<?php
include("conexion.php");

if(isset($_POST['login'])){
    $gmail = $_POST['email'];
    $pass = $_POST['pass'];

    $temp = $db->prepare("SELECT * FROM usuarios WHERE gmail = :gmail");
    $temp->bindValue(":gmail", $gmail);
    $busca = $temp->execute();
    $user = $busca->fetchArray(); //SQLITE3_ASSOC

    if($user && $pass == $user['pass']){ //password_verify($pass, $user['pass']))
        // guardar sesión
        $_SESSION['id_usuario'] = $user['id'];
        $_SESSION['usuario'] = $user['user'];

        header("Location: index.php");
        exit;
    } else {
        echo "Usuario o contraseña incorrectos";
    }
}


//$usuario = "steph";
//$pass = "1234";
if(isset($_POST['registrar'])){
    $nombre = $_POST['nom'];
    $ap = $_POST['ap'];
    $gmail = $_POST['email'];
    $pass = $_POST['pass'];

    $buscar = $db->query("SELECT * FROM usuarios WHERE gmail = $gmail");
    $user = $buscar->fetchArray();
    if(!$user){
        // encriptar password
        //$passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $db->exec("INSERT INTO usuarios(nom, ap, gmail, pass) VALUES('$nom', '$ap', '$gmail', '$pass')");

        echo "Usuario creado";
        //header("Location: login.php")
    }else{
        echo "Correo ya registrado";
        exit;
    } 
}

?>

<?php

//session_start();

//if(!isset($_SESSION['id_usuario']))
//{
//    header("Location: login.php");
//    exit;
//}

//echo "Hola " . $_SESSION['usuario'];

?>

<?php
if(isset($_GET['cerrar'])){
    session_start();
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}
?>