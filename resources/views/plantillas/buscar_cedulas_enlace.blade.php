@extends('plantillas/nav')

@section('content')

<div class="p-3 mb-2 bg-banner text-white">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>


<!--  FORM PARA BUSCAR LAS CÉDULAS DEL ENLACE  -->
@if( $seccion == 1 )

<div class="formm">
    <form action="{{route('buscarced_e')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
            <hr>
        </div>


        <div class="col-md-4 mb-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Recibidas:</label>
            <select name="usuario" class="form-control" id="sel1">
                <optgroup label="Selecciona cualquier Usuario:">
                    <option value="0" selected readonly><b>Sin argumento</b></option>
                    <option disabled><b></b></option>
                </optgroup>
                @foreach( $recibidas as $ob )
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @endforeach
            </select>
        </div>


        <div class="col-md-4 mb-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Enviadas:</label>
            <select name="rdsp" class="form-control" id="sel1">
                <optgroup label="Selecciona cualquier RDSP:">
                    <option value="0" selected readonly><b>Sin argumento</b></option>
                    <option disabled><b></b></option>
                </optgroup>
                @foreach( $enviadas as $ob )
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
                @foreach( $estatus as $ob2 )
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


















<!-- FORM DE RESULTADOS DE LA BÚSQUEDA DE LAS CÉDULAS DEL ENLACE -->
@elseif( $seccion == 2 )

<div class="formm">
    <form action="{{route('buscarced_e')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
            <hr>
        </div>

        <div class="col-md-4">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Recibidas:</label>
            <select name="usuario" class="form-control" id="sel1">
                @if( $usuariorec != 0 )
                @foreach( $recibidas as $ob )
                @if( $usuariorec == $ob->idcredencial )
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}" selected>Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                    <option disabled></option>
                </optgroup>
                @else
                <optgroup label="Selecciona cualquier Usuario:">
                    <option value="0" readonly><b>Sin argumento</b></option>
                    <option disabled><b></b></option>
                </optgroup>
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @endif
                @endforeach
                @else
                <optgroup label="Selecciona cualquier Usuario:">
                    <option value="0" selected readonly><b>Sin argumento</b></option>
                    <option disabled><b></b></option>
                </optgroup>
                @foreach( $recibidas as $ob )
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
            <label for="sel1">Enviadas:</label>
            <select name="rdsp" class="form-control" id="sel1">
                @if( $rdspenv != 0 )
                @foreach( $enviadas as $ob )
                @if( $cantidadrdsp == 1 )
                <optgroup label="Selecciona cualquier RDSP:">
                    <option value="0" readonly><b>Sin argumento</b></option>
                    <option disabled><b></b></option>
                </optgroup>
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}" selected>Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @else
                @if( $rdspenv == $ob->idcredencial )
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                    <option disabled></option>
                </optgroup>
                @else
                <optgroup label="Selecciona cualquier RDSP:">
                    <option value="0" readonly><b>Sin argumento</b></option>
                    <option disabled><b></b></option>
                </optgroup>
                <optgroup label="{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                    <option value="{{$ob->idcredencial}}">Correo: {{$ob->correo}}</option>
                    <option disabled>Cargo: {{$ob->cargo}}</option>
                    <option disabled>UA: {{$ob->unidad}}</option>
                </optgroup>
                @endif
                @endif
                @endforeach
                @else
                <optgroup label="Selecciona cualquier RDSP:">
                    <option value="0" selected readonly><b>Sin argumento</b></option>
                    <option disabled><b></b></option>
                </optgroup>
                @foreach( $enviadas as $ob )
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
                @foreach( $estatus as $ob )
                @if( $estatusreq == $ob->id_estado )
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
                @foreach( $estatus as $ob )
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



<div class="formm">
    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Resultado de la búsqueda</h3>
        <hr>
    </div>
</div>

@if( $datos != null )
<div class="formm">
    <table id="tablaBusquedaEnlace" class="table">

        <thead>
            <tr id="trencabezado">
                <th scope="col">FOLIO:</th>
                <th scope="col">DATOS PERSONALES:</th>
                <!--<th scope="col">DOMICILIO:</th>
                                <th scope="col">CONTACTO:</th>-->
                <th scope="col">DETALLES:</th>
                <th scope="col">OPCIONES:</th>
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

                <th>
                    {{$ob->folio}}
                </th>

                <td>
                    <b><span class="glyphicon glyphicon-user"></span> Nombre: </b> {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                </td>


                <td>
                    <!--<span class="glyphicon glyphicon-refresh"></span><b> Motivo:</b><br>
                                        {{$ob->tipo_cambio}}<br><br>

                                        <span class="glyphicon glyphicon-calendar"></span><b> Recibida:</b><br>
                                        {{$ob->fecha_enviousuario}}<br><br>-->

                    <span class="glyphicon glyphicon-info-sign"></span><b> Estatus: </b>
                    {{$ob->descripcion}}<br>

                    <span class="glyphicon glyphicon-user"></span><b> Recibida de:</b>
                    {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>
                    <!--<span class="glyphicon glyphicon-envelope"></span><b> {{$ob->correousu}}</b>-->

                    @if( $ob->correordsp != null )
                    <span class="glyphicon glyphicon-user"></span><b> Enviada a:</b>
                    {{$ob->rdspnom1}} {{$ob->rdspnom2}} {{$ob->rdspappat}} {{$ob->rdspapmat}}<br>
                    <!--<span class="glyphicon glyphicon-envelope"></span><b> {{$ob->correordsp}}</b><br><br>-->
                    @endif

                    @if( $ob->observaciones != null)
                    <span class="glyphicon glyphicon-search"></span><b> Observaciones: </b>
                    {{$ob->observaciones}}<br>
                    @endif
                </td>

                <td style="padding-top: 1%">
                    <form action="cedulainfo" method="post">
                        @csrf

                        <input type="hidden" name="regreso" value="2002" />
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
                <!--<th scope="col">DOMICILIO:</th>
                                <th scope="col">CONTACTO:</th>-->
                <th scope="col">DETALLES:</th>
                <th scope="col">OPCIONES:</th>
            </tr>
        </tfoot>

    </table>
</div>

@else


<div class="m-auto py-5">
    <div class="card shadow-lg notify notify-warning">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/not-found-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">SIN RESULTADOS</h1>
                    <p class="txt-notify-s">No se encontraron cédulas con los parámetros dados.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>


@endif

@endif

@endsection