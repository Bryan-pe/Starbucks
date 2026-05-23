<?php
include("conexion.php");

if(isset($_POST["agregar"])){
    if(isset($_SESSION['id_usuario'])){
        $id_prod = $_GET["id"];
        $id_user = $_SESSION['id_usuario'];
        $carrito = $db->query("SELECT * FROM carrito WHERE usuario = $id_user AND estado = 'abierto'")->fetchArray();

        if(!$carrito){
            $db->exec("INSERT INTO carrito(usuario, estado) VALUES($id_user, 'abierto')");
            $id_carrito = $db->lastInsertRowID();
        }else{
            $id_carrito = $carrito["id"];
        }
    
        $db->exec("INSERT INTO carrito_det(carrito, bebida) VALUES($id_carrito, $id_prod)");
        //echo "<script> msg('Agregado al carrito', 'good'); <script>";
    } else {
        header("Location: login.php");
        exit;
    }
}

if(isset($_POST['comprar'])){
    if(isset($_SESSION['id_usuario'])){

        $id_user = $_SESSION['id_usuario'];
        $carrito_abierto = $db->query("SELECT * FROM carrito WHERE usuario = $id_user AND estado = 'abierto'")->fetchArray();
        $id_carrito = $carrito_abierto["id"];
        $prods = $db->query("SELECT * FROM carrito_det cd JOIN bebidas b ON cd.bebida = b.id WHERE carrito = $id_carrito");
        $total = 0;

        while($datos = $prods->fetchArray()){
            $total += $datos["precio_n"] * $datos["cant"];
        }

        $db->exec("INSERT INTO compra(usuario, total) VALUES($id_user, $total)");
        $id_compra = $db->lastInsertRowID();

        while($datos = $prods->fetchArray()){

            $bebida = $datos["bebida"];
            $cantidad = $datos["cant"];
            $precio = $datos["precio_n"];

            $db->exec("INSERT INTO compra_det(compra, bebida, cant, precio) VALUES($id_compra, $bebida, $cantidad, $precio)");
        }
        $db->exec("UPDATE carrito SET estado = 'comprado' WHERE id = $id_carrito");
        //echo "<script> msg('Carrito comprado', 'good'); <script>";
    }
}

if(isset($_POST['mas'])){ //$accion == "mas"
    $id_car = $_POST['id_carrito'];

    $res = $db->query("SELECT cant FROM carrito_det WHERE id_carrito_det = $id_car");
    $prod = $res->fetchArray();
    $cant = $prod['cant'];
    $cant++;

    $db->exec("UPDATE carrito_det SET cant = $cant WHERE id_carrito_det = $id_car");
}

if(isset($_POST['menos'])){ //$accion == "menos"
    $id_car = $_POST['id_carrito'];

    $res = $db->query("SELECT cant FROM carrito_det WHERE id_carrito_det = $id_car");
    $prod = $res->fetchArray();
    $cant = $prod['cant'];
    $cant--;

    if($cant < 1){
        $db->exec("DELETE FROM carrito_det WHERE id_carrito_det = $id_car");
    } else {
        $db->exec("UPDATE carrito_det SET cant = $cant WHERE id_carrito_det = $id_car");
    }
}
?>