<?php

namespace App\Livewire\Tag;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.tag.index')->layout('components.layouts.admin');
    }
}
