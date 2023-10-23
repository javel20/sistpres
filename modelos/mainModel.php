<?php

    if($peticionAjax){
        require_once "../config/server.php";
    }else{
        require_once "./config/server.php";
    }

class mainModel{
    protected static function conectar(){
        $conexion = new PDO(SGBD,USER,PASS);
        $conexion->exec("SET CHARACTER SET UTF8");
        return $conexion;
    }

    protected static function  ejecutar_consulta_simple($consulta){
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql();
    }
}

?>