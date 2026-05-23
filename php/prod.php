<?php
session_start();
include("conexion.php");
include("cosas_carrito.php");
$id = $_GET['id'];
$resul = $db->query("SELECT * FROM bebidas WHERE id = $id");
$prod = $resul->fetchArray();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/prod.css">
    <link rel="shortcut icon" href="../css/logo.svg">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $prod['nom']; ?></title>
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
                        <?php if(isset($_SESSION['id_usuario'])){ ?>
                            <a class="btn-w" href="login_registro.php?cerrar=logout">Cerrar sesion</a>
                        <?php } else { ?>
                            <a class="btn-w" href="login.php" id="login_link">Ingresar</a>
                        <?php } ?>
                        <a class="btn-b" href="#">Únete</a>
                        <a class="nav-a" href="carrito.php"><img src="../icons/carrito.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="caja">
        <div class="cont-prod">
            <img src="<?php echo $prod['img']; ?>">
            <div class="texto">
                <h1><?php echo $prod['nom']; ?></h1>
                <p><?php echo $prod['kcal']; ?> kcal <span class="info">i</span></p>
                <p class="nuevo">$<?php echo $prod['precio_n']; ?> | <span>$<?php echo $prod['precio_v']; ?></span></p>
                <form method="POST">
                    <button type="submit" name="agregar" class="agregar">+ Agregar artículo</button>
                </form>
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