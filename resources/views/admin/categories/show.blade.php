@extends('admin.layouts.app')

@section('content')
    @component('admin.components.show')
        @slot('title', $category->name)
        @slot('form')
            @include('admin.categories.form')
        @endslot
    @endcomponent
@endsection

@push('scripts')
    <script>
        $('.form-control').attr('readonly', true);
    </script>
@endpush