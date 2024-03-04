@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-3 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>


<!-- LISTADO DE LAS CÉDULAS DIRECTAS PENDIENTES -->
@if( $seccion == 1 )

@if($datos != null)

<div class="formm">
    <table id="tabladt" class="table">

        <thead>
            <tr id="trencabezado">
                <th scope="col">FOLIO:</th>
                <th scope="col">DATOS DE LA CÉDULA:</th>
                <th scope="col">MOTIVO DEL CAMBIO:</th>
                <th scope="col">DETALLES:</th>
                <th scope="col">OPCIONES:</th>
            </tr>
        </thead>

        <tbody>

            @foreach($datos as $ob)
            <tr id="tablaneutro">

                <td scope="row">
                    <b>{{$ob->folio}}</b>
                </td>

                <td>
                    <b>Nombre:</b> {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->appat}} {{$ob->apmat}}<br>
                    <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                    <b>Cargo:</b> {{$ob->cargo}}<br>
                    <b>Clave UA:</b> {{$ob->clave_ua}}
                </td>

                <td><span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}</td>

                <td>
                    <b>Creada:</b><br>
                    <span class="glyphicon glyphicon-calendar"></span> {{$ob->created_at}}<br><br>
                </td>

                <td class="text-center">
                    <!--<div>
                                        <div id="separacion"><a href="{{ route('vercedulardsp',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-info" id="tamanioboton">VER C&Eacute;DULA</a></div>
                                        @if( $ob->id_estadocedula == 11)
                                            <div id="separacion"><a href="{{ route('validarcedulardsp',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-success" id="tamanioboton">VALIDAR DATOS</a></div>
                                            <div id="separacion"><a href="{{ route('modceddir',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-warning" id="tamanioboton">MODIFICAR DATOS</a></div>
                                            <div id="separacion"><a href="{{ route('invalidarcedulardsp',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-danger" id="tamanioboton">ELIMINAR C&Eacute;DULA</a></div>
                                        @endif
                                    </div>-->
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
                                <span class="glyphicon glyphicon-check"></span>
                            </button>
                        </form>


                        <div id="separacion"></div>
                        <form action="modceddir" method="post">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                            <button id="tamanioboton" class="btn btn-warning m-1" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificación">
                                <span class="glyphicon glyphicon-pencil"></span>
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
                <th scope="col">DATOS DE LA C&Eacute;DULA:</th>
                <th scope="col">MOTIVO DEL CAMBIO:</th>
                <th scope="col">DETALLES:</th>
                <th scope="col">OPCIONES:</th>
            </tr>
        </tfoot>

    </table>
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




















<!-- MODIFICAR CÉDULA DIRECTA -->
@elseif( $seccion == 2)

