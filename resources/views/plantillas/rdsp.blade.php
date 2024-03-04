@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>

<!-- BANDEJA DE ENTRADA -->
@if( $seccion == 1)

@if($datos != null)
<div class="formm">
    <div class="table-responsive m-3 p-3">
        <table id="tablaBandejaEntrada" class="table">

            <thead>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS DEL EMISOR:</th>
                    <th scope="col">DATOS DE LA C&Eacute;DULA:</th>
                    <th scope="col">MOTIVO DEL CAMBIO:</th>
                    <th scope="col">DETALLES:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>

                @foreach($datos as $ob)
                <tr id="tablaneutro">

                    <th>
                        {{$ob->folio}}
                    </th>

                    <td>
                        <b>Nombre:</b><br>
                        <span class="glyphicon glyphicon-user"></span> {{$ob->nom1}} {{$ob->nom2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br><br>

                        <b>Usuario:</b><br>
                        <span class="glyphicon glyphicon-envelope"></span> {{$ob->correo}}<br><br>
                    </td>

                    <td>
                        <b>Nombre:</b> {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->appat}} {{$ob->apmat}}<br>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>Clave UA:</b> {{$ob->clave_ua}}
                    </td>

                    <td><span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}</td>

                    <td>
                        <b>Recibida:</b><br>
                        <span class="glyphicon glyphicon-calendar"></span> {{$ob->fecha_validacionenlace}}<br><br>
                    </td>

                    <td>
                        <div class="d-flex">
                            <form action="vercedulardsp" method="post">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                                <button id="tamanioboton" class="btn btn-info m-1" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Cédula">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                            </form>

                            @if( $ob->id_estadocedula == 11)
                            <div id="separacion"></div>
                            <form action="validarcedulardsp" method="post">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                                <button id="tamanioboton" class="btn btn-success m-1" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Validar Datos">
                                    <span class="glyphicon glyphicon-ok"></span>
                                </button>
                            </form>


                            <div id="separacion"></div>
                            <form action="correccion" method="post">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                                <button id="tamanioboton" class="btn btn-warning m-1" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Corrección">
                                    <span class="glyphicon glyphicon-refresh"></span>
                                </button>
                            </form>


                            <div id="separacion"></div>
                            <form action="invalidarcedulardsp" method="post">
                                @csrf
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                                <button id="tamanioboton" class="btn btn-danger m-1" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Rechazar">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </button>
                            </form>

                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS DEL EMISOR:</th>
                    <th scope="col">DATOS DE LA C&Eacute;DULA:</th>
                    <th scope="col">MOTIVO DEL CAMBIO:</th>
                    <th scope="col">DETALLES:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </tfoot>

        </table>
    </div>
</div>

@else

<div class="m-auto">
    <div class="card shadow-lg notify notify-warning">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/not-found-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">SIN RESULTADOS</h1>
                    <p class="txt-notify-s">No se encontraron cédulas pendientes por validar.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

<!-- VER CÉDULA -->
@elseif( $seccion == 2 )

