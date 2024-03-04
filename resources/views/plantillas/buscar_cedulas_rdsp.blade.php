@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>




<!--  FORM PARA BUSCAR LAS CÉDULAS DEL ENLACE  -->
@if( $seccion == 1 )

<div class="formm">
    <form action="{{route('buscarced_r')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
            <hr>
        </div>

        <div>
            <div class="col-md-4 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Tipo de Búsqueda:</label>
                <select name="tipo" class="form-control txt-gray" id="sel1" required>
                    <optgroup label="Selecciona un tipo de Búsqueda:">
                        <option value="0" selected><b>C&eacute;dulas</b></option>
                        <option value="1">C&eacute;dulas por Instrucci&oacute;n</option>
                    </optgroup>
                </select>
            </div>
        </div>


        <div class="col-md-4 mb-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Enlaces:</label>
            <select name="enlace" class="form-control" id="sel1">
                <optgroup label="Selecciona cualquier Enlace:">
                    <option value="0" selected readonly><b>Sin argumento</b></option>
                    <option disabled></option>
                </optgroup>
                @foreach( $datos as $ob )
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @endforeach
            </select>
        </div>

        <div class="col-md-3 mb-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Estatus:</label>
            <select name="estatus" class="form-control" id="sel1">
                <optgroup label="Selecciona cualquier Estatus:">
                    <option value="0" selected readonly>Sin argumento</option>
                    <option disabled></option>
                </optgroup>
                @foreach( $datos2 as $ob2 )
                <option value="{{$ob2->id_estado}}">{{$ob2->estado}} - {{$ob2->descripcion}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 mb-3">
            <span class="glyphicon glyphicon-calendar txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Fecha inicio:</label>
            <input type="date" name="fecha1" min="2022-06-01" class="form-control" id="validationDefault01" />
        </div>

        <div class="col-md-2 mb-3">
            <span class="glyphicon glyphicon-calendar txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Fecha fin:</label>
            <input type="date" name="fecha2" class="form-control" id="validationDefault01" />
        </div>


        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">BUSCAR</button>
            </div>
        </div>
    </form>
</div>



















<!-- FORM DE DESPLIEGUE/BUSCAR CÉDULAS DEL RDSP-->
@elseif( $seccion == 2 )

<div class="formm">
    <form action="{{route('buscarced_r')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <legend align="center">Criterios de B&uacute;squeda</legend>



        <div>
            <div class="col-md-4">
                <span class="glyphicon glyphicon-tasks"></span>
                <label for="sel1">Tipo:</label>
                <select name="tipo" class="form-control" id="sel1" required>
                    <optgroup label="Selecciona un tipo de Búsqueda:">
                        @if( $tiporeq == 0 )
                        <option value="0" selected><b>C&eacute;dulas</b></option>
                        <option value="1">C&eacute;dulas por Instrucci&oacute;n</option>
                        @else
                        <option value="0"><b>C&eacute;dulas</b></option>
                        <option value="1" selected>C&eacute;dulas por Instrucci&oacute;n</option>
                        @endif
                    </optgroup>
                </select>
            </div>
        </div>




        <div class="col-md-4">
            <span class="glyphicon glyphicon-tasks"></span>
            <label for="sel1">Enlaces:</label>
            <select name="enlace" class="form-control" id="sel1">
                @if( $enlacereq != 0 )
                <optgroup label="Selecciona cualquier Enlace:">
                    <option value="0"><b>Sin argumento</b></option>
                    <option disabled></option>
                </optgroup>
                @foreach( $enlaces as $ob )
                @if( $enlacereq == $ob->idcredencial )
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}" selected>Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                    <option disabled></option>
                </optgroup>
                @else
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @endif
                @endforeach
                @else
                <optgroup label="Selecciona cualquier Enlace:">
                    <option value="0" selected readonly><b>Sin argumento</b></option>
                    <option disabled></option>
                </optgroup>
                @foreach( $enlaces as $ob )
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @endforeach
                @endif

            </select>
        </div>







        <div class="col-md-4">
            <span class="glyphicon glyphicon-tasks"></span>
            <label for="sel1">Estatus:</label>
            <select name="estatus" class="form-control" id="sel1">
                @if( $estatusreq != 0 )
                <optgroup label="Selecciona cualquier Estatus:">
                    <option value="0">Sin argumento</option>
                    <option disabled></option>
                </optgroup>
                @foreach( $estados as $ob )
                @if( $estatusreq == $ob->id_estado)
                <option value="{{$ob->id_estado}}" selected>{{$ob->estado}} - {{$ob->descripcion}}</option>
                @else
                <option value="{{$ob->id_estado}}">{{$ob->estado}} - {{$ob->descripcion}}</option>
                @endif
                @endforeach
                @else
                <optgroup label="Selecciona cualquier Estatus:">
                    <option value="0" selected readonly>Sin argumento</option>
                    <option disabled></option>
                </optgroup>
                @foreach( $estados as $ob )
                <option value="{{$ob->id_estado}}">{{$ob->estado}} - {{$ob->descripcion}}</option>
                @endforeach
                @endif
            </select>
        </div>


        <div class="col-md-2">
            <span class="glyphicon glyphicon-calendar"></span>
            <label for="validationDefault01" class="form-label">Fecha inicio:</label>
            <input type="date" name="fecha1" value="{{$fecha1req}}" min="2022-06-01" class="form-control" id="validationDefault01" />
        </div>


        <div class="col-md-2">
            <span class="glyphicon glyphicon-calendar"></span>
            <label for="validationDefault01" class="form-label">Fecha fin:</label>
            <input type="date" name="fecha2" value="{{$fecha2req}}" class="form-control" id="validationDefault01" />
        </div>


        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">BUSCAR</button>
            </div>
        </div>
    </form>
