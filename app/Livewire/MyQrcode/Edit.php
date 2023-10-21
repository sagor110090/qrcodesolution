<?php

namespace App\Livewire\MyQrcode;

use App\Models\QrCode;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Edit extends ModalComponent
{
    public $qrCode = QrCode::class;
    public $qrCodeId;
    public $name;


    public function render()
    {
        return view('livewire.my-qrcode.edit');
    }
}
