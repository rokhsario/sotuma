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
                            <label for="title">Titre</label>
                            <input type="text" name="title" class="form-control" value="{{ $certificate->title }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image actuelle</label><br>
                            <img src="{{ asset('storage/' . $certificate->image) }}" alt="{{ $certificate->title }}" width="120" class="mb-2">
                            <input type="file" name="image" class="form-control-file">
                            <small class="form-text text-muted">Laisser vide pour conserver l'image actuelle.</small>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control" rows="4" required>{{ $certificate->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 