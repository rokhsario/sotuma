@extends('backend.layouts.master')
@section('main-content')
<div class="card">
  <div class="row">
    <div class="col-md-12">
       @include('backend.layouts.notification')
    </div>
  </div>
  <h5 class="card-header">
    {{ __('admin.messages') }}
    <a href="{{route('message.create')}}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" data-placement="bottom" title="Créer un Message">
      <i class="fas fa-plus"></i> Créer un Message
    </a>
  </h5>
  <div class="card-body">
    @if(count($messages)>0)
    <table class="table message-table" id="message-dataTable">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Subject</th>
          <th scope="col">Attachment</th>
          <th scope="col">Date</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ( $messages as $message)

        <tr class="@if($message->read_at) border-left-success @else bg-light border-left-warning @endif">
          <td scope="row">{{$loop->index +1}}</td>
          <td>{{$message->name}} {{$message->read_at}}</td>
          <td>{{$message->subject}}</td>
          <td>
              @if($message->attachment)
                  <div class="d-flex align-items-center">
                      <a href="{{ route('message.download', $message->id) }}" class="btn btn-sm btn-info mr-1" title="Télécharger la pièce jointe">
                          <i class="fas fa-download"></i> Télécharger
                      </a>
                      <a href="{{ route('message.attachment.delete', $message->id) }}" class="btn btn-sm btn-danger" 
                         onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pièce jointe ?')" title="Supprimer la pièce jointe">
                          <i class="fas fa-trash"></i>
                      </a>
                  </div>
              @else
                  <span class="text-muted">Aucune pièce jointe</span>
              @endif
          </td>
          <td>{{$message->created_at->format('F d, Y h:i A')}}</td>
          <td>
            <div class="d-flex align-items-center">
                <a href="{{route('message.show',$message->id)}}" class="btn btn-primary btn-sm mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Voir" data-placement="bottom">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{route('message.edit',$message->id)}}" class="btn btn-warning btn-sm mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Modifier" data-placement="bottom">
                    <i class="fas fa-edit"></i>
                </a>
                <form method="POST" action="{{route('message.destroy',[$message->id])}}" class="d-inline">
                  @csrf 
                  @method('delete')
                  <button class="btn btn-danger btn-sm dltBtn" data-id={{$message->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Supprimer">
                      <i class="fas fa-trash-alt"></i>
                  </button>
                </form>
            </div>
          </td>
        </tr>

        @endforeach
      </tbody>
    </table>
    <nav class="blog-pagination justify-content-center d-flex">
      {{$messages->links()}}
    </nav>
    @else
      <h2>{{ __('admin.messages') }} Empty!</h2>
    @endif
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
        transform: scale(3.2);
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
      
      $('#message-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[4]
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
                  title: "Are you sure?",
                  text: "Once deleted, you will not be able to recover this data!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                  if (willDelete) {
                    form.submit();
                  } else {
                      swal("Your data is safe!");
                  }
              });
        })
    })
  </script>
@endpush