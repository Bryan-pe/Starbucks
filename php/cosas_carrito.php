<?php
include("conexion.php");

if(isset($_POST["agregar"])){ //agrega el producto al carrito
    if(isset($_SESSION['id_usuario'])){
        $id_prod = $_GET["id"];
        $id_user = $_SESSION['id_usuario'];
        $carrito = $db->query("SELECT * FROM carrito WHERE usuario = $id_user AND estado = 'abierto'")->fetchArray();

        if(!$carrito){ //si el usuario ya tiene un carrito se usa el mismo
            $db->exec("INSERT INTO carrito(usuario, estado) VALUES($id_user, 'abierto')");
            $id_carrito = $db->lastInsertRowID();
        }else{
            $id_carrito = $carrito["id"];
        }
    
        $db->exec("INSERT INTO carrito_det(carrito, bebida) VALUES($id_carrito, $id_prod)"); //guarda los detalles del producto en el carrito
        $_SESSION['good'] = 'Agregado al carrito';
    } else {
        header("Location: login.php");
        exit;
    }
}

if(isset($_POST['comprar'])){
    if(isset($_SESSION['id_usuario'])){
        $id_user = $_SESSION['id_usuario'];
        $carrito_abierto = $db->query("SELECT * FROM carrito WHERE usuario = $id_user AND estado = 'abierto'")->fetchArray(); //busca el carrito del usuario
        $id_carrito = $carrito_abierto["id"];

        $prods = $db->query("SELECT * FROM carrito_det cd JOIN bebidas b ON cd.bebida = b.id WHERE carrito = $id_carrito"); //busca los productos del carrito
        $total = 0;

        while($datos = $prods->fetchArray()){ //suma el total a pagar por los productos
            $total += $datos["precio_n"] * $datos["cant"];
        }

        $db->exec("INSERT INTO compra(usuario, total) VALUES($id_user, $total)");
        $id_compra = $db->lastInsertRowID();

        while($datos = $prods->fetchArray()){ //registra los productos que fueron comprados
            $bebida = $datos["bebida"];
            $cantidad = $datos["cant"];
            $precio = $datos["precio_n"];

            $db->exec("INSERT INTO compra_det(compra, bebida, cant, precio) VALUES($id_compra, $bebida, $cantidad, $precio)");
        }
        $db->exec("UPDATE carrito SET estado = 'comprado' WHERE id = $id_carrito");
        $_SESSION['good'] = 'Carrito comprado';
    }
    header("Location: carrito.php");
    exit;
}

if(isset($_POST['mas'])){ //agregar mas
    $id_car = $_POST['id_carrito'];

    $res = $db->query("SELECT cant FROM carrito_det WHERE id_carrito_det = $id_car");
    $prod = $res->fetchArray();
    $cant = $prod['cant'];
    $cant++;

    $db->exec("UPDATE carrito_det SET cant = $cant WHERE id_carrito_det = $id_car");
}

if(isset($_POST['menos'])){ //quitar o eliminar
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