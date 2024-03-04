<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Login_Controller;

use Redirect;

class Pruebas_Controller extends Controller{

    public function Prueba(){
        
        $host = request()->getHttpHost();
        $host2 = request()->getHost();

        echo $host;
        echo "<br>";
        echo $host2;
    }

    public function GenerarContrasenias($cantidad,$longitud){

        $arr = array();
        $pattern = "abcdefghkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ123456789abcdefghkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ123456789";
        

        for($i = 0; $i < $cantidad; $i++){
            $pwd = substr(str_shuffle($pattern),0,$longitud);
            array_push($arr,$pwd);
        }
        $this->Imprimir($arr);
    }

    public function Imprimir($arreglo){

        for($i = 0; $i < count($arreglo); $i++){
            echo $arreglo[$i]."<br>";
        }
    }
}
