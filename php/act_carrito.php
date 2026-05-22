<?php
include("conexion.php");

$id_car = $_POST['id_carrito'];
$accion = $_POST['accion'];

$res = $db->query("SELECT cant FROM carrito_det WHERE id_carrito_det = $id_car");
$prod = $res->fetchArray(SQLITE3_ASSOC);

$cant = $prod['cant'];

if($accion == "mas"){ //sumar
    $cant++;

    $db->exec("UPDATE carrito_det SET cant = $cant WHERE id_carrito_det = $id_car");
}

if($accion == "menos"){ //restar
    $cant--;

    if($cant < 1){
        $db->exec("DELETE FROM carrito_det WHERE id_carrito_det = $id_car");
    } else {
        $db->exec("UPDATE carrito_det SET cant = $cant WHERE id_carrito_det = $id_car");
    }
}

header("Location: carrito.php");
?>