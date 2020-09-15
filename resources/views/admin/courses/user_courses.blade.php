@extends('admin.layouts.app')

@section('content')
    @component('admin.components.table')
        @slot('title', 'Meus cursos')
        @slot('head')
            <th>Nome</th>
            <th>Categoria</th>
            <th>Imagem</th>
            <th></th>
        @endslot
        @slot('body')
            @foreach($courses as $course)
                <tr>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->category->name }}</td>
                    <td><img src="{{ asset('storage/' . $course->image_link) }}" width="50" height="50"></td>
                    <td class="options">
                        <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-dark"><i class="fas fa-search"></i></a>
                    </td>
                </tr>
            @endforeach  
        @endslot
    @endcomponent
@endsection

@push('scripts')
    <script src="{{ asset('js/components/dataTable.js') }}"></script>
    <script src="{{ asset('js/components/sweetAlert.js') }}"></script>
@endpush
    