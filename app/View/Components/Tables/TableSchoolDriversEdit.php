<?php

namespace App\View\Components\Tables;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableSchoolDriversEdit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $schoolDrivers)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.table-school-drivers-edit');
    }
}
