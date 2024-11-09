<?php
include('conexao.php');

// Defina variáveis iniciais
$mensagem = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se a chave 'nome', 'senha' e 'novo_email' existem em $_POST
    $nome = isset($_POST['nome']) ? $_POST['nome'] : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
    $novo_email = isset($_POST['novo_email']) ? $_POST['novo_email'] : null;

    // Verificar se todas as variáveis necessárias foram fornecidas
    if ($nome !== null && $senha !== null && $novo_email !== null) {
        try {
            // Verificar se o 'nome' e a 'senha' correspondem a um registro no banco de dados
            $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE nome = :nome AND senha = :senha");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':senha', $senha);
            $stmt->execute();

            // Se encontrar um registro, realizar a atualização do e-mail
            if ($stmt->rowCount() > 0) {
                $stmt = $conexao->prepare("UPDATE usuarios SET email = :novo_email WHERE nome = :nome");
                $stmt->bindParam(':novo_email', $novo_email);
                $stmt->bindParam(':nome', $nome);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $mensagem = "E-mail alterado com sucesso!";
                } else {
                    $mensagem = "Nenhum dado alterado. Verifique se o novo e-mail é diferente do atual.";
                }
            } else {
                $mensagem = "Nome e/ou senha incorretos. Alteração de e-mail não realizada.";
            }
        } catch (PDOException $e) {
            $mensagem = "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    } else {
        $mensagem = "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            text-align: center;
            color: #007bff; /* Azul */
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff; /* Azul */
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; /* Azul mais escuro */
        }
    </style>
</head>
<body>
<p><?php echo $mensagem; ?></p>
<h1>Alterar email</h1>

<!-- Formulário para alterar a senha -->
<form action="" method="post">
        <label for="Nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

        <label for="novo_email">Novo E-mail:</label>
        <input type="email" id="novo_email" name="novo_email" required>

        <input type="submit" value="Alterar E-mail">

        <a href="login.php" class="btn-voltar">Voltar para Login</a>
</form>
</body>
</html>