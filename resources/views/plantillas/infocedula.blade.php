@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>



<div class="formm resaltardatos p-3 my-5">
    <!--<div class="col-md-8">
                <span class="glyphicon glyphicon-user"></span>
                <label for="validationDefault01" class="form-label">Recibida de:</label>
                <input type="text" value="id_detalle_cedula: {{$envio->id_det}} estado: {{$envio->idestado}}" class="form-control" id="validationDefault01" readonly/>
            </div>-->

    <!-- + + + + + + + + + + + + + + + + + + + + + + + + Datos de Envío + + + + + + + + + + + + + + + + + + + + + + + + -->
    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Datos de Envío</h3>
        <hr>
    </div>

    @if( $rol != 1 && $directa == false )
    <div class="col-md-12">
        <div class="col-md-4 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Recibida de:</label>
            <input type="text" value="{{$envio->nom}} {{$envio->nom2}} {{$envio->app}} {{$envio->apm}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-4 my-3">
            <span class="glyphicon glyphicon-envelope txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Correo:</label>
            <input type="text" value="{{$envio->correo}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-4 my-3">
            <span class="glyphicon glyphicon-calendar txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Recibida el:</label>
            <!--  ENLACE  -->
            @if( $rol == 2 )
            <input type="text" value="{{$envio->enviodelegado}}" class="form-control" id="validationDefault01" readonly />
            <!--  RDSP  -->
            @elseif( $rol == 3 )
            <input type="text" value="{{$envio->envioenlace}}" class="form-control" id="validationDefault01" readonly />
            @endif
        </div>
    </div>
    @endif


    <!--  EL RDSP Y EL ADMIN NO ENVIAN CÉDULAS  -->
    <!--  SE EXCLUYEN LOS ENVIOS DE LAS CÉDULAS ELIMINADAS  -->
    @if( $envio->idestado != 4 && $envio->idestado != 8 && $envio->idestado != 12 )
    @if( $rol != 3 )
    <div class="col-md-12">
        <div class="col-md-4 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Enviada a:</label>
            <input type="text" value="{{$envio->nombre1}} {{$envio->nombre2}} {{$envio->apellidopat}} {{$envio->apellidomat}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-4 my-3">
            <span class="glyphicon glyphicon-envelope txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Correo:</label>
            <input type="text" value="{{$envio->correoenvio}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-4 my-3">
            <span class="glyphicon glyphicon-calendar txt-gray"></span>
            <label for="validationDefault01" class="form- txt-gray">Fecha de env&iacute;o:</label>
            <!--  DELEGADO  -->
            @if( $rol == 1 )
            <input type="text" value="{{$envio->enviodelegado}}" class="form-control" id="validationDefault01" readonly />
            <!-- ENLACE  -->
            @elseif( $rol == 2 )
            <input type="text" value="{{$envio->envioenlace}}" class="form-control" id="validationDefault01" readonly />
            @endif
        </div>
    </div>
    @endif
    @endif

    <!-- ESTATUS DE LAS CEDULAS  -->
    <div class="col-md-12">
        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-info-sign txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Estatus:</label>
            <input type="text" value="{{$envio->estado}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-calendar txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Fecha estatus:</label>
            @if( $envio->publicacion != null )
            <input type="text" value="{{$envio->publicacion}}" class="form-control" id="validationDefault01" readonly />
            @elseif( $envio->envioenlace != null )
            <input type="text" value="{{$envio->envioenlace}}" class="form-control" id="validationDefault01" readonly />
            @elseif( $envio->enviodelegado != null )
            <input type="text" value="{{$envio->enviodelegado}}" class="form-control" id="validationDefault01" readonly />
            @endif
        </div>
    </div>



    <!-- + + + + + + + + + + + + + + + + + + + + + + + + Unidad Administrativa  + + + + + + + + + + + + + + + + + + + + + + + + -->

    <div class="col-md-12">
        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Unidad Administrativa</h3>
            <hr>
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Secretar&iacute;a:</label>
            <input type="text" value="{{$list[0]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n &Aacute;rea:</label>
            <input type="text" value="{{$list[3]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subsecretar&iacute;a:</label>
            <input type="text" value="{{$list[1]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subdirecci&oacute;n:</label>
            <input type="text" value="{{$list[4]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n General:</label>
            <input type="text" value="{{$list[2]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Departamento / Oficina:</label>
            <input type="text" value="{{$datos->nombre}}" class="form-control" id="validationDefault01" readonly />
        </div>
    </div>


    <!--  + + + + + + + + + + + + + + + + + + + + + + + + Persona Servidora Pública, dice:  + + + + + + + + + + + + + + + + + + + + + + + + -->

    <div class="col-md-12">
        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, dice:</h3>
            <hr>
        </div>

        <input type="text" value="{{$datos2->idpersona}}" class="form-control" id="validationDefault01" hidden />
        <!--<div class="col-md-1">
                <span class="glyphicon glyphicon-user"></span>
                <label for="validationDefault02" class="form-label">ID:</label>
                <input type="text" value="{{$datos2->idpersona}}" class="form-control" id="validationDefault01" readonly/>
            </div>-->

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Nombre completo:</label>
            <input type="text" value="{{$datos2->nombre1}} {{$datos2->nombre2}} {{$datos2->apellidopat}} {{$datos2->apellidomat}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
            <input type="text" value="{{$datos2->profesion}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-9 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
            <input type="text" value="{{$datos2->cargo}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-3 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
            <input type="text" value="{{$datos2->tipo}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
            <input type="text" value="{{$datos2->genero}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
            <input type="text" value="{{$datos2->nivelnominal}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
            <input type="text" value="{{$datos2->rango}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-6 my-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
            <input type="text" value="{{$datos2->cveua}}" class="form-control" id="validationDefault02" readonly />
        </div>
    </div>

    <!--  + + + + + + + + + + + + + + + + + + + + + + + + Motivo del Cambio  + + + + + + + + + + + + + + + + + + + + + + + + -->
    <div class=" col-md-12">

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Motivo del Cambio</h3>
            <hr>
        </div>

        <div class="col-md-3 my-3">
            <span class="glyphicon glyphicon-refresh txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Motivo del cambio:</label>
            <input type="text" value="{{$datos->tipo_cambio}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <!-- + + + + + + + + + + + + + + + + + + + + + + + + Persona Servidora Pública, debe decir:  + + + + + + + + + + + + + + + + + + + + + + + + -->

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, debe decir:</h3>
            <hr>
        </div>

        <div id="separador-formulario">
            @if( $datos->nombre1 == $datos2->nombre1)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">P. nombre:</label>
                <input type="text" value="{{$datos->nombre1}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">P. nombre:</label>
                <input type="text" value="{{$datos->nombre1}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->nombre1}}</i></b></small>
            </div>
            @endif

            @if( $datos->nombre2 == $datos2->nombre2)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Nombre(s):</label>
                <input type="text" value="{{$datos->nombre2}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Nombre(s):</label>
                <input type="text" value="{{$datos->nombre2}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->nombre2}}</i></b></small>
            </div>
            @endif

            @if( $datos->appat == $datos2->apellidopat)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" value="{{$datos->appat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" value="{{$datos->appat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->apellidopat}}</i></b></small>
            </div>
            @endif

            @if( $datos->apmat == $datos2->apellidomat)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" value="{{$datos->apmat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" value="{{$datos->apmat}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault01" readonly />
                <small>Dice: <b><i>{{$datos2->apellidomat}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario" class="col-md-12 p-0">

            @if( $datos->profesion == $datos2->profesion )
            <div class="col-md-6 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                <input type="text" value="{{$datos->profesion}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-6 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                <input type="text" value="{{$datos->profesion}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->apellidomat}}</i></b></small>
            </div>
            @endif

            @if( $datos->cargo == $datos2->cargo )
            <div class="col-md-6 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" value="{{$datos->cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-6 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" value="{{$datos->cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->cargo}}</i></b></small>
            </div>
            @endif

        </div>

        <div id="separador-formulario">

            @if( $datos->sit_cargo == $datos2->tipo)
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
                <input type="text" value="{{$datos->sit_cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
                <input type="text" value="{{$datos->sit_cargo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tipo}}</i></b></small>
            </div>
            @endif

            @if( $datos->sexo == $datos2->genero )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
                <input type="text" value="{{$datos->sexo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
                <input type="text" value="{{$datos->sexo}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->genero}}</i></b></small>
            </div>
            @endif

            @if( $datos->nivel_nom == $datos2->nivelnominal )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
                <input type="text" value="{{$datos->nivel_nom}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
                <input type="text" value="{{$datos->nivel_nom}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->nivelnominal}}</i></b></small>
            </div>
            @endif

            @if( $datos->rango == $datos2->rango )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" value="{{$datos->rango}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" value="{{$datos->rango}}" pattern="[A-Z\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->rango}}</i></b></small>
            </div>
            @endif

            @if( $datos->clave_ua == $datos2->cveua )
            <div class="col-md-3 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                <input type="text" value="{{$datos->clave_ua}}" pattern="[A-Z0-9\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-3 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                <input type="text" value="{{$datos->clave_ua}}" pattern="[A-Z0-9\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->cveua}}</i></b></small>
            </div>
            @endif

        </div>


        <!--  + + + + + + + + + + + + + + + + + + + + + + + + Domicilio  + + + + + + + + + + + + + + + + + + + + + + + + -->

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Domicilio:</h3>
            <hr>
        </div>

        <div id="separador-formulario">

            @if( $datos->calle == $datos2->calleprincipal )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                <input type="text" value="{{$datos->calle}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                <input type="text" value="{{$datos->calle}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->calleprincipal}}</i></b></small>
            </div>
            @endif

            @if( $datos->referencia1 == $datos2->entrecalle1 )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                <input type="text" value="{{$datos->referencia1}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                <input type="text" value="{{$datos->referencia1}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->entrecalle1}}</i></b></small>
            </div>
            @endif

            @if( $datos->referencia2 == $datos2->entrecalle2 )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 2:</label>
                <input type="text" value="{{$datos->referencia2}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 2:</label>
                <input type="text" value="{{$datos->referencia2}}" pattern="[A-Z0-9\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->entrecalle2}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->numext == $datos2->numext )
            <div class="col-md-2 my-2">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                <input type="text" value="{{$datos->numext}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-2" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                <input type="text" value="{{$datos->numext}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->numext}}</i></b></small>
            </div>
            @endif

            @if( $datos->numint == $datos2->numint )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                <input type="text" value="{{$datos->numint}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                <input type="text" value="{{$datos->numint}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->numint}}</i></b></small>
            </div>
            @endif

            @if( $datos->colonia == $datos2->colonia )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                <input type="text" value="{{$datos->colonia}}" pattern="[A-Za-z0-9/\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                <input type="text" value="{{$datos->colonia}}" pattern="[A-Za-z0-9/\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->colonia}}</i></b></small>
            </div>
            @endif

            @if( $datos->ciudad == $datos2->nombre_municipio )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                <input type="text" value="{{$datos->ciudad}}" pattern="[A-Za-z0-9/\s]+{30}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                <input type="text" value="{{$datos->ciudad}}" pattern="[A-Za-z0-9/\s]+{30}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->nombre_municipio}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->barrio == $datos2->barrio )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                <input type="text" value="{{$datos->barrio}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                <input type="text" value="{{$datos->barrio}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->barrio}}</i></b></small>
            </div>
            @endif

            @if( $datos->piso == $datos2->piso)
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                <input type="text" value="{{$datos->piso}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                <input type="text" value="{{$datos->piso}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->piso}}</i></b></small>
            </div>
            @endif

            @if( $datos->puerta == $datos2->puerta )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                <input type="text" value="{{$datos->puerta}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                <input type="text" value="{{$datos->puerta}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->puerta}}</i></b></small>
            </div>
            @endif

            @if( $datos->cp == $datos2->codigopostal )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                <input type="number" value="{{$datos->cp}}" maxlength="5" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                <input type="number" value="{{$datos->cp}}" maxlength="5" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->codigopostal}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->ref_dom == $datos2->ref_ad )
            <div class="col-md-12 my-3">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-12 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-map-marker txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->ref_ad}}</i></b></small>
            </div>
            @endif

        </div>


        <!--  + + + + + + + + + + + + + + + + + + + + + + + + Contacto + + + + + + + + + + + + + + + + + + + + + + + + -->

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Contacto</h3>
            <hr>
        </div>


        <div id="separador-formulario">

            @if( $datos->correo1 == $datos2->correo1 )
            <div class="col-md-6 my-3">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 1:</label>
                <input type="text" value="{{$datos->correo1}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-6 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 1:</label>
                <input type="text" value="{{$datos->correo1}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->correo1}}</i></b></small>
            </div>
            @endif

            @if( $datos->correo2 == $datos2->correo2 )
            <div class="col-md-6 my-3">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                <input type="text" value="{{$datos->correo2}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-6 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-envelope txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                <input type="text" value="{{$datos->correo2}}" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->correo2}}</i></b></small>
            </div>
            @endif

        </div>


        <div id="separador-formulario">

            @if( $datos->lada == $datos2->lada )
            <div class="col-md-1 my-3 ">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                <input type="text" value="{{$datos->lada}}" pattern="[0-9]+" placeholder="###" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3 " id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                <input type="text" value="{{$datos->lada}}" pattern="[0-9]+" placeholder="###" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->lada}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel1 == $datos2->tel1 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                <input type="text" value="{{$datos->tel1}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                <input type="text" value="{{$datos->tel1}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel1}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel2 == $datos2->tel2 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                <input type="text" value="{{$datos->tel2}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                <input type="text" value="{{$datos->tel2}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel2}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel3 == $datos2->tel3 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                <input type="text" value="{{$datos->tel3}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                <input type="text" value="{{$datos->tel3}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel3}}</i></b></small>
            </div>
            @endif

            @if( $datos->tel4 == $datos2->tel4 )
            <div class="col-md-2 my-3">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                <input type="text" value="{{$datos->tel4}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                <input type="text" value="{{$datos->tel4}}" pattern="[0-9]+" placeholder="#######" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->tel4}}</i></b></small>
            </div>
            @endif

            @if( $datos->ext1 == $datos2->ext1 )
            <div class="col-md-1 my-3 ">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                <input type="text" value="{{$datos->ext1}}" pattern="[0-9]+" placeholder="#####" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-1 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                <input type="text" value="{{$datos->ext1}}" pattern="[0-9]+" placeholder="#####" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->ext1}}</i></b></small>
            </div>
            @endif

            @if( $datos->ext2 == $datos2->ext2 )
            <div class="col-md-1 my-3 ">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                <input type="text" value="{{$datos->ext2}}" placeholder="#####" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-2 my-3 p-2" id="resaltar-texto">
                <span class="glyphicon glyphicon-earphone txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                <input type="text" value="{{$datos->ext2}}" placeholder="#####" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->ext2}}</i></b></small>
            </div>
            @endif

        </div>

