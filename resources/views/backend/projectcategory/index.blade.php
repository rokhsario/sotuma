@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Liste des Catégories de Projets</h6>
        <a href="{{route('admin.projectcategory.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.add_category') }} de Projet"><i class="fas fa-plus"></i> {{ __('admin.add_category') }}</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($categories)>0)
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>S.N.</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>
                            @if($category->image)
                            <img src="{{asset($category->image)}}" alt="{{$category->name}}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                            @else
                            <span class="text-muted">Aucune image</span>
                            @endif
                        </td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->slug}}</td>
                        <td>{{Str::limit($category->description, 50)}}</td>
                        <td>
                            <a href="{{route('admin.projectcategory.edit',$category->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="modifier" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('admin.projectcategory.destroy',[$category->id])}}" style="display:inline-block;">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$category->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{$categories->links()}}</span>
            @else
            <h6 class="text-center">Aucune catégorie de projet trouvée ! Veuillez en créer une.</h6>
            @endif
        </div>
    </div>
</div>
@endsection 