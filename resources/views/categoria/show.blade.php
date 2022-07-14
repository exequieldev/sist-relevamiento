@extends('adminlte::page')

@section('content')
  <!--Encabezado-->
  <div class="row">
    <h1> {{$nombre}}<a href="{{url('/categoria/')}}"><button class="btn btn-primary">Volver</button></a></h1>
  </div>
<br>
@if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
@endif
<div class="row">
    <div class="col-lg-12 col-md-8 col-sm-8 col-sx-8 ">
    <form action={{url('/institucion/')}} method="POST" autocomplete="off">
            @csrf
            <div class="form-group">
                <input type="hidden" name="categoria" value="{{$idCategoria}}">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" placeholder="Ingrese nombre">
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
            @foreach ($institucionMedica as $institucion)
              <tr>
                <td>{{$institucion->idInstitucionMedica}}</td>
                <td>{{$institucion->nombre}}</td>
                <td>
                      <div class="btn-toolbar">
                          <a href="{{url('institucion/'.$institucion->idInstitucionMedica.'/edit')}}"><button class="btn btn-info" ><i class="fas fa-edit"></i></button></a>
                          <a href="#">
                              <form action="{{route('institucion.destroy',$institucion->idInstitucionMedica)}}" method="POST">
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
    {{$institucionMedica->render()}}
    </div>
  </div>

@stop



