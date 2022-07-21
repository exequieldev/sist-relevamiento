@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-6 col-md-6 col-sd-6 col-xs-12">
      <h3>Nueva Manzana</h3>
      @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form action={{url('/manzana')}} method="POST" autocomplete="off">
          @csrf
          <div class="form-group">
              <label for="barrios">Barrios</label>
              
              <select class="form-control" name="barrios" id="">
                <option selected disabled>Seleccione...</option>
                @foreach ($barrios as $barrio)
                    <option value={{$barrio->idBarrio}}>{{$barrio->nombre}}</option>
                @endforeach
              </select>
          </div>
          <div class="form-group">
            <label for="numeroManzana">Numero Manzana</label>
            <input type="text" name="numeroManzana" class="form-control" placeholder="Ingrese numero de manzana">
          </div>
          <div class="form-group">
            <label for="divisionManzana">Letra Manzana</label>
            <input type="text" name="divisionManzana" class="form-control" placeholder="Ingrese letra de manzana">
          </div>


          <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
          </form>

  </div> 
</div>
  
@stop