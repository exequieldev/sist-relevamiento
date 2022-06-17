@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Manzanas <a href={{url('manzana/create')}}><button class="btn btn-success">Nuevo</button></a></h1>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-streped table-bordered table-condensed table-hover">
            <thead>
                <th>Id</th>
                <th>Número</th>
                <th>Opciones</th>
            </thead>
            @foreach ($manzanas as $manzana)
              <tr>
                <td>{{$manzana->idManzana}}</td>
                <td>{{$manzana->numero}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('manzana/'.$manzana->idManzana.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('manzana.destroy',$manzana->idManzana)}}" method="POST">
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
    {{$manzanas->render()}}
    </div>
  </div>


  

  
  
@stop
