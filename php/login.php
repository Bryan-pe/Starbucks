<?php
session_start();
if(isset($_SESSION['id_usuario'])){
    header("Location: index.php");
    exit;
}
include("conexion.php");
include("login_registro.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="shortcut icon" href="../css/logo.svg">
    <link rel="stylesheet" href="../css/login.css">
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
                        <a class="nav-a" href="#"><img src="../icons/menu.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section class="barra-ver">
        <div id="login-t" class="caja-t">
            <h2>Ingresa a tu cuenta</h2>
        </div>
        <div id="reg-t" class="caja-t" style="display: none;">
            <h2>Registro</h2>
        </div>
    </section>
    <main class="caja">
        <div class="cont"> 
            <div id="login"> <!--login-->
                <form method="POST">
                    <div class="campo">
                        <label>Email</label>
                        <input type="email" placeholder="Email*" name="email" id="login_email" required>
                    </div>
                    <div class="campo">
                        <label>Contraseña</label>
                        <input type="password" placeholder="Contraseña*" name="pass" id="login_pass" required>
                    </div>

                    <button type="submit" name="login">Ingresar</button>
                    <button type="button" onclick="reg()">Crear cuenta</button>
                </form>
            </div>
            <div id="reg" style="display: none;"> <!--registro-->
                <h2>Información personal <span>(*) campos obligatorios</span></h2>
                <p>¡Regístrate y comienza a vivir la experiencia Starbucks Reward!</p>
                <form method="POST">
                    <div class="campo">
                        <label>Nombre(s)</label>
                        <input type="text" placeholder="Nombre(s)*" name="nom" id="nombre" required>
                    </div>
                    <div class="campo">
                        <label>Apellido paterno</label>
                        <input type="text" placeholder="Apellido paterno*" name="ap" id="apellido" required>
                    </div>
                    <div class="campo">
                        <label>Email</label>
                        <input type="email" placeholder="Email*" name="email" id="email" required>
                    </div>
                    <div class="campo">
                        <label>Contraseña</label>
                        <input type="password" placeholder="Contraseña*" name="pass" id="pass" required>
                    </div>
                    <button type="submit" name="registrar">Registrarse</button>
                    <button type="button" onclick="log()">Ya tengo cuenta</button>
                </form>
            </div>
            <div id="msg"></div>
        </div>
        <script src="../js/auth_user.js"></script>
        <script src="../js/css_login.js"></script> <!--el css no ocultaba el registro-->
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