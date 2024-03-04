<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Redirect;

class Funcionarios_Controller extends Controller{

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Form_Funcionario(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "CREAR PERSONAL";
            $subtitulo = "Selecciona los datos correspondientes al nuevo personal.";
            $seccion = 1;

            $ua = \DB::select("select *
                                from c_un_adm
                                where cveua_padre like '2%' and estado = 'ACTIVO'
                                order by cverepua");              

            $tipocat = \DB::select("select * from c_usuarioscat");

            return view('plantillas/funcionarios')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion)
                        ->with('datos',$ua)
                        ->with('tipocat',$tipocat);
            
        }else{
            return Redirect::to('login');
        }
    }

    // &&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    public function Insertar_Persona(Request $request){
        $id=session('sid');
        
		
        if($id!=null){
            
            

           $persona = \DB::insert("insert into c_persona
                                    values(sec_persona.nextval,'".$request->nombre1."','".$request->nombre2."','".$request->appat."','".$request->apmat."','".$request->genero."',
                                    null,null,null,'MEXICANA',CURRENT_TIMESTAMP,null,null)");

            $maxpersona = \DB::select("select max(idpersona) as idpersona from c_persona");

           

            // Servidor Público
            if( $request->tipousu == 1 && $persona == 1 ){

                $personalua = \DB::insert("insert into c_personalua
                                            values(sec_personalua.nextval,".$request->ua.",'".$request->cargo."','".$request->rango."','".$request->tipo."','ACTIVO',".$maxpersona[0]->idpersona.",CURRENT_TIMESTAMP,null,'".$request->profesion."',".$request->nivel.",'".$request->nivelnom."')");

            // CATGEM
            
            }else if( $request->tipousu == 2 && $persona == 1 ){
                
                $personalcat = \DB::insert("insert into c_personal_cat
                                            values(sec_personalcat.nextval,".$maxpersona[0]->idpersona.",null,null,CURRENT_TIMESTAMP,null,1,".$request->tipocat.",null,null,null,null)");
                
            }

            return Redirect::to('personalagregado');
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Agregadas_Recientemente(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "PERSONAL AGREGADO";
            $subtitulo = "Relación del personal recientemente agregado.";
            $seccion = 2;
            $metodo = "agregado";
            $cantidad = 3;

            $servidor = \DB::select("select * from ( 
                                    select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero, 
                                    pua.id_personal, pua.iduniadmin, pua.cargo, pua.rango, pua.tipo, pua.idpersona as idpersonapua, pua.profesion, pua.nivel, pua.nivelnominal, 
                                    adm.nombre, adm.tipo as tipoadm
                                    from c_persona p 
                                    full outer join c_personalua pua on pua.idpersona = p.idpersona 
                                    full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin 
                                    where adm.cveua like '2%' and pua.estado = 'ACTIVO' and p.idpersona is not null
                                    order by p.idpersona desc ) 
                                    where rownum <=$cantidad");

            $otro = \DB::select("select * from ( 
                                select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero
                                from c_persona p
                                where p.idpersona not in (select id_persona from c_personal_cat) and p.deleted_at is null
                                order by p.idpersona desc ) 
                                where rownum <=$cantidad");

            $cat = \DB::select("select * from ( 
                                select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                ucat.tipo
                                from c_persona p
                                inner join c_personal_cat cat on cat.id_persona = p.idpersona
                                inner join c_usuarioscat ucat on ucat.idusuariocat = cat.tipo
                                where cat.estado = 1
                                order by p.idpersona desc ) 
                                where rownum <=$cantidad");
            

            return view('plantillas/funcionarios')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion)
                        ->with('metodo',$metodo)
                        ->with('servidor',$servidor)
                        ->with('otro',$otro)
                        ->with('cat',$cat);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Personal_Eliminado(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "PERSONAL ELIMINADO";
            $subtitulo = "Relación del personal recientemente eliminado.";
            $seccion = 2;
            $metodo = "eliminado";
            $cantidad = 3;

            $servidor = \DB::select("select * from ( 
                                    select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero, 
                                    pua.id_personal, pua.iduniadmin, pua.cargo, pua.rango, pua.tipo, pua.idpersona as idpersonapua, pua.profesion, pua.nivel, pua.nivelnominal, 
                                    adm.nombre, adm.tipo as tipoadm
                                    from c_persona p 
                                    full outer join c_personalua pua on pua.idpersona = p.idpersona 
                                    full outer join c_un_adm adm on adm.iduniadmin = pua.iduniadmin 
                                    where adm.cveua like '2%' and pua.estado = 'INACTIVO'
                                    order by p.idpersona desc ) 
                                    where rownum <=$cantidad");

            $otro = \DB::select("select * from ( 
                                select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero
                                from c_persona p
                                where p.deleted_at is not null
                                order by p.idpersona desc ) 
                                where rownum <=$cantidad");

            $cat = \DB::select("select * from ( 
                                select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                ucat.tipo
                                from c_persona p
                                inner join c_personal_cat cat on cat.id_persona = p.idpersona
                                inner join c_usuarioscat ucat on ucat.idusuariocat = cat.tipo
                                where cat.estado = 0
                                order by p.idpersona desc ) 
                                where rownum <=$cantidad");
            

            return view('plantillas/funcionarios')
                        ->with('titulo',$titulo)
                        ->with('subtitulo',$subtitulo)
                        ->with('seccion',$seccion)
                        ->with('metodo',$metodo)
                        ->with('servidor',$servidor)
                        ->with('otro',$otro)
                        ->with('cat',$cat);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Buscar_SP(){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "BUSCAR PERSONAL";
            $subtitulo = "Selecciona algún criterio de búsqueda.";
            $seccion = 3;
            $resultado = 0;

            return view('plantillas/funcionarios')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('resultado',$resultado);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Buscar(Request $request){
        $id=session('sid');
		
        if($id!=null){

            $titulo = "BUSCAR PERSONAL";
            $subtitulo = "Selecciona algún criterio de búsqueda.";
            $seccion = 3;
            $resultado = 1;

            $query = "";
            $sql = array();
            $tipo = "";
            $cantidad = 30;

            if( $request->nombre1 != null ){ $query = $query."and p.nombre1       like '$request->nombre1%'";}
            if( $request->nombre2 != null ){ $query = $query."and p.nombre2       like '$request->nombre2%'";}
            if( $request->appat   != null ){ $query = $query."and p.apellidopat   like '$request->appat%'";}
            if( $request->apmat   != null ){ $query = $query."and p.apellidomat   like '$request->apmat%'";}

            

            // Servidor Público
            if( $request->tipobus == 1 ){
                echo "aca entro";

                $tipo = "Servidor Público";

                $sql = \DB::select("select * from (select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero, p.deleted_at,
                                    pua.id_personal, pua.iduniadmin, pua.cargo, pua.rango, pua.tipo, pua.idpersona as idpersonapua, pua.profesion, pua.nivel, pua.nivelnominal, 
                                    adm.nombre, adm.tipo as tipoadm
                                    from c_persona p
                                    inner join c_personalua pua on pua.idpersona = p.idpersona
                                    inner join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                    where p.idpersona is not null $query
                                    order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat desc)
                                    where rownum <= $cantidad");

                  

            // CATGEM
            }else if( $request->tipobus == 2 ){

                $tipo = "CATGEM";

                $sql = \DB::select("select * from (select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero, p.deleted_at,
                                    ucat.tipo                    
                                    from c_persona p
                                    inner join c_personal_cat cat on cat.id_persona = p.idpersona
                                    inner join c_usuarioscat ucat on ucat.idusuariocat = cat.tipo
                                    where p.idpersona is not null and cat.estado = 1 $query
                                    order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat desc)
                                    where rownum <= $cantidad");
            // Otro
            }else if( $request->tipobus == 3 ){

                $tipo = "Otro";

                $sql = \DB::select("select * from (select *
                                    from c_persona p
                                    where p.nombre1 is not null $query
                                    order by p.nombre1, p.nombre2, p.apellidopat, p.apellidomat desc)
                                    where rownum <= $cantidad");

            }

            return view('plantillas/funcionarios')
                    ->with('titulo',$titulo)
                    ->with('subtitulo',$subtitulo)
                    ->with('seccion',$seccion)
                    ->with('resultado',$resultado)
                    ->with('sql',$sql)
                    ->with('tipoo',$tipo)
                    ->with('tipobus',$request->tipobus)
                    ->with('nombre1',$request->nombre1)
                    ->with('nombre2',$request->nombre2)
                    ->with('appat',$request->appat)
                    ->with('apmat',$request->apmat);
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Vista_Eliminar_SP($idp){
        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero, 
                                    pua.id_personal 
                                    from c_persona p 
                                    inner join c_personalua pua on pua.idpersona = p.idpersona 
                                    where pua.id_personal = $idp
                                    order by p.idpersona desc");

            $titulo = "La Persona Servidora Pública #".$resultado[0]->id_personal;
            $subtitulo = $resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat." será eliminado.";
            $seccion = 2;
            $link = "/SAPSP/veliminar/".$resultado[0]->id_personal."/1";
            $regresar = "/SAPSP/personalagregado";
            $boton = "ELIMINAR";

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

    public function Vista_Eliminar_CO($idu){
        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select cat.id_personalcat,
                                        p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat
                                        from c_personal_cat cat
                                        inner join c_persona p on p.idpersona = cat.id_persona
                                        where cat.id_persona = $idu");

            $titulo='';
            $subtitulo='';
            $link='';
            $seccion = 2;
            $regresar = "/SAPSP/personalagregado";
            $boton = "ELIMINAR";

            // Eliminar Otro
            if( $resultado == null ){

                $otro = \DB::select("select * from c_persona where idpersona = $idu");

                $titulo = "El usuario Otro #".$otro[0]->idpersona." será eliminado.";
                $subtitulo = $otro[0]->nombre1." ".$otro[0]->nombre2." ".$otro[0]->apellidopat." ".$otro[0]->apellidomat;
                $link = "/SAPSP/veliminar/".$otro[0]->idpersona."/2";

            // Eliminar CATGEM
            }else{
                $titulo = "El usuario del CATGEM #".$resultado[0]->idpersona." será eliminado.";
                $subtitulo = $resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat;
                $link = "/SAPSP/veliminar/".$resultado[0]->idpersona."/3";
            }

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

    public function Eliminar_Usu($idu,$op){
        $id=session('sid');
		
        if($id!=null){

            // Eliminar Servidor Público
            if( $op == 1 ){
                $sql = \DB::update("update c_personalua
                                        set estado = 'INACTIVO'
                                    where id_personal = $idu");

                $personalua = \DB::select("select * from c_personalua where id_personal = $idu");

                    if( $sql == 1 && $personalua != null ){
                        $persona = \DB::update("update c_persona
                                                    set deleted_at = CURRENT_TIMESTAMP
                                                where idpersona = ".$personalua[0]->idpersona);
                    }

            // Eliminar Otro
            }elseif( $op == 2 ){
                $persona = \DB::update("update c_persona
                                            set deleted_at = CURRENT_TIMESTAMP
                                        where idpersona = $idu");

            // Eliminar CATGEM
            }elseif( $op == 3 ){
                $cat = \DB::update("update c_personal_cat
                                        set estado = 0
                                    where id_persona = $idu");
                    
                if( $cat == 1 ){
                    $persona = \DB::update("update c_persona
                                                set deleted_at = CURRENT_TIMESTAMP
                                            where idpersona = $idu");
                }
            }

            return Redirect::to('personaleliminado');
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Vista_Activar_SP($idp){
        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero, 
                                    pua.id_personal 
                                    from c_persona p 
                                    inner join c_personalua pua on pua.idpersona = p.idpersona 
                                    where pua.id_personal = $idp
                                    order by p.idpersona desc");

            $titulo = "La Persona Servidora Pública #".$resultado[0]->id_personal;
            $subtitulo = $resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat." será activado.";
            $seccion = 1;
            $link = "/SAPSP/vactivar/".$resultado[0]->id_personal."/1";
            $regresar = "/SAPSP/personalagregado";
            $boton = "ACTIVAR";

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

    public function Vista_Activar_CO($idu){
        $id=session('sid');
		
        if($id!=null){

            $resultado = \DB::select("select cat.id_personalcat,
                                        p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat
                                        from c_personal_cat cat
                                        inner join c_persona p on p.idpersona = cat.id_persona
                                        where cat.id_persona = $idu");

            $titulo='';
            $subtitulo='';
            $link='';
            $seccion = 1;
            $regresar = "/SAPSP/personaleliminado";
            $boton = "ACTIVAR";

            // Eliminar Otro
            if( $resultado == null ){

                $otro = \DB::select("select * from c_persona where idpersona = $idu");

                $titulo = "El usuario Otro #".$otro[0]->idpersona." será activado.";
                $subtitulo = $otro[0]->nombre1." ".$otro[0]->nombre2." ".$otro[0]->apellidopat." ".$otro[0]->apellidomat;
                $link = "/SAPSP/vactivar/".$otro[0]->idpersona."/2";

            // Eliminar CATGEM
            }else{
                $titulo = "El usuario del CATGEM #".$resultado[0]->idpersona." será activado.";
                $subtitulo = $resultado[0]->nombre1." ".$resultado[0]->nombre2." ".$resultado[0]->apellidopat." ".$resultado[0]->apellidomat;
                $link = "/SAPSP/vactivar/".$resultado[0]->idpersona."/3";
            }

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

    public function Activar_Usu($idu,$op){
        $id=session('sid');
		
        if($id!=null){

            // Activar Servidor Público
            if( $op == 1 ){
                $sql = \DB::update("update c_personalua
                                        set estado = 'ACTIVO'
                                    where id_personal = $idu");

                $personalua = \DB::select("select * from c_personalua where id_personal = $idu");

                    if( $sql == 1 && $personalua != null ){
                        $persona = \DB::update("update c_persona
                                                    set deleted_at = null
                                                where idpersona = ".$personalua[0]->idpersona);
                    }

            // Activar Otro
            }elseif( $op == 2 ){
                $persona = \DB::update("update c_persona
                                            set deleted_at = null
                                        where idpersona = $idu");

            // Activar CATGEM
            }elseif( $op == 3 ){
                $cat = \DB::update("update c_personal_cat
                                        set estado = 1
                                    where id_persona = $idu");
                    
                if( $cat == 1 ){
                    $persona = \DB::update("update c_persona
                                                set deleted_at = null
                                            where idpersona = $idu");
                }
            }

            return Redirect::to('personalagregado');
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Vista_Modificar_SP($idp,$op){
        $id=session('sid');
		
        if($id!=null){

            $titulo='';
            $subtitulo = "Ingresa los datos correspondientes a modificar del personal.";
            $seccion = 4;

            $resultado = array();
            $ua = array();

            // Datos Servidor Público
            if( $op == 1 ){

                $titulo = "MODIFICAR PERSONA SERVIDORA PÚBLICA";

                $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero, 
                                            pua.id_personal, pua.cargo, pua.rango, pua.tipo, pua.profesion, pua.nivel, pua.nivelnominal,
                                            adm.iduniadmin, adm.nombre as nombreadm
                                            from c_persona p 
                                            inner join c_personalua pua on pua.idpersona = p.idpersona
                                            inner join c_un_adm adm on adm.iduniadmin = pua.iduniadmin
                                    where pua.id_personal = $idp");

                $ua = \DB::select("select *
                                    from c_un_adm
                                    where cveua_padre like '2%' and estado = 'ACTIVO'
                                    order by cverepua");

                return view('plantillas/funcionarios')
                            ->with('titulo',$titulo)
                            ->with('subtitulo',$subtitulo)
                            ->with('seccion',$seccion)
                            ->with('datos',$resultado[0])
                            ->with('ua',$ua)
                            ->with('tipomod',$op);

            // Datos del otro
            }elseif( $op == 2 ){

                $titulo = "MODIFICAR USUARIO OTRO";

                $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero 
                                            from c_persona p 
                                            where p.idpersona = $idp");

                return view('plantillas/funcionarios')
                            ->with('titulo',$titulo)
                            ->with('subtitulo',$subtitulo)
                            ->with('seccion',$seccion)
                            ->with('datos',$resultado[0])
                            ->with('tipomod',$op);

            // Datos CATGEM
            }elseif( $op == 3 ){

                $titulo = "MODIFICAR USUARIO CATGEM";

                /*$resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                            cat.id_personalcat,
                                            ucat.idusuariocat, ucat.tipo
                                            from c_persona p
                                            inner join c_personal_cat cat on cat.id_persona = p.idpersona
                                            inner join c_usuarioscat ucat on ucat.idusuariocat = cat.tipo
                                            where p.idpersona = $idp");*/

                $resultado = \DB::select("select p.idpersona, p.nombre1, p.nombre2, p.apellidopat, p.apellidomat, p.genero,
                                            cat.id_personalcat,
                                            ucat.idusuariocat, ucat.tipo
                                            from c_persona p
                                            full join c_personal_cat cat on cat.id_persona = p.idpersona
                                            full join c_usuarioscat ucat on ucat.idusuariocat = cat.tipo
                                            where p.idpersona = $idp");

                $tipocat = \DB::select("select * from c_usuarioscat");

                return view('plantillas/funcionarios')
                            ->with('titulo',$titulo)
                            ->with('subtitulo',$subtitulo)
                            ->with('seccion',$seccion)
                            ->with('datos',$resultado[0])
                            ->with('tipocat',$tipocat)
                            ->with('tipomod',$op);

            }            
            
        }else{
            return Redirect::to('login');
        }
    }

    public function Modificar_Usuarios(Request $request){
        $id=session('sid');
		
        if($id!=null){

            $persona = \DB::update("update c_persona
                                            set nombre1     = '".$request->nombre1."',
                                                nombre2     = '".$request->nombre2."',
                                                apellidopat = '".$request->appat."',
                                                apellidomat = '".$request->apmat."',
                                                genero      = '".$request->genero."'
                                        where idpersona = $request->idper");

            // Modificar Servidor Público
            if( $request->op == 1 && $persona == 1 ){

                $personalua = \DB::update("update c_personalua
                                                set iduniadmin = $request->ua,
                                                    cargo = '".$request->cargo."',
                                                    rango = '".$request->rango."',
                                                    tipo = '".$request->tipo."',
                                                    profesion = '".$request->profesion."',
                                                    nivel = '".$request->nivel."',
                                                    nivelnominal = '".$request->nivelnom."'
                                           where id_personal = $request->idper");

            // Modificar CATGEM
            }elseif( $request->op == 3 ){

                $tipo = \DB::update("update c_personal_cat
                                            set tipo = $request->tipocat
                                     where id_personalcat = $request->idcat");
            }

            return Redirect::to('personalagregado');
            
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
