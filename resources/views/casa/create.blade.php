@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-6 col-sd-6 col-xs-12">
      <h3>Nueva Casa</h3>
      @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form action={{url('/casa')}} method="POST" autocomplete="off">
          @csrf
          <div class="form-group col-6">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre">
          </div>
          <div class="form-group col-6">
            <label for="lote">Lote</label>
            <input type="text" name="nombre" class="form-control" placeholder="Ingrese lote">
          </div>
          <ul class="row list-unstyled">
                <li class="col-3">
                    <div>
                        <h2>Techos</h2> 
                        <div class="form-group">
                            <label for="nombreDetalle">Pared <input type="checkbox" name="nombreDetalle" class="form-control" placeholder="Ingrese lote"></label>
                        </div>
                    </div>
                </li>
          </ul>

          <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
          </form>

  </div> 
</div>
  
@stop