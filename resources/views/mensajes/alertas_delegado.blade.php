@extends('plantillas/nav')

@section('content')
<div class="formm">



    <!--    SATISFACTORIO ENVIAR CÉDULA AL ENLACE  -->
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
                            <form action="enviarcedula" method="post">

                                @csrf

                                <input type="hidden" value="{{$idreq}}" name="idreq" class="form-control" id="validationDefault01" />
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="d-flex">
                                    <button class="btn btn-success m-2" type="submit">CONFIRMAR CAMBIOS</button>
                                    <a href="{{route('pendientes')}}" class="btn btn-secondary m-2" type="button">REGRESAR</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>




    <!--    BORRAR CÉDULA DELEGADO   -->
    @elseif( $seccion == 2 )

    <div class="m-auto">
        <div class="card shadow-lg notify notify-danger">
            <section class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <img src="{{ asset('/public/img/icons/delete-icon.png') }}" width="80">
                    </div>
                    <div class="text-center px-3">
                        <h3 class="text-danger">{{ $titulo }}</h3>
                        <h5 class="txt-gray">{{ $subtitulo }}</h5>

                        <form action="eliminacedula" method="post">
                            @csrf

                            <input type="hidden" value="{{$idreq}}" name="idreq" class="form-control" id="validationDefault01" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            
                            <div class="mt-4">
                                <button class="btn btn-danger" type="submit">ELIMINAR CÉDULA</button>
                                <a href="{{route('pendientes')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </section>
        </div>
    </div>







    @endif


</div>

@endsection