<div class="formm">

    <section class="mb-5">
        <!-- Unidad Administrativa -->


        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Unidad Administrativa</h3>
            <hr>
        </div>



        <form action="{{route('modificarced')}}" method="post" autocomplete="off" class="row g-2">
            @csrf

            <input type="text" name="idced" value="{{$datos->id_cedulafun}}" class="form-control" id="validationDefault01" hidden />

            <div class="col-md-6">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Secretaría:</label>
                <input type="text" value="{{$list[0]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n &Aacute;rea:</label>
                <input type="text" value="{{$list[3]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Subsecretar&iacute;a:</label>
                <input type="text" value="{{$list[1]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Subdirecci&oacute;n:</label>
                <input type="text" value="{{$list[4]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n General:</label>
                <input type="text" value="{{$list[2]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Departamento / Oficina:</label>
                <input type="text" value="{{$datos->nombre}}" class="form-control" id="validationDefault01" readonly />
            </div>



            <!-- Persona Servidora Pública, dice: -->

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, dice:</h3>
                <hr>
            </div>

            <div class="col-md-1 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">ID:</label>
                <input type="text" name="idpersona" value="{{$datos->idpersona}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Nombre completo:</label>
                <input type="text" name="nombrecompleto" value="{{$datos2->nombre1}} {{$datos2->nombre2}} {{$datos2->apellidopat}} {{$datos2->apellidomat}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-5 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                <input type="text" name="prof" value="{{$datos2->profesion}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" name="cargo" value="{{$datos2->cargo}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Situación cargo:</label>
                <input type="text" name="sitcargo" value="{{$datos2->tipo}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
                <input type="text" name="sexo" value="{{$datos2->genero}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
                <input type="text" name="nivnom" value="{{$datos2->nivelnominal}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" name="rango" value="{{$datos2->rango}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                <input type="text" name="clua" value="{{$datos2->cveua}}" class="form-control" id="validationDefault02" readonly />
            </div>

    </section>

    <!-- Motivo del Cambio -->

    <div class="resaltardatos p-3 col-12 d-flex flex-column mt-5">

        <section class="col-12">

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Motivo del Cambio</h3>
                <hr>
            </div>

            <div class="col-md-4">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Motivo del cambio:</label>
                <select name="radio" class="form-control" id="sel1" required>
                    <optgroup label="Motivo Actual:">
                        <option value="{{$datos->tipo_cambio}}" selected readonly>{{$datos->tipo_cambio}}</option>
                    </optgroup>
                    @if( $datos->tipo_cambio == 'ACTUALIZACIÓN' )
                    <option value="CORRECCIÓN">CORRECCI&Oacute;N</option>

                    @elseif( $datos->tipo_cambio == 'CORRECCIÓN' )
                    <option value="ACTUALIZACIÓN">ACTUALIZACI&Oacute;N</option>

                    @else
                    <option value="ACTUALIZACIÓN">ACTUALIZACI&Oacute;N</option>
                    <option value="CORRECCIÓN">CORRECCI&Oacute;N</option>
                    @endif
                </select>
            </div>
            <!-- Persona Servidora Pública, debe decir: -->

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, <b>debe decir:</b></h3>
                <hr>
            </div>

            <div class="col-md-3">
                <span class="glyphicon glyphicon-user"></span>
                <label for="validationDefault02" class="form-label">P. nombre:</label>
                <input type="text" name="nombre1" value="{{$datos->nombre1}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" required />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">S. nombre:</label>
                <input type="text" name="nombre2" value="{{$datos->nombre2}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" name="appat" value="{{$datos->appat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" name="apmat" value="{{$datos->apmat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                <input type="text" name="profesion" value="{{$datos->profesion}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" name="cargo2" value="{{$datos->cargo}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="txt-gray form-label">Situaci&oacute;n cargo:</label>
                <select name="sitcargo" class="form-control" id="sel1" required>
                    <optgroup label="Situación Actual:">
                        <option value="{{$datos->sit_cargo}}" selected readonly><b>{{$datos->sit_cargo}}</b></option>
                    </optgroup>
                    @if( $datos->sit_cargo == 'ENCARGADO' )
                    <option value="TITULAR">TITULAR</option>
                    @elseif( $datos->sit_cargo == 'TITULAR')
                    <option value="ENCARGADO">ENCARGADO</option>
                    @else
                    <option value="ENCARGADO">ENCARGADO</option>
                    <option value="TITULAR">TITULAR</option>
                    @endif
                </select>
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="txt-gray form-label">G&eacute;nero:</label>
                <select name="sexo2" class="form-control" id="sel1" required>
                    <optgroup label="Género Actual:">
                        <option value="{{$datos->sexo}}" selected readonly><b>{{$datos->sexo}}</b></option>
                    </optgroup>
                    @if( $datos->sexo== 'FEMENINO' )
                    <option value="MASCULINO">MASCULINO</option>
                    @elseif( $datos->sexo == 'MASCULINO' )
                    <option value="FEMENINO">FEMENINO</option>
                    @else
                    <option value="FEMENINO">FEMENINO</option>
                    <option value="MASCULINO">MASCULINO</option>
                    @endif
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel nominal:</label>
                <input type="text" name="nivelnominal" value="{{$datos->nivel_nom}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" name="rango2" value="{{$datos->rango}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                <input type="text" name="claveua" value="{{$datos->clave_ua}}" pattern="[A-Z0-9\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

        </section>

        <section>

            <!-- Domicilio -->

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Domicilio</h3>
                <hr>
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                <input type="text" name="calle" value="{{$datos->calle}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                <input type="text" name="refcall1" value="{{$datos->referencia1}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 2:</label>
                <input type="text" name="refcall2" value="{{$datos->referencia2}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                <input type="text" name="numext" value="{{$datos->numext}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                <input type="text" name="numint" value="{{$datos->numint}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                <input type="text" name="colonia" value="{{$datos->colonia}}" pattern="[A-Za-z0-9/\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                <input type="text" name="ciudad" value="{{$datos->ciudad}}" pattern="[A-Za-z0-9/\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="txt-gray">Municipio:</label>
                <select name="muni" class="form-control" id="sel1" required>
                    <optgroup label="Municipio Actual:">
                        <option value="{{$datos->id_municipio}}" selected readonly><b>{{$datos->nombre_municipio}}</b></option>
                    </optgroup>
                    @foreach( $datos3 as $mun)
                    @if( $mun->id_municipio != $datos->id_municipio )
                    <option value="{{$mun->id_municipio}}">{{$mun->nombre_municipio}}</option>
                    @endif
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                <input type="text" name="barrio" value="{{$datos->barrio}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                <input type="text" name="piso" value="{{$datos->piso}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                <input type="text" name="puerta" value="{{$datos->puerta}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                <input type="number" name="cp" value="{{$datos->cp}}" maxlength="5" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-12 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" name="refadicional" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>



            <!-- Contacto -->

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Contacto</h3>
                <hr>
            </div>

            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-envelope txt-gray txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray txt-gray">Correo 1:</label>
                <input type="text" name="correo1" value="{{$datos->correo1}}" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
            </div>

            <div class="col-md-6 mb-3">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                <input type="text" name="correo2" value="{{$datos->correo2}}" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                <input type="text" name="lada" value="{{$datos->lada}}" pattern="[0-9]+" maxlength="3" title="Ingresa solo números." placeholder="###" class="form-control" id="validationDefault02" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                <input type="text" name="tel1" value="{{$datos->tel1}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                <input type="text" name="tel2" value="{{$datos->tel2}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                <input type="text" name="tel3" value="{{$datos->tel3}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
            </div>

            <div class="col-md-2 mb-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                <input type="text" name="tel4" value="{{$datos->tel4}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
            </div>

            <div>
                <div class="col-md-1 mb-3">
                    <span class="glyphicon glyphicon-earphone txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                    <input type="text" name="ext1" value="{{$datos->ext1}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-1 mb-3">
                    <span class="glyphicon glyphicon-earphone txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                    <input type="text" name="ext2" value="{{$datos->ext2}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                </div>
            </div>

            <!--<div class="col-md-1">
                    <span class="glyphicon glyphicon-earphone"></span>
                    <label for="validationDefault02" class="form-label">Fax 1:</label>
                    <input type="text" name="fax1" value="{{$datos->fax1}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02"/>
                </div>
                
                <div class="col-md-1">
                    <span class="glyphicon glyphicon-earphone"></span>
                    <label for="validationDefault02" class="form-label">Fax 2:</label>
                    <input type="text" name="fax2" value="{{$datos->fax2}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02"/>
                </div>-->

            <div>
                <div class="col-md-4 mb-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                    <input type="text" name="facebook" value="{{$datos->facebook}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-4 mb-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                    <input type="text" name="twitter" value="{{$datos->twitter}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-4 mb-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">P&aacute;gina web:</label>
                    <input type="text" name="web" value="{{$datos->web}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                </div>
            </div>

            <div class="col-md-8" id="separacionbottom">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" name="refead" value="{{$datos->ref_con}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

        </section class="col-12">


        <div class="col-12 py-5 text-center">
            <button class="btn btn-success" type="submit">CONFIRMAR CAMBIOS</button>
            
        </div>




        <!-- cierre resaltardatos-->
    </div>


    </form>
</div>



























<!-- CÉDULAS DIRECTAS PUBLICADAS -->
@elseif( $seccion == 3 )

@if( $datos != null )

<div class="formm">
    <div class="table-responsive m-3 p-3">
        <table id="tablaCedulasInstruccion" class="table">

            <thead>
                <tr id="trencabezado">
                    <th scope="col" style="width:8%">FOLIO:</th>
                    <th scope="col" style="width:30%">DATOS PERSONALES:</th>
                    <!--<th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">DOMICILIO:</th>
                    <th scope="col">CONTACTO:</th>
                    <th scope="col" id="anchoculumna1">MOTIVO:</th>-->
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
                        <b><span class="glyphicon glyphicon-user"></span> Nombre:</b>
                        {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                    </td>

                    <!--<td>
                            <b>Cargo:</b> {{$ob->cargo}}<br>
                            <b>Situaci&oacute;n cargo:</b> {{$ob->sit_cargo}}<br>
                            <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                            <b>Nivel nominal:</b> {{$ob->nivel_nom}}<br>
                            <b>Rango:</b> {{$ob->rango}}<br>
                            <b>Clave UA:</b> {{$ob->clave_ua}}<br>
                        </td>

                        <td>
                            <b>Motivo del cambio:</b><br>
                            <span class="glyphicon glyphicon-info-sign"></span> {{$ob->tipo_cambio}}<br><br>
                        </td>-->

                    <td>
                        <b><span class="glyphicon glyphicon-info-sign"></span> Estatus: </b>
                        {{$ob->descripcion}}<br>

                        <!--<b>Fecha:</b><br>
                            <span class="glyphicon glyphicon-calendar"></span> {{$ob->fecha_publicacionrdsp}}<br><br>-->

                        @if( $ob->observaciones != null)
                        <b><span class="glyphicon glyphicon-search"></span> Observaciones: </b>
                        {{$ob->observaciones}}<br>
                        @endif
                    </td>

                    <td class="d-flex">

                        <form action="cedulainfo" method="post">
                            @csrf

                            <input type="hidden" name="regreso" value="3002" />
                            <input type="hidden" name="iddet" value="{{ $ob->id_detalle}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <button class="btn btn-info m-2" id="tamanioboton" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Más">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </button>

                        </form>

                        @if($ob->tipo_cambio == 'ACTUALIZACIÓN')
                        <form action="eliminarpub" method="post" autocomplete="off">
                            @csrf

                            <input type="hidden" name="regreso" value="3002" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />

                            <div id="separacion" class="m-2">
                                <button id="tamanioboton" class="btn btn-danger" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Cédula">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </button>
                            </div>

                        </form>
                        <!--<div id="separacion"><a href="{{ route('eliminarpub',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-danger" id="tamanioboton">ELIMINAR C&Eacute;DULA</a></div>-->
                        @endif

                    </td>

                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS PERSONALES:</th>
                    <!--<th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">DOMICILIO:</th>
                    <th scope="col">CONTACTO:</th>
                    <th scope="col" id="anchoculumna1">MOTIVO:</th>-->
                    <th scope="col" id="anchoculumna2">DETALLES:</th>
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
                    <p class="txt-notify-s">No se encontraron cédulas publicadas</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

@endif

@endsection