@extends('backend.layouts.master')

@section('main-content')
<div class="card">
    <h5 class="card-header">Modifier la Catégorie de Projet</h5>
    <div class="card-body">
        <form method="post" action="{{route('admin.projectcategory.update',$category->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="inputName" class="col-form-label">Nom <span class="text-danger">*</span></label>
                <input id="inputName" type="text" name="name" placeholder="Entrez le nom de la catégorie" value="{{$category->name}}" class="form-control">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="inputDescription" class="col-form-label">Description</label>
                <textarea id="inputDescription" name="description" placeholder="Entrez la description de la catégorie" class="form-control" rows="4">{{$category->description}}</textarea>
                @error('description')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="inputImage" class="col-form-label">Image</label>
                @if($category->image)
                <div class="mb-2">
                    <img src="{{asset($category->image)}}" alt="{{$category->name}}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 4px;">
                </div>
                @endif
                <input id="inputImage" type="file" name="image" class="form-control">
                @error('image')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="inputSortOrder" class="col-form-label">Ordre d'affichage</label>
                <input id="inputSortOrder" type="number" name="sort_order" placeholder="0" value="{{$category->sort_order}}" class="form-control" min="0">
                @error('sort_order')
                <span class="text-danger">{{$message}}</span>
                @enderror
                <small class="form-text text-muted">Plus le nombre est petit, plus la catégorie apparaîtra en premier.</small>
            </div>
            
            <div class="form-group mb-3">
                <button class="btn btn-success" type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>
@endsection 