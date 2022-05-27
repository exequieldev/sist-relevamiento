@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sd-6 col-xs-12">
      <h3>Nuevo Lote</h3>
      @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form action={{url('/lote')}} method="POST" autocomplete="off">
          @csrf
          <div class="form-group">
              <label for="numero">Numero</label>
              <input type="text" name="numero" class="form-control" placeholder="Ingrese número">
          </div>
          <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
          </form>

  </div> 
</div>
  
@stop