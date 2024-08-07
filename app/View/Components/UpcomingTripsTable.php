<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportSchedule;

class UpcomingTripsTable extends Component

{
    public $transportSchedules;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get the upcoming trip with 'status' as 'In Progress'
        $this->transportSchedules = TransportSchedule::where('schedule_date', '>=', now())
            ->where('status', 'In Progress')
            ->orderBy('schedule_date', 'asc')
            ->limit(3)
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
