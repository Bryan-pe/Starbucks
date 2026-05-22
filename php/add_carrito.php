<?php
include("conexion.php");

$usuario = 1; //esto es temporal

$idProducto = $_GET["id"];

if(isset($_POST["agregar"])){
    $carrito = $db->query("SELECT * FROM carrito WHERE usuario = $usuario AND estado = 'abierto'")->fetchArray();

    if(!$carrito){
        $db->exec("INSERT INTO carrito(usuario,estado) VALUES($usuario,'abierto')");
        $idCarrito = $db->lastInsertRowID();
    }else{
        $idCarrito = $carrito["id"];
    }
   
    $db->exec("INSERT INTO carrito_det(carrito, bebida) VALUES($idCarrito, $idProducto)");
}
?>
