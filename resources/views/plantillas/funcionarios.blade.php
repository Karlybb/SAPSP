@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>



<!-- FORMULARIO PARA CREAR PERSONAL -->
@if( $seccion == 1 )

<div class="formm">
    <form action="{{route('crearpersona')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Tipo de Usuario</h3>
            <hr>
        </div>

        <div>
            <div class="form-check">
                <input class="form-check-input" id="flexRadioDefault1" type="radio" value="1" name="tipousu" onclick="mostrar(); ocultarcat();" required>
                <label class="form-check-label" for="flexRadioDefault1">PERSONA SERVIDORA PÚBLICA</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" id="flexRadioDefault1" type="radio" value="2" name="tipousu" onclick="ocultar(); mostrarcat();">
                <label class="form-check-label" for="flexRadioDefault2">CATGEM</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" id="flexRadioDefault1" type="radio" value="3" name="tipousu" onclick="ocultar(); ocultarcat();">
                <label class="form-check-label" for="flexRadioDefault2">OTRO</label>
            </div>
        </div>


        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Datos Personales</h3>
            <hr>
        </div>

        <div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">P. nombre:</label>
                <input type="text" name="nombre1" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">S. nombre:</label>
                <input type="text" name="nombre2" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" name="appat" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();"required />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" name="apmat" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

        </div>


        <div>
            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Género:</label>
                <select name="genero" class="form-control" id="sel1" required>
                    <option value="">Sin argumento.</option>
                    <option value="FEMENINO">FEMENINO</option>
                    <option value="MASCULINO">MASCULINO</option>
                </select>
            </div>
        </div>


        <!-- PERSONAL UA -->
        <div id="divocultar">

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Datos del Personal</h3>
                <hr>
            </div>

            <div>

                <div class="col-md-3 mb-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                    <input type="text" name="cargo" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-3 mb-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                    <input type="text" name="rango" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-3 mb-3">
                    <span class="glyphicon glyphicon-tasks txt-gray"></span>
                    <label for="sel1" class="txt-gray">Tipo:</label>
                    <select name="tipo" class="form-control" id="sel1">
                        <option value="">Sin argumento.</option>
                        <option value="ENCARGADO">ENCARGADO</option>
                        <option value="TITULAR">TITULAR</option>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                    <input type="text" name="profesion" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

            </div>


            <div>

                <div class="col-md-3 mb-3">
                    <span class="glyphicon glyphicon-tasks txt-gray"></span>
                    <label for="sel1" class="form-label txt-gray">Nivel:</label>
                    <select name="nivel" class="form-control" id="sel1">
                        <option value="">Sin argumento.</option>
                        <?php
                        for ($i = 1; $i <= 32; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="col-md-3 mb-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Nivel nominal:</label>
                    <input type="text" name="nivelnom" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

            </div>

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Datos de la Unidad Administrativa</h3>
                <hr>
            </div>

            <div>
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-tasks txt-gray"></span>
                    <label for="sel1" class="txt-gray">Unidad Administrativa:</label>
                    <select name="ua" class="form-control" id="sel1">
                        <option value="">Sin argumento.</option>
                        @foreach( $datos as $ob )
                        <option value="{{$ob->iduniadmin}}">{{$ob->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

        <div id="divocultarcat">

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Tipo de Usuario CATGEM</h3>
                <hr>
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Tipo:</label>
                <select name="tipocat" class="form-control" id="sel1">
                    <option value="">Sin argumento.</option>
                    @foreach( $tipocat as $ob )
                    <option value="{{$ob->idusuariocat}}">{{$ob->tipo}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div id="separacion">
            <div class="col-12 py-3" align="center">
                <button class="btn btn-primary" type="submit">CREAR</button>
            </div>
        </div>

    </form>
</div>


<!-- PERSONAL RECIEN AGREGADO Y ELIMINADO -->
@elseif( $seccion == 2 )

<!-- Servidor Público -->
<div class="formm">

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Persona Servidora Pública</h3>
        <hr>
    </div>

    <div class="table-responsive m-3 p-3">
        <table class="table" id="tablaServidoresPublicos">

            <thead>
                <tr class="table-dark">
                    <th scope="col">DATOS PERSONALES:</th>
                    <th scope="col">DATOS GENERALES:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($servidor as $ob)

                <td>
                    Nombre: <b>{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}</b><br>
                    G&eacute;nero: <b>{{$ob->genero}}</b>
                </td>

                <td>
                    Cargo: <b>{{$ob->cargo}}</b><br>
                    Rango: <b>{{$ob->rango}}</b><br>
                    Tipo: <b>{{$ob->tipo}}</b><br>
                    Profesi&oacute;n: <b>{{$ob->profesion}}</b><br>
                    Nivel: <b>{{$ob->nivel}}</b><br>
                    Nivel nominal: <b>{{$ob->nivelnominal}}</b><br>
                </td>

                <td>
                    UA: <b>{{$ob->nombre}}</b>
                </td>

                <td>
                    <div class="d-flex">
                        @if( $metodo == 'agregado' )
                        <div id="separacion">
                            <a href="{{ route('vmodificarsp',['id'=>$ob->id_personal,'op'=>1]) }}" type="button" class="btn btn-warning m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar Datos">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </div>
                        <div id="separacion">
                            <a href="{{ route('veliminarsp',['id'=>$ob->id_personal]) }}" type="button" class="btn btn-danger m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                        @elseif( $metodo == 'eliminado' )
                        <div id="separacion">
                            <a href="{{ route('vactivarsp',['id'=>$ob->id_personal]) }}" type="button" class="btn btn-success m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar">
                                <span class="glyphicon glyphicon-ok"></span>
                            </a>
                        </div>
                        @endif
                    </div>
                </td>


                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

<!-- Otro -->
<div class="formm">

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Otro</h3>
        <hr>
    </div>

    <div class="table-responsive m-3 p-3">
        <table class="table" id="tablaOtros">

            <thead>
                <tr class="table-dark">
                    <th scope="col">DATOS PERSONALES:</th>
                    <th scope="col">DATOS GENERALES:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($otro as $ob)

                <td>
                    Nombre: <b>{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}</b><br>
                    G&eacute;nero: <b>{{$ob->genero}}</b>
                </td>

                <td>
                    <b>SIN DATOS<b>
                </td>

                <td>
                    <b>SIN DATOS<b>
                </td>

                <td>
                    <div class="d-flex">
                        @if( $metodo == 'agregado' )
                        <div id="separacion"><a href="{{ route('vmodificarsp',['id'=>$ob->idpersona,'op'=>2]) }}" type="button" class="btn btn-warning m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar Datos">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </div>
                        <div id="separacion"><a href="{{ route('veliminarco',['id'=>$ob->idpersona]) }}" type="button" class="btn btn-danger m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                        @elseif( $metodo == 'eliminado' )
                        <div id="separacion"><a href="{{ route('vactivarco',['id'=>$ob->idpersona]) }}" type="button" class="btn btn-success m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar">
                                <span class="glyphicon glyphicon-ok"></span>
                            </a>
                        </div>
                        @endif
                    </div>
                </td>


                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<!-- CATGEM -->
<div class="formm">

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">CATGEM</h3>
        <hr>
    </div>

    <div class="table-responsive m-3 p-3">
        <table class="table" id="tablaCatgem">

            <thead>
                <tr class="table-dark">
                    <th scope="col">DATOS PERSONALES:</th>
                    <th scope="col">DATOS GENERALES:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($cat as $ob)

                <td>
                    Nombre: <b>{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}</b><br>
                    G&eacute;nero: <b>{{$ob->genero}}</b>
                </td>

                <td>
                    Tipo: <b>{{$ob->tipo}}<b>
                </td>

                <td>
                    UA: <b>Subdirecci&oacute;n de Vinculaci&oacute;n Ciudadana<b><br>
                            <b>Centro de Atenci&oacute;n Telef&oacute;nica del Gobierno del Estado de M&eacute;xico</b>
                </td>

                <td>
                    <div class="d-flex">
                        @if( $metodo == 'agregado' )
                        <div id="separacion">
                            <a href="{{ route('vmodificarsp',['id'=>$ob->idpersona,'op'=>3]) }}" type="button" class="btn btn-warning m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar Datos">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </div>
                        <div id="separacion">
                            <a href="{{ route('veliminarco',['id'=>$ob->idpersona]) }}" type="button" class="btn btn-danger m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                        </div>
                        @elseif( $metodo == 'eliminado' )
                        <div id="separacion">
                            <a href="{{ route('vactivarco',['id'=>$ob->idpersona]) }}" type="button" class="btn btn-success m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar">
                                <span class="glyphicon glyphicon-ok"></span>
                            </a>
                        </div>
                        @endif
                    </div>
                </td>


                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>


<!-- BUSCAR -->
@elseif( $seccion == 3 )

<div class="formm">
    <form action="{{route('buscarpersonal')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <legend align="center">Criterios de B&uacute;squeda</legend>

        <div class="col-md-3 mb-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Tipo:</label>
            <select name="tipobus" class="form-control" id="sel1">
                @if( $resultado == 0 )
                <option value="" selected>Sin argumento</option>
                <option value="1">Persona Servidora P&uacute;blica</option>
                <option value="2">CATGEM</option>
                <option value="3">Otro</option>
                @else
                <option value="{{ $tipobus }}" selected>{{ $tipoo }}</option>
                @if( $tipobus == 1 )
                <option value="2">CATGEM</option>
                <option value="3">Otro</option>
                @elseif( $tipobus == 2 )
                <option value="1">Persona Servidora P&uacute;blica</option>
                <option value="3">Otro</option>
                @else
                <option value="1">Persona Servidora P&uacute;blica</option>
                <option value="2">CATGEM</option>
                @endif
                @endif
            </select>
        </div>

        <div>

            <div class="col-md-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">P. nombre:</label>
                @if( $resultado == 0 )
                <input type="text" name="nombre1" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @else
                <input type="text" name="nombre1" value="{{ $nombre1 }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @endif

            </div>

            <div class="col-md-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nombre(s):</label>
                @if( $resultado == 0 )
                <input type="text" name="nombre2" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @else
                <input type="text" name="nombre2" value="{{ $nombre2 }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @endif
            </div>

            <div class="col-md-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido paterno:</label>
                @if( $resultado == 0 )
                <input type="text" name="appat" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @else
                <input type="text" name="appat" value="{{$appat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @endif
            </div>

            <div class="col-md-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido materno:</label>
                @if( $resultado == 0 )
                <input type="text" name="apmat" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @else
                <input type="text" name="apmat" value="{{$apmat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                @endif
            </div>

        </div>


        <div id="separacion">
            <div class="col-12 py-3" align="center">
                <button class="btn btn-primary" type="submit">BUSCAR</button>
            </div>
        </div>

    </form>
</div>

<!-- Entrada a la búsqueda -->
@if( $resultado == 1 && $sql != null )
<div class="formm">

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Resultados de la Búsqueda</h3>
        <hr>
    </div>

    <div class="table-responsive">
        <table class="table" id="tablaPersonales">

            <thead>
                <tr class="table-dark">
                    <th scope="col">DATOS PERSONALES:</th>
                    <th scope="col">DATOS GENERALES:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($sql as $ob)

                <td>
                    Nombre: <b>{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}</b><br>
                    G&eacute;nero: <b>{{$ob->genero}}</b>
                </td>

                <td>
                    <!-- Servidor Público-->
                    @if( $tipobus == 1 )
                    Cargo: <b>{{$ob->cargo}}</b><br>
                    Rango: <b>{{$ob->rango}}</b><br>
                    Tipo: <b>{{$ob->tipo}}<b><br>
                            Profesi&oacute;n: <b>{{$ob->profesion}}</b><br>
                            Nivel: <b>{{$ob->nivel}}</b><br>
                            Nivel nominal: <b>{{$ob->nivelnominal}}</b>

                            <!-- CATGEM -->
                            @elseif( $tipobus == 2 )
                            Tipo: <b>{{$ob->tipo}}</b>

                            <!-- Otro-->
                            @elseif( $tipobus == 3 )
                            <b>SIN DATOS</b>

                            @endif
                </td>

                <td>
                    <!-- Servidor Público-->
                    @if( $tipobus == 1 )
                    UA: <b>{{$ob->nombre}}</b><br>
                    <b>{{$ob->tipoadm}}</b><br>

                    <!-- CATGEM -->
                    @elseif( $tipobus == 2 )
                    UA: <b>Subdirecci&oacute;n de Vinculaci&oacute;n Ciudadana<b><br>
                            <b>Centro de Atenci&oacute;n Telef&oacute;nica del Gobierno del Estado de M&eacute;xico</b>
                            <!-- Otro-->
                            @elseif( $tipobus == 3 )
                            <b>SIN UNIDAD ADMINISTRATIVA ASIGNADA</b>

                            @endif
                </td>

                <td>
                    <div>
                        @if( $ob->deleted_at == null )
                        <div id="separacion"><a href="{{ route('vmodificarsp',['id'=>$ob->idpersona,'op'=>3]) }}" type="button" class="btn btn-warning" id="tamanioboton">MODIFICAR DATOS</a></div>
                        <div id="separacion"><a href="{{ route('veliminarco',['id'=>$ob->idpersona]) }}" type="button" class="btn btn-danger" id="tamanioboton">ELIMINAR</a></div>
                        @else
                        <div id="separacion"><a href="{{ route('vactivarco',['id'=>$ob->idpersona]) }}" type="button" class="btn btn-success" id="tamanioboton">ACTIVAR</a></div>
                        @endif
                    </div>
                </td>


                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

@elseif( $resultado == 1 )

<div class="alert alert-info" id="msj" role="alert">
    <h1 align="center">SIN RESULTADOS</h1>
    <h5 align="center">No se encuentran registros con los parametros dados.</h5>
</div>

@endif




















<!-- FORMULARIO PARA MODIFICAR SERVIDOR PÚBLICO -->
@elseif( $seccion == 4 )

<div class="formm">
    <form action="{{route('modfun')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <input type="text" name="op" value="{{$tipomod}}" class="form-control" id="validationDefault02" hidden />
        <input type="text" name="idper" value="{{ $datos->idpersona }}" class="form-control" id="validationDefault02" hidden />

        <!-- Apartado para el Servidor Público -->
        @if( $tipomod == 1 )
        <input type="text" name="idfun" value="{{ $datos->id_personal }}" class="form-control" id="validationDefault02" hidden />
        @endif

        <!-- Apartado para el CATGEM -->
        @if( $tipomod == 3 )
        <input type="text" name="idcat" value="{{ $datos->id_personalcat }}" class="form-control" id="validationDefault02" hidden />
        @endif

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Datos Personales</h3>
            <hr>
        </div>

        <div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">P. nombre:</label>
                <input type="text" name="nombre1" value="{{ $datos->nombre1 }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nombre(s):</label>
                <input type="text" name="nombre2" value="{{ $datos->nombre2 }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" name="appat" value="{{ $datos->apellidopat }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" name="apmat" value="{{ $datos->apellidomat }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

        </div>

        <div class="col-md-3 mb-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="sel1" class="form-label txt-gray">Género:</label>
            <select name="genero" class="form-control" id="sel1" required>
                <optgroup label="Género Actual:">
                    <option value="{{$datos->genero}}" selected readonly><b>{{$datos->genero}}</b></option>
                </optgroup>
                @if( $datos->genero == 'FEMENINO' )
                <option value="MASCULINO">MASCULINO</option>
                @elseif( $datos->genero == 'MASCULINO' )
                <option value="FEMENINO">FEMENINO</option>
                @else
                <option value="FEMENINO">FEMENINO</option>
                <option value="MASCULINO">MASCULINO</option>
                @endif
            </select>
        </div>

        <!-- Apartado para el usuario del CATGEM -->
        @if( $tipomod == 3 )

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Tipo de Usuario CATGEM</h3>
            <hr>
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-tasks"></span>
            <label for="sel1">Tipo:</label>
            <select name="tipocat" class="form-control" id="sel1">
                <option value="{{ $datos->idusuariocat }}">{{ $datos->tipo }}</option>
                @foreach( $tipocat as $ob )
                @if( $datos->idusuariocat != $ob->idusuariocat )
                <option value="{{ $ob->idusuariocat }}">{{ $ob->tipo }}</option>
                @endif
                @endforeach
            </select>
        </div>

        @endif


        <!-- Apartado para el Servidor Público -->
        @if( $tipomod == 1 )

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Datos del Personal</h3>
            <hr>
        </div>

        <div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" name="cargo" value="{{ $datos->cargo }}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" name="rango" value="{{ $datos->rango }}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Tipo:</label>
                <select name="tipo" class="form-control" id="sel1" required>
                    <optgroup label="Situación Actual:">
                        <option value="{{$datos->tipo}}" selected readonly><b>{{$datos->tipo}}</b></option>
                    </optgroup>
                    @if( $datos->tipo == 'ENCARGADO' )
                    <option value="TITULAR">TITULAR</option>
                    @elseif( $datos->tipo == 'TITULAR')
                    <option value="ENCARGADO">ENCARGADO</option>
                    @else
                    <option value="ENCARGADO">ENCARGADO</option>
                    <option value="TITULAR">TITULAR</option>
                    @endif
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                <input type="text" name="profesion" value="{{ $datos->profesion }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

        </div>


        <div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Nivel:</label>
                <select name="nivel" class="form-control" id="sel1">
                    <option value="{{ $datos->nivel }}">{{ $datos->nivel }}</option>
                    <?php
                    for ($i = 1; $i <= 32; $i++) {
                        if ($datos->nivel != $i) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel nominal:</label>
                <input type="text" name="nivelnom" value="{{ $datos->nivelnominal }}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

        </div>

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Datos de la Unidad Administrativa</h3>
            <hr>
        </div>

        <div>
            <div class="col-md-12 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Unidad Administrativa:</label>
                <select name="ua" class="form-control" id="sel1">
                    <option value="{{ $datos->iduniadmin }}">{{ $datos->nombreadm }}</option>
                    @foreach( $ua as $ob )
                    @if( $datos->iduniadmin != $ob->iduniadmin )
                    <option value="{{$ob->iduniadmin}}">{{$ob->nombre}}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>

        @endif



        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-warning" type="submit">MODIFICAR</button>
            </div>
        </div>

    </form>
</div>

@elseif( $seccion == 5 )

@endif

@endsection