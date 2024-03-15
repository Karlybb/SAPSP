@extends('plantillas/nav')

@section('content')

<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>

<!-- VISTA PARA BUSCAR A UN FUNCIONARIO -->
@if( $seccion == 1 )

<div class="formm">
    <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
    <hr>

    <form action="{{route('buscarfuncionario')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <div id="separacionbottom">
            <div class="row mb-3 p-2">
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-info-sign txt-gray"></span>
                    <label for="validationDefault01" class="form-label txt-gray">Dependencia:</label>
                    <input type="text" value="{{$datos->infodiv}}" class="form-control upper" id="validationDefault01" readonly />
                </div>
            </div>
        </div>

        <div id="separacionbottom">
            <div class="row mb-3 p-2">
                <div class="col-md-12 mb-3">
                    <span class="glyphicon glyphicon-briefcase txt-gray"></span>
                    <label for="sel1" class="txt-gray">Unidad Administrativa:</label>
                    <select name="ua" class="form-control ejemplo-1 txt-gray" id="sel1">
                        <option value=""><b>Selecciona una Unidad Administrativa.</b></option>
                        <optgroup label="Unidades:">
                            @if( $ua != null )
                            @foreach( $ua as $ob)
                            <option value="{{$ob->iduniadmin}}">{{$ob->nombre}}</option>
                            @endforeach
                            @else
                            <option disabled>No se encontraron Unidades Administrativas.</option>
                            @endif
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">P. nombre:</label>
                <input type="text" name="nombre1" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Primer Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">S. nombre::</label>
                <input type="text" name="nombre2" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Segundo Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido pat:</label>
                <input type="text" name="apellidopat" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Apellido Paterno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido mat:</label>
                <input type="text" name="apellidomat" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Apellido Materno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>
        </div>

        <br>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div>
            <div class="col-12 my-3" align="center">
                <button class="btn btn-primary" type="submit">BUSCAR</button>
            </div>
        </div>

    </form>
</div>

<!-- RESULTADOS DE LAS BUSQUEDA DE LOS FUNCIONARIOS -->
@elseif( $seccion == 2 )

<div class="formm">
    <form action="{{route('buscarfuncionario')}}" method="post" autocomplete="off" class="row g-3">
        @csrf

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Criterios de Búsqueda</h3>
            <hr>
        </div>

        <div id="separacionbottom">
            <div class="row mb-3 p-2">
                <div class="col-md-12 txt-gray">
                    <span class="glyphicon glyphicon-info-sign"></span>
                    <label for="validationDefault01" class="form-label">Dependencia:</label>
                    @if( $infod == 1 )
                    <input type="text" value="{{$datos2->infodiv}}" class="form-control upper" id="validationDefault01" readonly />
                    @elseif( $infod == 2 )
                    <input type="text" value="información no definida" class="form-control upper" id="validationDefault01" readonly />
                    @endif
                </div>
            </div>
        </div>

        <div id="separacionbottom">
            <div class="row mb-3 p-2">
                <div class="col-md-12 txt-gray">
                    <span class="glyphicon glyphicon-briefcase"></span>
                    <label for="sel1">Unidad Administrativa:</label>
                    <select name="ua" class="form-control" id="sel1">
                        <option value=""><b>Selecciona una Unidad Administrativa.</b></option>
                        <optgroup label="Unidades:">
                            @if( $ua != null )
                            @foreach( $ua as $ob)
                            <option value="{{$ob->iduniadmin}}">{{$ob->nombre}}</option>
                            @endforeach
                            @else
                            <option disabled>No se encontraron Unidades Administrativas.</option>
                            @endif
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>

        
        <div class="row">
            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">P. nombre:</label>
                <input type="text" name="nombre1" value="{{$n1}}"  id="busqueda1" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Primer Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">S. nombre:</label>
                <input type="text" name="nombre2" value="{{$n2}}" id="busqueda2" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Segundo Nombre." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido pat:</label>
                <input type="text" name="apellidopat"  value="{{$ap1}}"  id="busqueda3" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Apellido Paterno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>

            <div class="col-md-3 mb-3">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Apellido mat:</label>
                <input type="text" name="apellidomat" value="{{$ap2}}" id="busqueda4" maxlength="20" pattern="[A-Z\s]+{20}" title="Ingresa solo letras." placeholder="Apellido Materno." class="form-control upper" id="validationDefault01" onkeyup="this.value = this.value.toUpperCase();" />
            </div>
        </div>

        

        <br>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

        <div id="separacion">
            <div class="col-12 my-3" align="center">
                <button class="btn btn-primary" type="submit">BUSCAR</button>
            </div>
        </div>

        <div class="btn-limpiar m-4">
            <div class="col-12">
                <button class="btn btn-primary" onclick="limpiar2()">
                    <span class="glyphicon glyphicon-repeat p-2"></span>
                    Limpiar Campos
                </button>
            </div>
        </div>



    </form>
</div>

@if($datos != null)

<div class="col-md-12">
    <h3 class="subtitle mt-5 text-center">Resultados de la Búsqueda</h3>
    <hr>
</div>

