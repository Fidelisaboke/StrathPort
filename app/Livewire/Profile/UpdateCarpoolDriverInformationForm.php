<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\CarpoolDriver;
use Illuminate\Support\Facades\Validator;
use Livewire\WithEvents;

class UpdateCarpoolDriverInformationForm extends Component
{
    public $state = [];

    /**
     * Mount the component's properties to the view
     */
    public function mount()
    {
        $carpoolDriver = CarpoolDriver::where('user_id', auth()->id())->first();
        $this->state = $carpoolDriver->toArray();
    }

    public function render()
    {
        return view('livewire.profile.update-carpool-driver-information-form');
    }

    public function update()
    {
        // Get data from the form livewire component
        $validatedData = Validator::make($this->state, [
            'first_name' => 'required|string|max:255|alpha',
            'last_name' => 'required|string|max:255|alpha',
            'availability_status' => 'required|string|in:Avaliable,Unavaliable',
        ])->validate();

        // Update the carpool driver information
        CarpoolDriver::where('user_id', auth()->id())->update($validatedData);

        // Trigger action message on form
        $this->dispatch('saved');
    }

}
