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
        <h6 class="m-0 font-weight-bold text-primary float-left">Liste des Produits</h6>
        <a href="{{route('admin.product.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.add_product') }}"><i class="fas fa-plus"></i> {{ __('admin.add_product') }}</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($products)>0)
            <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Photo</th>
                        <th>Détails</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>N°</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Photo</th>
                        <th>Détails</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->category->title ?? ''}}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" class="img-fluid zoom" style="max-width:80px" alt="{{$product->title}}">
                            @else
                                <img src="{{asset('backend/img/thumbnail-default.jpg')}}" class="img-fluid" style="max-width:80px" alt="no-image">
                            @endif
                        </td>
                        <td>
                            @if($product->has_details)
                                <span class="badge badge-success">Oui</span>
                            @else
                                <span class="badge badge-secondary">Non</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Modifier" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('admin.product.destroy',[$product->id])}}" style="display:inline-block;">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$product->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <span style="float:right">{{$products->links()}}</span>
            @else
            <h6 class="text-center">Aucun produit trouvé !!! Veuillez créer un produit</h6>
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
        display: none;
    }
    .zoom {
        transition: transform .2s; /* Animation */
    }
    .zoom:hover {
        transform: scale(2.5);
    }
</style>
@endpush

@push('scripts')
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$('#product-dataTable').DataTable( {
    "scrollX": false
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
        $(document).on('click', '.dltBtn', function(e){
            e.preventDefault();
            console.log('Delete button clicked!'); // Debug log
            
            // Test if SweetAlert is loaded
            if (typeof Swal === 'undefined') {
                alert('SweetAlert not loaded! Using fallback.');
                if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
                    $(this).closest('form').submit();
                }
                return;
            }
            
            var form=$(this).closest('form');
            var dataID=$(this).data('id');
            console.log('Product ID:', dataID); // Debug log
            
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Une fois supprimé, vous ne pourrez plus récupérer ces données !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
                cancelButtonText: 'Annuler'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log('Form submitting...'); // Debug log
                    form.submit();
                }
            });
        })
    })
</script>
@endpush
