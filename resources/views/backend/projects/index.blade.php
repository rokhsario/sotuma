@extends('backend.layouts.master')
@section('title','SOTUMA || Projets')
@section('main-content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid">
    @include('backend.layouts.notification')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Projets</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Ajouter un projet</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>
                                @if($project->image)
                                    <img src="{{ asset($project->image) }}" alt="image" width="80" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Aucune image</span>
                                @endif
                            </td>
                            <td>{{ $project->title }}</td>
                            <td style="max-width:300px;">{{ Str::limit($project->description, 100) }}</td>
                            <td>
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-info">Voir</a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce projet ?')">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">{{ $projects->links() }}</div>
            </div>
        </div>
    </div>
</div>
@endsection 