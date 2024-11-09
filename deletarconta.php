<?php
session_start();

include('conexao.php');

$mensagem = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verificar se o email e a senha correspondem a um registro no banco de dados
    $sql = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':email', $email); // Alterado para 'nome'
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Usuário encontrado, proceder com a exclusão
        $nome_usuario = $user['nome']; // Alterado para 'nome'
        $email_usuario = $user['email']; // Adicionado

        // Excluir o registro associado ao nome e email
        $sqlDelete = "DELETE FROM usuarios WHERE nome = :nome_usuario AND email = :email_usuario";
        $stmtDelete = $conexao->prepare($sqlDelete);
        $stmtDelete->bindParam(':nome_usuario', $nome_usuario);
        $stmtDelete->bindParam(':email_usuario', $email_usuario);

        if ($stmtDelete->execute()) {
            // Exclusão bem-sucedida
            $mensagem = "Conta excluída com sucesso.";
        } else {
            // Erro ao excluir
            $mensagem = "Erro ao excluir a conta.";
        }
    } else {
        // Usuário não encontrado, mensagem de erro
        $mensagem = "Credenciais inválidas. Verifique seu e-mail e senha.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Conta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px; /* Espaço entre o título e o formulário */
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #ff0000; /* Cor de fundo vermelha para indicar exclusão de conta */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #cc0000;
        }

        #Ilx {
            background-color: #ff0000; /* Cor de fundo vermelha para indicar exclusão de conta */
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            width: 10%;
            justify-content: center;
        }

        #Ilx:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
<p><?php echo $mensagem; ?></p>
    <h1>Excluir Conta</h1>
    <form action="" method="post">
        <a id="Ilx" href="index.html">Voltar</a>
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <input type="submit" value="Excluir Conta">
    </form>
</body>
</html>