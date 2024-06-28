<?php

namespace App\Livewire;

use Livewire\Component;

class DeleteConfirmationModal extends Component
{
    public $showModal = false;
    public $indexRoute;
    public $id;
    public $modelClass;

    protected $listeners = ['delete' => 'show'];

    public function show($indexRoute, $id, $modelClass)
    {
        $this->indexRoute = $indexRoute;
        $this->id = $id;
        $this->modelClass = $modelClass;
        $this->showModal = true;
    }
    public function render()
    {
        return view('livewire.delete-confirmation-modal');
    }
    /**
     * Delete the specified resource in storage
     */
    public function delete(){
        $modelClass = $this->modelClass;
        $model = $modelClass::find($this->id);
        if ($model) {
            $model->delete();
            session()->flash('success', 'Resource deleted successfully.');
        } else {
            session()->flash('error', 'Failed to delete the resource.');
        }

        return redirect()->route($this->indexRoute);
    }


}
