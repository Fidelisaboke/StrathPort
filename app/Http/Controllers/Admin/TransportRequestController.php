<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SchoolVehicle;
use App\Models\TransportRequest;
use App\Models\TransportSchedule;
use Spatie\LaravelPdf\Facades\Pdf;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransportRequestApprovedNotification;
use App\Notifications\TransportRequestDeclinedNotification;


class TransportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportRequests = TransportRequest::with('user')->orderByDesc('id')->paginate(10);
        return view('admin.transport_requests.index', compact('transportRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        return view('admin.transport_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:today',
            'event_time' => 'required|after:05:00|before:19:00',
            'event_location' => 'required|string|max:255',
            'no_of_people' => 'required|integer|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_requests/create')
                ->withErrors($validator->errors())
                ->withInput();
        }

        $input = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'event_location' => $request->event_location,
            'no_of_people' => $request->no_of_people,
        ];

        TransportRequest::create($input);
        return redirect('admin/transport_requests')->with('success', 'Transport request created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportRequest = TransportRequest::find($id);
        return view('admin.transport_requests.show', compact('transportRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportRequest = TransportRequest::find($id);
        return view('admin.transport_requests.edit', compact('transportRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'event_date' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'event_time' => 'required|after:05:00|before:19:00',
            'event_location' => 'required|string|max:255',
            'no_of_people' => 'required|integer|between:1,200',
            'status' => 'required|in:Pending,Approved,Declined',
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_requests/' . $id . '/edit')
                ->withErrors($validator->errors())
                ->withInput();
        }

        return DB::transaction(function () use ($request, $id) {
            $transportRequest = TransportRequest::findOrFail($id);
            $input = $request->only(['title', 'description', 'event_date', 'event_time', 'event_location', 'no_of_people', 'status']);

            $transportSchedule = TransportSchedule::where('transport_request_id', $id)->first();

            if ($request->status == 'Declined' && $transportSchedule) {
                $transportSchedule->delete();
                $transportRequest->update($input);

                $user = $transportRequest->user;
                Notification::send($user, new TransportRequestDeclinedNotification($transportRequest));
                $admins = Role::findByName('admin', 'web')->users;
                Notification::send($admins, new TransportRequestDeclinedNotification($transportRequest));
            }

            if ($request->status == 'Pending' && $transportSchedule) {
                $transportSchedule->delete();
                $transportRequest->update($input);
            }

            if ($request->status == 'Approved' && !$transportSchedule) {
                // Atomic check for available vehicles
                $hasAvailable = SchoolVehicle::where('availability_status', 'Available')->lockForUpdate()->exists();
                if (!$hasAvailable) {
                    return redirect('admin/transport_requests/' . $id)->with('error', 'No school vehicle is available. Request cannot be approved.');
                }

                $schedule = [
                    'transport_request_id' => $id,
                    'title' => $transportRequest->title,
                    'description' => $transportRequest->description,
                    'schedule_date' => $transportRequest->event_date,
                    'schedule_time' => $transportRequest->event_time,
                    'starting_point' => 'Strathmore University',
                    'destination' => $transportRequest->event_location,
                ];

                TransportSchedule::create($schedule);
                $transportRequest->update($input);

                $user = $transportRequest->user;
                Notification::send($user, new TransportRequestApprovedNotification($transportRequest));
                $admins = Role::findByName('admin', 'web')->users;
                Notification::send($admins, new TransportRequestApprovedNotification($transportRequest));

                return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request approved successfully!');
            }

            $transportRequest->update($input);
            return redirect('admin/transport_requests')->with('success', 'Transport request updated successfully!');
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        TransportRequest::find($id)->delete();
        return redirect('admin/transport_requests')->with('success', 'Transport request deleted successfully!');
    }

    /**
     * Search for a transport request.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $search = $request->get('search');
        $transportRequests = TransportRequest::with('user')->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('event_date', 'like', '%' . $search . '%')
                ->orWhere('event_time', 'like', '%' . $search . '%')
                ->orWhere('event_location', 'like', '%' . $search . '%')
                ->orWhere('no_of_people', 'like', '%' . $search . '%');
        })->orderByDesc('id')->paginate(10);

        return view('admin.transport_requests.index', compact('transportRequests'));
    }

    /**
     * Filter transport requests by status.
     */
    public function filter(Request $request)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $filter = $request->get('status');
        if ($filter == 'All') {
            $transportRequests = TransportRequest::with('user')->orderByDesc('id')->paginate(10);
        } else {
            $transportRequests = TransportRequest::with('user')->where('status', $filter)->orderByDesc('id')->paginate(10);
        }
        return view('admin.transport_requests.index', compact('transportRequests'));
    }

    /**
     * Update the status of a transport request.
     */
    public function updateStatus(Request $request, string $id)
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,Approved,Declined',
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_requests/' . $id)
                ->withErrors($validator->errors())
                ->withInput();
        }

        return DB::transaction(function () use ($request, $id) {
            $transportRequest = TransportRequest::findOrFail($id);
            $transportSchedule = TransportSchedule::where('transport_request_id', $id)->first();
            $input = ['status' => $request->status];

            if ($request->status == 'Declined') {
                if ($transportSchedule) {
                    $transportSchedule->delete();
                }
                $transportRequest->update($input);

                $user = $transportRequest->user;
                Notification::send($user, new TransportRequestDeclinedNotification($transportRequest));
                $admins = Role::findByName('admin', 'web')->users;
                Notification::send($admins, new TransportRequestDeclinedNotification($transportRequest));

                return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request status declined successfully.');
            }

            if ($request->status == 'Approved' && !$transportSchedule) {
                // Atomic check for available vehicles
                $hasAvailable = SchoolVehicle::where('availability_status', 'Available')->lockForUpdate()->exists();
                if (!$hasAvailable) {
                    return redirect('admin/transport_requests/' . $id)->with('error', 'No school vehicle is available. Request cannot be approved.');
                }

                $schedule = [
                    'transport_request_id' => $id,
                    'title' => $transportRequest->title,
                    'description' => $transportRequest->description,
                    'schedule_date' => $transportRequest->event_date,
                    'schedule_time' => $transportRequest->event_time,
                    'starting_point' => 'Strathmore University',
                    'destination' => $transportRequest->event_location,
                    'no_of_people' => $transportRequest->no_of_people,
                ];

                TransportSchedule::create($schedule);
                $transportRequest->update($input);

                $user = $transportRequest->user;
                Notification::send($user, new TransportRequestApprovedNotification($transportRequest));
                $admins = Role::findByName('admin', 'web')->users;
                Notification::send($admins, new TransportRequestApprovedNotification($transportRequest));

                return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request status approved successfully!');
            }

            if ($request->status == 'Pending' && $transportSchedule) {
                $transportSchedule->delete();
            }

            $transportRequest->update($input);
            return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request status updated successfully!');
        });
    }
}
