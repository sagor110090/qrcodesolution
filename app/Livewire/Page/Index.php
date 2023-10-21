<?php

namespace App\Livewire\Page;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.page.index')->layout('components.layouts.admin');
    }
}
