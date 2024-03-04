<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Illuminate\Support\Facades\DB;

class VistaCedula_Controller extends Controller{

    public function Informacion(Request $request){

        $token = $request->session()->token();
        $token = csrf_token();

        $id=session('sid');

        if( $id != null ){

             
            $titulo = "INFORMACIÓN DE LA CÉDULA";
            $subtitulo = "Datos de la Persona Pública";

            // Datos de la cédula
            $cedula = \DB::select("select det.id_det, det.id_usuario, det.id_cedula, det.id_estadocedula, det.id_enlace, det.id_rdsp, det.fecha_enviousuario, det.fecha_validacionenlace, det.fecha_publicacionrdsp,
                                c.id_cedulafun, c.idpersona, c.tipo_cambio, c.nombre1, c.nombre2, c.appat, c.apmat, c.profesion, c.cargo, c.sit_cargo, c.sexo, c.nivel_nom, c.rango, c.clave_ua, c.calle, c.referencia1, c.referencia2, c.numext, c.numint, c.colonia, c.ciudad, c.municipio, c.barrio, c.piso, c.puerta, c.cp, c.ref_dom, c.correo1, c.correo2, c.lada, c.tel1, c.tel2, c.tel3, c.tel4, c.ext1, c.ext2, c.fax1, c.fax2, c.facebook, c.twitter, c.web, c.ref_con, c.observaciones as observacionescedula, c.deleted_at,
                                adm.infodiv, adm.nombre
                                from c_detalle_cedula det
                                inner join c_cedulasfun c on c.id_cedulafun = det.id_cedula
                                inner join c_persona p on p.idpersona = c.idpersona
                                inner join c_personalua ua on ua.idpersona = c.idpersona
                                inner join c_un_adm adm on adm.iduniadmin = ua.iduniadmin
                                where det.id_det = $request->iddet and c.deleted_at is null");

            
                                
            
            $list = explode("/",$cedula[0]->infodiv);
            array_push($list,"","","","","");

            // Datos del Funcionario Anterior
            $funcionarioant = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                        ua.profesion, ua.cargo, ua.tipo, ua.nivelnominal, ua.rango,
                                        adm.cveua,
                                        dir.calleprincipal, dir.entrecalle1, dir.entrecalle2, dir.numext, dir.numint, dir.colonia, dir.ciudad, dir.puerta, dir.piso, dir.barrio, dir.ref_ad, dir.codigopostal,
                                        mun.nombre_municipio,
                                        con.lada, con.tel1, con.tel2, con.tel3, con.tel4, con.fax1, con.fax2, con.ext1, con.ext2, con.correo1, con.correo2, con.facepage, con.twit, con.red, con.ref_ad as ref
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
                                        where det.id_det =".$request->iddet);

            $datosenvio = "";
            $directa = false;

            // Delegado
            if( session('srol') == 1 ){
                $datosenvio = \DB::select("select det.id_det, det.id_estadocedula as idestado, det.fecha_enviousuario as enviodelegado, det.fecha_validacionenlace as envioenlace, det.fecha_publicacionrdsp as publicacion,
                                            cre.correo as correoenvio,
                                            p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                            e.estado
                                            from c_detalle_cedula det
                                            inner join c_credenciales cre on cre.idcredencial = det.id_enlace
                                            inner join c_persona p on p.idpersona = cre.id_persona
                                            inner join c_estados e on e.id_estado = det.id_estadocedula
                                            where det.id_det = $request->iddet");

            // Enlace
            }else if( session('srol') == 2 ){
                $datosenvio = \DB::select("select det.id_det, det.id_estadocedula as idestado, det.fecha_enviousuario as enviodelegado, det.fecha_validacionenlace as envioenlace, det.fecha_publicacionrdsp as publicacion,
                                            cre.correo as correoenvio,
                                            p.nombre1, p.nombre2, p.apellidopat, p.apellidomat,
                                            cre2.correo,
                                            p2.nombre1 as nom, p2.nombre2 as nom2, p2.apellidopat as app, p2.apellidomat as apm,
                                            e.estado
                                            from c_detalle_cedula det
                                            full join c_credenciales cre on cre.idcredencial = det.id_rdsp
                                            full join c_persona p on p.idpersona = cre.id_persona
                                            full join c_credenciales cre2 on cre2.idcredencial = det.id_usuario
                                            inner join c_persona p2 on p2.idpersona = cre2.id_persona
                                            inner join c_estados e on e.id_estado = det.id_estadocedula
                                            where det.id_det = $request->iddet");

                                        


            // RDSP
            }else if( session('srol') == 3 ){
                $datosenvio = \DB::select("select det.id_det, det.id_estadocedula as idestado, det.fecha_enviousuario as enviodelegado, det.fecha_validacionenlace as envioenlace, det.fecha_publicacionrdsp as publicacion,
                                            cre.correo,
                                            p.nombre1 as nom, p.nombre2 as nom2, p.apellidopat as app, p.apellidomat as apm,
                                            e.estado
                                            from c_detalle_cedula det
                                            full outer join c_credenciales cre on cre.idcredencial = det.id_enlace
                                            full outer join c_persona p on p.idpersona = cre.id_persona
                                            full outer join c_estados e on e.id_estado = det.id_estadocedula
                                            where det.id_det = $request->iddet");

                if( $datosenvio[0]->correo == null ){
                    $directa = true;
                }
            }

            
           
            
            return view('plantillas/infocedula')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('regreso',$request->regreso)
                    ->with('datos',$cedula[0])
                    ->with('datos2',$funcionarioant[0])
                    ->with('envio',$datosenvio[0])
                    ->with('directa',$directa)
                    ->with('rol',session('srol'))
                    ->with('list',$list);
        }else{
            return Redirect::to('login');
        }
    }
}
