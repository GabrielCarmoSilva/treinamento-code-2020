@extends('admin.layouts.app')

@section('content')
    @component('admin.components.edit')
        @slot('title', 'Editar ' . $course->name)
        @slot('url', route('courses.update', $course->slug))
        @slot('form')
            @include('admin.courses.form')
        @endslot
    @endcomponent
@endsection