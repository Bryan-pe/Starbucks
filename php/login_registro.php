<?php
include("conexion.php");

if(isset($_POST['login'])){
    $gmail = $_POST['email'];
    $pass = $_POST['pass'];

    $temp = $db->prepare("SELECT * FROM usuarios WHERE gmail = :gmail");
    $temp->bindValue(":gmail", $gmail);
    $buscar = $temp->execute();
    $user = $buscar->fetchArray();

    if($user && $pass == $user['pass']){ //busca si existe el usuario y en caso de que si, revisa si la contraseña es correcta
        // guardar sesión
        $_SESSION['id_usuario'] = $user['id'];
        $_SESSION['usuario'] = $user['user'];

        header("Location: index.php");
        exit;
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrectos';
    }
    header("Location: login.php");
    exit;
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
    if(!$user){ //si no existe el correo se registra al usuario
        $db->exec("INSERT INTO usuarios(user, ap, gmail, pass) VALUES('$usuario', '$ap', '$gmail', '$pass')");
        $_SESSION['good'] = 'Usuario registrado correctamente';
    } else {
        $_SESSION['error'] = 'Correo ya registrado';
    }
    header("Location: login.php");
    exit;
}

if(isset($_GET['cerrar'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>