@props(['id', 'name', 'value' => ''])

<textarea id="{{ $id }}" name="{{ $name }}" {{ $attributes->merge(['class' => 'mt-1 block w-full']) }}>{{ old($name, $value) }}</textarea>

<input-error for="{{ $name }}" class="mt-2" />



@pushOnce('scripts')
    <script src='https://cdn.ckeditor.com/4.15.1/full-all/ckeditor.js'></script>
    <script>

        CKEDITOR.config.extraPlugins = 'codesnippet,uploadimage';
        // CKEDITOR.config.codeSnippet_theme = 'monokai_sublime';
        CKEDITOR.config.codeSnippet_languages = {
            javascript: 'JavaScript',
            php: 'PHP',
            html: 'HTML',
            css: 'CSS'
        };
        //toolbar

        CKEDITOR.config.toolbar = [
            { name: 'document', items: ['Source', '-', 'NewPage', 'Preview', '-', 'Templates'] },
            { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'] },

            { name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt'] },
            { name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'] },
            '/',
            { name: 'styles', items: ['Styles', 'Format'] },
            { name: 'justify', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},

            { name: 'basicstyles', items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
            { name: 'links', items: ['Link', 'Unlink', 'Anchor'] },
            { name: 'tools', items: ['Maximize'] },
            { name: 'others', items: ['-'] },
            { name: 'colors', items: ['TextColor', 'BGColor']},
            { name: 'custom', items: ['CodeSnippet', 'UploadImage'] },

        ];


        const editor = CKEDITOR.replace('{{ $id }}', {
            filebrowserUploadUrl: "{{ route('ckeditor.image-upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
        });
        editor.on('change', function(event) {
            @this.set('{{ $id }}', event.editor.getData());
        });






    </script>
@endpushOnce
