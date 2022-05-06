@extends('adminlte::page')

@section('content')
  <h1>Relevamiento</h1>
  <div style="margin: 6px">
    <button style="background: green; color:white; width: 100px" class="form-control">Nuevo</button>
  </div>
  <table class="table ">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        <td>
          <ul>
            <li>Editar</li>
            <li>Ver</li>
            <li>Eliminar</li>
          </ul>
        </td>
      </tr>
      <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
      </tr>
      <tr>
        <th scope="row">3</th>
        <td>Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
      </tr>
    </tbody>
  </table>
@stop
