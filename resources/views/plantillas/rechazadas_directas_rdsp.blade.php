@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>

@if($datos != null)
<div class="formm">
    <div class="table-responsive m-3 p-3">
        <table id="tablaCedulasInstRecha" class="table">

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
                <tr id="tablarojo">

                    <th scope="row">
                        {{$ob->folio}}
                    </th>

                    <td>
                        <b><span class="glyphicon glyphicon-refresh"></span> Nombre: </b>
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
                        <!--<b>Motivo del cambio:</b><br>
                        <span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}<br><br>-->

                        <b><span class="glyphicon glyphicon-info-sign"></span> Estatus: </b>
                        {{$ob->descestado}}<br>

                        <!--<b>Rechazada:</b><br>
                        <span class="glyphicon glyphicon-remove"></span> {{$ob->fecha_publicacionrdsp}}<br><br>-->

                        @if( $ob->observaciones != null)
                        <b><span class="glyphicon glyphicon-search"></span> Observaciones: </b>
                        {{$ob->observaciones}}<br>
                        @endif
                    </td>

                    <td>
                        <form action="cedulainfo" method="post">
                            @csrf

                            <input type="hidden" name="regreso" value="3003" />
                            <input type="hidden" name="iddet" value="{{ $ob->id_detalle}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <button class="btn btn-info" id="tamanioboton" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Más">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </button>

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
</div>


@else
<div class="alert alert-info" id="msj" role="alert">
    <h1 align="center">SIN RESULTADOS</h1>
    <h5 align="center">No se encontraron c&eacute;dulas rechazadas por el perfil actual.</h5>
    <div class="col-12" align="center">
        <a href="{{route('/')}}" class="btn btn-primary" type="button">IR A INICIO</a>
    </div>
</div>
@endif

@endsection