<!---
        <div id="separador-formulario">

            @if( $datos->facebook == $datos2->facepage )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                <input type="text" value="{{$datos->facebook}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                <input type="text" value="{{$datos->facebook}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->facepage}}</i></b></small>
            </div>
            @endif

            @if( $datos->twitter == $datos2->twit )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                <input type="text" value="{{$datos->twitter}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                <input type="text" value="{{$datos->twitter}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->twit}}</i></b></small>
            </div>
            @endif

            @if( $datos->web == $datos2->red )
            <div class="col-md-4 my-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">P&aacute;gina web:</label>
                <input type="text" value="{{$datos->web}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-4 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">P&aacute;gina web:</label>
                <input type="text" value="{{$datos->web}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->red}}</i></b></small>
            </div>
            @endif

        </div>
    -->

        <div id="">
            @if( $datos->ref_dom == $datos2->ref_ad )
            <div class="col-md-12 my-3" id="separacionbottom">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_con}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
            </div>
            @else
            <div class="col-md-12 my-3" id="resaltar-texto">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                <input type="text" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" readonly />
                <small>Dice: <b><i>{{$datos2->ref_ad}}</i></b></small>
            </div>
            @endif
        </div>

    </div>

    <div class="separacion2">
        <!--  REGRESO DELEGADO  -->
        @if( $regreso == 1000 )
        <div class="col-md-12 my-3 text-center">
            <a href="{{route('cedulasenviadas')}}" type="button" class="btn btn-secondary" id="tamanioboton">REGRESAR</a>
        </div>
        @elseif( $regreso == 1001 )
        <div class="col-md-12 my-3 text-center">
            <a href="{{route('buscar')}}" type="button" class="btn btn-secondary" id="tamanioboton">REGRESAR</a>
        </div>

        <!--  REGRESO ENLACE  -->
        @elseif( $regreso == 2000 )
        <div class="text-center p-2">
            <a href="{{route('cedulasenviadasenlace')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>
        @elseif( $regreso == 2001 )
        <div class="text-center p-2">
            <a href="{{route('rechazadasenlace')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>
        @elseif( $regreso == 2002 )
        <div class="text-center p-2">
            <a href="{{route('buscar_e')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>

        <!--  REGRESO RDSP Y ADMIN  -->
        @elseif( $regreso == 3000 )
        <div class="text-center p-2">
            <a href="{{route('cedulaspublicadas')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>
        @elseif( $regreso == 3001 )
        <div class="text-center p-2">
            <a href="{{route('rechazadasrdsp')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>
        @elseif( $regreso == 3002 )
        <div class="text-center p-2">
            <a href="{{route('cedulasdiraprobadas')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>
        @elseif( $regreso == 3003 )
        <div class="text-center p-2">
            <a href="{{route('cedulasdirrechazadas')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>
        @elseif( $regreso == 3004 )
        <div class="text-center p-2">
            <a href="{{route('buscar_r')}}" type="button" class="btn btn-secondary my-3" id="tamanioboton">REGRESAR</a>
        </div>
        @else
        Regreso no definido.
        @endif
    </div>

    @endsection