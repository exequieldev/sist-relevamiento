@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Detalle Relevamiento  <a href="{{url('/relevamiento/')}}"><button class="btn btn-primary">Volver</button></a></h1>
  </div>
<br>

<h5>Información Básica de las Casas</h5>

  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="accordion" id="accordionExample">
      @foreach ($relevamientos as $relevamiento)
        <div class="card">
          <div class="card-header" id="headingOne{{$relevamiento->division}}">
            <h2 class="mb-0">
              <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne{{$relevamiento->division}}" aria-expanded="true" aria-controls="collapseOne{{$relevamiento->division}}">
                Casa {{$relevamiento->casa}} - {{$relevamiento->division}}
              </button>
            </h2>
          </div>
      
          <div id="collapseOne{{$relevamiento->division}}" class="collapse" aria-labelledby="headingOne{{$relevamiento->division}}" data-parent="#accordionExample">
            <div class="card-body">
            <h5>Datos Generales</h5>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Fecha</th>
                        <th>Barrio</th>
                        <th>Manzana</th>
                        <th>Lote</th>
                        <th>Casa</th>
                        <th>Division</th>
                    </thead>
                    
                          <tr>
                            <td>{{$relevamiento->fechaDesde}}</td>
                            <td>{{$relevamiento->nombre}}</td>
                            <td>{{$relevamiento->descripcion}}</td>
                            <td>{{$relevamiento->lote}}</td>
                            <td>{{$relevamiento->casa}}</td>
                            <td>{{$relevamiento->division}}</td>
                          </tr>
                      
                </table>
              </div>
            
              <h5>Tipo Vivienda</h5>
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                        <th>Compartida</th>
                        <th>N° Habitaciones</th>
                        <th>Hacinamento</th>
                    </thead>
                    @foreach ($detallecasas as $detallecasa)
                          @if($relevamiento->division == $detallecasa->division)
                            <tr>
                              <td>{{$detallecasa->tipovivienda}}</td>
                              <td>{{$detallecasa->habitaciones}}</td>
                              <td>{{$detallecasa->hacinamiento}}</td>
                            </tr>
                          @endif
                    @endforeach   
                </table>
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
                          @if($relevamiento->division == $construccion->division)
                            <tr>
                              <td>{{$construccion->nombrecons}}</td>
                              <td>{{$construccion->nombredetallecons}}</td>
                            </tr>
                          @endif
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
                        @if($relevamiento->division == $detallehabitacion->division)
                          <tr>
                            <td>{{$detallehabitacion->nombrehab}}</td>
                            <td>{{$detallehabitacion->nombredetallehab}}</td>
                          </tr>
                        @endif 
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
                        @if($relevamiento->division == $persona->division)
                          <tr>
                            <td>{{$persona->hogar}}</td>
                            <td>{{$persona->vinculo}}</td>
                            <td>{{$persona->nombres}}</td>
                            <td>{{$persona->apellidos}}</td>
                            <td>{{$persona->fechanac}}</td>
                            <td>{{$persona->dni}}</td>
                          </tr>
                        @endif
                        @endforeach   
                    </table>
                </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach 
      </div>
    </div>
  </div>

@stop



