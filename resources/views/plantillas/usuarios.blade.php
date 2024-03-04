@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>

<!-- VISTA PARA CONSULTAR USUARIOS -->
@if( $seccion == 1 )

<div class="formm">

    <form action="{{route('consultarusuarios')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
            <hr>
        </div>

        <div class="mb-5">
            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray"><b>Tipo de Búsqueda:</b></label>
                <select name="tipbus" class="form-control col-md-8" id="validationDefault01" required>
                    <option value="1" selected><b>Persona Servidora P&uacute;blica</b></option>
                    <option value="2">No Persona Servidora P&uacute;blica</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">P. nombre:</label>
                <input type="text" name="nombre1" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Primer Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">S. nombre:</label>
                <input type="text" name="nombre2" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Segundo Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido paterno:</label>
                <input type="text" name="appat" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Apellido Paterno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido materno:</label>
                <input type="text" name="apmat" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Apellido Materno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>
        </div>

        <div class="col-12 mt-3 text-center">
            <button class="btn btn-primary mt-5" type="submit">BUSCAR USUARIO</button>
        </div>


    </form>

</div>


<!-- DESPLIEGE DE LA CONSULTA DE USUARIOS -->
@elseif( $seccion == 2 )

<div class="formm">

    <form action="{{route('consultarusuarios')}}" method="post" autocomplete="off" class="row g-3">
        @csrf


        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
            <hr>
        </div>

        <div>
            <div class="col-md-3">
                <span class="glyphicon glyphicon-tasks"></span>
                <label for="validationDefault01"><b>Tipo de B&uacute;squeda:</b></label>
                <select name="tipbus" class="form-control col-md-8" id="validationDefault01" required>
                    @if( $sp == 1 )
                    <option value="1" selected><b>Persona Servidora P&uacute;blica</b></option>
                    <option value="2">No Persona Servidora P&uacute;blica</option>
                    @else
                    <option value="1"><b>Persona Servidora P&uacute;blica</b></option>
                    <option value="2" selected>No Persona Servidora P&uacute;blica</option>
                    @endif
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-user"></span>
            <label for="validationDefault01" class="form-label">P. nombre:</label>
            <input type="text" name="nombre1" value="{{$n1}}" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Primer Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-user"></span>
            <label for="validationDefault01" class="form-label">S. nombre:</label>
            <input type="text" name="nombre2" value="{{$n2}}" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Segundo Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-user"></span>
            <label for="validationDefault01" class="form-label">Apellido paterno:</label>
            <input type="text" name="appat" value="{{$ap}}" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Apellido Paterno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-user"></span>
            <label for="validationDefault01" class="form-label">Apellido materno:</label>
            <input type="text" name="apmat" value="{{$am}}" pattern="[A-Z\s]+{30}" title="Ingresa solo letras." placeholder="Apellido Materno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
        </div>

        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">BUSCAR USUARIO</button>
            </div>
        </div>


    </form>

</div>



