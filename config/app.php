<?php

    define('SERVERURL', 'http://localhost/sistpres/');

    // const SERVERURL = 'http://localhost/sistpres/';
    const SERVERURLL = 'C:/xampp/htdocs/sistpres/';

    define('COMPANY','sysjavel');

    define('MONEDA','$');
    
    date_default_timezone_set("America/El_Salvador");


    $folderPath = dirname($_SERVER['SCRIPT_NAME']);

    //trae la ruta completa de la url, la que estamos ubicados
    $urlPath = $_SERVER['REQUEST_URI'];

    // $url = substr($urlPath,11); 
    //substr muestra nombre apartir del numero(caracter) escrito
    //strlen, longitud de cadena de texto de  folderpath
    $url = substr($urlPath,strlen($folderPath));

    //define constante global llamada url se almacena $url
    define('URL',$url);
    define('URL_PATH',$folderPath);