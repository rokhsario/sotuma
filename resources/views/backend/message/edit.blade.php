@extends('backend.layouts.master')
@section('title','SOTUMA || Modifier le Message')
@section('main-content')

<div class="card">
    <h5 class="card-header">Modifier le Message</h5>
    <div class="card-body">
        <form method="post" action="{{route('message.update',$message->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Nom <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" placeholder="Entrez le nom" value="{{$message->name}}" class="form-control">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-form-label">Email <span class="text-danger">*</span></label>
                <input id="inputEmail" type="email" name="email" placeholder="Entrez l'email" value="{{$message->email}}" class="form-control">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPhone" class="col-form-label">Téléphone</label>
                <input id="inputPhone" type="text" name="phone" placeholder="Entrez le téléphone" value="{{$message->phone}}" class="form-control">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputSubject" class="col-form-label">Sujet <span class="text-danger">*</span></label>
                <input id="inputSubject" type="text" name="subject" placeholder="Entrez le sujet" value="{{$message->subject}}" class="form-control">
                @error('subject')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputMessage" class="col-form-label">Message <span class="text-danger">*</span></label>
                <textarea id="inputMessage" name="message" rows="5" placeholder="Entrez le message" class="form-control">{{$message->message}}</textarea>
                @error('message')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputAttachment" class="col-form-label">Pièce jointe</label>
                <div class="input-group">
                    <input id="inputAttachment" type="file" name="attachment" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <div class="input-group-append">
                        <span class="input-group-text">PDF, DOC, DOCX, JPG, PNG (Max 5MB)</span>
                    </div>
                </div>
                @error('attachment')
                <span class="text-danger">{{$message}}</span>
                @enderror
                
                @if($message->attachment)
                <div class="mt-2">
                    <small class="text-muted">Pièce jointe actuelle:</small>
                    <div class="d-flex align-items-center mt-1">
                        <a href="{{ asset('storage/' . $message->attachment) }}" target="_blank" class="btn btn-sm btn-info mr-2">
                            <i class="fas fa-download"></i> Télécharger
                        </a>
                        <a href="{{ route('message.attachment.delete', $message->id) }}" class="btn btn-sm btn-danger" 
                           onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pièce jointe ?')">
                            <i class="fas fa-trash"></i> Supprimer
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <div class="form-group">
                <label class="col-form-label">Statut de lecture</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="mark_as_read" id="markAsRead" {{ $message->read_at ? 'checked' : '' }}>
                    <label class="form-check-label" for="markAsRead">
                        Marquer comme lu
                    </label>
                </div>
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Réinitialiser</button>
                <button class="btn btn-success" type="submit">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('styles')
<style>
    .form-group {
        margin-bottom: 1rem;
    }
    .text-danger {
        color: #dc3545 !important;
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-color: #ced4da;
    }
</style>
@endpush

@push('scripts')
<script>
    // Handle read status update
    document.getElementById('markAsRead').addEventListener('change', function() {
        if (this.checked) {
            // You can add AJAX call here to update read status immediately
            console.log('Message marked as read');
        } else {
            console.log('Message marked as unread');
        }
    });
</script>
@endpush

