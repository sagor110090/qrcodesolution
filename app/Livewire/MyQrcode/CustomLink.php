<?php

namespace App\Livewire\MyQrcode;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CustomLink extends ModalComponent
{

    use LivewireAlert;

    public $qrCode;
    public $link;

    public function mount($qrcode)
    {
        $this->qrCode = (object)$qrcode;
        $this->link = $this->qrCode->subdomain ;
    }

    public function render()
    {
        return view('livewire.my-qrcode.custom-link');
    }

    public function submit()
    {
        $this->validate([
            'link' => 'required|unique:qr_codes,subdomain,'.$this->qrCode->id,
        ]);
        auth()->user()->qrcodes()->where('id',$this->qrCode->id)->update([
            'subdomain' => $this->link
        ]);
        $this->dispatch('updateQrCode');
        $this->closeModal();
        $this->alert('success', 'Custom link updated successfully!');


    }
}