<div class="formm resaltardatos my-5">

    <!--  + + + + + + + + + + + + + + + + + Unidad Administrativa  + + + + + + + + + + + + + + + + +  -->

    <div class="col-md-12">
        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Unidad Administrativa</h3>
            <hr>
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Secretaría:</label>
            <input type="text" value="{{$list[0]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n &Aacute;rea:</label>
            <input type="text" value="{{$list[3]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subsecretar&iacute;a:</label>
            <input type="text" value="{{$list[1]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subdirecci&oacute;n:</label>
            <input type="text" value="{{$list[4]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n General:</label>
            <input type="text" value="{{$list[2]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Departamento / Oficina:</label>
            <input type="text" value="{{$datos->nombre}}" class="form-control" id="validationDefault01" readonly />
        </div>
    </div>


    <!--  + + + + + + + + + + + + + + + + + Persona Servidora Pública  + + + + + + + + + + + + + + + + + -->
    <div class="col-md-12">
        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, dice:</h3>
            <hr>
        </div>


        <input type="text" value="{{$datos->idpersona}}" class="form-control" id="validationDefault01" hidden />
        <!--<div class="col-md-1">
                <span class="glyphicon glyphicon-user"></span>
                <label for="validationDefault02" class="form-label">ID:</label>
                <input type="text" value="{{$datos->idpersona}}" class="form-control" id="validationDefault01" readonly/>
            </div>-->

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Nombre completo:</label>
            <input type="text" value="{{$datos2->nombre1}} {{$datos2->nombre2}} {{$datos2->apellidopat}} {{$datos2->apellidomat}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
            <input type="text" value="{{$datos2->profesion}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-9 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
            <input type="text" value="{{$datos2->cargo}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-3 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
            <input type="text" value="{{$datos2->tipo}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
            <input type="text" value="{{$datos2->genero}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
            <input type="text" value="{{$datos2->nivelnominal}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
            <input type="text" value="{{$datos2->rango}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-3 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
            <input type="text" value="{{$datos2->cveua}}" class="form-control" id="validationDefault02" readonly />
        </div>
    </div>




    <div class="col-md-12">

        <!-- Motivo del Cambio -->

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Motivo del Cambio</h3>
            <hr>
        </div>


        <div class="col-md-3 my-3">
            <span class="glyphicon glyphicon-refresh txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Motivo del cambio:</label>
            <input type="text" value="{{$datos->tipo_cambio}}" class="form-control" id="validationDefault02" readonly />
        </div>




        <!--  + + + + + + + + + + + + + + + + + debe decir:  + + + + + + + + + + + + + + + + +  -->

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, debe decir:</h3>
            <hr>
        </div>

        <div class="col-md-12">
            @if( $datos->nombre1 == $datos2->nombre1)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">P. nombre:</label>
                <input type="text" value="{{$datos->nombre1}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">P. nombre:</label>
                <input type="text" value="{{$datos->nombre1}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->nombre1}}</i></b></small>
            </div>
            @endif

            @if( $datos->nombre2 == $datos2->nombre2)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">S. nombre:</label>
                <input type="text" value="{{$datos->nombre2}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">S. nombre:</label>
                <input type="text" value="{{$datos->nombre2}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->nombre2}}</i></b></small>
            </div>
            @endif

            @if( $datos->appat == $datos2->apellidopat)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" value="{{$datos->appat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" value="{{$datos->appat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->apellidopat}}</i></b></small>
            </div>
            @endif

            @if( $datos->apmat == $datos2->apellidomat)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" value="{{$datos->apmat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" value="{{$datos->apmat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->apellidomat}}</i></b></small>
            </div>
            @endif

        </div>


        <div class="col-md-12">
            @if( $datos->profesion == $datos2->profesion )
            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                <input type="text" value="{{$datos->profesion}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-6 mb-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                <input type="text" value="{{$datos->profesion}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->profesion}}</i></b></small>
            </div>
            @endif

            @if( $datos->cargo == $datos2->cargo )
            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" value="{{$datos->cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-6 mb-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" value="{{$datos->cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->cargo}}</i></b></small>
            </div>
            @endif
        </div>

        <div id="separador-formulario">

            @if( $datos->sit_cargo == $datos2->tipo)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
                <input type="text" value="{{$datos->sit_cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
                <input type="text" value="{{$datos->sit_cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tipo}}</i></b></small>
            </div>
            @endif

            @if( $datos->sexo == $datos2->genero )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
                <input type="text" value="{{$datos->sexo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
                <input type="text" value="{{$datos->sexo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->genero}}</i></b></small>
            </div>
            @endif

            @if( $datos->nivel_nom == $datos2->nivelnominal )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
                <input type="text" value="{{$datos->nivel_nom}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
                <input type="text" value="{{$datos->nivel_nom}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->nivelnominal}}</i></b></small>
            </div>
            @endif

            @if( $datos->rango == $datos2->rango )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" value="{{$datos->rango}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" value="{{$datos->rango}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->rango}}</i></b></small>
            </div>
            @endif

            @if( $datos->clave_ua == $datos2->cveua )
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                <input type="text" value="{{$datos->clave_ua}}" pattern="[A-Z0-9\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                <input type="text" value="{{$datos->clave_ua}}" pattern="[A-Z0-9\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->cveua}}</i></b></small>
            </div>
            @endif

        </div>



        <!--  + + + + + + + + + + + + + + + + +  Domicilia  + + + + + + + + + + + + + + + + +  -->

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Domicilio</h3>
            <hr>
        </div>

        <div id="separador-formulario">

            @if( $datos->calle == $datos2->calleprincipal )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                <input type="text" value="{{$datos->calle}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                <input type="text" value="{{$datos->calle}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->calleprincipal}}</i></b></small>
            </div>
            @endif

            @if( $datos->referencia1 == $datos2->entrecalle1 )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                <input type="text" value="{{$datos->referencia1}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                <input type="text" value="{{$datos->referencia1}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->entrecalle1}}</i></b></small>
            </div>
            @endif

            @if( $datos->referencia2 == $datos2->entrecalle2 )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 2:</label>
                <input type="text" value="{{$datos->referencia2}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form- txt-gray">Referencia de calle 2:</label>
                <input type="text" value="{{$datos->referencia2}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->entrecalle2}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->numext == $datos2->numext )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                <input type="text" value="{{$datos->numext}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                <input type="text" value="{{$datos->numext}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->numext}}</i></b></small>
            </div>
            @endif

            @if( $datos->numint == $datos2->numint )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                <input type="text" value="{{$datos->numint}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                <input type="text" value="{{$datos->numint}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->numint}}</i></b></small>
            </div>
            @endif

            @if( $datos->colonia == $datos2->colonia )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                <input type="text" value="{{$datos->colonia}}" pattern="[A-Za-z0-9/\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                <input type="text" value="{{$datos->colonia}}" pattern="[A-Za-z0-9/\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->colonia}}</i></b></small>
            </div>
            @endif

            @if( $datos->ciudad == $datos2->nombre_municipio )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                <input type="text" value="{{$datos->ciudad}}" pattern="[A-Za-z0-9/\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                <input type="text" value="{{$datos->ciudad}}" pattern="[A-Za-z0-9/\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->nombre_municipio}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->barrio == $datos2->barrio )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                <input type="text" value="{{$datos->barrio}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                <input type="text" value="{{$datos->barrio}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->barrio}}</i></b></small>
            </div>
            @endif

            @if( $datos->piso == $datos2->piso)
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                <input type="text" value="{{$datos->piso}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                <input type="text" value="{{$datos->piso}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->piso}}</i></b></small>
            </div>
            @endif

            @if( $datos->puerta == $datos2->puerta )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                <input type="text" value="{{$datos->puerta}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                <input type="text" value="{{$datos->puerta}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->puerta}}</i></b></small>
            </div>
            @endif

            @if( $datos->cp == $datos2->codigopostal )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                <input type="number" value="{{$datos->cp}}" maxlength="5" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                <input type="number" value="{{$datos->cp}}" maxlength="5" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->codigopostal}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->ref_dom == $datos2->ref_ad )
            <div class="col-md-12 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-12 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small class="txt-gray">Dice: <b><i>{{$datos2->ref_ad}}</i></b></small>
            </div>
            @endif

        </div>




        <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
        <!-- <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Contacto</h3>
            <hr>
        </div> -->
        <legend align="center">Contacto</legend>



        <div id="separador-formulario">

            @if( $datos->correo1 == $datos2->correo1 )
            <div class="col-md-5 my-3">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 1:</label>
                <input type="text" value="{{$datos->correo1}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-5 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon- txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 1:</label>
                <input type="text" value="{{$datos->correo1}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->correo1}}</i></b></small>
            </div>
            @endif

            @if( $datos->correo2 == $datos2->correo2 )
            <div class="col-md-5 my-3">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                <input type="text" value="{{$datos->correo2}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-5 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                <input type="text" value="{{$datos->correo2}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->correo2}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->lada == $datos2->lada )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                <input type="text" value="{{$datos->lada}}" pattern="[0-9]+" placeholder="###" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                <input type="text" value="{{$datos->lada}}" pattern="[0-9]+" placeholder="###" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->lada}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel1 == $datos2->tel1 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                <input type="text" value="{{$datos->tel1}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                <input type="text" value="{{$datos->tel1}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel1}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel2 == $datos2->tel2 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                <input type="text" value="{{$datos->tel2}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                <input type="text" value="{{$datos->tel2}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel2}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel3 == $datos2->tel3 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                <input type="text" value="{{$datos->tel3}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                <input type="text" value="{{$datos->tel3}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel3}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel4 == $datos2->tel4 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                <input type="text" value="{{$datos->tel4}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                <input type="text" value="{{$datos->tel4}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel4}}</i></b></small>
            </div>
            @endif

            @if( $datos->ext1 == $datos2->ext1 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                <input type="text" value="{{$datos->ext1}}" pattern="[0-9]+" placeholder="#####" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon- txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                <input type="text" value="{{$datos->ext1}}" pattern="[0-9]+" placeholder="#####" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->ext1}}</i></b></small>
            </div>
            @endif

            @if( $datos->ext2 == $datos2->ext2 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                <input type="text" value="{{$datos->ext2}}" placeholder="#####" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                <input type="text" value="{{$datos->ext2}}" placeholder="#####" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->ext2}}</i></b></small>
            </div>
            @endif

        </div>

