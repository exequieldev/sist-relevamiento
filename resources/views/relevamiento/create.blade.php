@extends('adminlte::page')

@section('content')
<div class="row">
  <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12">
      <h3>Nuevo Relevamiento</h3>
      @if(count($errors)>0)
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{$error}}</li>
              @endforeach
          </ul>
      </div>
      @endif

    <form action={{url('/relevamiento')}} method="POST" autocomplete="off">
          @csrf
          <div class="row">
        {{-- <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                <label for="barrio">Barrio</label>
                <select name="barrio" class="form-control">
                    <option>Seleccionar...</option>
                    @foreach ($barrios as $barrio)
                        <option value="{{$barrio->idBarrio}}">{{$barrio->nombre}}</option>
                    @endforeach
                </select>
              </div> --}}

               
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="casa">Casa N°</label>
                        <input type="text" name="casa" value="{{old('casa')}}" class="form-control" placeholder="Ingrese numero de la casa">
                        
                    </div>
                </div>
                <div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">
                    <div class="form-group">
                        <label for="numeroTelefono">Numero Telefono</label>
                        <input type="text" name="telefono" class="form-control" placeholder="Ingrese el numero de telefono">
                    </div>
                </div>
          </div>
          
          <h5>Tipo de Construccion y Servicio</h5>
          <div class="row mb-3 ml-1" style="width: 75%;">
            @foreach ($construcciones as $construccion)
            <ul class="list-group">
            <h5>{{$construccion->nombre}}</h5>
            @foreach ($detalleConstrucciones as $detalleConstruccion)
                    @if($construccion->idConstruccion == $detalleConstruccion->idConstruccion)
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">{{$detalleConstruccion->nombre}}</label>
                            <input  type="checkbox" name="detallecons[{{$construccion->idConstruccion}}][{{$detalleConstruccion->iddetalleConstruccion}}]">
                        </li>
                    @endif
                @endforeach
            </ul>
            @endforeach
            
          </div>

            <h5>Organizacion de Vivienda</h5>
            <div class="row mt-3" >
                <div class="form-group col-lg-3 col-md-3 col-sd-3 col-xs-3">
                    <ul class="list-group ">
                        <h5>Tipo Vivienda</h5>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">Compartida</label>
                            <input  type="checkbox" name="tipoVivienda" id="">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">N° Habitacion</label>
                            <input style="width: 50px" min="1" type="number" name="numeroHabitacion" value="{{old('numeroHabitacion')}}" id="">
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-2">
                        <label class="pr-2" for="">Hacinamiento</label>
                            <input  type="checkbox" name="hacinamiento" id="">
                        </li>
                    </ul>
                </div>
                <div class="form-group col-lg-8 col-md-8 col-sd-8 col-xs-8">
                    <div class="form-group row">
                        @foreach ($habitaciones as $habitacion)
                            <ul class="list-group">
                            <h5>{{$habitacion->nombre}}</h5>
                            @foreach ($detalleHabitaciones as $detalleHabitacion)
                                    @if($habitacion->idHabitacion == $detalleHabitacion->idHabitacion )
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-0 pl-2 pr-2"  style="width: 250px;">
                                        <label class="pr-2" for="">{{$detalleHabitacion->nombre}}</label>
                                            <input  type="checkbox" name="detallehab[{{$habitacion->idHabitacion}}][{{$detalleHabitacion->idDetalleHabitacion}}]">
                                        </li>
                                    @endif
                            @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
                
            </div>
            <h5>Datos Grupo Familiar</h5>
            <div class="row mb-3 ">
                <div class="col-lg-3 col-md-3 col-sd-3 col-xs-3 mb-3">
                    <button class="form-control" id="btn_accordion">Nuevo Grupo</button>
                </div>

                <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12">
                    <div class="col-lg-12 col-md-12 col-sd-12 col-xs-12 p-0">
                        <div class="accordion" id="accordionExample">
                        
                    </div>
                </div>
                
            </div>
            <div id="modal"></div>
            {{-- Modal Detalle Persona --}}

            <div class="modal fade" id="detallePersona" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Detalle</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h3>Situacion Habitacional</h3>
                      <div class="form-group">
                        <label for="">Permiso de Ocupacion</label>
                        <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
                      </div>
                      <h3>Datos Medicos de la Persona</h3>
                            <div class="form-group" style="display: none" id="embarazada">
                              <label for="">Meses de Embarazo</label>
                              <input type="email" class="form-control" name="" id="" aria-describedby="emailHelpId" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="">Patologia</label>
                                <select class="form-control" name="" id="">
                                <option>Seleccione...</option>
                                <option></option>
                                <option></option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">CUD</label>
                                <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
                            </div>
                      <h3>Datos Escolares</h3>
                      <div class="form-group">
                        <label for="">Nivel de Estudio</label>
                        <select class="form-control" name="" id="">
                          <option>Seleccione...</option>
                          <option>Primaria</option>
                          <option>Secundaria</option>
                        </select>
                      </div>
                      <h3>Datos de Trabajo</h3>
                      <div class="form-group">
                        <label for="">Ocupacion</label>
                        <select class="form-control" name="" id="">
                          <option>Seleccione...</option>
                          <option>Desocupado</option>
                          <option>Empleado</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Trabajo Registrado</label>
                        <select class="form-control" name="" id="">
                          <option>Seleccione...</option>
                          <option></option>
                          <option></option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Ingreso</label>
                        <input type="text" class="form-control" name="" id="" aria-describedby="emailHelpId" placeholder="">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
            </div>

            {{-- Modal Salud Grupo Familiar --}}
            <div class="modal fade" id="saludFamiliar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Salud Grupo Familiar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="">Obra Social</label>
                        <select class="form-control" name="" id="">
                          <option>Seleccione...</option>
                          <option></option>
                          <option></option>
                        </select>
                      </div>
                      <h3>Centros Medicos</h3>
                      <div class="form-group">
                        <label for="">Hospital</label>
                        <select class="form-control" name="" id="">
                          <option>Seleccione...</option>
                          <option></option>
                          <option></option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">CAPS</label>
                        <select class="form-control" name="" id="">
                          <option>Seleccione...</option>
                          <option></option>
                          <option></option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Otros</label>
                        <input type="text" class="form-control" name="" id="" aria-describedby="emailHelpId" placeholder="">
                        
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
            </div>
            
              {{-- Modal Politica Sociales --}}
            <div class="modal fade" id="politicasSociales" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Politicas Sociales</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      
                      <div class="form-group">
                        <small class="mb-1">Nombre del programa social</p>
                        <div class="row">
                                    <div class="input-group input-group-sm mb-3 row d-flex justify-content-end">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="inputGroup-sizing-sm">Cantidad</span>
                                        </div>
                                        <input type="text" class="form-control col-lg-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroup-sizing-sm">Monto</span>
                                          </div>
                                          <input type="text" class="form-control col-lg-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                    </div> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="">Moviento Social</label>
                        <input type="text" class="form-control" name="" id="" aria-describedby="emailHelpId" placeholder="">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
            </div>
            
            {{-- Modal Politica Provinciales --}}
            <div class="modal fade" id="politicasProvinciales" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="staticBackdropLabel">Politicas Provinciales</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <small class="mb-1">Nombre del programa social</p>
                            <div class="row">
                                        <div class="input-group input-group-sm mb-3 row d-flex justify-content-end">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text" id="inputGroup-sizing-sm">Cantidad</span>
                                            </div>
                                            <input type="text" class="form-control col-lg-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">Monto</span>
                                              </div>
                                              <input type="text" class="form-control col-lg-2" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                        </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
          <div class="form-group">
              <button class="btn btn-primary" type="submit">Guardar</button>
              <button class="btn btn-danger" type="reset">Cancelar</button>
          </div>

          
    </form>

  </div> 
