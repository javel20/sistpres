<?php

    require_once(__DIR__ . '/config/app.php');
    require_once ("controladores/vistasControlador.php");

    // echo SERVERURL;
    $plantilla = new vistasControlador();
    $plantilla->obtener_plantilla_controlador();
    // echo ($_GET['views']);