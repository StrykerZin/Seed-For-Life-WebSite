<?php
    // Exibe mensagens de erro, se presente
    if (isset($_GET['erro'])) {
        echo '<p style="color: red;">' . $_GET['erro'] . '</p>';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Tela de login</title>
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
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        div{
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            text-decoration: none;
            font-family: sans-serif;
            gap: 10px;
            margin-bottom: 10px
                
        }

        #Il{
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
        }
        #Il:hover{
            background-color: #0056b3;
        }
        #Ilx{
            background-color: #007bff;
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


    </style>
</head>
<body>
    <h1>Login</h1>
    <form action="processar_login.php" method="post">
    <a id="Ilx" href="index.html">voltar </a>
        <label for="email">E-mail:</label>
        <input type="text" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>
        <div>
        <a id="botao2" href="mudar senha.php">Esqueci minha senha</a>
        <a id="botao2" href="mudar email.php">Esqueci Meu email</a>
        </div>

        <input type="submit" value="Login">
        <a id="Il" href="cadastro.php">Registrar-se</a>
        
        
    </form>
    
</body>
</html>

