@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Categories (Admin)</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3">Add Category</a>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td><img src="{{ $category->image ? asset('storage/'.$category->image) : asset('images/no-image.png') }}" style="height:60px;width:60px;object-fit:cover;"></td>
                    <td>{{ $category->title }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 