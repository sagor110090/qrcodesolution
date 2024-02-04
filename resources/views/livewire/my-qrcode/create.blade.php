<div class="z-10 grid grid-cols-12 gap-4 mt-6" x-data="{
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
    dynamic: false,

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

            img.onload = function() {
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

            img.onload = function() {
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


    },
    checkTypeDynamic(value) {
        let type = value;
        let listDynamic = @js(Support::onlyDynamicList());
        let check = listDynamic.includes(type);
        if (check) {
            this.dynamic = true;
        } else {
            this.dynamic = false;
        }

    }
}" x-init="$watch('type', value => checkTypeDynamic(value)), checkTypeDynamic(type)"  >

    <div class="col-span-12 md:col-span-3">
        <div
            class="bg-white shadow dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">

            <div class="px-6 py-4 border-neutral-100 dark:border-neutral-500">
                <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
                    <x-tw.label class="mr-2 font-bold text-center text-md">
                        Destinations
                    </x-tw.label>
                </h5>
            </div>

            <div class="pb-6 pl-6 pr-6" x-data>
                <div class="grid grid-cols-2 gap-4 text-center text-neutral-500 dark:text-neutral-300">
                    <x-qrcode.type name="URL" @click="type = 'url'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Email" @click="type = 'email'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="VCard" @click="type = 'vcard'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="SMS" @click="type = 'sms'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Phone" @click="type = 'phone'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Event" @click="type = 'event'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Social" @click="type = 'social'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Location" @click="type = 'location'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Text" @click="type = 'text'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Wifi" @click="type = 'wifi'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="BitCoin" @click="type = 'bitcoin'">
                        <x-slot name="icon">
                            <svg class="w-6 h-6 text-gray dark:text-white" fill="currentColor"
                                viewBox="0 0 37.866 37.866">
                                <g>
                                    <path
                                        d="M24.617,19.115c-0.377-0.219-0.922-0.418-1.635-0.601c0.664-0.226,1.198-0.51,1.604-0.855
                                        c0.404-0.346,0.715-0.743,0.931-1.193c0.215-0.451,0.321-0.927,0.321-1.429c0-0.69-0.202-1.325-0.609-1.903
                                        c-0.406-0.578-0.987-1.021-1.743-1.33c-0.292-0.12-0.641-0.209-1.02-0.283V8.838H19.89v2.501h-1.656V8.838h-2.576v2.501h-3.929
                                        v2.104h0.6c0.399,0,0.67,0.036,0.812,0.109s0.242,0.171,0.3,0.294c0.058,0.124,0.087,0.411,0.087,0.861v8.481
                                        c0,0.443-0.029,0.729-0.087,0.856c-0.059,0.127-0.158,0.226-0.3,0.294c-0.142,0.069-0.413,0.104-0.812,0.104h-0.6v2.104h3.929
                                        v2.502h2.576v-2.502h1.466c0.065,0,0.126-0.002,0.189-0.002v2.504h2.575v-2.719c0.434-0.084,0.813-0.188,1.138-0.318
                                        c0.89-0.354,1.577-0.874,2.062-1.553c0.485-0.68,0.729-1.424,0.729-2.23c0-0.676-0.16-1.288-0.479-1.837
                                        C25.594,19.847,25.162,19.419,24.617,19.115z M17.29,13.794h1.667c0.975,0,1.65,0.06,2.028,0.18
                                        c0.379,0.12,0.667,0.322,0.867,0.605c0.2,0.284,0.3,0.625,0.3,1.024c0,0.386-0.104,0.726-0.315,1.021s-0.524,0.515-0.942,0.659
                                        c-0.417,0.146-1.062,0.219-1.936,0.219h-1.667L17.29,13.794L17.29,13.794z M21.999,23.191c-0.297,0.379-0.657,0.629-1.082,0.747
                                        c-0.425,0.12-0.959,0.181-1.604,0.181h-1.11c-0.37,0-0.597-0.021-0.681-0.062c-0.083-0.04-0.143-0.108-0.179-0.212
                                        c-0.029-0.08-0.047-0.353-0.054-0.816v-3.295h1.969c0.862,0,1.505,0.081,1.926,0.24c0.42,0.16,0.735,0.396,0.945,0.709
                                        c0.212,0.313,0.316,0.694,0.316,1.146C22.447,22.359,22.297,22.813,21.999,23.191z M36.35,12.197
                                        c0.375-0.342,0.707-0.733,0.957-1.191c0.585-1.075,0.716-2.314,0.37-3.488C37.106,5.582,35.3,4.23,33.283,4.23
                                        c-0.438,0-0.876,0.063-1.3,0.188c-0.296,0.087-0.577,0.203-0.845,0.343C24.677-0.774,15.3-1.243,8.328,3.624
                                        c-6.955,4.854-9.75,13.788-6.817,21.749c-1.256,1.146-1.837,2.938-1.325,4.676c0.571,1.936,2.378,3.287,4.394,3.287
                                        c0.438,0,0.875-0.062,1.298-0.188c0.276-0.082,0.538-0.19,0.789-0.317c0.055,0.097,0.119,0.188,0.208,0.267
                                        c3.482,2.987,7.812,4.501,12.157,4.501c3.719,0,7.448-1.108,10.666-3.354c6.975-4.867,9.769-13.841,6.793-21.816
                                        C36.457,12.337,36.401,12.268,36.35,12.197z M32.55,6.337c0.239-0.071,0.485-0.106,0.732-0.106c1.135,0,2.152,0.763,2.476,1.854
                                        c0.194,0.662,0.121,1.359-0.208,1.966c-0.33,0.606-0.876,1.047-1.538,1.243c-1.343,0.395-2.816-0.418-3.209-1.746
                                        c-0.195-0.663-0.121-1.361,0.209-1.967C31.342,6.973,31.888,6.532,32.55,6.337z M5.312,31.228
                                        c-1.341,0.398-2.816-0.418-3.208-1.747c-0.403-1.365,0.381-2.806,1.747-3.209c0.239-0.068,0.486-0.105,0.732-0.105
                                        c1.136,0,2.154,0.763,2.476,1.854c0.195,0.662,0.121,1.36-0.208,1.966C6.521,30.591,5.975,31.033,5.312,31.228z M28.554,32.601
                                        c-6.229,4.347-14.605,3.926-20.375-1.022c0,0-0.001,0-0.001-0.002c0.157-0.199,0.306-0.406,0.43-0.635
                                        c0.585-1.074,0.717-2.312,0.37-3.486c-0.571-1.937-2.378-3.287-4.394-3.287c-0.438,0-0.875,0.062-1.299,0.188
                                        c-0.001,0-0.002,0.001-0.003,0.001C0.854,17.332,3.357,9.533,9.473,5.264c6.143-4.289,14.376-3.927,20.137,0.837
                                        c-0.125,0.169-0.252,0.335-0.354,0.522c-0.585,1.075-0.717,2.313-0.369,3.487c0.569,1.937,2.377,3.287,4.395,3.287
                                        c0.438,0,0.875-0.062,1.299-0.188c0.021-0.006,0.039-0.019,0.061-0.024C37.257,20.292,34.762,28.267,28.554,32.601z" />
                                </g>
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="PDF" @click="type = 'pdf'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Image" @click="type = 'image'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Audio" @click="type = 'audio'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    <x-qrcode.type name="Video" @click="type = 'video'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type>
                    {{-- <x-qrcode.type name="File" @click="type = 'file'">
                        <x-slot name="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="w-6 h-6" viewBox="0 0 16 16">
                                <path
                                    d="M14 4.5V9h-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v7H2V2a2 2 0 0 1 2-2h5.5zM13 12h1v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2h1v2a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1z" />
                            </svg>
                        </x-slot>
                    </x-qrcode.type> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-6">
        <div
            class="bg-white shadow dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">

            <x-qrcode.url />
            <x-qrcode.email />
            <x-qrcode.vcard />
            <x-qrcode.sms />
            <x-qrcode.phone />
            <x-qrcode.event />
            <x-qrcode.social-media />
            <x-qrcode.location />
            <x-qrcode.text />
            <x-qrcode.wifi />
            <x-qrcode.bitcoin />
            <x-qrcode.pdf />
            <x-qrcode.image />
            <x-qrcode.audio />
            <x-qrcode.video />
            {{-- <x-qrcode.video /> --}}


            <div class="p-6">
                <div class="mb-2 text-base text-neutral-500 dark:text-neutral-300" x-data>
                    <div class="flex justify-center">
                        <x-tw.radio label="Static" name="dynamic" id="static" :value="false" x-model="dynamic" />
                        <x-tw.radio label="Dynamic" name="dynamic" id="dynamic" :value="true" x-model="dynamic" />
                    </div>
                    <x-tw.label class="mt-10 mb-5 font-bold text-md">
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
                            <x-qrcode.eye-centers />
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="logo" label="Logo" show="false">
                            <x-qrcode.logos />
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_color" label="Color" show="false">
                            <x-qrcode.colors />
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="bgColor" label="Background Color" show="false">
                            <x-qrcode.bg-colors />
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qrEyeColor" label="Eye Color" show="false">
                            <x-qrcode.eye-colors />
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_gradientColor" label="Gradient Color" show="false">
                            <x-qrcode.gradient-colors />
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_bg_image" label="Background Image" show="false">
                            <x-qrcode.bg-images />
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="frame" label="Frame" show="false">
                            <x-qrcode.frames />
                        </x-tw.accordion-item>
                    </x-tw.accordion>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-3 qrcode-sticky">
        <div
            class="bg-white shadow dark:bg-gray-800 sm:rounded-lg dark:bg-gray-900/50 dark:border dark:border-gray-200/10">

            <div class="px-6 py-4 border-neutral-100 dark:border-neutral-500">
                <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
                    <x-tw.label class="mr-2 font-bold text-center text-md">
                        Preview your QR Code
                    </x-tw.label>
                </h5>
            </div>

            <x-qrcode.preview />

        </div>
    </div>

</div>


@push('css')
<style>
    .qrcode-sticky {
        position: sticky;
        top: 0;
        z-index: 10;
        height: 450px;
    }

    svg.qrcodesvg {
        height: 187px;
        width: 188px;
    }
</style>
@endpush
