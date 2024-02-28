<?php

namespace App\Livewire\MyQrcode;

use Livewire\Component;
use App\Helpers\Support;
use Illuminate\Support\Str;

class EventEdit extends Component
{

    public $steps = [
        'step1' => [
            'name' => 'Basic info',
            'details' => 'Event name, description, and URL.',
            'icon' => '',
        ],
        'step2' => [
            'name' => 'Location',
            'details' => 'Event location and online event setup.',
            'icon' => '',
        ],
        'step3' => [
            'name' => 'Design',
            'details' => 'Event cover image, font and color.',
            'icon' => '',
        ],
    ];
    public $currentStep = 'step1';
    public $logo_image = '';
    public $banner_image = '';
    public $QrcodeId = '';
    public $event = [
        'name' => '',
        'description' => '',
        'location' => '',

        'one_day_event' => false,
        'start_date_time' => '',
        'end_date_time' => '',
        'date_time' => '',

        'duration' => '',
        'logo_image' => '',
        'banner_image' => '',
        'color' => '',
        'font' => '',
    ];
    public $event_url = '';
    public $cover_image = '';

    public function mount($subdomain)
    {
        $qrCode = auth()
            ->user()
            ->qrCodes()
            ->where('subdomain', $subdomain)
            ->firstOrFail();
        $this->event = $qrCode->qr_code_info;
        $this->event_url = $qrCode->subdomain;
        $this->cover_image = null;
        $this->QrcodeId = $qrCode->id;
    }

    public function render()
    {
        return view('livewire.my-qrcode.event-edit');
    }

    public function setCurrentStep($step)
    {
        // remove all errors
        $this->resetErrorBag();
        if ($step == 'step2') {
            $this->validate(
                [
                    'event.name' => 'required|min:3|max:255',
                    'event_url' => 'required|min:3|max:255|alpha|unique:qr_codes,subdomain,' . $this->QrcodeId,
                    'event.description' => 'required|min:20|max:500',
                ],
                [
                    'event.name.required' => 'Event name is required',
                    'event_url.required' => 'Event URL is required',
                    'event.description.required' => 'Event description is required',
                    'event.name.min' => 'Event name must be at least 3 characters',
                    'event_url.min' => 'Event URL must be at least 3 characters',
                    'event.description.min' => 'Event description must be at least 20 characters',
                    'event.name.max' => 'Event name must be at most 255 characters',
                    'event_url.max' => 'Event URL must be at most 255 characters',
                    'event.description.max' => 'Event description must be at most 500 characters',
                    'event_url.url' => 'Event URL must be a valid URL',
                    'event_url.unique' => 'Event URL must be unique',
                    'event_url.alpha' => 'Event URL must be alphabets only',
                ],
            );
        } elseif ($step == 'step3') {
            $this->validate(
                [
                    'event.location' => 'required|min:3|max:255',
                    'event.start_date_time' => 'required_if:event.one_day_event,false',
                    'event.end_date_time' => 'required_if:event.one_day_event,false',
                    'event.date_time' => 'required_if:event.one_day_event,true',
                    // 'event.duration' => 'required_if:event.one_day_event,true|min:3|max:255',
                ],
                [
                    'event.location.required' => 'Event location is required',
                    'event.location.min' => 'Event location must be at least 3 characters',
                    'event.location.max' => 'Event location must be at most 255 characters',
                    'event.start_date_time.required_if' => 'Event start date and time is required',
                    'event.end_date_time.required_if' => 'Event end date and time is required',
                    'event.date_time.required_if' => 'Event date and time is required',
                    'event.duration.required' => 'Event duration is required',
                ],
            );
        } elseif ($step == 'submit') {
            $this->validate(
                [
                    'event.color' => 'nullable',
                    'event.font' => 'nullable',
                    'logo_image' => 'nullable',
                    'banner_image' => 'nullable',
                ],
                [
                    'event.color.required' => 'Event color is required',
                    'event.font.required' => 'Event font is required',
                    'cover_image.required' => 'Event cover image is required',
                ],
            );

            if ($this->logo_image) {
                $this->event['logo_image'] = 'storage/' . Support::uploadImage($this->logo_image, 'event', Str::slug($this->event['name']));
            }
            if ($this->banner_image) {
                $this->event['banner_image'] = 'storage/' . Support::uploadImage($this->banner_image, 'event', Str::slug($this->event['name']));
            }

            $data = [
                'qr_code_info' => $this->event,
                'subdomain' => $this->event_url,
                'type' => 'event',
                'name' => $this->event['name'],
                'is_dynamic' => true,
            ];

            $data = array_merge($data, Support::basicDataForQrCode());

            auth()
                ->user()
                ->qrCodes()
                ->find($this->QrcodeId)
                ->update($data);

            toastr()->success('QR Code Created Successfully');
            return $this->redirect(route('my-qrcode.dynamic'));
        }

        $this->currentStep = $step;
    }
}