<div class="formm">
    <div class="table-responsive m-3 p-3">
        <table id="tablaCedulas" class="table">

            <thead>
                <tr id="trencabezado">
                    <th scope="col" class="text-center">NOMBRES:</th>
                    <th scope="col" class="text-center">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col" class="text-center">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>

                @foreach($datos as $ob)
                <tr id="tablaneutro">

                    <th scope="row">{{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}</th>

                    <td>
                        <b>Profesión:</b> {{$ob->profesion}}<br>
                        <b>Cargo:</b> {{$ob->cargo}}<br>
                        <b>UA:</b> {{$ob->dependencia}}
                    </td>

                    <td class="text-center">
                        <form action="cargardatos" method="post" autocomplete="off">
                            @csrf
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="_id" value="{{ $ob->idpersona }}" />
                            <button class="btn btn-success" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Crear Cédula">
                                <span class="glyphicon glyphicon-copy"></span>
                            </button>
                        </form>
                    </td>

                    <!--<td><a href="{{ route('cargardatos',['id'=>$ob->idpersona]) }}" type="button" class="btn btn-success">CREAR C&Eacute;DULA</a></td>-->

                </tr>
                @endforeach

            </tbody>

            <tfoot>
                <tr id="trencabezado">
                    <th scope="col">NOMBRE:</th>
                    <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                    <th scope="col">OPCIONES:</th>
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
                    <p class="txt-notify-s">No se encuentran registros de funcionarios con los parametros dados.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">Inicio</a>
                </div>
            </div>
        </section>
    </div>
</div>

@endif

<!-- CARGAR DATOS DEL FUNCIONARIO -->
@elseif( $seccion == 3 )

<div class="formm">

    <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
    <h3 class="subtitle mt-5 text-center">Unidad Administrativa</h3>
    <hr>
    <br>

    <form action="{{route('insertarfuncionario')}}" method="post" autocomplete="off" class="row g-2">
        @csrf

        <input type="text" name="idpua" value="{{$datos->idua}}" class="form-control" id="validationDefault01" hidden />
        <input type="text" name="iduadm" value="{{$datos->idadm}}" class="form-control" id="validationDefault01" hidden />

        <div class="row">
            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Secretar&iacute;a:</label>
                <input type="text" value="{{$list[0]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n &Aacute;rea:</label>
                <input type="text" value="{{$list[3]}}" class="form-control" id="validationDefault01" readonly />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Subsecretar&iacute;a:</label>
                <input type="text" value="{{$list[1]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Subdirecci&oacute;n:</label>
                <input type="text" value="{{$list[4]}}" class="form-control" id="validationDefault01" readonly />
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n General:</label>
                <input type="text" value="{{$list[2]}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Departamento / Oficina:</label>
                <input type="text" value="{{$datos->nombre}}" class="form-control" id="validationDefault01" readonly />
            </div>
        </div>



        <!--&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&-->
        <br>
        <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, dice:</h3>
        <hr>

        <input type="text" name="idpersona" value="{{$datos->idpersona}}" class="form-control" id="validationDefault01" hidden />

        <!--<div class="col-md-2">
                    <span class="glyphicon glyphicon-user"></span>
                    <label for="validationDefault02" class="form-label">ID:</label>
                    <input type="text" name="idpersona" value="{{$datos->idpersona}}" class="form-control" id="validationDefault01" hidden/>
                </div>-->

        <div class="row">
            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault01" class="form-label txt-gray">Nombre completo:</label>
                <input type="text" name="nombrecompleto" value="{{$datos->nombre1}} {{$datos->nombre2}} {{$datos->apellidopat}} {{$datos->apellidomat}}" class="form-control" id="validationDefault01" readonly />
            </div>

            <div class="col-md-6 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Profesión:</label>
                <input type="text" name="prof" value="{{$datos->profesion}}" class="form-control" id="validationDefault02" readonly />
            </div>
        </div>

        <div class="row">
            <div class="col-md-9 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                <input type="text" name="cargo" value="{{$datos->cargo}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-3 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
                <input type="text" name="sitcargo" value="{{$datos->situacion}}" class="form-control" id="validationDefault02" readonly />
            </div>
        </div>


        <div class="row">
            <div class="col-md-3 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
                <input type="text" name="sexo" value="{{$datos->genero}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-3 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Nivel:</label>
                <input type="text" name="nivnom" value="{{$datos->nivelnominal}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-3 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                <input type="text" name="rango" value="{{$datos->rango}}" class="form-control" id="validationDefault02" readonly />
            </div>

            <div class="col-md-3 mb-4">
                <span class="glyphicon glyphicon-user txt-gray"></span>
                <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                <input type="text" name="clua" value="{{$datos->cveua}}" class="form-control" id="validationDefault02" readonly />
            </div>
        </div>



        <div class="resaltardatos my-5">
            <!-- + + + + + + + + + + + + + + + + + Motivo del Cambio  + + + + + + + + + + + + + + + + +  -->
            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Motivo del Cambio</h3>
                <hr>
            </div>

          <!--  <div class="col-md-12 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="txt-gray">Motivo del cambio:</label>
                <select name="radio" class="form-control" id="sel1" >
                    <option value=""><b>Selecciona el Motivo del Cambio.</b></option>
                    <optgroup label="Motivos:">
                        <option value="ACTUALIZACIÓN">ACTUALIZACIÓN</option>
                        <option value="CORRECCIÓN">CORRECCIÓN</option>
                    </optgroup>
                </select>
            </div>-->

           
                <div class="col-md-12 mb-3">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="txt-gray">Motivo del cambio:</label>
                <select  title="Hace referencia a la razon por la cual el registro del funcionario sera alterado" name="radio" class="form-control" id="sel1" onchange="ShowSelected();">   
                    <optgroup   label="Motivos:">                   
                        <option  title="Existe uno o varios cambios a efectuar dentro de la información del servidor" value="CORRECCIÓN">CORRECCIÓN</option>
                        <option title="Todos los datos  personales del servidor seran actualizados a los del nuevo funcionario" value="ACTUALIZACIÓN">ACTUALIZACIÓN</option>
                     </optgroup>
                </select>
                </div>
            

            <!-- + + + + + + + + + + + + + + + + + Debe decir  + + + + + + + + + + + + + + + + + -->

            <section>
                <div class="col-md-12">
                    <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, debe decir:</h3>
                    <hr>
                </div>

            <!--    <div class="btn-limpiar m-4">
                    <div class="col-12">
                        <button class="btn btn-primary" onclick="limpiar()">
                            <span class="glyphicon glyphicon-repeat p-2"></span>
                            Limpiar Campos
                        </button>
                    </div>
                </div>
            -->

                <div class="col-md-3 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">P. nombre:</label>
                    <input type="text" name="nombre1" value="{{$datos->nombre1}}" maxlength="30" pattern="[a-zA-Z\s]+{30}" class="form-control upper" id="limpiartexto1" onkeyup="this.value = this.value.toUpperCase();" required />
                </div>

                <div class="col-md-3 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Nombre(s):</label>
                    <input type="text" name="nombre2" value="{{$datos->nombre2}}" maxlength="30" pattern="[a-zA-Z\s]+{30}" class="form-control upper" id="limpiartexto2" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-3 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Apellido paterno:</label>
                    <input type="text" name="appat" value="{{$datos->apellidopat}}" maxlength="30" pattern="[a-zA-Z\s]+{30}" class="form-control upper" id="limpiartexto3" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-3 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Apellido materno:</label>
                    <input type="text" name="apmat" value="{{$datos->apellidomat}}" maxlength="30" pattern="[a-zA-Z\s]+{30}" class="form-control upper" id="limpiartexto4" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-6 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Profesión:</label>
                    <input type="text" name="profesion" value="{{$datos->profesion}}" maxlength="50" pattern="[a-zA-Z\s]+{30}" class="form-control upper" id="limpiartexto5" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-6 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                    <input type="text" name="cargo2" value="{{$datos->cargo}}" maxlength="50" pattern="[a-zA-Z\s]+{50}" class="form-control upper" id="limpiartexto6" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-3 my-3">
                    <span class="glyphicon glyphicon-tasks txt-gray"></span>
                    <label for="sel1" class="form-label txt-gray">Situación cargo:</label>
                    <select name="sitcargo" class="form-control" id="limpiartexto7" required>
                        <optgroup label="Situación Actual:">
                            <option value="{{$datos->situacion}}"><b>{{$datos->situacion}}</b></option>
                            @if( $datos->situacion == 'ENCARGADO' )
                            <option value="TITULAR">TITULAR</option>
                            <option value="SUPLENTE">SUPLENTE</option> 
                            @elseif( $datos->situacion == 'TITULAR')
                            <option value="ENCARGADO">ENCARGADO</option>
                            <option value="SUPLENTE">SUPLENTE</option> 
                        </optgroup>
                        
                        
                        @endif
                    </select>
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-tasks txt-gray"></span>
                    <label for="sel1" class="txt-gray form-label">Género:</label>
                    <select name="sexo2" class="form-control" id="limpiartexto8" required>
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

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Nivel nominal:</label>
                    <input type="text" name="nivelnominal" value="{{$datos->nivelnominal}}" maxlength="5" pattern="[A-Z0-9\s]+{5}" class="form-control upper" id="limpiartexto9" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                    <input type="text" name="rango2" value="{{$datos->rango}}" maxlength="5" pattern="[A-Z0-9\s]+{5}" class="form-control upper" id="limpiartexto10" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-3 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                    <input type="text" name="claveua" value="{{$datos->cveua}}" maxlength="15" pattern="[A-Z0-9\s]+{15}" class="form-control upper" id="limpiartexto11" onkeyup="this.value = this.value.toUpperCase();" />
                </div>
                <br>
            </section>


            <!-- + + + + + + + + + + + + + + + + + Domicilio + + + + + + + + + + + + + + + + +  -->
            <section>
                <div class="col-md-12">
                    <h3 class="subtitle mt-5 text-center">Domicilio</h3>
                    <hr>
                </div>

                <div class="col-md-4 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                    <input type="text" name="calle" value="{{$datos->calleprincipal}}" maxlength="50" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-4 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                    <input type="text" name="refcall1" value="{{$datos->entrecalle1}}" maxlength="50" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-4 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 2:</label>
                    <input type="text" name="refcall2" value="{{$datos->entrecalle2}}" maxlength="50" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                    <input type="text" name="numext" value="{{$datos->numext}}" maxlength="10" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                    <input type="text" name="numint" value="{{$datos->numint}}" maxlength="10" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-4 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                    <input type="text" name="colonia" value="{{$datos->colonia}}" maxlength="50" pattern="[A-Za-z0-9/\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                    <input type="text" name="ciudad" value="{{$datos->ciudad}}" maxlength="30" pattern="[A-Za-z0-9/\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-tasks txt-gray"></span>
                    <label for="sel1" class="form-label txt-gray">Municipio:</label>
                    <select name="muni" class="form-control" id="sel1" required>
                        <optgroup label="Municipio Actual:">
                            <option value="{{$datos->id_municipio}}" selected readonly><b>{{$datos->nombre_municipio}}</b></option>
                        </optgroup>
                        @foreach( $datos2 as $mun)
                        @if( $mun->id_municipio != $datos->id_municipio )
                        <option value="{{$datos->id_municipio}}">{{$mun->nombre_municipio}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                    <input type="text" name="barrio" value="{{$datos->barrio}}" maxlength="50" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                    <input type="text" name="piso" value="{{$datos->piso}}" maxlength="10" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                    <input type="text" name="puerta" value="{{$datos->puerta}}" maxlength="10" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                    <input type="number" name="cp" value="{{$datos->codigopostal}}" maxlength="5" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>

                <div class="col-md-12 my-3">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                    <input type="text" name="refadicional" value="{{$datos->ref_ad}}" maxlength="50" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                </div>
                <br>
            </section>

            <!--  + + + + + + + + + + + + + + + + + Contacto  + + + + + + + + + + + + + + + + + -->
            <section>
                <div class="col-md-12">
                    <h3 class="subtitle mt-5 text-center">Contacto</h3>
                    <hr>
                </div>

                <div class="col-md-6 my-3">
                    <span class="glyphicon glyphicon-envelope txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Correo 1:</label>
                    <input type="text" name="correo1" value="{{$datos->correo1}}" maxlength="35" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-6 my-3">
                    <span class="glyphicon glyphicon-envelope txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                    <input type="text" name="correo2" value="{{$datos->correo2}}" maxlength="35" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-1 my-3">
                    <span class="glyphicon glyphicon-earphone txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                    <input type="text" name="lada" value="{{$datos->lada}}" pattern="[0-9]+" maxlength="3" title="Ingresa solo números." placeholder="###" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-earphone txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                    <input type="text" name="tel1" value="{{$datos->tel1}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-earphone txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                    <input type="text" name="tel2" value="{{$datos->tel2}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-earphone txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                    <input type="text" name="tel3" value="{{$datos->tel3}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                </div>

                <div class="col-md-2 my-3">
                    <span class="glyphicon glyphicon-earphone txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                    <input type="text" name="tel4" value="{{$datos->tel4}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                </div>

                <div>
                    <div class="col-md-1 my-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                        <input type="text" name="ext1" value="{{$datos->ext1}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                    </div>

                    <div class="col-md-1 my-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                        <input type="text" name="ext2" value="{{$datos->ext2}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                    </div>
                </div>
<!-- fb tw y redes sociales eliminados 
                <div>
                    <div class="col-md-4 my-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                        <input type="text" name="facebook" value="{{$datos->facepage}}" maxlength="30" pattern="[A-Za-z0-9/-_@\s]+{30}" class="form-control" id="validationDefault02" />
                    </div>

                    <div class="col-md-4 my-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                        <input type="text" name="twitter" value="{{$datos->twit}}" maxlength="30" pattern="[A-Za-z0-9/-_@\s]+{30}" class="form-control" id="validationDefault02" />
                    </div>

                    <div class="col-md-4 my-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">P&aacute;gina web:</label>
                        <input type="text" name="web" value="{{$datos->red}}" maxlength="50" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                    </div>
                </div>
  -->
                <div class="col-md-12 mb-3" id="separacionbottom">
                    <span class="glyphicon glyphicon-user txt-gray"></span>
                    <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                    <input type="text" name="refead" value="{{$datos->refead}}" maxlength="50" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    <br>
                </div>
            </section>

            <section>
                @if( Session::get('srol') != 1 )
                    <div id="separacionbottom"></div>
                @endif


                @if( Session::get('srol') == 1 )
                <!-- &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&& -->

                <div class="col-md-12">
                    <h3 class="subtitle mt-5 text-center">Datos del Delegado Administrativo</h3>
                    <hr>
                </div>


                <div class="col-md-12 mb-5" id="separacionbottom">
                    <span class="glyphicon glyphicon-tasks txt-gray"></span>
                    <label for="sel1" class="txt-gray">Direcciones de los Delegado Administrativo:</label>
                    <select name="enlace" class="form-control" id="sel1" required>
                        <option value=""><b>Selecciona un Delegado Administrativo...</b></option>
                        @foreach( $datos3 as $ob3 )
                        <optgroup label="{{$ob3->nombre1}} {{$ob3->nombre2}} {{$ob3->apellidopat}} {{$ob3->apellidomat}}">
                            <option value="{{$ob3->idcredencial}}">Correo: {{$ob3->correo}}</option>
                            <option disabled>Cargo: {{$ob3->cargo}}</option>
                            <option disabled>UA: {{$ob3->unidad}}</option>
                        </optgroup>
                        @endforeach
                    </select>
                </div>
                <br>
                @endif
                <br>
            </section>

            <section class="mb-5 col-12">
                <br>
                <div class="py-2 text-center col-12">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <br>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">CONFIRMAR CAMBIOS</button>
                        <!--REGRESO RDSP-->
                        @if( Session::get('srol') == 3 )
                            <a href="javascript:history.back()" class="btn btn-secondary" type="button">REGRESAR</a>
                        @endif
                    </div>
                </div>
            </section>

            <!-- CIERRE RESALTADOS -->
        </div>


    </form>
</div>













<!-- CÉDULAS ENVIADAS -->
@elseif( $seccion == 4)


@if( $datos != null )
<div class="formm">
    <div class="table-responsive m-3 p-3">
        <table id="delEnviadas" class="table">

            <thead>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS PERSONALES:</th>
                    <!--<th scope="col">UNIDAD ADMINISTRATIVA:</th>-->
                    <th scope="col">DETALLES:</th>
                    <th scope="col" class="text-center">OPCIONES:</th>
                </tr>
            </thead>

            <tbody>

                @foreach($datos as $ob)

                @if( $ob->id_estadocedula == 1 || $ob->id_estadocedula == 2 )
                <tr id="tablaneutro">

                    @elseif( $ob->id_estadocedula == 3 )
                <tr id="tablaamarillo">

                    @elseif( $ob->id_estadocedula == 4 || $ob->id_estadocedula == 8 || $ob->id_estadocedula == 12 )
                <tr id="tablarojo">

                    @elseif( $ob->id_estadocedula == 6 || $ob->id_estadocedula == 10 )
                <tr id="tablagris">

                    @elseif( $ob->id_estadocedula == 7 || $ob->id_estadocedula == 11 )
                <tr id="tablaazul">

                    @elseif( $ob->id_estadocedula == 13 )
                <tr id="tablaverde">

                    @endif

                    <th scope="row">
                        {{$ob->folio}}
                    </th>

                    <td>
                        <b><span class="glyphicon glyphicon-user"></span> Nombre: </b> {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                        <!--<b>G&eacute;nero:</b> {{$ob->sexo}}-->
                    </td>

                    <!--<td>
                                <b>Cargo:</b> {{$ob->cargo}}<br>
                                <b>Situaci&oacute;n cargo:</b> {{$ob->sit_cargo}}<br>
                                <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                                <b>Nivel nominal:</b> {{$ob->nivel_nom}}<br>
                                <b>Rango:</b> {{$ob->rango}}<br>
                                <b>Clave UA:</b> {{$ob->clave_ua}}<br>
                            </td>-->

                    <td>
                        <b><span class="glyphicon glyphicon-info-sign"></span> Estatus: </b>
                        {{$ob->descripcion}}<br>

                        <b><span class="glyphicon glyphicon-user"></span> Enviada a: </b>
                        {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br>

                        <!--<b><span class="glyphicon glyphicon-envelope"></span> Usuario: </b>
                                {{$ob->correo}}<br>

                                <b><span class="glyphicon glyphicon-calendar"></span> Fecha: </b>
                                {{$ob->fecha_enviousuario}}<br>-->

                        @if( $ob->observaciones != null)
                        <b><span class="glyphicon glyphicon-search"></span> Observaciones: </b>
                        {{$ob->observaciones}}<br>
                        @endif

                    </td>

                    <td class="text-center">
                        <form action="cedulainfo" method="post">
                            @csrf

                            <input type="hidden" name="regreso" value="1000" />
                            <input type="hidden" name="iddet" value="{{ $ob->id_detalle}}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div>
                                <button class="btn btn-info" type="submit" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver más">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </button>
                            </div>

                        </form>
                    </td>


                </tr>

                @endforeach

            </tbody>

            <tfoot>
                <tr id="trencabezado">
                    <th scope="col">FOLIO:</th>
                    <th scope="col">DATOS PERSONALES:</th>
                    <!--<th scope="col">UNIDAD ADMINISTRATIVA:</th>-->
                    <th scope="col">DETALLES:</th>
                    <th scope="col">OPCIONES:</th>
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
                    <p class="txt-notify-s">No se encontraron cédulas enviadas por este perfil.</p>
                    <a href="{{route('/')}}" class="btn btn-warning" type="button">INICIO</a>
                </div>
            </div>
        </section>
    </div>
</div>

@endif




















<!-- MODIFICAR CEDULA -->
@elseif( $seccion == 5 )

<div class="formm resaltardatos my-5 p-4">

    <!-- + + + + + + + + + + + + + + + + + + Unidad Administrativo + + + + + + + + + + + + + + + + + + -->

    <div class="col-md-12">
        <h3 class="subtitle mt-5 text-center">Unidad Administrativa</h3>
        <hr>
    </div>

    <form action="{{route('actualizarfuncionario')}}" method="post" autocomplete="off" class="row g-2">
        @csrf

        <input type="text" value="{{$datos->id_cedula}}" name="idcedula" class="form-control" id="validationDefault01" hidden />
        <input type="text" value="{{$datos->id_det}}" name="iddet" class="form-control" id="validationDefault01" hidden />

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Secretaría:</label>
            <input type="text" value="{{$list[0]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n &Aacute;rea:</label>
            <input type="text" value="{{$list[3]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subsecretar&iacute;a:</label>
            <input type="text" value="{{$list[1]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subdirecci&oacute;n:</label>
            <input type="text" value="{{$list[4]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Direcci&oacute;n General:</label>
            <input type="text" value="{{$list[2]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Departamento / Oficina:</label>
            <input type="text" value="{{$datos->nombre}}" class="form-control" id="validationDefault01" readonly />
        </div>






        <!-- + + + + + + + + + + + + + + + + + + + Persona Servidora Pública, dice: + + + + + + + + + + + + + + + + + + + + -->

        <div class="col-md-12">
            <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, dice:</h3>
            <hr>
        </div>

        <input type="text" name="idpersona" value="{{$datos5->idpersona}}" class="form-control" id="validationDefault01" hidden />
        <!--<div class="col-md-1">
                    <span class="glyphicon glyphicon-user"></span>
                    <label for="validationDefault02" class="form-label">ID:</label>
                    <input type="text" name="idpersona" value="{{$datos5->idpersona}}" class="form-control" id="validationDefault01" readonly/>
                </div>-->

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Nombre completo:</label>
            <input type="text" name="nombrecompleto" value="{{$datos5->nombre1}} {{$datos5->nombre2}} {{$datos5->apellidopat}} {{$datos5->apellidomat}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
            <input type="text" name="prof" value="{{$datos5->profesion}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-9 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
            <input type="text" name="cargo" value="{{$datos5->cargo}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-3 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
            <input type="text" name="sitcargo" value="{{$datos5->situacion}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">G&eacute;nero:</label>
            <input type="text" name="sexo" value="{{$datos5->genero}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Nivel nom:</label>
            <input type="text" name="nivnom" value="{{$datos5->nivelnominal}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-2 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
            <input type="text" name="rango" value="{{$datos5->rango}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-3 mb-3">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
            <input type="text" name="clua" value="{{$datos5->cveua}}" class="form-control" id="validationDefault02" readonly />
        </div>


        <!-- Motivo del Cambio -->
        <div>

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">
                    Motivo del Cambio
                </h3>
                <hr>
            </div>

            <div class="col-md-4">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="txt-gray form-label">Motivo del cambio:</label>
                <select name="radio" class="form-control" id="sel1" required>
                    <optgroup label="Motivo Actual:">
                        <option value="{{$datos->tipo_cambio}}" selected readonly>{{$datos->tipo_cambio}}</option>
                    </optgroup>
                    @if( $datos->tipo_cambio == 'ACTUALIZACIÓN' )
                    <option value="CORRECCIÓN">CORRECCI&Oacute;N</option>

                    @elseif( $datos->tipo_cambio == 'CORRECCIÓN' )
                    <option value="ACTUALIZACIÓN">ACTUALIZACI&Oacute;N</option>

                    @else
                    <option value="ACTUALIZACIÓN">ACTUALIZACI&Oacute;N</option>
                    <option value="CORRECCIÓN">CORRECCI&Oacute;N</option>
                    @endif
                </select>
            </div>




            <!-- Persona Servidora Pública, debe decir: -->
            <div class="col-md-12">
                <div class="col-md-12">
                    <h3 class="subtitle mt-5 text-center">Persona Servidora Pública, <b>debe decir:</b></h3>
                    <hr>
                </div>

                <div id="separador-formulario">

                    @if( $datos->nombre1 == $datos5->nombre1 )
                    <div class="col-md-3 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">P. nombre:</label>
                        <input type="text" name="nombre1" value="{{$datos->nombre1}}" pattern="[a-zA-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" required />
                    </div>
                    @else
                    <div class="col-md-3 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">P. nombre:</label>
                        <input type="text" name="nombre1" value="{{$datos->nombre1}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" required />
                        <small>Dice: <b><i>{{$datos5->nombre1}}</i></b></small>
                    </div>
                    @endif

                    @if( $datos->nombre2 == $datos5->nombre2 )
                    <div class="col-md-3 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Nombre(s):</label>
                        <input type="text" name="nombre2" value="{{$datos->nombre2}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-3 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Nombre(s):</label>
                        <input type="text" name="nombre2" value="{{$datos->nombre2}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->nombre2}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->appat == $datos5->apellidopat )
                    <div class="col-md-3 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Apellido paterno:</label>
                        <input type="text" name="appat" value="{{$datos->appat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-3 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Apellido paterno:</label>
                        <input type="text" name="appat" value="{{$datos->appat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->apellidopat}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->apmat == $datos5->apellidomat )
                    <div class="col-md-3 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Apellido materno:</label>
                        <input type="text" name="apmat" value="{{$datos->apmat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-3 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Apellido materno:</label>
                        <input type="text" name="apmat" value="{{$datos->apmat}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->apellidomat}}<i></b></small>
                    </div>
                    @endif

                </div>

                <div id="separador-formulario">

                    @if( $datos->profesion == $datos5->profesion )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                        <input type="text" name="profesion" value="{{$datos->profesion}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
                        <input type="text" name="profesion" value="{{$datos->profesion}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->profesion}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->cargo == $datos5->cargo )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                        <input type="text" name="cargo2" value="{{$datos->cargo}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
                        <input type="text" name="cargo2" value="{{$datos->cargo}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->cargo}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->sit_cargo == $datos5->situacion )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-tasks txt-gray"></span>
                        <label for="sel1" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
                        <select name="sitcargo" class="form-control" id="sel1" required>
                            <optgroup label="Situación Actual:">
                                <option value="{{$datos->sit_cargo}}" selected readonly><b>{{$datos->sit_cargo}}</b></option>
                            </optgroup>
                            @if( $datos->sit_cargo == 'ENCARGADO' )
                            <option value="TITULAR">TITULAR</option>
                            @elseif( $datos->sit_cargo == 'TITULAR')
                            <option value="ENCARGADO">ENCARGADO</option>
                            @else
                            <option value="ENCARGADO">ENCARGADO</option>
                            <option value="TITULAR">TITULAR</option>
                            @endif
                        </select>
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-tasks txt-gray"></span>
                        <label for="sel1" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
                        <select name="sitcargo" class="form-control" id="sel1" required>
                            <optgroup label="Situación Actual:">
                                <option value="{{$datos->sit_cargo}}" selected readonly><b>{{$datos->sit_cargo}}</b></option>
                            </optgroup>
                            @if( $datos->sit_cargo == 'ENCARGADO' )
                            <option value="TITULAR">TITULAR</option>
                            @elseif( $datos->sit_cargo == 'TITULAR')
                            <option value="ENCARGADO">ENCARGADO</option>
                            @else
                            <option value="ENCARGADO">ENCARGADO</option>
                            <option value="TITULAR">TITULAR</option>
                            @endif
                        </select>
                        <small>Dice: <b><i>{{$datos5->situacion}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->sexo == $datos5->genero )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-tasks txt-gray"></span>
                        <label for="sel1" class="txt-gray form-label">G&eacute;nero:</label>
                        <select name="sexo2" class="form-control" id="sel1" required>
                            <optgroup label="Género Actual:">
                                <option value="{{$datos->sexo}}" selected readonly><b>{{$datos->sexo}}</b></option>
                            </optgroup>
                            @if( $datos->sexo == 'FEMENINO' )
                            <option value="MASCULINO">MASCULINO</option>
                            @elseif( $datos->sexo == 'MASCULINO' )
                            <option value="FEMENINO">FEMENINO</option>
                            @else
                            <option value="FEMENINO">FEMENINO</option>
                            <option value="MASCULINO">MASCULINO</option>
                            @endif
                        </select>
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-tasks txt-gray"></span>
                        <label for="sel1" class="txt-gray form-label">G&eacute;nero:</label>
                        <select name="sexo2" class="form-control" id="sel1" required>
                            <optgroup label="Género Actual:">
                                <option value="{{$datos->sexo}}" selected readonly><b>{{$datos->sexo}}</b></option>
                            </optgroup>
                            @if( $datos->sexo == 'FEMENINO' )
                            <option value="MASCULINO">MASCULINO</option>
                            @elseif( $datos->sexo == 'MASCULINO' )
                            <option value="FEMENINO">FEMENINO</option>
                            @else
                            <option value="FEMENINO">FEMENINO</option>
                            <option value="MASCULINO">MASCULINO</option>
                            @endif
                        </select>
                        <small>Dice: <b><i>{{$datos5->genero}}<i></b></small>
                    </div>
                    @endif

                </div>

                <div id="separador-formulario">

                    @if( $datos->nivel_nom == $datos5->nivelnominal )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Nivel nominal:</label>
                        <input type="text" name="nivelnominal" value="{{$datos->nivel_nom}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Nivel nominal:</label>
                        <input type="text" name="nivelnominal" value="{{$datos->nivel_nom}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->nivelnominal}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->rango == $datos5->rango )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                        <input type="text" name="rango2" value="{{$datos->rango}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Rango:</label>
                        <input type="text" name="rango2" value="{{$datos->rango}}" pattern="[A-Z\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->rango}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->clave_ua == $datos5->cveua )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                        <input type="text" name="claveua" value="{{$datos->clave_ua}}" pattern="[A-Z0-9\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
                        <input type="text" name="claveua" value="{{$datos->clave_ua}}" pattern="[A-Z0-9\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->cveua}}<i></b></small>
                    </div>
                    @endif

                </div>
            </div>

            <!-- Domicilio: -->
            <div class="col-md-12">
                <div class="col-md-12">
                    <h3 class="subtitle mt-5 text-center">Domicilio</h3>
                    <hr>
                </div>

                <div class="col-md-12">

                    @if( $datos->calle == $datos5->calleprincipal )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                        <input type="text" name="calle" value="{{$datos->calle}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Calle principal:</label>
                        <input type="text" name="calle" value="{{$datos->calle}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->calleprincipal}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->referencia1 == $datos5->entrecalle1 )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                        <input type="text" name="refcall1" value="{{$datos->referencia1}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 1:</label>
                        <input type="text" name="refcall1" value="{{$datos->referencia1}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->entrecalle1}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->referencia2 == $datos5->entrecalle2 )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 2:</label>
                        <input type="text" name="refcall2" value="{{$datos->referencia2}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia de calle 2:</label>
                        <input type="text" name="refcall2" value="{{$datos->referencia2}}" pattern="[A-Z0-9\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->entrecalle2}}<i></b></small>
                    </div>
                    @endif

                </div>


                <div class="col-md-12">

                    @if( $datos->numext == $datos5->numext )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                        <input type="text" name="numext" value="{{$datos->numext}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero exterior:</label>
                        <input type="text" name="numext" value="{{$datos->numext}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->numext}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->numint == $datos5->numint )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                        <input type="text" name="numint" value="{{$datos->numint}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">N&uacute;mero interior:</label>
                        <input type="text" name="numint" value="{{$datos->numint}}" pattern="[A-Za-z0-9/\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->numint}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->colonia == $datos5->colonia )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                        <input type="text" name="colonia" value="{{$datos->colonia}}" pattern="[A-Za-z0-9/\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Colonia:</label>
                        <input type="text" name="colonia" value="{{$datos->colonia}}" pattern="[A-Za-z0-9/\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->colonia}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->ciudad == $datos5->ciudad )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                        <input type="text" name="ciudad" value="{{$datos->ciudad}}" pattern="[A-Za-z0-9/\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ciudad:</label>
                        <input type="text" name="ciudad" value="{{$datos->ciudad}}" pattern="[A-Za-z0-9/\s]+{30}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->ciudad}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->municipio == $datos5->id_municipio )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-tasks txt-gray"></span>
                        <label for="sel1" class="form-label txt-gray">Municipio:</label>
                        <select name="muni" class="form-control" id="sel1" required>
                            <optgroup label="Municipio Actual:">
                                <option value="{{$datos->municipio}}" selected readonly><b>{{$datos->nombre_municipio}}</b></option>
                            </optgroup>
                            @foreach( $datos2 as $mun)
                            @if( $mun->id_municipio != $datos->municipio )
                            <option value="{{$mun->id_municipio}}">{{$mun->nombre_municipio}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-tasks txt-gray"></span>
                        <label for="sel1" class="form-label txt-gray">Municipio:</label>
                        <select name="muni" class="form-control" id="sel1" required>
                            <optgroup label="Municipio Actual:">
                                <option value="{{$datos->municipio}}" selected readonly><b>{{$datos->nombre_municipio}}</b></option>
                            </optgroup>
                            @foreach( $datos2 as $mun)
                            @if( $mun->id_municipio != $datos->municipio )
                            <option value="{{$mun->id_municipio}}">{{$mun->nombre_municipio}}</option>
                            @endif
                            @endforeach
                        </select>
                        <small>Dice: <b><i>{{$datos5->nombre_municipio}}<i></b></small>
                    </div>
                    @endif

                </div>


                <div class="col-md-12">

                    @if( $datos->barrio == $datos5->barrio )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                        <input type="text" name="barrio" value="{{$datos->barrio}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Barrio:</label>
                        <input type="text" name="barrio" value="{{$datos->barrio}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->barrio}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->piso == $datos5->piso )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                        <input type="text" name="piso" value="{{$datos->piso}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Piso:</label>
                        <input type="text" name="piso" value="{{$datos->piso}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->piso}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->puerta == $datos5->puerta )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                        <input type="text" name="puerta" value="{{$datos->puerta}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Puerta:</label>
                        <input type="text" name="puerta" value="{{$datos->puerta}}" pattern="[A-Za-z0-9/-\s]+{10}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->puerta}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->cp == $datos5->codigopostal )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                        <input type="number" name="cp" value="{{$datos->cp}}" maxlength="5" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">C&oacute;digo postal:</label>
                        <input type="number" name="cp" value="{{$datos->cp}}" maxlength="5" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->codigopostal}}<i></b></small>
                    </div>
                    @endif
                </div>


                <div class="col-md-12">

                    @if( $datos->ref_dom == $datos5->ref_ad )
                    <div class="col-md-12 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                        <input type="text" name="refadicional" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-12 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                        <input type="text" name="refadicional" value="{{$datos->ref_dom}}" pattern="[A-Za-z0-9/-\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->ref_ad}}<i></b></small>
                    </div>
                    @endif

                </div>
            </div>

            <!-- Contacto -->

            <dic class="col-md-12">

                <div class="col-md-12">
                    <h3 class="subtitle mt-5 text-center">Contacto</h3>
                    <hr>
                </div>

                <div id="separador-formulario">

                    @if( $datos->correo1 == $datos5->correo1 )
                    <div class="col-md-6 mb-3">
                        <span class="glyphicon glyphicon-envelope txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Correo 1:</label>
                        <input type="text" name="correo1" value="{{$datos->correo1}}" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-6 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-envelope txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Correo 1:</label>
                        <input type="text" name="correo1" value="{{$datos->correo1}}" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->correo1}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->correo2 == $datos5->correo2 )
                    <div class="col-md-6 mb-3">
                        <span class="glyphicon glyphicon-envelope txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                        <input type="text" name="correo2" value="{{$datos->correo2}}" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-6 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-envelope txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Correo 2:</label>
                        <input type="text" name="correo2" value="{{$datos->correo2}}" title="Ingresa un correo válido" placeholder="ejemplo@ejemplo.com" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->correo2}}<i></b></small>
                    </div>
                    @endif

                </div>

                <div>

                    @if( $datos->lada == $datos5->lada )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                        <input type="text" name="lada" value="{{$datos->lada}}" pattern="[0-9]+" maxlength="3" title="Ingresa solo números." placeholder="###" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-1 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Lada:</label>
                        <input type="text" name="lada" value="{{$datos->lada}}" pattern="[0-9]+" maxlength="3" title="Ingresa solo números." placeholder="###" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->lada}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->tel1 == $datos5->tel1 )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                        <input type="text" name="tel1" value="{{$datos->tel1}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 1:</label>
                        <input type="text" name="tel1" value="{{$datos->tel1}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->tel1}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->tel2 == $datos5->tel2 )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                        <input type="text" name="tel2" value="{{$datos->tel2}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 2:</label>
                        <input type="text" name="tel2" value="{{$datos->tel2}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->tel2}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->tel3 == $datos5->tel3 )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                        <input type="text" name="tel3" value="{{$datos->tel3}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 3:</label>
                        <input type="text" name="tel3" value="{{$datos->tel3}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->tel3}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->tel4 == $datos5->tel4 )
                    <div class="col-md-2 mb-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                        <input type="text" name="tel4" value="{{$datos->tel4}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-2 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Tel&eacute;fono 4:</label>
                        <input type="text" name="tel4" value="{{$datos->tel4}}" pattern="[0-9]+" maxlength="7" title="Ingresa solo números." placeholder="#######" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->tel4}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->ext1 == $datos5->ext1 )
                    <div class="col-md-1 mb-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                        <input type="text" name="ext1" value="{{$datos->ext1}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-1 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ext 1:</label>
                        <input type="text" name="ext1" value="{{$datos->ext1}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->ext1}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->ext2 == $datos5->ext2 )
                    <div class="col-md-1 mb-3">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                        <input type="text" name="ext2" value="{{$datos->ext2}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-1 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-earphone txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Ext 2:</label>
                        <input type="text" name="ext2" value="{{$datos->ext2}}" pattern="[0-9]+" maxlength="5" title="Ingresa solo números." placeholder="#####" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->ext2}}<i></b></small>
                    </div>
                    @endif

                </div>
<!--
                <div>

                    @if( $datos->facebook == $datos5->facepage )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                        <input type="text" name="facebook" value="{{$datos->facebook}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Facebook:</label>
                        <input type="text" name="facebook" value="{{$datos->facebook}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->facepage}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->twitter == $datos5->twit )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                        <input type="text" name="twitter" value="{{$datos->twitter}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Twitter:</label>
                        <input type="text" name="twitter" value="{{$datos->twitter}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->twit}}<i></b></small>
                    </div>
                    @endif

                    @if( $datos->web == $datos5->red )
                    <div class="col-md-4 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Página web:</label>
                        <input type="text" name="web" value="{{$datos->web}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                    </div>
                    @else
                    <div class="col-md-4 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Página web:</label>
                        <input type="text" name="web" value="{{$datos->web}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control" id="validationDefault02" />
                        <small>Dice: <b><i>{{$datos5->red}}<i></b></small>
                    </div>
                    @endif

                </div>
            -->
                <div id="separador-formulario">


                    @if( $datos->ref_con == $datos5->refead )
                    <div class="col-md-12 mb-3">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                        <input type="text" name="refead" value="{{$datos->ref_con}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                    </div>
                    @else
                    <div class="col-md-12 mb-3" id="resaltar-texto">
                        <span class="glyphicon glyphicon-user txt-gray"></span>
                        <label for="validationDefault02" class="form-label txt-gray">Referencia adicional:</label>
                        <input type="text" name="refead" value="{{$datos->ref_con}}" pattern="[A-Za-z0-9/-_@\s]+{50}" class="form-control upper" id="validationDefault02" onkeyup="this.value = this.value.toUpperCase();" />
                        <small>Dice: <b><i>{{$datos5->refead}}<i></b></small>
                    </div>
                    @endif

                </div>
                <br>
            </dic>


            <!-- Enlace -->
            @if( $correcciones == 0 )

            <div class="col-md-12">
                <h3 class="subtitle mt-5 text-center">Datos del Delegado Administrativo</h3>
                <hr>
            </div>

            <div class="col-md-4" id="separacionbottom">
                <span class="glyphicon glyphicon-tasks txt-gray"></span>
                <label for="sel1" class="form-label txt-gray">Direcciones de los Delegado Administrativo:</label>
                <select name="enlace" class="form-control" id="sel1" required>
                    <optgroup label="Delegado Administrativo Actual: {{$datos4->nombre1}} {{$datos4->nombre2}} {{$datos4->apellidopat}} {{$datos4->apellidomat}}">
                        <!--<option disabled><b></b></option>-->
                        <option value="{{$datos4->idcredencial}}" selected readonly>Correo: {{$datos4->correo}}</option>
                        <option disabled>Cargo: {{$datos4->cargo}}</option>
                        <option disabled>UA: {{$datos4->unidad}}</option>
                    </optgroup>
                    @foreach( $datos3 as $ob3 )
                    @if( $datos4->idcredencial != $ob3->idcredencial )
                    <optgroup label="{{$ob3->nombre1}} {{$ob3->nombre2}} {{$ob3->apellidopat}} {{$ob3->apellidomat}}">
                        <option value="{{$ob3->idcredencial}}">Correo: {{$ob3->correo}}</option>
                        <option disabled>Cargo: {{$ob3->cargo}}</option>
                        <option disabled>UA: {{$ob3->unidad}}</option>
                    </optgroup>
                    @endif
                    @endforeach
                </select>
            </div>

            @endif


            <!-- cierre resaltar datos-->
        </div>


        <div id="separacion">
            <div class="col-12" align="center">
                @if( $correcciones > 0 )
                <p><b>*Nota:</b> Una vez confirmando los cambios, la c&eacute;dula se enviará autom&aacute;ticamente al delegado correspondiente.</p>
                <button class="btn btn-success" type="submit">CONFIRMAR CAMBIOS</button>
                <a href="{{route('correcciones')}}" type="button" class="btn btn-secondary" id="tamanioboton">REGRESAR</a>
                @else
                <button class="btn btn-success" type="submit">CONFIRMAR CAMBIOS</button>
                <a href="{{route('pendientes')}}" type="button" class="btn btn-secondary" id="tamanioboton">REGRESAR</a>
                @endif
            </div>
        </div>


    </form>
</div>
@endif

@endsection