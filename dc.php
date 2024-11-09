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

<p><?php echo $mensagem; ?></p>