<div class="grid grid-cols-3 gap-4 p-2" x-data="{ imageType: '', qrcodePreview: '',download(imageType) {
    if (imageType === 'svg') {
        let svg = document.querySelector('#qrcodePreview svg');
        let data = new XMLSerializer().serializeToString(svg);
        let downloadLink = document.createElement('a');
        downloadLink.download = 'qrcode.' + imageType;
        downloadLink.href = 'data:image/svg+xml;base64,' + btoa(data);
        downloadLink.click();
    } else if (imageType === 'png') {
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

    } else if (imageType === 'jpeg') {
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
    imageType = '';


    } }">
    <div class="cursor-pointer" @click="download('png')">
        <div
            class="border flex items-center text-sm justify-center bg-gradient-to-br rounded p-1   from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100 ">
            PNG
        </div>
    </div>
    <div class="cursor-pointer" @click="download('jpeg')">
        <div
            class="border flex items-center text-sm justify-center bg-gradient-to-br rounded p-1 from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
            JPEG
        </div>
    </div>
    <div class="cursor-pointer" @click="download('svg')">
        <div
            class="border flex items-center text-sm justify-center bg-gradient-to-br rounded p-1 from-gray-200 to-gray-200 hover:from-gray-300 hover:to-gray-300 dark:from-gray-700 dark:to-gray-700 dark:hover:from-gray-600 dark:hover:to-gray-600 text-neutral-900 dark:text-neutral-100">
            SVG
        </div>
    </div>

</div>
