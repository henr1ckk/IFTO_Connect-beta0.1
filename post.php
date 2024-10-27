<?php 
session_start();
require_once "conect.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['iduser'])) {
    $_SESSION['msg'] = "Login Necessário!";
    header('Location: index.php');
    exit;
}

if (isset($_POST['postagem'])) {
    $postagem = $_POST['postagem'];
    $usuarioid = $_SESSION['iduser'];
    $tipousuario = $_SESSION['tipousuario'];

    // Prepare a consulta SQL com base no tipo de usuário
    if ($tipousuario == 'aluno') {
        // Insere como aluno
        $sql = "INSERT INTO postagens (descricao, data, alunoid) VALUES ('$postagem', NOW(), '$usuarioid')";
    } elseif ($tipousuario == 'professor') {
        // Insere como professor
        $sql = "INSERT INTO postagens (descricao, data, profid) VALUES ('$postagem', NOW(), '$usuarioid')";
    } elseif ($tipousuario == 'admin') {
        // Se tiver um caso para administrador, adicione aqui
        $sql = "INSERT INTO postagens (descricao, data, adminsid) VALUES ('$postagem', NOW(), '$usuarioid')";
    } else {
        $_SESSION['msg'] = "Tipo de usuário inválido.";
        header('Location: postagem.php');
        exit;
    }

    // Tente executar a consulta
    if ($conect->query($sql) === TRUE) {
        header('Location: home.php');
        exit;
    } else {
        $_SESSION['msg'] = "Erro ao publicar: " . $conect->error; // Adiciona mensagem de erro
        header('Location: postagem.php');
        exit;
    }
} else {
    $_SESSION['msg'] = "Erro ao publicar: nenhum conteúdo fornecido.";
    header('Location: postagem.php');
    exit;
}

// Fecha a conexão
$conect->close();
?>
