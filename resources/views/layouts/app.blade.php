@extends('adminlte::page')

@section('meta_tags')
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
@stop

@push('js')
    <script type="text/javascript">
        $(".select2").select2();
    </script>
@endpush

@section('footer')
    Footer
@stop
