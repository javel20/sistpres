<?php

class vistasModelo{

    protected static function obtener_vistas_modelo($vistas){
        $listaBlanca=["home","client-list","client-new","client-search","client-update","company","item-list","item-new",
        "item-search","item-update","reservation-list","reservation-new","reservation-pending","reservation-search",
        "reservation-update","user-list","reservation-reservation","user-new","user-search","user_update"];
        if(in_array($vistas, $listaBlanca)){
            
            // echo SERVERURL."vistas/contenidos/".$vistas."-view.php";
            // echo __DIR__. "/contenidos/".$vistas."-view.php";
            if(is_file(SERVERURLL."vistas/contenidos/".$vistas."-view.php")){
                $contenido=SERVERURLL."vistas/contenidos/".$vistas."-view.php";
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