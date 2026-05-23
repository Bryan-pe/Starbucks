<?php
include("conexion.php");
if(isset($_POST['login'])){
    $gmail = $_POST['email'];
    $pass = $_POST['pass'];

    $temp = $db->prepare("SELECT * FROM usuarios WHERE gmail = :gmail");
    $temp->bindValue(":gmail", $gmail);
    $busca = $temp->execute();
    $user = $busca->fetchArray();

    if($user && $pass == $user['pass']){
        // guardar sesión
        $_SESSION['id_usuario'] = $user['id'];
        $_SESSION['usuario'] = $user['user'];

        header("Location: index.php");
        exit;
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}

if(isset($_POST['registrar'])){
    $nombre = $_POST['nom'];
    $ap = $_POST['ap'];
    $gmail = $_POST['email'];
    $pass = $_POST['pass'];

    $buscar = $db->query("SELECT * FROM usuarios WHERE gmail = $gmail");
    $user = $buscar->fetchArray();
    if(!$user){
        $db->exec("INSERT INTO usuarios(nom, ap, gmail, pass) VALUES('$nom', '$ap', '$gmail', '$pass')");
        //echo "Usuario creado";
    } else {
        echo "Correo ya registrado";
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