<div class="row">
    <div class="form-group col-12">
        <label for="name" class="required">Nome </label>
        <input type="text" name="name" id="name" required class="form-control" autofocus value="{{ old('name', $course->name )}}">
    </div>
    <div class="form-group col-12">
        <label for="slug" class="required">Slug </label>
        <input type="text" name="slug" id="slug" required class="form-control" autofocus value="{{ old('slug', $course->slug )}}">
    </div>
    <div class="form-group col-12">
        <label for="image_link">Imagem </label><br>
        @if(Route::is('courses.show'))
            <img class="img-fluid" src={{ asset('storage/' . $course->image_link) }} width="400" height="400">
        @else    
            <input type="file" name="image_link" id="image_link" autofocus>
        @endif
    </div>
    <div class="form-group col-12">
        @if(Route::is('courses.show'))
            <label for="video">Vídeo </label><br>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{ $video_link }}" allowfullscreen></iframe>
            </div>    
        @else    
            <label for="video" class="required">Link do vídeo </label>
            <input type="text" name="video" id="video" required class="form-control" autofocus value="{{ old('video', $course->video )}}">
        @endif
    </div>
    <div class="form-group col-12">
        <label for="client" class="required">Categoria </label>
        <select class="form-control select2" name="category_id" required value="{{ old('category_id', $course->category_id) }}">
            <option></option>
            @foreach($categories as $category)
                @if((Route::is('courses.edit') || Route::is('courses.show')) && $category->id === $course->category_id)
                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                @else
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif    
            @endforeach
        </select>
    </div>
    <div class="form-group col-12">
        <label for="description" class="required">Descrição do curso </label>
        @if(Route::is('courses.edit') || Route::is('courses.create'))
            <textarea name="description" id="description" required class="form-control summernote">{!! $course->description !!}</textarea>
        @else
            <div class="border-html">
                <p class="pl-1">{!! $course->description !!}</p>
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){

            $(".summernote").summernote();

            $(function() {
                $('.select2').select2();
            });

            $(function() {
                $('select').select2({
                    placeholder: 'Selecione uma categoria',
                    allowClear: true
                });
            });
        });
    </script>
@endpush