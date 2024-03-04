@extends('plantillas/nav')

@section('content')
<div class="p-2 mb-2 bg-banner text-white shadow-lg">
    <h1 align="center">{{ $titulo }}</h1>
    <h5 align="center">{{ $subtitulo }}</h5>
</div>

<div class="formm">

    <h3 class="subtitle mt-5 text-center">Unidad Administrativa</h3>
    <hr>

    <div class="row mb-3 p-2">
        <div class="col-md-6 pb-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Secretaría:</label>
            <input type="text" value="{{$list[0]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 pb-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subsecretaría:</label>
            <input type="text" value="{{$list[1]}}" class="form-control" id="validationDefault01" readonly />
        </div>
    </div>

    <div class="row mb-3 p-2">
        <div class="col-md-6 pb-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Dirección General:</label>
            <input type="text" value="{{$list[2]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 pb-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-labeltxt txt-gray">Dirección Área:</label>
            <input type="text" value="{{$list[3]}}" class="form-control" id="validationDefault01" readonly />
        </div>

    </div>

    <div class="row mb-3 p-2">
        <div class="col-md-6 pb-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Subdirección:</label>
            <input type="text" value="{{$list[4]}}" class="form-control" id="validationDefault01" readonly />
        </div>

        <div class="col-md-6 pb-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Departamento / Oficina:</label>
            <input type="text" value="{{$datos->nombre}}" class="form-control" id="validationDefault01" readonly />
        </div>

    </div>

    <h3 class="subtitle mt-5 text-center">Datos Personales</h3>
    <hr>

    <!--
        <div class="col-md-1">
            <span class="glyphicon glyphicon-user"></span>
            <label for="validationDefault02" class="form-label">ID:</label>
            <input type="text" value="{{$datos->idcredencial}}" class="form-control" id="validationDefault01" readonly/>
        </div>
    -->

    <div class="row mb-3 p-2">
        <div class="col-md-6">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault01" class="form-label txt-gray">Nombre completo:</label>
            <input type="text" value="{{$datos->nombre1}} {{$datos->nombre2}} {{$datos->apellidopat}} {{$datos->apellidomat}}" class="form-control" id="validationDefault01" readonly />
        </div>
        <div class="col-md-6">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Correo:</label>
            <input type="text" value="{{$datos->correo}}" class="form-control" id="validationDefault02" readonly />
        </div>
    </div>

    <div class="row mb-3 p-2">
        <div class="col-md-6">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Profesi&oacute;n:</label>
            <input type="text" value="{{$datos->profesion}}" class="form-control" id="validationDefault02" readonly />
        </div>

        <div class="col-md-6 p-2">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Cargo:</label>
            <input type="text" value="{{$datos->cargo}}" class="form-control" id="validationDefault02" readonly />
        </div>

    </div>

    <div class="row mb-3 p-2">

        <div class="col-md-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Clave UA:</label>
            <input type="text" value="{{$datos->cveua}}" class="form-control" id="validationDefault01" readonly />
        </div>

       <!-- <input type="text" value="{{$datos->rol}}" class="form-control" id="validationDefault02" readonly /> DATO ANTERIOR-->
        <div class="col-md-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Rol:</label>
            @if($datos->rol=='Enlace')
            <input type="text" value="Delegado Administrativo" class="form-control" id="validationDefault02" readonly />        
            @endif
            @if($datos->rol=='Usuario')
            <input type="text" value="Usuario Habilitado" class="form-control" id="validationDefault02" readonly />        
            @endif
           
        </div>



        <div class="col-md-4">
            <span class="glyphicon glyphicon-user txt-gray"></span>
            <label for="validationDefault02" class="form-label txt-gray">Situaci&oacute;n cargo:</label>
            <input type="text" value="{{$datos->tipo}}" class="form-control" id="validationDefault02" readonly />
        </div>

    </div>

</div>

@endsection