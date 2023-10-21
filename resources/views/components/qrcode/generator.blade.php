@props([
'type' => 'url',
'onlyDynamic' => false,

])

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
    frame_labelTextColor: @entangle('frame_labelTextColor'),

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

    <div class="col-span-12 md:col-span-3">
        <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-center">

            <div class="border-neutral-100 px-6 py-4  dark:border-neutral-500">
                <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
                    <x-tw.label class="mr-2 font-bold text-md">
                        Destinations
                    </x-tw.label>
                </h5>
            </div>

            <div class="pl-6 pr-6  pb-6" x-data>
                <div class="grid grid-cols-2 gap-4  text-center text-neutral-500 dark:text-neutral-300">
                    <x-qrcode.type icon="bi bi-link-45deg" name="URL" @click="type = 'url'" />
                    <x-qrcode.type icon="bi bi-envelope" name="Email" @click="type = 'email'" />
                    <x-qrcode.type icon="bi bi-person" name="VCard" @click="type = 'vcard'" />
                    <x-qrcode.type icon="bi bi-menu-up" name="SMS" @click="type = 'sms'" />
                    <x-qrcode.type icon="bi bi-telephone" name="Phone" @click="type = 'phone'" />
                    <x-qrcode.type icon="bi bi-calendar" name="Event" @click="type = 'event'" />
                    <x-qrcode.type icon="bi bi-geo-alt" name="Location" @click="type = 'location'" />
                    <x-qrcode.type icon="bi bi-file-earmark-text" name="Text" @click="type = 'text'" />
                    <x-qrcode.type icon="bi bi-wifi" name="Wifi" @click="type = 'wifi'" />
                    <x-qrcode.type icon="bi bi-file-earmark-binary" name="BitCoin" @click="type = 'bitcoin'" />
                    <x-qrcode.type icon="bi bi-file-earmark-pdf" name="PDF" @click="type = 'pdf'" />
                    <x-qrcode.type icon="bi bi-file-earmark-image" name="Image" @click="type = 'image'" />
                    <x-qrcode.type icon="bi bi-file-earmark-music" name="Audio" @click="type = 'audio'" />
                    <x-qrcode.type icon="bi bi-file-earmark-play" name="Video" @click="type = 'video'" />
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-6">
        <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-center">

            <x-qrcode.url />
            <x-qrcode.email />
            <x-qrcode.vcard />
            <x-qrcode.sms />
            <x-qrcode.phone />
            <x-qrcode.event />
            <x-qrcode.location />
            <x-qrcode.text />
            <x-qrcode.wifi />
            <x-qrcode.bitcoin />
            <x-qrcode.pdf />
            <x-qrcode.image />
            <x-qrcode.audio />
            <x-qrcode.video />


            <div class="p-6">
                <div class="mb-2 text-base text-neutral-500 dark:text-neutral-300">
                    <div class="flex justify-center">
                        <x-tw.radio label="Static" name="static" id="static" checked />
                        <x-tw.radio label="Dynamic" name="dynamic" id="dynamic" />
                    </div>
                    <x-tw.label class="font-bold text-md mb-5 mt-10">
                        Design Your QR Code
                    </x-tw.label>
                    <x-tw.accordion>
                        <x-tw.accordion-item id="pattern" label="Pattern" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div class="grid grid-cols-5 gap-4">

                                    <x-tw.button-select @click="qr_style = 'default'" value="default" type="qr_style">
                                        <div>
                                            <label
                                                class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label active_label"
                                                for="pattern_default"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5,1h1l0-1L4,0v1H3V0L0,0v0v0v2h1V1h0h1h1v1v0v0l0,0H2v1H1H0h0v3h0v0h2v0H1l0-2h1l0,1h1v1h3v0H5v0V5h1V4H5v1H3 l0-2l1,0v1h1V3h1V2H5V1z M5,3H4V2h1V3z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'circle'" value="circle" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_circle"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="0.5" cy="0.5" r="0.5"></circle>
                                                    <circle cx="1.5" cy="0.5" r="0.5"></circle>
                                                    <circle cx="3.5" cy="0.5" r="0.5"></circle>
                                                    <circle cx="4.5" cy="0.5" r="0.5"></circle>
                                                    <circle cx="0.5" cy="1.5" r="0.5"></circle>
                                                    <circle cx="4.5" cy="1.5" r="0.5"></circle>
                                                    <circle cx="5.5" cy="1.5" r="0.5"></circle>
                                                    <circle cx="0.5" cy="2.5" r="0.5"></circle>
                                                    <circle cx="1.5" cy="2.5" r="0.5"></circle>
                                                    <circle cx="0.5" cy="3.5" r="0.5"></circle>
                                                    <circle cx="1.5" cy="3.5" r="0.5"></circle>
                                                    <circle cx="4.5" cy="3.5" r="0.5"></circle>
                                                    <circle cx="5.5" cy="3.5" r="0.5"></circle>
                                                    <circle cx="2.5" cy="4.5" r="0.5"></circle>
                                                    <circle cx="1.5" cy="5.5" r="0.5"></circle>
                                                    <circle cx="3.5" cy="5.5" r="0.5"></circle>
                                                    <circle cx="5.5" cy="5.5" r="0.5"></circle>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'dot'" value="dot" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_dot"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="0.5" cy="0.5" r="0.3"></circle>
                                                    <circle cx="1.5" cy="0.5" r="0.3"></circle>
                                                    <circle cx="3.5" cy="0.5" r="0.3"></circle>
                                                    <circle cx="4.5" cy="0.5" r="0.3"></circle>
                                                    <circle cx="0.5" cy="1.5" r="0.3"></circle>
                                                    <circle cx="4.5" cy="1.5" r="0.3"></circle>
                                                    <circle cx="5.5" cy="1.5" r="0.3"></circle>
                                                    <circle cx="0.5" cy="2.5" r="0.3"></circle>
                                                    <circle cx="1.5" cy="2.5" r="0.3"></circle>
                                                    <circle cx="0.5" cy="3.5" r="0.3"></circle>
                                                    <circle cx="1.5" cy="3.5" r="0.3"></circle>
                                                    <circle cx="4.5" cy="3.5" r="0.3"></circle>
                                                    <circle cx="5.5" cy="3.5" r="0.3"></circle>
                                                    <circle cx="2.5" cy="4.5" r="0.3"></circle>
                                                    <circle cx="1.5" cy="5.5" r="0.3"></circle>
                                                    <circle cx="3.5" cy="5.5" r="0.3"></circle>
                                                    <circle cx="5.5" cy="5.5" r="0.3"></circle>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'star'" value="star" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_star"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon
                                                        points="0.5,0.8 0.2,1 0.2,0.6 0,0.4 0.3,0.3 0.5,0 0.7,0.3 1,0.4 0.7,0.6 0.8,1">
                                                    </polygon>
                                                    <polygon
                                                        points="2.5,0.8 2.2,1 2.2,0.6 2,0.4 2.3,0.3 2.5,0 2.7,0.3 3,0.4 2.7,0.6 2.8,1">
                                                    </polygon>
                                                    <polygon
                                                        points="4.5,0.8 4.2,1 4.3,0.6 4,0.4 4.3,0.3 4.5,0 4.7,0.3 5,0.4 4.8,0.6 4.8,1">
                                                    </polygon>
                                                    <polygon
                                                        points="5.5,0.8 5.2,1 5.3,0.6 5,0.4 5.3,0.3 5.5,0 5.7,0.3 6,0.4 5.8,0.6 5.8,1">
                                                    </polygon>
                                                    <polygon
                                                        points="3.5,1.8 3.2,2 3.2,1.6 3,1.4 3.3,1.3 3.5,1 3.7,1.3 4,1.4 3.7,1.6 3.8,2">
                                                    </polygon>
                                                    <polygon
                                                        points="4.5,1.8 4.2,2 4.2,1.6 4,1.4 4.3,1.3 4.5,1 4.7,1.3 5,1.4 4.7,1.6 4.8,2">
                                                    </polygon>
                                                    <polygon
                                                        points="2.5,2.8 2.2,3 2.2,2.6 2,2.4 2.3,2.3 2.5,2 2.7,2.3 3,2.4 2.7,2.6 2.8,3">
                                                    </polygon>
                                                    <polygon
                                                        points="3.5,2.8 3.2,3 3.2,2.6 3,2.4 3.3,2.3 3.5,2 3.7,2.3 4,2.4 3.7,2.6 3.8,3">
                                                    </polygon>
                                                    <polygon
                                                        points="0.5,3.8 0.2,4 0.2,3.6 0,3.4 0.3,3.3 0.5,3 0.7,3.3 1,3.4 0.7,3.6 0.8,4">
                                                    </polygon>
                                                    <polygon
                                                        points="1.5,3.8 1.2,4 1.2,3.6 1,3.4 1.3,3.3 1.5,3 1.7,3.3 2,3.4 1.7,3.6 1.8,4">
                                                    </polygon>
                                                    <polygon
                                                        points="2.5,5.8 2.2,6 2.2,5.6 2,5.4 2.3,5.3 2.5,5 2.7,5.3 3,5.4 2.8,5.6 2.8,6">
                                                    </polygon>
                                                    <polygon
                                                        points="3.5,5.8 3.2,6 3.2,5.6 3,5.4 3.3,5.3 3.5,5 3.7,5.3 4,5.4 3.8,5.6 3.8,6">
                                                    </polygon>
                                                    <polygon
                                                        points="0.5,1.8 0.2,2 0.2,1.6 0,1.4 0.3,1.3 0.5,1 0.7,1.3 1,1.4 0.7,1.6 0.8,2">
                                                    </polygon>
                                                    <polygon
                                                        points="4.5,3.8 4.2,4 4.3,3.6 4,3.4 4.3,3.3 4.5,3 4.7,3.3 5,3.4 4.8,3.6 4.8,4">
                                                    </polygon>
                                                    <polygon
                                                        points="5.5,4.8 5.2,5 5.3,4.6 5,4.4 5.3,4.3 5.5,4 5.7,4.3 6,4.4 5.8,4.6 5.8,5">
                                                    </polygon>
                                                    <polygon
                                                        points="0.5,5.8 0.2,6 0.2,5.6 0,5.4 0.3,5.3 0.5,5 0.7,5.3 1,5.4 0.7,5.6 0.8,6">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'diamond'" value="diamond" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_diamond"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.1" y="0.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -0.2075 0.4992)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="0.1" y="1.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -0.9146 0.7923)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="2.1" y="0.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 0.3783 1.9134)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="4.1" y="0.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 0.9641 3.3276)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="5.1" y="0.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 1.257 4.0347)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="4.1" y="1.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 0.257 3.6205)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="3.1" y="1.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.593460e-02 2.9134)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="3.1" y="2.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -0.743 3.2063)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="2.1" y="2.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.0359 2.4992)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="1.1" y="3.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.0359 2.0849)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="0.1" y="3.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.3287 1.3777)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="0.1" y="5.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.7428 1.9634)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="2.1" y="5.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -3.1573 3.3778)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="3.1" y="5.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.8644 4.0849)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="5.1" y="4.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.5715 5.2063)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <rect x="4.1" y="3.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.1573 4.2063)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'sparkle'" value="sparkle" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_sparkle"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.4,0.9L0.4,0.9L0.4,0.9h0.1c0-0.2,0.2-0.3,0.4-0.4l0.1,0l0.1,0c0.2,0,0.3,0.2,0.4,0.4v0.1c0,0.2-0.2,0.3-0.4,0.4L1,1.5 v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4v0.1c0,0.2-0.2,0.3-0.4,0.4L1,2.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1l0-0.1 c0-0.2,0.2-0.3,0.4-0.4l0.1,0V2.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4V1.9c0-0.2,0.2-0.3,0.4-0.4l0.1,0V1.5l-0.1,0 c-0.2,0-0.3-0.2-0.4-0.4V0.9c0-0.2,0.2-0.3,0.4-0.4l0.1,0V0.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H1.5l0,0.1 c0,0.2-0.2,0.3-0.4,0.4L1,0.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H0.5l0,0.1c0,0.2-0.2,0.3-0.4,0.4L0,0.5v0.1l0.1,0 C0.3,0.6,0.4,0.7,0.4,0.9z">
                                                    </path>
                                                    <path
                                                        d="M3.6,4.1L3.6,4.1L3.6,4.1H3.4c0,0.2-0.2,0.3-0.4,0.4H2.9c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H2.5l0,0.1c0,0.2-0.2,0.3-0.4,0.4 L2,4.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4v0.1c0,0.2-0.2,0.3-0.4,0.4H1.9c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H1.5l0,0.1 c0,0.2-0.2,0.3-0.4,0.4H0.9c-0.2,0-0.3-0.2-0.4-0.4V4.9c0-0.2,0.2-0.3,0.4-0.4l0.1,0V4.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4V3.9 c0-0.2,0.2-0.3,0.4-0.4l0.1,0V3.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H0.5l0,0.1c0,0.2-0.2,0.3-0.4,0.4L0,3.5v0.1l0.1,0 c0.2,0,0.3,0.2,0.4,0.4v0.1c0,0.2-0.2,0.3-0.4,0.4L0,4.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4v0.1c0,0.2-0.2,0.3-0.4,0.4L0,5.5v0.1 l0.1,0c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1l0-0.1c0-0.2,0.2-0.3,0.4-0.4h0.1c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1l0-0.1 c0-0.2,0.2-0.3,0.4-0.4h0.1c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1l0-0.1c0-0.2,0.2-0.3,0.4-0.4h0.1c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1 l0-0.1c0-0.2,0.2-0.3,0.4-0.4l0.1,0V5.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4V4.9c0-0.2,0.2-0.3,0.4-0.4l0.1,0V4.5l-0.1,0 C3.7,4.4,3.6,4.3,3.6,4.1z M3.4,5.1c0,0.2-0.2,0.3-0.4,0.4H2.9c-0.2,0-0.3-0.2-0.4-0.4V4.9c0-0.2,0.2-0.3,0.4-0.4h0.1 c0.2,0,0.3,0.2,0.4,0.4V5.1z">
                                                    </path>
                                                    <path
                                                        d="M5.6,4.1L5.6,4.1L5.6,4.1H5.4c0,0.2-0.2,0.3-0.4,0.4L5,4.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1l0-0.1 c0-0.2,0.2-0.3,0.4-0.4l0.1,0V4.5l-0.1,0C5.7,4.4,5.6,4.3,5.6,4.1z">
                                                    </path>
                                                    <path
                                                        d="M5.6,2.1L5.6,2.1L5.6,2.1H5.4c0,0.2-0.2,0.3-0.4,0.4H4.9c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H4.5l0,0.1c0,0.2-0.2,0.3-0.4,0.4 H3.9c-0.2,0-0.3-0.2-0.4-0.4V1.9c0-0.2,0.2-0.3,0.4-0.4l0.1,0V1.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4V0.9c0-0.2,0.2-0.3,0.4-0.4l0.1,0 V0.5l-0.1,0c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H3.5l0,0.1c0,0.2-0.2,0.3-0.4,0.4L3,0.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4v0.1 c0,0.2-0.2,0.3-0.4,0.4L3,1.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4v0.1c0,0.2-0.2,0.3-0.4,0.4L3,2.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4 l0,0.1h0.1l0-0.1c0-0.2,0.2-0.3,0.4-0.4h0.1c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1l0-0.1c0-0.2,0.2-0.3,0.4-0.4h0.1 c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1l0-0.1c0-0.2,0.2-0.3,0.4-0.4l0.1,0V2.5l-0.1,0C5.7,2.4,5.6,2.3,5.6,2.1z">
                                                    </path>
                                                    <path
                                                        d="M5.9,0.4c-0.2,0-0.3-0.2-0.4-0.4l0-0.1H5.5l0,0.1c0,0.2-0.2,0.3-0.4,0.4L5,0.5v0.1l0.1,0c0.2,0,0.3,0.2,0.4,0.4l0,0.1h0.1 l0-0.1c0-0.2,0.2-0.3,0.4-0.4V0.4L5.9,0.4L5.9,0.4z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'danger'" value="danger" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_danger"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon
                                                        points="2.9,0.5 3,0.4 3,0 2.6,0 2.5,0.1 2.4,0 2,0 2,0.4 2.1,0.5 2,0.6 2,1 2.4,1 2.5,0.9 2.6,1 3,1 3,0.6">
                                                    </polygon>
                                                    <path
                                                        d="M6,0H5.6L5.5,0.1L5.4,0H5H4.6L4.5,0.1L4.4,0H4v0.4l0.1,0.1L4,0.6V1H3.6L3.5,1.1L3.4,1H3v0.4l0.1,0.1L3,1.6V2 h0.4l0.1-0.1L3.6,2H4h0.4l0.1-0.1L4.6,2H5V1.6L4.9,1.5L5,1.4V1h0.4l0.1-0.1L5.6,1H6V0.6L5.9,0.5L6,0.4V0z M4,1.6L3.9,1.5L4,1.4 l0.1,0.1L4,1.6z M4.5,1.1L4.4,1l0.1-0.1L4.6,1L4.5,1.1z M5,0.6L4.9,0.5L5,0.4l0.1,0.1L5,0.6z">
                                                    </path>
                                                    <polygon
                                                        points="2.5,2.1 2.4,2 2,2 2,2.4 2.1,2.5 2,2.6 2,3 2.4,3 2.5,2.9 2.6,3 3,3 3,2.6 2.9,2.5 3,2.4 3,2 2.6,2">
                                                    </polygon>
                                                    <path
                                                        d="M0.5,1.9L0.6,2H1V1.6L0.9,1.5L1,1.4V1V0.6L0.9,0.5L1,0.4V0H0.6L0.5,0.1L0.4,0H0v0.4l0.1,0.1L0,0.6V1v0.4 l0.1,0.1L0,1.6V2h0.4L0.5,1.9z M0.5,0.9L0.6,1L0.5,1.1L0.4,1L0.5,0.9z">
                                                    </path>
                                                    <path
                                                        d="M1.5,3.1L1.4,3H1H0.6L0.5,3.1L0.4,3H0v0.4l0.1,0.1L0,3.6V4h0.4l0.1-0.1L0.6,4H1h0.4l0.1-0.1L1.6,4H2V3.6 L1.9,3.5L2,3.4V3H1.6L1.5,3.1z M1,3.6L0.9,3.5L1,3.4l0.1,0.1L1,3.6z">
                                                    </path>
                                                    <polygon
                                                        points="0.5,5.1 0.4,5 0,5 0,5.4 0.1,5.5 0,5.6 0,6 0.4,6 0.5,5.9 0.6,6 1,6 1,5.6 0.9,5.5 1,5.4 1,5 0.6,5">
                                                    </polygon>
                                                    <path
                                                        d="M3.5,5.1L3.4,5H3H2.6L2.5,5.1L2.4,5H2v0.4l0.1,0.1L2,5.6V6h0.4l0.1-0.1L2.6,6H3h0.4l0.1-0.1L3.6,6H4V5.6 L3.9,5.5L4,5.4V5H3.6L3.5,5.1z M3,5.6L2.9,5.5L3,5.4l0.1,0.1L3,5.6z">
                                                    </path>
                                                    <polygon
                                                        points="4.9,3.5 5,3.4 5,3 4.6,3 4.5,3.1 4.4,3 4,3 4,3.4 4.1,3.5 4,3.6 4,4 4.4,4 4.5,3.9 4.6,4 5,4 5,3.6">
                                                    </polygon>
                                                    <polygon
                                                        points="5.5,4.1 5.4,4 5,4 5,4.4 5.1,4.5 5,4.6 5,5 5.4,5 5.5,4.9 5.6,5 6,5 6,4.6 5.9,4.5 6,4.4 6,4 5.6,4">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'cross'" value="cross" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_cross"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon
                                                        points="0.3,2 0.7,2 0.7,1.7 1,1.7 1,1.3 0.7,1.3 0.7,1 0.7,0.7 1,0.7 1,0.3 0.7,0.3 0.7,0 0.3,0 0.3,0.3 0,0.3 0,0.7 0.3,0.7 0.3,1 0.3,1.3 0,1.3 0,1.7 0.3,1.7 ">
                                                    </polygon>
                                                    <polygon
                                                        points="2.3,1 2.7,1 2.7,0.7 3,0.7 3,0.3 2.7,0.3 2.7,0 2.3,0 2.3,0.3 2,0.3 2,0.7 2.3,0.7 ">
                                                    </polygon>
                                                    <polygon
                                                        points="5.7,0.3 5.7,0 5.3,0 5.3,0.3 5,0.3 4.7,0.3 4.7,0 4.3,0 4.3,0.3 4,0.3 4,0.7 4.3,0.7 4.3,1 4.3,1.3 4,1.3 3.7,1.3 3.7,1 3.3,1 3.3,1.3 3,1.3 3,1.7 3.3,1.7 3.3,2 3.7,2 3.7,1.7 4,1.7 4,1.7 4.3,1.7 4.3,2 4.7,2 4.7,1.7 5,1.7 5,1.3 4.7,1.3 4.7,1 4.7,0.7 5,0.7 5,0.7 5.3,0.7 5.3,1 5.7,1 5.7,0.7 6,0.7 6,0.3 ">
                                                    </polygon>
                                                    <polygon
                                                        points="2.3,3 2.7,3 2.7,2.7 3,2.7 3,2.3 2.7,2.3 2.7,2 2.3,2 2.3,2.3 2,2.3 2,2.7 2.3,2.7 ">
                                                    </polygon>
                                                    <polygon
                                                        points="1.7,3 1.3,3 1.3,3.3 1,3.3 0.7,3.3 0.7,3 0.3,3 0.3,3.3 0,3.3 0,3.7 0.3,3.7 0.3,4 0.7,4 0.7,3.7 1,3.7 1,3.7 1.3,3.7 1.3,4 1.7,4 1.7,3.7 2,3.7 2,3.3 1.7,3.3 ">
                                                    </polygon>
                                                    <polygon
                                                        points="4.7,3 4.3,3 4.3,3.3 4,3.3 4,3.7 4.3,3.7 4.3,4 4.7,4 4.7,3.7 5,3.7 5,3.3 4.7,3.3 ">
                                                    </polygon>
                                                    <polygon
                                                        points="5.7,4 5.3,4 5.3,4.3 5,4.3 5,4.7 5.3,4.7 5.3,5 5.7,5 5.7,4.7 6,4.7 6,4.3 5.7,4.3 ">
                                                    </polygon>
                                                    <polygon
                                                        points="3.7,5 3.3,5 3.3,5.3 3,5.3 2.7,5.3 2.7,5 2.3,5 2.3,5.3 2,5.3 2,5.7 2.3,5.7 2.3,6 2.7,6 2.7,5.7 3,5.7 3,5.7 3.3,5.7 3.3,6 3.7,6 3.7,5.7 4,5.7 4,5.3 3.7,5.3 ">
                                                    </polygon>
                                                    <polygon
                                                        points="0.7,5 0.3,5 0.3,5.3 0,5.3 0,5.7 0.3,5.7 0.3,6 0.7,6 0.7,5.7 1,5.7 1,5.3 0.7,5.3 ">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'plus'" value="plus" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_plus"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.7,0.8L0.7,0.8L0.7,0.8c0.1-0.1,0.2-0.1,0.2-0.1C1,0.6,1,0.6,1,0.5c0-0.1-0.1-0.2-0.2-0.2H0.7V0.2
                                                        C0.7,0.1,0.6,0,0.5,0S0.3,0.1,0.3,0.2v0.1H0.2C0.1,0.3,0,0.4,0,0.5s0.1,0.2,0.2,0.2h0.1v0.1C0.3,0.9,0.4,1,0.5,1 c0.1,0,0.1,0,0.2-0.1S0.7,0.8,0.7,0.8z">
                                                    </path>
                                                    <path
                                                        d="M2.2,0.7L2.2,0.7L2.2,0.7C2.3,0.9,2.4,1,2.5,1c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V0.7h0.1 c0.1,0,0.1,0,0.2-0.1C3,0.6,3,0.6,3,0.5c0-0.1-0.1-0.2-0.2-0.2H2.7V0.2C2.7,0.1,2.6,0,2.5,0S2.3,0.1,2.3,0.2v0.1H2.2 C2.1,0.3,2,0.4,2,0.5S2.1,0.7,2.2,0.7z">
                                                    </path>
                                                    <path
                                                        d="M4.7,0.8L4.7,0.8L4.7,0.8c0.1-0.1,0.2-0.1,0.2-0.1C5,0.6,5,0.6,5,0.5c0-0.1-0.1-0.2-0.2-0.2H4.7V0.2 C4.7,0.1,4.6,0,4.5,0S4.3,0.1,4.3,0.2v0.1H4.2C4.1,0.3,4,0.4,4,0.5s0.1,0.2,0.2,0.2h0.1v0.1C4.3,0.9,4.4,1,4.5,1 c0.1,0,0.1,0,0.2-0.1S4.7,0.8,4.7,0.8z">
                                                    </path>
                                                    <path
                                                        d="M5.2,0.7L5.2,0.7L5.2,0.7C5.3,0.9,5.4,1,5.5,1c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V0.7h0.1 c0.1,0,0.1,0,0.2-0.1C6,0.6,6,0.6,6,0.5c0-0.1-0.1-0.2-0.2-0.2H5.7V0.2C5.7,0.1,5.6,0,5.5,0S5.3,0.1,5.3,0.2v0.1H5.2 C5.1,0.3,5,0.4,5,0.5S5.1,0.7,5.2,0.7z">
                                                    </path>
                                                    <path
                                                        d="M4.2,1.7L4.2,1.7L4.2,1.7C4.3,1.9,4.4,2,4.5,2c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V1.7h0.1 c0.1,0,0.1,0,0.2-0.1C5,1.6,5,1.6,5,1.5c0-0.1-0.1-0.2-0.2-0.2H4.7V1.2C4.7,1.1,4.6,1,4.5,1S4.3,1.1,4.3,1.2v0.1H4.2 C4.1,1.3,4,1.4,4,1.5S4.1,1.7,4.2,1.7z">
                                                    </path>
                                                    <path
                                                        d="M3.7,1.8L3.7,1.8L3.7,1.8c0.1-0.1,0.2-0.1,0.2-0.1C4,1.6,4,1.6,4,1.5c0-0.1-0.1-0.2-0.2-0.2H3.7V1.2 C3.7,1.1,3.6,1,3.5,1S3.3,1.1,3.3,1.2v0.1H3.2C3.1,1.3,3,1.4,3,1.5s0.1,0.2,0.2,0.2h0.1v0.1C3.3,1.9,3.4,2,3.5,2 c0.1,0,0.1,0,0.2-0.1S3.7,1.8,3.7,1.8z">
                                                    </path>
                                                    <path
                                                        d="M3.2,2.7L3.2,2.7L3.2,2.7C3.3,2.9,3.4,3,3.5,3c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V2.7h0.1 c0.1,0,0.1,0,0.2-0.1C4,2.6,4,2.6,4,2.5c0-0.1-0.1-0.2-0.2-0.2H3.7V2.2C3.7,2.1,3.6,2,3.5,2S3.3,2.1,3.3,2.2v0.1H3.2 C3.1,2.3,3,2.4,3,2.5S3.1,2.7,3.2,2.7z">
                                                    </path>
                                                    <path
                                                        d="M2.2,2.7L2.2,2.7L2.2,2.7C2.3,2.9,2.4,3,2.5,3c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V2.7h0.1 c0.1,0,0.1,0,0.2-0.1C3,2.6,3,2.6,3,2.5c0-0.1-0.1-0.2-0.2-0.2H2.7V2.2C2.7,2.1,2.6,2,2.5,2S2.3,2.1,2.3,2.2v0.1H2.2 C2.1,2.3,2,2.4,2,2.5S2.1,2.7,2.2,2.7z">
                                                    </path>
                                                    <path
                                                        d="M0.3,1.2L0.3,1.2L0.3,1.2C0.1,1.3,0,1.4,0,1.5s0.1,0.2,0.2,0.2h0.1v0.1C0.3,1.9,0.4,2,0.5,2 c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V1.7h0.1c0.1,0,0.1,0,0.2-0.1C1,1.6,1,1.6,1,1.5c0-0.1-0.1-0.2-0.2-0.2H0.7V1.2 C0.7,1.1,0.6,1,0.5,1S0.3,1.1,0.3,1.2z">
                                                    </path>
                                                    <path
                                                        d="M0.8,3.3L0.8,3.3L0.8,3.3C0.7,3.1,0.6,3,0.5,3S0.3,3.1,0.3,3.2v0.1H0.2C0.1,3.3,0,3.4,0,3.5s0.1,0.2,0.2,0.2 h0.1v0.1C0.3,3.9,0.4,4,0.5,4c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V3.7h0.1c0.1,0,0.1,0,0.2-0.1C1,3.6,1,3.6,1,3.5 C1,3.4,0.9,3.3,0.8,3.3z">
                                                    </path>
                                                    <path
                                                        d="M1.8,3.3L1.8,3.3L1.8,3.3C1.7,3.1,1.6,3,1.5,3S1.3,3.1,1.3,3.2v0.1H1.2C1.1,3.3,1,3.4,1,3.5s0.1,0.2,0.2,0.2 h0.1v0.1C1.3,3.9,1.4,4,1.5,4c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V3.7h0.1c0.1,0,0.1,0,0.2-0.1C2,3.6,2,3.6,2,3.5 C2,3.4,1.9,3.3,1.8,3.3z">
                                                    </path>
                                                    <path
                                                        d="M4.8,3.3L4.8,3.3L4.8,3.3C4.7,3.1,4.6,3,4.5,3S4.3,3.1,4.3,3.2v0.1H4.2C4.1,3.3,4,3.4,4,3.5s0.1,0.2,0.2,0.2 h0.1v0.1C4.3,3.9,4.4,4,4.5,4c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V3.7h0.1c0.1,0,0.1,0,0.2-0.1C5,3.6,5,3.6,5,3.5 C5,3.4,4.9,3.3,4.8,3.3z">
                                                    </path>
                                                    <path
                                                        d="M5.8,4.3L5.8,4.3L5.8,4.3C5.7,4.1,5.6,4,5.5,4S5.3,4.1,5.3,4.2v0.1H5.2C5.1,4.3,5,4.4,5,4.5s0.1,0.2,0.2,0.2 h0.1v0.1C5.3,4.9,5.4,5,5.5,5c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V4.7h0.1c0.1,0,0.1,0,0.2-0.1C6,4.6,6,4.6,6,4.5 C6,4.4,5.9,4.3,5.8,4.3z">
                                                    </path>
                                                    <path
                                                        d="M3.8,5.3L3.8,5.3L3.8,5.3C3.7,5.1,3.6,5,3.5,5S3.3,5.1,3.3,5.2v0.1H3.2C3.1,5.3,3,5.4,3,5.5s0.1,0.2,0.2,0.2 h0.1v0.1C3.3,5.9,3.4,6,3.5,6c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V5.7h0.1c0.1,0,0.1,0,0.2-0.1C4,5.6,4,5.6,4,5.5 C4,5.4,3.9,5.3,3.8,5.3z">
                                                    </path>
                                                    <path
                                                        d="M2.8,5.3L2.8,5.3L2.8,5.3C2.7,5.1,2.6,5,2.5,5S2.3,5.1,2.3,5.2v0.1H2.2C2.1,5.3,2,5.4,2,5.5s0.1,0.2,0.2,0.2 h0.1v0.1C2.3,5.9,2.4,6,2.5,6c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V5.7h0.1c0.1,0,0.1,0,0.2-0.1C3,5.6,3,5.6,3,5.5 C3,5.4,2.9,5.3,2.8,5.3z">
                                                    </path>
                                                    <path
                                                        d="M0.8,5.3L0.8,5.3L0.8,5.3C0.7,5.1,0.6,5,0.5,5S0.3,5.1,0.3,5.2v0.1H0.2C0.1,5.3,0,5.4,0,5.5s0.1,0.2,0.2,0.2 h0.1v0.1C0.3,5.9,0.4,6,0.5,6c0.1,0,0.1,0,0.2-0.1s0.1-0.1,0.1-0.2V5.7h0.1c0.1,0,0.1,0,0.2-0.1C1,5.6,1,5.6,1,5.5 C1,5.4,0.9,5.3,0.8,5.3z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'x'" value="x" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_x"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.5,0.9L0.5,0.9C0.6,1,0.7,1,0.7,1s0.1,0,0.2-0.1C1,0.8,1,0.7,0.9,0.6L0.9,0.5l0.1-0.1C1,0.3,1,0.2,0.9,0.1 S0.7,0,0.6,0.1L0.5,0.1L0.4,0.1C0.3,0,0.2,0,0.1,0.1C0,0.2,0,0.3,0.1,0.4l0.1,0.1L0.1,0.6C0,0.7,0,0.8,0.1,0.9C0.1,1,0.2,1,0.3,1 C0.3,1,0.4,1,0.5,0.9L0.5,0.9z">
                                                    </path>
                                                    <path
                                                        d="M2.1,0.9C2.1,1,2.2,1,2.3,1c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C2.6,1,2.7,1,2.7,1s0.1,0,0.2-0.1 C3,0.8,3,0.7,2.9,0.6L2.9,0.5l0.1-0.1C3,0.3,3,0.2,2.9,0.1S2.7,0,2.6,0.1L2.5,0.1L2.4,0.1C2.3,0,2.2,0,2.1,0.1S2,0.3,2.1,0.4 l0.1,0.1L2.1,0.6C2,0.7,2,0.8,2.1,0.9z">
                                                    </path>
                                                    <path
                                                        d="M4.9,0.5L4.9,0.5C5,0.4,5,0.3,5,0.3s0-0.1-0.1-0.2C4.8,0,4.7,0,4.6,0.1L4.5,0.1L4.4,0.1C4.3,0,4.2,0,4.1,0.1 S4,0.3,4.1,0.4l0.1,0.1L4.1,0.6C4,0.7,4,0.8,4.1,0.9C4.1,1,4.2,1,4.3,1c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C4.6,1,4.7,1,4.7,1 s0.1,0,0.2-0.1C5,0.9,5,0.8,5,0.7C5,0.7,5,0.6,4.9,0.5L4.9,0.5z">
                                                    </path>
                                                    <path
                                                        d="M5.9,0.5L5.9,0.5C6,0.3,6,0.2,5.9,0.1S5.7,0,5.6,0.1L5.5,0.1L5.4,0.1C5.3,0,5.2,0,5.1,0.1C5,0.1,5,0.2,5,0.3 s0,0.1,0.1,0.2l0.1,0.1L5.1,0.6C5,0.6,5,0.7,5,0.7c0,0.1,0,0.1,0.1,0.2C5.1,1,5.2,1,5.3,1c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1 C5.6,1,5.7,1,5.7,1s0.1,0,0.2-0.1C6,0.8,6,0.7,5.9,0.5L5.9,0.5z">
                                                    </path>
                                                    <path
                                                        d="M4.5,1.1L4.5,1.1C4.4,1,4.3,1,4.3,1S4.1,1,4.1,1.1C4,1.1,4,1.2,4,1.3s0,0.1,0.1,0.2l0.1,0.1L4.1,1.6 C4,1.6,4,1.7,4,1.7c0,0.1,0,0.1,0.1,0.2C4.1,2,4.2,2,4.3,2c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C4.6,2,4.7,2,4.7,2s0.1,0,0.2-0.1 C5,1.8,5,1.7,4.9,1.6L4.9,1.5l0.1-0.1C5,1.3,5,1.2,4.9,1.1C4.9,1,4.8,1,4.7,1C4.7,1,4.6,1,4.5,1.1L4.5,1.1z">
                                                    </path>
                                                    <path
                                                        d="M3.9,1.5L3.9,1.5C4,1.4,4,1.3,4,1.3s0-0.1-0.1-0.2C3.8,1,3.7,1,3.6,1.1L3.5,1.1L3.4,1.1C3.3,1,3.2,1,3.1,1.1 C3,1.2,3,1.3,3.1,1.4l0.1,0.1L3.1,1.6C3,1.7,3,1.8,3.1,1.9C3.1,2,3.2,2,3.3,2c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1 C3.6,2,3.7,2,3.7,2s0.1,0,0.2-0.1C4,1.9,4,1.8,4,1.7C4,1.7,4,1.6,3.9,1.5L3.9,1.5z">
                                                    </path>
                                                    <path
                                                        d="M2.1,2.9C2.1,3,2.2,3,2.3,3c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C2.6,3,2.7,3,2.7,3s0.1,0,0.2-0.1 C3,2.8,3,2.7,2.9,2.6L2.9,2.5l0.1-0.1C3,2.3,3,2.2,2.9,2.1C2.8,2,2.7,2,2.6,2.1L2.5,2.1L2.4,2.1C2.3,2,2.2,2,2.1,2.1 C2,2.2,2,2.3,2.1,2.4l0.1,0.1L2.1,2.6C2,2.7,2,2.8,2.1,2.9z">
                                                    </path>
                                                    <path
                                                        d="M0.1,1.9C0.1,2,0.2,2,0.3,2c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C0.6,2,0.7,2,0.7,2s0.1,0,0.2-0.1 C1,1.8,1,1.7,0.9,1.6L0.9,1.5l0.1-0.1C1,1.3,1,1.2,0.9,1.1C0.9,1,0.8,1,0.7,1C0.7,1,0.6,1,0.6,1.1L0.5,1.1L0.4,1.1 C0.4,1,0.3,1,0.3,1S0.1,1,0.1,1.1C0,1.2,0,1.3,0.1,1.4l0.1,0.1L0.1,1.6C0,1.7,0,1.8,0.1,1.9z">
                                                    </path>
                                                    <path
                                                        d="M0.9,3.5L0.9,3.5C1,3.4,1,3.3,1,3.3s0-0.1-0.1-0.2C0.8,3,0.7,3,0.6,3.1L0.5,3.1L0.4,3.1C0.3,3,0.2,3,0.1,3.1 C0,3.2,0,3.3,0.1,3.4l0.1,0.1L0.1,3.6C0,3.7,0,3.8,0.1,3.9C0.1,4,0.2,4,0.3,4c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1 C0.6,4,0.7,4,0.7,4s0.1,0,0.2-0.1C1,3.9,1,3.8,1,3.7C1,3.7,1,3.6,0.9,3.5L0.9,3.5z">
                                                    </path>
                                                    <path
                                                        d="M1.9,3.6L1.9,3.6V3.4C2,3.3,2,3.2,1.9,3.1C1.8,3,1.7,3,1.6,3.1L1.5,3.1L1.4,3.1C1.3,3,1.2,3,1.1,3.1 C1,3.1,1,3.2,1,3.3s0,0.1,0.1,0.2l0.1,0.1L1.1,3.6C1,3.6,1,3.7,1,3.7c0,0.1,0,0.1,0.1,0.2C1.1,4,1.2,4,1.3,4c0.1,0,0.1,0,0.2-0.1 l0.1-0.1l0.1,0.1C1.6,4,1.7,4,1.7,4s0.1,0,0.2-0.1C2,3.8,2,3.7,1.9,3.6z">
                                                    </path>
                                                    <path
                                                        d="M4.9,3.6L4.9,3.6V3.4C5,3.3,5,3.2,4.9,3.1C4.8,3,4.7,3,4.6,3.1L4.5,3.1L4.4,3.1C4.3,3,4.2,3,4.1,3.1 C4,3.2,4,3.3,4.1,3.4l0.1,0.1L4.1,3.6C4,3.7,4,3.8,4.1,3.9C4.1,4,4.2,4,4.3,4c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1 C4.6,4,4.7,4,4.7,4s0.1,0,0.2-0.1C5,3.8,5,3.7,4.9,3.6z">
                                                    </path>
                                                    <path
                                                        d="M5.9,4.1C5.8,4,5.7,4,5.6,4.1L5.5,4.1L5.4,4.1C5.3,4,5.2,4,5.1,4.1C5,4.2,5,4.3,5.1,4.4l0.1,0.1L5.1,4.6 C5,4.7,5,4.8,5.1,4.9C5.1,5,5.2,5,5.3,5c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C5.6,5,5.7,5,5.7,5s0.1,0,0.2-0.1C6,4.8,6,4.7,5.9,4.6 L5.9,4.5l0.1-0.1C6,4.3,6,4.2,5.9,4.1z">
                                                    </path>
                                                    <path
                                                        d="M3.9,5.1C3.8,5,3.7,5,3.6,5.1L3.5,5.1L3.4,5.1C3.3,5,3.2,5,3.1,5.1C3,5.1,3,5.2,3,5.3s0,0.1,0.1,0.2l0.1,0.1 L3.1,5.6C3,5.6,3,5.7,3,5.7c0,0.1,0,0.1,0.1,0.2C3.1,6,3.2,6,3.3,6c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C3.6,6,3.7,6,3.7,6 s0.1,0,0.2-0.1C4,5.8,4,5.7,3.9,5.6L3.9,5.5l0.1-0.1C4,5.3,4,5.2,3.9,5.1z">
                                                    </path>
                                                    <path
                                                        d="M2.9,5.5L2.9,5.5C3,5.4,3,5.3,3,5.3s0-0.1-0.1-0.2C2.8,5,2.7,5,2.6,5.1L2.5,5.1L2.4,5.1C2.3,5,2.2,5,2.1,5.1 C2,5.2,2,5.3,2.1,5.4l0.1,0.1L2.1,5.6C2,5.7,2,5.8,2.1,5.9C2.1,6,2.2,6,2.3,6c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1 C2.6,6,2.7,6,2.7,6s0.1,0,0.2-0.1C3,5.9,3,5.8,3,5.7C3,5.7,3,5.6,2.9,5.5L2.9,5.5z">
                                                    </path>
                                                    <path
                                                        d="M0.9,5.1C0.8,5,0.7,5,0.6,5.1L0.5,5.1L0.4,5.1C0.3,5,0.2,5,0.1,5.1C0,5.2,0,5.3,0.1,5.4l0.1,0.1L0.1,5.6 C0,5.7,0,5.8,0.1,5.9C0.1,6,0.2,6,0.3,6c0.1,0,0.1,0,0.2-0.1l0.1-0.1l0.1,0.1C0.6,6,0.7,6,0.7,6s0.1,0,0.2-0.1C1,5.8,1,5.7,0.9,5.6 L0.9,5.5l0.1-0.1C1,5.3,1,5.2,0.9,5.1z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'heart'" value="heart" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_heart"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.8,0C0.7,0,0.6,0,0.5,0.1C0.4,0,0.4,0,0.3,0C0.1,0,0,0.1,0,0.3c0,0.1,0,0.1,0,0.2l0,0L0.5,1l0.4-0.5 C1,0.4,1,0.3,1,0.3C1,0.1,0.9,0,0.8,0z">
                                                    </path>
                                                    <path
                                                        d="M2.8,0C2.7,0,2.6,0,2.5,0.1C2.4,0,2.4,0,2.3,0C2.1,0,2,0.1,2,0.3c0,0.1,0,0.1,0,0.2l0,0L2.5,1l0.4-0.5 C3,0.4,3,0.3,3,0.3C3,0.1,2.9,0,2.8,0z">
                                                    </path>
                                                    <path
                                                        d="M4.8,0C4.7,0,4.6,0,4.5,0.1C4.4,0,4.4,0,4.3,0C4.1,0,4,0.1,4,0.3c0,0.1,0,0.1,0,0.2l0,0L4.5,1l0.4-0.5 C5,0.4,5,0.3,5,0.3C5,0.1,4.9,0,4.8,0z">
                                                    </path>
                                                    <path
                                                        d="M5,0.5L5.5,1l0.4-0.5C6,0.4,6,0.3,6,0.3C6,0.1,5.9,0,5.8,0C5.7,0,5.6,0,5.5,0.1C5.4,0,5.4,0,5.3,0 C5.1,0,5,0.1,5,0.3C5,0.3,5,0.4,5,0.5L5,0.5z">
                                                    </path>
                                                    <path
                                                        d="M4.8,1C4.7,1,4.6,1,4.5,1.1C4.4,1,4.4,1,4.3,1C4.1,1,4,1.1,4,1.3c0,0.1,0,0.1,0,0.2l0,0L4.5,2l0.4-0.5 C5,1.4,5,1.3,5,1.3C5,1.1,4.9,1,4.8,1z">
                                                    </path>
                                                    <path
                                                        d="M3.8,1C3.7,1,3.6,1,3.5,1.1C3.4,1,3.4,1,3.3,1C3.1,1,3,1.1,3,1.3c0,0.1,0,0.1,0,0.2l0,0L3.5,2l0.4-0.5 C4,1.4,4,1.3,4,1.3C4,1.1,3.9,1,3.8,1z">
                                                    </path>
                                                    <path
                                                        d="M2.8,2C2.7,2,2.6,2,2.5,2.1C2.4,2,2.4,2,2.3,2C2.1,2,2,2.1,2,2.3c0,0.1,0,0.1,0,0.2l0,0L2.5,3l0.4-0.5 C3,2.4,3,2.3,3,2.3C3,2.1,2.9,2,2.8,2z">
                                                    </path>
                                                    <path
                                                        d="M0.8,1C0.7,1,0.6,1,0.5,1.1C0.4,1,0.4,1,0.3,1C0.1,1,0,1.1,0,1.3c0,0.1,0,0.1,0,0.2l0,0L0.5,2l0.4-0.5 C1,1.4,1,1.3,1,1.3C1,1.1,0.9,1,0.8,1z">
                                                    </path>
                                                    <path
                                                        d="M0.8,3C0.7,3,0.6,3,0.5,3.1C0.4,3,0.4,3,0.3,3C0.1,3,0,3.1,0,3.3c0,0.1,0,0.1,0,0.2l0,0L0.5,4l0.4-0.5 C1,3.4,1,3.3,1,3.3C1,3.1,0.9,3,0.8,3z">
                                                    </path>
                                                    <path
                                                        d="M1.8,3C1.7,3,1.6,3,1.5,3.1C1.4,3,1.4,3,1.3,3C1.1,3,1,3.1,1,3.3c0,0.1,0,0.1,0,0.2l0,0L1.5,4l0.4-0.5 C2,3.4,2,3.3,2,3.3C2,3.1,1.9,3,1.8,3z">
                                                    </path>
                                                    <path
                                                        d="M4.8,3C4.7,3,4.6,3,4.5,3.1C4.4,3,4.4,3,4.3,3C4.1,3,4,3.1,4,3.3c0,0.1,0,0.1,0,0.2l0,0L4.5,4l0.4-0.5 C5,3.4,5,3.3,5,3.3C5,3.1,4.9,3,4.8,3z">
                                                    </path>
                                                    <path
                                                        d="M5.8,4C5.7,4,5.6,4,5.5,4.1C5.4,4,5.4,4,5.3,4C5.1,4,5,4.1,5,4.3c0,0.1,0,0.1,0,0.2l0,0L5.5,5l0.4-0.5 C6,4.4,6,4.3,6,4.3C6,4.1,5.9,4,5.8,4z">
                                                    </path>
                                                    <path
                                                        d="M3.8,5C3.7,5,3.6,5,3.5,5.1C3.4,5,3.4,5,3.3,5C3.1,5,3,5.1,3,5.3c0,0.1,0,0.1,0,0.2l0,0L3.5,6l0.4-0.5 C4,5.4,4,5.3,4,5.3C4,5.1,3.9,5,3.8,5z">
                                                    </path>
                                                    <path
                                                        d="M2.8,5C2.7,5,2.6,5,2.5,5.1C2.4,5,2.4,5,2.3,5C2.1,5,2,5.1,2,5.3c0,0.1,0,0.1,0,0.2l0,0L2.5,6l0.4-0.5 C3,5.4,3,5.3,3,5.3C3,5.1,2.9,5,2.8,5z">
                                                    </path>
                                                    <path
                                                        d="M0.8,5C0.7,5,0.6,5,0.5,5.1C0.4,5,0.4,5,0.3,5C0.1,5,0,5.1,0,5.3c0,0.1,0,0.1,0,0.2l0,0L0.5,6l0.4-0.5 C1,5.4,1,5.3,1,5.3C1,5.1,0.9,5,0.8,5z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'shake'" value="shake" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_shake"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.1" y="0.1"
                                                        transform="matrix(0.9962 -8.720575e-02 8.720575e-02 0.9962 -4.170330e-02 4.550928e-02)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="2.1" y="0.1"
                                                        transform="matrix(6.981014e-02 -0.9976 0.9976 6.981014e-02 1.8266 2.9591)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="4.1" y="0.1"
                                                        transform="matrix(0.1045 -0.9945 0.9945 0.1045 3.5323 4.9232)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="5.1" y="0.1"
                                                        transform="matrix(0.9962 -8.713004e-02 8.713004e-02 0.9962 -2.265348e-02 0.4811)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="4.1" y="1.1"
                                                        transform="matrix(0.9986 -5.233859e-02 5.233859e-02 0.9986 -7.234332e-02 0.2376)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="3.1" y="1.1"
                                                        transform="matrix(0.1736 -0.9848 0.9848 0.1736 1.415 4.6864)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="2.1" y="2.1"
                                                        transform="matrix(0.9962 -8.720575e-02 8.720575e-02 0.9962 -0.2085 0.2275)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="0.1" y="1.1"
                                                        transform="matrix(5.233460e-02 -0.9986 0.9986 5.233460e-02 -1.0241 1.9209)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="0.1" y="3.1"
                                                        transform="matrix(0.9998 -1.747158e-02 1.747158e-02 0.9998 -6.107527e-02 9.270038e-03)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="1.1" y="3.1"
                                                        transform="matrix(3.486695e-02 -0.9994 0.9994 3.486695e-02 -2.0502 4.8771)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="4.1" y="3.1"
                                                        transform="matrix(0.1564 -0.9877 0.9877 0.1564 0.3392 7.3973)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="5.1" y="4.1"
                                                        transform="matrix(0.1045 -0.9945 0.9945 0.1045 0.4498 9.4996)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="3.1" y="5.1"
                                                        transform="matrix(0.9962 -8.720575e-02 8.720575e-02 0.9962 -0.4663 0.3262)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="2.1" y="5.1"
                                                        transform="matrix(8.719913e-02 -0.9962 0.9962 8.719913e-02 -3.1971 7.511)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                    <rect x="0.1" y="5.1"
                                                        transform="matrix(8.719913e-02 -0.9962 0.9962 8.719913e-02 -5.0227 5.5186)"
                                                        width="0.8" height="0.8">
                                                    </rect>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'blob'" value="blob" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_blob"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="5.5" cy="4.5" r="0.5"></circle>
                                                    <path d="M5.8,0.2C5.7,0.2,5.6,0.1,5.5,0.1c-0.2,0-0.4,0.2-0.4,0.4s0.2,0.4,0.4,0.4c0.1,0,0.2,0,0.3-0.1
                                                    C5.8,0.7,5.9,0.7,6,0.7V0.3C5.9,0.3,5.8,0.3,5.8,0.2z">
                                                    </path>
                                                    <path
                                                        d="M3.9,4.5c0-0.2-0.2-0.4-0.4-0.4c-0.1,0-0.2,0-0.3,0.1C3.2,4.3,3.1,4.3,3,4.3c-0.1,0-0.2,0-0.2-0.1 C2.7,4.2,2.6,4.1,2.5,4.1c-0.2,0-0.4,0.2-0.4,0.4c0,0.1,0,0.2,0.1,0.3C2.3,4.8,2.3,4.9,2.3,5c0,0.2-0.1,0.3-0.3,0.3c0,0,0,0-0.1,0
                                                    C1.9,5.1,1.7,5,1.5,5S1.1,5.1,1.1,5.3c0,0,0,0-0.1,0v0c-0.1,0-0.2,0-0.2-0.1c0,0,0,0,0,0C0.7,5.2,0.7,5.1,0.7,5c0,0,0,0,0-0.1 C0.9,4.9,1,4.7,1,4.5S0.9,4.1,0.7,4.1c0,0,0,0,0-0.1h0c0-0.1,0-0.2,0.1-0.2c0.1-0.1,0.1-0.2,0.1-0.3c0-0.2-0.2-0.4-0.4-0.4 S0.1,3.3,0.1,3.5c0,0.1,0,0.2,0.1,0.3C0.3,3.8,0.3,3.9,0.3,4c0,0,0,0,0,0.1C0.1,4.1,0,4.3,0,4.5s0.1,0.4,0.3,0.4c0,0,0,0,0,0 c0,0,0,0,0,0c0,0.1,0,0.2-0.1,0.2C0.2,5.3,0.1,5.4,0.1,5.5c0,0.2,0.2,0.4,0.4,0.4c0.1,0,0.2,0,0.3-0.1C0.8,5.7,0.9,5.7,1,5.7v0 c0,0,0,0,0.1,0C1.1,5.9,1.3,6,1.5,6s0.4-0.1,0.4-0.3c0,0,0,0,0.1,0c0.2,0,0.3,0.1,0.3,0.3h0.3c0-0.2,0.1-0.3,0.3-0.3h0 c0,0,0,0,0.1,0c0.1,0,0.1,0,0.2,0.1c0,0,0,0,0,0C3.3,5.8,3.3,5.9,3.3,6h0.3c0-0.1,0-0.2,0.1-0.2c0,0,0,0,0,0 c0.1-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.2-0.1-0.3c0,0,0,0,0,0C3.7,5.2,3.7,5.1,3.7,5h0c0-0.1,0-0.2,0.1-0.2C3.8,4.7,3.9,4.6,3.9,4.5z M3.2,5.2C3.2,5.2,3.2,5.2,3.2,5.2c0,0-0.1,0.1-0.2,0.1c0,0,0,0-0.1,0h0C2.8,5.3,2.7,5.2,2.7,5c0-0.1,0-0.2,0.1-0.2c0,0,0,0,0,0 C2.8,4.7,2.9,4.7,3,4.7s0.2,0,0.2,0.1c0,0,0,0,0,0C3.3,4.8,3.3,4.9,3.3,5h0C3.3,5.1,3.3,5.2,3.2,5.2z">
                                                    </path>
                                                    <path
                                                        d="M5.2,2.8c0.1,0.1,0.2,0.1,0.3,0.1c0.2,0,0.4-0.2,0.4-0.4S5.7,2.1,5.5,2.1c-0.1,0-0.2,0-0.3,0.1 C5.2,2.3,5.1,2.3,5,2.3c0,0,0,0,0,0v0c0,0,0,0-0.1,0C4.9,2.1,4.7,2,4.5,2C4.3,2,4.1,2.1,4.1,2.3c0,0,0,0-0.1,0 c-0.1,0-0.2,0-0.2-0.1c0,0,0,0,0,0C3.7,2.2,3.7,2.1,3.7,2c0-0.1,0-0.2,0.1-0.2c0,0,0,0,0,0c0.1-0.1,0.1-0.2,0.1-0.3 c0-0.1,0-0.2-0.1-0.3c0,0,0,0,0,0C3.7,1.2,3.7,1.1,3.7,1c0-0.1,0-0.2,0.1-0.2c0.1-0.1,0.1-0.2,0.1-0.3c0-0.2-0.2-0.4-0.4-0.4 c-0.2,0-0.4,0.2-0.4,0.4c0,0.1,0,0.2,0.1,0.3C3.3,0.8,3.3,0.9,3.3,1c0,0.1,0,0.2-0.1,0.2c0,0,0,0,0,0C3.2,1.3,3.1,1.4,3.1,1.5 c0,0.1,0,0.2,0.1,0.3c0,0,0,0,0,0C3.3,1.8,3.3,1.9,3.3,2c0,0.1,0,0.2-0.1,0.2C3.2,2.3,3.1,2.4,3.1,2.5c0,0.2,0.2,0.4,0.4,0.4 c0.1,0,0.2,0,0.3-0.1C3.8,2.7,3.9,2.7,4,2.7c0,0,0,0,0,0l0,0c0,0,0,0,0,0c0,0,0,0,0.1,0C4.1,2.9,4.3,3,4.5,3c0.2,0,0.4-0.1,0.4-0.3 c0,0,0,0,0.1,0c0,0,0,0,0,0C5.1,2.7,5.2,2.7,5.2,2.8z">
                                                    </path>
                                                    <path
                                                        d="M0.5,0.9c0.1,0,0.2,0,0.3-0.1C0.8,0.7,0.9,0.7,1,0.7c0,0,0,0,0.1,0c0.1,0,0.1,0,0.2,0.1c0,0,0,0,0,0 C1.3,0.8,1.3,0.9,1.3,1h0c0,0,0,0,0,0.1C1.1,1.1,1,1.3,1,1.5s0.1,0.4,0.3,0.4c0,0,0,0,0,0.1c0,0,0,0,0,0c0,0.1,0,0.2-0.1,0.2 C1.2,2.3,1.1,2.4,1.1,2.5c0,0.2,0.2,0.4,0.4,0.4c0.2,0,0.4-0.2,0.4-0.4c0-0.1,0-0.2-0.1-0.3C1.7,2.2,1.7,2.1,1.7,2c0,0,0,0,0,0 c0,0,0,0,0,0C1.9,1.9,2,1.7,2,1.5S1.9,1.1,1.7,1.1c0,0,0,0,0-0.1v0c0-0.1,0-0.2,0.1-0.2c0,0,0,0,0,0c0.1-0.1,0.1-0.2,0.1-0.3 c0-0.1,0-0.2-0.1-0.3c0,0,0,0,0,0C1.7,0.2,1.7,0.1,1.7,0H1.3c0,0.1,0,0.2-0.1,0.2c0,0,0,0,0,0c0,0-0.1,0.1-0.2,0.1c0,0,0,0-0.1,0 c-0.1,0-0.2,0-0.2-0.1C0.7,0.2,0.6,0.1,0.5,0.1c-0.2,0-0.4,0.2-0.4,0.4S0.3,0.9,0.5,0.9z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'special-circle-orizz'"
                                        value="special-circle-orizz" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_special-circle-orizz"><svg width="38" height="38"
                                                    viewBox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.5,0.9l1,0c0.2,0,0.4-0.2,0.4-0.4c0-0.2-0.2-0.4-0.4-0.4l-1,0c-0.2,0-0.4,0.2-0.4,0.4S0.3,0.9,0.5,0.9z">
                                                    </path>
                                                    <path
                                                        d="M1.5,1.9l2,0c0.2,0,0.4-0.2,0.4-0.4c0-0.2-0.2-0.4-0.4-0.4l-2,0c-0.2,0-0.4,0.2-0.4,0.4S1.3,1.9,1.5,1.9z">
                                                    </path>
                                                    <path
                                                        d="M3.5,0.9c0.2,0,0.4-0.2,0.4-0.4c0-0.2-0.2-0.4-0.4-0.4S3.1,0.3,3.1,0.5C3.1,0.7,3.3,0.9,3.5,0.9z">
                                                    </path>
                                                    <path
                                                        d="M4.5,2.1l-3,0c-0.2,0-0.4,0.2-0.4,0.4s0.2,0.4,0.4,0.4l3,0c0.2,0,0.4-0.2,0.4-0.4S4.7,2.1,4.5,2.1z">
                                                    </path>
                                                    <path
                                                        d="M1.9,3.5c0-0.2-0.2-0.4-0.4-0.4H0v0.8h1.5C1.7,3.9,1.9,3.7,1.9,3.5z">
                                                    </path>
                                                    <path
                                                        d="M4.5,3.1c-0.2,0-0.4,0.2-0.4,0.4s0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4S4.7,3.1,4.5,3.1z">
                                                    </path>
                                                    <path
                                                        d="M5.9,4.5c0-0.2-0.2-0.4-0.4-0.4l-1,0c-0.2,0-0.4,0.2-0.4,0.4s0.2,0.4,0.4,0.4l1,0C5.7,4.9,5.9,4.7,5.9,4.5z">
                                                    </path>
                                                    <path
                                                        d="M3.5,4.1l-2,0c-0.2,0-0.4,0.2-0.4,0.4s0.2,0.4,0.4,0.4l2,0c0.2,0,0.4-0.2,0.4-0.4S3.7,4.1,3.5,4.1z">
                                                    </path>
                                                    <path
                                                        d="M2.5,5.1l-2,0c-0.2,0-0.4,0.2-0.4,0.4c0,0.2,0.2,0.4,0.4,0.4l2,0c0.2,0,0.4-0.2,0.4-0.4S2.7,5.1,2.5,5.1z">
                                                    </path>
                                                    <path
                                                        d="M6,0.1l-1.5,0c-0.2,0-0.4,0.2-0.4,0.4s0.2,0.4,0.4,0.4l1.5,0h0L6,0.1L6,0.1z">
                                                    </path>
                                                    <path
                                                        d="M5.1,5.5c0,0.2,0.2,0.4,0.4,0.4H6V5.1H5.5C5.3,5.1,5.1,5.3,5.1,5.5z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'special-circle-vert'"
                                        value="special-circle-vert" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_special-circle-vert"><svg width="38" height="38"
                                                    viewBox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.5,4.1c-0.2,0-0.4,0.2-0.4,0.4l0,1c0,0.2,0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4l0-1C0.9,4.3,0.7,4.1,0.5,4.1z">
                                                    </path>
                                                    <path
                                                        d="M1.5,2.1c-0.2,0-0.4,0.2-0.4,0.4l0,2c0,0.2,0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4l0-2C1.9,2.3,1.7,2.1,1.5,2.1z">
                                                    </path>
                                                    <path
                                                        d="M0.5,2.9c0.2,0,0.4-0.2,0.4-0.4S0.7,2.1,0.5,2.1c-0.2,0-0.4,0.2-0.4,0.4S0.3,2.9,0.5,2.9z">
                                                    </path>
                                                    <path
                                                        d="M2.5,1.1c-0.2,0-0.4,0.2-0.4,0.4l0,3c0,0.2,0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4l0-3C2.9,1.3,2.7,1.1,2.5,1.1z">
                                                    </path>
                                                    <path
                                                        d="M3.5,4.1c-0.2,0-0.4,0.2-0.4,0.4V6h0.8V4.5C3.9,4.3,3.7,4.1,3.5,4.1z">
                                                    </path>
                                                    <path
                                                        d="M3.5,1.1c-0.2,0-0.4,0.2-0.4,0.4s0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4S3.7,1.1,3.5,1.1z">
                                                    </path>
                                                    <path
                                                        d="M4.5,1.9c0.2,0,0.4-0.2,0.4-0.4l0-1c0-0.2-0.2-0.4-0.4-0.4c-0.2,0-0.4,0.2-0.4,0.4l0,1 C4.1,1.7,4.3,1.9,4.5,1.9z">
                                                    </path>
                                                    <path
                                                        d="M4.5,2.1c-0.2,0-0.4,0.2-0.4,0.4l0,2c0,0.2,0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4l0-2C4.9,2.3,4.7,2.1,4.5,2.1z">
                                                    </path>
                                                    <path
                                                        d="M5.5,3.1c-0.2,0-0.4,0.2-0.4,0.4l0,2c0,0.2,0.2,0.4,0.4,0.4c0.2,0,0.4-0.2,0.4-0.4l0-2 C5.9,3.3,5.7,3.1,5.5,3.1z">
                                                    </path>
                                                    <path
                                                        d="M0.1,0l0,1.5c0,0.2,0.2,0.4,0.4,0.4s0.4-0.2,0.4-0.4l0-1.5v0L0.1,0L0.1,0z">
                                                    </path>
                                                    <path
                                                        d="M5.5,0.9c0.2,0,0.4-0.2,0.4-0.4V0H5.1v0.5C5.1,0.7,5.3,0.9,5.5,0.9z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'special-circle'" value="special-circle"
                                        type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_special-circle"><svg width="38" height="38"
                                                    viewBox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.5,3C2.8,3,3,2.8,3,2.5L3,2h1.5C4.8,2,5,1.8,5,1.5C5,1.2,4.8,1,4.5,1H4V0L2,0l0,2.5C2,2.8,2.2,3,2.5,3z M4,1 L4,1L4,1L4,1z">
                                                    </path>
                                                    <path
                                                        d="M5.5,3C5.2,3,5,3.2,5,3.5S5.2,4,5.5,4C5.8,4,6,3.8,6,3.5S5.8,3,5.5,3z">
                                                    </path>
                                                    <path d="M0.5,1C0.8,1,1,0.8,1,0.5V0L0,0v0v0.5C0,0.8,0.2,1,0.5,1z">
                                                    </path>
                                                    <path
                                                        d="M4,4L4,4L3,4l0,0v0C2.4,4,2,4.4,2,5h0H1V2.5C1,2.2,0.8,2,0.5,2S0,2.2,0,2.5V5h0c0,0.6,0.4,1,1,1h2v0V5h1v0h0v1 l1,0V5h0C5,4.4,4.6,4,4,4z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'special-diamond'" value="special-diamond"
                                        type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_special-diamond"><svg width="38" height="38"
                                                    viewBox="0 0 6 6" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="4.1" y="3.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.1563 4.2076)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <polygon
                                                        points="1,1.5 1,1 1,1 2.5,1 3,0.5 2.5,0 0.5,0 0,0.5 0,1.5 0.5,2 ">
                                                    </polygon>
                                                    <path d="M3,2"></path>
                                                    <rect x="5.1" y="4.1"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.5707 5.2069)"
                                                        width="0.7" height="0.7">
                                                    </rect>
                                                    <polygon
                                                        points="0.5,3 0,3.5 0,5.5 0.5,6 1,5.5 1,4 2,4 2,5.5 2.5,6 4.5,6 5,5.5 4.5,5 3,5 3,3.5 2.5,3">
                                                    </polygon>
                                                    <polygon
                                                        points="5.5,0 4.5,0 4,0.5 4,1 3.5,1 3,1.5 3,2.5 3.5,3 4,2.5 4,2 4.5,2 5,1.5 5,1 5.5,1 6,0.5">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'ribbon'" value="ribbon" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_ribbon"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="4" y="3" width="1" height="1">
                                                    </rect>
                                                    <rect x="5" y="4" width="1" height="1">
                                                    </rect>
                                                    <polygon
                                                        points="5,1 6,1 6,1 6,1 5.5,0.5 6,0 4,0 4,0 4,0 4,1 4,1 4,1 3,1 2.5,0.5 3,0 3,0 3,0 0,0 0,2 0,2 0,2 0.5,1.5 1,2 1,2 1,2 1,1 1,1 3,1 3,3 0,3 0,6 0,6 0,6 0.5,5.5 1,6 1,6 1,4 2,4 2,6 6,6 6,6 5,6 4.5,5.5 5,5 5,5 5,5 3,5 3,3 3.5,2.5 4,3 4,3 4,3 4,2 5,2 5,2 5,2">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'oriental'" value="oriental" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_oriental"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5.5,4C5.2,4,5,4.2,5,4.5S5.2,5,5.5,5C5.8,5,6,4.8,6,4.5S5.8,4,5.5,4z">
                                                    </path>
                                                    <path
                                                        d="M0,2c0.6,0,1-0.4,1-1l1,0v0l0.2-0.1c0.2-0.1,0.4-0.1,0.6,0L3,1c0,0,0,0,0,0v0l0,0c0-0.6-0.4-1-1-1v0H0l0,1h0l0.1,0.2 c0.1,0.2,0.1,0.4,0,0.6L0,2z">
                                                    </path>
                                                    <path
                                                        d="M4.5,3C4.2,3,4,3.2,4,3.5S4.2,4,4.5,4C4.8,4,5,3.8,5,3.5S4.8,3,4.5,3z">
                                                    </path>
                                                    <path
                                                        d="M3,2L3,2L3,2l0.1,0.2c0.1,0.2,0.1,0.4,0,0.6L3,3c0.6,0,1-0.4,1-1l0,0h0h0.5C4.8,2,5,1.8,5,1.5V1l0.2-0.1 c0.2-0.1,0.4-0.1,0.6,0L6,1c0-0.6-0.4-1-1-1l0,0h0H4.5C4.2,0,4,0.2,4,0.5V1h0H3.5C3.2,1,3,1.2,3,1.5V2z">
                                                    </path>
                                                    <path
                                                        d="M4,5L4,5L3,5v0h0l0-1.5C3,3.2,2.8,3,2.5,3l-1,0C1.2,3,1,3.2,1,3.5L1,4l0,0L0.8,4.1c-0.2,0.1-0.4,0.1-0.6,0L0,4 c0,0.6,0.4,1,1,1l0,0l1,0l0,0.5C2,5.8,2.2,6,2.5,6L4,6l0,0v0l0.2-0.1c0.2-0.1,0.4-0.1,0.6,0L5,6C5,5.4,4.6,5,4,5z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_style = 'ellipse'" value="ellipse" type="qr_style">
                                        <div>
                                            <label class="btn btn-light p-1 me-1 mb-1 rounded-0 pattern_label"
                                                for="pattern_ellipse"><svg width="38" height="38" viewBox="0 0 6 6"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5.2,4C5,4,4.9,4.3,5.1,4.5C5.3,4.8,5.6,5,5.8,5C6,5,6.1,4.7,5.9,4.5C5.7,4.2,5.4,4,5.2,4z">
                                                    </path>
                                                    <path d="M5,0.9C5,0.9,5.1,1,5.1,1H6V0C5.8,0,5,0.6,5,0.9z">
                                                    </path>
                                                    <path
                                                        d="M5.9,2H4l0,0h0V1l0,0h0c0-0.2-0.6-1-0.9-1C3.1,0,3,0.1,3,0.1v2.5C3,2.9,3.1,3,3.3,3L5,3v0l0,0c0.2,0,1-0.6,1-0.9 C6,2.1,5.9,2,5.9,2z">
                                                    </path>
                                                    <path
                                                        d="M3.7,4H2.3C2.1,4,2,4.1,2,4.3V5h0l0,0H1v0V4h0l0,0c0-0.2-0.6-1-0.9-1C0.1,3,0,3.1,0,3.1v2.5C0,5.9,0.1,6,0.3,6L4,6V4.3 C4,4.1,3.9,4,3.7,4z">
                                                    </path>
                                                    <path
                                                        d="M0.1,1H1v0v1h0l0,0c0,0.2,0.6,1,0.9,1C1.9,3,2,2.9,2,2.9L2,0H1v0C0.8,0,0,0.6,0,0.9C0,0.9,0.1,1,0.1,1z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>


                                </div>
                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_eye_border" label="Eye Borders" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div class="grid grid-cols-6 gap-4">

                                    <x-tw.button-select @click="qr_eye_border = 'default'" value="default"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b124-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_default"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0,0v14h14V0H0z M12,12H2V2h10V12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'flurry'" value="flurry"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b125-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_flurry"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label active_label"><svg
                                                    width="32" height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.2,0.1L0.1,0.6l0.1,0.5L0.2,1.6L0.1,2.1l0.1,0.5L0,3.1l0,0.5L0,4l0.1,0.5l0,0.5l0.1,0.5L0.1,6l0,0.5l0,0.5 l0.2,0.5L0.1,8l0.1,0.5L0,8.9l0.2,0.5L0,9.9l0.2,0.5l-0.1,0.5l0,0.5L0,11.9l0.2,0.5l-0.1,0.5l0.1,0.5l0,0.4L0.6,14l0.5,0l0.5-0.1 l0.5,0.1l0.5,0.1L3.1,14l0.5-0.1l0.5-0.1l0.5,0L5,13.9l0.5-0.1l0.5,0l0.5,0L7,13.9L7.5,14L8,14l0.5-0.2L9,13.9L9.4,14l0.5-0.2 l0.5,0.2l0.5-0.1l0.5,0l0.5-0.1l0.5,0l0.5,0l0.5,0l0.5,0.1l-0.1-0.5l0.2-0.5l-0.1-0.5l-0.1-0.5l0.2-0.5l-0.2-0.5l0.1-0.5L14,9.9 l-0.2-0.5L13.9,9L14,8.5L14,8l-0.2-0.5l0-0.5l0.1-0.5L13.8,6l0-0.5L14,5l0-0.5l-0.1-0.5l0.1-0.5l-0.2-0.5l0.1-0.5l0-0.5l0-0.5 l-0.1-0.5L14,0.6l-0.2-0.4l-0.4,0l-0.5,0L12.4,0l-0.5,0.2l-0.5,0l-0.5-0.1l-0.5,0L10,0l-0.5,0L9,0L8.5,0.2L8,0.2L7.5,0.1L7,0.1 L6.5,0.2L6,0L5.5,0.2L5.1,0.2L4.6,0.1L4.1,0.1L3.6,0L3.1,0.1L2.6,0L2.1,0.1l-0.5,0l-0.5,0L0.6,0.2L0.2,0.1z M11.9,11.9l-0.5-0.1 L10.9,12l-0.5-0.1L10,11.9l-0.5,0.1L9,11.8l-0.5,0l-0.5,0l-0.5,0.1l-0.5,0L6.5,12L6,11.9l-0.5,0l-0.5,0L4.6,12l-0.5-0.2L3.6,12 l-0.5-0.1L2.6,12l-0.4-0.1L2,11.4l0.1-0.5l0-0.5l0.1-0.5L2,9.5L2.1,9L2,8.5L2,8l0.2-0.5l0-0.5L2,6.5L2.1,6l0.1-0.5L2.2,5L2.1,4.5 L2,4.1l0-0.5l0.2-0.5L2,2.6L2,2l0.5,0l0.5,0.1l0.5,0.1l0.5,0L4.5,2L5,2.1l0.5,0.1L6,2l0.5,0.2L7,2.1l0.5,0L8,2l0.5,0L9,2l0.5,0 l0.5,0.1L10.4,2l0.5,0.2L11.4,2L12,2l-0.1,0.6L12,3.1l-0.1,0.5L11.8,4L12,4.5L11.9,5l-0.1,0.5l0,0.5L12,6.5L12,7l-0.1,0.5L12,8 l0,0.5l-0.2,0.5l0,0.5l0.1,0.5l-0.1,0.5l0.2,0.5l-0.1,0.5L11.9,11.9z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'sdoz'" value="sdoz"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b126-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_sdoz"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0l0.9,13c0,0.6,0.5,1,1,1h12V2c0-0.6-0.4-1-1-1L0,0z M12,12H3.8c-0.5,0-1-0.4-1-1L2,2l9,0.7c0.5,0,1,0.5,1,1 V12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'drop_in'" value="drop_in"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b127-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_drop_in"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0l0,7c0,3.9,3.1,7,7,7h0c3.9,0,7-3.1,7-7v0c0-3.9-3.1-7-7-7H0z M7,12L7,12c-2.8,0-5-2.2-5-5V2h5c2.8,0,5,2.2,5,5v0 C12,9.8,9.8,12,7,12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'drop'" value="drop"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b128-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_drop"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,7L0,7c0,3.9,3.1,7,7,7h7V7c0-3.9-3.1-7-7-7h0C3.1,0,0,3.1,0,7z M12,12H7c-2.8,0-5-2.2-5-5v0c0-2.8,2.2-5,5-5h0 c2.8,0,5,2.2,5,5V12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'dropeye'" value="dropeye"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b12d-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_dropeye"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0l0,7c0,3.9,3.1,7,7,7h7V7c0-3.9-3.1-7-7-7H0z M12,12H7c-2.8,0-5-2.2-5-5V2h5c2.8,0,5,2.2,5,5V12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'dropeyeleft'" value="dropeyeleft"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b12e-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_dropeyeleft"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0l0,7c0,3.9,3.1,7,7,7h7V7c0-3.9-3.1-7-7-7H0z M12,12H7c-2.8,0-5-2.2-5-5v0c0-2.8,2.2-5,5-5h0c2.8,0,5,2.2,5,5V12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'dropeyeleaf'" value="dropeyeleaf"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b12f-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_dropeyeleaf"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0l0,7c0,3.9,3.1,7,7,7h7V7c0-3.9-3.1-7-7-7H0z M7,12L7,12c-2.8,0-5-2.2-5-5v0c0-2.8,2.2-5,5-5h0c2.8,0,5,2.2,5,5v0 C12,9.8,9.8,12,7,12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'dropeyeright'" value="dropeyeright"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b130-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_dropeyeright"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0l0,7c0,3.9,3.1,7,7,7h7V7c0-3.9-3.1-7-7-7H0z M7,12L7,12c-2.8,0-5-2.2-5-5V2h5c2.8,0,5,2.2,5,5v0C12,9.8,9.8,12,7,12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'squarecircle'" value="squarecircle"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b131-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_squarecircle"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0l0,14h14V0H0z M7,12L7,12c-2.8,0-5-2.2-5-5v0c0-2.8,2.2-5,5-5h0c2.8,0,5,2.2,5,5v0C12,9.8,9.8,12,7,12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'circle'" value="circle"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b129-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_circle"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,7L0,7c0,3.9,3.1,7,7,7h0c3.9,0,7-3.1,7-7v0c0-3.9-3.1-7-7-7h0C3.1,0,0,3.1,0,7z M7,12L7,12c-2.8,0-5-2.2-5-5v0 c0-2.8,2.2-5,5-5h0c2.8,0,5,2.2,5,5v0C12,9.8,9.8,12,7,12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'rounded'" value="rounded"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b12a-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_rounded"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.5,14h5.1C12,14,14,12,14,9.6V4.5C14,2,12,0,9.5,0H4.4C2,0,0,2,0,4.4v5.1C0,12,2,14,4.5,14z M12,4.8v4.4 c0,1.5-1.3,2.8-2.8,2.8H4.8C3.2,12,2,10.8,2,9.2V4.8C2,3.3,3.3,2,4.8,2h4.4C10.8,2,12,3.2,12,4.8z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'flower'" value="flower"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b12b-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_flower"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0v9.6C0,12,2,14,4.4,14h5.1C12,14,14,12,14,9.6V4.4C14,2,12,0,9.6,0H0z M9.2,12H4.8C3.3,12,2,10.7,2,9.2V2h7.2 C10.7,2,12,3.3,12,4.8v4.4C12,10.7,10.7,12,9.2,12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'flower_in'" value="flower_in"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b12c-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_flower_in"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14,14V4.4C14,2,12,0,9.6,0H4.4C2,0,0,2,0,4.4v5.1C0,12,2,14,4.4,14H14z M4.8,2h4.4C10.7,2,12,3.3,12,4.8V12H4.8 C3.3,12,2,10.7,2,9.2V4.8C2,3.3,3.3,2,4.8,2z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'square'" value="square"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b132-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_leaf"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0,0v9.6C0,12,2,14,4.4,14H14V4.4C14,2,12,0,9.6,0H0z M12,12H4.8C3.3,12,2,10.7,2,9.2V2h7.2C10.7,2,12,3.3,12,4.8V12z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = '3-corners'" value="3-corners"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b133-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_3-corners"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14,0H4.4C2,0,0,2,0,4.4V14h14V0z M2,12V4.8C2,3.3,3.3,2,4.8,2H12v10H2z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'vortex'" value="vortex"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b134-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_vortex"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M13.8,1.1c-3.5,3.9-3.8-1.9-12.8-0.9c3.9,3.5-1.9,3.8-0.9,12.8c3.5-3.9,3.8,1.9,12.8,0.9C9.1,10.4,14.9,10.1,13.8,1.1z
                                                    M9.4,13.2c-6.5-1.6-5.2-5.6-8.6-3.8c1.6-6.5,5.6-5.2,3.8-8.6c6.5,1.6,5.2,5.6,8.6,3.8C11.7,11.1,7.6,9.8,9.4,13.2z">
                                                    </path>
                                                    <path d="M5.8,4.6"></path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'dots'" value="dots"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b135-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_dots"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14,3.1c0-0.4-0.3-0.8-0.6-1c0.4-0.2,0.6-0.5,0.6-1C14,0.5,13.5,0,12.9,0c-0.4,0-0.8,0.3-1,0.6 c-0.2-0.4-0.5-0.6-1-0.6s-0.8,0.3-1,0.6C9.8,0.3,9.4,0,9,0C8.5,0,8.2,0.3,8,0.6C7.8,0.3,7.4,0,7,0S6.2,0.3,6,0.6C5.8,0.3,5.5,0,5,0 C4.6,0,4.2,0.3,4,0.6C3.9,0.3,3.5,0,3.1,0s-0.8,0.3-1,0.6C1.9,0.3,1.5,0,1.1,0C0.5,0,0,0.5,0,1.1c0,0.4,0.3,0.8,0.6,1 C0.3,2.2,0,2.6,0,3.1s0.3,0.8,0.6,1C0.3,4.2,0,4.6,0,5c0,0.4,0.3,0.8,0.6,1C0.3,6.2,0,6.6,0,7s0.3,0.8,0.6,1C0.3,8.2,0,8.5,0,9 c0,0.4,0.3,0.8,0.6,1c-0.4,0.2-0.6,0.5-0.6,1s0.3,0.8,0.6,1c-0.4,0.2-0.6,0.5-0.6,1C0,13.5,0.5,14,1.1,14c0.4,0,0.8-0.3,1-0.6 c0.2,0.4,0.5,0.6,1,0.6s0.8-0.3,1-0.6C4.2,13.7,4.6,14,5,14c0.4,0,0.8-0.3,1-0.6C6.2,13.7,6.6,14,7,14s0.8-0.3,1-0.6 C8.2,13.7,8.5,14,9,14c0.4,0,0.8-0.3,1-0.6c0.2,0.4,0.5,0.6,1,0.6s0.8-0.3,1-0.6c0.2,0.4,0.5,0.6,1,0.6c0.6,0,1.1-0.5,1.1-1.1 c0-0.4-0.3-0.8-0.6-1c0.4-0.2,0.6-0.5,0.6-1s-0.3-0.8-0.6-1C13.7,9.8,14,9.4,14,9c0-0.4-0.3-0.8-0.6-1C13.7,7.8,14,7.4,14,7 s-0.3-0.8-0.6-1C13.7,5.8,14,5.5,14,5c0-0.4-0.3-0.8-0.6-1C13.7,3.9,14,3.5,14,3.1z M11.9,12.5c-0.2-0.4-0.5-0.6-1-0.6 s-0.8,0.3-1,0.6c-0.2-0.4-0.5-0.6-1-0.6c-0.4,0-0.8,0.3-1,0.6c-0.2-0.4-0.5-0.6-1-0.6s-0.8,0.3-1,0.6c-0.2-0.4-0.5-0.6-1-0.6 c-0.4,0-0.8,0.3-1,0.6c-0.2-0.4-0.5-0.6-1-0.6s-0.8,0.3-1,0.6C2,12.2,1.8,12,1.5,11.9c0.4-0.2,0.6-0.5,0.6-1s-0.3-0.8-0.6-1 c0.4-0.2,0.6-0.5,0.6-1c0-0.4-0.3-0.8-0.6-1c0.4-0.2,0.6-0.5,0.6-1S1.9,6.2,1.5,6c0.4-0.2,0.6-0.5,0.6-1c0-0.4-0.3-0.8-0.6-1 c0.4-0.2,0.6-0.5,0.6-1s-0.3-0.8-0.6-1C1.8,2,2,1.8,2.1,1.5c0.2,0.4,0.5,0.6,1,0.6s0.8-0.3,1-0.6c0.2,0.4,0.5,0.6,1,0.6 c0.4,0,0.8-0.3,1-0.6c0.2,0.4,0.5,0.6,1,0.6s0.8-0.3,1-0.6c0.2,0.4,0.5,0.6,1,0.6c0.4,0,0.8-0.3,1-0.6c0.2,0.4,0.5,0.6,1,0.6 s0.8-0.3,1-0.6C12,1.8,12.2,2,12.5,2.1c-0.4,0.2-0.6,0.5-0.6,1s0.3,0.8,0.6,1c-0.4,0.2-0.6,0.5-0.6,1c0,0.4,0.3,0.8,0.6,1 c-0.4,0.2-0.6,0.5-0.6,1s0.3,0.8,0.6,1c-0.4,0.2-0.6,0.5-0.6,1c0,0.4,0.3,0.8,0.6,1c-0.4,0.2-0.6,0.5-0.6,1s0.3,0.8,0.6,1 C12.2,12,12,12.2,11.9,12.5z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'bruised'" value="bruised"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b136-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_bruised"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M14,9.6V3c-1.7,0-3-1.3-3-3H4.4C2,0,0,2,0,4.4V11c1.7,0,3,1.3,3,3h6.6C12,14,14,12,14,9.6z M4.6,12C4.1,10.8,3.2,9.9,2,9.4 v-5C2,3.1,3.1,2,4.4,2h5c0.5,1.2,1.4,2.1,2.6,2.6v5c0,1.3-1.1,2.4-2.4,2.4H4.6z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_border = 'canvas'" value="canvas"
                                        type="qr_eye_border">
                                        <div id="w-node-bccc0b1a-c34c-3d82-a479-db2a8f66b137-b2ca3f7c" class="w-embed">
                                            <label for="marker_out_canvas"
                                                class="btn btn-light p-1 me-1 mb-1 marker_label"><svg width="32"
                                                    height="32" viewBox="0 0 14 14" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path class="st0"
                                                        d="M13.8,1.8H14V0.2h-0.2V0h-1.6v0.2H12v0L11.7,0L11,0.4L10.3,0L9.7,0.4L9,0L8.3,0.4L7.7,0L7,0.4L6.3,0L5.7,0.4
                                                            L5,0L4.3,0.4L3.7,0L3,0.4L2.3,0L2,0.2v0H1.8V0H0.2v0.2H0v1.6h0.2V2h0L0,2.3L0.4,3L0,3.7l0.4,0.7L0,5l0.4,0.7L0,6.3L0.4,7L0,7.7
                                                            l0.4,0.7L0,9l0.4,0.7L0,10.3L0.4,11L0,11.7L0.2,12h0v0.2H0v1.6h0.2V14h1.6v-0.2H2v0L2.3,14L3,13.6L3.7,14l0.7-0.4L5,14l0.7-0.4
                                                            L6.3,14L7,13.6L7.7,14l0.7-0.4L9,14l0.7-0.4l0.7,0.4l0.7-0.4l0.7,0.4l0.3-0.2v0h0.2V14h1.6v-0.2H14v-1.6h-0.2V12h0l0.2-0.3L13.6,11
                                                            l0.4-0.7l-0.4-0.7L14,9l-0.4-0.7L14,7.7L13.6,7L14,6.3l-0.4-0.7L14,5l-0.4-0.7L14,3.7L13.6,3L14,2.3L13.8,2h0V1.8z M12.4,3L12,3.7
                                                            l0.4,0.7L12,5l0.4,0.7L12,6.3L12.4,7L12,7.7l0.4,0.7L12,9l0.4,0.7L12,10.3l0.4,0.7L12,11.7l0.2,0.3h0v0.2H12v0L11.7,12L11,12.4
                                                            L10.3,12l-0.7,0.4L9,12l-0.7,0.4L7.7,12L7,12.4L6.3,12l-0.7,0.4L5,12l-0.7,0.4L3.7,12L3,12.4L2.3,12L2,12.2v0H1.8V12h0L2,11.7
                                                            L1.6,11L2,10.3L1.6,9.7L2,9L1.6,8.3L2,7.7L1.6,7L2,6.3L1.6,5.7L2,5L1.6,4.3L2,3.7L1.6,3L2,2.3L1.8,2h0V1.8H2v0L2.3,2L3,1.6L3.7,2
                                                            l0.7-0.4L5,2l0.7-0.4L6.3,2L7,1.6L7.7,2l0.7-0.4L9,2l0.7-0.4L10.3,2L11,1.6L11.7,2L12,1.8v0h0.2V2h0L12,2.3L12.4,3z">
                                                    </path>
                                                </svg>
                                            </label>
                                        </div>
                                    </x-tw.button-select>
                                </div>
                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_eye_center" label="Eye Center" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div class="grid grid-cols-6 gap-4">
                                    <x-tw.button-select @click="qr_eye_center = 'default'" value="default"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9eee-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_default"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label active_label"><svg
                                                    width="14" height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="6" height="6">
                                                    </rect>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'flurry'" value="flurry"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9eef-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_flurry"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon
                                                        points="5.9,5.9 5.6,5.9 5.3,6 5,5.7 4.7,5.8 4.4,5.8 4.1,5.8 3.9,5.7 3.6,5.7 3.3,5.8 3,5.9 2.7,5.8 2.4,5.8 2.1,5.8 1.9,5.7 1.6,5.7 1.3,5.7 1,5.8 0.7,5.8 0.4,5.8 0.1,5.9 0,5.5 0.1,5.3 0,5 0.3,4.7 0.3,4.4 0.2,4.1 0.2,3.8 0.1,3.5 0.3,3.3 0.1,3 0.1,2.7 0.2,2.4 0.1,2.1 0.1,1.8 0.1,1.5 0.2,1.3 0.3,1 0,0.7 0,0.4 0.3,0.2 0.4,0.1 0.7,0.1 1,0.2 1.3,0.1 1.6,0.3 1.9,0.1 2.1,0.1 2.4,0.2 2.7,0.1 3,0.3 3.3,0.2 3.6,0.2 3.8,0.2 4.1,0.1 4.4,0.3 4.7,0.1 5,0.2 5.3,0.1 5.6,0 5.9,0 5.8,0.4 6,0.7 6,1 5.9,1.2 5.7,1.5 5.7,1.8 5.9,2.1 5.7,2.4 5.8,2.7 6,3 5.9,3.3 5.8,3.5 5.8,3.8 5.8,4.1 6,4.4 5.8,4.7 5.7,5 5.7,5.3 5.8,5.5">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'sdoz'" value="sdoz"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef0-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_sdoz"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon points="6,6 0.5,6 0,0 6,0.5">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'drop_in'" value="drop_in"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef1-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_drop_in"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3,6L3,6C1.3,6,0,4.7,0,3l0-3l3,0c1.7,0,3,1.3,3,3v0C6,4.7,4.7,6,3,6z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'drop'" value="drop"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef2-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_drop"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6,6H3C1.3,6,0,4.7,0,3v0c0-1.7,1.3-3,3-3h0c1.7,0,3,1.3,3,3V6z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'dropeye'" value="dropeye"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef3-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_dropeye"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M6,6H3C1.3,6,0,4.7,0,3l0-3l3,0c1.7,0,3,1.3,3,3V6z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'circle'" value="circle"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef4-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_circle"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="3" cy="3" r="3"></circle>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'rounded'" value="rounded"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef5-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_rounded"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6,1.7v2.7C6,5.2,5.2,6,4.3,6H1.7C0.7,6,0,5.3,0,4.3V1.7C0,0.8,0.8,0,1.7,0h2.7C5.3,0,6,0.7,6,1.7z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'sun'" value="sun" type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef6-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_sun"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon
                                                        points="3,0 3.4,0.7 4,0.2 4.1,0.9 4.9,0.7 4.8,1.5 5.6,1.5 5.2,2.2 5.9,2.5 5.3,3 5.9,3.5 5.2,3.8 5.6,4.5 4.8,4.5 4.9,5.3 4.1,5.1 4,5.8 3.4,5.3 3,6 2.5,5.3 1.9,5.8 1.8,5.1 1,5.3 1.1,4.5 0.4,4.5 0.7,3.8 0,3.5 0.6,3 0,2.5 0.7,2.2 0.4,1.5 1.1,1.5 1,0.7 1.8,0.9 1.9,0.2 2.5,0.7">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'star'" value="star"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef7-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_star"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.2,0.3l0.6,1.3C4,1.8,4.1,1.9,4.3,1.9l1.4,0.2c0.2,0,0.3,0.3,0.2,0.5l-1,1C4.7,3.7,4.7,3.9,4.7,4.1L5,5.5 c0,0.2-0.2,0.4-0.4,0.3L3.3,5.2c-0.2-0.1-0.4-0.1-0.6,0L1.4,5.8C1.2,5.9,1,5.8,1,5.5l0.2-1.4c0-0.2,0-0.4-0.2-0.5l-1-1 C-0.1,2.4,0,2.2,0.2,2.1l1.4-0.2c0.2,0,0.4-0.2,0.5-0.3l0.6-1.3C2.9,0.1,3.1,0.1,3.2,0.3z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'diamond'" value="diamond"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef8-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_diamond"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="0.9" y="0.9"
                                                        transform="matrix(0.7071 -0.7071 0.7071 0.7071 -1.2426 3)"
                                                        width="4.2" height="4.2">
                                                    </rect>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'danger'" value="danger"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9ef9-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_danger"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon
                                                        points="3,5.1 3.9,6 6,6 6,3.9 5.1,3 6,2.1 6,0 3.9,0 3,0.9 2.1,0 0,0 0,2.1 0.9,3 0,3.9 0,6 2.1,6">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'cross'" value="cross"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9efa-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_cross"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon
                                                        points="6,1.5 4.5,1.5 4.5,0 1.5,0 1.5,1.5 0,1.5 0,4.5 1.5,4.5 1.5,6 4.5,6 4.5,4.5 6,4.5">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'plus'" value="plus"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9efb-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_plus"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.5,1.5L4.5,1.5L4.5,1.5C4.5,0.7,3.8,0,3,0h0C2.2,0,1.5,0.7,1.5,1.5v0h0C0.7,1.5,0,2.2,0,3v0 c0,0.8,0.7,1.5,1.5,1.5h0v0C1.5,5.3,2.2,6,3,6h0c0.8,0,1.5-0.7,1.5-1.5v0h0C5.3,4.5,6,3.8,6,3v0C6,2.2,5.3,1.5,4.5,1.5z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'x'" value="x" type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9efc-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_x"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3,5.1l0.4,0.4C3.7,5.8,4.1,6,4.5,6h0C5.3,6,6,5.3,6,4.5v0c0-0.4-0.2-0.8-0.4-1.1L5.1,3l0.4-0.4 C5.8,2.3,6,1.9,6,1.5v0C6,0.7,5.3,0,4.5,0h0C4.1,0,3.7,0.2,3.4,0.4L3,0.9L2.6,0.4C2.3,0.2,1.9,0,1.5,0h0C0.7,0,0,0.7,0,1.5v0 c0,0.4,0.2,0.8,0.4,1.1L0.9,3L0.4,3.4C0.2,3.7,0,4.1,0,4.5v0C0,5.3,0.7,6,1.5,6h0c0.4,0,0.8-0.2,1.1-0.4L3,5.1z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'heart'" value="heart"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9efd-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_heart"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6,1.8C5.9,1,5.3,0.4,4.5,0.3C3.9,0.2,3.4,0.5,3,0.9C2.6,0.5,2.1,0.3,1.6,0.3C0.8,0.4,0.1,1,0,1.8 C0,2.3,0.1,2.7,0.3,3l0,0l0,0c0.1,0.1,0.2,0.2,0.3,0.3l1.9,2.2c0.3,0.3,0.7,0.3,0.9,0l1.8-1.9c0.1-0.1,0.3-0.3,0.4-0.5 C5.9,2.8,6.1,2.3,6,1.8z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'vortex'" value="vortex"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9efe-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_vortex"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3.5,6C0.7,4.7,1.7,3,0,3.5C1.3,0.7,3,1.7,2.5,0C5.3,1.3,4.3,3,6,2.5C4.7,5.3,3,4.3,3.5,6z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'sparkle_dot'" value="default"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9eff-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_sparkle_dot"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M3-1L3-1c0,2.2-1.8,4-4,4h0h0c2.2,0,4,1.8,4,4v0v0c0-2.2,1.8-4,4-4h0h0C4.8,3,3,1.2,3-1L3-1z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = '9-dots'" value="9-dots"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9f00-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_9-dots"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="1" cy="1" r="1"></circle>
                                                    <circle cx="3" cy="1" r="1"></circle>
                                                    <circle cx="5" cy="1" r="1"></circle>
                                                    <circle cx="1" cy="3" r="1"></circle>
                                                    <circle cx="3" cy="3" r="1"></circle>
                                                    <circle cx="5" cy="3" r="1"></circle>
                                                    <circle cx="1" cy="5" r="1"></circle>
                                                    <circle cx="3" cy="5" r="1"></circle>
                                                    <circle cx="5" cy="5" r="1"></circle>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = '9-dots-fat'" value="9-dots-fat"
                                        type="qr_eye_center">
                                        <div id="w-node-d2c0b408-7f74-d66f-ac42-404ce29d9f01-b2ca3f7c" class="w-embed">
                                            <label for="marker_in_9-dots-fat"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6,3c0-0.4-0.3-0.8-0.6-1C5.7,1.9,6,1.5,6,1.1C6,0.5,5.5,0,4.9,0C4.5,0,4.1,0.3,4,0.6C3.8,0.3,3.4,0,3,0S2.2,0.3,2,0.6 C1.9,0.3,1.5,0,1.1,0C0.5,0,0,0.5,0,1.1c0,0.4,0.3,0.8,0.6,1C0.3,2.2,0,2.6,0,3s0.3,0.8,0.6,1C0.3,4.1,0,4.5,0,4.9 C0,5.5,0.5,6,1.1,6c0.4,0,0.8-0.3,1-0.6C2.2,5.7,2.6,6,3,6s0.8-0.3,1-0.6C4.1,5.7,4.5,6,4.9,6C5.5,6,6,5.5,6,4.9 c0-0.4-0.3-0.8-0.6-1C5.7,3.8,6,3.4,6,3z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'flower'" value="flower"
                                        type="qr_eye_center">
                                        <div class="w-embed">
                                            <label for="marker_in_flower"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.3,6H1.7C0.8,6,0,5.2,0,4.3V0h4.3C5.2,0,6,0.8,6,1.7v2.6C6,5.2,5.2,6,4.3,6z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'elastic'" value="elastic"
                                        type="qr_eye_center">
                                        <div class="w-embed">
                                            <label for="marker_in_elastic"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6,6L6,6C4.1,5.4,1.9,5.4,0,6l0,0l0,0c0.6-1.9,0.6-4.1,0-6l0,0l0,0c1.9,0.6,4.1,0.6,6,0l0,0l0,0C5.4,1.9,5.4,4.1,6,6L6,6z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'diagonal'" value="diagonal"
                                        type="qr_eye_center">
                                        <div class="w-embed">
                                            <label for="marker_in_diagonal"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <polygon points="6,6 3,6 0,3 0,0 3,0 6,3 ">
                                                    </polygon>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'ropes'" value="ropes"
                                        type="qr_eye_center">
                                        <div class="w-embed">
                                            <label for="marker_in_ropes"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M5.1,1.9H0.9C0.4,1.9,0,1.5,0,1v0c0-0.5,0.4-0.9,0.9-0.9h4.2C5.6,0.1,6,0.5,6,1v0C6,1.5,5.6,1.9,5.1,1.9z">
                                                    </path>
                                                    <path
                                                        d="M5.1,3.9H0.9C0.4,3.9,0,3.5,0,3v0c0-0.5,0.4-0.9,0.9-0.9h4.2C5.6,2.1,6,2.5,6,3v0C6,3.5,5.6,3.9,5.1,3.9z">
                                                    </path>
                                                    <path
                                                        d="M5.1,5.9H0.9C0.4,5.9,0,5.5,0,5v0c0-0.5,0.4-0.9,0.9-0.9h4.2C5.6,4.1,6,4.5,6,5v0C6,5.5,5.6,5.9,5.1,5.9z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'ropes-vert'" value="ropes-vert"
                                        type="qr_eye_center">
                                        <div class="w-embed">
                                            <label for="marker_in_ropes-vert"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.1,5.1V0.9C4.1,0.4,4.5,0,5,0h0c0.5,0,0.9,0.4,0.9,0.9v4.2C5.9,5.6,5.5,6,5,6h0C4.5,6,4.1,5.6,4.1,5.1z">
                                                    </path>
                                                    <path
                                                        d="M2.1,5.1V0.9C2.1,0.4,2.5,0,3,0h0c0.5,0,0.9,0.4,0.9,0.9v4.2C3.9,5.6,3.5,6,3,6h0C2.5,6,2.1,5.6,2.1,5.1z">
                                                    </path>
                                                    <path
                                                        d="M0.1,5.1V0.9C0.1,0.4,0.5,0,1,0h0c0.5,0,0.9,0.4,0.9,0.9v4.2C1.9,5.6,1.5,6,1,6h0C0.5,6,0.1,5.6,0.1,5.1z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="qr_eye_center = 'bruised'" value="bruised"
                                        type="qr_eye_center">
                                        <div class="w-embed">
                                            <label for="marker_in_bruised"
                                                class="btn btn-light p-1 me-1 mb-1 marker_center_label"><svg width="14"
                                                    height="14" viewBox="0 0 6 6" fill="currentColor"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.5,6C1.2,5.3,0.7,4.8,0,4.5v-3C0,0.7,0.7,0,1.5,0h3C4.8,0.7,5.3,1.2,6,1.5v3C6,5.3,5.3,6,4.5,6H1.5z">
                                                    </path>
                                                </svg></label>
                                        </div>
                                    </x-tw.button-select>
                                </div>
                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="logo" label="Logo" show="false">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6 md:col-span-2 mt-5">
                                    <x-tw.button-select @click="qr_logo = '',qr_custom_logo=null" value=""
                                        type="qr_logo">
                                        <svg viewBox="0 0 16 16" class="bi bi-x w-10 h-10 rounded-lg shadow-lg"
                                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                            </path>
                                        </svg>
                                    </x-tw.button-select>
                                </div>
                                @foreach (Support::readFolder(public_path('images/watermarks')) as $item)
                                <div class="col-span-6 md:col-span-2 mt-5">
                                    <x-tw.button-select @click="qr_logo = '{{ $item }}'" value="{{ $item }}"
                                        type="qr_logo">
                                        <img src="{{ asset('images/watermarks/' . $item) }}" alt="{{ $item }}"
                                            class="w-10 h-10 rounded-lg shadow-lg">
                                    </x-tw.button-select>

                                </div>
                                @endforeach


                            </div>
                            <div class="col-span-12 md:col-span-4 mt-5">
                                <x-tw.file-attachment name="qr_custom_logo" profile-class="w-24 h-24 rounded-lg"
                                    accept="image/jpg,image/jpeg,image/png">
                                    <span class="ml-2 text-gray-600">Upload logo | <span class="text-sm">PNG or
                                            JPEG</span></span>
                                </x-tw.file-attachment>
                            </div>
                            <div class="col-span-12 md:col-span-4 mt-5">
                                <x-tw.switch label="Remove background behind Logo" name="qr_logo_background" />
                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_color" label="Color" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div class="grid grid-cols-4 md:grid-cols-8  gap-4">
                                    @foreach (Support::twentyColor() as $item)
                                    <x-tw.button-select @click="qr_color = '{{ $item }}'" value="{{ $item }}"
                                        type="qr_color">
                                        <div class="w-10 h-5" style="background-color: {{ $item }}">
                                        </div>
                                    </x-tw.button-select>
                                    @endforeach
                                </div>
                                <div>
                                    <x-tw.label class="font-bold text-md mb-5 mt-10">
                                        Or
                                    </x-tw.label>
                                    <div class="grid grid-cols-1 gap-4">
                                        <x-tw.input label="Custom Color" placeholder="Custom Color" id="customColor"
                                            name="qr_color" type="color" class="col-span-2" size='lg' value="#000000" />
                                    </div>

                                </div>
                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="bgColor" label="Background Color" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div class="grid  grid-cols-4 md:grid-cols-8 gap-4">
                                    @foreach (Support::twentyColor() as $item)
                                    <x-tw.button-select @click="qr_bg_color = '{{ $item }}'" value="{{ $item }}"
                                        type="qr_bg_color">
                                        <div class="w-10 h-5" style="background-color:{{ $item }}">
                                        </div>
                                    </x-tw.button-select>
                                    @endforeach
                                </div>
                                <div>
                                    <x-tw.label class="font-bold text-md mb-5 mt-10">
                                        Or
                                    </x-tw.label>
                                    <div class="grid grid-cols-1 gap-4">
                                        <x-tw.input label="Custom Color" placeholder="Custom Color" id="customBgColor"
                                            name="qr_bg_color" type="color" class="col-span-2" size='lg'
                                            value="#ffffff" />
                                    </div>

                                </div>
                            </div>
                        </x-tw.accordion-item>

                        <x-tw.accordion-item id="qrEyeColor" label="Eye Color" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div>
                                    <div class="grid grid-cols-1 gap-4">
                                        <x-tw.input label="Color In" placeholder="Color In" id="qr_eye_color_in"
                                            name="qr_eye_color_in" type="color" class="col-span-2" size='lg'
                                            value="#000000" />
                                    </div>
                                    <div class="grid grid-cols-1 gap-4">
                                        <x-tw.input label="Color Out" placeholder="Color Out" id="qr_eye_color_out"
                                            name="qr_eye_color_out" type="color" class="col-span-2" size='lg'
                                            value="#ffffff" />
                                    </div>
                                </div>

                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_gradientColor" label="Gradient Color" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div>


                                    <div class="grid grid-cols-1 gap-4">
                                        <x-tw.input label="Color One" placeholder="Color One" id="qr_color"
                                            name="qr_color" type="color" class="col-span-2" size='lg' value="#ffffff" />
                                    </div>

                                    <x-tw.label class="font-bold text-md mb-5 mt-10">
                                        And
                                    </x-tw.label>

                                    <div class="grid grid-cols-1 gap-4">
                                        <x-tw.input label="Color Two" placeholder="Color Two" id="qr_gradient"
                                            name="qr_gradient" type="color" class="col-span-2" size='lg'
                                            value="#000000" />
                                    </div>

                                </div>
                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="qr_bg_image" label="Background Image" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div class="grid grid-cols-12 gap-4">
                                    <div class="col-span-6 md:col-span-2 mt-5">
                                        <x-tw.button-select @click="qr_bg_image = '',qr_custom_background=''" value=""
                                            type="qr_bg_image">
                                            <svg viewBox="0 0 16 16" class="bi bi-x w-10 h-10 rounded-lg shadow-lg"
                                                fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z">
                                                </path>
                                            </svg>
                                        </x-tw.button-select>
                                    </div>
                                    @foreach (Support::readFolder(public_path('images/animated-images')) as $item)
                                    <div class="col-span-6 md:col-span-2 mt-5">
                                        <x-tw.button-select @click="qr_bg_image = '{{ $item }}'" value="{{ $item }}"
                                            type="qr_bg_image">
                                            <img src="{{ asset('images/animated-images/' . $item) }}" alt="{{ $item }}"
                                                class="w-10 h-10 rounded-lg shadow-lg">
                                        </x-tw.button-select>
                                    </div>
                                    @endforeach


                                </div>
                            </div>
                            <div class="col-span-12 md:col-span-4 mt-5">
                                <x-tw.file-attachment name="qr_custom_background" profile-class="w-24 h-24 rounded-lg"
                                    accept="image/jpg,image/jpeg,image/png">
                                    <span class="ml-2 text-gray-600">Upload logo | <span class="text-sm">PNG or
                                            JPEG</span></span>
                                </x-tw.file-attachment>
                            </div>
                        </x-tw.accordion-item>
                        <x-tw.accordion-item id="frame" label="Frame" show="false">
                            <div class="col-span-12 md:col-span-8 mt-5">
                                <div class="grid grid-cols-5 gap-4">
                                    <x-tw.button-select @click="frame = 'none'" value="none" type="frame">
                                        <label for="outer_frame_none"
                                            class="btn btn-light p-1 frame_label active_label"><svg width="48"
                                                height="56" viewBox="0 0 24 24" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <polygon
                                                    points="18.7,6.6 12,13.3 5.3,6.6 4.6,7.3 11.3,14 4.6,20.7 5.3,21.4 12,14.7 18.7,21.4 19.4,20.7 12.7,14 19.4,7.3 ">
                                                </polygon>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'bottom'" value="bottom" type="frame">
                                        <label for="outer_frame_bottom" class="btn btn-light p-1 frame_label"><svg
                                                width="48" height="56" viewBox="0 0 24 29" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22.7,0H1.3C0.6,0,0,0.6,0,1.3v25.3C0,27.4,0.6,28,1.3,28h21.3c0.7,0,1.3-0.6,1.3-1.3V1.3C24,0.6,23.4,0,22.7,0 z M23,22c0,0.6-0.5,1-1,1H2c-0.6,0-1-0.5-1-1V2c0-0.6,0.5-1,1-1h20c0.6,0,1,0.5,1,1V22z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'top'" value="top" type="frame">
                                        <label for="outer_frame_top" class="btn btn-light p-1 frame_label"><svg
                                                width="48" height="56" viewBox="0 0 24 29" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.3,28L22.6,28c0.7,0,1.3-0.6,1.3-1.3L24,1.4c0-0.7-0.6-1.3-1.3-1.3L1.4,0C0.7,0,0.1,0.6,0,1.3L0,26.6 C-0.1,27.4,0.5,28,1.3,28z M1,6c0-0.6,0.5-1,1-1L22,5c0.6,0,1,0.5,1,1L23,26c0,0.6-0.5,1-1,1L2,27c-0.6,0-1-0.5-1-1L1,6z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'balloon-bottom'" value="balloon-bottom"
                                        type="frame">
                                        <label for="outer_frame_balloon-bottom"
                                            class="btn btn-light p-1 frame_label"><svg width="48" height="56"
                                                viewBox="0 0 24 31" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M1.3,24l21.3,0c0.7,0,1.3-0.6,1.3-1.3l0-21.3C24,0.6,23.4,0,22.7,0L1.3,0C0.6,0,0,0.6,0,1.3l0,21.3 C0,23.4,0.6,24,1.3,24z M1,2c0-0.6,0.5-1,1-1l20,0c0.6,0,1,0.5,1,1v20c0,0.6-0.5,1-1,1L2,23c-0.6,0-1-0.5-1-1V2z">
                                                </path>
                                                <path
                                                    d="M1,30h22c0.5,0,1-0.4,1-1v-3c0-0.5-0.4-1-1-1H13l-1-1l-1,1H1c-0.5,0-1,0.4-1,1v3C0,29.6,0.4,30,1,30z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'balloon-top'" value="balloon-top" type="frame">
                                        <label for="outer_frame_balloon-top" class="btn btn-light p-1 frame_label"><svg
                                                width="48" height="56" viewBox="0 0 24 31" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22.7,6L1.3,6C0.6,6,0,6.6,0,7.3l0,21.3C0,29.4,0.6,30,1.3,30l21.3,0c0.7,0,1.3-0.6,1.3-1.3l0-21.3 C24,6.6,23.4,6,22.7,6z M23,28c0,0.6-0.5,1-1,1L2,29c-0.6,0-1-0.5-1-1V8c0-0.6,0.5-1,1-1l20,0c0.6,0,1,0.5,1,1V28z">
                                                </path>
                                                <path
                                                    d="M23,0H1C0.4,0,0,0.4,0,1v3c0,0.5,0.4,1,1,1h10l1,1l1-1h10c0.5,0,1-0.4,1-1V1C24,0.4,23.6,0,23,0z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'ribbon-bottom'" value="ribbon-bottom"
                                        type="frame">
                                        <label for="outer_frame_ribbon-bottom"
                                            class="btn btn-light p-1 frame_label"><svg width="48" height="56"
                                                viewBox="0 0 24 28" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M24,21h-1.7V1.7H1.7V21H0l1,2l-1,2h1v2h22v-2h1l-1-2L24,21z M2,2h20v19v1H2v-1V2z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'ribbon-top'" value="ribbon-top" type="frame">
                                        <label for="outer_frame_ribbon-top" class="btn btn-light p-1 frame_label"><svg
                                                width="48" height="56" viewBox="0 0 24 28" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M0,6h1.7v19.3h20.7V6H24l-1-2l1-2h-1V0H1v2H0l1,2L0,6z M22,25H2V6V5h20v1V25z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'phone'" value="phone" type="frame">
                                        <label for="outer_frame_phone" class="btn btn-light p-1 frame_label"><svg
                                                width="48" height="56" viewBox="0 0 24 25.5" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.6,0H6.4c-1,0-1.8,0.8-1.8,1.8v20.4c0,1,0.8,1.8,1.8,1.8h11.1c1,0,1.8-0.8,1.8-1.8V1.8C19.4,0.8,18.6,0,17.6,0z M11.2,2.3h2.7c0.1,0,0.2,0.1,0.2,0.2S14,2.7,13.9,2.7h-2.7c-0.1,0-0.2-0.1-0.2-0.2S11.1,2.3,11.2,2.3z M10.1,2.3 c0.1,0,0.2,0.1,0.2,0.2s-0.1,0.2-0.2,0.2c-0.1,0-0.2-0.1-0.2-0.2S10,2.3,10.1,2.3z M19,19H5V5h14V19z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                    <x-tw.button-select @click="frame = 'cine'" value="cine" type="frame">
                                        <label for="outer_frame_cine" class="btn btn-light p-1 frame_label"><svg
                                                width="48" height="56" viewBox="0 0 24 23.9" fill="currentColor"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M4.5,4.5L4.5,4.5L4.5,4.5l0,17.2c0,0.3,0.3,0.6,0.6,0.6h13.8c0.3,0,0.6-0.3,0.6-0.6V4.5H4.5z M19,18.6
                                            c0,0.2-0.2,0.4-0.4,0.4H5.4C5.2,19,5,18.8,5,18.6V5.4C5,5.2,5.2,5,5.4,5h13.1C18.8,5,19,5.2,19,5.4V18.6z">
                                                </path>
                                                <path
                                                    d="M19.1,0.1L4.2,1.7l0.3,2.8l14.9-1.6L19.1,0.1z M6.8,3.8L4.9,4l1.7-2.1l1.9-0.2L6.8,3.8z M10.5,3.4L8.6,3.6l1.7-2.1l1.9-0.2 L10.5,3.4z M14.2,3l-1.9,0.2L14,1.1l1.9-0.2L14.2,3z M18,2.6l-1.9,0.2l1.7-2.1l0.9-0.1l0.1,0.9L18,2.6z">
                                                </path>
                                            </svg>
                                        </label>
                                    </x-tw.button-select>
                                </div>
                                <x-tw.input label="Frame Phase" placeholder="Frame Phase" id="framePhase"
                                    name="frame_label" type="text" class="col-span-2 mt-4 mb-4" size='lg'
                                    x-model="frame_label" />
                                <x-tw.select label="Frame Font" placeholder="Frame Font" id="frameFont"
                                    name="frame_label_font" class="col-span-2 mt-4"
                                    :optinons="json_encode(Support::frame_label_fonts())" />
                                <x-tw.input label="Frame Color" placeholder="Frame Color" id="frameColor"
                                    name="frame_labelTextColor" type="color" class="col-span-2 mt-4" size='lg'
                                    value="#000000" />
                            </div>
                        </x-tw.accordion-item>
                    </x-tw.accordion>
                </div>
            </div>
        </div>
    </div>

    <div class="col-span-12 md:col-span-3">
        <div class="block rounded-lg bg-white shadow-lg dark:bg-neutral-700 text-center" data-te-sticky-init
            data-te-sticky-boundary="#sticky-top" data-te-sticky-direction="both">

            <div class="border-neutral-100 px-6 py-4 dark:border-neutral-500">
                <h5 class="flex items-center justify-center text-neutral-500 dark:text-neutral-300">
                    <x-tw.label class="mr-2 font-bold text-md">
                        Preview your QR Code
                    </x-tw.label>
                </h5>
            </div>


            <div class="p-0 grid  justify-center"  wire:ignore>
                <div class=" max-w-[18rem] rounded-lgdark:bg-neutral-700 grid justify-items-center">
                    <div class="relative overflow-hidden bg-cover bg-no-repeat">

                        <div class="border-2 shadow-sm rounded-lg">
                            <div x-html="qrcodePreview" id="qrcodePreview">
                            </div>
                            <img src="{{ asset('images/placeholder.svg') }}" x-show='!qrcodePreview' alt="placeholder"
                                class="w-48 h-48 rounded-lg">
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
                    <a href="javascript:void(0)"  data-te-toggle="modal"
                    data-te-target="#loginModal"
                    data-te-ripple-init
                    data-te-ripple-color="light"
                        class="flex items-center justify-center bg-gradient-to-br rounded-lg p-2   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
                        <i class="bi bi-save text-xl"></i>
                        <span class="ml-2 font-bold text-md">
                            Save
                        </span>
                    </a>
                    @else
                    <a href="javascript:void(0)"
                        wire:click="save()"
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
