@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Construcciones <a href={{url('construccion/create')}}><button class="btn btn-success">Nuevo</button></a></h1>
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
            @foreach ($construcciones as $construccion)
              <tr>
                <td>{{$construccion->idConstruccion}}</td>
                <td>{{$construccion->nombre}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('construccion/'.$construccion->idConstruccion.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('construccion.destroy',$construccion->idConstruccion)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                              </form>
                            </a>
                            <a href="{{url('construccion/'.$construccion->idConstruccion)}}"><button class="btn btn-warning" ><i class="fas fa-plus"></i></button></a>
                      </div>  
                </td>
              </tr>
            @endforeach   
        </table>
    </div>
    {{$construcciones->render()}}
    </div>
  </div>


  

  
  
@stop
