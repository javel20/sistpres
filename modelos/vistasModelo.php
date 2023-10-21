<?php

class vistasModelo{

    protected static function obtener_vistas_modelo($vistas){
        $listaBlanca=["home","client-list"];
        if(in_array($vistas, $listaBlanca)){
            
            if(is_file(__DIR__."/contenidos/".$vistas."-view.php")){
                $contenido=__DIR__."/contenidos/".$vistas."-view.php";
            }else{
                $contenido="404";
            }
        }elseif($vistas=="login" || $vistas=="index"){
            $contenido="login";

        }else{
            $contenido ="404";
        }
        return $contenido;
    }

}