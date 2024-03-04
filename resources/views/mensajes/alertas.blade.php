@extends('plantillas/nav')

@section('content')
<div class="formm">


    <!--    SATISFACTORIO   -->
    @if( $seccion == 1 )


<div class="formm">
    <div class="m-auto">
        <div class="card shadow-lg notify">
            <section class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="{{ asset('/public/img/icons/check-icon.png') }}" width="80">
                    </div>
                    <div class="text-center">
                        <h1>{{ $titulo }}</h1>
                        <p>{{ $subtitulo }}</p>
                        <div>
                            <a href="{{$link}}" class="btn btn-success" id="tamanioboton" type="button">{{$boton}}</a>
                            <a href="{{$regresar}}" class="btn btn-secondary" id="tamanioboton" type="button">REGRESAR</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>



    <!--    PELIGRO/ERROR   -->
    @elseif( $seccion == 2 )

    <div class="formm">
    <div class="m-auto">
        <div class="card shadow-lg notify notify-danger">
            <section class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <img src="{{ asset('/public/img/icons/delete-icon.png') }}" width="80">
                    </div>
                    <div class="text-center">
                        <h1>{{ $titulo }}</h1>
                        <p>{{ $subtitulo }}</p>
                        <div>
                            <a href="{{$link}}" class="btn btn-danger" id="tamanioboton" type="button">{{$boton}}</a>
                            <a href="{{$regresar}}" class="btn btn-secondary" id="tamanioboton" type="button">REGRESAR</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


    <!--    WARNING   -->
    @elseif( $seccion == 3 )

    <div class="alert alert-warning" role="alert">
        <h1 align="center">{{ $titulo }}</h1>
        <h5 align="center">{{ $subtitulo }}</h5>
        <div class="col-12" align="center">
            <button class="btn btn-primary" id="tamanioboton" type="submit">GUARDAR</button>di
        </div>
    </div>


    <!--    PELIGRO/ERROR RECHAZAR CEDULA ENLACE -->
    @elseif( $seccion == 5 )

    <div class="formm">
        <form action="{{route('rechazarcedula')}}" method="post" autocomplete="off" class="row g-3">
            @csrf

            <input type="text" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" hidden />
            <input type="text" value="{{$datos->id_cedula}}" name="idced" class="form-control" id="validationDefault01" hidden />


            <div class="alert alert-danger" id="izq" role="alert">
                <h1 align="center">{{ $titulo }}</h1>
                <h5 align="center">{{ $subtitulo }}</h5>

                <div class="col-md-12">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <label for="validationDefault02" class="form-label">Comentario:</label>
                    <textarea name="texto" id="" cols="5" rows="10" maxlength="300" title="Ingresa un comentario." class="form-control" required></textarea>
                    <p><b>Caracteres máximos 300.</b></p>
                    <p>Ingresa un comentario del porqu&eacute; vas a rechazar la c&eacute;dula, para tener una realimentaci&oacute;n.</p>
                </div>


                <div id="separacion">
                    <div align="center">
                        <button class="btn btn-danger" type="submit">CONFIRMAR CAMBIOS</button>
                        <a href="{{route('bandejaenlace')}}" class="btn btn-success" type="button">REGRESAR</a>
                    </div>
                </div>
            </div>


        </form>
    </div>

    <!--  SELECCIONAR RDSP PARA ENVÍO -->
    @elseif( $seccion == 6 )

    <div class="formm">
        <form action="{{route('validacedula')}}" method="post" autocomplete="off" class="row g-3">
            @csrf

            <input type="text" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" hidden />

            <div class="alert alert-info" id="izq" role="alert">
                <h1 align="center">{{ $titulo }}</h1>
                <h5 align="center">{{ $subtitulo }}</h5>

                <div class="col-md-12">
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
                        <a href="{{route('bandejaenlace')}}" class="btn btn-info" type="button">REGRESAR</a>
                    </div>
                </div>

            </div>


        </form>
    </div>

    <!--    WARNING/CORRECCION DE LA CEDULA ENLACE -->
    @elseif( $seccion == 7 )

    <div class="formm">
        <form action="{{route('enviarcorreccion')}}" method="post" autocomplete="off" class="row g-3">
            @csrf

            <input type="text" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" hidden />
            <input type="text" value="{{$datos->id_usuario}}" name="idusuario" class="form-control" id="validationDefault01" hidden />


            <div class="alert alert-warning" id="izq" role="alert">
                <h1 align="center">{{ $titulo }}</h1>
                <h5 align="center">{{ $subtitulo }}</h5>

                <div class="col-md-12">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <label for="validationDefault02" class="form-label">Comentario:</label>
                    <textarea name="texto" id="" cols="5" rows="10" maxlength="300" title="Ingresa un comentario." class="form-control" required></textarea>
                    <p><b>Caracteres máximos 300.</b></p>
                    <p>Describe el error del porqu&eacute; vas a solicitar una correcci&oacute;n de la c&eacute;dula, para tener una realimentaci&oacute;n.</p>
                </div>


                <div id="separacion">
                    <div align="center">
                        <button class="btn btn-warning" type="submit">CONFIRMAR CAMBIOS</button>
                        <a href="{{route('bandejaenlace')}}" class="btn btn-success" type="button">REGRESAR</a>
                    </div>
                </div>
            </div>


        </form>
    </div>

    <!--    PELIGRO/ERROR RECHAZAR CEDULA RDSP   -->
    @elseif( $seccion == 10 )

    <div class="formm">
        <form action="{{route('rechazarcedulardsp')}}" method="post" autocomplete="off" class="row g-3">
            @csrf

            <input type="text" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" hidden />
            <input type="text" value="{{$datos->id_cedula}}" name="idced" class="form-control" id="validationDefault01" hidden />


            <div class="alert alert-danger" id="izq" role="alert">
                <h1 align="center">{{ $titulo }}</h1>
                <h5 align="center">{{ $subtitulo }}</h5>

                <div class="col-md-12">
                    <span class="glyphicon glyphicon-pencil"></span>
                    <label for="validationDefault02" class="form-label">Comentario:</label>
                    <textarea name="texto" id="" cols="5" rows="10" maxlength="300" title="Ingresa un comentario." class="form-control" required></textarea>
                    <p><b>Caracteres máximos 300.</b></p>
                    <p>Ingresa un comentario del porqu&eacute; vas a rechazar la c&eacute;dula, para tener una realimentaci&oacute;n.</p>
                </div>


                <div id="separacion">
                    <div align="center">
                        <button class="btn btn-danger" type="submit">CONFIRMAR CAMBIOS</button>
                        <a href="{{$regresar}}" class="btn btn-success" type="button">REGRESAR</a>
                    </div>
                </div>
            </div>


        </form>
    </div>

    @endif
</div>

<div class="alertas-msj">
</div>
@endsection