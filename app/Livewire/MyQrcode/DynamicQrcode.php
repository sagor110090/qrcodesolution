<?php

namespace App\Livewire\MyQrcode;

use App\Models\QrCode;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class DynamicQrcode extends Component
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

        return view('livewire.my-qrcode.dynamic-qrcode', [
            'qrcodes' =>   QrCode::where('user_id', auth()->user()->id)
                ->isDynamic()
                ->when($this->search, function ($query) {
                    return $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('type', 'like', '%' . $this->search . '%');
                })
                ->with('qrCodeTracks')
                ->latest()
                ->paginate(10)
        ]);
    }

    public function makeStatic($id)
    {
        $qrcode =  auth()
            ->user()
            ->qrCodes()
            ->findOrFail($id);
        $qrcode->update(['is_dynamic' => false]);
        $this->js('alert("Successfully updated qrcode.")');
        $this->js('loadingStop()');
    }

    public function status($id, $status = false)
    {
        if (env('ACTIVE_STRIPE')) {
            if (
                auth()
                    ->user()
                    ->isNotOnSubscription() &&
                !$status
            ) {
                $this->dispatch('openModal', component: 'my-qrcode.subscription-alert', arguments: ['qrcodeId' => $id]);
                return;
            }
            if (
                auth()
                    ->user()
                    ->plan()->qrcode_limit <=
                    auth()
                        ->user()
                        ->qrCodes()
                        ->isDynamic()
                        ->isActive()
                        ->count() &&
                !$status
            ) {
                $this->js('alert("You have reached your limit for active dynamic QR Codes.", "error")');
                $this->js('loadingStop()');

                return;
            }
        }

        $qrcode = auth()
            ->user()
            ->qrCodes()
            ->findOrFail($id);
        $qrcode->update(['status' => !$qrcode->status]);
        $this->js('alert("Successfully updated qrcode.")');
        $this->js('loadingStop()');
    }
}
