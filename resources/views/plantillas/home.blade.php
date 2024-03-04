@extends('plantillas/nav')

@section('content')

<script>
    // 10 min/mili
    setTimeout("location.reload()", 600000);
</script>

<div class="p-2 mb-2 bg-banner text-white shadow-lg" id="recargarhome">
    <h3 align="center">SISTEMA DE ACTUALIZACI&Oacute;N DEL DIRECTORIO DE PERSONAS SERVIDORAS P&Uacute;BLICAS</h3>
</div>

@if( $seccion == 1 )

<!-- DELEGADO -->
@if( Session::get('srol') == 1 )

@if( $num > 0 )
<div class="m-auto">
    <div class="card shadow-lg notify notify-info">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TIENES CÉDULAS PENDIENTES</h1>
                    <p class="txt-notify-s">Consulta tus cédulas que se encuentran en proceso de ser validadas.</p>
                    <a href="{{route('pendientes')}}" class="btn btn-primary" type="button">Ir</a>
                </div>
            </div>
        </section>
    </div>
</div>

@endif

@if( $correccion > 0 )
<div class="m-auto">
    <div class="card shadow-lg notify notify-warning">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/not-found-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TIENES CÉDULAS POR CORREGIR</h1>
                    <p class="txt-notify-s">Consulta tus cédulas que se encuentran en proceso de ser corregidas.</p>
                    <a href="{{route('correcciones')}}" class="btn btn-warning" type="button">Ir</a>
                </div>
            </div>
        </section>
    </div>
</div>
<!--<div class="alert alert-warning" id="msj" role="alert">
    <h1 align="center">TIENES CÉDULAS POR CORREGIR</h1>
    <h5 align="center">Consulta tus cédulas que se encuentran en proceso de ser corregidas.</h5>
    <div class="col-12" align="center">
        <a href="{{route('correcciones')}}" class="btn btn-success" type="button">IR</a>
    </div>
</div>-->
@endif

@if( $num == 0 && $correccion == 0 )
<div class="m-auto">
    <div class="card shadow-lg notify notify-success">
        <section class="card-body my-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/check-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TODO SE ENCUENTRA ACTUALIZADO</h1>
                    <span class="txt-gray">No tienes cédulas pendientes.</span>
                </div>
            </div>
        </section>
    </div>
</div>

@endif







<!-- ENLACE -->
@elseif( Session::get('srol') == 2 && $num > 0 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-info">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TIENES CÉDULAS PENDIENTES</h1>
                    <p class="txt-notify-s">Consulta tu bandeja de entrada.</p>
                    <a href="{{route('bandejaenlace')}}" class="btn btn-primary" type="button">Ir</a>
                </div>
            </div>
        </section>
    </div>
</div>







<!-- RDSP -->
@elseif( Session::get('srol') == 3 && $num > 0 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-info">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TIENES CÉDULAS PENDIENTES</h1>
                    <p class="txt-notify-s">Consulta tu bandeja de entrada.</p>
                    <a href="{{route('bandejardsp')}}" class="btn btn-primary" type="button">Ir</a>
                </div>
            </div>
        </section>
    </div>
</div>







<!-- ADMINISTRADOR -->
@elseif( Session::get('srol') == 99 )

<!-- <div class="m-auto">
    <div class="alert alert-info text-center mt-5" id="msj" role="alert">
        <h1 align="center">¡BIENVENIDO ADMINISTRADOR!</h1>
    </div>
</div> -->

<div class="m-auto">
    <div class="card shadow-lg notify notify-success">
        <section class="card-body my-5">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/Success-Login.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">Bievenido Administrador</h1>
                    <span class="txt-gray">{{Session::get('sname')}}</span>
                </div>
            </div>
        </section>
    </div>
</div>
@else

<div class="m-auto">
    <div class="card shadow-lg notify notify-success">
        <section class="card-body my-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/check-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TODO SE ENCUENTRA ACTUALIZADO</h1>
                    <span class="txt-gray">No tienes cédulas pendientes.</span>
                </div>
            </div>
        </section>
    </div>
</div>


@endif


<!-- PERIODO VACACIONAL -->
@elseif( $seccion == 2 )

<!-- USUARIO -->
@if( Session::get('srol') == 1 )

        @if( $num > 0 )

        <div class="m-auto">
            <div class="card shadow-lg notify notify-info">
                <section class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                        </div>
                        <div class="text-center px-3">
                            <h1 class="txt-notify">TIENES CÉDULAS PENDIENTES</h1>
                            <p class="txt-notify-s">Consulta tus cédulas que se encuentran en proceso de ser validadas</p>
                            <a href="{{route('pendientes')}}" class="btn btn-primary" type="button">Ir</a>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        @endif

@if( $correccion > 0 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-info">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TIENES CÉDULAS PENDIENTES</h1>
                    <p class="txt-notify-s">Consulta tus cédulas que se encuentran en proceso de ser corregidas</p>
                    <a href="{{route('bandejardsp')}}" class="btn btn-info" type="button">Ir</a>
                </div>
            </div>
        </section>
    </div>
</div>

@endif

@if( $num == 0 && $correccion == 0 )
<div class="m-auto">
    <div class="card shadow-lg notify notify-success">
        <section class="card-body my-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/check-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TODO SE ENCUENTRA ACTUALIZADO</h1>
                    <span class="txt-gray">No tienes cédulas pendientes.</span>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

<!-- ENLACE -->
@elseif( Session::get('srol') == 2 && $num > 0 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-info">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TIENES CÉDULAS PENDIENTES</h1>
                    <p class="txt-notify-s">Consulta tu bandeja de entrada.</p>
                    <a href="{{route('bandejaenlace')}}" class="btn btn-primary" type="button">Ir</a>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- RDSP -->
@elseif( Session::get('srol') == 3 && $num > 0 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-info">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TIENES CÉDULAS PENDIENTES</h1>
                    <p class="txt-notify-s">Consulta tu bandeja de entrada.</p>
                    <a href="{{route('bandejardsp')}}" class="btn btn-primary" type="button">Ir</a>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- ADMINISTRADOR -->
@elseif( Session::get('srol') == 99 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-success">
        <section class="card-body my-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/Success-Login.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">Bievenido Administrador</h1>
                    <span class="txt-gray">{{Session::get('sname')}}</span>
                </div>
            </div>
        </section>
    </div>
</div>

@else

<div class="m-auto">
    <div class="card shadow-lg notify notify-success">
        <section class="card-body my-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/check-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">TODO SE ENCUENTRA ACTUALIZADO</h1>
                    <span class="txt-gray">No tienes cédulas pendientes.</span>
                </div>
            </div>
        </section>
    </div>
</div>

@endif

@if( $datos != null && Session::get('srol') != 99 )

<div class="m-auto">
    <div class="card shadow-lg notify notify-info">
        <section class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <img src="{{ asset('/public/img/icons/infoazul-icon.png') }}" width="80">
                </div>
                <div class="text-center px-3">
                    <h1 class="txt-notify">PERIODO VACACIONAL</h1>
                    <p class="txt-notify-s">Actualemente el RDSP se encuentra en periodo vacacional del día {{$datos->fecha1}} al {{$datos->fecha2}}, validará las actualizaciones en las cédulas requisitadas cuando este finalice.</p>
                </div>
            </div>
        </section>
    </div>
</div>
@endif

@endif

@endsection