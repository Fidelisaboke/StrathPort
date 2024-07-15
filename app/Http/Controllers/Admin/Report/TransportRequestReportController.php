<?php

namespace App\Http\Controllers\Admin\Report;

use function Spatie\LaravelPdf\Support\pdf;
use App\Models\TransportRequest;
use Spatie\Browsershot\Browsershot;

use App\Http\Controllers\Controller;

class TransportRequestReportController extends Controller
{
    /**
     * Generate a montly report of transport requests.
     */
    public function __invoke(){

        // Fetch all transport requests for the current month
        $transportRequests = TransportRequest::whereMonth('event_date', now()->month)->get();

        // Calculate totals and breakdowns
        $totalRequests = $transportRequests->count();
        $uniqueUsers = $transportRequests->unique('user_id')->count();
        $statusCounts = $transportRequests->groupBy('status')->map->count();

        return view('admin.transport_requests.report', [
            'transportRequests' => $transportRequests,
            'totalRequests' => $totalRequests,
            'uniqueUsers' => $uniqueUsers,
            'statusCounts' => $statusCounts,
        ]);

        // return pdf('admin.transport_requests.report', [
        //     'transportRequests' => $transportRequests,
        //     'totalRequests' => $totalRequests,
        //     'uniqueUsers' => $uniqueUsers,
        //     'statusCounts' => $statusCounts,
        // ]);
    }
}
