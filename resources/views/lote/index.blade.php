@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1>Lotes <a href={{url('lote/create')}}><button class="btn btn-success">Nuevo</button></a></h1>
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
            @foreach ($lotes as $lote)
              <tr>
                <td>{{$lote->idLote}}</td>
                <td>{{$lote->numero}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('lote/'.$lote->idLote.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('lote.destroy',$lote->idLote)}}" method="POST">
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
    {{$lotes->render()}}
    </div>
  </div>


  

  
  
@stop
