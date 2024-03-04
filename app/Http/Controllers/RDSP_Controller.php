<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Redirect;

class RDSP_Controller extends Controller{

    public function Bandeja_Entrada(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "BANDEJA DE ENTRADA";
            $subtitulo = "Relación de las cédulas pendientes por validar.";
            $seccion = 1;

            $resultado = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.fecha_validacionenlace, det.id_det as id_detalle, det.id_estadocedula,
                                      p.nombre1 as nom1, p.nombre2 as nom2, p.apellidopat, p.apellidomat,
                                      cr.correo
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      where (det.id_rdsp = '$id' and (det.id_estadocedula = 10 or det.id_estadocedula = 11) and c.deleted_at is null)
                                      order by det.fecha_validacionenlace desc");
            return view('plantillas/rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado);
            
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
            
            if( $resultado[0]->id_estadocedula == 10 ){
                $res = \DB::update("update c_detalle_cedula
                                    set id_estadocedula = 11
                                    where id_det = $request->_id");
            }

            // Datos nuevos
            $resultado2 = \DB::select("select det.id_det, det.id_usuario, det.id_cedula, det.id_estadocedula, det.id_enlace, det.id_rdsp, det.fecha_enviousuario, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones as observacionescedula, c.deleted_at,
                                adm.infodiv, adm.nombre
                                from c_detalle_cedula det
                                inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                inner join c_persona p on p.idpersona = c.idpersona
                                inner join c_personalua ua on ua.idpersona = c.idpersona
                                inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                where det.id_det = $request->_id and c.deleted_at is null");
            
            $list = explode("/",$resultado2[0]->infodiv);
            array_push($list,"","","","","");

            // Datos del Funcionario Anterior
            $resultado3 = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                        ua.profesion, ua.cargo, ua.tipo, ua.nivelnominal, ua.rango,
                                        adm.cveua,
                                        dir.calleprincipal, dir.entrecalle1, dir.entrecalle2, dir.numext, dir.numint, dir.colonia, dir.ciudad, dir.puerta, dir.piso, dir.barrio, dir.ref_ad, dir.codigopostal,
                                        mun.nombre_municipio,
                                        con.lada, con.tel1, con.tel2, con.tel3, con.tel4, con.fax1, con.fax2, con.ext1, con.ext2, con.correo1, con.correo2, con.facepage, con.twit, con.red, con.ref_ad
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

            /*if( strcmp($resultado2[0]->apmat,$resultado3[0]->apellidomat) == 0 ){
                echo "siiiiiiiiii";
            }else{
                if(strpos($resultado2[0]->apmat, " ")){
                    echo "si tiene espacio";
                }
            }*/

            // Boton 0 para Cédulas Pendientes
            $boton = 0;
            $directa = \DB::select("select *
                                    from c_detalle_cedula
                                    where id_det = $request->_id and id_enlace is null");

            // Botón 1 para Cédulas por Instrucción
            if( count($directa) == 1 ){ $boton = 1; }

            return view('plantillas/rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado2[0])
                    ->with('datos2',$resultado3[0])
                    ->with('list',$list)
                    ->with('boton',$boton);
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

            $titulo = "La cédula:";
            $subtitulo = "Folio: ".$resultado[0]->folio." de la persona: ".$resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->appat." ".$resultado[0]->apmat.", serán PUBLICADOS.";
            $seccion = 1;

            // Regreso 1 para Cédulas Pendientes
            $regreso = 1;

            // Regreso 2 para Cédulas por Instrucción
            if( ($resultado[0]->id_enlace && $resultado[0]->id_rdsp) == null  ){
                $regreso = 2;
            }
            //echo $resultado[0]->id_enlace ,"-----", $resultado[0]->id_enlace;

            return view('mensajes/alertas_rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('idreq',$request->_id)
                    ->with('regreso',$regreso);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Publicar(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');

        if($id!=null){

            // ID del personal del CAT
            $personalcat = \DB::select("select cat.id_personalcat, cat.usuario
                                        from c_credenciales cr
                                        inner join c_personal_cat cat on cat.id_persona = cr.id_persona
                                        where cr.idcredencial = $id");

            $idcat = 1;
            $usuariocat = "ADMIN";

            // Asignación de ID
            if( $personalcat != null ){
                $idcat = $personalcat[0]->id_personalcat;
                $usuariocat = $personalcat[0]->usuario;
            }

            $resultado = \DB::update("update c_detalle_cedula
                                         set
                                            id_estadocedula = 13,
                                            fecha_publicacionrdsp = CURRENT_TIMESTAMP
                                      where id_det = $request->idreq");
            
            if( $resultado == 1 ){
                
                // Datos de la Cédula
                $cedula = \DB::select("select *
                                            from c_detalle_cedula det
                                            inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                       where det.id_det = $request->idreq");

                // Datos de la Unidad Administrativa
                /*$ua = \DB::select("select dir.iddireccion,
                                   con.idcontacto,
                                   ua.id_personal, ua.nivel,
                                   adm.iduniadmin, adm.cveua, adm.cveua22 
                                   from c_personalua ua
                                   inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                   inner join c_inmueble mue on mue.iduniadmin = ua.iduniadmin
                                   inner join c_direccion dir on dir.iddireccion = mue.iddireccion
                                   inner join c_regcontacto reg on reg.iduniadmin = ua.iduniadmin
                                   inner join c_contacto con on con.idcontacto = reg.idcontacto
                                   where ua.id_personal = ".$cedula[0]->idpersonalua."");*/

                $ua = \DB::select("select dir.iddireccion,
                                    con.idcontacto,
                                    ua.id_personal, ua.nivel,
                                    adm.iduniadmin, adm.cveua, adm.cveua22
                                    from c_un_adm adm 
                                    inner join c_personalua ua on ua.iduniadmin = adm.iduniadmin
                                    inner join c_inmueble mue on mue.iduniadmin = ua.iduniadmin
                                    inner join c_direccion dir on dir.iddireccion = mue.iddireccion
                                    inner join c_regcontacto reg on reg.iduniadmin = ua.iduniadmin
                                    inner join c_contacto con on con.idcontacto = reg.idcontacto
                                    where adm.iduniadmin = ".$cedula[0]->iduadm." and ua.id_personal = ".$cedula[0]->idpersonalua);
                                   
                if( strcmp( $cedula[0]->tipo_cambio, "CORRECCIÓN") == 0 ){
                    //echo "Es una correccion, solo un cambio<br>";

                    // Datos del Funcionario Anterior
                    $funant = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                            ua.profesion, ua.cargo, ua.tipo, ua.nivelnominal, ua.rango,
                                            adm.cveua,
                                            dir.calleprincipal, dir.entrecalle1, dir.entrecalle2, dir.numext, dir.numint, dir.colonia, dir.ciudad, dir.puerta, dir.piso, dir.barrio, dir.ref_ad, dir.codigopostal,
                                            mun.id_municipio, mun.nombre_municipio,
                                            con.lada, con.tel1, con.tel2, con.tel3, con.tel4, con.fax1, con.fax2, con.ext1, con.ext2, con.correo1, con.correo2, con.facepage, con.twit, con.red, con.ref_ad
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
                                            where det.id_det =".$request->idreq);

                    // Modificación sobre el Funcionario
                    $i = 0;
                    if( strcmp($cedula[0]->nombre1,    $funant[0]->nombre1)     !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->nombre2,    $funant[0]->nombre2)     !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->appat,      $funant[0]->apellidopat) !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->apmat,      $funant[0]->apellidomat) !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->sexo,       $funant[0]->genero)      !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->sit_cargo,  $funant[0]->tipo)        !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->profesion,  $funant[0]->profesion)   !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->cargo,      $funant[0]->cargo)       !== 0 ){ $i++; }
                    if( strcmp($cedula[0]->nivel_nom,  $funant[0]->nivelnominal)!== 0 ){ $i++; }
                    if( strcmp($cedula[0]->rango,      $funant[0]->rango)       !== 0 ){ $i++; }
                    
                    if( $i > 0 ){
                        $persona = \DB::update("update c_persona
                                                set nombre1     = '".$cedula[0]->nombre1."',
                                                    nombre2     = '".$cedula[0]->nombre2."',
                                                    apellidopat = '".$cedula[0]->appat."',
                                                    apellidomat = '".$cedula[0]->apmat."',
                                                    genero      = '".$cedula[0]->sexo."'
                                                where idpersona =  ".$cedula[0]->idpersona."");

                        $personalua = \DB::update("update c_personalua
                                                   set tipo          = '".$cedula[0]->sit_cargo."',
                                                        profesion    = '".$cedula[0]->profesion."',
                                                        cargo        = '".$cedula[0]->cargo."',
                                                        nivelnominal = '".$cedula[0]->nivel_nom."',
                                                        rango        = '".$cedula[0]->rango."'
                                                   where idpersona   =  ".$cedula[0]->idpersona."");

                        $cambiosfun = \DB::insert("insert into c_modificaciones
                                                   values(sec_modificaciones.nextval,'".$ua[0]->cveua."','".$ua[0]->cveua22."','$usuariocat',CURRENT_TIMESTAMP,'FUNCIONARIO',null)");
                    }

                    // Modificación sobre la Dirección
                    $j = 0;
                    if( strcmp($cedula[0]->calle,      $funant[0]->calleprincipal) !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->referencia1,$funant[0]->entrecalle1)    !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->referencia2,$funant[0]->entrecalle2)    !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->numext,     $funant[0]->numext)         !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->numint,     $funant[0]->numint)         !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->colonia,    $funant[0]->colonia)        !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->ciudad,     $funant[0]->ciudad)         !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->municipio,  $funant[0]->id_municipio)   !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->puerta,     $funant[0]->puerta)         !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->piso,       $funant[0]->piso)           !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->barrio,     $funant[0]->barrio)         !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->ref_dom,    $funant[0]->ref_ad)         !== 0 ){ $j++; }
                    if( strcmp($cedula[0]->cp,         $funant[0]->codigopostal)   !== 0 ){ $j++; }
                    
