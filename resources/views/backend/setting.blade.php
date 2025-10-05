@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Paramètres du Site</h5>
    <div class="card-body">
    <form method="post" action="{{route('settings.update')}}" enctype="multipart/form-data">
        @csrf 
        
        <h6 class="mb-3 text-primary">Informations Générales</h6>
        
        <div class="form-group">
          <label for="short_des" class="col-form-label">Description Courte <span class="text-danger">*</span></label>
          <textarea class="form-control" id="quote" name="short_des">{{$data->short_des}}</textarea>
          @error('short_des')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="hero_slogan" class="col-form-label">Slogan Hero</label>
          <input type="text" class="form-control" id="hero_slogan" name="hero_slogan" value="{{$data->hero_slogan ?? ''}}" placeholder="Entrez le slogan de la section hero">
          <small class="form-text text-muted">Slogan affiché dans la section hero de la page d'accueil</small>
          @error('hero_slogan')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <h6 class="mb-3 mt-4 text-primary">Images</h6>

        <div class="form-group">
          <label for="presentation_image" class="col-form-label">Image de Présentation</label>
          @if($data->presentation_image)
            <div class="mb-2">
              <img src="{{ asset($data->presentation_image) }}" alt="Image de présentation actuelle" style="max-width:300px;max-height:200px;" class="img-thumbnail">
              <p class="text-muted small">Image de présentation actuelle</p>
            </div>
          @endif
          <input type="file" name="presentation_image" class="form-control" accept="image/*">
          <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG, GIF, SVG, WEBP (Max: 90MB). Laisser vide pour conserver l'image actuelle.</small>
          @error('presentation_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <h6 class="mb-3 mt-4 text-primary">Page À propos – Images (ordre d’affichage)</h6>

        <div class="form-group">
          <label for="about_hero_bg" class="col-form-label">1) À propos – Image de fond (Hero)</label>
          @if($data->about_hero_bg)
            <div class="mb-2">
              <img src="{{ asset($data->about_hero_bg) }}" alt="Image actuelle de la page À propos" style="max-width:300px;max-height:200px;" class="img-thumbnail">
              <p class="text-muted small">Image actuelle de la page À propos</p>
            </div>
          @endif
          <input type="file" name="about_hero_bg" class="form-control" accept="image/*">
          <small class="form-text text-muted">Formats acceptés: JPEG, PNG, JPG, GIF, SVG, WEBP (Max: 90MB). Laisser vide pour conserver l'image actuelle.</small>
          @error('about_hero_bg')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="about_presentation_image" class="col-form-label">2) À propos – Image Présentation</label>
          @if($data->about_presentation_image)
            <div class="mb-2">
              <img src="{{ asset($data->about_presentation_image) }}" alt="Image Présentation actuelle" style="max-width:300px;max-height:200px;" class="img-thumbnail">
              <p class="text-muted small">Image actuelle</p>
            </div>
          @endif
          <input type="file" name="about_presentation_image" class="form-control" accept="image/*">
          @error('about_presentation_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="about_mission_image" class="col-form-label">3) À propos – Image Mission</label>
          @if($data->about_mission_image)
            <div class="mb-2">
              <img src="{{ asset($data->about_mission_image) }}" alt="Image Mission actuelle" style="max-width:300px;max-height:200px;" class="img-thumbnail">
              <p class="text-muted small">Image actuelle</p>
            </div>
          @endif
          <input type="file" name="about_mission_image" class="form-control" accept="image/*">
          @error('about_mission_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="about_objectives_image" class="col-form-label">4) À propos – Image Objectifs</label>
          @if($data->about_objectives_image)
            <div class="mb-2">
              <img src="{{ asset($data->about_objectives_image) }}" alt="Image Objectifs actuelle" style="max-width:300px;max-height:200px;" class="img-thumbnail">
              <p class="text-muted small">Image actuelle</p>
            </div>
          @endif
          <input type="file" name="about_objectives_image" class="form-control" accept="image/*">
          @error('about_objectives_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="about_expertise_image" class="col-form-label">5) À propos – Image Expertise</label>
          @if($data->about_expertise_image)
            <div class="mb-2">
              <img src="{{ asset($data->about_expertise_image) }}" alt="Image Expertise actuelle" style="max-width:300px;max-height:200px;" class="img-thumbnail">
              <p class="text-muted small">Image actuelle</p>
            </div>
          @endif
          <input type="file" name="about_expertise_image" class="form-control" accept="image/*">
          @error('about_expertise_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="about_approach_image" class="col-form-label">6) À propos – Image Approche</label>
          @if($data->about_approach_image)
            <div class="mb-2">
              <img src="{{ asset($data->about_approach_image) }}" alt="Image Approche actuelle" style="max-width:300px;max-height:200px;" class="img-thumbnail">
              <p class="text-muted small">Image actuelle</p>
            </div>
          @endif
          <input type="file" name="about_approach_image" class="form-control" accept="image/*">
          @error('about_approach_image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        

        <h6 class="mb-3 mt-4 text-primary">Informations de Contact</h6>

        <div class="form-group">
          <label for="address" class="col-form-label">Adresse <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="address" required value="{{$data->address}}">
          @error('address')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" required value="{{$data->email}}">
          @error('email')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="phone" class="col-form-label">Numéro de Téléphone <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="phone" required value="{{$data->phone}}">
          @error('phone')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>



        <h6 class="mb-3 mt-4 text-primary">Statistiques du Site</h6>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="warranty_years" class="col-form-label">Années de Garantie <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="warranty_years" required value="{{$data->warranty_years ?? 10}}" min="1" max="50">
                    @error('warranty_years')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="experience_years" class="col-form-label">Années d'Expérience <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="experience_years" required value="{{$data->experience_years ?? 15}}" min="1" max="100">
                    @error('experience_years')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                    <label for="projects_count" class="col-form-label">Nombre de Projets <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="projects_count" required value="{{$data->projects_count ?? 50}}" min="1" max="1000">
                    @error('projects_count')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group mb-3 mt-4">
           <button class="btn btn-success" type="submit">Mettre à Jour</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

@endpush
@push('scripts')
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    $(document).ready(function() {
    $('#summary').summernote({
      placeholder: "Écrivez une courte description.....",
        tabsize: 2,
        height: 150
    });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Écrivez une courte citation.....",
          tabsize: 2,
          height: 100
      });
    });
</script>
@endpush