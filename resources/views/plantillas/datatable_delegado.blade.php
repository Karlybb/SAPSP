@extends('plantillas/nav')

@section('content')

    <div class="p-3 mb-2 bg-secondary text-white">
        <h1 align="center">{{ $titulo }}</h1>
        <h5 align="center">{{ $subtitulo }}</h5>
    </div>

    <!-- RESULTADOS DE LAS BUSQUEDA DE LOS FUNCIONARIOS -->
    @if($seccion == 1)

        <h4>ESTA ES LA PLANTILLA DATATABLE</h4>


        <div class="formm">
            <table id="tabladt" class="table">

                <thead>
                    <tr class="table-dark">
                        <th scope="col">FOLIO:</th>
                        <th scope="col">DATOS PERSONALES:</th>
                        <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                        <th scope="col" id="anchoculumna1">MOTIVO:</th>
                        <th scope="col" id="anchoculumna2">ESTATUS:</th>
                    </tr>
                </thead>

                <tbody>
                    
                    @foreach($datos as $ob)
                        <tr style="background-color: #FCDAD3">
                          
                            <th scope="row">
                                {{$ob->folio}}
                            </th>

                            <th>
                                Nombre: {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                                G&eacute;nero: {{$ob->sexo}}
                            </th>
                            
                            <td>
                                <b>Cargo:</b> {{$ob->cargo}}<br>
                                <b>Situaci&oacute;n cargo:</b> {{$ob->sit_cargo}}<br>
                                <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                                <b>Nivel nominal:</b> {{$ob->nivel_nom}}<br>
                                <b>Rango:</b> {{$ob->rango}}<br>
                                <b>Clave UA:</b> {{$ob->clave_ua}}<br>
                            </td>

                            <td>
                                <b>Motivo del cambio:</b><br>
                                <span class="glyphicon glyphicon-refresh"></span> {{$ob->tipo_cambio}}<br><br>
                            </td>

                            <td>
                                <b>Estado:</b><br>
                                <span class="glyphicon glyphicon-info-sign"></span> {{$ob->descestado}}<br><br>
                                
                                <b>Rechazada:</b><br>
                                <span class="glyphicon glyphicon-remove"></span> {{$ob->fecha_publicacionrdsp}}<br><br>

                                @if( $ob->observaciones != null)
                                    <b>Observaciones:</b><br>
                                    <span class="glyphicon glyphicon-search"></span> {{$ob->observaciones}}<br>
                                @endif
                            </td>
                            
                            
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    <tr class="table-dark">
                        <th scope="col">FOLIO:</th>
                        <th scope="col">DATOS PERSONALES:</th>
                        <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                        <th scope="col" id="anchoculumna1">MOTIVO:</th>
                        <th scope="col" id="anchoculumna2">ESTATUS:</th>
                    </tr>
                </tfoot>

            </table>
        </div>


        









    <!-- CÉDULAS ENVIADAS -->
    @elseif($seccion == 2)

        @if($datos != null)

            <div class="formm">
                <table id="tabladt" class="table">

                    <thead>
                        <tr class="table-dark">
                            <th scope="col">FOLIO:</th>
                            <th scope="col">DATOS PERSONALES:</th>
                            <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                            <th scope="col">DETALLES:</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        @foreach($datos as $ob)
                            <tr style="background-color: #FCDAD3">
                                
                                <th scope="row">
                                    {{$ob->folio}}
                                </th>

                                <td>
                                    <b>Nombre:</b> {{$ob->nom1}} {{$ob->nom2}} {{$ob->appat}} {{$ob->apmat}}<br>
                                    <b>G&eacute;nero:</b> {{$ob->sexo}}
                                </td>

                                <td>
                                    <b>Cargo:</b> {{$ob->cargo}}<br>
                                    <b>Situaci&oacute;n cargo:</b> {{$ob->sit_cargo}}<br>
                                    <b>Profesi&oacute;n:</b> {{$ob->profesion}}<br>
                                    <b>Nivel nominal:</b> {{$ob->nivel_nom}}<br>
                                    <b>Rango:</b> {{$ob->rango}}<br>
                                    <b>Clave UA:</b> {{$ob->clave_ua}}<br>
                                </td>

                                <td>
                                    <b>Estatus:</b><br>
                                    <span class="glyphicon glyphicon-info-sign"></span> {{$ob->descripcion}}<br><br>

                                    <b>Enviada a:</b><br>
                                    <span class="glyphicon glyphicon-user"></span> {{$ob->nombre1}} {{$ob->nombre2}} {{$ob->apellidopat}} {{$ob->apellidomat}}<br><br>

                                    <b>Usuario:</b><br>
                                    <span class="glyphicon glyphicon-envelope"></span> {{$ob->correo}}<br><br>

                                    <b>Fecha:</b><br>
                                    <span class="glyphicon glyphicon-calendar"></span> {{$ob->fecha_enviousuario}}<br><br>

                                    @if( $ob->observaciones != null)
                                        <b>Observaciones:</b><br>
                                        <span class="glyphicon glyphicon-search"></span> {{$ob->observaciones}}<br>
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                    <tfoot>
                        <tr class="table-dark">
                            <th scope="col">FOLIO:</th>
                            <th scope="col">DATOS PERSONALES:</th>
                            <th scope="col">UNIDAD ADMINISTRATIVA:</th>
                            <th scope="col">DETALLES:</th>
                        </tr>
                    </tfoot>

                </table>
            </div>

        @else
            <div class="alert alert-info" id="msj" role="alert">
                <h1 align="center">SIN RESULTADOS</h1>
                <h5 align="center">No se encontraron c&eacute;dulas enviadas por este perfil.</h5>
                <div class="col-12" align="center">
                    <a href="{{route('/')}}" class="btn btn-primary" type="button">IR A INICIO</a>
                </div>
            </div>
        @endif

    @endif

    


@endsection