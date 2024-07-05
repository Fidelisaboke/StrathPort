<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransportRequest;
use App\Models\TransportSchedule;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TransportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            $transportRequests = TransportRequest::paginate(10);
            return view('admin.transport_requests.index', compact('transportRequests'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            return view('admin.transport_requests.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            // Validate the request...
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|integer',
                'title' => 'required|string|max:60',
                'description' => 'required|string|max:255',
                'event_date' => 'required|date|before:2024-12-31|after_or_equal:'.Carbon::now()->format('Y-m-d'),
                'event_time' => 'required|after:05:00|before:19:00',
                'event_location' => 'required|string|max:255',
                'no_of_people' => 'required|integer|between:1,200',
            ]);

            if ($validator->fails()) {
                return redirect('admin/transport_requests/create')
                            ->withErrors($validator->errors())
                            ->withInput();
            } else {
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
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            $transportRequest = TransportRequest::find($id);
            return view('admin.transport_requests.show', compact('transportRequest'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            $transportRequest = TransportRequest::find($id);
            return view('admin.transport_requests.edit', compact('transportRequest'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            // Validate the request...
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:60',
                'description' => 'required|string|max:255',
                'event_date' => 'required|date|before:2024-12-31|after_or_equal:'.Carbon::now()->format('Y-m-d'),
                'event_time' => 'required|after:05:00|before:19:00',
                'event_location' => 'required|string|max:255',
                'no_of_people' => 'required|integer|between:1,200',
                'status' => 'required|in:Pending,Approved,Declined',
            ]);

            if ($validator->fails()) {
                return redirect('admin/transport_requests/'.$id.'/edit')
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

                TransportRequest::find($id)->update($input);
                return redirect('admin/transport_requests')->with('success', 'Transport request updated successfully!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            TransportRequest::find($id)->delete();
            return redirect('admin/transport_requests')->with('success', 'Transport request deleted successfully!');
        }
    }

    /**
     * Search for a transport request.
     */
    public function search(Request $request)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            $search = $request->get('search');
            $transportRequests = TransportRequest::where('title', 'like', '%'.$search.'%')
                ->orWhere('description', 'like', '%'.$search.'%')
                ->orWhere('event_date', 'like', '%'.$search.'%')
                ->orWhere('event_time', 'like', '%'.$search.'%')
                ->orWhere('event_location', 'like', '%'.$search.'%')
                ->orWhere('no_of_people', 'like', '%'.$search.'%')
                ->paginate(10);
            return view('admin.transport_requests.index', compact('transportRequests'));
        }
    }

    /**
     * Filter transport requests by status.
     */
    public function filter(Request $request)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        } else {
            $filter = $request->get('status');
            if($filter == 'All'){
                $transportRequests = TransportRequest::paginate(10);
            } else {
                $transportRequests = TransportRequest::where('status', $filter)->paginate(10);
            }
            return view('admin.transport_requests.index', compact('transportRequests'));
        }
    }

    /**
     * Update the status of a transport request.
     */
    public function updateStatus(Request $request, string $id)
    {
        if(!Gate::allows('admin')){
            abort(403, 'Unauthorized');
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:Pending,Approved,Declined',
        ]);

        if ($validator->fails()) {
            return redirect('admin/transport_requests/'.$id)
                        ->withErrors($validator->errors())
                        ->withInput();
        }

        $input = [
            'status' => $request->status,
        ];

        $requestUpdated = TransportRequest::find($id)->update($input);

        if(!$requestUpdated){
            return redirect('admin/transport_requests/'.$id)->with('error', 'An error occurred while updating the transport request status!');
        }

        $transportSchedule = TransportSchedule::where('transport_request_id', $id)->first();

        if($request->status == 'Approved' && empty($transportSchedule)){
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

            return redirect('admin/transport_requests/'.$id)->with('success', 'Transport request status updated successfully! A transport schedule has been created.');
        } elseif($request->status == 'Declined' && !empty($transportSchedule)){
            // Delete the corresponding transport schedule if exists
            TransportSchedule::where('transport_request_id', $id)->delete();

            return redirect('admin/transport_requests/'.$id)->with('success', 'Transport request status updated successfully! The corresponding transport schedule has been deleted.');
        }
    }
}