</div>
  
<script>
incrementador = 1;
persona = 1;
var niveles = <?php echo json_encode($niveles); ?>;
var patologias = <?php echo json_encode($patologias); ?>;
var vinculos = <?php echo json_encode($vinculos); ?>;
var generos = <?php echo json_encode($generos); ?>;
var ocupaciones = <?php echo json_encode($ocupaciones); ?>;
var situacionesocupacionales = <?php echo json_encode($situacionesocupacionales); ?>;
var obrasociales = <?php echo json_encode($obrasociales); ?>;
var programaProvincial = <?php echo json_encode($programaProvinciales); ?>;
var programaSocial = <?php echo json_encode($programaSociales); ?>;
var movimientoSocial = <?php echo json_encode($movimientoSocial); ?>;
var instituciones = <?php echo json_encode($intitucionMedica); ?>;

document.getElementById("btn_accordion").addEventListener("click", function(event){
  event.preventDefault();
  crearAcordeon();
});

function crearAcordeon(){
    //Cabecera 
    acordion  = '<div class="card">';
    acordion =  acordion + '<div class="card-header" id="headingOne "' + incrementador + '">';
    acordion  =  acordion + '<h2 class="mb-0">';
    acordion = acordion + '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne' + incrementador + '" aria-expanded="true" aria-controls="collapseOne' + incrementador + '">Grupo Familiar ' + incrementador + ' </button> </h2>';
    acordion = acordion + '</div>';

    //Contenido 
    acordion = acordion + '<div id="collapseOne' + incrementador + '" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">';
    acordion = acordion + '<div class="card-body">' + ' <div class="row">';
    
    //Vinculo 
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="casa">Vinculo</label>';

    acordion = acordion +  '<select  class="form-control" id="vinculo' + incrementador + '"><option selected disabled>Seleccione...</option>';


    for(i=0; i<vinculos.length; i++){
        acordion = acordion + '<option value="'+ vinculos[i].idVinculo +'">' + vinculos[i].nombre + '</option>';
    }
    acordion = acordion + '</select></div></div>';


    //Nombres
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="nombres">Nombres</label>';
    acordion = acordion + '<input type="text" id="nombres' + incrementador + '" class="form-control" placeholder="Ingrese nombres">' + '</div>' + '</div>';

    //Apellidos
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="apellidos">Apellidos</label>';
    acordion = acordion + '<input type="text" id="apellidos' + incrementador + '" class="form-control" placeholder="Ingrese apellidos">' + '</div>' + '</div>';

    //Generos


    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="casa">Sexo</label>';

    acordion = acordion +  '<select  class="form-control" id="genero' + incrementador + '"><option selected disabled>Seleccione...</option>';


    for(i=0; i<generos.length; i++){
        acordion = acordion + '<option value="'+ generos[i].idGenero +'">' + generos[i].nombre + '</option>';
    }
    acordion = acordion + '</select></div></div>';

    
    //Fecha Nacimiento
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="fechaNac">Fecha Nacimiento</label>';
    acordion = acordion + '<input type="date" id="fechaNac' + incrementador + '" class="form-control" placeholder="Ingrese Fecha Nacimiento">' + '</div>' + '</div>';


    //DNI
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">' + '<label for="dni">DNI</label>';
    acordion = acordion + '<input type="text" id="dni' + incrementador + '" class="form-control" placeholder="Ingrese DNI">' + '</div>' + '</div>' ;

    //Boton
    acordion = acordion + '<div class="form-group col-lg-2 col-md-2 col-sd-2 col-xs-2 mb-0">';
    acordion = acordion + '<div class="form-group">';
    acordion = acordion + '<label for="" style="visibility:hidden">Agregar Persona</label>';
    acordion = acordion + '<button class="form-control" id="btn_add" onclick="agregar(' + incrementador + '), event.preventDefault()">Agregar Persona</button>';
    acordion = acordion + '</div>' + '</div>';


    //Tabla
    acordion = acordion + '<div class="form-group col-lg-12 col-md-12 col-sd-12 col-xs-12 mb-0">';
    acordion = acordion + '<div class="row table-responsive">';
    acordion = acordion + '<div class="table-responsive">';
    acordion = acordion + '<table class="col-sm-12 table-bordered table-striped table-condensed ">';
    acordion = acordion + '<thead>' + '<tr><th scope="col">#</th>' + '<th scope="col">Vinculo</th>' + '<th scope="col">Nombres</th>' +  '<th scope="col">Apellidos</th>' + '<th scope="col">Genero</th>' + ' <th scope="col">Fecha Nacimiento</th>' + '<th scope="col">DNI</th>' + '<th scope="col">Operaciones</th>' + ' </tr>' + ' </thead>' + '<tbody id="tablebody' + incrementador + '">' + '</tbody>' + '</table>' + ' </div>' + ' </div>';
    acordion = acordion + '</div>'
    //Botones
    acordion = acordion + '<div class="form-group col-lg-12 col-md-12 col-sd-12 col-xs-12 mb-0">';
    acordion = acordion + '<div class="row mt-3">';

    acordion = acordion + '<div col-lg-3 >'
    acordion = acordion + '<button type=button class="form-control" data-toggle="modal" data-target="#saludFamiliar' + incrementador + '" >Salud Grupo Familar</button>'
    acordion = acordion + '</div>';

    acordion = acordion + '<div col-lg-3 >'
    acordion = acordion + '<button type=button class="form-control" data-toggle="modal" data-target="#politicasSociales' + incrementador + '">Politicas Sociales</button>'
    acordion = acordion + '</div>';

    acordion = acordion + '<div col-lg-3>'
    acordion = acordion + '<button type=button class="form-control" data-toggle="modal" data-target="#politicasProvinciales' + incrementador + '">Politicas Provinciales</button>'
    acordion = acordion + '</div>';

    acordion = acordion + '</div>';
    acordion = acordion + '</div>';

    acordion = acordion + '</div>' + '</div>' + '</div>';

  
    

    //Sludo Grupo Familiar
    //Cabecera Modal
                modal =         '<div class="modal fade" id="saludFamiliar'+incrementador+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'
                modal = modal + '<div class="modal-dialog">'
                modal = modal + '<div class="modal-content">'

                modal = modal + '<div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Salud Grupo Familiar</h5>'
                modal = modal + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                modal = modal + '</div>'

                modal = modal +  '<div class="modal-body">'

                //Obra Social
                modal = modal + '<div class="form-group"><label for="">Obra Social</label></div>';
                modal = modal + '<div class="form-group" id="obraSociales'+incrementador+'"><select class="form-control" name="obraSociales[]" id=""><option selected disabled>Seleccione...</option>';
                for(i=0; i<obrasociales.length; i++){
                    modal = modal + '<option value="'+ obrasociales[i].idObraSocial +'">' + obrasociales[i].nombre + '</option>';
                }
                modal = modal + '</select></div>';
                
                  //Instituciones Medicas
                modal = modal + '<div class="form-group"><label for="">Institucion Medica</label></div>';
                modal = modal + '<div class="form-group" id="insticuciones'+incrementador+'"><select class="form-control" name="insticuciones[]" id=""><option selected disabled>Seleccione...</option>';
                for(i=0; i<instituciones.length; i++){
                     modal = modal + '<option value="'+ instituciones[i].idInstitucionMedica +'">' + instituciones[i].nombre + '</option>';
                }
                modal = modal + '</select></div>';

                //Botones
                modal = modal + '<div class="modal-footer">'
                modal = modal + '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>'
                modal = modal + '<button type="button" class="btn btn-primary">Guardar</button>'
                modal = modal + '</div>'

                modal = modal + '</div>'
                modal = modal + '</div>'
                modal = modal + '</div>'

                $('#modal').append(modal);

    //Politicas Sociales
    //Cabecera Modal
                modal =         '<div class="modal fade" id="politicasSociales'+incrementador+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'
                modal = modal + '<div class="modal-dialog">'
                modal = modal + '<div class="modal-content">'

                modal = modal + '<div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Politicas Sociales</h5>'
                modal = modal + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                modal = modal + '</div>'

                modal = modal +  '<div class="modal-body">'

                //Programas Sociales
                modal = modal + '<div class="form-group"><h3 for="">Programas Sociales</h3></div>';
                modal = modal + '<div class="form-group" ><select class="form-control"  id="programaSociales'+incrementador+'"><option selected disabled>Seleccione Programa...</option>';
                for(i=0; i<programaSocial.length; i++){
                      modal = modal + '<option value="'+ programaSocial[i].idPrograma +'">' + programaSocial[i].programa + '</option>';
                }
                modal = modal + '</select></div>';

                modal = modal + '<div class="row">'
                modal = modal + '<div class="form-group col-lg-6 col-md-6 col-sd-6 col-xs-6 mb-0">';
                modal = modal + '<div class="form-group">' + '<label for="dni">Cantidad</label>';
                modal = modal + '<input type="text" id="cantidadSocial' + incrementador + '" class="form-control" placeholder="Ingrese Cantidad">' + '</div>' + '</div>' ;

                modal = modal + '<div class="form-group col-lg-6 col-md-6 col-sd-6 col-xs-6 mb-0">';
                modal = modal + '<div class="form-group">';
                modal = modal + '<label for="" style="visibility:hidden">Agregar Programa</label>';
                modal = modal + '<button class="form-control" id="btn_add" onclick="agregarPoliticaSocial(' + incrementador + '),event.preventDefault()">Agregar Programa</button>';
                modal = modal + '</div>' + '</div>';
                modal = modal + '</div>'

                modal = modal + '<div class="form-group col-lg-12 col-md-12 col-sd-12 col-xs-12 mb-0">';
                modal = modal + '<div class="row table-responsive">';
                modal = modal + '<div class="table-responsive">';
                modal = modal + '<table class="col-sm-12 table-bordered table-striped table-condensed ">';
                modal = modal + '<thead>' + '<th scope="col">#</th>' + '<th scope="col">Programa</th>' + '<th scope="col">Cantidad</th>' + ' </tr>' + ' </thead>' + '<tbody id="tbsocial' + incrementador + '">' + '</tbody>' + '</table>' + ' </div>' + ' </div>';
                modal = modal + '</div>'
                modal = modal + '<br>'


                //Moviento Social
                modal = modal + '<div class="form-group"><h3 for="">Movimiento Social</h3></div>';
                modal = modal + '<div class="form-group" id="movimientoSocial'+incrementador+'"><select class="form-control" name="movimientoSocial[]" id=""><option selected disabled>Seleccione...</option>';
                for(i=0; i<movimientoSocial.length; i++){
                      modal = modal + '<option value="'+ movimientoSocial[i].idMovimientoSocial +'">' + movimientoSocial[i].nombre + '</option>';
                }
                modal = modal + '</select></div>';

                //Botones
                modal = modal + '<div class="modal-footer">'
                modal = modal + '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>'
                modal = modal + '<button type="button" class="btn btn-primary">Guardar</button>'
                modal = modal + '</div>'
                
                modal = modal + '</div>'
                modal = modal + '</div>'
                modal = modal + '</div>'
               
                $('#modal').append(modal);

    //Politicas Provinciales
    //Cabecera Modal
                modal =         '<div class="modal fade" id="politicasProvinciales'+incrementador+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'
                modal = modal + '<div class="modal-dialog">'
                modal = modal + '<div class="modal-content">'

                modal = modal + '<div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Politicas Provinciales</h5>'
                modal = modal + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                modal = modal + '</div>'

                modal = modal +  '<div class="modal-body">'

                //Programas Provinciales
                modal = modal + '<div class="form-group"><h3 for="">Programas Provinciales</h3></div>';
                modal = modal + '<div class="form-group"><select class="form-control" id="programaProvincial'+incrementador+'"><option selected disabled>Seleccione Programa...</option>';
                for(i=0; i<programaProvincial.length; i++){
                      modal = modal + '<option value="'+ programaProvincial[i].idPrograma +'">' + programaProvincial[i].programa + '</option>';
                }
                modal = modal + '</select></div>';

                modal = modal + '<div class="row">'
                modal = modal + '<div class="form-group col-lg-6 col-md-6 col-sd-6 col-xs-6 mb-0">';
                modal = modal + '<div class="form-group">' + '<label for="dni">Cantidad</label>';
                modal = modal + '<input type="text" id="cantidadProvincial' + incrementador + '" class="form-control" placeholder="Ingrese Cantidad">' + '</div>' + '</div>' ;

                modal = modal + '<div class="form-group col-lg-6 col-md-6 col-sd-6 col-xs-6 mb-0">';
                modal = modal + '<div class="form-group">';
                modal = modal + '<label for="" style="visibility:hidden">Agregar Programa</label>';
                modal = modal + '<button class="form-control" id="btn_add" onclick="agregarPoliticaProvincial(' + incrementador + '),event.preventDefault()">Agregar Programa</button>';
                modal = modal + '</div>' + '</div>';
                modal = modal + '</div>'

                modal = modal + '<div class="form-group col-lg-12 col-md-12 col-sd-12 col-xs-12 mb-0">';
                modal = modal + '<div class="row table-responsive">';
                modal = modal + '<div class="table-responsive">';
                modal = modal + '<table class="col-sm-12 table-bordered table-striped table-condensed ">';
                modal = modal + '<thead>' + '<th scope="col">#</th>' + '<th scope="col">Programa</th>' + '<th scope="col">Cantidad</th>' + ' </tr>' + ' </thead>' + '<tbody id="tbprovincial' + incrementador + '">' + '</tbody>' + '</table>' + ' </div>' + ' </div>';
                modal = modal + '</div>'
                modal = modal + '<br>'
                
                //Botones
                modal = modal + '<div class="modal-footer">'
                modal = modal + '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>'
                modal = modal + '<button type="button" class="btn btn-primary">Guardar</button>'
                modal = modal + '</div>'

                modal = modal + '</div>'
                modal = modal + '</div>'
                modal = modal + '</div>'
               
                $('#modal').append(modal);
                $("#accordionExample").append(acordion);
                incrementador++;
}

