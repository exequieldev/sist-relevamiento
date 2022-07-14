@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Movimientos Sociales <a href={{url('movimiento/create')}}><button class="btn btn-success">Nuevo</button></a></h1>
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
            @foreach ($movimientos as $movimiento)
              <tr>
                <td>{{$movimiento->idMovimientoSocial}}</td>
                <td>{{$movimiento->nombre}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('movimiento/'.$movimiento->idMovimientoSocial.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('movimiento.destroy',$movimiento->idMovimientoSocial)}}" method="POST">
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
    {{$movimientos->render()}}
    </div>
  </div>


  

  
  
@stop
