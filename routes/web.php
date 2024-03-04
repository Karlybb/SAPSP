<?php

use Illuminate\Support\Facades\Route;

Use App\Http\Controllers\Pruebas_Controller;
Use App\Http\Controllers\RDSP_Controller;
Use App\Http\Controllers\Enlace_Controller;
use App\Http\Controllers\Cedulas_Controller;
use App\Http\Controllers\Usuarios_Controller;
Use App\Http\Controllers\Login_Controller;
Use App\Http\Controllers\Funcionarios_Controller;
Use App\Http\Controllers\Manual_Controller;
Use App\Http\Controllers\VistaCedula_Controller;

Use App\Mail\CorreoElectronico;
Use Illuminate\Support\Facades\Mail;


// Pruebas
Route::controller(Pruebas_Controller::class)->group(function(){
    Route::get('prueba','Prueba')->name('prueba');
    Route::get('generarpass/{cantidad}/{longitud}','GenerarContrasenias')->name('generarpass');
});




// Index
Route::get('login', function () { return view('login');})->name('login');



// Ruta HOME
Route::get('/',[Login_Controller::class, 'Index'])->name('/');


// Login
Route::controller(Login_Controller::class)->group(function(){
    Route::post('login','Login')->name('login');
    Route::get('logout','Logout')->name('logout');
    Route::get('perfil','Perfil')->name('perfil');
});



// Rutas de las CEDULAS
Route::controller(Cedulas_Controller::class)->group(function(){
    Route::get('consultarfun','Cedula')->name('consultarfun');  // Aquí
   
    Route::post('buscarfuncionario','Buscar_Funcionario')->name('buscarfuncionario');
    Route::post('cargardatos','Cargar_Datos')->name('cargardatos');
    Route::post('insertarfuncionario','Insertar_Funcionario')->name('insertarfuncionario');
    Route::get('pendientes','Pendientes')->name('pendientes');
    Route::get('cedulasenviadas','Cedulas_Enviadas')->name('cedulasenviadas');
    Route::post('validardatos','Validar_Datos')->name('validardatos');
    Route::post('enviarcedula','Enviar_Cedula')->name('enviarcedula');
    Route::post('eliminarcedula','Eliminar_Cedula')->name('eliminarcedula');
    Route::post('eliminacedula','Desactivar_Cedula')->name('eliminacedula');
    Route::post('modificardatos','Modificar_Datos')->name('modificardatos');
    Route::post('actualizarfuncionario','Actualizar_Funcionario')->name('actualizarfuncionario');
    Route::get('correcciones','Correccion')->name('correcciones');
    Route::get('buscar','Buscar')->name('buscar');
    Route::post('buscarced','Buscar_Cedulas')->name('buscarced');
});



// Rutas del Enlace
Route::controller(Enlace_Controller::class)->group(function(){
    Route::get('bandejaenlace','Bandeja_Entrada')->name('bandejaenlace');
    Route::post('vercedula','Ver_Cedula')->name('vercedula');
    Route::post('validarcedula','Validar_Cedula')->name('validarcedula');
    Route::post('validacedula','Enviar_Cedula_RDSP')->name('validacedula');
    Route::post('correccion','Correccion_EnlaceyRDSP')->name('correccion');
    Route::post('enviarcorreccion','Enviar_Correccion')->name('enviarcorreccion');
    Route::post('invalidarcedula','Invalidar_Cedula')->name('invalidarcedula');
    Route::post('rechazarcedula','Rechazar_Cedula')->name('rechazarcedula');
    Route::get('rechazadasenlace','Vista_Rechazadas')->name('rechazadasenlace');
    Route::get('cedulasenviadasenlace','Cedulas_Enviadas')->name('cedulasenviadasenlace');
    Route::get('buscar_e','Buscar')->name('buscar_e');
    Route::post('buscarced_e','Buscar_Cedulas')->name('buscarced_e');
});



