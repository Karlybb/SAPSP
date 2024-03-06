<!DOCTYPE html>
<html lang="es">

<head>
    <title>SAPSP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' cdn.jsdelivr.net cdn.datatables.net maxcdn.bootstrapcdn.com ajax.googleapis.com 'unsafe-inline'">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/public/img/escudoedomex.png') }}" crossorigin="anonymous">
    <!-- Estilos - LS -->
    <link rel="stylesheet" href="{{ asset('/resources/css/app.css') }}" crossorigin="anonymous">
    <!-- DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous"></script>

    <!-- DATATABLES-->
    <!-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style type="text/css">
        .ulcol {
            background-color: yellow;
        }

        .divcol {
            background-color: blue;
        }


        .tamposalertas {
            width: 50%;
        }

        .btn-limpiar {
            margin-left: 1.5%;
        }

        #divocultar {
            display: none;
        }

        #divocultarcat {
            display: none;
        }


        #separacionbtnpendientes {
            margin-top: 5%;
        }

        #msj {
            margin-top: 10%;
            margin-left: 20%;
            margin-right: 20%;
        }

        #msj2 {
            margin-top: 3%;
            margin-left: 20%;
            margin-right: 20%;
        }

        #enviaralrdsp {
            margin-top: 10%;
        }

        #nota {
            margin-top: 1%;
        }

        #color1 {
            background-color: #00CC66;
        }

        #conteiner-perfil {
            height: auto;
        }

        #vacaciones {
            padding-left: 33%;
        }

        #izq {
            margin-right: 10%;
            margin-top: 15%;
        }
    </style>

    <script crossorigin="anonymous">

        var activado =0;    
        function mostrar() {
            document.getElementById('divocultar').style.display = 'block';
        }

        function ocultar() {
            document.getElementById('divocultar').style.display = 'none';
        }

        function mostrarcat() {
            document.getElementById('divocultarcat').style.display = 'block';
        }

        function ocultarcat() {
            document.getElementById('divocultarcat').style.display = 'none';
        }

        // Script limpiar datos
        function limpiar() {
            document.getElementById("limpiartexto1").value = "";
            document.getElementById("limpiartexto2").value = "";
            document.getElementById("limpiartexto3").value = "";
            document.getElementById("limpiartexto4").value = "";
            document.getElementById("limpiartexto5").value = "";
            document.getElementById("limpiartexto6").value = "";
            document.getElementById("limpiartexto7").value = "";
            document.getElementById("limpiartexto8").value = "";
            document.getElementById("limpiartexto9").value = "";
            document.getElementById("limpiartexto10").value = "";
            document.getElementById("limpiartexto11").value = "";
            //OBTENEMOS EL ID DEL FORM
            //FORM.RESET()
        }

        function limpiar2() {
             document.getElementById("busqueda1").value = "";
             document.getElementById("busqueda2").value = "";
             document.getElementById("busqueda3").value = "";
             document.getElementById("busqueda4").value = "";
    
        }

        function limpiar3() {
            document.getElementById("limpiartexto1").value = "";
            document.getElementById("limpiartexto2").value = "";
            document.getElementById("limpiartexto3").value = "";
            document.getElementById("limpiartexto4").value = "";
            document.getElementById("limpiartexto5").value = "";            
            document.getElementById("limpiartexto7").value = "";
            document.getElementById("limpiartexto8").value = "";
            document.getElementById("limpiartexto9").value = "";
            document.getElementById("limpiartexto10").value = "";
            
        }

        function Mostrar() //usuario.blade linea 276 si selecciona un usuario/delegado
        {
        
        var combo = document.getElementById("v01");
        var selected = combo.options[combo.selectedIndex].text;   
        
               
          if (((combo.options[combo.selectedIndex].text =='Usuario') || (combo.options[combo.selectedIndex].text =='Administrador')) && activado == 0  ){
               document.getElementById('boxUno').classList.toggle('oculto');
               activado=1;
               consol.log("activado");
                              
            }
         if ((combo.options[combo.selectedIndex].text =='Enlace'|| (combo.options[combo.selectedIndex].text =='RDSP')) && activado == 1  ){
               document.getElementById('boxUno').classList.toggle('oculto');
               activado=0;
               
               
            }
          

        }

        function ShowSelected()
                {
                
                var combo = document.getElementById("sel1");
                var selected = combo.options[combo.selectedIndex].text;              
                  if (combo.options[combo.selectedIndex].text =='ACTUALIZACIÓN'){
                        limpiar3();
                    }
                  if(combo.options[combo.selectedIndex].text =='CORRECCIÓN'){
                      
                        location.reload();          
                       
                    }

                }

    </script>


  
    

    


