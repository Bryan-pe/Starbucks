<?php
    try {
        $db = new SQLite3("../db/starbucks_db");
        /*echo "conexion exitosa";*/
    }catch(Exception $e){
        die("Error de la conexion: ".$e->getMessage());
    }

    function add($valor){
        $db->exec("INSERT INTO carrito(usuario) VALUES($valor)");
    }

    function del($tabla, $id){
        $db->exec("DELETE FROM $tabla WHERE id = $id");
    }

    function updt($tabla, $campo, $valor, $id){
        $db->exec("UPDATE $tabla SET $campo = $valor WHERE id = $id");
    }
?>

