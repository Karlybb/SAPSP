<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class Login_Controller extends Controller{
  

    public function Index(){
        $id=session('sid');

        if($id!=null){

            $query = array();
            $total = 0;
            $total2 = 0;

            // Cédulas por corregir
            $correccion = \DB::select("select count(*) as correccion
                                        from c_detalle_cedula det
                                        inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                        where det.id_usuario = $id and det.id_estadocedula = 3 and c.deleted_at is null");

            // Cédulas no vistas o vistas, pendientes
            if( session('srol') == 1 ){
                $query = \DB::select("select count(*) as num
                                      from c_detalle_cedula
                                      where id_usuario = $id and (id_estadocedula = 1 or id_estadocedula = 2)");

            }else if( session('srol') == 2 ){
                $query = \DB::select("select count(*) as num
                                      from c_detalle_cedula
                                      where id_enlace = $id and (id_estadocedula = 6 or id_estadocedula = 7)");

            }else if( session('srol') == 3 ){
                $query = \DB::select("select count(*) as num
                                      from c_detalle_cedula
                                      where id_rdsp = $id and (id_estadocedula = 10 or id_estadocedula = 11)");
            }

            date_default_timezone_set("America/Mexico_City");
            $hoy = date("d-M-Y H:i:s");
            $seccion = 1;
            
            $query2 = \DB::select("select
                                    idvacaciones,
                                    to_char(fecha1,'DD-MON-YYYY') as fecha1,
                                    to_char(fecha2,'DD-MON-YYYY') as fecha2,
                                    fecha2 as fechanormal
                                    from c_vacaciones
                                    where deleted_at is null");
            
            // Número de cédulas pendientes
            if( count($query) > 0 ){
                $total = $query[0]->num;
            }

            // Número de cédulas por corregir
            if( count($correccion) > 0){
                $total2 = $correccion[0]->correccion;
            }

            if( $query2 != null ){
                
                if( strtotime($hoy) > strtotime($query2[0]->fechanormal) ){
                    $query3 = \DB::update("update c_vacaciones
                                            set deleted_at = CURRENT_TIMESTAMP
                                            where idvacaciones = ".$query2[0]->idvacaciones);
                }else{
                    $seccion = 2;
                    return view('plantillas/home')
                                ->with('num',$total)
                                ->with('datos',$query2[0])
                                ->with('correccion',$total2)
                                ->with('seccion',$seccion);
                }
            }
            
            return view('plantillas/home')
                        ->with('num',$total)
                        ->with('correccion',$total2)
                        ->with('seccion',$seccion);

        }else{
            return Redirect::to('login');
        }
    }
    
    public function Login(Request $request){//

        

        $this->validate($request,[
            'email' => 'required|email',
            'pass'  => 'required'
        ]);

        $token = $request->session()->token();
        $token = csrf_token();

        $email=$request->email;
        $pass=$request->pass;

        $i = 0;
        $query2 = array();

       $query = \DB::select("select cr.idcredencial, cr.correo, cr.pass, cr.id_personal_ua, cr.id_persona, cr.id_unadm, cr.id_rol,
                                p.nombre1, p.idpersona,p.apellidopat
                                from c_credenciales cr
                                inner join c_persona p on p.idpersona = cr.id_persona
                                where cr.correo = '$email' and cr.deleted_at is null and p.deleted_at is null");

        if( $query != null ){

            while( $i < count($query) ){

                
                
                if( $query[$i]->correo == $email && $query[$i]->pass == md5($pass) ){

                    
                    
                    if( $query[$i]->id_personal_ua != null ){
                        $query2 = \DB::select("select adm.cveua
                                                    from c_personalua ua
                                                    inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                               where ua.id_personal = ".$query[$i]->id_personal_ua." ");

                        Session::put('sid_personalua',$query[$i]->id_personal_ua);

                    }else if( $query[$i]->id_unadm != null ){
                        $query2 = \DB::select("select cveua
                                                    from c_un_adm
                                               where iduniadmin = ".$query[$i]->id_unadm."");
                    }else{
                        Session::put('sid_personalua',0);
                    }

                    if( session('sid_personalua') != 0 ){
                        Session::put('scveua',substr($query2[0]->cveua,0,3));
                    }else{
                        Session::put('scveua',"2");
                    }

                    Session::put('sid',$query[$i]->idcredencial);
                    Session::put('sid_uniadmin',$query[$i]->id_unadm);
                    Session::put('sid_credencial',$query[$i]->idcredencial);
                    Session::put('sname',$query[$i]->nombre1);
                    Session::put('scorreo',$query[$i]->correo);
                    Session::put('srol',$query[$i]->id_rol);
                    Session::put('snametitulo',$query[$i]->nombre1." ".$query[$i]->apellidopat);
                    date_default_timezone_set('America/Mexico_City');
                    Session::put('shora',date("h:i:s",strtotime(date("h:i:s"))-3600));
                    
                    return Redirect::to('/');

                }else{
                    $i++;
                }
            }

            if( $i == count($query) ){
              
                
                
             //return view('login')->with("message","Contraseña o usuario invalido!");

             return back()->with("msj","Contraseña o usuario invalido!");

               
            }

        }else{ 
            //echo '<script type="text/javascript">alert(\'"No existe el usuario o se encuentra desactivado"\');</script>'; 
            
            return back()->with("msj","No existe el usuario o se encuentra desactivado.");
          // return view('login')->with("message","No existe el usuario o se encuentra desactivado.");
           
            
        }

        
        
    }

    public function Logout(){
        Session::forget('sid');
        Session::forget('sid_personalua');
        Session::forget('sid_uniadmin');
        Session::forget('sid_credencial');
		Session::forget('sname');
		Session::forget('semail');
		Session::forget('srol');
        Session::forget('shora');
        Session::forget('scveua');
		Session::flush();
		return Redirect::to('login');
    }

    public function Perfil(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "PERFIL";
            $subtitulo = "Datos del usuario.";
            $list="";

            $resultado=\DB::select("select cr.idcredencial, cr.correo,
                                    p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                    r.idrol, r.rol,
                                    pua.profesion, pua.cargo, pua.tipo,
                                    adm.infodiv, adm.nombre, adm.cveua
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_rol r on r.idrol = cr.id_rol
                                    full outer join c_personalua pua on pua.idpersona = p.idpersona
                                    full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                    where cr.idcredencial = $id");
            

            if( count($resultado) == 1 ){

                $list = explode("/",$resultado[0]->infodiv);
                array_push($list,"","","","","");
            
                return view('plantillas/perfil_usuario')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('datos',$resultado[0])
                        ->with('list',$list);
            }else{

                $titulo = "CONSULTAR PERFIL";
                $subtitulo = "Error en la consulta del perfil, no se encontraron registros.";
                $link = "/SAPSP";
                $boton = "IR A INICIO";
                $regresar = "/SAPSP";
                $seccion = 2;
                return view('mensajes/alertas')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('link',$link)
                        ->with('boton',$boton)
                        ->with('regresar',$regresar)
                        ->with('seccion',$seccion);
            }
            
        }else{
            return Redirect::to('login');
        }
    }

}
