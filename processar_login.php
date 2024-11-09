<?php
session_start();

include('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Usuário encontrado, o usuário está autenticado
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['usuarioAutenticado'] = true;
        header("Location: index.html?login=1");

        
    } else {
        header("Location: login.php?erro=Essa conta nao existe.");
    }
}
?>