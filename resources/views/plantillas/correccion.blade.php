@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">CORRECCIÓN DE CÉDULAS</h1>
    <h5 align="center">Listado de las cédulas ha corregir</h5>
</div>



<!-- DESPLIEGUE DE LAS CEDULAS POR CORREGIR -->
@if( $seccion == 1 )

@if($datos != null)
<div class="formm">
    <table id="tabladt" class="table">

        <thead>
            <tr id="trencabezado">
                <th scope="col">FOLIO:</th>
                <th scope="col">DATOS PERSONALES:</th>
                <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                <th scope="col">CORRECCI&Oacute;N:</th>
                <th scope="col">DETALLES:</th>
                <th scope="col">OPCIONES:</th>
            </tr>
        </thead>

        @foreach($datos as $ob)
        <tbody>
            <tr id="tablaamarillo">
                <th scope="row">
                    {{$ob->folio}}
                </th>

                <td>
                    <b>Nombre:</b> {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                    <b>Sexo:</b> {{$ob->sexo}}
                </td>

                <td>
                    <b>Cargo:</b> {{$ob->cargo}}<br>
                    <b>Situaci&oacute;n cargo:</b> {{$ob->sit_cargo}}<br>
                    <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                    <b>Nivel nominal:</b> {{$ob->nivel_nom}}<br>
                    <b>Rango:</b> {{$ob->rango}}<br>
                    <b>Clave UA:</b> {{$ob->clave_ua}}<br>
                </td>

                <td>
                    <b>Dato(s) a corregir:</b><br>
                    @foreach( $array as $elementos )
                    @foreach( $elementos as $ob2 )
                    @if( $ob->id_detalle == $ob2->detcor )
                    <span class="glyphicon glyphicon-pencil"></span> {{$ob2->correccion}}<br><br>
                    @endif
                    @endforeach
                    @endforeach

                </td>

                <td>
                    <b>Motivo:</b><br>
                    <span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}<br><br>

                    <b>Creada:</b><br>
                    <span class="glyphicon glyphicon-pencil"></span> {{$ob->created_at}}<br><br>

                    <b>Enviar a:</b><br>
                    <span class="glyphicon glyphicon-user"></span> {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>
                    <span class="glyphicon glyphicon-envelope"></span> <b>{{$ob->correo}}</b>
                </td>

                <td>
                    <div>
                        <form action="modificardatos" method="post" autocomplete="off">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                            <!--<button id="tamanioboton" class="btn btn-warning" type="submit">MODIFICAR DATOS</button>-->
                            <button id="tamanioboton" class="btn btn-warning m-2" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar Datos">
                                <span class="glyphicon glyphicon-refresh"></span>
                            </button>
                        </form>
                        <!--<a href="{{ route('modificardatos',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-warning" id="tamanioboton">MODIFICAR DATOS</a>-->
                    </div>
                </td>

            </tr>
        </tbody>

        <tfoot>
            <tr id="trencabezado">
                <th scope="col">FOLIO:</th>
                <th scope="col">DATOS PERSONALES:</th>
                <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                <th scope="col">CORRECCI&Oacute;N:</th>
                <th scope="col">DETALLES:</th>
                <th scope="col">OPCIONES:</th>
            </tr>
        </tfoot>
        @endforeach
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
                    <p class="txt-notify-s">No se encontraron cédulas pendientes por corregir.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endif





<!-- VISTA PARA MODIFICAR LAS CORRECCIONES -->
@elseif( $seccion == 2 )

@endif



@endsection