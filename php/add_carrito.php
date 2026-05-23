<?php
include("conexion.php");

$idProducto = $_GET["id"];

if(isset($_POST["agregar"])){
    if(isset($_SESSION['id_usuario'])){
        $id_user = $_SESSION['id_usuario'];
        $carrito = $db->query("SELECT * FROM carrito WHERE usuario = $id_user AND estado = 'abierto'")->fetchArray();

        if(!$carrito){
            $db->exec("INSERT INTO carrito(usuario,estado) VALUES($id_user,'abierto')");
            $idCarrito = $db->lastInsertRowID();
        }else{
            $idCarrito = $carrito["id"];
        }
    
        $db->exec("INSERT INTO carrito_det(carrito, bebida) VALUES($idCarrito, $idProducto)");
    } else {
        header("Location: login.php");
        exit;
    }
}
?>
