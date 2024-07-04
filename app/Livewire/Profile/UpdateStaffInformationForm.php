<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Staff;
use Illuminate\Support\Facades\Validator;

class UpdateStaffInformationForm extends Component
{
    public $state = [];

    /**
     * Mount the component's properties to the view
     */
    public function mount()
    {
        $staff = Staff::where('user_id', auth()->id())->first();
        $this->state = $staff->toArray();

        // Create staff if it does not exist
        if (!$staff) {
            $staff = new Staff();
            $staff->user_id = auth()->id();
            $staff->save();
        }
    }
    public function render()
    {
        return view('livewire.profile.update-staff-information-form');
    }

    public function update()
    {
        // Get data from the form livewire component
        $validatedData = Validator::make($this->state, [
            'staff_school_id' => 'required|integer|max:999999',
            'first_name' => 'required|string|max:255|alpha',
            'last_name' => 'required|string|max:255|alpha',
        ])->validate();

        // Update the carpool driver information
        Staff::where('user_id', auth()->id())->update($validatedData);

        // Trigger action message on form
        $this->dispatch('saved');

    }
}
