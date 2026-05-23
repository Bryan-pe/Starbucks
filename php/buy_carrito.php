<?php
include("conexion.php");

if(isset($_POST['comprar'])){
    if(isset($_SESSION['id_usuario'])){
        $id_user = $_SESSION['id_usuario'];
        $carri = $db->query("SELECT * FROM carrito WHERE usuario = $id_user AND estado = 'abierto'")->fetchArray();

        $idCarrito = $carri["id"];

        $prods = $db->query("SELECT * FROM carrito_det JOIN bebidas ON carrito_det.bebida = bebidas.id WHERE carrito_det.carrito = $idCarrito");

        $total = 0;

        while($fila = $prods->fetchArray()){
            $total += $fila["precio_n"] * $fila["cant"];
        }

        $db->exec("INSERT INTO compra(usuario, total) VALUES($id_user, $total)");

        $idCompra = $db->lastInsertRowID();

        while($fila = $prods->fetchArray()){

            $producto = $fila["bebida"];
            $cantidad = $fila["cant"];
            $precio = $fila["precio_n"];

            $db->exec("INSERT INTO compra_det(compra,bebida,cant,precio) VALUES($idCompra,$producto,$cantidad,$precio)");
        }

        $db->exec("UPDATE carrito SET estado = 'comprado' WHERE id = $idCarrito");
    }
}
?>