@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Barrios <a href={{url('barrio/create')}}><button class="btn btn-success">Nuevo</button></a></h1>
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
            @foreach ($barrios as $barrio)
              <tr>
                <td>{{$barrio->idBarrio}}</td>
                <td>{{$barrio->nombre}}</td>
                <td>
                  <ul class="list-unstyled list-group list-group-horizontal">
                    <li><a href="#"><button class="btn btn-info" >Editar</button></a></li>
                    <li><a href="#"><button class="btn btn-danger">Eliminar</button></a></li>
                  </ul>
                </td>
              </tr>
            @endforeach   
        </table>
    </div>
    {{$barrios->render()}}
    </div>
  </div>


  

  
  
@stop
