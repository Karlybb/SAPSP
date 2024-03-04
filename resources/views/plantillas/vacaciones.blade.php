@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>


<!-- CREACIÓN DE PERIODO VACACIONAL -->
@if( $seccion == 1)


@if( $periodo == 0 )
<div class="formm">
    <form action="{{route('crearperiodo')}}" method="post" autocomplete="off" class="row g-3">
        @csrf


        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Selecciona tu rango vacacional.</h3>
            <hr>
        </div>

        <div id="vacaciones">

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-calendar txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">De:</label>
                <input type="date" name="fecha1" class="form-control upper" id="validationDefault01" required />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-calendar txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">A:</label>
                <input type="date" name="fecha2" class="form-control upper" id="validationDefault01" required />
            </div>

        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">CREAR PERIODO</button>
            </div>
        </div>

    </form>
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
                    <h1 class="txt-notify">YA EXISTE UN PERIODO VACACIONAL</h1>
                    <p class="txt-notify-s">Solo puedes tener un periodo vacacional activo.</p>
                </div>
            </div>
        </section>
    </div>
</div>

@endif




<!-- DESPLIEGUE DEL PERIODO VACACIONAL ACTUAL -->
@elseif( $seccion == 2 )

@if( $datos != null )

<div class="formm">

    <legend align="center">Periodo Vacacional Activo.</legend>

    <table id="tablaPeriodoVacacional">

        <thead>
            <tr>
                <th scope="col">DATOS PERSONALES:</th>
                <th scope="col">PERIODO VACACIONAL:</th>
                <th scope="col">OPCIONES:</th>
            </tr>
        </thead>

        @foreach($datos as $ob)
        <tbody>

            <tr>
                <th scope="row">{{$datos2->nombre1}} {{$datos2->nombre2}} {{$datos2->apellidopat}} {{$datos2->apellidomat}}</th>

                <td>Del: <b>{{$ob->fecha1}}</b> al <b>{{$ob->fecha2}}</b></td>

                <td class="d-flex">
                    <div class="m-2">
                        <form action="{{route('modificarper')}}" method="post" autocomplete="off" class="row g-3">
                            @csrf

                            <input type="hidden" name="_id" value="{{$ob->idvacaciones}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="separacion">
                                <div class="col-12 m-3">
                                    <button class="btn btn-warning" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar Datos">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                    <div id="separacionbtnpendientes" class="m-2">
                        <form action="{{route('eliminaperiodo')}}" method="post" autocomplete="off" class="row g-3">
                            @csrf

                            <input type="hidden" name="_id" value="{{$ob->idvacaciones}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="separacion">
                                <div class="col-12 m-3">
                                    <button class="btn btn-danger" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar Periodo">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </td>

            </tr>

        </tbody>
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
                    <p class="txt-notify-s">No se encontraron periodos vacacionales.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>


@endif





<!-- MODIFICAR PERIODO VACACIONAL -->
@elseif( $seccion == 3 )

<div class="formm">
    <form action="{{route('modificarperiodo')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <legend align="center">Selecciona tu rango Vacacional.</legend>

        <div id="vacaciones">

            <input type="text" name="idvac" value="{{$datos->idvacaciones}}" class="form-control upper" id="validationDefault01" hidden />

            <div class="col-md-3">
                <span class="glyphicon glyphicon-calendar"></span>
                <label for="validationDefault01" class="form-label">De:</label>
                <input type="date" name="fecha1" value="{{$fecha1}}" class="form-control upper" id="validationDefault01" required />
            </div>

            <div class="col-md-3">
                <span class="glyphicon glyphicon-calendar"></span>
                <label for="validationDefault01" class="form-label">A:</label>
                <input type="date" name="fecha2" value="{{$fecha2}}" class="form-control upper" id="validationDefault01" required />
            </div>

        </div>

        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">MODIFICAR PERIODO</button>
            </div>
        </div>

    </form>
</div>

@endif

@endsection