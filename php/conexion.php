<?php
try {
    $db = new SQLite3("../db/starbucks_db");
}catch(Exception $e){
    die("Error de la conexion: ".$e->getMessage());
}
?>

