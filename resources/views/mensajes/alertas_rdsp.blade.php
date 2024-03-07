@extends('plantillas/nav')

@section('content')




<!--    PUBLICAR CÉDULA NORMAL  -->
@if( $seccion == 1 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-success">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/check-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h3 align="center">{{ $titulo }}</h3>
                    <h5 align="center">{{ $subtitulo }}</h5>
                    <br>
                    <div class="d-flex justify-content-center">
                        <form action="validacedulardsp" method="post">
                            @csrf
                            <input type="hidden" value="{{$idreq}}" name="idreq" class="form-control" id="validationDefault01" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button class="btn btn-success m-2" type="submit">VALIDAR</button>
                            @if( $regreso == 1 )
                            <a href="{{route('bandejardsp')}}" class="btn btn-secondary m-2" type="button">REGRESAR</a>
                            @elseif( $regreso == 2 )
                            <a href="{{route('cedulaspendientes')}}" class="btn btn-secondary m-2" type="button">REGRESAR</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>







<!--    INVALIDAR CÉDULA    -->
@elseif( $seccion == 2 )

<div class="formm tamposalertas">
    <form action="{{route('rechazarcedulardsp')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <input type="text" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" hidden />
        <input type="text" value="{{$datos->id_cedula}}" name="idced" class="form-control" id="validationDefault01" hidden />


        <div class="card p-5 notify-danger" id="izq" role="alert">
            <div class="text-center mb-3">
                <h1 class="txt-danger">{{ $titulo }}</h1>
                <h5 class="txt-gray">{{ $subtitulo }}</h5>
            </div>

            <div class="col-md-12">
                <span class="glyphicon glyphicon-pencil"></span>
                <label for="validationDefault02" class="form-label">Comentario:</label>
                <textarea name="texto" id="" cols="5" rows="10" maxlength="300" title="Ingresa un comentario." class="form-control" required></textarea>
                <p><b>Caracteres máximos 300.</b></p>
                <p class="text-justify txt-gray">Ingresa un comentario del porqué vas a rechazar la cédula, para tener una realimentaci&oacute;n.</p>
            </div>

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />


            <div id="separacion">
                <div align="center">
                    <button class="btn btn-success" type="submit">CONFIRMAR CAMBIOS</button>
                    @if( $regreso == 1 )
                    <a href="{{route('bandejardsp')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                    @elseif( $regreso == 2 )
                    <a href="{{route('cedulaspendientes')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                    @endif
                </div>
            </div>
        </div>


    </form>
</div>




<!--  ELIMINAR PERIODO VACACIONAL  -->
@elseif( $seccion == 3 )

<!-- <div class="alert alert-danger" id="msj" role="alert">

    <h3 align="center">{{ $titulo }}</h3>
    <h5 align="center">{{ $subtitulo }}</h5>

    <div class="col-12" align="center">

        <form action="eliminarperiodo" method="post">
            @csrf

            <input type="hidden" name="_id" value="{{$idvac}}" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div id="separacion">
                <div align="center">
                    <button class="btn btn-danger" type="submit">ELIMINAR PERIODO</button>
                    <a href="{{route('consultarperiodo')}}" class="btn btn-success" type="button">REGRESAR</a>

                </div>
            </div>

        </form>

    </div>
</div> -->



<div class="m-auto">
    <div class="card shadow-lg notify notify-danger">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/delete-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h3 class="text-danger">{{ $titulo }}</h3>
                    <h5 class="text-gray">{{ $subtitulo }}</h5>
                    <br>
                    <div class="my-3">
                        <form action="eliminarperiodo" method="post">
                            @csrf

                            <input type="hidden" name="_id" value="{{$idvac}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div id="separacion">
                                <div align="center">
                                    <button class="btn btn-success m-1" type="submit">ELIMINAR PERIODO</button>
                                    <a href="{{route('consultarperiodo')}}" class="btn btn-secondary m-1" type="button">REGRESAR</a>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>






<!--    ROLLBACK    -->
@elseif( $seccion == 4 )


<div class="m-auto">
    <div class="card shadow-lg notify notify-danger">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/delete-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="text-danger">{{ $titulo }}</h1>
                    <h5 class="txt-gray">{{ $subtitulo }}</h5>
                    <div class="my-3">
                        <form action="eliminarpublicacion" method="post">
                            @csrf

                            <input type="hidden" name="_id" value="{{$datos->id_det}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div class="py-3">
                                <button class="btn btn-danger" type="submit">ELIMINAR</button>
                                @if( $directa == true )
                                <a href="{{route('cedulasdiraprobadas')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                                @else
                                <a href="{{route('cedulaspublicadas')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                                @endif
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

@endif



@endsection