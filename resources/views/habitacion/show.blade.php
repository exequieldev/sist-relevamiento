@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Detalle Habitacion de {{$nombre}}<a href="{{url('/habitacion/')}}"><button class="btn btn-primary">Volver</button></a></h1>
  </div>
<br>
<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
    <form action={{url('/detallehabitacion/')}} method="POST" autocomplete="off">
            @csrf
            <div class="form-group">
                <input type="hidden" name="habitacion" value="{{$idHabitacion}}">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ingrese nombre">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Nuevo</button>
            </div>
    </form>
</div> 
</div>
<br>
  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </thead>
            @foreach ($detalleHabitacion as $detalle)
              <tr>
                <td>{{$detalle->idDetalleHabitacion}}</td>
                <td>{{$detalle->nombre}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('detallehabitacion/'.$detalle->idDetalleHabitacion.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('detallehabitacion.destroy',$detalle->idDetalleHabitacion)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                              </form>
                            </a>
                      </div>  
                </td>
              </tr>
            @endforeach   
        </table>
    </div>
    {{$detalleHabitacion->render()}}
    </div>
  </div>

@stop



