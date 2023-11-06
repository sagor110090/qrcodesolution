<?php

namespace App\Livewire\Plan;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.plan.index')->layout('components.layouts.admin');
    }
}
