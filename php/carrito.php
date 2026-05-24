<?php
session_start();
if(!isset($_SESSION['id_usuario'])){
    header("Location: login.php");
    exit;
}
include("conexion.php");
include("cosas_carrito.php");
$id_user = $_SESSION['id_usuario'];
$carrito = $db->query("SELECT * FROM carrito_det cd JOIN bebidas b ON cd.bebida = b.id JOIN size s ON b.size_id = s.id JOIN carrito c on cd.carrito = c.id WHERE estado = 'abierto' AND usuario = $id_user");
$todo=0;

$cuantos = $db->query("SELECT sum(cant) FROM carrito_det cd JOIN carrito c on cd.carrito = c.id WHERE estado = 'abierto' AND usuario = $id_user");
$en_carrito = $cuantos->fetchArray();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/carrito.css">
    <link rel="shortcut icon" href="../css/logo.svg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starbucks</title>
</head>
<body>
    <header class="caja"> <!--navegador-->
        <div class="cont">
            <div class="logo-header">
                <a href="index.php" class="logo">logo</a>
                <div class="main-menu">
                    <div class="menu"> <!-- parte de la izquierda -->
                        <a class="nav-a parte-izq" href="menu.php">MENU</a>
                        <a class="nav-a parte-izq" href="#">REWARDS</a>
                    </div>
                    <div class="menu"> <!-- parte de la derecha -->
                        <a class="nav-a" href="#"><img src="../icons/maps.png"> Localizar Tienda</a>
                        <a class="btn-w" href="login_registro.php?cerrar=logout">Cerrar sesion</a>
                        <a class="btn-b" href="#">Únete</a>
                        <span class="carrito-icono" >
                            <a class="nav-a" href="carrito.php">
                                <img src="../icons/carrito.png">
                                <span id="contador-carrito" class="contador"><?php echo $en_carrito['sum(cant)'] ?? 0; ?></span>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="barra-ver">
        <h2>Carrito</h2><img class="img-t" src="../icons/carrito2.png">
    </section>
    <main class="caja">
        <div class="cont">
            <?php while($prod = $carrito->fetchArray()){ ?> <!-- productos que hay en el carrito -->
            <div class="prod">
                <div class="circulo">
                    <img src="<?php echo $prod['img'] ?>">
                </div>
                <div class="info">
                    <h2><?php echo $prod['nom'] ?></h2>
                    <p>Tamaño: <?php echo $prod['size'] ?></p>
                    <p>Crema batida: <?php echo $prod['crema'] ?></p>
                    <p>Tipo de leche: <?php echo $prod['leche'] ?></p>
                    <p>Tipo de Frappuccino: <?php echo $prod['frapp'] ?></p>
                    <div class="precio">
                        <span class="nuevo">$<?php echo $prod['precio_n'] ?></span>
                        <?php $todo += $prod['precio_n'] * $prod['cant']; ?>
                        <span class="viejo">$<?php echo $prod['precio_v'] ?></span>
                    </div>
                </div>
                <div class="controles">
                    <div class="cant">

                        <form method="POST" >
                            <input type="hidden" name="id_carrito" value="<?php echo $prod['id_carrito_det'] ?>">
                            <button type="submit" name="menos">-</button>
                        </form>

                        <span><?php echo $prod['cant'] ?></span>

                        <form method="POST" >
                            <input type="hidden" name="id_carrito" value="<?php echo $prod['id_carrito_det'] ?>">
                            <button type="submit" name="mas">+</button>
                        </form>

                    </div>
                </div>
            </div>
            <?php } 
            if($todo>0){ ?> <!-- en caso de no tener articulos en el carrito mostrara un boton para ir al menu -->
                <p class="nuevo" style="margin-left: 82%; font-size: 25px; margin-bottom: 5px;">Total: $<?php echo $todo ?></p>
                <form method="POST">
                    <button type="submit" name="comprar" class="agregar" style="margin-left: 80%;">Comprar artículos</button>
                </form>
            <?php } else { ?>
                <a class="agregar" style="margin-left: 80%;" href="menu.php">+ Agregar articulos</a>
            <?php } ?>
            <script src="../js/error.js"></script>
            <?php if(isset($_SESSION['good'])){ $texto = $_SESSION['good']; unset($_SESSION['good']);?> <!-- muestra un mensaje al comprar el carrito -->
                <div id="msg" class="show good"><?php echo $texto; ?></div>
            <?php } ?>
        </div>
        <script src="../js/log_user.js"></script>
        <script src="../js/error.js"></script>
    </main>
    <footer class="caja">
        <div class="cont">
            <div class="sobre-nos"> <!--sobre nosotros-->
                <div class="sobre-cont">
                    <div class="sobre-titulo">
                        <h2>Sobre Nosotros</h2>
                    </div>
                    <div class="sobre-text">
                        <ul>
                            <li><a href="#">Trabaja con nosotros</a></li>
                            <li><a href="#">Historia Starbucks</a></li>
                        </ul>
                    </div>
                </div>
                <div class="sobre-cont">
                    <div class="sobre-titulo">
                        <h2>Atencion al cliente</h2>
                    </div>
                    <div class="sobre-text">
                        <ul>
                            <li><a href="#">Contactanos</a></li>
                            <li><a href="#">Facturas Electronicas</a></li>
                            <li><a href="#">Formas de comprar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="mas redes"> <!--redes sociales-->
                <ul>
                    <li><a href="#"><img src="../icons/face.png"></a></li>
                    <li><a href="#"><img src="../icons/insta.png"></a></li>
                    <li><a href="#"><img src="../icons/x.png"></a></li>
                    <li><a href="#"><img src="../icons/you.png"></a></li>
                </ul>
            </div>
            <div class="mas"> <!--mas botones-->
                <ul>
                    <li><a href="#">Accesibilidad Web |</a></li>
                    <li><a href="#">Aviso de Privacidad |</a></li>
                    <li><a href="#">Boletines |</a></li>
                    <li><a href="#">Condiciones de uso |</a></li>
                    <li><a href="#">Mapa del sitio |</a></li>
                    <li><a href="#">Preferencias sobre cookies</a></li>
                </ul>   
            </div>
            <i class="fi fi-brands-instagram"></i>
            <div class="fin">
                <h3>Ⓒ 2026. Starbucks Cofee Company. Reservados todos los derechos</h3>
                <h4>mx | prod | b3d3e13c63662e161abbb818fa8f4625e24d7ba1 | 14/08/2025-06:08:38:579</h4>
            </div>
        </div>
    </footer>
</body>
</html>