</div>

<legend align="center" id="separacion">Resultados de la B&uacute;squeda</legend>

@if( $datos3 != null )
<div class="formm">
    <table id="tabladt" class="table">

        <thead>
            <tr id="trencabezado">
                <th scope="col" style="width:8%">FOLIO:</th>
                <th scope="col" style="width:30%">DATOS PERSONALES:</th>
                <th scope="col" style="width:30%">DETALLES:</th>
                <th scope="col" style="width:8%">OPCIONES:</th>
            </tr>
        </thead>

        <tbody>

            @foreach($datos3 as $ob)

            @if( $ob->id_estadocedula == 1 || $ob->id_estadocedula == 2 )
            <tr id="tablaneutro">

                @elseif( $ob->id_estadocedula == 3 )
            <tr id="tablaamarillo">

                @elseif( $ob->id_estadocedula == 4 || $ob->id_estadocedula == 8 || $ob->id_estadocedula == 12 )
            <tr id="tablarojo">

                @elseif( $ob->id_estadocedula == 6 || $ob->id_estadocedula == 10 )
            <tr id="tablagris">

                @elseif( $ob->id_estadocedula == 7 || $ob->id_estadocedula == 11 )
            <tr id="tablaazul">

                @elseif( $ob->id_estadocedula == 13 )
            <tr id="tablaverde">

                @endif

                <th scope="row">
                    {{$ob->folio}}
                </th>

                <td>
                    <b><span class="glyphicon glyphicon-user"></span> Nombre: </b>
                    {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
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
                    <span class="glyphicon glyphicon-info-sign"></span><b> Estatus:</b>
                    {{$ob->descripcion}}<br>

                    <!--<span class="glyphicon glyphicon-refresh"></span><b> Motivo:</b><br>
                                        {{$ob->tipo_cambio}}<br><br>

                                        <span class="glyphicon glyphicon-calendar"></span><b> Recibida:</b><br>
                                        {{$ob->fecha_validacionenlace}}<br><br>-->

                    <span class="glyphicon glyphicon-user"></span><b> Recibida de:</b>
                    {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>
                    <!--<span class="glyphicon glyphicon-envelope"></span><b> {{$ob->correo}}</b>-->

                    @if( $ob->observaciones != null)
                    <span class="glyphicon glyphicon-search"></span><b> Observaciones:</b>
                    {{$ob->observaciones}}<br>
                    @endif

                    <!--@if( $ob->fecha_publicacionrdsp != null )
                                            <span class="glyphicon glyphicon-calendar"></span><b> Fecha:</b><br>
                                            {{$ob->fecha_publicacionrdsp}}<br><br>
                                        @endif-->
                </td>

                <td>
                    <form action="cedulainfo" method="post">
                        @csrf

                        <input type="hidden" name="regreso" value="3004" />
                        <input type="hidden" name="iddet" value="{{ $ob->id_detalle}}" />
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div>
                            <button class="btn btn-info" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver más">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </button>
                        </div>

                    </form>
                </td>

            </tr>

            @endforeach
        </tbody>

        <tfoot>
            <tr id="trencabezado">
                <th scope="col">FOLIO:</th>
                <th scope="col">DATOS PERSONALES:</th>
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
                    <p class="txt-notify-s">No se encontraron cédulas con los parámetros dados.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">INICIO</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

@endif

@endsection