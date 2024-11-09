<?php
    // Exibe mensagens de erro, se presente
    if (isset($_GET['erro'])) {
        echo '<p style="color: red;">' . $_GET['erro'] . '</p>';
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style/styleC.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        input[type="text"], input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .radio-group {
            margin-bottom: 10px;
        }

        .radio-group label {
            display: inline-block;
            margin-right: 10px;
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
        #doildo{
            text-decoration: none;
             border: none;
             cursor: pointer;
             font-size: 17px;
             margin-top: 10px;
        }
        #doildo:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Registrar-se</h1>
    <form name="cad-usuario" action="servidor.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>

        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required>

      

        <input type="submit" value="Registrar">
        
    </form>
    <a id="doildo" href="login.php">Ja tenho Conta</a>
</body>
</html>