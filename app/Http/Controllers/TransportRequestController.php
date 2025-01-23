<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportRequest;
use App\Models\SchoolVehicle;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TransportRequestSubmittedNotification;


class TransportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        $transportRequests = TransportRequest::where('user_id', Auth::id())->orderByDesc('id')->paginate(10);
        return view('user.transport_requests.index', compact('transportRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        return view('user.transport_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        // validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'event_date' => 'required|date|before:'. Carbon::now()->addMonths(6) .'|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'event_time' => 'required|after:05:00|before:19:00',
            'event_location' => 'required|string|max:255',
            'no_of_people' => 'required|integer|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('transport_requests/create')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'event_location' => $request->event_location,
            ];

            // Get vehicle that has an availiability status of 'Available' with the highest capacity
            $schoolVehicle = SchoolVehicle::where('availability_status', 'Available')->orderByDesc('capacity')->first();

            // if the no of people is greater than the vehicle capacity, return with error message
            if ($request->no_of_people > $schoolVehicle->capacity) {
                return redirect('transport_requests/create')
                    ->with('error',
                    "The number of people exceeds the capacity of vehicles available ({$schoolVehicle->capacity}).\n
                    Make a second request for the remaining people.");
            }

            $input['no_of_people'] = $request->no_of_people;

            $transportRequest = TransportRequest::create($input);

            if (!$transportRequest) {
                return redirect('transport_requests/create')->with('error', 'Failed to create Transport Request.');
            }

            // Notify the authenticated user
            Notification::send(Auth::user(), new TransportRequestSubmittedNotification($transportRequest));

            // Send notification to the admins
            $adminRole = Role::findByName('admin', 'web');
            $admins = $adminRole->users;
            Notification::send($admins, new TransportRequestSubmittedNotification($transportRequest));

            // Return with success message
            return redirect('transport_requests')->with('success', 'Transport Request created successfully.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        $transportRequest = TransportRequest::find($id);
        return view('user.transport_requests.show', compact('transportRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        $transportRequest = TransportRequest::find($id);
        return view('user.transport_requests.edit', compact('transportRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        // validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date|before:'. Carbon::now()->addMonths(6) .'|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'event_time' => 'required|after:05:00|before:19:00',
            'event_location' => 'required',
            'no_of_people' => 'required|integer|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('transport_requests/' . $id . '/edit')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'event_location' => $request->event_location,
            ];

            // Get vehicle that has an availiability status of 'Available' with the highest capacity
            $schoolVehicle = SchoolVehicle::where('availability_status', 'Available')->orderByDesc('capacity')->first();

            // if the no of people is greater than the vehicle capacity, return with error message
            if ($request->no_of_people > $schoolVehicle->capacity) {
                return redirect('transport_requests/create')
                    ->with('error',
                    "The number of people exceeds the capacity of vehicles available ({$schoolVehicle->capacity}).\n
                    Make a second request for the remaining people.");
            }

            $input['no_of_people'] = $request->no_of_people;


            $requestUpdated = TransportRequest::find($id)->update($input);

            if(!$requestUpdated){
                return redirect()->back()->with('error', 'Failed to update request');
            }

            // Return with success message
            return redirect('transport_requests')->with('success', 'Transport Request updated successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        TransportRequest::find($id)->delete();
        return redirect('transport_requests')->with('success', 'Transport Request deleted successfully.');
    }

    /**
     * Search for a transport request.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        $search = $request->input('search');

        // Search for transport requests for the specific user
        $transportRequests = TransportRequest::where('user_id', Auth::id())
            ->where(function($query) use ($search) {
            $query->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%")
                ->orWhere('event_date', 'LIKE', "%$search%")
                ->orWhere('event_time', 'LIKE', "%$search%")
                ->orWhere('event_location', 'LIKE', "%$search%")
                ->orWhere('no_of_people', 'LIKE', "%$search%");
            })
            ->orderByDesc('id')
            ->paginate(10);

        return view('user.transport_requests.index', compact('transportRequests'));
    }

    /**
     * Filter transport requests by status.
     */
    public function filter(Request $request)
    {
        abort_unless(Gate::allows('student'), 403, 'Forbidden');

        $filter = $request->input('status');
        if ($filter == 'All') {
            $transportRequests = TransportRequest::where('user_id', Auth::id())->paginate(10);
        } else {
            $transportRequests = TransportRequest::where('user_id', Auth::id())->where('status', $filter)->paginate(10);
        }

        return view('user.transport_requests.index', compact('transportRequests'));
    }
}
