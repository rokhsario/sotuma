@extends('backend.layouts.master')
@section('main-content')
<div class="card">
  <h5 class="card-header">Message</h5>
  <div class="card-body">
    @if($message)
        <div class="py-4">From: <br>
           Name :{{$message->name}}<br>
           Email :{{$message->email}}<br>
           Phone :{{$message->phone}}
        </div>
        @if($message->attachment)
    <div class="mb-3">
        <h6>Pièce jointe:</h6>
        <div class="d-flex align-items-center">
            <a href="{{ route('message.download', $message->id) }}" class="btn btn-info mr-2">
                <i class="fas fa-download"></i> Télécharger
            </a>
            <a href="{{ route('message.attachment.delete', $message->id) }}" class="btn btn-danger" 
               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pièce jointe ?')">
                <i class="fas fa-trash"></i> Supprimer
            </a>
        </div>
        <small class="text-muted">Fichier: {{ basename($message->attachment) }}</small>
    </div>
@endif
        <hr/>
  <h5 class="text-center" style="text-decoration:underline"><strong>Subject :</strong> {{$message->subject}}</h5>
        <p class="py-5">{{$message->message}}</p>

    @endif

  </div>
</div>
@endsection