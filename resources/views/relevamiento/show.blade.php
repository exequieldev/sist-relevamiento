@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Detalle Hogar<a href="{{url('/relevamiento/')}}"><button class="btn btn-primary">Volver</button></a></h1>
  </div>
<br>

<h5>Información Básica del Hogar</h5>

  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Fecha</th>
                <th>Barrio</th>
                <th>Manzana</th>
                <th>Lote</th>
                <th>Casa</th>
            </thead>
            @foreach ($relevamientos as $relevamiento)
              <tr>
                <td>{{$relevamiento[0]->fechaDesde}}</td>
                <td>{{$relevamiento[0]->nombre}}</td>
                <td>{{$relevamiento[0]->descripcion}}</td>
                <td>{{$relevamiento[0]->lote}}</td>
                <td>{{$relevamiento[0]->casa}}</td>
              </tr>
            @endforeach   
        </table>
    </div>
  
    </div>
  </div>

<br>
<h5>Tipo de Construccion y Servicio</h5>
<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Construcción o servicio</th>
                <th>Detalle Construcción o servicio</th>
            </thead>
            @foreach ($construcciones as $construccion)
              <tr>
                <td>{{$construccion->nombrecons}}</td>
                <td>{{$construccion->nombredetallecons}}</td>
              </tr>
            @endforeach   
        </table>
    </div>
  
    </div>
  </div>

  <br>
  <h5>Organizacion de Vivienda</h5>
  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Habitación</th>
                <th>Detalle Habitación</th>
            </thead>
            @foreach ($detallehabitaciones as $detallehabitacion)
              <tr>
                <td>{{$detallehabitacion->nombrehab}}</td>
                <td>{{$detallehabitacion->nombredetallehab}}</td>
              </tr>
            @endforeach   
        </table>
    </div>
    </div>
  </div>

  <br>
  <h5>Personas</h5>
  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Hogar</th>
                <th>Vinculo</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha Nacimiento</th>
                <th>DNI</th>
            </thead>
            @foreach ($personas as $persona)
              <tr>
                <td>{{$persona->hogar}}</td>
                <td>{{$persona->vinculo}}</td>
                <td>{{$persona->nombres}}</td>
                <td>{{$persona->apellidos}}</td>
                <td>{{$persona->fechanac}}</td>
                <td>{{$persona->dni}}</td>
              </tr>
            @endforeach   
        </table>
    </div>
    </div>
  </div>
@stop



