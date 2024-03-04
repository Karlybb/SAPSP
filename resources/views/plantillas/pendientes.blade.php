@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">CÉDULAS PENDIENTES</h1>
    <h5 align="center">Listado de las cédulas en espera para validar los datos y ser enviadas al enlace.</h5>
</div>

@if($datos != null)

<div class="formm">
    <div class="table-responsive">
        <table id="delPendientes" class="table">

            <thead>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS PERSONALES:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">DETALLES:</th>
                    <th scope="col" class="text-center">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>

                @foreach($datos as $ob)
                <tr id="tablaneutro">

                    <th scope="row">
                        {{$ob->folio}}
                    </th>

                    <td>
                        @if( Session::get('srol') == 99 )
                        <b>ID Persona:</b> {{$ob->idpersona}}<br>
                        @endif
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
                        <b>Motivo:</b><br>
                        <span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}<br><br>

                        <b>Creada:</b><br>
                        <span class="glyphicon glyphicon-pencil"></span> {{$ob->created_at}}<br><br>

                        <b>Enviar a:</b><br>
                        <span class="glyphicon glyphicon-user"></span> {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>
                        <span class="glyphicon glyphicon-envelope"></span> <b>{{$ob->correo}}</b>
                    </td>

                    <td>
                        <div class="d-flex justify-content-center">
                            <div class="m-2">
                                <form action="modificardatos" method="post" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                                    <button id="tamanioboton" class="btn btn-warning" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="Modificar Datos">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                </form>
                                <!--<a href="{{ route('modificardatos',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-warning" id="tamanioboton">MODIFICAR DATOS</a>-->
                            </div>
                            <div id="separacionbtnpendientes" class="m-2">
                                <form action="validardatos" method="post" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                                    <button id="tamanioboton" class="btn btn-success glyphicon glyphicon-send" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="Enviar Cédula"></button>
                                </form>
                                <!--<a href="{{ route('validardatos',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-success" id="tamanioboton">ENVIAR C&Eacute;DULA</a>-->
                            </div>
                            <div id="separacionbtnpendientes" class="m-2">
                                <form action="eliminarcedula" method="post" autocomplete="off">
                                    @csrf
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="_id" value="{{ $ob->id_detalle }}" />
                                    <button id="tamanioboton" class="btn btn-danger glyphicon glyphicon-trash" type="submit" data-bs-toggle="tooltip" data-bs-placement="left" title="Eliminar Cédula"></button>
                                </form>
                                <!--<a href="{{ route('eliminarcedula',['id'=>$ob->id_detalle]) }}" type="button" class="btn btn-danger" id="tamanioboton">ELIMINAR C&Eacute;DULA</a>-->
                            </div>
                        </div>
                    </td>

                </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS PERSONALES:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">DETALLES:</th>
                    <th scope="col" class="text-center">OPCIONES:</th>
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
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

@endsection