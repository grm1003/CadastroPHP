<?php
    require_once "UsuarioEntidade.php";
    session_start();
    if(!isset($_SESSION["login"]) || $_SESSION["login"] != "1") {
        header("Location: login.php");
    }
    else {
        $usuario = $_SESSION["usuario"];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Aprendendo PHP</title>
</head>
<body>
    <h1>Ola, <?= $usuario->getNome();?>!!!</h1>
    <form action="" method="POST">
        <input type="submit" value="Sair"/>
    </form>
    <form action="" method="GET">
        <input type="submit" value="Lista Usuarios"/>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            session_destroy();
            header("Location: login.php");
        }
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            session_destroy();
            header("Location: tabela-usuarios.php");
        }
    ?>
</body>
</html>