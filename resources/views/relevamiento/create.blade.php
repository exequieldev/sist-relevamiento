@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12">
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
            <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="barrio">Barrio</label>
                <select class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($barrios as $barrio)
                        <option value="{{$barrio->idBarrio}}">{{$barrio->nombre}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="manzana">Manzana</label>
                <select class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($manzanas as $manzana)
                        <option value="{{$manzana->idManzana}}">{{$manzana->descripcion}}</option>
                    @endforeach
                </select>
              </div>

              <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="lote">Lote</label>
                <select class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($lotes as $lote)
                        <option value="{{$lote->idLote}}">{{$lote->numero}}</option>
                    @endforeach
                </select>
              </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="casa">Casa N°</label>
                        <input type="text" name="casa" class="form-control" placeholder="Ingrese numero de la casa">
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="numeroTelefono">Numero Telefono</label>
                        <input type="number" name="numeroTelefono" class="form-control" placeholder="Ingrese el numero de telefono">
                    </div>
                </div>
          </div>
          
          <h5>Tipo de Construccion y Servicio</h5>
          <div class="row mb-3 ml-1" style="width: 80%;">
            @foreach ($construcciones as $construccion)
            <ul class="list-group">
            <h5>{{$construccion->nombre}}</h5>
            @foreach ($detalleConstrucciones as $detalleConstruccion)
            
                    
                    @if($construccion->idConstruccion == $detalleConstruccion->idConstruccion )
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">{{$detalleConstruccion->nombre}}</label>
                            <input  type="checkbox" name="" id="">
                        </li>
                    @endif
                @endforeach
            </ul>
            @endforeach
            
          </div>

            <h5>Organizacion de Vivienda</h5>
            <div class="row mt-3" >
                <div class="form-group col-lg-3 col-md-3 col-sd-3 col-xs-3">
                    <ul class="list-group ">
                        <h5>Tipo Vivienda</h5>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">Compartida</label>
                            <input  type="checkbox" name="" id="">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">N° Habitacion</label>
                            <input style="width: 50px" type="number" name="" id="">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">Hacinamiento</label>
                            <input  type="checkbox" name="" id="">
                        </li>
                    </ul>
                </div>
                <div class="form-group col-lg-8 col-md-8 col-sd-8 col-xs-8">
                    <div class="form-group row">
                        <ul class="list-group col-lg-6 col-md-6 col-sd-6 col-xs-6">
                            <h5>Cocina</h5>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                            <label class="pr-2" for="">Disponible</label>
                                <input  type="checkbox" name="" id="">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                                Carton
                                <input type="checkbox" name="" id="">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                                Pepe
                                <input  type="checkbox" name="" id="">
                            </li>
                        </ul>
                        <ul class="list-group col-lg-6 col-md-6 col-sd-6 col-xs-6">
                            <h5>Cocina</h5>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                            <label class="pr-2" for="">Disponible</label>
                                <input  type="checkbox" name="" id="">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                                Carton
                                <input type="checkbox" name="" id="">
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                                Pepe
                                <input  type="checkbox" name="" id="">
                            </li>
                        </ul>
                    </div>
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