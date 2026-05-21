<?php
include("conexion.php");

$usuario = 1;

if(isset($_POST['comprar'])){
$carrito = $db->query("SELECT * FROM carrito WHERE usuario = $usuario AND estado = 'abierto'")->fetchArray();

$idCarrito = $carrito["id"];

$prods = $db->query("SELECT * FROM carrito_det JOIN bebidas ON carrito_det.bebida = bebidas.id WHERE carrito_det.carrito = $idCarrito");

$total = 0;

while($fila = $prods->fetchArray()){
    $total += $fila["precio_n"] * $fila["cant"];
}

$db->exec("INSERT INTO compra(usuario, total) VALUES($usuario, $total)");

$idCompra = $db->lastInsertRowID();

while($fila = $prods->fetchArray()){

    $producto = $fila["bebida"];
    $cantidad = $fila["cant"];
    $precio = $fila["precio_n"];

    $db->exec("INSERT INTO compra_det(compra,bebida,cant,precio) VALUES($idCompra,$producto,$cantidad,$precio)");
}

$db->exec("UPDATE carrito SET estado = 'comprado' WHERE id = $idCarrito");
}
?>