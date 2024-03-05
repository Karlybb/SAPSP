<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;

class Cedulas_Controller extends Controller{

    public function Cedula(){

        $id=session('sid');
        $idcveua=session('sid_uniadmin');
        $rol=session('srol');

		if($id!=null){

            $titulo = "CONSULTAR PERSONA SERVIDORA PÚBLICA";
            $subtitulo = "Ingresa los datos correspondientes para realizar la búsqueda de la persona servidora pública.";
            $seccion = 1;

            $ua = array();

            $query = \DB::select("select * from R_infodiv where idcredencial = $id");

            // Buscar Servidor Público - Delegado
            if( $rol == 1 ){

                $cveua = \DB::select("select * from R_All_CUNADM where iduniadmin = $idcveua");

                $likecveua = substr($cveua[0]->cveua_padre,0,8);

                $ua = \DB::select("select * from R_All_CUNADM where cveua_padre like '$likecveua%' and estado = 'ACTIVO'
                                   order by cverepua");
            
            // Buscar Servidor Público - RDSP ó Admin
            }else{

                $ua = \DB::select("select * from R_All_CUNADM
                                   where cveua_padre like '2%' and estado = 'ACTIVO'
                                   order by cverepua");
            }

            return view('plantillas/cedulas')
                ->with("titulo",$titulo)
                ->with("subtitulo",$subtitulo)
                ->with("seccion",$seccion)
                ->with("datos",$query[0])
                ->with('ua',$ua);

        }else{
            return Redirect::to('login');
        }
    }

    public function Buscar_Funcionario(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();
                
        $id=session('sid');
        $idcveua=session('sid_uniadmin');
        $rol=session('srol');
		
        if($id!=null){

            $titulo = "RESULTADOS DE LA BÚSQUEDA";
            $subtitulo = "Relación de los funcionarios encontrados.";
            $seccion = 2;

            $ua = array();
            $query = "";
            
            // Buscar Servidor Público - Delegado ---> usuario habilitado
            if( $rol == 1 ){

                $cveua = \DB::select("select * from R_All_CUNADM where iduniadmin = $idcveua");

                $likecveua = substr($cveua[0]->cveua_padre,0,8);

                $ua = \DB::select("select * from R_All_CUNADM
                                    where cveua_padre like '$likecveua%' and estado = 'ACTIVO'
                                    order by cverepua");

                if( $request->ua != null ){
                    $query = $query." and adm.iduniadmin = $request->ua ";
                }else{
                    // Retornar solo los de su estructura
                   // $likecveua = substr($cveua[0]->cveua_padre,0,7);
                    //$query = $query." and adm.cveua_padre like '$likecveua%' "; ANTERIORES
                    $likecveua = substr($cveua[0]->cveua_padre,0,8);
                    $query = $query." and adm.cveua like '$likecveua%' ";
                }
            
            // Buscar Servidor Público - RDSP ó Admin
            }else{

                $ua = \DB::select("select * from R_All_CUNADM
                                    where cveua_padre like '2%' and estado = 'ACTIVO'
                                    order by cverepua");

                if( $request->ua != null ){ $query = $query." and adm.iduniadmin = $request->ua "; }
            }

            if( $request->nombre1     != null ){ $query = $query." and p.nombre1 like     '$request->nombre1%' ";}
            if( $request->nombre2     != null ){ $query = $query." and p.nombre2 like     '$request->nombre2%' ";}
            if( $request->apellidopat != null ){ $query = $query." and p.apellidopat like '$request->apellidopat%' ";}
            if( $request->apellidomat != null ){ $query = $query." and p.apellidomat like '$request->apellidomat%' ";}

            $infodiv = \DB::select("select * from R_CC_infodiv2 where idcredencial = $id");
                                    
            $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                        ua.cargo, ua.tipo, ua.profesion,
                                        adm.nombre as dependencia, adm.cveua
                                        from c_persona p
                                        inner join c_personalua ua on ua.idpersona = p.idpersona
                                        inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                        where (ua.estado = 'ACTIVO' ".$query.")
                                        order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

             echo ("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
             ua.cargo, ua.tipo, ua.profesion,
             adm.nombre as dependencia, adm.cveua
             from c_persona p
             inner join c_personalua ua on ua.idpersona = p.idpersona
             inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
             where (ua.estado = 'ACTIVO' ".$query.")
             order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");                        
            
            if( $infodiv != null ){
                return view('plantillas/cedulas')
                        ->with('titulo', $titulo)
                        ->with('subtitulo', $subtitulo)
                        ->with('seccion', $seccion)
                        ->with('ua',$ua)
                        ->with('datos',$resultado)
                        ->with('datos2',$infodiv[0])
                        ->with('infod',1)
                        ->with('unad',$request->ua)
                        ->with('n1',$request->nombre1)
                        ->with('n2',$request->nombre2)
                        ->with('ap1',$request->apellidopat)
                        ->with('ap2',$request->apellidomat);
            }else{
                return view('plantillas/cedulas')
                    ->with('titulo', $titulo)
                    ->with('subtitulo', $subtitulo)
                    ->with('seccion', $seccion)
                    ->with('ua',$ua)
                    ->with('datos',$resultado)
                    ->with('infod',2)
                    ->with('unad',$request->ua)
                    ->with('n1',$request->nombre1)
                    ->with('n2',$request->nombre2)
                    ->with('ap1',$request->apellidopat)
                    ->with('ap2',$request->apellidomat);
            }
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Cargar_Datos(Request $request){

        $token = $request->session()->token();
        
        $token = csrf_token();
        
        $id=session('sid');
        $iduad=session('sid_uniadmin');
        
		
        if($id!=null){
            $titulo = "CREAR CÉDULA";
            $subtitulo = "Ingresa los datos correspondientes al funcionario.";
            $seccion = 3;

            $resultado = \DB::select("select * from R_CC_Funcionario where idpersona = '$request->_id'");

            $resultado2 = \DB::select("select * from c_municipios order by nombre_municipio asc");

            $resultado3 = \DB::select("select * from R_CC_Credenciales where iduniadmin = '$iduad'");

           // $resultado3 = \DB::select("select * from R_CC_Credenciales");

            //iduniadmin

            $list = explode("/",$resultado[0]->infodiv);
            array_push($list,"","","","","");
            

            
            
            return view('plantillas/cedulas')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('datos',$resultado[0])
                ->with('datos2',$resultado2)
                ->with('datos3',$resultado3)
                ->with('list',$list);
        }else{
            return Redirect::to('login');
        }
    }

    public function Folio($numero,$motivo){
        $folio = "";

        $motivo = substr($motivo,0,1);

        if( $numero <= 0 ){
            $folio = "C".$motivo."-1";
        }elseif( $numero <= 9 ){
            $folio = "C".$motivo."000000000".$numero;
        }else if( $numero <= 99 ){
            $folio = "C".$motivo."00000000".$numero;
        }else if( $numero <= 999 ){
            $folio = "C".$motivo."0000000".$numero;
        }else if( $numero <= 9999 ){
            $folio = "C".$motivo."000000".$numero;
        }else if( $numero <= 99999 ){
            $folio = "C".$motivo."00000".$numero;
        }else if( $numero <= 999999 ){
            $folio = "C".$motivo."0000".$numero;
        }else if( $numero <= 9999999 ){
            $folio = "C".$motivo."000".$numero;
        }else if( $numero <= 99999999 ){
            $folio = "C".$motivo."00".$numero;
        }else if( $numero <= 999999999 ){
            $folio = "C".$motivo."0".$numero;
        }else if( $numero <= 9999999999 ){
            $folio = "C".$motivo.$numero;
        }else if( $numero > 9999999999 ){
            $folio = "C".$motivo."-1";
        }
        
        return $folio;
    }

    public function PA(){
        $id = 14;
        $estado = "Prueba 1";
        $descr = "Aqui esta la descripcion";

        $consulta = DB::insert("call Insertar_Estados(?,?,?)",[$id,'asdasd','asdasd']);
        /*$res = DB::select("begin Insertar_Estados(:id,:estado,:descripcion,:res); end;",[
            'id' => $id,
            'estado' => $estado,
            'descripcion' => $descr,
            'res' => &$res,
        ]);*/

        echo "->",$consulta;
    }

    public function Borrar($id){
        $res = DB::delete("call Eliminar_Estados_byId($id)");
        echo "borrado: ",$res;
    }

    public function Actualizar($id){
        $est = "Datos";
        $desc = "aqui la descrip";
        $res = DB::update("call Modificar_Estados(?,?,?)",[$id,$est,$desc]);
        echo "update: ",$res;
    }

    public function Insertar_Funcionario(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            $query = "";
            $update=" ";

            // Inserción - Delegado
            if( session('srol') == 1 ){
                $query = "$request->enlace, null";

            // Insercion Cédula por Instrucción - RDSP ó Admin
            }else{
                $query = "null,null";
            }

            if( $request->cp == null ){ $request->cp = 0; }

            // Asignación de Folio
            $max = \DB::select("select max(id_cedulafun) as id from c_cedulasfun");
            $folio = $this->Folio( ( $max[0]->id + 1 ),$request->radio);

            $resultado = \DB::insert("insert into c_cedulasfun
                                      values(sec_cedulasfun.nextval,'$folio',$request->idpersona,$request->idpua,$request->iduadm,'$request->radio',
                                      '$request->nombre1','$request->nombre2','$request->appat','$request->apmat',
                                      '$request->profesion','$request->cargo2','$request->sitcargo','$request->sexo2','$request->nivelnominal','$request->rango2','$request->claveua',
                                      '$request->calle','$request->refcall1','$request->refcall2','$request->numext','$request->numint','$request->colonia','$request->ciudad',$request->muni,'$request->barrio','$request->piso','$request->puerta',$request->cp,'$request->refadicional',
                                      '$request->correo1','$request->correo2','$request->lada','$request->tel1','$request->tel2','$request->tel3','$request->tel4','$request->ext1','$request->ext2','$request->fax1','$request->fax2','$request->facebook','$request->twitter','$request->web','$request->refead',
                                       $id,".$query.",CURRENT_TIMESTAMP,null,null)");

            // Direccionar al Delegado
            if( $resultado == 1 && session('srol') == 1 ){
                return Redirect::to('pendientes');

            // Direccionar al RDSP ó Admin
            }else if( $resultado == 1 && session('srol') != 1 ){

                $iddet = \DB::select("select max(id_det) as id from c_detalle_cedula where id_usuario = $id");
                $detalle = $iddet[0]->id;

                if( $detalle != null ){
                    $query2 = \DB::update("update c_detalle_cedula
                                                set id_estadocedula = 10
                                           where id_det = $detalle and id_usuario = $id");

                    if( $query2 == 1 ){
                        return Redirect::to('cedulaspendientes');
                    }

                }
            
            }

            return Redirect::to('home');

        }else{
            return Redirect::to('login');
        }
    }

    public function Pendientes(){
        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select * from R_CC_CedulasPendientes where id_usuario = '$id'");

            return view('plantillas/pendientes')
                    ->with('datos',$resultado);
        }else{
            return Redirect::to('login');
        }
    }

    public function Validar_Datos(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){
            
            $resultado=\DB::select("select * from R_CC_DetalleCedula where id_det = '$request->_id'");
            
            $titulo = "La cédula con folio ".$resultado[0]->folio." se enviará al enlace:";
            $subtitulo = $resultado[0]->nombre1d." ".$resultado[0]->nombre2d." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat." con el usuario: ".$resultado[0]->correo;
            $seccion = 1;
            $regresar = "/Redic/pendientes";

            return view('mensajes/alertas_delegado')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('idreq',$request->_id);
        }else{
            return Redirect::to('login');
        }
    }

    public function Enviar_Cedula(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');

        if($id!=null){
            $res = \DB::update("update c_detalle_cedula
                                    set id_estadocedula = 6, fecha_enviousuario = CURRENT_TIMESTAMP
                                    where id_det = $request->idreq");

            if( $res == 1 ){
                return Redirect::to('cedulasenviadas');
            }
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Cedulas_Enviadas(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "CÉDULAS ENVIADAS";
            $subtitulo = "Relación de las cédulas enviadas al enlace.";
            $seccion = 4;

            $resultado = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.fecha_enviousuario, det.id_det as id_detalle, det.id_usuario, det.id_estadocedula,
                                      cr.correo,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      e.estado, e.descripcion
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where (det.id_usuario = '$id' and det.id_estadocedula >= 5 and c.deleted_at is null)
                                      order by det.fecha_enviousuario desc");

            return view('plantillas/cedulas')
                        ->with('datos',$resultado)
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion);
        
        }else{
            return Redirect::to('login');
        }
    }

    public function Eliminar_Cedula(Request $request){
        
        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){
            
            $resultado=\DB::select("select det.id_det,
                                    c.folio, c.id_cedulafun,c.nombre1, c.nombre2, c.appat, c.apmat,
                                    p.nombre1 as nombre1d, p.nombre2 as nombre2d, p.apellidopat, p.apellidomat,
                                    ua.cargo,
                                    adm.nombre as oficina
                                    from c_detalle_cedula det
                                    inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                    inner join c_credenciales cr on cr.idcredencial = det.id_usuario
                                    inner join c_persona p on p.idpersona = det.id_enlace
                                    inner join c_personalua ua on ua.idpersona = p.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                    where det.id_det = $request->_id");

            $titulo = "ELIMINAR CÉDULA";
            $subtitulo = "La cédula #".$resultado[0]->folio." será eliminada y ya no podrás accesar a ella en un futuro.";
            $seccion = 2;

            return view('mensajes/alertas_delegado')
                ->with('titulo', $titulo)
                ->with('subtitulo', $subtitulo)
                ->with('seccion', $seccion)
                ->with('idreq',$request->_id);
        }else{
            return Redirect::to('login');
        }
    }

    public function Desactivar_Cedula(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');

		if($id!=null){

            $cast = 0;

            $resultado = \DB::update("update c_detalle_cedula
                                       set id_estadocedula = 4
                                       where id_det = $request->idreq");
            
            if( $resultado == 1){
                $resultado2 = \DB::select("select * from c_detalle_cedula where id_det = $request->idreq");
                $cast2 = $resultado2[0]->id_cedula;
                $cast = $cast + $cast2;

                $resultado3 = \DB::update("update c_cedulasfun
                                           set deleted_at = CURRENT_TIMESTAMP
                                           where id_cedulafun = '$cast'");
                return Redirect::to('pendientes');
            }

        }else{
            return Redirect::to('login');
        }
    }

    public function Modificar_Datos(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){
            
            $titulo = "MODIFICAR CÉDULA";
            $subtitulo = "Modificar datos de una cédula.";
            $seccion = 5;

            // Datos Nuevos de la cédula
            $resultado = \DB::select("select det.id_det, det.id_usuario, det.id_cedula, det.id_estadocedula, det.id_enlace, det.id_rdsp, det.fecha_enviousuario, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                    c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones as observacionescedula, c.deleted_at,
                                    adm.infodiv, adm.nombre,
                                    mun.id_municipio, mun.nombre_municipio
                                    from c_detalle_cedula det
                                    inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                    inner join c_persona p on p.idpersona = c.idpersona
                                    inner join c_personalua ua on ua.idpersona = c.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                    inner join c_municipios mun on mun.id_municipio = c.municipio
                                    where det.id_det = '$request->_id' and c.deleted_at is null");

            $correccion = \DB::select("select *
                                        from c_detalle_correccion
                                        where id_detalle = ".$resultado[0]->id_det);

            // Municipios
            $resultado2 = \DB::select("select * from c_municipios order by nombre_municipio asc");

            // Datos de los Enlaces
            $resultado3 = \DB::select("select cr.idcredencial, cr.correo,
                                    p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                    r.idrol, r.rol,
                                    pua.cargo,
                                    adm.nombre as unidad, adm.infodiv
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_rol r on r.idrol = cr.id_rol
                                    inner join c_personalua pua on pua.idpersona = p.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                    where (r.rol = 'Enlace' and cr.deleted_at is null and p.deleted_at is null and pua.estado = 'ACTIVO')");

            // Datos del Enlace Actual
            $resultado4 = \DB::select("select cr.idcredencial, cr.correo,
                                    p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                    r.idrol, r.rol,
                                    pua.cargo,
                                    adm.nombre as unidad, adm.infodiv
                                    from c_credenciales cr
                                    inner join c_detalle_cedula det on det.id_enlace = cr.idcredencial
                                    inner join c_persona p on p.idpersona = det.id_enlace
                                    inner join c_rol r on r.idrol = cr.id_rol
                                    inner join c_personalua pua on pua.idpersona = p.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                    where det.id_det = $request->_id");
            
            $idper = 0;
            $idper = $resultado[0]->idpersona;

            // Datos del Funcionario Anterior
            $resultado5 = \DB::select("select cp.idpersona as idpersona, cp.nombre1, cp.nombre2, cp.apellidopat, cp.apellidomat, cp.genero,
                                    ua.id_personal as idua, ua.cargo, ua.tipo as situacion, ua.profesion, ua.nivelnominal, ua.rango,
                                    adm.iduniadmin as idadm, adm.cveua, adm.infodiv, adm.nombre,
                                    mue.descripcion,
                                    dir.iddireccion, dir.calleprincipal, dir.entrecalle1, dir.entrecalle2, dir.numext, dir.numint, dir.colonia, dir.ciudad, dir.idmunicipio, dir.puerta, dir.piso, dir.barrio, dir.ref_ad, dir.codigopostal,
                                    reg.tipo,
                                    con.idcontacto, con.lada, con. tel1, con.tel2, con.tel3, con.tel4, con.fax1, con.fax2, con.ext1, con.ext2, con.correo1, con.correo2, con.facepage, con.twit, con.red, con.ref_ad as refead,
                                    mun.id_municipio, mun.nombre_municipio
                                    from c_persona cp
                                    inner join c_personalua ua on ua.idpersona = cp.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                    inner join c_inmueble mue on mue.iduniadmin = adm.iduniadmin
                                    inner join c_direccion dir on dir.iddireccion = mue.iddireccion
                                    inner join c_regcontacto reg on reg.iduniadmin = adm.iduniadmin
                                    inner join c_contacto con on con.idcontacto = reg.idcontacto
                                    inner join c_municipios mun on mun.id_municipio = dir.idmunicipio
                                    where cp.idpersona = '$idper'
                                    order by cp.nombre1, cp.nombre2, cp.apellidopat, cp.apellidomat desc");

            $list = explode("/",$resultado5[0]->infodiv);
            array_push($list,"","","","","");

            return view('plantillas/cedulas')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion)
                        ->with('datos',$resultado[0])
                        ->with('correcciones',count($correccion))
                        ->with('datos2',$resultado2)
                        ->with('datos3',$resultado3)
                        ->with('datos4',$resultado4[0])
                        ->with('datos5',$resultado5[0])
                        ->with('list',$list);
        }else{
            return Redirect::to('login');
        }
    }

    public function Actualizar_Funcionario(Request $request){
        $id=session('sid');
		
        if($id!=null){

            $correccion = \DB::select("select *
                                        from c_detalle_correccion
                                        where id_detalle = ".$request->iddet);

            // Modificacion de Correcciones, en estado 4
            if( count($correccion) > 0 ){
                
                if( $request->cp == null ){ $request->cp = 0;}
                
                    $resultado = \DB::update("update c_cedulasfun
                                                set
                                                    tipo_cambio = '$request->radio',
                                                    nombre1 = '$request->nombre1', nombre2 = '$request->nombre2', appat = '$request->appat', apmat = '$request->apmat',
                                                    profesion= '$request->profesion', cargo = '$request->cargo2', sit_cargo = '$request->sitcargo', sexo = '$request->sexo2', nivel_nom = '$request->nivelnominal', rango = '$request->rango2', clave_ua = '$request->claveua',
                                                    calle = '$request->calle', referencia1 = '$request->refcall1', referencia2 = '$request->refcall2', numext = '$request->numext', numint = '$request->numint', colonia = '$request->colonia', ciudad = '$request->ciudad', municipio = $request->muni, barrio = '$request->barrio', piso = '$request->piso', puerta = '$request->puerta',cp = $request->cp, ref_dom = '$request->refadicional',
                                                    correo1 = '$request->correo1', correo2 = '$request->correo2', lada = '$request->lada', tel1 = '$request->tel1', tel2 = '$request->tel2', tel3 = '$request->tel3', tel4 = '$request->tel4', ext1 = '$request->ext1', ext2 = '$request->ext2', fax1 = '$request->fax1', fax2 = '$request->fax2', facebook = '$request->facebook', twitter = '$request->twitter', web = '$request->web', ref_con = '$request->refead',
                                                    updated_at = CURRENT_TIMESTAMP
                                              where id_cedulafun = $request->idcedula");

                if( $resultado == 1 ){

                    $resultado2 = \DB::update("update c_detalle_cedula
                                                    set
                                                        id_estadocedula = 6
                                               where id_cedula = $request->idcedula");
                    
                    if( $resultado2 == 1 ){

                        $resultado3 = \DB::update("update c_detalle_correccion
                                                      set
                                                          fecha_validacion = CURRENT_TIMESTAMP
                                                   where id_detalle = $request->iddet and fecha_validacion is null");
                                         
                        if( $resultado3 >= 1 ){
                            return Redirect::to('cedulasenviadas');
                        }
                        
                    }
                }

            // Modificación Normal
            }else{
                
                if( $request->cp == null ){ $request->cp = 0;}
            
                    $resultado = \DB::update("update c_cedulasfun
                                                set
                                                    tipo_cambio = '$request->radio',
                                                    nombre1 = '$request->nombre1', nombre2 = '$request->nombre2', appat = '$request->appat', apmat = '$request->apmat',
                                                    profesion= '$request->profesion', cargo = '$request->cargo2', sit_cargo = '$request->sitcargo', sexo = '$request->sexo2', nivel_nom = '$request->nivelnominal', rango = '$request->rango2', clave_ua = '$request->claveua',
                                                    calle = '$request->calle', referencia1 = '$request->refcall1', referencia2 = '$request->refcall2', numext = '$request->numext', numint = '$request->numint', colonia = '$request->colonia', ciudad = '$request->ciudad', municipio = $request->muni, barrio = '$request->barrio', piso = '$request->piso', puerta = '$request->puerta',cp = $request->cp, ref_dom = '$request->refadicional',
                                                    correo1 = '$request->correo1', correo2 = '$request->correo2', lada = '$request->lada', tel1 = '$request->tel1', tel2 = '$request->tel2', tel3 = '$request->tel3', tel4 = '$request->tel4', ext1 = '$request->ext1', ext2 = '$request->ext2', fax1 = '$request->fax1', fax2 = '$request->fax2', facebook = '$request->facebook', twitter = '$request->twitter', web = '$request->web', ref_con = '$request->refead',
                                                    idenlace = '$request->enlace',updated_at = CURRENT_TIMESTAMP
                                               where id_cedulafun = '$request->idcedula'");

                if( $resultado == 1 ){
                    $resultado2 = \DB::update("update c_detalle_cedula
                                                  set
                                                      id_enlace = '$request->enlace'
                                               where id_cedula = '$request->idcedula'");
                    if( $resultado2 == 1 ){
                        return Redirect::to('pendientes');
                    }
                }
            }

        }else{
            return Redirect::to('login');
        }
    }

    public function Correccion(){
        $id=session('sid');

		if($id!=null){

            $seccion = 1;
            $correccion = array();
            
            $resultado = \DB::select("select c.id_cedulafun, c.folio, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.created_at,
                                      det.id_det as id_detalle, det.id_usuario, det.id_estadocedula,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      mun.nombre_municipio,
                                      cr.correo
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = c.idenlace
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      inner join c_municipios mun on mun.id_municipio = c.municipio
                                      where (det.id_usuario = '$id' and det.id_estadocedula = 3 and c.deleted_at is null)
                                      order by c.created_at desc");

            for( $i = 0; $i < count($resultado); $i++ ){

                $correccion[$i] = \DB::select("select correccion, id_detalle as detcor
                                                from c_detalle_correccion
                                                where id_detalle = ".$resultado[$i]->id_detalle);

            }
            //echo('<pre>');
            //var_dump($correccion);
            //echo('</pre>');

            return view('plantillas/correccion')
                ->with('seccion',$seccion)
                ->with('datos',$resultado)
                ->with('array',$correccion)
                ->with('titulo',"hola")
                ->with('subtitulo',"sub");

        }else{
            return Redirect::to('login');
        }
    }

    public function Buscar(){
        $id=session('sid');
		
        if($id!=null){
            
            $titulo = "BUSCAR CÉDULAS";
            $subtitulo = "Selecciona algún criterio de búsqueda.";
            $seccion = 1;

            // Enlaces a los que se le ha enviado cédulas
            $enlaces = \DB::select("select distinct det.id_enlace,
                                    cr.idcredencial, cr.correo,
                                    p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                    pua.cargo,
                                    adm.nombre as unidad, adm.infodiv
                                    from c_detalle_cedula det
                                    inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_personalua pua on pua.idpersona = p.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                    where det.id_usuario = $id
                                    order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

            // Estados de la cédula 
            $estados = \DB::select("select distinct det.id_estadocedula, e.id_estado, e.estado, e.descripcion
                                    from c_detalle_cedula det
                                    inner join c_estados e on e.id_estado = det.id_estadocedula
                                    where det.id_usuario = $id
                                    order by id_estadocedula");

            return view('plantillas/buscar_cedulas')
                ->with('titulo',$titulo)
                ->with('subtitulo',$subtitulo)
                ->with('seccion',$seccion)
                ->with('datos',$enlaces)
                ->with('datos2',$estados);
        }else{
            return Redirect::to('login');
        }
    }

    public function Buscar_Cedulas(Request $request){
        $id=session('sid');
		
        if($id!=null){

            $query = "";

            if( $request->enlace != 0 ){ $query = " and det.id_enlace=$request->enlace "; }
            
            if( $request->estatus != 0 ){
                $query = $query." and det.id_estadocedula=$request->estatus ";
            }else{
                $query = $query." and det.id_estadocedula >= 1 ";
            }
            
            if( $request->fecha1 != null && $request->fecha2 != null ){
                $query = $query." and fecha_enviousuario between '$request->fecha1' and '$request->fecha2' ";
            }

            //echo $query;
            //echo "<br>";
            //echo $id;
            $titulo = "CÉDULAS ENVIADAS";
            $subtitulo = "Relación de la búsqueda de las cédulas enviadas al enlace.";
            $seccion = 2;

            // Datos de las cédulas
            $cedula = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.id_det as id_detalle, det.fecha_enviousuario, det.id_usuario, det.id_estadocedula, det.id_enlace,
                                      cr.correo,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      e.estado, e.descripcion
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where (det.id_usuario = '$id' and c.deleted_at is null) ".
                                      $query."
                                      order by det.fecha_enviousuario desc");

            /*$res = \DB::select("select cr.idcredencial, cr.correo,
                                p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                r.idrol, r.rol,
                                pua.cargo,
                                adm.nombre as unidad, adm.infodiv
                                from c_credenciales cr
                                inner join c_persona p on p.idpersona = cr.id_persona
                                inner join c_rol r on r.idrol = cr.id_rol
                                inner join c_personalua pua on pua.idpersona = p.idpersona
                                inner join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                where (cr.deleted_at is null and r.rol = 'Enlace' and p.deleted_at is null)
                                order by p.nombre1 asc");*/

            // Enlaces a los que se le ha enviado cédulas
            $res = \DB::select("select distinct det.id_enlace,
                                    cr.idcredencial, cr.correo,
                                    p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                    pua.cargo,
                                    adm.nombre as unidad, adm.infodiv
                                    from c_detalle_cedula det
                                    inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    inner join c_personalua pua on pua.idpersona = p.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                    where det.id_usuario = $id
                                    order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

            // Estados de la cédula 
            $estados = \DB::select("select distinct det.id_estadocedula, e.id_estado, e.estado, e.descripcion
                                    from c_detalle_cedula det
                                    inner join c_estados e on e.id_estado = det.id_estadocedula
                                    where det.id_usuario = $id
                                    order by id_estadocedula");
            
            return view('plantillas/buscar_cedulas')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$cedula)
                    ->with('datos2',$res)
                    ->with('datos3',$estados);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function X(){
        $id=session('sid');
		if($id!=null){
            
        }else{
            return Redirect::to('login');
        }
    }
}