function agregar(inc){
    selectVinculo = document.getElementById("vinculo"+ inc);
    selectGenero = document.getElementById("genero"+ inc);

    vinculo = selectVinculo.value;
    textoVinculo = selectVinculo.options[selectVinculo.selectedIndex].text;

    genero = selectGenero.value;
    textoGenero = selectGenero.options[selectGenero.selectedIndex].text;

    nombres = $("#nombres" + inc).val();
    apellidos = $("#apellidos" + inc).val();
    dni = $("#dni" + inc).val();
    fechaNac = $("#fechaNac" + inc).val();

    //Edad
    const fechaActual = new Date();
    const anoActual = parseInt(fechaActual.getFullYear());
    const mesActual = parseInt(fechaActual.getMonth()) + 1;
    const diaActual = parseInt(fechaActual.getDate());

    // 2016-07-11
    const anoNacimiento = parseInt(String(fechaNac).substring(0, 4));
    console.log(anoNacimiento);

    const mesNacimiento = parseInt(String(fechaNac).substring(5, 7));
    const diaNacimiento = parseInt(String(fechaNac).substring(8, 10));

    let edad = anoActual - anoNacimiento;
    if (mesActual < mesNacimiento) {
        edad--;
    } else if (mesActual === mesNacimiento) {
        if (diaActual < diaNacimiento) {
            edad--;
        }
    }

    console.log(edad);

    if (selectVinculo.selectedIndex != 0 && nombres != "" && apellidos != "" && dni != "" && fechaNac != "" && selectGenero.selectedIndex != 0){
                var fila = '<tr>';
                fila = fila + '<td>' + '<input type="hidden" name="grupos[]" value="'+inc+'">'+'</td>';
                fila = fila + '<td><input type="hidden" name="vinculos[]" value="' + vinculo + '">' + textoVinculo + '</td>' ;
                fila = fila + '<td><input type="hidden" name="nombres[]" value="' + nombres + '">' + nombres + '</td>' ;
                fila = fila + '<td><input type="hidden" name="apellidos[]" value="' + apellidos + '">' + apellidos + '</td>' ;
                fila = fila + '<td><input type="hidden" name="generos[]" value="' + genero + '">' + textoGenero + '</td>' ;
                fila = fila + '<td><input type="hidden" name="fechaNac[]" value="' + fechaNac + '" class="fechaNac">' + fechaNac + '</td>' ;
                fila = fila + '<td><input type="hidden" name="dni[]" value="' + dni + '">' + dni + '</td>' ;
                fila = fila + '<td>' + '<button class="form-control" data-toggle="modal" data-target="#detallePersona'+persona+'" onClick="event.preventDefault()">'+ 'Detalle' + '</button>' + '</td>' ;
                fila = fila + '</tr>' ;
                limpiar(inc);

                $("#tablebody" + inc).append(fila) ;

                //Cabecera Modal
                modal =         '<div class="modal fade" id="detallePersona'+persona+'" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">'
                modal = modal +   '<div class="modal-dialog">'
                modal = modal +     '<div class="modal-content">'

                modal = modal + '<div class="modal-header"><h5 class="modal-title" id="staticBackdropLabel">Detalles de: '+nombres+' ' +apellidos+' </h5>'
                modal = modal + '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                modal = modal + '</div>'

                modal = modal +  '<div class="modal-body">'
                //Situacion Habitacional
                // modal = modal +  '<h3>Situacion Habitacional</h3>'
                // modal = modal +  '<div class="form-group">'     
                // modal = modal +     '<label for="">Permiso de Ocupacion</label>'
                // modal = modal +     '<input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">'
                // modal = modal +  '</div>'

                //Datos Medicos de la Persona
                modal = modal +  '<h3>Datos Medicos de la Persona</h3>'

                //Embarazo
                if(textoGenero == 'Femenino'){
                  modal = modal + '<label for="">Embarazada</label><br><label for="">Si</label><input type="radio" name="embarazada'+persona+'[]" id="siembarazada'+persona+'" value="Si" onclick="mesesEmb('+persona+', this.id)"><br><label for="">No </label><input type="radio" name="embarazada'+persona+'[]" id="noembarazada'+persona+'" value="No" onclick="mesesEmb('+persona+', this.id)" checked>';
  
                  //Meses Embarazo
                  modal = modal +  '<div class="form-group" style="display:none" id="mesesembarazo'+persona+'"><label for="">Meses de Embarazo</label><input type="text" class="form-control" name="mesesemb[]" placeholder=""></div>'; 
                } else {
                  modal = modal + '<input type="text" class="form-control" name="mesesemb[]" value="No" style="display:none">';
                }

                //Patologia
                modal = modal + '<div class="form-group"><label for="">Patologia</label><br><label for="">Si</label><input type="radio" name="patologia'+persona+'[]" id="sipatologia'+persona+'" value="Si" onclick="patologiaPersona('+persona+', this.id)"><br><label for="">No </label><input type="radio" name="patologia'+persona+'[]" id="nopatologia'+persona+'" value="No" onclick="patologiaPersona('+persona+', this.id)" checked></div>';

                //Select Patologia
                modal = modal +  '<div class="form-group" style="display:none" id="patologias'+persona+'"><select class="form-control" name="patologias[]" id=""><option selected  value="No">Seleccione...</option>';
                
                for(i=0; i<patologias.length; i++){
                    modal = modal + '<option value="'+ patologias[i].idPatologia +'">' + patologias[i].nombre + '</option>';
                }
                modal = modal + '</select></div>';

                //CUD Patologia
                modal = modal +  '<div class="form-group" style="display:none" id="cud'+persona+'"><label for="">CUD</label><input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId"></div>'
                
                //Datos Escolares
                modal = modal +  '<h3>Datos Escolares</h3>'

                //Escolaridad
                modal = modal + '<div class="form-group"><label for="">Escolaridad</label><br><label for="">Si</label><input type="radio" name="escolaridad'+persona+'[]" id="siescolaridad'+persona+'" value="Si" onclick="escolaridadPersona('+persona+', this.id)"><br><label for="">No </label><input type="radio" name="escolaridad'+persona+'[]" id="noescolaridad'+persona+'" value="No" onclick="escolaridadPersona('+persona+', this.id)" checked></div>';

                //Select Nivel
                modal = modal +  '<div class="form-group" style="display:none" id="nivel'+persona+'"><label for="">Nivel de Estudio</label><select class="form-control" name="niveles[]" id=""><option selected value="No">Seleccione...</option>';

                if(niveles.length != 0){
                  for(i=0; i<niveles.length; i++){
                      modal = modal + '<option value="'+ niveles[i].idNivel +'">' + niveles[i].nombre + '</option>';
                  }
                }

                modal = modal + '</select></div>';
                
                if(edad > 16){
                  //Datos de trabajo
                  //Ocupacion
                  modal = modal +  '<h3>Datos de Trabajo</h3>'
                  

                  modal = modal +  '<div class="form-group"><label for="">Ocupación</label><select class="form-control" name="ocupaciones[]" id=""><option selected value="No">Seleccione...</option>';
                
                  for(i=0; i<ocupaciones.length; i++){
                      modal = modal + '<option value="'+ ocupaciones[i].idOcupacion +'">' + ocupaciones[i].nombre + '</option>';
                  }
                  modal = modal + '</select></div>';
                 
                  //Trabajo Registrado
                  modal = modal +  '<div class="form-group"><label for="">Trabajo Registrado</label><select class="form-control" name="situacionesocupacionales[]" id=""><option selected value="No">Seleccione...</option>';
                
                  for(i=0; i<situacionesocupacionales.length; i++){
                      modal = modal + '<option value="'+ situacionesocupacionales[i].idsituacionOcupacionales +'">' + situacionesocupacionales[i].nombre + '</option>';
                  }
                  modal = modal + '</select></div>';
  
                  modal = modal +   '<div class="form-group">'
                  modal = modal +   '<label for="">Ingreso</label><input type="text" class="form-control" name="ingresos[]" id="" placeholder="Ingrese el ingreso"></div>'
                  modal = modal +   '</div>'
              
                } else {

                  modal = modal + '<select class="form-control" name="trabajoreg[]" style="display:none"><option selected value="No">Seleccione...</option></select>';

                  modal = modal + '<input type="text" class="form-control" name="ingresos[]" style="display:none">';

                  modal = modal + '<input type="text" class="form-control" name="ocupaciones[]" style="display:none">';

                  modal = modal + '<input type="text" class="form-control" name="situacionesocupacionales[]" style="display:none">';
                }

                

                //Botones Modal
                modal = modal + '<div class="modal-footer">'
                
                modal = modal + '<button type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button>'
                modal = modal + '</div>'
                modal = modal + '</div>'
                modal = modal + '</div>'
                modal = modal + '</div>'
               
                $('#modal').append(modal);
                persona++;
} else {
    alert("Error al ingresar los datos de la persona en el grupo familiar.") ;
}
}

 function agregarPoliticaSocial(inc){
   selectPrograma = document.getElementById("programaSociales"+ inc);
   programa = selectPrograma.value;
   textoprograma = selectPrograma.options[selectPrograma.selectedIndex].text;
  
   cantidadSocial = $("#cantidadSocial" + inc).val();
    if (selectPrograma.selectedIndex != 0 && cantidadSocial != ""){
              var fila = '<tr>';
                  fila = fila + '<td>' + '<input type="hidden" name="gruposSocial[]" value="'+inc+'">'+'</td>';
                  fila = fila + '<td><input type="hidden" name="programasSociales[]" value="' + programa + '">' + textoprograma + '</td>' ;
                  fila = fila + '<td><input type="hidden" name="cantidadSocial[]" value="' + cantidadSocial + '">' + cantidadSocial + '</td>' ;
                  fila = fila + '</tr>' ;
                  $("#tbsocial" + inc).append(fila) ;
    }

   document.getElementById("programaSociales" + inc).selectedIndex = 0;
   $("#cantidadSocial" + inc).val("");

 }

  function agregarPoliticaProvincial(inc){
    selectPrograma = document.getElementById("programaProvincial"+ inc);
    programa = selectPrograma.value;
    textoprograma = selectPrograma.options[selectPrograma.selectedIndex].text;

    cantidadProvincial = $("#cantidadProvincial" + inc).val();
    console.log(cantidadProvincial);

    if (selectPrograma.selectedIndex != 0 && cantidadProvincial != ""){
              var fila = '<tr>';
                  fila = fila + '<td>' + '<input type="hidden" name="gruposProvincial[]" value="'+inc+'">'+'</td>';
                  fila = fila + '<td><input type="hidden" name="programasProvinciales[]" value="' + programa + '">' + textoprograma + '</td>' ;
                  fila = fila + '<td><input type="hidden" name="cantidadProvincial[]" value="' + cantidadProvincial + '">' + cantidadProvincial + '</td>' ;
                  fila = fila + '</tr>' ;
                  limpiar(inc);

                  $("#tbprovincial" + inc).append(fila) ;
    }
  }

 function detalle(){
     this.addEventListener("click", (e) => {
         e.preventDefault();
     });
 }

 function mesesEmb(pers, id){

   $mesesembarazo = document.getElementById('mesesembarazo'+pers);
   console.log(id, pers);
  
   console.log(id.includes('noembarazada'), "no embarazada");
   console.log(id.includes('siembarazada'), "embarazada");
  

   if (id != null && id.includes('noembarazada') && $mesesembarazo != null){
     $mesesembarazo.style.display = "none";
   }

   if (id != null && id.includes('siembarazada') && $mesesembarazo != null){
     $mesesembarazo.style.display = "";
   }
 }

function patologiaPersona(pers, id){

$patologias = document.getElementById('patologias'+pers);
$cud = document.getElementById('cud'+pers);

console.log(id, pers);


if (id != null && id.includes('nopatologia') && $patologias != null){
  $patologias.style.display = "none";
  $cud.style.display = "none";
}

if (id != null && id.includes('sipatologia') && $patologias != null){
  $patologias.style.display = "";
  $cud.style.display = "";
}
}

function escolaridadPersona(pers, id){

$nivel = document.getElementById('nivel'+pers);


if (id != null && id.includes('noescolaridad') && $nivel != null){
  $nivel.style.display = "none";
}

if (id != null && id.includes('siescolaridad') && $nivel != null){
  $nivel.style.display = "";
}
}


function limpiar(inc){
    document.getElementById("vinculo" + inc).selectedIndex = 0;
    document.getElementById("genero" + inc).selectedIndex = 0;
    $("#nombres" + inc).val("");
    $("#apellidos" + inc).val("");
    $("#fechaNac" + inc).val("");
    $("#dni" + inc).val("");
}
</script>
@stop
