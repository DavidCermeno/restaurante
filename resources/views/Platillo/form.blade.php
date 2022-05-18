@if (count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="nombre">Nombre: </label>
    <input type="text" class="form-control" name="nombre" value="{{ isset($platillo->nombre)?$platillo->nombre:old('nombre') }}" id="nombre" >
    
</div>
<div class="form-group">
    <label for="apellido">Descripción: </label>
    <input type="text" class="form-control" name="descripcion" value="{{ isset($platillo->descripcion)?$platillo->descripcion:old('descripcion') }}" id="descripcion" >
    
</div>
<div class="form-group">
    <label for="foto">Foto: </label>
    @if (isset($platillo->foto))
        <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$platillo->foto }}" width="100px" alt="">
    @endif
    <input type="file" class="form-control-file" name="foto" id="foto">
    
    
</div>
<div class="form-group">
<input type="submit" class="btn btn-success" value="{{ $modo }} platillo">
<a href="{{ url('platillo/') }}" class="btn btn-outline-success">Regresar</a>
</div>