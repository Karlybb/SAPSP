@extends('plantillas/nav')

@section('content')
<div class="formm">

    <!--    ENVIAR CÉDULA AL RDSP  -->
    @if( $seccion == 1 )

    <div class="m-auto">
        <div class="card shadow-lg notify">
            <section class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <img src="{{ asset('/public/img/icons/check-icon.png') }}" width="80">
                    </div>
                    <!-- + + + + + + + + + + + + + + + + -->
                    <div class="text-center px-3">
                        <form action="{{route('validacedula')}}" method="post" class="row g-3">
                            @csrf

                            <input type="hidden" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div>
                                <h3 align="center">{{ $titulo }}</h3>
                                <h5 align="center">{{ $subtitulo }}</h5>

                                <div class="col-md-12 text-start">
                                    <span class="glyphicon glyphicon-tasks"></span>
                                    <label for="sel1">RDSP:</label>

                                    <select name="rdsp" class="form-control" id="sel1" required>
                                        @foreach( $datos2 as $ob)
                                        <optgroup label="RDSP: {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}">
                                            <option value="{{$ob->idcredencial}}">Usuario: {{$ob->correo}}</option>
                                        </optgroup>
                                        @endforeach
                                    </select>
                                    <p id="nota">* Selecciona un RDSP para enviarle la c&eacute;dula.</p>
                                </div>

                                <div id="enviaralrdsp">
                                    <div align="center">
                                        <button class="btn btn-success" type="submit">CONFIRMAR ENV&Iacute;O</button>
                                        <a href="{{route('bandejaenlace')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>

                </div>
            </section>
        </div>
    </div>

    <!--    ENVIAR UNA CORRECCIÓN DE LA CÉDULA AL DELEGADO   -->
    @elseif( $seccion == 2 )

    <div class="formm tamposalertas">
        <form action="{{route('enviarcorreccion')}}" method="post" autocomplete="off" class="row g-3">
            @csrf

            <input type="hidden" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" />
            <input type="hidden" value="{{$datos->id_usuario}}" name="idusuario" class="form-control" id="validationDefault01" />
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

            <div class="card p-5 notify-warning shadow-lg" id="izq" role="alert" style="border-radius: 20px;">
                <div class="text-center mb-3">
                    <h1 class="txt-warning">{{ $titulo }}</h1>
                    <h5 class="txt-gray">{{ $subtitulo }}</h5>
                </div>

                <div class="col-md-12">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <label for="validationDefault02" class="form-label">Comentario:</label>
                    <textarea name="texto" id="" cols="5" rows="5" maxlength="300" title="Ingresa un comentario." class="form-control" required></textarea>
                    <p><b>Caracteres máximos 300.</b></p>
                    <p class="text-justify txt-gray">Describe el error del porqué vas a solicitar una corrección de la cédula, para tener una realimentación.</p>
                </div>


                <div id="separacion">
                    <div align="center">
                        <button class="btn btn-success" type="submit">CONFIRMAR CAMBIOS</button>
                        @if( $rol == 2 )
                        <a href="{{route('bandejaenlace')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                        @elseif( $rol == 3 )
                        @if( $regreso == 1 )
                        <a href="{{route('bandejardsp')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                        @elseif( $regreso == 2 )
                        <a href="{{route('cedulaspendientes')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                        @endif
                        @else
                        <h1>estipula un regreso para el admin</h1>
                        @endif
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!--       RECHAZAR LA CÉDULA     -->
    @elseif( $seccion == 3 )

    <div class="formm tamposalertas">
        <form action="{{route('rechazarcedula')}}" method="post" autocomplete="off" class="row g-3">
            @csrf

            <input type="text" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" hidden />
            <input type="text" value="{{$datos->id_cedula}}" name="idced" class="form-control" id="validationDefault01" hidden />


            <div class="card p-5 notify-danger shadow-lg" id="izq" role="alert">
                <h1 class="txt-danger" align="center">{{ $titulo }}</h1>
                <h5 class="txt-gray" align="justify">{{ $subtitulo }}</h5>

                <div class="col-md-12">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <label for="validationDefault02" class="form-label">Comentario:</label>
                    <textarea name="texto" id="" cols="5" rows="5" maxlength="300" title="Ingresa un comentario." class="form-control" required></textarea>
                    <p><b>Caracteres máximos 300.</b></p>
                    <p>Ingresa un comentario del porqu&eacute; vas a rechazar la c&eacute;dula, para tener una realimentaci&oacute;n.</p>
                </div>


                <div id="separacion">
                    <div align="center">
                        <button class="btn btn-success" type="submit">CONFIRMAR CAMBIOS</button>
                        <a href="{{route('bandejaenlace')}}" class="btn btn-secondary" type="button">REGRESAR</a>
                    </div>
                </div>
            </div>


        </form>
    </div>

    @endif


</div>

@endsection