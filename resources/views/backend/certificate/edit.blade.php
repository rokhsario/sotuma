@extends('backend.layouts.master')

@section('main-content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Editer le certificat</h1>
        <a href="{{ route('admin.certificate.index') }}" class="btn btn-secondary">Retour à la liste</a>
    </div>
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modifier le certificat</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.certificate.update', $certificate->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="title">Titre <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" value="{{ $certificate->title }}" required>
                            @error('title')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-form-label">Image</label>
                            @if($certificate->image)
                                <div class="mb-2">
                                    <img src="{{ asset($certificate->image) }}" alt="{{ $certificate->title }}" style="max-width:200px;max-height:200px;" class="img-thumbnail">
                                    <p class="text-muted small">Image actuelle</p>
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG, GIF, SVG, WEBP (Max: 50MB). Laisser vide pour conserver l'image actuelle.</small>
                            @error('image')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $certificate->description }}</textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 