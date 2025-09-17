@extends('layouts.app')
@section('content')
<div class="container py-5">
    <h2 class="mb-4">Products (Admin)</h2>
    <a href="{{ route('products.create') }}" class="btn btn-success mb-3">Add Product</a>
    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td><img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/no-image.png') }}" style="height:60px;width:60px;object-fit:cover;"></td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->category->title ?? '' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 