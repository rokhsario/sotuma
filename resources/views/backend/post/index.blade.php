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
      <h6 class="m-0 font-weight-bold text-primary float-left">Liste des {{ __('admin.media') }}</h6>
      <a href="{{route('post.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Ajouter un Média"><i class="fas fa-plus"></i> Ajouter un Média</a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($posts)>0)
        <table class="table table-bordered" id="product-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>N°</th>
              <th>Titre</th>
              <th>Catégorie</th>
              <th>Auteur</th>
              <th>Media</th>
              <th>Statut</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>N°</th>
              <th>Titre</th>
              <th>Catégorie</th>
              <th>Auteur</th>
              <th>Media</th>
              <th>Statut</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
           
            @foreach($posts as $post)   
              @php 
              $author_info=DB::table('users')->select('name')->where('id',$post->added_by)->get();
              // dd($sub_cat_info);
              // dd($author_info);

              @endphp
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->cat_info->title}}</td>

                    <td>
                      @foreach($author_info as $data)
                          {{$data->name}}
                      @endforeach
                    </td>
                    <td>
                        @if($post->first_media)
                            @if($post->first_media->isVideo())
                                <video class="img-fluid zoom" style="max-width:80px; height:60px; object-fit:cover;" controls>
                                    <source src="{{ asset($post->first_media->image) }}" type="video/{{ $post->first_media->file_extension }}">
                                    Your browser does not support the video tag.
                                </video>
                            @else
                                <img src="{{ asset($post->first_media->image) }}" class="img-fluid zoom" style="max-width:80px" alt="{{$post->title}}">
                            @endif
                        @elseif($post->photo)
                            <img src="{{ asset($post->photo) }}" class="img-fluid zoom" style="max-width:80px" alt="{{$post->title}}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width:80px; height:60px; border-radius:4px;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                        @endif
                    </td>                   
                    <td>
                        @if($post->status=='active')
                            <span class="badge badge-success">{{$post->status}}</span>
                        @else
                            <span class="badge badge-warning">{{$post->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('post.edit',$post->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{route('post.destroy',[$post->id])}}">
                      @csrf 
                      @method('delete')
                          <button class="btn btn-danger btn-sm dltBtn" data-id={{$post->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>  
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{$posts->links()}}</span>
        @else
          <h6 class="text-center">Aucun média trouvé !!! Veuillez créer un média</h6>
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
        transform: scale(5);
      }
      
      /* Video preview styling */
      video.zoom {
        border-radius: 4px;
        background: #f8f9fa;
      }
      
      video.zoom:hover {
        transform: scale(3);
        z-index: 1000;
        position: relative;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>
      
      $('#product-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8,9,10]
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