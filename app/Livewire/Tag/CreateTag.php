<?php

namespace App\Livewire\Tag;

use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateTag extends ModalComponent
{
    use LivewireAlert;
    public $name;

    public function render()
    {
        return view('livewire.tag.create-tag')->layout('components.layouts.admin');
    }

    //store
    public function store()
    {
        $this->validate([
            'name' => 'required|unique:tags,name',
        ]);

        $this->name = \Illuminate\Support\Str::slug($this->name);

        \App\Models\Tag::create([
            'name' => $this->name,
        ]);
        $this->alert('success', 'Tag Created Successfully');
        $this->closeModalWithEvents(['tagCreated']);
    }

}
