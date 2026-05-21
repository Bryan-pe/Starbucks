<?php
include("conexion.php");

$usuario = 1;

// ID del producto actual
$idProducto = $_GET["id"];

if(isset($_POST["agregar"])){

    // Buscar carrito existente
    $carrito = $db->query("SELECT * FROM carrito WHERE usuario = $usuario AND estado = 'abierto'")->fetchArray();
    //$carrito = $buscar->fetchArray();

    // Si NO existe carrito
    if(!$carrito){

        $db->exec("INSERT INTO carrito(usuario,estado) VALUES($usuario,'abierto')");
        $idCarrito = $db->lastInsertRowID();

    }else{

        // usar carrito existente
        $idCarrito = $carrito["id"];
    }


    // insertar producto
   
    $db->exec("INSERT INTO carrito_det(carrito, bebida) VALUES($idCarrito, $idProducto)");
    
    
}
?>