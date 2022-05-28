@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-6 col-sd-6 col-xs-12">
      <h3>Nuevo Relevamiento</h3>
      @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif

    <form action={{url('/relevamiento')}} method="POST" autocomplete="off">
          @csrf
          <div class="row">
            <div class="form-group col-3">
                <label for="barrio">Barrio</label>
                <select class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($barrios as $barrio)
                        <option value="{{$barrio->idBarrio}}">{{$barrio->nombre}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group col-3">
                <label for="manzana">Manzana</label>
                <select class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($manzanas as $manzana)
                        <option value="{{$manzana->idManzana}}">{{$manzana->descripcion}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group col-3">
                <label for="lote">Lote</label>
                <select class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($lotes as $lote)
                        <option value="{{$lote->idLote}}">{{$lote->numero}}</option>
                    @endforeach
                </select>
              </div>
          </div>
          
          <div class="row">
            <div class="form-group col-3">
                <div class="form-group">
                    <label for="casa">Casa N°</label>
                    <input type="text" name="casa" class="form-control" placeholder="Ingrese numero de la casa">
                </div>
            </div>
            <div class="form-group col-3">
                <div class="form-group">
                    <label for="tipoTelefono">Tipo Telefono</label>
                    <input type="text" name="tipoTelefono" class="form-control" placeholder="Ingrese el tipo de telefono">
                </div>
            </div>
            <div class="form-group col-3">
                <div class="form-group">
                    <label for="numeroTelefono">Numero Telefono</label>
                    <input type="number" name="numeroTelefono" class="form-control" placeholder="Ingrese el numero de telefono">
                </div>
            </div>
          </div>
        
            <ul class="row list-unstyled">
                
                    <li class="col-3">
                        <h3>Techo</h3>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="switch">
                            <label  for="switchA">Chapa Zinc</label>
                        </div>
                    </li>
                
            </ul>
            
            <div class="row">
                <div class="form-group col-3">
                    <div class="form-group">
                        <h3>Tipo Vivienda </h3>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="switch">
                            <label  for="switchA">Compartida</label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-3">
                    <div class="form-group">
                        <h3>Hacinamiento </h3>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="switch">
                            <label  for="switchA">Dispone</label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-6">
                    <ul class="row list-unstyled">
                
                        <li class="col-6">
                            <h3>Cocina</h3>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="switch">
                                <label  for="switchA">Disponile</label>
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <button type="button" class="btn btn-primary">Agregar Grupo</button>
                </div>
            </div>
          
          <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>
    </form>

  </div> 
</div>
  
@stop