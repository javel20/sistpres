<?php

    if($peticionAjax){
        require_once "../modelos/usuarioModelo.php";
    }else{
        require_once "./modelos/mainModel.php";
    }

    class usuarioControlador extends usuarioModelo{
        
    }
?>