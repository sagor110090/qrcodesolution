<div>

    <div class="grid grid-cols-12 gap-4 mt-6 z-10" x-data="{
            type: @entangle('type'),
            imageType: 'png',
            qr_style: @entangle('qr_style'),
            qr_logo: @entangle('qr_logo'),
            qr_logo_background: @entangle('qr_logo_background'),
            qr_color: @entangle('qr_color'),
            qr_bg_color: @entangle('qr_bg_color'),
            qr_eye_border: @entangle('qr_eye_border'),
            qr_eye_center: @entangle('qr_eye_center'),
            qr_gradient: @entangle('qr_gradient'),
            qr_eye_color_in: @entangle('qr_eye_color_in'),
            qr_eye_color_out: @entangle('qr_eye_color_out'),
            qr_eye_style_in: @entangle('qr_eye_style_in'),
            qr_eye_style_out: @entangle('qr_eye_style_out'),
            qr_bg_image: @entangle('qr_bg_image'),
            qr_custom_logo: @entangle('qr_custom_logo'),
            qr_custom_background: @entangle('qr_custom_background'),
            frame: @entangle('frame'),
            frame_label: @entangle('frame_label'),
            frame_label_font: @entangle('frame_label_font'),
            frame_label_text_color: @entangle('frame_label_text_color'),

            qrcodePreview: @entangle('qrcodePreview'),
            onlyDynamic: @entangle('onlyDynamic'),

            download() {
                if (this.imageType === 'svg') {
                    let svg = document.querySelector('#qrcodePreview svg');
                    let data = new XMLSerializer().serializeToString(svg);
                    let downloadLink = document.createElement('a');
                    downloadLink.download = 'qrcode.' + this.imageType;
                    downloadLink.href = 'data:image/svg+xml;base64,' + btoa(data);
                    downloadLink.click();
                } else if (this.imageType === 'png') {
                    let svg = document.querySelector('#qrcodePreview svg');
                    let canvas = document.createElement('canvas');
                    let ctx = canvas.getContext('2d');
                    let data = new XMLSerializer().serializeToString(svg);
                    let img = new Image();

                    img.onload = function () {
                        ctx.drawImage(img, 0, 0);
                        let downloadLink = document.createElement('a');
                        downloadLink.download = 'qrcode.png';
                        downloadLink.href = canvas.toDataURL('image/png;base64');
                        downloadLink.click();
                    };
                    let height = parseInt(svg.getAttribute('height'));
                    let width = parseInt(svg.getAttribute('width'));
                    img.setAttribute('src', 'data:image/svg+xml;base64,' + btoa(data));
                    canvas.setAttribute('height', height);
                    canvas.setAttribute('width', width);

                } else if (this.imageType === 'jpeg') {
                    let svg = document.querySelector('#qrcodePreview svg');
                    let canvas = document.createElement('canvas');
                    let ctx = canvas.getContext('2d');
                    let data = new XMLSerializer().serializeToString(svg);
                    let img = new Image();

                    img.onload = function () {
                        ctx.drawImage(img, 0, 0);
                        let downloadLink = document.createElement('a');
                        downloadLink.download = 'qrcode.jpeg';
                        downloadLink.href = canvas.toDataURL('image/jpeg;base64');
                        downloadLink.click();
                    };
                    let height = parseInt(svg.getAttribute('height'));
                    let width = parseInt(svg.getAttribute('width'));
                    img.setAttribute('src', 'data:image/svg+xml;base64,' + btoa(data));
                    canvas.setAttribute('height', height);
                    canvas.setAttribute('width', width);
                }


            }
        }">



        <div class="col-span-12 md:col-span-9">
            <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-center">

                <div class=" n p-4 border-b dark:border-neutral-600">
                    <x-tw.input label="QR Code Name" placeholder="QR Code Name" id="name"  required class="col-span-2" name="name" value="{{ $name }}"/>

                </div>
                <x-qrcode.url  :url="$url" />
                <x-qrcode.email :email="$email" :subject="$subject" :body="$message" />
                <x-qrcode.vcard
                    :vcard_first_name="$vcard_first_name"
                    :vcard_last_name="$vcard_last_name"
                    :vcard_phone_number="$vcard_phone_number"
                    :vcard_mobile="$vcard_mobile"
                    :vcard_email="$vcard_email"
                    :vcard_website="$vcard_website"
                    :vcard_company="$vcard_company"
                    :vcard_job_title="$vcard_job_title"
                    :vcard_address="$vcard_address"
                    :vcard_fax="$vcard_fax"
                    :vcard_city="$vcard_city"
                    :vcard_post_code="$vcard_post_code"
                    :vcard_country="$vcard_country"
                />
                <x-qrcode.sms
                    :sms_phone="$sms_phone"
                    :sms="$sms"
                />
                <x-qrcode.phone :phone="$call_phone" />
                <x-qrcode.event />
                <x-qrcode.location
                    :latitude="$latitude"
                    :longitude="$longitude"
                    />
                <x-qrcode.text
                    :text_data="$text_data"
                    />
                <x-qrcode.wifi
                    :network_name="$network_name"
                    :network_password="$network_password"
                    :network_type="$network_type"
                    :wifi_hidden="$wifi_hidden"
                    />
                <x-qrcode.bitcoin
                    :bitcoin_address="$bitcoin_address"
                    :bitcoin_amount="$bitcoin_amount"
                    />
                <x-qrcode.pdf />
                <x-qrcode.image />
                <x-qrcode.audio />
                <x-qrcode.video />

                <div class="p-6">
                    <div class="mb-2 text-base text-neutral-500 dark:text-neutral-300">

                        <x-tw.label class="font-bold text-md mb-5 mt-10">
                            Design Your QR Code
                        </x-tw.label>
                        <x-tw.accordion>
                            <x-tw.accordion-item id="pattern" label="Pattern" show="false">
                                <x-qrcode.patterns />
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="qr_eye_border" label="Eye Borders" show="false">
                                <x-qrcode.eye-borders />
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="qr_eye_center" label="Eye Center" show="false">
                                <x-qrcode.eye-centers/>
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="logo" label="Logo" show="false">
                                <x-qrcode.logos/>
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="qr_color" label="Color" show="false">
                                <x-qrcode.colors/>
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="bgColor" label="Background Color" show="false">
                                <x-qrcode.bg-colors/>
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="qrEyeColor" label="Eye Color" show="false">
                                <x-qrcode.eye-colors/>
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="qr_gradientColor" label="Gradient Color" show="false">
                                <x-qrcode.gradient-colors/>
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="qr_bg_image" label="Background Image" show="false">
                                <x-qrcode.bg-images/>
                            </x-tw.accordion-item>
                            <x-tw.accordion-item id="frame" label="Frame" show="false">
                                <x-qrcode.frames/>
                            </x-tw.accordion-item>
                        </x-tw.accordion>
                    </div>
                </div>

            </div>
        </div>

        <div class="col-span-12 md:col-span-3" wire:ignore>
            <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-center" data-te-sticky-init
                data-te-sticky-boundary="#sticky-top" data-te-sticky-direction="both">

                <div class="border-neutral-100 px-6 py-4 dark:border-neutral-500">
                    <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
                        <x-tw.label class="mr-2 font-bold text-md">
                            Preview your QR Code
                        </x-tw.label>
                    </h5>
                </div>


                <div class="p-0 grid  justify-center">
                    <div class=" max-w-[18rem] rounded-lgdark:bg-neutral-700 grid justify-items-center">
                        <div class="relative overflow-hidden bg-cover bg-no-repeat">

                            <div class="border-2 shadow-sm rounded-lg">
                                <div x-html="qrcodePreview" id="qrcodePreview">
                                </div>
                                <img src="{{ asset('images/placeholder.svg') }}" x-show='!qrcodePreview'
                                    alt="placeholder" class="w-48 h-48 rounded-lg">
                            </div>
                        </div>
                        <div class="p-0">
                            <p class="text-base text-neutral-600 dark:text-neutral-200">
                                Scan me to get the link
                            </p>
                        </div>
                        <div class="grid grid-cols-3 gap-4 p-2">
                            <x-tw.button-select @click="imageType = 'png'" value="png" type="imageType">
                                PNG
                            </x-tw.button-select>
                            <x-tw.button-select @click="imageType = 'jpeg'" value="jpeg" type="imageType">
                                JPEG
                            </x-tw.button-select>
                            <x-tw.button-select @click="imageType = 'svg'" value="svg" type="imageType">
                                SVG
                            </x-tw.button-select>

                        </div>
                    </div>
                    <div class="mt-4 p-2 grid grid-cols-2 gap-4">
                        <a href="javascript:void(0)" @click="download()"
                            class="flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
                            <i class="bi bi-download text-xl"></i>
                            <span class="ml-2 font-bold text-md">
                                Download
                            </span>
                        </a>
                        @guest
                        <a href="javascript:void(0)" data-te-toggle="modal" data-te-target="#loginModal"
                            data-te-ripple-init data-te-ripple-color="light"
                            class="flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
                            <i class="bi bi-save text-xl"></i>
                            <span class="ml-2 font-bold text-md">
                                Save
                            </span>
                        </a>
                        @else
                        <a href="javascript:void(0)" wire:click="save()"
                            class="flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
                            <i class="bi bi-save text-xl"></i>
                            <span class="ml-2 font-bold text-md">
                                Save
                            </span>
                        </a>
                        @endguest


                    </div>

                </div>

            </div>
        </div>

    </div>



</div>


@push('css')
<style>
    .qrcode-sticky {
        position: sticky;
        top: 0;
        z-index: 10;
    }

    svg.qrcodesvg {
        height: 187px;
        width: 188px;
    }
</style>
@endpush


@push('js')

@endpush
