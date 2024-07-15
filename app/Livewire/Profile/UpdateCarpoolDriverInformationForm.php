<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\CarpoolRequest;
use App\Models\CarpoolDriver;
use App\Models\CarpoolingDetails;
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

        // Create carpool driver if it does not exist
        if (!$carpoolDriver) {
            $carpoolDriver = new CarpoolDriver();
            $carpoolDriver->user_id = auth()->id();
            $carpoolDriver->save();
        }

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
            'availability_status' => 'required|string|in:Available,Unavailable',
        ])->validate();

        // Get carpool driver details based on the authenticated user
        $carpoolDriver = CarpoolDriver::where('user_id', auth()->id())->first();

        // Get all carpool requests belonging to the driver
        $carpoolRequests = CarpoolRequest::where('carpool_driver_id', $carpoolDriver->id)->get();

        // Get carpooling details based on the carpool requests
        $carpoolDetails = CarpoolingDetails::whereIn('carpool_request_id', $carpoolRequests->pluck('id'))
            ->where('status', 'In Progress')
            ->first();

        // Prevent changing status to 'Available' if there's a carpool schedule in progress
        if ($validatedData['availability_status'] === 'Available' && $carpoolDetails) {
            $this->addError('availability_status', 'You cannot change your availability status to "Available" while you have a carpool schedule in progress.');
            return;
        }

        // Update the carpool driver information
        CarpoolDriver::where('user_id', auth()->id())->update($validatedData);

        // Trigger action message on form
        $this->dispatch('saved');
    }

}
