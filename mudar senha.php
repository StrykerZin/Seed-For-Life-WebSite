<?php
include('conexao.php');

// Defina variáveis iniciais
$mensagem = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se as chaves 'email', 'nova_senha' e 'confirma_nova_senha' existem em $_POST
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $nova_senha = isset($_POST['nova_senha']) ? $_POST['nova_senha'] : null;
    $confirma_nova_senha = isset($_POST['confirma_nova_senha']) ? $_POST['confirma_nova_senha'] : null;

    // Verificar se todas as variáveis necessárias foram fornecidas
    if ($email !== null && $nova_senha !== null && $confirma_nova_senha !== null) {
        // Verificar se a nova senha e a confirmação são iguais
        if ($nova_senha === $confirma_nova_senha) {
            try {
                // Atualizar a senha no banco de dados
                $stmt = $conexao->prepare("UPDATE usuarios SET senha = :nova_senha WHERE email = :email");
                $stmt->bindParam(':nova_senha', $nova_senha);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $mensagem = "Senha alterada com sucesso!";
                } else {
                    $mensagem = "Nenhum dado alterado. Verifique se o e-mail está correto.";
                }
            } catch (PDOException $e) {
                $mensagem = "Erro ao conectar ao banco de dados: " . $e->getMessage();
            }
        } else {
            $mensagem = "A nova senha e a confirmação não coincidem.";
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
<h1>Alterar Senha</h1>

<!-- Formulário para alterar a senha -->
<form action="" method="post">
    <label for="Email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="nova_senha">Nova Senha:</label>
    <input type="password" id="nova_senha" name="nova_senha" required>

    <label for="confirma_nova_senha">Confirme a Nova Senha:</label>
    <input type="password" id="confirma_nova_senha" name="confirma_nova_senha" required>

    <input type="submit" value="Alterar Senha">
    <a href="login.php" class="btn-voltar">Voltar para Login</a>
</form>
</body>
</html>