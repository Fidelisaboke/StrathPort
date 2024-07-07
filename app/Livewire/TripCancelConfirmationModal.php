<?php

namespace App\Livewire;

use Livewire\Component;

class TripCancelConfirmationModal extends Component
{
    public $showModal = false;
    public $redirectUrl;
    public $id;
    public $modelClass;

    protected $listeners = ['cancelTrip' => 'show'];

    public function show($redirectUrl, $id, $modelClass)
    {
        $this->redirectUrl = $redirectUrl;
        $this->id = $id;
        $this->modelClass = $modelClass;
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.trip-cancel-confirmation-modal');
    }
    /**
     * Cancel the trip
     */
    public function cancelTrip(){
        $modelClass = $this->modelClass;
        $model = $modelClass::find($this->id);
        if ($model) {
            $model->status = 'Cancelled';
            $model->save();

            session()->flash('success', 'Trip has been cancelled successfully.');
        }
        else {
            session()->flash('error', 'Failed to cancel trip.');
        }

        return redirect($this->redirectUrl.'/'.$this->id);
    }
}
