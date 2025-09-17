@extends('backend.layouts.master')

@section('main-content')
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Liste des Catégories</h6>
        <a href="{{route('admin.category.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.add_category') }}"><i class="fas fa-plus"></i> {{ __('admin.add_category') }}</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($categories)>0)
            <table class="table table-bordered" id="category-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Produits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Produits</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>
                            <strong>{{$category->title}}</strong>
                            @if($category->slug)
                                <br><small class="text-muted">Slug: {{$category->slug}}</small>
                            @endif
                        </td>
                        <td>
                            @if($category->description)
                                {{ Str::limit(strip_tags($category->description), 50) }}
                            @else
                                <span class="text-muted">Aucune description</span>
                            @endif
                        </td>
                        <td>
                            @if($category->image)
                                <img src="{{ asset($category->image) }}" class="img-fluid zoom" style="max-width:80px" alt="{{$category->title}}">
                            @else
                                <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="no-image">
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-primary">{{$category->products->count()}} produits</span>
                        </td>
                        <td>
                            <a href="{{route('admin.category.products',$category->id)}}" class="btn btn-info btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Gérer les Produits" data-placement="bottom"><i class="fas fa-cogs"></i></a>
                            <a href="{{route('admin.category.edit',$category->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('admin.category.destroy',[$category->id])}}" style="display:inline-block;">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$category->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{$categories->links()}}</span>
            @else
            <h6 class="text-center">Aucune catégorie trouvée !!! Veuillez créer une catégorie</h6>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
<style>
    div.dataTables_wrapper div.dataTables_paginate{
        display: block;
        float: right;
        margin: 10px 0;
    }
    .zoom {
        transition: transform .2s; /* Animation */
    }
    .zoom:hover {
        transform: scale(3.0);
    }
</style>
@endpush

@push('scripts')
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
<script>
    $('#category-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[3,4,5]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
</script>
<script>
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
        $('.dltBtn').click(function(e){
          var form=$(this).closest('form');
            var dataID=$(this).data('id');
            // alert(dataID);
            e.preventDefault();
            swal({
                  title: "Êtes-vous sûr ?",
                  text: "Une fois supprimé, vous ne pourrez plus récupérer ces données !",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                       form.submit();
                  } else {
                      swal("Vos données sont en sécurité !");
                  }
              });
        })
    })
</script>
@endpush
