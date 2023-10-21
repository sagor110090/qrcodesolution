<div>
    {!! $chart->container() !!}
</div>


@push('scripts')
<script src="{{ $chart->cdn() }}"></script>

{{ $chart->script() }}

@endpush
