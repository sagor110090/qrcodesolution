@props(['id', 'name', 'value' => ''])

<textarea id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'mt-1 block w-full']) }}>{{ old($name, $value) }}</textarea>

<input-error for="{{ $name }}" class="mt-2" />



@pushOnce('scripts')
    <script>
        document.addEventListener('live d', function() {
            const editor = CKEDITOR.replace('{{ $id }}', {
                filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form',
            });
            editor.on('change', function(event) {
                @this.set('{{ $id }}', event.editor.getData());
            });
        })
    </script>
@endpushOnce
