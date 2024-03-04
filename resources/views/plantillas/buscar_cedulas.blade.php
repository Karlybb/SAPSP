@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 class="text-center">{{ $titulo }}</h1>
    <h5 class="text-center">{{ $subtitulo }}</h5>
</div>

<!--  FORM PARA BUSCAR LAS CÉDULAS  -->
@if( $seccion == 1 )

<div class="formm">
    <form action="{{route('buscarced')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
        <hr>

        <div class="col-md-4">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Enlaces:</label>
            <select name="enlace" class="form-control txt-gray" id="sel1">
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

        <div class="col-md-4">
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

        <div class="col-md-2">
            <span class="glyphicon glyphicon-calendar txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Fecha inicio:</label>
            <input type="date" name="fecha1" min="2022-06-01" class="form-control" id="validationDefault01" />
        </div>

        <div class="col-md-2">
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

<div class="separacion-footer"></div>




<!-- FORM DE LOS RESULTADOS DE LA BUSQUEDA -->
@elseif( $seccion == 2 )

<div class="formm">
    <form action="{{route('buscarced')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
        <hr>

        <div class="col-md-4">
            <span class="glyphicon glyphicon-tasks"></span>
            <label for="sel1">Enlaces:</label>
            <select name="enlace" class="form-control" id="sel1">
                <optgroup label="Selecciona cualquier Enlace:">
                    <option value="0" selected readonly><b>Sin argumento</b></option>
                    <option disabled></option>
                </optgroup>
                @foreach( $datos2 as $ob )
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <span class="glyphicon glyphicon-tasks"></span>
            <label for="sel1">Estatus:</label>
            <select name="estatus" class="form-control" id="sel1">
                <optgroup label="Selecciona cualquier Estatus:">
                    <option value="0" selected readonly>Sin argumento</option>
                    <option disabled></option>
                </optgroup>
                @foreach( $datos3 as $ob2 )
                <option value="{{$ob2->id_estado}}">{{$ob2->estado}} - {{$ob2->descripcion}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <span class="glyphicon glyphicon-calendar"></span>
            <label for="validationDefault01" class="form-label">Fecha inicio:</label>
            <input type="date" name="fecha1" min="2022-06-01" class="form-control" id="validationDefault01" />
        </div>

        <div class="col-md-2">
            <span class="glyphicon glyphicon-calendar"></span>
            <label for="validationDefault01" class="form-label">Fecha fin:</label>
            <input type="date" name="fecha2" class="form-control" id="validationDefault01" />
        </div>


        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">BUSCAR</button>
            </div>
        </div>
    </form>
</div>

<div class="m-auto col-10">
    <h3 class="subtitle mt-5 text-center">Resultados de Búsqueda</h3>
    <hr>
</div>

@if( $datos != null )
<div class="formm">
    <div class="table-responsive">
        <table id="tablaCedulaEnv" class="table">

            <thead>
                <tr id="trencabezado">
                    <th scope="col" style="width:8%">FOLIO:</th>
                    <th scope="col" style="width:30%">DATOS PERSONALES:</th>
                    <th scope="col" style="width:30%">DETALLES:</th>
                    <th scope="col" style="width:8%">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>

                @foreach($datos as $ob)

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
                        {{ $ob->folio }}
                    </th>

                    <td>
                        <b><span class="glyphicon glyphicon-user"></span> Nombre: </b> {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                        <!--<b>G&eacute;nero:</b> {{$ob->sexo}}-->
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
                        <!--<span class="glyphicon glyphicon-refresh"></span><b> Motivo:</b><br>
                                {{$ob->tipo_cambio}}<br><br>-->

                        <span class="glyphicon glyphicon-info-sign"></span><b> Estatus: </b>
                        {{$ob->descripcion}}<br>

                        <span class="glyphicon glyphicon-user"></span><b> Enviada a: </b>
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>
                        <!--<span class="glyphicon glyphicon-envelope"><b> {{$ob->correo}}</b><br><br>

                                <span class="glyphicon glyphicon-calendar"></span><b> Fecha:</b><br>{{$ob->fecha_enviousuario}}<br><br>-->

                        @if( $ob->observaciones != null)
                        <span class="glyphicon glyphicon-search"></span><b> Observaciones: </b>
                        {{$ob->observaciones}}<br>
                        @endif

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
                    <p class="txt-notify-s">No se encontraron cédulas enviadas con los parámetros dados.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>

@endif

@endif

@endsection