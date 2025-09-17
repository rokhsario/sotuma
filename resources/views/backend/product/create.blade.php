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