<!--
        <div id="separador-formulario">

            @if( $datos->facebook == $datos2->facepage )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                <input type="text" value="{{$datos->facebook}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                <input type="text" value="{{$datos->facebook}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->facepage}}</i></b></small>
            </div>
            @endif

            @if( $datos->twitter == $datos2->twit )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                <input type="text" value="{{$datos->twitter}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                <input type="text" value="{{$datos->twitter}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->twit}}</i></b></small>
            </div>
            @endif

            @if( $datos->web == $datos2->red )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">P&aacute;gina web:</label>
                <input type="text" value="{{$datos->web}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">P&aacute;gina web:</label>
                <input type="text" value="{{$datos->web}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->red}}</i></b></small>
            </div>
            @endif

        </div>
    -->
        <div id="separacionbottom">
            @if( $datos->ref_con == $datos2->ref_ad )
            <div class="col-md-12" id="separacionbottom">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_con}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-12" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_con}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->ref_ad}}</i></b></small>
            </div>
            @endif
        </div>

        <section class="col-md-12 p-5">
            <div class="d-flex justify-content-center flex-wrap">
                <div class="botonera1 m-2">
                    <form action="validarcedulardsp" method="post">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_id" value="{{ $datos->id_det }}" />
                        <button id="tamanioboton" class="btn btn-success" type="submit">VALIDAR DATOS</button>
                    </form>
                </div>

                @if( $boton == 0 )
                <div class="botonera2 m-2">
                    <form action="correccion" method="post">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_id" value="{{ $datos->id_det }}" />
                        <button id="tamanioboton" class="btn btn-warning" type="submit">CORRECCIÓN</button>
                    </form>
                </div>
                @endif

                <div class="botonera3 m-2">
                    <form action="invalidarcedulardsp" method="post">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_id" value="{{ $datos->id_det }}" />
                        <button id="tamanioboton" class="btn btn-danger" type="submit">RECHAZAR</button>
                    </form>
                </div>

                @if( $boton == 0 )
                <a href="{{route('bandejardsp')}}" class="btn btn-secondary m-2" type="button" id="tamanioboton">REGRESAR</a>
                @else
                <a href="{{route('cedulaspendientes')}}" class="btn btn-secondary m-2" type="button" id="tamanioboton">REGRESAR</a>
                @endif
            </div>
        </section>


        <!-- Fin div resaltardatos-->
    </div>

    <!--<div class="col-12" id="separacion" align="center">
                <a href="{{ route('validarcedulardsp',['id'=>$datos->id_det]) }}" type="button" class="btn btn-success" id="tamanioboton">VALIDAR DATOS</a>
                @if( $boton == 0 )
                    <a href="{{ route('correccion',['id'=>$datos->id_det]) }}" type="button" class="btn btn-warning" id="tamanioboton">CORRECCI&Oacute;N</a>
                @endif
                <a href="{{ route('invalidarcedulardsp',['id'=>$datos->id_det]) }}" type="button" class="btn btn-danger" id="tamanioboton">ELIMINAR</a>
                @if( $boton == 0 )
                    <a href="/SAPSP/bandejardsp" class="btn btn-info" type="button" id="tamanioboton">REGRESAR</a>
                @else
                    <a href="/SAPSP/cedulaspendientes" class="btn btn-info" type="button" id="tamanioboton">REGRESAR</a>
                @endif
            </div>-->


    <!-- </div fromm>-->
