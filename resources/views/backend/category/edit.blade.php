@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Edit Category</h5>
    <div class="card-body">
      <form method="post" action="{{route('admin.category.update',$category->id)}}" enctype="multipart/form-data">
        @csrf 
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Enter title"  value="{{$category->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter category description">{{$category->description}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="image">Category Photo</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*">
          <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG, GIF, SVG, WEBP (Max: 90MB). Laisser vide pour conserver l'image actuelle.</small>
          @if($category->image)
              <img id="current-photo" src="{{ asset($category->image) }}" style="height: 5rem; margin-top: 10px;" onerror="this.onerror=null;this.src='/images/no-image.png';">
          @endif
          <img id="preview" src="" style="height: 5rem; margin-top: 10px; display: none;" onerror="this.onerror=null;this.src='/images/no-image.png';">
          @error('image')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group mb-3">
           <button class="btn btn-success" type="submit">Update</button>
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
            placeholder: "Write category description.....",
            tabsize: 2,
            height: 150
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