<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use Redirect;

class Manual_Controller extends Controller{
    
    public function Descargar(){

        $id=session('sid');
        $rol = session('srol');

        $archivo="";
        $url="";
		
        if($id!=null){
            

            if( $rol == 1 ){
                $archivo = "/files/ManualDelegado.pdf";
                
    
            }elseif( $rol == 2 ){
                $archivo = "/files/ManualE.pdf";
    
            }elseif( $rol == 3 ){
                $archivo = "/files/ManualR.pdf";
    
            }
            $public_path = public_path();
            $url = $public_path.$archivo;
            return Response::download($url);

        }else{
            return Redirect::to('login');
        }    
    }

    public function VistaPrevia(){
        $id=session('sid');
        $rol = session('srol');

        $filename=" ";

        if($id!=null){

            if( $rol == 1 ){
                $filename = 'ManualDelegado.pdf';
    
            }elseif( $rol == 2 ){
                $filename = 'ManualEnlace.pdf';
    
            }elseif( $rol == 99 or $rol == 3){
                $filename = 'ManualRDSP.pdf';
    
            }
            
            $path = storage_path($filename);

            echo $path;

           
           
            
           
            
            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="'.$filename.'"'
            ]);

        }else{
            return Redirect::to('login');
        }
    }
}
