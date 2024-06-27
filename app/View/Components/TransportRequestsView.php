<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TransportRequest;

class TransportRequestsView extends Component
{
    public $transport_requests;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->transport_requests = TransportRequest::paginate(10);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.transport-requests-view');
    }
}
