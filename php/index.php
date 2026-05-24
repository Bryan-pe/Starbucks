<?php
session_start();
include("conexion.php");
if(isset($_SESSION['id_usuario'])){
    $id_user = $_SESSION['id_usuario'];
    $cuantos = $db->query("SELECT sum(cant) FROM carrito_det cd JOIN carrito c on cd.carrito = c.id WHERE estado = 'abierto' AND usuario = $id_user");
    $en_carrito = $cuantos->fetchArray();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/estilos.css">
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
                        <?php if(isset($_SESSION['id_usuario'])){ ?> <!-- si el usuario esta logueado el boton de ingresar cambia a cerrar sesion -->
                            <a class="btn-w" href="login_registro.php?cerrar=logout">Cerrar sesion</a>
                        <?php } else { ?>
                            <a class="btn-w" href="login.php" id="login_link">Ingresar</a>
                        <?php } ?>
                        <a class="btn-b" href="#">Únete</a>
                        <span class="carrito-icono" >
                            <?php if(isset($_SESSION['id_usuario'])){ ?> <!-- si el usuario esta logueado se vera cunatos articulos hay en el carrito -->
                                <a class="nav-a" href="carrito.php">
                                    <img src="../icons/carrito.png">
                                    <span id="contador-carrito" class="contador"><?php echo $en_carrito['sum(cant)'] ?? 0; ?></span>
                                </a>
                            <?php } else { ?>
                                <a class="nav-a" href="carrito.php"><img src="../icons/carrito.png"></a>
                            <?php } ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="caja">
        <div class="cont-main"> <!--cosa donde van las tarjetas-->
            <div class="card" id="card1"> <!--1ra tarjeta-->
                <div class="img">
                    <img src="../img/cafe1.jpg">
                </div>
                <div class="text-cont">
                    <div class="text">
                        <h2>¡Hola PROteína!</h2>
                        <p>Dale un plus a tus días con un Vainilla Protein Latte, Vainilla Sin Azúcar Protein Latte o un Matcha Protein Latte, helado o caliente.</p>
                        <a href="#">Descubre mas</a>
                    </div>
                </div>
            </div>
            <div class="card reverse" id="card2"> <!--2da tarjeta-->
                <div class="img">
                    <img src="../img/cafe2.jpg">
                </div>
                <div class="text-cont">
                    <div class="text">
                        <h2>Un regreso que sabe a Lavanda</h2>
                        <p>¡Tus favoritos regresaron! Ven por tu Lavanda Latte, Lavanda Latte Helado, Lavanda Frappuccino, Matcha Helado con Lavanda Cold Foam, 
                            Mocha Blanco Lavanda Frappuccino y Vainilla Lavanda Latte.</p>
                    </div>
                </div>
            </div>
            <div class="card" id="card3"> <!--3ra tarjeta-->
                <div class="img">
                    <img src="../img/cafe3.jpg">
                </div>
                <div class="text-cont">
                    <div class="text">
                        <h2>Recompensas todo el año</h2>
                        <p>Sé parte de las recompensas que te da tu bebida favorita. Obtén más café gratis, promociones exclusivas, accesos a productos antes que nadie y más.</p>
                    </div>
                </div>
            </div>
            <div class="card reverse" id="card4"> <!--4ta tarjeta-->
                <div class="img">
                    <img src="../img/cafe4.jpg">
                </div>
                <div class="text-cont">
                    <div class="text">
                        <h2>¡Tus vasos y termos son bienvenidos!</h2>
                        <p>Cada vez que eliges llevar tu vaso o termo para tomar tus bebidas obtienes $8 de descuento y ayudas a cuidar el planeta.</p>
                    </div>
                </div>
            </div>
            <div class="cont-card" >
                <div class="card-info" id="card5">
                    <div class="borde" id="borde1">
                        <h2>Noticias<br><strong>Starbucks</strong></h2>
                    </div>
                    <p>Consulta los eventos más <br>recientes.</p>
                    <a class="btn-v" href="#">Aqui</a>
                </div>
                <div class="card-info" id="card6">
                    <div class="borde" id="borde2">
                        <h2>Conoce nuestras<br><strong>Promociones</strong></h2>
                    </div>
                    <p>Términos y <br>condiciones.</p>
                    <a class="btn-c" href="#">Ver mas</a>
                </div>
            </div>
        </div>
        <script src="../js/log_user.js"></script>
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