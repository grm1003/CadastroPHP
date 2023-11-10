<!DOCTYPE html>
<html>
<head>
    <title>Aprendendo PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="POST" class="col-sm-12 col-md-8 col-xl-6 container center box-input">
            <div class="form-floating mb-3"> 
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="111111111">
                <label for="floatingInput">CPF</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                <label for="floatingPassword">Senha</label>
            </div>
            <div class="d-flex justify-content-center">
            <input class="botao" type="submit" value="Entrar"/>
            </div>
        </form>
        <div class="d-flex justify-content-center ">
            <form  action="cadastro.php" method="post">
                <input class="botao" type="submit" value="Cadastrar">
            </form>
        </div>
<?php
    session_start();
    if(isset($_POST["usuario"]) && isset($_POST["senha"])) {
        require_once "conexao.php";
        require_once "UsuarioEntidade.php";
        
        $conn = new Conexao();

        $sql = "SELECT * FROM usuarios WHERE cpf = ? and senha = ?";
        $stmt = $conn->conexao->prepare( $sql );

        $stmt->bindParam(1, $_POST["usuario"]);
        $stmt->bindParam(2, $_POST["senha"]);

        $resultado = $stmt->execute();

        if($stmt->rowCount() == 1) {

            $usuario = new UsuarioEntidade();
            
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $usuario->setCpf($rs->cpf);
                $usuario->setNome($rs->nome);
            }

            $_SESSION["login"] = "1";
            $_SESSION["usuario"] = $usuario;
            header("Location: home.php");
        }
        else {
            echo "Usuário ou senha inválidos";
        }
    }
?>
</body>
</html>