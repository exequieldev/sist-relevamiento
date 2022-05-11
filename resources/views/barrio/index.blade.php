@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <h1>Barrios</h1>

  <!--Botones-->
  <div style="margin: 6px">
    <button style="background: green; width: 100px; text-decoration: none; color:white" class="form-control">
      <a href="{{ url('/barrio/create') }}">Nuevo</a>
    </button>
  </div>

  <!--Lista de Barrios-->
  <table class="table ">

    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nombres</th>
        <th scope="col">Opciones</th>
      </tr>
    </thead>
    <tbody>
      
        <tr>
          <th scope="row">1</th>
          <td>{{$barrios->nombre}}</td>
          <td>
            <ul>
              <li><a href="{{url('/barrio/edit')}}">Edit</a></li>
              <li><a href="{{url('/barrio/show')}}">Mostrar</a></li>
              <li><a href="#">Eliminar</a></li>
            </ul>
          </td>
        </tr>

    </tbody>
  </table>
@stop