</head>


<body>


    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid d-flex align-items-center justify-content-between">

            <div class="home">
                <a class="navbar-brand" href="{{route('/')}}">
                    <img src="{{ asset('/public/img/mgobierno2.png') }}" alt="" style="width:125px;">
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse p-2" id="navbarNavDropdown">
                <ul class="navbar-nav mt-3 p-3 d-flex justify-content-end" style="width: 90%;">

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('/')}}">
                            <span class="glyphicon glyphicon-home"></span> HOME
                        </a>
                    </li>

                    @if( Session::get('srol') == 1 || Session::get('srol') == 99 )
                    <li class="nav-item dropdown navbar-left">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-file"></span> USUARIO HABILITADO
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-header" align="center">Requisitar C&eacute;dula</div>
                            <li><a class="dropdown-item" href="{{route('consultarfun')}}"><span class="glyphicon glyphicon-edit"></span> Nueva C&eacute;dula</a></li>
                            <li><a class="dropdown-item" href="{{route('pendientes')}}"><span class="glyphicon glyphicon-exclamation-sign"></span> C&eacute;dulas Pendientes</a></li>
                            <li><a class="dropdown-item" href="{{route('cedulasenviadas')}}"><span class="glyphicon glyphicon-share-alt"></span> C&eacute;dulas Enviadas</a></li>
                            <li><a class="dropdown-item" href="{{route('correcciones')}}"><span class="glyphicon glyphicon-pencil"></span> Correcci&oacute;n de C&eacute;dulas</a></li>
                            <li><a class="dropdown-item" href="{{route('buscar')}}"><span class="glyphicon glyphicon-search"></span> B&uacute;squeda de C&eacute;dulas</a></li>
                            <div class="dropdown-divider"></div>
                        </ul>
                    </li>
                    @endif

                    @if( Session::get('srol') == 2 || Session::get('srol') == 99 )
                    <li class="nav-item dropdown navbar-left">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-screenshot"></span> DELEGADO ADMINISTRATIVO
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-header" align="center">C&eacute;dulas</div>
                            <li><a class="dropdown-item" href="{{route('bandejaenlace')}}"><span class="glyphicon glyphicon-envelope"></span> Bandeja de Entrada</a></li>
                            <li><a class="dropdown-item" href="{{route('cedulasenviadasenlace')}}"><span class="glyphicon glyphicon-ok"></span> C&eacute;dulas Enviadas</a></li>
                            <li><a class="dropdown-item" href="{{route('rechazadasenlace')}}"><span class="glyphicon glyphicon-remove"></span> C&eacute;dulas Rechazadas</a></li>
                            <li><a class="dropdown-item" href="{{route('buscar_e')}}"><span class="glyphicon glyphicon-search"></span> B&uacute;squeda de C&eacute;dulas</a></li>
                            <div class="dropdown-divider"></div>
                        </ul>
                    </li>
                    @endif

                    @if( Session::get('srol') == 3 || Session::get('srol') == 99 )
                    <li class="nav-item dropdown navbar-left">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-check"></span> RDSP
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-header" align="center">C&eacute;dulas</div>
                            <li><a class="dropdown-item" href="{{route('bandejardsp')}}"><span class="glyphicon glyphicon-envelope"></span> Bandeja de Entrada</a></li>
                            <li><a class="dropdown-item" href="{{route('cedulaspublicadas')}}"><span class="glyphicon glyphicon-ok"></span> C&eacute;dulas Aprobadas</a></li>
                            <li><a class="dropdown-item" href="{{route('rechazadasrdsp')}}"><span class="glyphicon glyphicon-remove"></span> C&eacute;dulas Rechazadas</a></li>

                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header" align="center">C&eacute;dulas por Instrucci&oacute;n</div>
                            <li><a class="dropdown-item" href="{{route('consultarfun')}}"><span class="glyphicon glyphicon-pencil"></span> Crear C&eacute;dula</a></li>
                            <li><a class="dropdown-item" href="{{route('cedulaspendientes')}}"><span class="glyphicon glyphicon-edit"></span> C&eacute;dulas Pendientes</a></li>
                            <li><a class="dropdown-item" href="{{route('cedulasdiraprobadas')}}"><span class="glyphicon glyphicon-ok"></span> C&eacute;dulas Aprobadas</a></li>
                            <li><a class="dropdown-item" href="{{route('cedulasdirrechazadas')}}"><span class="glyphicon glyphicon-remove"></span> C&eacute;dulas Rechazadas</a></li>

                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header" align="center">B&uacute;squeda de C&eacute;dulas</div>
                            <li><a class="dropdown-item" href="{{route('buscar_r')}}"><span class="glyphicon glyphicon-search"></span> Consultar C&eacute;dulas</a></li>

                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header" align="center">Periodo Vacacional</div>
                            <li><a class="dropdown-item" href="{{route('vistaperiodo')}}"><span class="glyphicon glyphicon-calendar"></span> Crear Periodo</a></li>
                            <li><a class="dropdown-item" href="{{route('consultarperiodo')}}"><span class="glyphicon glyphicon-search"></span> Consultar Periodo</a></li>
                            <div class="dropdown-divider"></div>
                        </ul>
                    </li>
                    @endif

                    @if( Session::get('srol') == 99 )
                    <li class="nav-item dropdown navbar-left">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span> PERSONA SERVIDORA P&Uacute;BLICA
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-header" align="center">Persona Servidora P&uacute;blica</div>
                            <li><a class="dropdown-item" href="{{route('formfuncionario')}}"><span class="glyphicon glyphicon-user"></span> Crear Persona Servidora P&uacute;blica</a></li>
                            <li><a class="dropdown-item" href="{{route('personalagregado')}}"><span class="glyphicon glyphicon-time"></span> Consultar Creados</a></li>
                            <li><a class="dropdown-item" href="{{route('personaleliminado')}}"><span class="glyphicon glyphicon-time"></span> Consultar Eliminados</a></li>
                            <li><a class="dropdown-item" href="{{route('buscarsp')}}"><span class="glyphicon glyphicon-search"></span> Consultar</a></li>
                            <div class="dropdown-divider"></div>
                        </ul>
                    </li>
                    @endif

                    @if( Session::get('srol') == 99 )
                    <li class="nav-item dropdown navbar-left">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="glyphicon glyphicon-wrench"></span> ADMIN
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-header" align="center">Usuarios</div>
                            <li><a class="dropdown-item" href="{{route('vistabusqueda')}}"><span class="glyphicon glyphicon-search"></span> Consultar Usuarios</a></li>
                            <li><a class="dropdown-item" href="{{route('usuariosactivos')}}"><span class="glyphicon glyphicon-user"></span> Usuarios Activos</a></li>
                            <li><a class="dropdown-item" href="{{route('usuariosdesactivados')}}"><span class="glyphicon glyphicon-user"></span> Usuarios Desactivados</a></li>
                            <div class="dropdown-divider"></div>
                            <!--<div class="dropdown-header" align="center">C&eacute;dulas</div>
                                <div class="dropdown-divider"></div>
                                <div class="dropdown-header" align="center">Entidades</div>
                                <li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-list-alt"></span> Entidades</a></li>-->
                        </ul>
                    </li>
                    @endif

                    <!--<li>
                            <a class="nav-link" href="#" id="navbarDropdownMenuLink" role="button" aria-expanded="false">
                                <span class="glyphicon glyphicon-envelope"></span> Mensajes
                            </a>
                        </li>-->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{Session::get('snametitulo')}}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="{{route('perfil')}}"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                            <!--<li><a class="dropdown-item" href="{{route('descargarmanual')}}"><span class="glyphicon glyphicon-book"></span> Manual de Usuario</a></li>-->
                            <li><a class="dropdown-item" href="{{route('vistaprevia')}}"><span class="glyphicon glyphicon-book"></span> Manual de Usuario</a></li>
                            <div class="dropdown-divider"></div>
                            <li><a class="dropdown-item" href="{{route('logout')}}"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <!--
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a class="dropdown-item" href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>-->

        </div>
    </nav>

    <div class="contenedor">
        @yield('content')
    </div>
    <!--Footer  -->
    @include('plantillas.footer')



</body>
<script src="{{'resources/js/app.js'}}"></script>

<!-- <script crossorigin="anonymous">
    $('#tabladt').DataTable({
        responsive: true,
        autoWidth: false,

        "language": {
            "lengthMenu": 'Mostrar <select>' +
                '<option value="2">2</option>' +
                '<option value="5">5</option>' +
                '<option value="10">10</option>' +
                '<option value="20">20</option>' +
                '<option value="30">30</option>' +
                '<option value="-1">Todas</option>' +
                '</select> cédulas por página.',
            "zeroRecords": "No existen registros con esos parámetros.",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No existen cédulas.",
            "infoFiltered": "(filtrado para un máximo de _MAX_ registros)",
            "loadingRecords": "Cargando cédulas...",
            "processing": "Procesando cédulas...",
            "search": "Buscar en la tabla: ",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
</script> -->

</html>