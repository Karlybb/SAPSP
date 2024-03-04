@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>

@if($datos != null)
<div class="formm">
    <div class="table-responsive p-3 m-3">
        <table id="tablaCedulasRecha" class="table">

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
                        <b><span class="glyphicon glyphicon-user"></span> Nombre: </b>{{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
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
                        <b><span class="glyphicon glyphicon-info-sign"></span> Estatus: </b>
                        {{$ob->descestado}}<br>

                        <!--<b>Motivo:</b><br>
                        <span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}<br><br>

                        <b>Recibida:</b><br>
                        <span class="glyphicon glyphicon-pencil"></span> {{$ob->fecha_validacionenlace}}<br><br>-->

                        <b><span class="glyphicon glyphicon-user"></span> Recibida de: </b>
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>

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

                            <input type="hidden" name="regreso" value="3001" />
                            <input type="hidden" name="iddet" value="{{ $ob->id_detalle}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="separacion">
                                <button class="btn btn-info" id="tamanioboton" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Más">
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
                    <p class="txt-notify-s">No se encontraron cédulas rechazadas por el perfil actual.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

@endsection