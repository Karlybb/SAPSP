<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Redirect;

class Enlace_Controller extends Controller{

    public function Bandeja_Entrada(){
        $id=session('sid');
		
        if($id!=null){
            $titulo = "BANDEJA DE ENTRADA";
            $subtitulo = "Relación de cédulas pendientes por validar.";
            $seccion = 1;

            $correccion = array();

            $resultado = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.fecha_enviousuario, det.id_det as id_detalle, det.id_estadocedula,
                                      p.nombre1 as nom1, p.nombre2 as nom2, p.apellidopat, p.apellidomat,
                                      cr.correo
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_usuario
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      where (det.id_enlace = '$id' and (det.id_estadocedula = 6 or det.id_estadocedula = 7) and c.deleted_at is null)
                                      order by det.fecha_enviousuario desc");

            for( $i = 0; $i < count($resultado); $i++ ){

                $correccion[$i] = \DB::select("select correccion, id_detalle as detcor
                                                from c_detalle_correccion
                                                where id_detalle = ".$resultado[$i]->id_detalle);

            }

            return view('plantillas/enlace')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado)
                    ->with('correccion',$correccion);
        }else{
            return Redirect::to('login');
        }
    }

    public function Ver_Cedula(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            $titulo = "DATOS DE LA CÉDULA";
            $subtitulo = "Verifica que los datos sean correctos para poder validar la cédula.";
            $seccion = 2;

            $resultado = \DB::select("select * from c_detalle_cedula where id_det = $request->_id");
            
            if( $resultado[0]->id_estadocedula == 6 ){
                $res = \DB::update("update c_detalle_cedula
                                    set id_estadocedula = 7
                                    where id_det = $request->_id");
            }

            // Datos de la cédula
            $cedula = \DB::select("select det.id_det, det.id_usuario, det.id_cedula, det.id_estadocedula, det.id_enlace, det.id_rdsp, det.fecha_enviousuario, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones as observacionescedula, c.deleted_at,
                                adm.infodiv, adm.nombre
                                from c_detalle_cedula det
                                inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                inner join c_persona p on p.idpersona = c.idpersona
                                inner join c_personalua ua on ua.idpersona = c.idpersona
                                inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                where det.id_det = $request->_id and c.deleted_at is null");
            
            $list = explode("/",$cedula[0]->infodiv);
            array_push($list,"","","","","");

            // Datos del Funcionario Anterior
            $funcionarioant = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                        ua.profesion, ua.cargo, ua.tipo, ua.nivelnominal, ua.rango,
                                        adm.cveua,
                                        dir.calleprincipal, dir.entrecalle1, dir.entrecalle2, dir.numext, dir.numint, dir.colonia, dir.ciudad, dir.puerta, dir.piso, dir.barrio, dir.ref_ad, dir.codigopostal,
                                        mun.nombre_municipio,
                                        con.lada, con.tel1, con.tel2, con.tel3, con.tel4, con.fax1, con.fax2, con.ext1, con.ext2, con.correo1, con.correo2, con.facepage, con.twit, con.red, con.ref_ad as red
                                        from c_detalle_cedula det
                                        inner join c_cedulasfun ced on ced.id_cedulafun = det.id_cedula
                                        inner join c_persona p on p.idpersona = ced.idpersona
                                        inner join c_personalua ua on ua.idpersona = p.idpersona
                                        inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                        inner join c_inmueble mue on mue.iduniadmin = adm.iduniadmin
                                        inner join c_direccion dir on dir.iddireccion = mue.iddireccion
                                        inner join c_municipios mun on mun.id_municipio = dir.idmunicipio
                                        inner join c_regcontacto reg on reg.iduniadmin = adm.iduniadmin
                                        inner join c_contacto con on con.idcontacto = reg.idcontacto
                                        where det.id_det =".$request->_id);

            return view('plantillas/enlace')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$cedula[0])
                    ->with('datos2',$funcionarioant[0])
                    ->with('list',$list);
        }else{
            return Redirect::to('login');
        }
    }

