@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">{{ __('admin.add_product') }}</h5>
    <div class="card-body">
      <form method="post" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Titre <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{old('title')}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="title_break_index" class="col-form-label">Rupture du titre (après le N-ième mot)</label>
          <input id="title_break_index" type="number" name="title_break_index" min="0" step="1" value="{{ old('title_break_index') }}" class="form-control" placeholder="Ex: 2 pour couper après 2 mots">
          <small class="form-text text-muted">Définit où couper le titre en 2 lignes. L'ordre des mots reste identique.</small>
          @error('title_break_index')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="title_break_index_2" class="col-form-label">Deuxième rupture (optionnelle)</label>
          <input id="title_break_index_2" type="number" name="title_break_index_2" min="0" step="1" value="{{ old('title_break_index_2') }}" class="form-control" placeholder="Ex: 4 pour une 3ème ligne">
          <small class="form-text text-muted">Laisser vide pour n'utiliser que 2 lignes. Doit être supérieur à la première rupture.</small>
          @error('title_break_index_2')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label class="col-form-label">Aperçu du titre sur la carte produit</label>
          <div id="titleSplitPreview"></div>
        </div>

        <div class="form-group">
          <label class="col-form-label">Réglage par glisser (entre les mots)</label>
          <div id="titleSplitChips" style="display:flex; flex-wrap:wrap; gap:6px; align-items:center;"></div>
          <div style="display:flex; gap:10px; align-items:center; margin-top:8px;">
            <div style="flex:1;">
              <label style="font-size:12px; margin:0;">Rupture 1</label>
              <input id="title_break_slider" type="range" min="0" max="0" step="1" value="0" class="form-control"/>
            </div>
            <div style="flex:1;">
              <label style="font-size:12px; margin:0;">Rupture 2 (optionnelle)</label>
              <input id="title_break_slider_2" type="range" min="0" max="0" step="1" value="0" class="form-control"/>
            </div>
          </div>
          <small class="form-text text-muted">Glissez pour choisir 1 ou 2 coupures. Cliquer sur un mot place la coupure après ce mot.</small>
        </div>

        <div class="form-group">
          <label class="col-form-label">Contrôle manuel des 3 lignes (prioritaire)</label>
          <input type="text" name="title_line1" class="form-control mb-2" placeholder="Ligne 1 (laisser vide pour ignorer)" value="{{ old('title_line1') }}">
          <input type="text" name="title_line2" class="form-control mb-2" placeholder="Ligne 2 (laisser vide pour ignorer)" value="{{ old('title_line2') }}">
          <input type="text" name="title_line3" class="form-control" placeholder="Ligne 3 (laisser vide pour ignorer)" value="{{ old('title_line3') }}">
          <small class="form-text text-muted">Si vous remplissez ces champs, ils remplacent les coupures automatiques. Vous pouvez laisser une ligne vide, n'utiliser qu'une ligne, etc.</small>
        </div>

        <div class="form-group">
          <label for="category_id">Catégorie <span class="text-danger">*</span></label>
          <select name="category_id" id="category_id" class="form-control">
              <option value="">--Sélectionnez une catégorie--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}'>{{$cat_data->title}}</option>
              @endforeach
          </select>
          @error('category_id')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group d-none" id="child_cat_div">
          <label for="child_cat_id">Sous-catégorie</label>
          <select name="child_cat_id" id="child_cat_id" class="form-control">
              <option value="">--Sélectionnez une sous-catégorie--</option>
          </select>
        </div>

        <div class="form-group">
          <label for="image" class="col-form-label">Image du Produit</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*">
          <img id="preview" src="" style="height: 5rem; margin-top: 10px; display: none;" onerror="this.onerror=null;this.src='/images/no-image.png';">
          @error('image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="has_details" id="has_details" value="1">
            <label class="form-check-label" for="has_details">
              A une Page de Détails
            </label>
          </div>
          <small class="form-text text-muted">Cochez cette case si le produit doit avoir une page de description détaillée</small>
        </div>

        <div class="form-group" id="description_group" style="display: none;">
          <label for="description" class="col-form-label">Description</label>
          <textarea id="description" name="description" placeholder="Entrez la description du produit" class="form-control" rows="8">{{old('description')}}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group">
          <button class="btn btn-success" type="submit">Soumettre</button>
        </div>
      </form>
    </div>
</div>

<script>
document.getElementById('image').addEventListener('change', function(e) {
    const [file] = this.files;
    if (file) {
        const preview = document.getElementById('preview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});

document.getElementById('has_details').addEventListener('change', function() {
    const descriptionGroup = document.getElementById('description_group');
    if (this.checked) {
        descriptionGroup.style.display = 'block';
    } else {
        descriptionGroup.style.display = 'none';
    }
});

// Live preview + slider/chips (same as edit)
function renderTitlePreview() {
    const title = document.getElementById('inputTitle').value || '';
    const idx = parseInt(document.getElementById('title_break_index').value, 10);
    const preview = document.getElementById('titleSplitPreview');
    if (!preview) return;
    const words = title.trim().split(/\s+/).filter(Boolean);
    if (!words.length) { preview.innerHTML=''; return; }
    let line1 = title, line2 = '';
    if (!isNaN(idx) && idx > 0 && idx < words.length) {
        line1 = words.slice(0, idx).join(' ');
        line2 = words.slice(idx).join(' ');
    } else {
        const half = Math.ceil(words.length / 2);
        line1 = words.slice(0, half).join(' ');
        line2 = words.slice(half).join(' ');
    }
    const remaining = (line2 || '').trim().length ? (line2.split(/\s+/)) : [];
    let l2 = line2, l3 = '';
    if (remaining.length > 1) {
        const half2 = Math.ceil(remaining.length / 2);
        l2 = remaining.slice(0, half2).join(' ');
        l3 = remaining.slice(half2).join(' ');
    }
    preview.innerHTML = '<div style="border:1px dashed #ddd;border-radius:6px;padding:10px;text-align:center;max-width:520px;">'
        + (line1 ? '<div style="font-weight:700;">' + line1 + '</div>' : '')
        + (l2 ? '<div style="font-weight:700;">' + l2 + '</div>' : '')
        + (l3 ? '<div style="font-weight:700;">' + l3 + '</div>' : '')
        + '</div>';
}

function initSplitControls() {
    const titleInput = document.getElementById('inputTitle');
    const slider = document.getElementById('title_break_slider');
    const slider2 = document.getElementById('title_break_slider_2');
    const indexInput = document.getElementById('title_break_index');
    const indexInput2 = document.getElementById('title_break_index_2');
    const chips = document.getElementById('titleSplitChips');
    if (!titleInput || !slider || !indexInput || !chips) return;

    function rebuild() {
        const words = (titleInput.value || '').trim().split(/\s+/).filter(Boolean);
        const maxIndex = Math.max(0, words.length - 1);
        slider.max = String(maxIndex);
        slider2.max = String(maxIndex);
        const idx = Math.max(0, Math.min(parseInt(indexInput.value || '0', 10) || 0, maxIndex));
        slider.value = String(idx);
        indexInput.value = String(idx);
        let idx2 = Math.max(0, Math.min(parseInt(indexInput2.value || '0', 10) || 0, maxIndex));
        if (idx2 <= idx) idx2 = 0;
        slider2.value = String(idx2);
        indexInput2.value = String(idx2 || '');
        chips.innerHTML = '';
        words.forEach((w, i) => {
            const chip = document.createElement('button');
            chip.type = 'button';
            chip.textContent = w;
            chip.style.cssText = 'border:1px solid #ddd;border-radius:14px;padding:4px 10px;background:#f8f9fa;cursor:pointer;line-height:1;';
            if (i === idx - 1 || (i === idx2 - 1 && idx2 > 0)) {
                chip.style.borderColor = '#28a745';
            }
            chip.addEventListener('click', () => {
                const newIdx = Math.min(i + 1, maxIndex);
                if (!idx || newIdx <= idx) {
                    slider.value = String(newIdx);
                    indexInput.value = String(newIdx);
                } else {
                    slider2.value = String(newIdx);
                    indexInput2.value = String(newIdx);
                }
                renderTitlePreview();
                rebuild();
            });
            chips.appendChild(chip);
        });
    }

    slider.addEventListener('input', () => {
        indexInput.value = slider.value;
        renderTitlePreview();
        rebuild();
    });
    indexInput.addEventListener('input', () => {
        slider.value = indexInput.value || '0';
        renderTitlePreview();
        rebuild();
    });
    slider2.addEventListener('input', () => {
        if (parseInt(slider2.value, 10) <= parseInt(slider.value, 10)) {
            slider2.value = slider.value;
        }
        indexInput2.value = slider2.value;
        renderTitlePreview();
        rebuild();
    });
    indexInput2.addEventListener('input', () => {
        slider2.value = indexInput2.value || '0';
        renderTitlePreview();
        rebuild();
    });
    titleInput.addEventListener('input', () => { renderTitlePreview(); rebuild(); });
    document.addEventListener('DOMContentLoaded', () => { renderTitlePreview(); rebuild(); });
}

document.addEventListener('DOMContentLoaded', () => {
    renderTitlePreview();
    initSplitControls();
});
</script>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
  $('#category_id').change(function(){
    var cat_id=$(this).val();
    // alert(cat_id);
    if(cat_id !=null){
      // Ajax call
      $.ajax({
        url:"/admin/category/"+cat_id+"/child",
        data:{
          _token:"{{csrf_token()}}",
          id:cat_id
        },
        type:"POST",
        success:function(response){
          if(typeof(response) !='object'){
            response=$.parseJSON(response)
          }
          // console.log(response);
          var html_option="<option value=''>----Sélectionnez une sous-catégorie----</option>"
          if(response.status){
            var data=response.data;
            // alert(data);
            if(response.data){
              $('#child_cat_div').removeClass('d-none');
              $.each(data,function(id,title){
                html_option +="<option value='"+id+"'>"+title+"</option>"
              });
            }
            else{
            }
          }
          else{
            $('#child_cat_div').addClass('d-none');
          }
          $('#child_cat_id').html(html_option);
        }
      });
    }
    else{
    }
  })
</script>
@endpush