@if($datos != null)
<div class="formm">

    <div class="col-md-12 my-5">
        <h3 class="subtitle mt-5 text-center">Resultados de la Búsqueda de {{$tipo}}</h3>
        <hr>
    </div>

    <table id="tablaUsuariosRol" class="table">

        <thead>
            <tr class="table-dark">
                <th scope="col">NOMBRE:</th>
                <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                <th scope="col">TIPO:</th>
                <th scope="col">ROL:</th>
                <th scope="col">OPCIONES:</th>
            </tr>
        </thead>

        <tbody>
            @foreach($datos as $ob)
            <tr>
                <th scope="row">
                    {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                </th>

                @if( $sp == 1 )
                <td>
                    <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                    <b>Cargo:</b> {{$ob->cargo}}<br>
                    <b>UA:</b> {{$ob->dependencia}}
                </td>

                <td>{{$ob->tipo}}</td>
                @else
                <td>SIN UNIDAD ADMINISTRATIVA ASIGNADA</td>

                <td>SIN DATOS</td>
                @endif

                @if($ob->rol != null)
                <td><b>{{$ob->rol}}</b></td>
                @else
                <td>SIN ROL</td>
                @endif

                <td>
                    <div id="separacion" class="d-flex">
                        @if( $ob->rol == null)
                        @if( $servidorp == true )
                        <a href="{{ route('crearrol',['id'=>$ob->id_personal,'sp'=>1]) }}" type="button" class="btn btn-success m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Crear Rol">
                            <span class="glyphicon glyphicon-user"></span>
                        </a>
                        @else
                        <a href="{{ route('crearrol',['id'=>$ob->idpersona,'sp'=>0]) }}" type="button" class="btn btn-success m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Crear Rol">
                            <span class="glyphicon glyphicon-user"></span>
                        </a>
                        @endif
                        @else
                        <a href="{{ route('modrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-warning m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        @endif
                    </div>

                    <div id="separacion">
                        @if( $ob->rol != null && $ob->deleted_at == null)
                        <a href="{{ route('desactivarrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-danger m-1" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="top" title="Desactivar Usuario">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        @endif
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@else
<div class="alert alert-info" id="msj" role="alert">
    <h1 align="center">SIN RESULTADOS</h1>
    <h5 align="center">No se encuentran registros de usuarios con los parametros dados.</h5>
    <div class
    ="col-12" align="center">
        <p>Buscar otro usuario.</p>
        <a href="{{route('vistabusqueda')}}" class="btn btn-primary" type="button">BUSCAR</a>
    </div>
</div>
@endif




























<!-- VISTA CREAR USUARIO -->
@elseif( $seccion == 3 )

<div class="formm">

    <form action="{{route('insertarcredenciales')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <input type="text" name="idpersona" value="{{ $datos->idpersona }}" class="form-control" id="validationDefault01" hidden />
        <input type="text" name="personalua" value="{{ $personalua }}" class="form-control" id="validationDefault01" hidden />
        <input type="text" name="ua" value="{{ $ua }}" class="form-control" id="validationDefault01" hidden />

        <div class="col-md-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Nombre:</label>
            <input type="text" name="nombre" value="{{ $datos->nombre1 }} {{ $datos->nombre2 }} {{ $datos->apellidopat }} {{ $datos->apellidomat }}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="validationDefault01" class="form-label"><b>¿Deseas enviar un correo?</b></label>
            <select name="enviar" class="form-control col-md-8" id="validationDefault01" required>
                <option value="1" selected><b>No enviar correo.</b></option>
                <option value="2">Enviar correo.</option>
            </select>
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-envelope txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Correo: <span class="txt-red">*</span></label>
            <input type="text" name="email" value="{{$datos->correo}}" class="form-control" id="validationDefault01" required />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-lock txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Contraseña: <span class="txt-red">*</span></label>
            <input type="pass" name="pass" value="{{$pwd}}" class="form-control" id="validationDefault01" readonly required />
        </div>


        <div>

            <div class="col-md-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="validationDefault01" class="txt-gray"><b>Selecciona un rol: <span class="txt-red">*</span></b></label>
                <select name="rol" class="form-control col-md-8" id="validationDefault01" required>
                    @if( $datos->rol == null )
                    <option value="">Sin argumento</option>
                    @foreach($datos2 as $ob2)
                    <option value="{{$ob2->idrol}}">{{$ob2->rol}}</option>
                    @endforeach
                    @endif
                </select>
            </div>


        </div>


        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">GUARDAR CAMBIOS</button>
            </div>
        </div>

    </form>

</div>




























<!-- VISTA MODIFICAR USUARIOS -->
@elseif( $seccion == 4 )

<div class="formm">

    <form action="{{route('modificarcredenciales')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <input type="text" name="idcredencial" value="{{ $datos->idcredencial }}" class="form-control" id="validationDefault01" hidden />

        <div class="col-md-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Nombre:</label>
            <input type="text" name="nombre" value="{{ $datos->nombre1 }} {{ $datos->nombre2 }} {{ $datos->apellidopat }} {{ $datos->apellidomat }}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-tasks txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray"><b>¿Deseas enviar un correo?</b></label>
            <select name="enviar" class="form-control col-md-8" id="validationDefault01" required>
                <option value="1" selected><b>No enviar correo.</b></option>
                <option value="2">Enviar correo.</option>
            </select>
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-envelope txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Correo: <span class="txt-red">*</span></label>
            <input type="text" name="email" value="{{$datos->correo}}" class="form-control" id="validationDefault01" required />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-lock txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Contraseña: <span class="txt-red">*</span> </label>
            <input type="pass" name="pass" value="{{$pwd}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-3">
            <span class="glyphicon glyphicon-asterisk txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Rol:</label>
            <input type="text" value="{{$datos->rol}}" class="form-control" id="validationDefault01" readonly />
            <p><b>Nota:</b> El rol no puede ser modificado.</p>
        </div>


        <div id="separacion">
            <div class="col-12" align="center">
                <button class="btn btn-primary" type="submit">GUARDAR CAMBIOS</button>
            </div>
        </div>

    </form>

</div>



















<!-- DESPLIEGUE DE USUARIOS ACTIVOS -->
@elseif( $seccion == 5 )

<!--! Administrador -->
<div class="formm">
    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Administrador</h3>
        <hr>
    </div>
    <p>Cantidad: {{$admintotal->total}}</p>

    <div class="table-responsive m-3 p-3">
        <table id="tablaAdministrador" class="table">

            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($admin as $ob)
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td>
                        <div id="separacion" class="d-flex">
                            @if( $ob->rol != null && $ob->deleted_at == null)
                            <a href="{{ route('modrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-warning m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Modificar">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            @if( $ob->idcredencial != $sesion )
                            <a href="{{ route('desactivarrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-danger m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Desactivar">
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </a>
                            @endif
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>


<!--! Usuarios -->
<div class="formm">
    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Usuarios Habilitado</h3>
        <hr>
    </div>

    <div class="table-responsive m-3 p-3">
        <table class="table" id="tablaUsuarios">

            <p>Cantidad: {{$usuariototal->total}}</p>

            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>


            <tbody>
                @foreach($usuario as $ob)
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td>
                        <div id="separacion" class="d-flex">
                            @if( $ob->rol != null && $ob->deleted_at == null)
                            <a href="{{ route('modrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-warning m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Modificar">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="{{ route('desactivarrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-danger m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Desactivar">
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<!--! Enlaces -->
<div class="formm">
    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Delegado Administrativo</h3>
        <hr>
    </div>
    <p>Cantidad: {{$enlacetotal->total}}</p>

    <div class="table-responsive m-3 p-3">
        <table class="table" id="tablaEnlaces">

            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>


            <tbody>
                @foreach($enlace as $ob)
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td>
                        <div id="separacion" class="d-flex">
                            @if( $ob->rol != null && $ob->deleted_at == null)
                            <a href="{{ route('modrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-warning m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Modificar">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="{{ route('desactivarrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-danger m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Desactivar">
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<!--! RDSP -->
<div class="formm">
    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">RDSP</h3>
        <hr>
    </div>
    <p>Cantidad: {{$rdsptotal->total}}</p>

    <div class="table-responsive m-3 p-3">
        <table class="table" id="tablaRDSP">


            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col" class="text-center">OPCIONES:</th>
                </tr>
            </thead>

            @foreach($rdsp as $ob)

            <tbody>
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td class="text-center">
                        <div id="separacion" class="d-flex">
                            @if( $ob->rol != null && $ob->deleted_at == null)
                            <a href="{{ route('modrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-warning m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Modificar">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                            <a href="{{ route('desactivarrol',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-danger m-2" id="tamanioboton" data-bs-toggle="tooltip" data-bs-placement="left" title="Desactivar">
                                <span class="glyphicon glyphicon-ban-circle"></span>
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
            </tbody>

            @endforeach
        </table>

    </div>
</div>


@if( session('info'))
<script>
    alert("{{session('info')}}");
</script>
@endif


<!-- DESPLIEGUE DE USUARIOS DESACTIVADOS -->
@elseif( $seccion == 6 )

<div class="formm">
    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Administrador</h3>
        <hr>
    </div>
    <p>Cantidad: {{$admintotal->total}}</p>

    <div class="table-responsive">
        <table class="table" id="tablaAdminsDesact">

            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($admin as $ob)
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td>
                        <div id="separacion">
                            @if( $ob->deleted_at != null)
                            <a href="{{ route('activarusuario',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar Usuario">
                                <span class="glyphicon glyphicon-check"></span>
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>


        </table>
    </div>
</div>


<div class="formm">

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Usuario</h3>
        <hr>
    </div>
    <p>Cantidad: {{$usuariototal->total}}</p>

    <div class="table-responsive">
        <table class="table" id="tablaUsersDesact">

            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            @foreach($usuario as $ob)
            <tbody>
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td>
                        <div id="separacion">
                            @if( $ob->deleted_at != null)
                            <a href="{{ route('activarusuario',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar Usuario">
                                <span class="glyphicon glyphicon-check"></span>
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
            </tbody>

            @endforeach

        </table>
    </div>
</div>


<div class="formm">

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Enlace</h3>
        <hr>
    </div>
    <p>Cantidad: {{$enlacetotal->total}}</p>

    <div class="table-responsive">
        <table class="table" id="tablaEnlacesDesact">

            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($enlace as $ob)
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td>
                        <div id="separacion">
                            @if( $ob->deleted_at != null)
                            <a href="{{ route('activarusuario',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar Usuario">
                                <span class="glyphicon glyphicon-check"></span>
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>


        </table>
    </div>
</div>


<div class="formm">

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">RDSP</h3>
        <hr>
    </div>
    <p>Cantidad: {{$rdsptotal->total}}</p>

    <div class="table-responsive">
        <table class="table" id="tablaRDSPDesact">

            <thead>
                <tr class="table-dark">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">TIPO:</th>
                    <th scope="col">ROL:</th>
                    <th scope="col">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>
                @foreach($rdsp as $ob)
                <tr>
                    <th scope="row">
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}
                        <br>
                        {{$ob->correo}}
                    </th>

                    <td>
                        <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td>{{$ob->tipo}}</td>
                    <td><b>{{$ob->rol}}</b></td>

                    <td>
                        <div id="separacion">
                            @if( $ob->deleted_at != null)
                            <a href="{{ route('activarusuario',['id'=>$ob->idcredencial]) }}" type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Activar Usuario">
                                <span class="glyphicon glyphicon-check"></span>
                            </a>
                            @endif
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>


        </table>
    </div>
</div>



@endif

@endsection