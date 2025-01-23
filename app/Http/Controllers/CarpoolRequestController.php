<?php

namespace App\Http\Controllers;

use App\Models\CarpoolDriver;
use Illuminate\Http\Request;
use App\Models\CarpoolRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CarpoolRequestSubmittedNotification;
use App\Notifications\CarpoolRequestUpdatedNotification;

class CarpoolRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $carpoolRequests = CarpoolRequest::where('user_id', Auth::id())->orderByDesc('id')->paginate(10);
        return view('user.carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $carpoolDrivers = CarpoolDriver::has('carpoolVehicle')
            ->where('availability_status', 'Available')
            ->get(['id', 'first_name', 'last_name', 'availability_status']);

        return view('user.carpool_requests.create', compact('carpoolDrivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'carpool_driver_id' => 'required|integer',
            'departure_date' => 'required|date|before:' . Carbon::now()->addMonths(6) .'|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'departure_time' => 'required',
            'departure_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'no_of_people' => 'required|integer|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('carpool_requests/create')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'user_id' => Auth::id(),
                'title' => $request->title,
                'description' => $request->description,
                'carpool_driver_id' => $request->carpool_driver_id,
                'departure_date' => $request->departure_date,
                'departure_time' => $request->departure_time,
                'departure_location' => $request->departure_location,
                'destination' => $request->destination,
                'no_of_people' => $request->no_of_people,
                'status' => 'Pending',
            ];

            // Check if carpool driver's vehicle capacity is enough
            $carpoolDriver = CarpoolDriver::find($request->carpool_driver_id);

            if ($carpoolDriver->carpoolVehicle->capacity < $request->no_of_people) {
                return redirect()->back()
                    ->with('error', 'The carpool driver\'s vehicle capacity (' . $carpoolDriver->carpoolVehicle->capacity . ') is not enough. Please select another carpool driver.')
                    ->withInput();
            }

            $carpoolRequest = CarpoolRequest::create($input);

            // Check if request has been created
            if ($carpoolRequest) {
                // Send notification to the carpool drivers and user
                $requestOwner = Auth::user();

                // Get the user account of the carpool driver
                $carpoolDriver = $carpoolRequest->carpoolDriver;
                $carpoolDriverUser = $carpoolDriver->user;

                Notification::send([$requestOwner, $carpoolDriverUser], new CarpoolRequestSubmittedNotification($carpoolRequest));

                return redirect('carpool_requests')->with('success', 'Carpool Request created successfully.');
            }

            return redirect()->back()
                ->with('error', 'An error occurred while creating the carpool request.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $carpoolRequest = CarpoolRequest::find($id);
        return view('user.carpool_requests.show', compact('carpoolRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $carpoolRequest = CarpoolRequest::find($id);
        $carpoolDrivers = CarpoolDriver::where('availability_status', 'Available')
            ->get(['id', 'first_name', 'last_name', 'availability_status']);

        return view('user.carpool_requests.edit', compact('carpoolRequest', 'carpoolDrivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        // Validate the request...
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'carpool_driver_id' => 'required|integer',
            'departure_date' => 'required|date|before:'. Carbon::now()->addMonths(6) .'|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'departure_time' => 'required',
            'departure_location' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'no_of_people' => 'required|integer|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('carpool_requests/' . $id . '/edit')
                ->withErrors($validator->errors())
                ->withInput();
        } else {
            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'carpool_driver_id' => $request->carpool_driver_id,
                'departure_date' => $request->departure_date,
                'departure_time' => $request->departure_time,
                'departure_location' => $request->departure_location,
                'destination' => $request->destination,
                'no_of_people' => $request->no_of_people,
                'status' => 'Pending',
            ];

            $carpoolRequest = CarpoolRequest::find($id)->update($input);

            if ($carpoolRequest) {
                // Send notification to the carpool drivers and user
                $requestOwner = Auth::user();

                // Get the user account of the carpool driver
                $carpoolDriver = $carpoolRequest->carpoolDriver;
                $carpoolDriverUser = $carpoolDriver->user;

                Notification::send([$requestOwner, $carpoolDriverUser], new CarpoolRequestUpdatedNotification($carpoolRequest));

                return redirect('carpool_requests')->with('success', 'Carpool Request updated successfully.');
            }

            return redirect('carpool_requests')
                ->with('error', 'An error occurred while updating the carpool request.')
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        CarpoolRequest::find($id)->delete();
        return redirect('carpool_requests')->with('success', 'Carpool Request deleted successfully.');
    }

    /**
     * Search for a carpool request.
     */
    public function search(Request $request)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $search = $request->input('search');

        $carpoolRequests = CarpoolRequest::where('user_id', Auth::id())
        ->where(function($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
            ->orWhere('description', 'like', '%' . $search . '%')
            ->orWhere('departure_location', 'like', '%' . $search . '%')
            ->orWhere('destination', 'like', '%' . $search . '%');
        })
        ->orderByDesc('id')
        ->paginate(10);
        return view('user.carpool_requests.index', compact('carpoolRequests'));
    }

    /**
     * Filter carpool requests by status.
     */
    public function filter(Request $request)
    {
        abort_unless(Gate::any(['student', 'staff']), 403, 'Forbidden');

        $filter = $request->get('status');
        if ($filter == 'All') {
            $carpoolRequests = CarpoolRequest::where('user_id', Auth::id())->orderByDesc('id')->paginate(10);
        } else {
            $carpoolRequests = CarpoolRequest::where('user_id', Auth::id())
                ->where('status', $filter)
                ->orderByDesc('id')
                ->paginate(10);
        }

        return view('user.carpool_requests.index', compact('carpoolRequests'));
    }
}
