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
            <x-tw.input label="Custom Color" placeholder="Custom Color"
                id="customBgColor" name="qr_bg_color" type="color" class="col-span-2"
                size='lg' value="#ffffff" />
        </div>

    </div>
</div>
