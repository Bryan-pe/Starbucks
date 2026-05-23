<?php
include("conexion.php");

if(isset($_POST['login'])){
    $gmail = $_POST['email'];
    $pass = $_POST['pass'];

    $temp = $db->prepare("SELECT * FROM usuarios WHERE gmail = :gmail");
    $temp->bindValue(":gmail", $gmail);
    $buscar = $temp->execute();
    $user = $buscar->fetchArray();

    if($user && $pass == $user['pass']){
        // guardar sesión
        $_SESSION['id_usuario'] = $user['id'];
        $_SESSION['usuario'] = $user['user'];

        header("Location: index.php");
        exit;
    } else {
        echo "Usuario o contraseña incorrectos";
        //echo "<script> msg('Usuario o contraseña incorrectos', 'error'); <script>";
        exit;
    }
}

if(isset($_POST['registrar'])){
    $usuario = $_POST['nom'];
    $ap = $_POST['ap'];
    $gmail = $_POST['email'];
    $pass = $_POST['pass'];

    $temp = $db->prepare("SELECT * FROM usuarios WHERE gmail = :gmail");
    $temp->bindValue(":gmail", $gmail);
    $buscar = $temp->execute();
    $user = $buscar->fetchArray();
    if(!$user){
        $db->exec("INSERT INTO usuarios(user, ap, gmail, pass) VALUES('$usuario', '$ap', '$gmail', '$pass')");
        //echo "Usuario registrado correctamente";
        //echo "<script> msg('Usuario registrado correctamente', 'good'); <script>";
        exit;
    } else {
        echo "Correo ya registrado";
        //echo "<script> msg('Correo ya registrado', 'error'); <script>";
        exit;
    } 
}

if(isset($_GET['cerrar'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>