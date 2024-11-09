<?php
include('conexao.php');

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if ($nome != null && $email != null && $senha != null) {
    // Verifica se o email já existe no banco de dados
    $verificarEmail = $conexao->prepare("SELECT email FROM usuarios WHERE email = :email");
    $verificarEmail->bindParam(':email', $email);
    $verificarEmail->execute();

    if ($verificarEmail->rowCount() == 0) {
        // O email não existe, pode prosseguir com o registro
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        if ($conexao->exec($sql)) {
            echo "Registro salvo com sucesso";
            header("Location: login.php");
        } else {
            echo "Erro ao salvar registro.";
        }
    } else {
        // O email já existe, exiba uma mensagem de erro
        header("Location: cadastro.php?erro=Este email já está registrado. Por favor, escolha outro.");
    }
} else {
    echo "Por favor, preencha todos os campos.";
}
?>



  