    public function Validar_Cedula(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select det.id_det, det.id_usuario, det.id_cedula, det.id_estadocedula, det.id_enlace, det.id_rdsp, det.fecha_enviousuario, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat
                                from c_detalle_cedula det
                                inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                inner join c_persona p on p.idpersona = c.idpersona
                                inner join c_personalua ua on ua.idpersona = c.idpersona
                                where det.id_det = $request->_id and c.deleted_at is null");

            $resultado2 = \DB::select("select cr.idcredencial, cr.correo,
                                        p.nombre1, p.nombre2, p.apellidopat, p.apellidomat
                                        from c_credenciales cr
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        where cr.id_rol = 3 and cr.deleted_at is null and p.deleted_at is null");

            $titulo = "Los datos de la cédula:";
            $subtitulo = "Folio".$resultado[0]->folio." de la persona: ".$resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->appat." ".$resultado[0]->apmat.", serán validados y enviados al RDSP.";
            $seccion = 1;

            return view('mensajes/alertas_enlace')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado[0])
                    ->with('datos2',$resultado2);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Enviar_Cedula_RDSP(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();
        
        $id=session('sid');

        if($id!=null){

            $resultado = \DB::update("update c_detalle_cedula
                                      set id_rdsp = '$request->rdsp', id_estadocedula = 10, fecha_validacionenlace = CURRENT_TIMESTAMP
                                      where id_det = '$request->iddet'");

            if( $resultado == 1 ){
                return Redirect::to('cedulasenviadasenlace');
            }
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Cedulas_Enviadas(){
        $id=session('sid');

        
		
        if($id!=null){

            $resultado = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.fecha_validacionenlace, det.id_det as id_detalle, det.id_usuario, det.id_estadocedula,
                                      cr.correo,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      e.estado, e.descripcion
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_rdsp
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where (det.id_enlace = '$id' and det.id_estadocedula >= 9 and c.deleted_at is null)
                                      order by det.fecha_validacionenlace desc");

            
            $titulo = "CÉDULAS ENVIADAS";
            $subtitulo = "Relación de las cédulas enviadas el RDSP.";
            $seccion = 3;
             

            return view('plantillas/enlace')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado);
        }else{
            return Redirect::to('login');
        }
    }

    public function Invalidar_Cedula(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');

        if($id!=null){

            $resultado = \DB::select("select det.id_det, det.id_usuario, det.id_cedula, det.id_estadocedula, det.id_enlace, det.id_rdsp, det.fecha_enviousuario, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                      c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat
                                      from c_detalle_cedula det
                                      inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                      inner join c_persona p on p.idpersona = c.idpersona
                                      inner join c_personalua ua on ua.idpersona = c.idpersona
                                      where det.id_det = $request->_id and c.deleted_at is null");

            $titulo = "La cédula:";
            $subtitulo = "Folio: ".$resultado[0]->folio." de la persona: ".$resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->appat." ".$resultado[0]->apmat.", serán RECHAZADOS y NO se enviarán al RDSP.";
            $seccion = 3;

            return view('mensajes/alertas_enlace')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado[0]);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Rechazar_Cedula(Request $request){
        
        $token = $request->session()->token();
        $token = csrf_token();
        
        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::update("update c_cedulasfun
                                      set observaciones = '$request->texto'
                                      where id_cedulafun = '$request->idced'");

            if( $resultado == 1 ){
                $resultado2 = \DB::update("update c_detalle_cedula
                                           set id_estadocedula = 8, fecha_validacionenlace = CURRENT_TIMESTAMP
                                           where id_det = '$request->iddet'");

                if( $resultado2 == 1 ){
                    return Redirect::to('rechazadasenlace');
                }
            } 
        }else{
            return Redirect::to('login');
        }
    }

    public function Vista_Rechazadas(){
        $id=session('sid');
		
        if($id!=null){
            
            $titulo = "CÉDULAS RECHAZADAS";
            $subtitulo = "Relación de las cédulas rechazadas por el enlace actual.";

            $resultado = \DB::select("select cr.correo,
                                      c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones, c.created_at,
                                      det.id_det as id_detalle, det.id_usuario, det.id_estadocedula, det.fecha_validacionenlace, det.fecha_enviousuario,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      mun.nombre_municipio,
                                      e.descripcion as descestado
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_usuario
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      inner join c_municipios mun on mun.id_municipio = c.municipio
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where (det.id_enlace = '$id' and det.id_estadocedula = 8 and c.deleted_at is null)
                                      order by det.fecha_validacionenlace desc");

            return view('plantillas/rechazadas_enlace')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('datos',$resultado);
        }else{
            return Redirect::to('login');
        }
    }

    public function Correccion_EnlaceyRDSP(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select det.id_det, det.id_usuario, det.id_cedula, det.id_estadocedula, det.id_enlace, det.id_rdsp, det.fecha_enviousuario, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                      c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat,
                                      cr.correo,
                                      pusu.nombre1, pusu.nombre2, pusu.apellidopat, pusu.apellidomat
                                      from c_detalle_cedula det
                                      inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                      inner join c_persona p on p.idpersona = c.idpersona
                                      inner join c_personalua ua on ua.idpersona = c.idpersona
                                      inner join c_credenciales cr on cr.idcredencial = det.id_usuario
                                      inner join c_persona pusu on pusu.idpersona = cr.id_persona
                                      where det.id_det = $request->_id and c.deleted_at is null");

            $titulo = "La cédula:";
            $subtitulo = "Folio: ".$resultado[0]->folio."
                        , serán enviados al Usuario ".$resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat." 
                        con el correo: ".$resultado[0]->correo." para su corrección.";
            $seccion = 2;

            // Regreso 1 para Cédulas Pendientes solo RDSP
            $regreso = 1;

            // Regreso 2 para Cédulas por Instrucción solo RDSP
            if( ($resultado[0]->id_enlace && $resultado[0]->id_rdsp) == null  ){
                $regreso = 2;
            }

            return view('mensajes/alertas_enlace')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado[0])
                    ->with('rol',session('srol'))
                    ->with('regreso',$regreso);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Enviar_Correccion(Request $request){
        $id=session('sid');
        
        if($id!=null){

            $correccion = \DB::insert("insert into c_detalle_correccion
                                       values(sec_detcorreccion.nextval,'$request->texto',$request->iddet,$id,$request->idusuario,null,CURRENT_TIMESTAMP,null,null)");

            if( $correccion == 1 ){
                $updateestado = \DB::update("update c_detalle_cedula
                                             set id_estadocedula = 3
                                             where id_det = $request->iddet");
            }

            if( session('srol') == 2 ){
                return Redirect::to('bandejaenlace');
            }elseif( session('srol') == 3 ){
                return Redirect::to('bandejardsp');
            }else{
                return Redirect::to('/');
            }
            
            
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

            // Cédulas recibidas
            $recibidas = \DB::select("select distinct det.id_usuario,
                                        cr.idcredencial, cr.correo,
                                        p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                        pua.cargo,
                                        adm.nombre as unidad, adm.infodiv
                                        from c_detalle_cedula det
                                        inner join c_credenciales cr on cr.idcredencial = det.id_usuario
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        inner join c_rol r on r.idrol = cr.id_rol
                                        full outer join c_personalua pua on pua.idpersona = p.idpersona
                                        full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                        where det.id_enlace = $id
                                        order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

            // Cédulas enviadas
            $enviadas = \DB::select("select distinct det.id_rdsp,
                                        cr.idcredencial, cr.correo,
                                        p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                        r.idrol, r.rol,
                                        pua.cargo,
                                        adm.nombre as unidad, adm.infodiv
                                        from c_detalle_cedula det
                                        inner join c_credenciales cr on cr.idcredencial = det.id_rdsp
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        inner join c_rol r on r.idrol = cr.id_rol
                                        full outer join c_personalua pua on pua.idpersona = p.idpersona
                                        full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                        where det.id_enlace = $id
                                        order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

            $estatus = \DB::select("select * from c_estados where id_estado >= 6");

            return view('plantillas/buscar_cedulas_enlace')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('recibidas',$recibidas)
                    ->with('enviadas',$enviadas)
                    ->with('estatus',$estatus);

        }else{
            return Redirect::to('login');
        }
    }

    public function Buscar_Cedulas(Request $request){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "BÚSQUEDA DE CÉDULAS";
            $subtitulo = "Relación de la búsqueda de las cédulas enviadas al enlace.";
            $seccion = 2;

            $query = "";

            if( $request->usuario != 0 ){ $query = $query." and det.id_usuario=$request->usuario "; }
            if( $request->rdsp    != 0 ){ $query = $query." and det.id_rdsp=$request->rdsp "; }
            if( $request->estatus != 0 ){
                $query = $query." and det.id_estadocedula=$request->estatus ";
            }else{
                $query = $query." and det.id_estadocedula >= 6";
            }
            
            if( $request->fecha1 != null && $request->fecha2 != null ){
                $query = $query." and fecha_validacionenlace between '$request->fecha1' and '$request->fecha2' ";
            }

            // Datos de las cédulas
            $cedula = \DB::select("select det.id_det as id_detalle, det.fecha_enviousuario, det.fecha_validacionenlace, det.id_usuario, det.id_estadocedula, det.id_enlace,
                                    e.estado, e.descripcion,
                                    c.id_cedulafun, c.folio, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones, 
                                    p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, 
                                    cr.correo as correousu,
                                    pe.nombre1 as rdspnom1, pe.nombre2 as rdspnom2, pe.apellidopat as rdspappat, pe.apellidomat as rdspapmat, 
                                    cr2.correo as correordsp  
                                    from c_detalle_cedula det
                                    inner join c_estados e on e.id_estado = det.id_estadocedula
                                    inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                    inner join c_credenciales del on del.idcredencial = det.id_usuario
                                    inner join c_persona p on p.idpersona = del.id_persona
                                    inner join c_credenciales cr on cr.idcredencial = det.id_usuario
                                    full outer join c_credenciales cr2 on cr2.idcredencial = det.id_rdsp 
                                    full outer join c_persona pe on pe.idpersona = det.id_rdsp 
                                    where (det.id_enlace = $id and c.deleted_at is null) $query
                                    order by det.fecha_validacionenlace desc");

            // Cédulas recibidas
            $recibidas = \DB::select("select distinct det.id_usuario,
                                        cr.idcredencial, cr.correo,
                                        p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                        pua.cargo,
                                        adm.nombre as unidad, adm.infodiv
                                        from c_detalle_cedula det
                                        inner join c_credenciales cr on cr.idcredencial = det.id_usuario
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        inner join c_rol r on r.idrol = cr.id_rol
                                        full outer join c_personalua pua on pua.idpersona = p.idpersona
                                        full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                        where det.id_enlace = $id
                                        order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

            // Cédulas enviadas
            $enviadas = \DB::select("select distinct det.id_rdsp,
                                        cr.idcredencial, cr.correo,
                                        p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                        r.idrol, r.rol,
                                        pua.cargo,
                                        adm.nombre as unidad, adm.infodiv
                                        from c_detalle_cedula det
                                        inner join c_credenciales cr on cr.idcredencial = det.id_rdsp
                                        inner join c_persona p on p.idpersona = cr.id_persona
                                        inner join c_rol r on r.idrol = cr.id_rol
                                        full outer join c_personalua pua on pua.idpersona = p.idpersona
                                        full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                        where det.id_enlace = $id
                                        order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat asc");

            //echo('<pre>');
            //var_dump($ced_recibidas);
            //echo('</pre>');

            $estatus = \DB::select("select * from c_estados where id_estado >= 6");
            
            return view('plantillas/buscar_cedulas_enlace')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion)
                        ->with('recibidas',$recibidas)
                        ->with('enviadas',$enviadas)
                        ->with('estatus',$estatus)
                        ->with('datos',$cedula)
                        ->with('usuariorec',$request->usuario)
                        ->with('rdspenv',$request->rdsp)
                        ->with('cantidadrdsp',count($enviadas))
                        ->with('estatusreq',$request->estatus)
                        ->with('fecha1req',$request->fecha1)
                        ->with('fecha2req',$request->fecha2);
            
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
