@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.add_category') }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('admin.category.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Titre <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="4" placeholder="Entrez la description de la catégorie">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="image">Photo de la Catégorie</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*">
          <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG, GIF, SVG, WEBP (Max: 90MB)</small>
          <img id="preview" src="" style="height: 5rem; margin-top: 10px; display: none;" onerror="this.onerror=null;this.src='/images/no-image.png';">
          @error('image')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Réinitialiser</button>
           <button class="btn btn-success" type="submit">Soumettre</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
@endpush
@push('scripts')
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script>
    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Écrivez la description de la catégorie.....",
          tabsize: 2,
          height: 120
      });
    });
</script>
<script>
document.getElementById('image').addEventListener('change', function(e) {
    const [file] = this.files;
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
@endpush