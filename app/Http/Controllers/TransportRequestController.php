<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransportRequest;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class TransportRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transportRequests = TransportRequest::paginate(10);
        return view('transport_requests.index', compact('transportRequests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('transport_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date|before:2024-12-31|after_or_equal:'.Carbon::now()->format('Y-m-d'),
            'event_time' => 'required|after:05:00|before:19:00',
            'event_location' => 'required',
            'no_of_people' => 'required|integer|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('transport_requests/create')
                        ->withErrors($validator->errors())
                        ->withInput();
        }else{
            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'event_location' => $request->event_location,
                'no_of_people' => $request->no_of_people,
            ];

            TransportRequest::create($input);

            // Return with success message
            return redirect('transport_requests')->with('success', 'Transport Request created successfully.');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transportRequest = TransportRequest::find($id);
        return view('transport_requests.show', compact('transportRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transportRequest = TransportRequest::find($id);
        return view('transport_requests.edit', compact('transportRequest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validate the form data
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'event_date' => 'required|date|before:2024-12-31|after_or_equal:'.Carbon::now()->format('Y-m-d'),
            'event_time' => 'required|after:05:00|before:19:00',
            'event_location' => 'required',
            'no_of_people' => 'required|integer|between:1,200',
        ]);

        if ($validator->fails()) {
            return redirect('transport_requests/'.$id.'/edit')
                        ->withErrors($validator->errors())
                        ->withInput();
        }else{
            $input = [
                'title' => $request->title,
                'description' => $request->description,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'event_location' => $request->event_location,
                'no_of_people' => $request->no_of_people,
            ];

            TransportRequest::find($id)->update($input);

            // Return with success message
            return redirect('transport_requests')->with('success', 'Transport Request updated successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TransportRequest::find($id)->delete();
        return redirect('transport_requests')->with('success', 'Transport Request deleted successfully.');
    }

    /**
     * Search for a transport request.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $transportRequests = TransportRequest::where('title', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->orWhere('event_location', 'like', '%'.$search.'%')
            ->orWhere('no_of_people', 'like', '%'.$search.'%')
            ->paginate(10);
        return view('transport_requests.index', compact('transportRequests'));
    }

    /**
     * Filter transport requests by status.
     */
    public function filter(Request $request){
        $filter = $request->input('status');
        if($filter == 'All'){
           $transportRequests = TransportRequest::paginate(10);
        }else{
            $transportRequests = TransportRequest::where('status', $filter)->paginate(10);
        }

        return view('transport_requests.index', compact('transportRequests'));
    }
}
