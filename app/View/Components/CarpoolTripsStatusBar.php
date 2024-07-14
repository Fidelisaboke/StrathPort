<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CarpoolDriver;
use App\Models\CarpoolRequest;
use App\Models\CarpoolingDetails;

class CarpoolTripsStatusBar extends Component
{
    public $inProgressCount;
    public $completedCount;
    public $cancelledCount;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get the carpool driver via auth user id
        $carpoolDriver = CarpoolDriver::where('user_id', auth()->id())->first();

        // Get the carpool requests linked to the carpool driver
        $carpoolRequestIds = CarpoolRequest::where('carpool_driver_id', $carpoolDriver->id)
            ->pluck('id');

        // Get the count of carpool trips with 'status' as 'In Progress' linked to the carpool requests
        $this->inProgressCount = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)
            ->where('status', 'In Progress')
            ->count();

        // Get the count of carpool trips with 'status' as 'Completed' linked to the carpool requests

        $this->completedCount = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)
            ->where('status', 'Completed')
            ->count();

        // Get the count of carpool trips with 'status' as 'Cancelled' linked to the carpool requests
        $this->cancelledCount = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)
            ->where('status', 'Cancelled')
            ->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.carpool-trips-status-bar');
    }
}
