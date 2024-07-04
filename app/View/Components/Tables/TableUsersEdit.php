<?php

namespace App\View\Components\Tables;

use Closure;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TableUsersEdit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $users)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.table-users-edit');
    }
}
