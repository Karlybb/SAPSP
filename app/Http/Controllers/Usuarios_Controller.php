<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\c_persona;
use Redirect;
use DateTime;

Use App\Mail\CorreoElectronico;
Use Illuminate\Support\Facades\Mail;

class Usuarios_Controller extends Controller{

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Vista_Busqueda(){
        $id=session('sid');

		if($id!=null){

            $titulo = "CONSULTAR USUARIOS";
            $subtitulo = "Favor de capturar los datos correspondientes para realizar la búsqueda.";
            $seccion = 1;

            return view('plantillas/usuarios')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion);

        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Consultar_Usuarios(Request $request){
        $id=session('sid');
		if($id!=null){
            
            
            $titulo = "RESULTADOS DE LA BÚSQUEDA";
            $subtitulo = "Listado de usuarios encontrados.";
            $seccion = 2;

            $query = "";
            $resultado = array();
            $servidorp = false;
            $tipo = "";

            if( $request->nombre1 != null ){$query = $query." and p.nombre1     like '$request->nombre1%' ";}
            if( $request->nombre2 != null ){$query = $query." and p.nombre2     like '$request->nombre2%' ";}
            if( $request->appat   != null ){$query = $query." and p.apellidopat like '$request->appat%' ";}
            if( $request->apmat   != null ){$query = $query." and p.apellidomat like '$request->apmat%'";}

            // Búsqueda de Servidor público
            if( $request->tipbus == 1 ){

                $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.deleted_at,                        
                                            ua.id_personal, ua.cargo, ua.tipo, ua.profesion,
                                            adm.nombre as dependencia,
                                            cr.idcredencial,
                                            r.rol
                                            from c_persona p
                                            inner join c_personalua ua on ua.idpersona = p.idpersona
                                            inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                            full outer join c_credenciales cr on cr.id_persona = p.idpersona
                                            full outer join c_rol r on r.idrol = cr.id_rol
                                            where adm.cveua like '2%' and ua.estado = 'ACTIVO' ".$query."
                                            order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

                $servidorp = true;
                $tipo = "Servidor Público";
                
                
            // Búsqueda de NO Servidor Público
            }else if( $request->tipbus == 2 ){

                $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.deleted_at,                                                
                                            cr.idcredencial,
                                            r.rol
                                            from c_persona p
                                            full outer join c_credenciales cr on cr.id_persona = p.idpersona
                                            full outer join c_rol r on r.idrol = cr.id_rol
                                            where p.deleted_at is null and p.idpersona not in
                                                (select ua.idpersona
                                                 from c_personalua ua
                                                 inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                                 where ua.estado = 'ACTIVO' and adm.estado = 'ACTIVO' and adm.cveua like '2%')".$query."
                                            order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

                $tipo = "No Servidor Público";
            }
            
            
            return view('plantillas/usuarios')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('servidorp',$servidorp)
                ->with('datos',$resultado)
                ->with('tipo',$tipo)
                ->with('sp',$request->tipbus)
                ->with('n1',$request->nombre1)
                ->with('n2',$request->nombre2)
                ->with('ap',$request->appat)
                ->with('am',$request->apmat);
            
        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Vista_Crear_Rol($idu,$sp){

        $id=session('sid');

		if($id!=null){

            $titulo = "CREAR CREDENCIALES";
            $subtitulo = "Ingresa los datos correspondientes para crear un usuario.";
            $seccion = 3;

            $resultado = array();
            $personalua = 0;
            $ua = 0;

            // Consultar Servidor Público
            if( $sp == 1 ){

                $resultado=\DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                        ua.id_personal, ua.iduniadmin,
                                        cr.correo,
                                        rol.idrol, rol.rol
                                        from c_persona p
                                        inner join c_personalua ua on ua.idpersona = p.idpersona
                                        full outer join c_credenciales cr on cr.id_persona = p.idpersona
                                        full outer join c_rol rol on rol.idrol = cr.id_rol
                                        where ua.id_personal = $idu");

                $personalua = $idu;
                $ua = $resultado[0]->iduniadmin;

            // Consultar No Servidor Público
            }elseif( $sp == 0 ){

                $resultado=\DB::select("select cr.correo,    
                                        p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                        rol.idrol, rol.rol
                                        from c_credenciales cr
                                        full outer join c_persona p on p.idpersona = cr.id_persona
                                        full outer join c_rol rol on rol.idrol = cr.id_rol 
                                        where p.idpersona = $idu");
            }
            
            $resultado2=\DB::select("select * from c_rol");

            /*$unidadesadm = \DB::select("select *
                                        from c_un_adm
                                        where estado = 'ACTIVO' and cveua like '2%' and cveua_padre not like '0%'
                                        order by cverepua asc");*/

            $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $shfl = str_shuffle($comb);
            $pwd = substr($shfl,0,9);
            $DAdm=\DB::select("select * from R_CC_CREDENCIALES Where iduniadmin is NOT NULL");

            return view('plantillas/usuarios')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('datos',$resultado[0])
                ->with('personalua',$personalua)
                ->with('ua',$ua)
                ->with('datos2',$resultado2)
                ->with('pwd',$pwd)
                ->with('DAdm',$DAdm);


        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Ingresar_Credenciales(Request $request){
        
        $id=session('sid');
        

		if($id!=null){

            
            $resultado="";
            $pass = md5($request->pass);

            // Inserar Credenciales Servidor Público
            if( $request->personalua != 0 ){
                

                $resultado=\DB::insert("insert into c_credenciales
                                       values(sec_credenciales.nextval,'$request->email','$pass',".$request->personalua.",".$request->idpersona.",".$request->ua.",".$request->rol.",CURRENT_TIMESTAMP,null,null)");
               
               
    
               
            // Insertar Credenciales No Servidor Público
            }elseif( $request->personalua == 0 ){

                $resultado=\DB::insert("insert into c_credenciales
                                        values(sec_credenciales.nextval,'$request->email','$pass',null,".$request->idpersona.",null,".$request->rol.",CURRENT_TIMESTAMP,null,null)");
            }    

            if( $resultado == 1 ){
                if( $request->enviar == 2 ){
                    //echo "Si enviar";
                    $correo = new CorreoElectronico($request->all());
                    Mail::to($request->email)->send($correo);
                    //return "Mensaje enviado";
                    return Redirect::to('/usuariosactivos')
                        ->with('info','Correo Enviado.');
                }
                return Redirect::to('/usuariosactivos');
            }

        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Usuarios_Activos(){
        $id=session('sid');


		if($id!=null){

            $titulo = "USUARIOS ACTIVOS";
            $subtitulo = "Resultados de la búsqueda.";
            $seccion = 5;

            $admin=\DB::select("select cr.idcredencial, cr.correo,
                                p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.deleted_at,
                                rol.rol,
                                ua.cargo, ua.tipo, ua.profesion,
                                adm.nombre as dependencia
                                from c_credenciales cr
                                inner join c_persona p on p.idpersona = cr.id_persona
                                inner join c_rol rol on rol.idrol = cr.id_rol
                                full outer join c_personalua ua on ua.idpersona = p.idpersona
                                full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                where rol.rol = 'Administrador' and p.deleted_at is null and cr.deleted_at is null 
                                order by p.nombre1, p.nombre2, p.apellidopat asc");

            $admintotal = \DB::select("select count(cr.idcredencial) as total
                                        from c_credenciales cr
                                        inner join c_rol rol on rol.idrol = cr.id_rol
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        where rol.rol = 'Administrador' and cr.deleted_at is null and p.deleted_at is null");

            $usuario=\DB::select("select cr.idcredencial, cr.correo,
                                    p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.deleted_at,
                                    rol.rol,
                                    ua.cargo, ua.tipo, ua.profesion,
                                    adm.nombre as dependencia
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_rol rol on rol.idrol = cr.id_rol
                                    full outer join c_personalua ua on ua.idpersona = p.idpersona
                                    full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                    where rol.rol = 'Usuario' and p.deleted_at is null and cr.deleted_at is null 
                                    order by p.nombre1, p.nombre2, p.apellidopat asc");

            $usuariototal = \DB::select("select count(cr.idcredencial) as total
                                            from c_credenciales cr
                                            inner join c_rol rol on rol.idrol = cr.id_rol
                                            inner join c_persona p on p.idpersona = cr.id_persona
                                            where rol.rol = 'Usuario' and cr.deleted_at is null and p.deleted_at is null");

            $enlace=\DB::select("select cr.idcredencial, cr.correo,
                                    p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.deleted_at,
                                    rol.rol,
                                    ua.cargo, ua.tipo, ua.profesion,
                                    adm.nombre as dependencia
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_rol rol on rol.idrol = cr.id_rol
                                    full outer join c_personalua ua on ua.idpersona = p.idpersona
                                    full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                    where rol.rol = 'Enlace' and p.deleted_at is null and cr.deleted_at is null 
                                    order by p.nombre1, p.nombre2, p.apellidopat asc");
            
            $enlacetotal = \DB::select("select count(cr.idcredencial) as total
                                        from c_credenciales cr
                                        inner join c_rol rol on rol.idrol = cr.id_rol
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        where rol.rol = 'Enlace' and cr.deleted_at is null and p.deleted_at is null");

            $rdsp=\DB::select("select cr.idcredencial, cr.correo,
                                p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.deleted_at,
                                rol.rol,
                                ua.cargo, ua.tipo, ua.profesion,
                                adm.nombre as dependencia
                                from c_credenciales cr
                                inner join c_persona p on p.idpersona = cr.id_persona
                                inner join c_rol rol on rol.idrol = cr.id_rol
                                full outer join c_personalua ua on ua.idpersona = p.idpersona
                                full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                where rol.rol = 'RDSP' and p.deleted_at is null and cr.deleted_at is null 
                                order by p.nombre1, p.nombre2, p.apellidopat asc");

            $rdsptotal = \DB::select("select count(cr.idcredencial) as total
                                        from c_credenciales cr
                                        inner join c_rol rol on rol.idrol = cr.id_rol
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        where rol.rol = 'RDSP' and cr.deleted_at is null and p.deleted_at is null");

            return view('plantillas/usuarios')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('admin',$admin)
                ->with('admintotal',$admintotal[0])
                ->with('usuario',$usuario)
                ->with('usuariototal',$usuariototal[0])
                ->with('enlace',$enlace)
                ->with('enlacetotal',$enlacetotal[0])
                ->with('rdsp',$rdsp)
                ->with('rdsptotal',$rdsptotal[0])
                ->with('sesion',$id);
        }else{
            return Redirect::to('login');
        }
    }


    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Desactivar_Usuario($idu){
        
        $id=session('sid');

		if($id!=null){

            $resultado=\DB::select("select cr.idcredencial,
                                    p.nombre1, p.nombre2, p.apellidopat, p.apellidomat
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    where cr.idcredencial = '$idu'");
            
            $titulo = "DESACTIVAR USUARIO";
            $subtitulo = "El usuario: ".$resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat." será DESACTIVADO.";
            $seccion = 2;

            $idpersona = $resultado[0]->idcredencial;
            $link = "/SAPSP/desactivarusu/{$idpersona}";
            $regresar = "/SAPSP/usuariosactivos";
            $boton = "DESACTIVAR";

            return view('mensajes/alertas')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('link',$link)
                ->with('regresar',$regresar)
                ->with('boton',$boton);
        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Desactivar_Usu($idu){
        $id=session('sid');

		if($id!=null){

            $resultado=\DB::update("update c_credenciales
                                    set deleted_at = CURRENT_TIMESTAMP
                                    where idcredencial = '$idu'");

            return Redirect::to('/usuariosdesactivados');
            
        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Usuarios_Desactivados(){
        $id=session('sid');

		if($id!=null){

            $titulo = "USUARIOS DESACTIVADOS";
            $subtitulo = "Resultados de la búsqueda.";
            $seccion = 6;

            $admin=\DB::select("select cr.idcredencial, cr.correo, cr.deleted_at,
                                p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                rol.rol,
                                ua.cargo, ua.tipo, ua.profesion,
                                adm.nombre as dependencia
                                from c_credenciales cr
                                inner join c_persona p on p.idpersona = cr.id_persona
                                inner join c_rol rol on rol.idrol = cr.id_rol
                                full outer join c_personalua ua on ua.idpersona = p.idpersona
                                full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                where rol.rol = 'Administrador' and cr.deleted_at is not null 
                                order by p.nombre1, p.nombre2, p.apellidopat asc");

            $admintotal = \DB::select("select count(cr.idcredencial) as total
                                        from c_credenciales cr
                                        inner join c_rol rol on rol.idrol = cr.id_rol
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        where rol.rol = 'Administrador' and cr.deleted_at is not null");

                                        $usuario=\DB::select("select cr.idcredencial, cr.correo,
                                        p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.deleted_at,
                                        rol.rol,
                                        ua.cargo, ua.tipo, ua.profesion,
                                        adm.nombre as dependencia
                                        from c_credenciales cr
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        inner join c_rol rol on rol.idrol = cr.id_rol
                                        full outer join c_personalua ua on ua.idpersona = p.idpersona
                                        full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                        where rol.rol = 'Usuario' and p.deleted_at is null and cr.deleted_at is null 
                                        order by p.nombre1, p.nombre2, p.apellidopat asc");
    
            $usuariototal = \DB::select("select count(cr.idcredencial) as total
                                                from c_credenciales cr
                                                inner join c_rol rol on rol.idrol = cr.id_rol
                                                inner join c_persona p on p.idpersona = cr.id_persona
                                                where rol.rol = 'Usuario' and cr.deleted_at is null and p.deleted_at is null");
    
            $enlace=\DB::select("select cr.idcredencial, cr.correo, cr.deleted_at,
                                    p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                    rol.rol,
                                    ua.cargo, ua.tipo, ua.profesion,
                                    adm.nombre as dependencia
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_rol rol on rol.idrol = cr.id_rol
                                    full outer join c_personalua ua on ua.idpersona = p.idpersona
                                    full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                    where rol.rol = 'Enlace' and cr.deleted_at is not null 
                                    order by p.nombre1, p.nombre2, p.apellidopat asc");

            $enlacetotal = \DB::select("select count(cr.idcredencial) as total
                                        from c_credenciales cr
                                        inner join c_rol rol on rol.idrol = cr.id_rol
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        where rol.rol = 'Enlace' and cr.deleted_at is not null");

            $rdsp=\DB::select("select cr.idcredencial, cr.correo, cr.deleted_at,
                                p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                rol.rol,
                                ua.cargo, ua.tipo, ua.profesion,
                                adm.nombre as dependencia
                                from c_credenciales cr
                                inner join c_persona p on p.idpersona = cr.id_persona
                                inner join c_rol rol on rol.idrol = cr.id_rol
                                full outer join c_personalua ua on ua.idpersona = p.idpersona
                                full outer join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                where rol.rol = 'RDSP' and cr.deleted_at is not null 
                                order by p.nombre1, p.nombre2, p.apellidopat asc");

            $rdsptotal = \DB::select("select count(cr.idcredencial) as total
                                        from c_credenciales cr
                                        inner join c_rol rol on rol.idrol = cr.id_rol
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        where rol.rol = 'RDSP' and cr.deleted_at is not null");

            return view('plantillas/usuarios')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('admin',$admin)
                ->with('admintotal',$admintotal[0])
                ->with('usuario',$usuario)
                ->with('usuariototal',$usuariototal[0])
                ->with('enlace',$enlace)
                ->with('enlacetotal',$enlacetotal[0])
                ->with('rdsp',$rdsp)
                ->with('rdsptotal',$rdsptotal[0]);
        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Activar_Usuario($idu){

        $resultado=\DB::select("select cr.idcredencial,
                                p.nombre1, p.nombre2, p.apellidopat, p.apellidomat
                                from c_credenciales cr
                                inner join c_persona p on p.idpersona = cr.id_persona
                                where idcredencial = '$idu'");

        $titulo = "ACTIVAR USUARIO";
        $subtitulo = "El usuario: ".$resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat." será ACTIVADO.";
        $seccion = 1;

        $idpersona = $resultado[0]->idcredencial;
        $link = "/SAPSP/activarusu/{$idpersona}";
        $regresar = "/SAPSP/usuariosdesactivados";
        $boton = "ACTIVAR";

        return view('mensajes/alertas')
            ->with('titulo', $titulo)
            ->with('subtitulo', $subtitulo)
            ->with('seccion', $seccion)
            ->with('link',$link)
            ->with('regresar',$regresar)
            ->with('boton',$boton);
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Activar_Usu($idu){
        $id=session('sid');

		if($id!=null){
            
            $resultado=\DB::update("update c_credenciales
                                    set deleted_at = null
                                    where idcredencial = '$idu'");
            return Redirect::to('/usuariosactivos');
        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Vista_Modificar($idu){
        $id=session('sid');

		if($id!=null){

            $titulo = "MODIFICAR CREDENCIALES";
            $subtitulo = "Ingresa los datos correspondientes para modificar al usuario.";
            $seccion = 4;

            $resultado=\DB::select("select cr.idcredencial, cr.correo,    
                                    p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                    rol.idrol, rol.rol
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_rol rol on rol.idrol = cr.id_rol 
                                    where cr.idcredencial = $idu");
            
            $resultado2=\DB::select("select * from c_rol");

            $comb = "abcdefghijkmnopqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ123456789";
            $shfl = str_shuffle($comb);
            $pwd = substr($shfl,0,9);

            return view('plantillas/usuarios')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('datos',$resultado[0])
                ->with('datos2',$resultado2)
                ->with('pwd',$pwd);
        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Modificar_Credenciales(Request $request){
        $id=session('sid');

		if($id!=null){

            $pass = md5($request->pass);

            $resultado=\DB::update("update c_credenciales
                                    set
                                    correo= '$request->email',
                                    pass = '$pass',
                                    updated_at = CURRENT_TIMESTAMP
                                    where idcredencial = ".$request->idcredencial);
            
            if( $resultado == 1 ){

                if( $request->enviar == 2 ){
                    //echo "Si enviar";
                    $correo = new CorreoElectronico($request->all());
                    Mail::to($request->email)->send($correo);
                    //return "Mensaje enviado";
                    return Redirect::to('/usuariosactivos')
                        ->with('info','Correo Enviado.');
                }

                return Redirect::to('/usuariosactivos');
            }

        }else{
            return Redirect::to('login');
        }
    }
    
}
