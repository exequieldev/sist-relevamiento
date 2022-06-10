@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Relevamientos <a href={{url('relevamiento/create')}}><button class="btn btn-success">Nuevo</button></a></h1>
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
      <div class="table-responsive">
        <table class="table table-streped table-bordered table-condensed table-hover">
            <thead>
                <th>Fecha</th>
                <th>Barrio</th>
                <th>Manzana</th>
                <th>Lote</th>
                <th>Casa</th>
                <th>Opciones</th>
            </thead>
            @foreach ($relevamientos as $relevamiento)
              <tr>
                <td>{{$relevamiento[0]->fechaDesde}}</td>
                <td>{{$relevamiento[0]->nombre}}</td>
                <td>{{$relevamiento[0]->descripcion}}</td>
                <td>{{$relevamiento[0]->lote}}</td>
                <td>{{$relevamiento[0]->casa}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('relevamiento/'.$relevamiento[0]->idRelevamiento.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('relevamiento.destroy',$relevamiento[0]->idRelevamiento)}}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                              </form>
                          </a>
                          <a href="{{url('relevamiento/'.$relevamiento[0]->idRelevamiento)}}"><button class="btn btn-warning" ><i class="fas fa-plus"></i></button></a>
                      </div>
                </td>
              </tr>
            @endforeach   
        </table>
    </div>
    {{-- {{$relevamientos->render()}} --}}
    </div>
  </div>


  

  
  
@stop
