<?php

namespace App\Livewire\MyQrcode;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Track extends ModalComponent
{

    public $locations;

    public function mount($locations)
    {
        $this->locations = $locations;
    }

    public function boot()
    {
        $this->js('loadingStop()');
    }

    public function render()
    {
        return view('livewire.my-qrcode.track');
    }
}
