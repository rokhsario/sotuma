@extends('backend.layouts.master')
@section('title','SOTUMA || Créer un Message')
@section('main-content')

<div class="card">
    <h5 class="card-header">Créer un Message</h5>
    <div class="card-body">
        <form method="post" action="{{route('message.store')}}" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="inputTitle" class="col-form-label">Nom <span class="text-danger">*</span></label>
                <input id="inputTitle" type="text" name="name" placeholder="Entrez le nom" value="{{old('name')}}" class="form-control">
                @error('name')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-form-label">Email <span class="text-danger">*</span></label>
                <input id="inputEmail" type="email" name="email" placeholder="Entrez l'email" value="{{old('email')}}" class="form-control">
                @error('email')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputPhone" class="col-form-label">Téléphone</label>
                <input id="inputPhone" type="text" name="phone" placeholder="Entrez le téléphone" value="{{old('phone')}}" class="form-control">
                @error('phone')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputSubject" class="col-form-label">Sujet <span class="text-danger">*</span></label>
                <input id="inputSubject" type="text" name="subject" placeholder="Entrez le sujet" value="{{old('subject')}}" class="form-control">
                @error('subject')
                <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="inputMessage" class="col-form-label">Message <span class="text-danger">*</span></label>
                <textarea id="inputMessage" name="message" rows="5" placeholder="Entrez le message" class="form-control">{{old('message')}}</textarea>
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
            </div>

            <div class="form-group mb-3">
                <button type="reset" class="btn btn-warning">Réinitialiser</button>
                <button class="btn btn-success" type="submit">Créer le Message</button>
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

