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
            <select class="form-control">
                <option>Seleccionar...</option>
                @foreach ($lotes as $lote)
                    <option value="{{$lote->idLote}}">{{$lote->numero}}</option>
                @endforeach
            </select>
          </div>
          <ul class="row list-unstyled">
                <li class="col-3">
                    <div class="custom-control custom-checkbox">
                        <h2>Techos</h2> 
                        <input type="checkbox" class="custom-control-input" id="switchA" name="switch">
                        <label class="custom-control-label" for="switchA">Custom checkbox</label>
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