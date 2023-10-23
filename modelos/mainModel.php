<?php

    if($peticionAjax){
        require_once "../config/server.php";
    }else{
        require_once "./config/server.php";
    }

class mainModel{

    // conectar a BD
    protected static function conectar(){
        $conexion = new PDO(SGBD,USER,PASS);
        $conexion->exec("SET CHARACTER SET UTF8");
        return $conexion;
    }

    //function consultas simples
    protected static function  ejecutar_consulta_simple($consulta){
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql();
    }

    //encriptar cadenas
    public function encryption($string){
        $output=FALSE;
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output=base64_encode($output);
        return $output;
    }

    //desencryptar cadenas
    protected static function decryption($string){
        $key=hash('sha256', SECRET_KEY);
        $iv=substr(hash('sha256', SECRET_IV), 0, 16);
        $output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    //generador codigo
    protected static function generar_codigo_aleatorio($letra,$longitud,$numero){
        for($i=1;$i<=$longitud;$i++){
            $aleatorio = rand(0,9);
            $letra.=$aleatorio;
        }
        return $letra. "-" .$numero;
    }

    //evitar inyeccion
    protected static function limpiar_cadena($cadena){
        $cadena = str_ireplace("<script>", "",$cadena);
        $cadena = str_ireplace("</script>", "",$cadena);
        $cadena = str_ireplace("<script src>", "",$cadena);
        $cadena = str_ireplace("<script type>", "",$cadena);
        $cadena = str_ireplace("SELECT * FROM", "",$cadena);
        $cadena = str_ireplace("DELETE FROM", "",$cadena);
        $cadena = str_ireplace("INSERT INTO", "",$cadena);
        $cadena = str_ireplace("DROP TABLE", "",$cadena);
        $cadena = str_ireplace("DROP DATABASE", "",$cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "",$cadena);
        $cadena = str_ireplace("SHOW TABLES", "",$cadena);
        $cadena = str_ireplace("SHOW DATABASES", "",$cadena);
        $cadena = str_ireplace("<?PHP", "",$cadena);
        $cadena = str_ireplace("?>", "",$cadena);
        $cadena = str_ireplace("--", "",$cadena);
        $cadena = str_ireplace(">", "",$cadena);
        $cadena = str_ireplace("<", "",$cadena);
        $cadena = str_ireplace("[", "",$cadena);
        $cadena = str_ireplace("]", "",$cadena);
        $cadena = str_ireplace("^", "",$cadena);
        $cadena = str_ireplace("==", "",$cadena);
        $cadena = str_ireplace(";", "",$cadena);
        $cadena = str_ireplace("::", "",$cadena);
        $cadena = str_ireplace("SELECT * FROM", "",$cadena);
        $cadena = stripslashes($cadena);
        $cadena = trim($cadena);
        return $cadena;

    }

    //verificar datos
    protected static function verificar_datos($filtro,$cadena){
        if(preg_match("/^".$filtro."$/",$cadena)){
            return false;
        }else{
            return true;
        }
    }

    //verificar fecha
    protected static function verificar_fecha($fecha){
        $valores = explode('-','$fecha');
        if(count($valores)==3 && checkdate($valores[1],$valores[2],$valores[1])){
            return false;
        }else{
            return true; // si hay errores
        }
    }

    //paginacion
    protected static function paginador_tablas($pagina,$Npaginas,$url,$botones){
        $tabla = '<nav aria-label="Page navigation exampl"><ul class="pagination justify-content-center">';

        if($pagina==1){
            $tabla.='<li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-left"></i></a></lis>';
        }else{
            $tabla.='
            <li class="page-item"><a class="page-link" href="' .$url. '1/"><i class="fas fa-angle-double-left"></i></a></li>
            <li class="page-item"><a class="page-link" href="' .$url.($pagina-1). '1/">Anterior</a></li> 
            ';
        }

        $ci=0;
        for($i=$pagina;$i<=$Npaginas;$i++){
            if($ci>=$botones){
                break;
            }
            if($pagina==$i){
                $tabla.='<li class="page-item"><a class="page-link active" href="'.$url.$i.'/">'.$i.'</a></li>';
            }else{
                $tabla.='<li class="page-item"><a class="page-link" href="'.$url.$i. '/">'.$i.'</a></li>';
            }
            $ci++;
        }

        if($pagina==$Npaginas){
            $tabla.='<li class="page-item disabled"><a class="page-link"><i class="fas fa-angle-double-left"></i></a></lis>';
        }else{
            $tabla.='
            <li class="page-item"><a class="page-link" href="' .$url.($pagina+1). '/">Siguiente</a></li>
            <li class="page-item"><a class="page-link" href="' .$url.$Npaginas. '1/"><i class="fas fa-angle-double-right"></i></a></li> 
            ';
        }

        $tabla.='</ul></nav>';
        return $tabla;
    }

}