</div>

<!--  CÉDULAS PUBLICADAS  -->
@elseif( $seccion == 3 )

@if( $datos != null )
<div class="formm">
    <div class="table-responsive">
        <table id="tablaCedulasPublic" class="table">

            <thead>
                <tr id="trencabezado">
                    <th scope="col" style="width:8%">FOLIO:</th>
                    <th scope="col" style="width:30%">DATOS PERSONALES:</th>
                    <!--<th scope="col">UNIDAD ADMINISTRATIVA:</th>-->
                    <th scope="col" style="width:30%">DETALLES:</th>
                    <th scope="col" style="width:8%">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>

                @foreach($datos as $ob)
                <tr id="tablaverde">

                    <th scope="row">
                        {{$ob->folio}}
                    </th>

                    <td>
                        <b>Nombre: </b>{{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                    </td>

                    <!--<td>
                                <b>Cargo:</b> {{$ob->cargo}}<br>
                                <b>Situaci&oacute;n cargo:</b> {{$ob->sit_cargo}}<br>
                                <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                                <b>Nivel nominal:</b> {{$ob->nivel_nom}}<br>
                                <b>Rango:</b> {{$ob->rango}}<br>
                                <b>Clave UA:</b> {{$ob->clave_ua}}<br>
                            </td>-->

                    <td>
                        <!--<b>Motivo:</b><br>
                                <span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}<br><br>

                                <b><span class="glyphicon glyphicon-pencil"></span> Recibida: </b>
                                {{$ob->fecha_validacionenlace}}<br>-->

                        <b><span class="glyphicon glyphicon-info-sign"></span> Estatus: </b>
                        {{$ob->descripcion}}<br>

                        <b><span class="glyphicon glyphicon-user"></span> Recibida de: </b>
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>

                        <!--<b><span class="glyphicon glyphicon-envelope"></span>  Correo: </b>
                                {{$ob->correo}}

                                <b><span class="glyphicon glyphicon-calendar"></span> Publicaci&oacute;n: </b>
                                {{$ob->fecha_publicacionrdsp}}<br>-->

                        @if( $ob->observaciones != null)
                        <b><span class="glyphicon glyphicon-search"></span> Observaciones: </b>
                        {{$ob->observaciones}}<br>
                        @endif
                    </td>


                    <td class="d-flex">

                        <form action="cedulainfo" method="post">
                            @csrf

                            <input type="hidden" name="regreso" value="3000" />
                            <input type="hidden" name="iddet" value="{{ $ob->id_detalle}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <button class="btn btn-info m-2" id="tamanioboton" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Más">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </button>

                        </form>

                        @if($ob->tipo_cambio == 'ACTUALIZACIÓN')
                        <!--<div id="separacion"><a href="{{ route('eliminarpub',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-danger" id="tamanioboton">ELIMINAR C&Eacute;DULA</a></div>-->
                        <form action="eliminarpub" method="post">
                            @csrf

                            <input type="hidden" name="regreso" value="3002" />
                            <input type="hidden" name="_id" value="{{ $ob->id_detalle}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="separacion">
                                <button class="btn btn-danger m-2" id="tamanioboton" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Cédula">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </div>

                        </form>
                        @endif

                    </td>

                </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS PERSONALES:</th>
                    <!--<th scope="col">UNIDAD ADMINISTRATIVA:</th>-->
                    <th scope="col">DETALLES:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </tfoot>

        </table>
    </div>
</div>

@else
<div class="m-auto">
    <div class="card shadow-lg notify notify-warning">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/not-found-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">SIN RESULTADOS</h1>
                    <p class="txt-notify-s">No se encontraron cédulas publicadas.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

@endif

@endsection