<!DOCTYPE html>
<html>
<head>
    <title>Aprendendo PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

        <form action="" method="POST" class="col-sm-12 col-md-8 col-xl-6 container center">
            <div class="form-floating mb-3"> 
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="111111111">
                <label for="floatingInput">CPF</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                <label for="floatingInput">Nome</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                <label for="floatingPassword">Senha</label>
            </div>
            <input type="submit" value="Cadastrar"/>
        </form>
        <form action="login.php" method="post">
        <input type="submit" value="Login">
         </form>
        

        <?php
session_start();


    require_once "conexao.php";

    $conn = new Conexao();

    $verificarUsuarioSql = "SELECT * FROM usuarios WHERE cpf = ?";
    $verificarUsuarioStmt = $conn->conexao->prepare($verificarUsuarioSql);
    $verificarUsuarioStmt->bindParam(1, $_POST["usuario"]);
    $verificarUsuarioStmt->execute();

    if ($verificarUsuarioStmt->rowCount() > 0) {
        echo "Usuário já cadastrado. Escolha outro nome de usuário.";
    } else {
        $cadastrarUsuarioSql = "INSERT INTO usuarios (cpf,nome, senha) VALUES (?, ?, ?)";
        $cadastrarUsuarioStmt = $conn->conexao->prepare($cadastrarUsuarioSql);


        $cadastrarUsuarioStmt->bindParam(1, $_POST["usuario"]);
        $cadastrarUsuarioStmt->bindParam(2, $_POST["nome"]);
        $cadastrarUsuarioStmt->bindParam(3, $_POST["senha"]);

        $cadastrarUsuarioStmt->execute();

        echo "Cadastro realizado com sucesso. Faça o login agora.";
    }

?>
</body>
</html>