<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class UpdateStudentInformationForm extends Component
{
    public $state = [];

    /**
     * Mount the component's properties to the view
     */
    public function mount()
    {
        $student = Student::where('user_id', auth()->id())->first();

        // Create student if it does not exist
        if (!$student) {
            $student = new Student();
            $student->user_id = auth()->id();
            $student->save();
        }
        
        $this->state = $student->toArray();
    }

    public function render()
    {
        return view('livewire.profile.update-student-information-form');
    }

    public function update()
    {
        // Get data from the form livewire component
        $validatedData = Validator::make($this->state, [
            'student_school_id' => 'required|integer|max:999999',
            'first_name' => 'required|string|max:255|alpha',
            'last_name' => 'required|string|max:255|alpha',
        ])->validate();

        // Update the carpool driver information
        Student::where('user_id', auth()->id())->update($validatedData);

        // Trigger action message on form
        $this->dispatch('saved');

    }
}
