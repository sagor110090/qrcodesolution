<?php

namespace App\Livewire\Tag;


use LivewireUI\Modal\ModalComponent;

class EditTag extends ModalComponent
{
    use \Jantinnerezo\LivewireAlert\LivewireAlert;
    public $tag_id;
    public $name;

    public function mount($id)
    {
        $this->tag_id = $id;
        $tag = \App\Models\Tag::find($id);
        $this->name = $tag->name;
    }

    public function render()
    {
        return view('livewire.tag.edit-tag')->layout('components.layouts.admin');
    }

    //update
    public function update()
    {
        $this->validate([
            'name' => 'required|unique:tags,name,' . $this->tag_id,
        ]);

        $this->name = \Illuminate\Support\Str::slug($this->name);

        \App\Models\Tag::find($this->tag_id)->update([
            'name' => $this->name,
        ]);
        $this->alert('success', 'Tag Updated Successfully');
        $this->closeModalWithEvents(['tagUpdated']);
    }
}