                    if( $j > 0 ){
                        $direccion = \DB::update("update c_direccion
                                                    set calleprincipal = '".$cedula[0]->calle."',
                                                        entrecalle1    = '".$cedula[0]->referencia1."',
                                                        entrecalle2    = '".$cedula[0]->referencia2."',
                                                        numext         = '".$cedula[0]->numext."',
                                                        numint         = '".$cedula[0]->numint."',
                                                        colonia        = '".$cedula[0]->colonia."',
                                                        ciudad         = '".$cedula[0]->ciudad."',
                                                        idmunicipio    = '".$cedula[0]->municipio."',
                                                        puerta         = '".$cedula[0]->puerta."',
                                                        piso           = '".$cedula[0]->piso."',
                                                        barrio         = '".$cedula[0]->barrio."',
                                                        ref_ad         = '".$cedula[0]->ref_dom."',
                                                        codigopostal   = '".$cedula[0]->cp."',
                                                        estado         = 'ACTIVO'
                                                    where iddireccion =    ".$ua[0]->iddireccion."");

                        $cambiosfun = \DB::insert("insert into c_modificaciones
                                                    values(sec_modificaciones.nextval,'".$ua[0]->cveua."','".$ua[0]->cveua22."','$usuariocat',CURRENT_TIMESTAMP,'DIRECCION',null)");
                    }

                    // Modificación sobre el Contacto
                    $k = 0;
                    if( strcmp($cedula[0]->lada,       $funant[0]->lada)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->tel1,       $funant[0]->tel1)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->tel2,       $funant[0]->tel2)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->tel3,       $funant[0]->tel3)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->tel4,       $funant[0]->tel4)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->fax1,       $funant[0]->fax1)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->fax2,       $funant[0]->fax2)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->ext1,       $funant[0]->ext1)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->ext2,       $funant[0]->ext2)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->correo1,    $funant[0]->correo1)    !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->correo2,    $funant[0]->correo2)    !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->facebook,   $funant[0]->facepage)   !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->twitter,    $funant[0]->twit)       !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->web,        $funant[0]->red)        !== 0 ){ $k++; }
                    if( strcmp($cedula[0]->ref_con,    $funant[0]->ref_ad)     !== 0 ){ $k++; }

                    if( $k > 0 ){

                        $contacto = \DB::update("update c_contacto
                                                         set lada       = '".$cedula[0]->lada."',
                                                             tel1       = '".$cedula[0]->tel1."',
                                                             tel2       = '".$cedula[0]->tel2."',
                                                             tel3       = '".$cedula[0]->tel3."',
                                                             tel4       = '".$cedula[0]->tel4."',
                                                             fax1       = '".$cedula[0]->fax1."',
                                                             fax2       = '".$cedula[0]->fax2."',
                                                             ext1       = '".$cedula[0]->ext1."',
                                                             ext2       = '".$cedula[0]->ext2."',
                                                             correo1    = '".$cedula[0]->correo1."',
                                                             correo2    = '".$cedula[0]->correo2."',
                                                             facepage   = '".$cedula[0]->facebook."',
                                                             twit       = '".$cedula[0]->twitter."',
                                                             red        = '".$cedula[0]->web."',
                                                             ref_ad     = '".$cedula[0]->ref_con."'
                                                         where idcontacto = ".$ua[0]->idcontacto."");

                        $cambiosfun = \DB::insert("insert into c_modificaciones
                                                    values(sec_modificaciones.nextval,'".$ua[0]->cveua."','".$ua[0]->cveua22."','$usuariocat',CURRENT_TIMESTAMP,'CONTACTO',null)");
                    }


                }else if( strcmp( $cedula[0]->tipo_cambio, "ACTUALIZACIÓN") == 0 ){
                    //echo "Es una actualizacion, cambio de Funcionario";

                    $desactivar = \DB::update("update c_personalua
                                                    set estado = 'INACTIVO', fechaf = CURRENT_TIMESTAMP
                                               where id_personal = ".$ua[0]->id_personal."");
                    //$desactivar == 1
                    if( $desactivar == 1 ){

                        /*$cedsaliente = \DB::update("update c_cedulasfun
                                                                set idsaliente = ".$ua[0]->id_personal."
                                                            where id_cedulafun = ".$cedula[0]->id_cedulafun);

                        if( $cedsaliente == 1 ){*/

                            $persona = \DB::insert("insert into c_persona
                                                values(sec_persona.nextval,'".$cedula[0]->nombre1."','".$cedula[0]->nombre2."','".$cedula[0]->appat."','".$cedula[0]->apmat."','".$cedula[0]->sexo."',null,null,null,'MEXICANA',CURRENT_TIMESTAMP,null,null)");
                        
                            $maxpersona = \DB::select("select max(idpersona) as idpersona from c_persona");
                            
                            //$persona == 1
                            if( $persona == 1 ){
                                $personalua = \DB::insert("insert into c_personalua
                                                        values (sec_personalua.nextval,".$ua[0]->iduniadmin.",'".$cedula[0]->cargo."','".$cedula[0]->rango."','".$cedula[0]->sit_cargo."','ACTIVO',".$maxpersona[0]->idpersona.",CURRENT_TIMESTAMP,null,'".$cedula[0]->profesion."','".$ua[0]->nivel."','".$cedula[0]->nivel_nom."')");
                            
                                $personae = \DB::select("select max(id_personal) as idpersonal from c_personalua");


                                //$personalua == 1
                                if( $personalua == 1 ){

                                    $direccion = \DB::update("update c_direccion
                                                            set calleprincipal = '".$cedula[0]->calle."',
                                                                entrecalle1    = '".$cedula[0]->referencia1."',
                                                                entrecalle2    = '".$cedula[0]->referencia2."',
                                                                numext         = '".$cedula[0]->numext."',
                                                                numint         = '".$cedula[0]->numint."',
                                                                colonia        = '".$cedula[0]->colonia."',
                                                                ciudad         = '".$cedula[0]->ciudad."',
                                                                idmunicipio    = '".$cedula[0]->municipio."',
                                                                puerta         = '".$cedula[0]->puerta."',
                                                                piso           = '".$cedula[0]->piso."',
                                                                barrio         = '".$cedula[0]->barrio."',
                                                                ref_ad         = '".$cedula[0]->ref_dom."',
                                                                codigopostal   = '".$cedula[0]->cp."',
                                                                estado         = 'ACTIVO'
                                                            where iddireccion = ".$ua[0]->iddireccion."");
                                    //$direccion == 1
                                    if( $direccion == 1 ){
                                        $contacto = \DB::update("update c_contacto
                                                                set lada       = '".$cedula[0]->lada."',
                                                                    tel1       = '".$cedula[0]->tel1."',
                                                                    tel2       = '".$cedula[0]->tel2."',
                                                                    tel3       = '".$cedula[0]->tel3."',
                                                                    tel4       = '".$cedula[0]->tel4."',
                                                                    fax1       = '".$cedula[0]->fax1."',
                                                                    fax2       = '".$cedula[0]->fax2."',
                                                                    ext1       = '".$cedula[0]->ext1."',
                                                                    ext2       = '".$cedula[0]->ext2."',
                                                                    correo1    = '".$cedula[0]->correo1."',
                                                                    correo2    = '".$cedula[0]->correo2."',
                                                                    facepage   = '".$cedula[0]->facebook."',
                                                                    twit       = '".$cedula[0]->twitter."',
                                                                    red        = '".$cedula[0]->web."',
                                                                    ref_ad     = '".$cedula[0]->ref_con."'
                                                                where idcontacto = ".$ua[0]->idcontacto."");
                                        //$contacto == 1
                                        if( $contacto == 1 ){
                                            //echo "Satisfactorio";
                                            $cambiosfun = \DB::insert("insert into c_cambiosfuncionario
                                                                    values(sec_cambiosfun.nextval,".$ua[0]->iduniadmin.",".$personae[0]->idpersonal.",".$ua[0]->id_personal.",".$idcat.",CURRENT_TIMESTAMP)");
                                        }
                                    }
                                }
                            }

                        //}

                    }
                }else{
                    echo "No está definido el Tipo de Cambio en la Cédula!!!";
                }
                if( $cedula[0]->id_usuario == $id ){
                    // Cédulas por Instruccion
                    return Redirect::to('cedulasdiraprobadas');

                }else{
                    // Cedulas Normales
                    return Redirect::to('cedulaspublicadas');
                }
                
            }
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Cedulas_Publicadas(){
        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.fecha_validacionenlace, det.fecha_publicacionrdsp, det.id_det as id_detalle, det.id_usuario, det.id_estadocedula,
                                      cr.correo,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      e.estado, e.descripcion
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                      inner join c_persona p on p.idpersona = cr.id_persona 
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where det.id_rdsp = $id and det.id_estadocedula = 13 and c.deleted_at is null
                                      order by det.fecha_publicacionrdsp desc");
            
            $titulo = "CÉDULAS PUBLICADAS";
            $subtitulo = "Relación de las cédulas publicadas en el Directorio de las Personas Servidoras Públicas.";
            $seccion = 3;

            return view('plantillas/rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado);
        }else{
            return Redirect::to('login');
        }
    }


    public function Invalidar_Cedula(request $request){

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
            $subtitulo = "Folio: ".$resultado[0]->folio." de la persona: ".$resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->appat." ".$resultado[0]->apmat.", serán RECHAZADOS y NÓ serán publicados.";
            $seccion = 2;

            // Regreso 1 para Cédulas Pendientes
            $regreso = 1;

            // Regreso 2 para Cédulas por Instrucción
            if( ($resultado[0]->id_enlace && $resultado[0]->id_rdsp) == null  ){
                $regreso = 2;
            }

            return view('mensajes/alertas_rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado[0])
                    ->with('regreso',$regreso);
            
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
                                                set id_estadocedula = 12, fecha_publicacionrdsp = CURRENT_TIMESTAMP
                                           where id_det = '$request->iddet'");

                $resultado3 = \DB::select("select count(*) as cantidad
                                           from c_detalle_cedula
                                           where id_det = $request->iddet and id_usuario = $id");

                if( $resultado2 == 1 && $resultado3[0]->cantidad == 0 ){
                    return Redirect::to('rechazadasrdsp');
                    
                }elseif( $resultado2 == 1 && $resultado3[0]->cantidad == 1 ){
                    return Redirect::to('cedulasdirrechazadas');
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
            $subtitulo = "Relación de las cédulas rechazadas.";

            $resultado = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones, c.created_at,
                                      det.id_det as id_detalle, det.id_enlace, det.id_estadocedula, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      cr.correo,
                                      mun.nombre_municipio,
                                      e.descripcion as descestado
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      inner join c_municipios mun on mun.id_municipio = c.municipio
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where (det.id_rdsp = '$id' and det.id_estadocedula = 12 and c.deleted_at is null)
                                      order by det.fecha_publicacionrdsp desc");

            return view('plantillas/rechazadas_rdsp')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('datos',$resultado);
        }else{
            return Redirect::to('login');
        }
    }


    public function Consultar_Cedula_Directa(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "CÉDULAS POR INSTRUCCIÓN PENDIENTES";
            $subtitulo = "Relación de las cédulas creadas por el RDSP.";
            $seccion = 1;
            
            $resultado = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones, c.created_at,
                                      det.id_det as id_detalle, det.id_estadocedula
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      where (det.id_usuario = '$id' and (det.id_estadocedula = 10 or det.id_estadocedula = 11) and c.deleted_at is null)
                                      order by c.created_at desc");

            return view('plantillas/rdsp_cedulas_directas')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion)
                        ->with('datos',$resultado);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Vista_Cedula_Directa(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            $titulo = "MODIFICAR CÉDULA";
            $subtitulo = "Ingresa los datos correspondientes al funcionario.";
            $seccion = 2;

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
                                where det.id_det = $request->_id and c.deleted_at is null");
            
            $list = explode("/",$resultado[0]->infodiv);
            array_push($list,"","","","","");

            // Datos del Funcionario Anterior
            $resultado2 = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                        ua.profesion, ua.cargo, ua.tipo, ua.nivelnominal, ua.rango,
                                        adm.cveua,
                                        dir.calleprincipal, dir.entrecalle1, dir.entrecalle2, dir.numext, dir.numint, dir.colonia, dir.ciudad, dir.puerta, dir.piso, dir.barrio, dir.ref_ad, dir.codigopostal,
                                        mun.nombre_municipio,
                                        con.lada, con.tel1, con.tel2, con.tel3, con.tel4, con.fax1, con.fax2, con.ext1, con.ext2, con.correo1, con.correo2, con.facepage, con.twit, con.red, con.ref_ad
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

            $resultado3 = \DB::select("select * from c_municipios order by nombre_municipio");

            return view('plantillas/rdsp_cedulas_directas')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$resultado[0])
                    ->with('datos2',$resultado2[0])
                    ->with('datos3',$resultado3)
                    ->with('list',$list);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Modificar_Cedula_Directa(Request $request){
        $id=session('sid');
		
        if($id!=null){

            $query = \DB::update("update c_cedulasfun
                                  set
                                  tipo_cambio = '$request->radio',
                                  nombre1 = '$request->nombre1',
                                  nombre2 = '$request->nombre2',
                                  appat = '$request->appat',
                                  apmat = '$request->apmat',
                                  profesion = '$request->profesion',
                                  cargo = '".$request->cargo2."',
                                  sit_cargo = '$request->sitcargo',
                                  sexo = '$request->sexo2',
                                  nivel_nom = '$request->nivelnominal',
                                  rango = '$request->rango2',
                                  clave_ua = '$request->claveua',
                                  calle = '$request->calle',
                                  referencia1 = '$request->refcall1',
                                  referencia2 = '$request->refcall2',
                                  numext = '$request->numext',
                                  numint = '$request->numint',
                                  colonia = '$request->colonia',
                                  ciudad = '$request->ciudad',
                                  municipio = $request->muni,
                                  barrio = '$request->barrio',
                                  piso = '$request->piso',
                                  puerta = '$request->puerta',
                                  cp = $request->cp,
                                  ref_dom = '$request->refadicional',
                                  correo1 = '$request->correo1',
                                  correo2 = '$request->correo2',
                                  lada = '$request->lada',
                                  tel1 = '$request->tel1',
                                  tel2 = '$request->tel2',
                                  tel3 = '$request->tel3',
                                  tel4 = '$request->tel4',
                                  ext1 = '$request->ext1',
                                  ext2 = '$request->ext2',
                                  facebook = '$request->facebook',
                                  twitter = '$request->twitter',
                                  web = '$request->web',
                                  ref_con = '$request->refead',
                                  updated_at = CURRENT_TIMESTAMP
                                  where id_cedulafun = $request->idced");

            if( $query == 1 ){
                return Redirect::to('cedulaspendientes');
            }
            return Redirect::to('/');
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Cedulas_Directas_Aprobadas(){
        $id=session('sid');

        if($id!=null){

            $titulo = "CÉDULAS POR INSTRUCCIÓN PUBLICADAS";
            $subtitulo = "Relación de las cédulas por Instrucción publicadas en el Directorio de Personas Servidoras Públicas.";
            $seccion = 3;//3

            // Datos de la cédula
            $cedula = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.id_det as id_detalle, det.id_usuario, det.id_estadocedula, det.fecha_publicacionrdsp,
                                      e.estado, e.descripcion
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where det.id_usuario = $id and det.id_estadocedula = 13 and c.deleted_at is null
                                      order by det.fecha_publicacionrdsp desc");

            return view('plantillas/rdsp_cedulas_directas')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$cedula);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Cedulas_Directas_Rechazadas(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "CÉDULAS POR INSTRUCCIÓN RECHAZADAS";
            $subtitulo = "Relación de las cédulas por instrucción rechazadas.";

            // Datos de la cédula
            $cedula = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones, c.created_at,
                                      det.id_det as id_detalle, det.id_enlace, det.id_estadocedula, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                      mun.nombre_municipio,
                                      e.descripcion as descestado
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      inner join c_municipios mun on mun.id_municipio = c.municipio
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where (det.id_usuario = $id and det.id_estadocedula = 12 and c.deleted_at is null)
                                      order by det.fecha_publicacionrdsp desc");

            return view('plantillas/rechazadas_directas_rdsp')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('datos',$cedula);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Consulta(){
        return view('plantillas/rconsulta');
    }

    public function Confirmacion_Eliminar(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            $query = \DB::select("select det.id_det, c.folio, id_enlace
                                  from c_detalle_cedula det
                                  inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                  where id_det = ".$request->_id);

            $titulo = "ELIMINAR CÉDULA PUBLICADA";
            $subtitulo = "La cédula con folio: ".$query[0]->folio." será eliminada y el funcionario anterior se restaurará, este proceso es irreversible una vez completado.";
            $seccion = 4;
            $directa = false;

            if( $query[0]->id_enlace == null ){
                $directa = true;
            }

            return view('mensajes/alertas_rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$query[0])
                    ->with('directa',$directa);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Eliminar_Publicacion(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            // ID del personal del CAT
            $personalcat = \DB::select("select cat.id_personalcat, cat.usuario
                                        from c_credenciales cr
                                        inner join c_personal_cat cat on cat.id_persona = cr.id_persona
                                        where cr.idcredencial = $id");

            $idcat = 1;

            if( $personalcat != null ){ $idcat = $personalcat[0]->id_personalcat; }

            $cedula = \DB::select("select c.iduadm, c.idpersonalua,
                                   dc.id_usuario
                                   from c_detalle_cedula dc
                                   inner join c_cedulasfun c on c.id_cedulafun = dc.id_cedula
                                   where dc.id_det = ".$request->_id);

            // Seleccionar cambio
            $cambio = \DB::select("select *
                                   from c_cambiosfuncionario
                                   where iduniadmin = ".$cedula[0]->iduadm." and idpersonals = ".$cedula[0]->idpersonalua."");

            // Desactivar al Funcionario Actual
            $desactivaract = \DB::update("update c_personalua
                                              set estado = 'INACTIVO'
                                          where id_personal = ".$cambio[0]->idpersonale." and iduniadmin = ".$cambio[0]->iduniadmin);

            if( $desactivaract == 1 ){

                // Activar al Funcionario Anterior
                $activarant = \DB::update("update c_personalua
                                              set estado = 'ACTIVO'
                                          where id_personal = ".$cambio[0]->idpersonals." and iduniadmin = ".$cambio[0]->iduniadmin);

                if( $activarant == 1 ){

                    // Actualizar estado de la Cédula
                    $estadoced = \DB::update("update c_detalle_cedula
                                                    set id_estadocedula = 12
                                              where id_det = ".$request->_id);

                    if( $estadoced == 1 ){

                        // Insertar el cambio del Funcionario
                        $nuevocambio = \DB::insert("insert into c_cambiosfuncionario
                                                    values(sec_cambiosfun.nextval,".$cambio[0]->iduniadmin.",".$cambio[0]->idpersonals.",".$cambio[0]->idpersonale.",$idcat,CURRENT_TIMESTAMP)");
                    
                        if( $cedula[0]->id_usuario == $id ){
                            // Cédula por Instrucción
                            return Redirect::to('cedulasdirrechazadas');
                        }else{
                            // Cédulas Normales
                            return Redirect::to('rechazadasrdsp');
                        }
                    }
                }
            }
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Consul(Request $request){
        $token = $request->session()->token();
        $token = csrf_token();

        

        $persona=$request->usua;
        $personacon=$request->contr;

        if($persona == "refis" && $personacon == "sifer"){
            Session::put('sid_personalua',0);
            Session::put('scveua',"2");
            Session::put('sid',18);
            Session::put('sid_uniadmin','200000000000000');
            Session::put('sid_credencial',18);
            Session::put('sname',"Ing. Luis Fernando García");
            Session::put('scorreo',"refis");
            Session::put('srol',99);
            date_default_timezone_set('America/Mexico_City');
            Session::put('shora',date("h:i:s",strtotime(date("h:i:s"))-3600));
            
            return Redirect::to('/');
        }else{
            return view('plantillas/rconsulta')
                    ->with('msj',"No existe el usuario o se encuentra desactivado.");
        }
    }

    public function Buscar(){
        $id=session('sid');
		
        if($id!=null){
            
            $titulo = "BUSCAR CÉDULAS";
            $subtitulo = "Selecciona algún criterio de búsqueda.";
            $seccion = 1;

            // Enlaces que envian cédulas al RDSP
            $res = \DB::select("select distinct det.id_enlace,
                                cr.idcredencial, cr.correo,
                                p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                pua.cargo,
                                adm.nombre as unidad, adm.infodiv
                                from c_detalle_cedula det
                                inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                inner join c_persona p on p.idpersona = cr.id_persona
                                full outer join c_personalua pua on pua.idpersona = p.idpersona
                                full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                where det.id_enlace is not null and det.id_rdsp = $id
                                order by p.nombre1, p.nombre2, p.apellidopat");

            // Estados de las cédulas
            $res2 = \DB::select("select * from c_estados where id_estado >= 10 and id_estado <= 13");

            return view('plantillas/buscar_cedulas_rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('datos',$res)
                    ->with('datos2',$res2);
        }else{
            return Redirect::to('login');
        }
    }

    public function Buscar_Cedulas(Request $request){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "BUSCAR CÉDULAS";
            $subtitulo = "Relación de la búsqueda de las cédulas.";
            $seccion = 2;

            $resultado = array();
            $query = "";
            $inner = "";

            // Cédulas Normales
            if( $request->tipo == 0 ){

                $query = $query."and det.id_rdsp = $id";
                $inner = "inner join c_credenciales cr on cr.idcredencial = det.id_enlace";

                if( $request->enlace  != 0 ){ $query = $query." and det.id_enlace = $request->enlace "; }

            // Cédulas por Instrucción
            }else if( $request->tipo == 1 ){

                $query = $query."and det.id_usuario = $id";
                $inner = $inner."inner join c_credenciales cr on cr.idcredencial = det.id_usuario";

            }

            // Estados de las cédulas
            if( $request->estatus != 0 ){
                $query = $query." and det.id_estadocedula = $request->estatus ";
            }else{
                $query = $query." and det.id_estadocedula >= 10 and det.id_estadocedula <= 13";
            }

            // Entre fechas
            if( $request->fecha1 != null && $request->fecha2 != null ){
                
                // Cédulas Normales
                if( $request->tipo == 0 ){
                    $query = $query." and fecha_validacionenlace between '$request->fecha1' and '$request->fecha2' ";

                // Cédulas por Instrucción
                }else if( $request->tipo == 1 ){
                    $query = $query." and fecha_publicacionrdsp between '$request->fecha1' and '$request->fecha2' ";
                }
                
            }

            // Enlaces que envian cédulas al RDSP
            $enlaces = \DB::select("select distinct det.id_enlace,
                                cr.idcredencial, cr.correo,
                                p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                pua.cargo,
                                adm.nombre as unidad, adm.infodiv
                                from c_detalle_cedula det
                                inner join c_credenciales cr on cr.idcredencial = det.id_enlace
                                inner join c_persona p on p.idpersona = cr.id_persona
                                full outer join c_personalua pua on pua.idpersona = p.idpersona
                                full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                where det.id_enlace is not null and det.id_rdsp = $id
                                order by p.nombre1, p.nombre2, p.apellidopat asc");

            // Datos de las cédulas
            $cedulas = \DB::select("select c.folio, c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1 as nom1, c.nombre2 as nom2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones,
                                      det.id_det as id_detalle, det.fecha_validacionenlace, det.fecha_publicacionrdsp, det.id_usuario, det.id_estadocedula, det.id_enlace,
                                      cr.correo,
                                      p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                      e.estado, e.descripcion
                                      from c_cedulasfun c
                                      inner join c_detalle_cedula det on det.id_cedula = c.id_cedulafun
                                      $inner
                                      inner join c_persona p on p.idpersona = cr.id_persona
                                      inner join c_estados e on e.id_estado = det.id_estadocedula
                                      where (c.deleted_at is null) $query
                                      order by det.fecha_publicacionrdsp, det.fecha_validacionenlace desc");
            
            // Estados de las cédulas
            $estados = \DB::select("select * from c_estados where id_estado >= 10 and id_estado <= 13");

            return view('plantillas/buscar_cedulas_rdsp')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('enlaces',$enlaces)
                    ->with('datos3',$cedulas)
                    ->with('estados',$estados)
                    ->with('tiporeq',$request->tipo)
                    ->with('enlacereq',$request->enlace)
                    ->with('estatusreq',$request->estatus)
                    ->with('fecha1req',$request->fecha1)
                    ->with('fecha2req',$request->fecha2);
            
        }else{
            return Redirect::to('login');
        }
    }


    public function Vista_Periodo(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "CREAR PERIODO VACACIONAL";
            $subtitulo = "Registra tu periodo vacacional.";
            $seccion = 1;
            $periodo = 0;

            $query = \DB::select("select *
                                  from c_vacaciones
                                  where deleted_at is null and idusuario = $id");

            if( $query != null ){
                $periodo = 1;
            }
            
            return view('plantillas/vacaciones')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('periodo',$periodo);

        }else{
            return Redirect::to('login');
        }
    }

    public function Crear_Periodo(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){
            
            $query = \DB::insert("insert into c_vacaciones
                                    values(sec_vacaciones.nextval,$id,'$request->fecha1 00:00:01','$request->fecha2 23:59:59',CURRENT_TIMESTAMP,null,null)");
            
            if( $query == 1 ){
                return Redirect::to('consultarperiodo');
            }
        }else{
            return Redirect::to('login');
        }
    }

    public function Consultar_Periodo(){
        $id=session('sid');
		
        if($id!=null){
            
            $titulo = "CONSULTAR PERIODO VACACIONAL";
            $subtitulo = "Relación de los periodos vacacionales.";
            $seccion = 2;
            
            $query = \DB::select("select
                                    idvacaciones,
                                    to_char(fecha1,'DD-MON-YYYY') as fecha1,
                                    to_char(fecha2,'DD-MON-YYYY') as fecha2
                                    from c_vacaciones
                                    where idusuario = $id and deleted_at is null
                                    order by created_at desc");
            
            $query2 = \DB::select("select p.nombre1, p.nombre2, p.apellidopat, p.apellidomat
                                    from c_credenciales cr
                                    inner join c_persona p on p.idpersona = cr.id_persona
                                    where cr.idcredencial=$id");

            return view('plantillas/vacaciones')
                ->with('titulo',$titulo)
                ->with('subtitulo',$subtitulo)
                ->with('seccion',$seccion)
                ->with('datos',$query)
                ->with('datos2',$query2[0]);

        }else{
            return Redirect::to('login');
        }
    }

    public function Elimina_Periodo(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){

            $query = \DB::select("select idvacaciones,
                                    to_char(fecha1,'DD-MM-YYYY') as fecha1,
                                    to_char(fecha2,'DD-MM-YYYY') as fecha2
                                    from c_vacaciones where idvacaciones = $request->_id");

            $titulo = "ELIMINAR PERIODO VACACIONAL";
            $subtitulo = "El periodo vacacional #".$query[0]->idvacaciones." del ".$query[0]->fecha1." al ".$query[0]->fecha2." será eliminado.";
            $seccion = 3;

            return view('mensajes/alertas_rdsp')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion)
                        ->with('idvac',$request->_id);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Desactivar_Periodo(Request $request){

        //$token = $request->session()->token();
        //$token = csrf_token();

        $id=session('sid');
		
        if($id!=null){
            $query = \DB::update("update c_vacaciones
                                    set deleted_at = CURRENT_TIMESTAMP
                                    where idvacaciones = $request->_id");
            if( $query == 1){
                return Redirect::to('consultarperiodo');
            }
        }else{
            return Redirect::to('login');
        }
    }

    public function Vista_Modificar_Periodo(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');
		
        if($id!=null){
            $titulo = "MODIFICAR PERIODO VACACIONAL";
            $subtitulo = "Modifica los datos que esten incorrectos sobre el periodo vacaional.";
            $seccion = 3;
            
            $query = \DB::select("select *
                                    from c_vacaciones
                                    where idvacaciones = $request->_id and deleted_at is null");

            $fecha1 = date('Y-m-d', strtotime($query[0]->fecha1));
            $fecha2 = date('Y-m-d', strtotime($query[0]->fecha2));
            //date('Y-m-d', strtotime("2013-11-31");

            return view('plantillas/vacaciones')
                ->with('titulo',$titulo)
                ->with('subtitulo',$subtitulo)
                ->with('seccion',$seccion)
                ->with('datos',$query[0])
                ->with('fecha1',$fecha1)
                ->with('fecha2',$fecha2);
        }else{
            return view('plantillas/vacaciones');
        }
    }

    public function Modificar_Periodo(Request $request){
        $id=session('sid');
		
        if($id!=null){
            
            $query = \DB::update("update c_vacaciones
                                    set fecha1 = '$request->fecha1', fecha2 = '$request->fecha2', updated_at = CURRENT_TIMESTAMP
                                    where idvacaciones = $request->idvac");
            if( $query == 1){
                return Redirect::to('consultarperiodo');
            }
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
