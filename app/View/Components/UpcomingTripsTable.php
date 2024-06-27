<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportSchedule;

class UpcomingTripsTable extends Component

{
    public $transport_schedules;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get at most 4 upcoming trips
        $this->transport_schedules = TransportSchedule::where('schedule_date', '>=', now())
            ->orderBy('schedule_date', 'asc')
            ->limit(5)
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.upcoming-trips-table');
    }
}