// Rutas del RDSP
Route::controller(RDSP_Controller::class)->group(function(){
    Route::get('bandejardsp','Bandeja_Entrada')->name('bandejardsp');
    Route::post('vercedulardsp','Ver_Cedula')->name('vercedulardsp');
    Route::post('validarcedulardsp','Validar_Cedula')->name('validarcedulardsp');
    Route::post('validacedulardsp','Publicar')->name('validacedulardsp');
    Route::get('cedulaspublicadas','Cedulas_Publicadas')->name('cedulaspublicadas');
    Route::post('invalidarcedulardsp','Invalidar_Cedula')->name('invalidarcedulardsp');
    Route::post('rechazarcedulardsp','Rechazar_Cedula')->name('rechazarcedulardsp');
    Route::get('rechazadasrdsp','Vista_Rechazadas')->name('rechazadasrdsp');
    Route::get('cedulaspendientes','Consultar_Cedula_Directa')->name('cedulaspendientes');
    Route::post('modceddir','Vista_Cedula_Directa')->name('modceddir');
    Route::post('modificarced','Modificar_Cedula_Directa')->name('modificarced');
    Route::get('cedulasdiraprobadas','Cedulas_Directas_Aprobadas')->name('cedulasdiraprobadas');
    Route::get('cedulasdirrechazadas','Cedulas_Directas_Rechazadas')->name('cedulasdirrechazadas');
    Route::get('buscar_r','Buscar')->name('buscar_r');
    Route::post('buscarced_r','Buscar_Cedulas')->name('buscarced_r');

    Route::get('vistaperiodo','Vista_Periodo')->name('vistaperiodo');
    Route::post('crearperiodo','Crear_Periodo')->name('crearperiodo');
    Route::get('consultarperiodo','Consultar_Periodo')->name('consultarperiodo');
    Route::get('consultaa','Consulta')->name('consultaa');
    Route::post('consul','Consul')->name('consul');
    Route::post('modificarper','Vista_Modificar_Periodo')->name('modificarper');
    Route::post('modificarperiodo','Modificar_Periodo')->name('modificarperiodo');
    Route::post('eliminaperiodo','Elimina_Periodo')->name('eliminaperiodo');
    Route::post('eliminarperiodo','Desactivar_Periodo')->name('eliminarperiodo');

    Route::post('eliminarpub','Confirmacion_Eliminar')->name('eliminarpub');
    Route::post('eliminarpublicacion','Eliminar_Publicacion')->name('eliminarpublicacion');
});



// Rutas del ADMIN
Route::controller(Usuarios_Controller::class)->group(function(){
    Route::get('vista','Vista_Busqueda')->name('vistabusqueda');
    Route::post('consultarusuarios','Consultar_Usuarios')->name('consultarusuarios');
    Route::get('crearrol/{id}/{sp}','Vista_Crear_Rol')->name('crearrol');
    Route::post('insertarcredenciales','Ingresar_Credenciales')->name('insertarcredenciales');
    Route::get('desactivarrol/{id}','Desactivar_Usuario')->name('desactivarrol');
    Route::get('usuariosactivos','Usuarios_Activos')->name('usuariosactivos');
    Route::get('usuariosdesactivados','Usuarios_Desactivados')->name('usuariosdesactivados');
    Route::get('desactivarusu/{id}','Desactivar_Usu')->name('desactivarusu');
    Route::get('activarusuario/{id}','Activar_Usuario')->name('activarusuario');
    Route::get('activarusu/{id}','Activar_Usu')->name('activarusu');
    Route::get('modrol/{id}','Vista_Modificar')->name('modrol');
    Route::post('modificarcredenciales','Modificar_Credenciales')->name('modificarcredenciales');
});



// Rutas de los Funcionarios
Route::controller(Funcionarios_Controller::class)->group(function(){
    Route::get('formfuncionario','Form_Funcionario')->name('formfuncionario');
    Route::post('crearpersona','Insertar_Persona')->name('crearpersona');
    Route::get('personalagregado','Agregadas_Recientemente')->name('personalagregado');
    Route::get('personaleliminado','Personal_Eliminado')->name('personaleliminado');
    Route::get('buscarsp','Buscar_SP')->name('buscarsp');
    Route::post('buscarpersonal','Buscar')->name('buscarpersonal');
    // Eliminar
    Route::get('veliminarsp/{id}','Vista_Eliminar_SP')->name('veliminarsp');
    Route::get('veliminarco/{id}','Vista_Eliminar_CO')->name('veliminarco');
    Route::get('veliminar/{id}/{op}','Eliminar_Usu')->name('veliminar');
    // Activar
    Route::get('vactivarsp/{id}','Vista_Activar_SP')->name('vactivarsp');
    Route::get('vactivarco/{id}','Vista_Activar_CO')->name('vactivarco');
    Route::get('vactivar/{id}/{op}','Activar_Usu')->name('vactivar');
    // Modificar
    Route::get('vmodificarsp/{id}/{op}','Vista_Modificar_SP')->name('vmodificarsp');
    Route::post('modfun','Modificar_Usuarios')->name('modfun');
});


// Rutas ver más Cedulas
Route::controller(VistaCedula_Controller::class)->group(function(){
    Route::post('cedulainfo','Informacion')->name('cedulainfo');
});


// Rutas del Manual
Route::controller(Manual_Controller::class)->group(function(){
    Route::get('descargarmanual','Descargar')->name('descargarmanual');
    Route::get('vistaprevia','VistaPrevia')->name('vistaprevia');
});