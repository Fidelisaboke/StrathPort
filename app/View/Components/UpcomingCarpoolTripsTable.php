<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\CarpoolingDetails;
use App\Models\CarpoolDriver;
use App\Models\CarpoolRequest;

class UpcomingCarpoolTripsTable extends Component
{
    public $carpoolingDetails;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get carpool driver via auth user id
        $carpoolDriver = CarpoolDriver::where('user_id', auth()->id())->first();

        // Get the 'Approved' carpoling requests' ids linked to the carpool driver
        $carpoolRequestIds = CarpoolRequest::where('carpool_driver_id', $carpoolDriver->id)
            ->where('status', 'Approved')
            ->where('departure_date', '>=', now())
            ->pluck('id');

        // Get the first 3 upcoming carpool trips with 'status' as 'In Progress' linked to the carpool requests
        $this->carpoolingDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequestIds)
            ->where('status', 'In Progress')
            ->limit(3)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.upcoming-carpool-trips-table');
    }
}
