<?php

    $peticionAjax=true;
    require_once "../config/app.php";

    if(isset($_POST['usuario_dni_reg'])){

        /*----instanciar al controlador---*/
        require_once "../controladores/usuarioControlador.php";
        $ins_usuario = new usuarioControlador();

        /*----agregar usuario---*/
        if(isset($_POST['usuario_dni_reg']) && isset($_POST['usuario_nombre_reg'])){
            echo $ins_usuario->agregar_usuario_controlador();
        }

    }else{
        session_start(['name'=>'SPM']);
        session_unset();
        session_destroy();
        header("location: ".SERVERURL."login/");
        exit();
    }

?>