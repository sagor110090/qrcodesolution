@props(['id', 'name', 'value' => ''])

<textarea
id="{{$id}}"
name="{{$name}}"
{{ $attributes->merge(['class' => 'mt-1 block w-full']) }}


>{{old($name, $value)}}</textarea>

<input-error for="{{$name}}" class="mt-2" />


@pushOnce('styles')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpushOnce

@pushOnce('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
     document.addEventListener('DOMContentLoaded', function () {

    $('#{{$id}}').summernote({
      placeholder: 'Enter Description',
      //extranal css
        codemirror: { // codemirror options
            theme: 'monokai'
        },
      tabsize: 2,
      height: 200,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['codeview']]
      ],
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('{{$id}}', contents);
            }
        }
    });
});
  </script>
@endpushOnce
