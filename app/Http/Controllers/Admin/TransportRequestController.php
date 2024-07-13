<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolVehicle;
use App\Models\TransportRequest;
use App\Models\TransportSchedule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransportRequestDeclinedNotification;
use App\Notifications\TransportRequestApprovedNotification;
use Spatie\Permission\Models\Role;


class TransportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('admin'), 403, 'Forbidden');

        $transportRequests = TransportRequest::orderByDesc('id')->paginate(10);
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
            'event_date' => 'required|date|before:2024-12-31|after_or_equal:' . Carbon::now()->format('Y-m-d'),
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

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'event_date' => 'required|date|before:2024-12-31|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'event_time' => 'required|after:05:00|before:19:00',
            'event_location' => 'required|string|max:255',
            'no_of_people' => 'required|integer|between:1,200',
            'status' => 'required|in:Pending,Approved,Declined',
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_requests/' . $id . '/edit')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'event_location' => $request->event_location,
                'no_of_people' => $request->no_of_people,
                'status' => $request->status,
            ];


            // Update the corresponding transport schedule if exists
            $transportSchedule = TransportSchedule::where('transport_request_id', $id)->first();

            if ($request->status == 'Declined' && !empty($transportSchedule)) {
                // Delete the corresponding transport schedule if exists
                TransportSchedule::where('transport_request_id', $id)->delete();

                $requestUpdated = TransportRequest::find($id)->update($input);

                if (!$requestUpdated) {
                    return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while updating the transport request status!');
                }

                $transportRequest = TransportRequest::find($id);
                $user = $transportRequest->user;

                // Notify the user
                Notification::send($user, new TransportRequestDeclinedNotification($transportRequest));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                // Notify all admins
                Notification::send($admins, new TransportRequestDeclinedNotification($transportRequest));
            }

            // If status changed to pending, delete the corresponding transport schedule
            if ($request->status == 'Pending' && !empty($transportSchedule)) {
                TransportSchedule::where('transport_request_id', $id)->delete();
                return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request updated successfully! The corresponding transport schedule has been deleted.');
            }

            if ($request->status == 'Approved' && empty($transportSchedule)) {
                // Check if any school vehicle is available
                $availableVehicles = SchoolVehicle::where('availability_status', 'Available')->count();
                if ($availableVehicles < 1) {
                    return redirect('admin/transport_requests/' . $id)->with('error', 'No school vehicle is available. Request cannot be approved.');
                }

                // Create a corresponding transport schedule if not exists
                $schedule = [
                    'transport_request_id' => $id,
                    'title' => TransportRequest::find($id)->title,
                    'description' => TransportRequest::find($id)->description,
                    'schedule_date' => TransportRequest::find($id)->event_date,
                    'schedule_time' => TransportRequest::find($id)->event_time,
                    'starting_point' => 'Strathmore University',
                    'destination' => TransportRequest::find($id)->event_location,
                ];

                TransportSchedule::create($schedule);

                // Check if transport schedule was created
                $transportSchedule = TransportSchedule::where('transport_request_id', $id)->first();
                if (empty($transportSchedule)) {
                    return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while creating the transport schedule!');
                }

                $requestUpdated = TransportRequest::find($id)->update($input);

                if (!$requestUpdated) {
                    return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while updating the transport request status!');
                }

                $transportRequest = TransportRequest::find($id);
                $user = $transportRequest->user;

                // Notify the user
                Notification::send($user, new TransportRequestApprovedNotification($transportRequest));

                $adminRole = Role::findByName('admin', 'web');
                $admins = $adminRole->users;

                // Notify all admins
                Notification::send($admins, new TransportRequestApprovedNotification($transportRequest));

                return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request approved successfully! A transport schedule has been created.');
            }

            $requestUpdated = TransportRequest::find($id)->update($input);

            if (!$requestUpdated) {
                return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while updating the transport request status!');
            }

            $message = $request->status == 'Declined' ? 'The corresponding transport schedule has been deleted.' : 'Request updated.';
            return redirect('admin/transport_requests')->with('success', 'Transport request updated successfully! ' . $message);
        }
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
        $transportRequests = TransportRequest::where(function ($query) use ($search) {
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
            $transportRequests = TransportRequest::orderByDesc('id')->paginate(10);
        } else {
            $transportRequests = TransportRequest::where('status', $filter)->orderByDesc('id')->paginate(10);
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

        $input = [
            'status' => $request->status,
        ];

        $transportSchedule = TransportSchedule::where('transport_request_id', $id)->first();

        if ($request->status == 'Declined') {
            $requestUpdated = TransportRequest::find($id)->update($input);

            if (!$requestUpdated) {
                return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while updating the transport request status!');
            }

            $transportRequest = TransportRequest::find($id);
            $user = $transportRequest->user;

            // Notify the user
            Notification::send($user, new TransportRequestDeclinedNotification($transportRequest));

            $adminRole = Role::findByName('admin', 'web');
            $admins = $adminRole->users;

            // Notify all admins
            Notification::send($admins, new TransportRequestDeclinedNotification($transportRequest));

            return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request status declined successfully.');
        }

        if ($request->status == 'Approved' && empty($transportSchedule)) {
            // Check if any school vehicle is available
            $availableVehicles = SchoolVehicle::where('availability_status', 'Available')->count();
            if ($availableVehicles < 1) {
                return redirect('admin/transport_requests/' . $id)->with('error', 'No school vehicle is available. Request cannot be approved.');
            }

            // Create a corresponding transport schedule if not exists
            $schedule = [
                'transport_request_id' => $id,
                'title' => TransportRequest::find($id)->title,
                'description' => TransportRequest::find($id)->description,
                'schedule_date' => TransportRequest::find($id)->event_date,
                'schedule_time' => TransportRequest::find($id)->event_time,
                'starting_point' => 'Strathmore University',
                'destination' => TransportRequest::find($id)->event_location,
            ];

            TransportSchedule::create($schedule);

            // Check if transport schedule was created
            $transportSchedule = TransportSchedule::where('transport_request_id', $id)->first();
            if (empty($transportSchedule)) {
                return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while creating the transport schedule!');
            }

            $requestUpdated = TransportRequest::find($id)->update($input);

            if (!$requestUpdated) {
                return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while updating the transport request status!');
            }

            $transportRequest = TransportRequest::find($id);
            $user = $transportRequest->user;

            // Notify the user
            Notification::send($user, new TransportRequestApprovedNotification($transportRequest));

            $adminRole = Role::findByName('admin', 'web');
            $admins = $adminRole->users;

            // Notify all admins
            Notification::send($admins, new TransportRequestApprovedNotification($transportRequest));

            return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request status approved successfully! A transport schedule has been created.');
        }

        $requestUpdated = TransportRequest::find($id)->update($input);

        if (!$requestUpdated) {
            return redirect('admin/transport_requests/' . $id)->with('error', 'An error occurred while updating the transport request status!');
        }

        return redirect('admin/transport_requests/' . $id)->with('success', 'Transport request status updated successfully! Request Updated.');
    }
}
