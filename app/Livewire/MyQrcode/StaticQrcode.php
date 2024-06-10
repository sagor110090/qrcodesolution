<?php

namespace App\Livewire\MyQrcode;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class StaticQrcode extends Component
{
    use WithPagination;

    #[On('updateQrCode')]
    public function updateQrCode()
    {
        $this->render();
    }
    #[Url]
    public $search = '';
    public function render()
    {
        return view('livewire.my-qrcode.static-qrcode',[
            'qrcodes' => auth()->user()->qrCodes()->isStatic()
            ->when($this->search, function ($query) {
                return $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('type', 'like', '%' . $this->search . '%');
            })
            ->latest()->paginate(8)
        ]);
    }

    public function makeDynamic($id)
    {
        $qrcode = auth()->user()->qrCodes()->findOrFail($id);
        $qrcode->update(['is_dynamic' => true]);
        $this->js('alert("Successfully updated qrcode.")');
    }


}
