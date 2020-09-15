@extends('admin.layouts.app')

@section('content')
    @component('admin.components.table')
        @slot('title', 'Listagem de cursos')
        @slot('create', route('courses.create'))
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
                        <form enctype="multipart/form-data" action="{{ route('courses.register', $course->slug) }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ Auth::user()->id }}" id="user" name="user">
                            @if(!(Auth::user()->containsCourse($course)))
                                <input type="hidden" name="register" id="register" class="form-control" value="1">
                                <button type="submit" class="btn btn-success"><i class="fas fa-clipboard-check"></i></button>
                            @else
                                <input type="hidden" name="register" id="register" class="form-control" required value="0">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-clipboard-check"></i></button>
                            @endif    
                        </form>
                        <a href="{{ route('courses.edit', $course->slug) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a>
                        <a href="{{ route('courses.show', $course->slug) }}" class="btn btn-dark"><i class="fas fa-search"></i></a>
                        <form action="{{ route('courses.destroy', $course->slug) }}" class="form-delete" method="post" >
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
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
    