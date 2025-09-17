@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Modifier le Produit</h5>
    <div class="card-body">
      <form method="post" action="{{route('admin.product.update',$product->id)}}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="inputTitle" class="col-form-label">Titre <span class="text-danger">*</span></label>
          <input id="inputTitle" type="text" name="title" placeholder="Entrez le titre"  value="{{$product->title}}" class="form-control">
          @error('title')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <label for="category_id">Catégorie <span class="text-danger">*</span></label>
          <select name="category_id" id="category_id" class="form-control">
              <option value="">--Sélectionnez une catégorie--</option>
              @foreach($categories as $key=>$cat_data)
                  <option value='{{$cat_data->id}}' {{(($product->category_id==$cat_data->id)? 'selected' : '')}}>{{$cat_data->title}}</option>
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
          @if($product->image)
            <img src="{{ asset($product->image) }}" style="height: 5rem; margin-top: 10px;" onerror="this.onerror=null;this.src='/images/no-image.png';">
          @endif
          <img id="preview" src="" style="height: 5rem; margin-top: 10px; display: none;" onerror="this.onerror=null;this.src='/images/no-image.png';">
          @error('image')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="has_details" id="has_details" value="1" {{ $product->has_details ? 'checked' : '' }}>
            <label class="form-check-label" for="has_details">
              A une Page de Détails
            </label>
          </div>
          <small class="form-text text-muted">Cochez cette case si le produit doit avoir une page de description détaillée</small>
        </div>

        <div class="form-group" id="description_group" style="{{ $product->has_details ? 'display: block;' : 'display: none;' }}">
          <label for="description" class="col-form-label">Description</label>
          <textarea id="description" name="description" placeholder="Entrez la description du produit" class="form-control" rows="8">{{ $product->description }}</textarea>
          @error('description')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <div class="form-group">
          <button class="btn btn-success" type="submit">Mettre à jour</button>
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
  var  child_cat_id='{{$product->child_cat_id}}';
        // alert(child_cat_id);
        $('#category_id').change(function(){
            var cat_id=$(this).val();

            if(cat_id !=null){
                // ajax call
                $.ajax({
                    url:"/admin/category/"+cat_id+"/child",
                    type:"POST",
                    data:{
                        _token:"{{csrf_token()}}"
                    },
                    success:function(response){
                        if(typeof(response)!='object'){
                            response=$.parseJSON(response);
                        }
                        var html_option="<option value=''>--Sélectionnez une option--</option>";
                        if(response.status){
                            var data=response.data;
                            if(response.data){
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data,function(id,title){
                                    html_option += "<option value='"+id+"' "+(child_cat_id==id ? 'selected ' : '')+">"+title+"</option>";
                                });
                            }
                            else{
                                $('#child_cat_div').addClass('d-none');
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
        });
        if(child_cat_id !=null){
            $('#category_id').change();
        }
</script>
@endpush