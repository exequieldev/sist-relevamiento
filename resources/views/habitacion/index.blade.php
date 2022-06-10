@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Habitaciones <a href={{url('habitacion/create')}}><button class="btn btn-success">Nuevo</button></a></h1>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-streped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Nombre</th>
                <th>Opciones</th>
            </thead>
            @foreach ($habitaciones as $habitacion)
              <tr>
                <td>{{$habitacion->idHabitacion}}</td>
                <td>{{$habitacion->nombre}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('habitacion/'.$habitacion->idHabitacion.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('habitacion.destroy',$habitacion->idHabitacion)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                              </form>
                            </a>
                            <a href="{{url('habitacion/'.$habitacion->idHabitacion)}}"><button class="btn btn-warning" ><i class="fas fa-plus"></i></button></a>
                      </div>  
                </td>
              </tr>
            @endforeach   
        </table>
    </div>
    {{$habitaciones->render()}}
    </div>
  </div>


  

  
  
@stop
