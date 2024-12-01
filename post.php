<?php 
session_start();
require_once "conect.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['iduser'])) {
    $_SESSION['msg'] = "Login Necessário!";
    header('Location: index.php');
    exit;
}

// Verifica se a postagem existe e define as variáveis que vieram da tabela de postagens
if (isset($_POST['postagem'])) {
    $postagem = $_POST['postagem'];
    $usuarioid = $_SESSION['iduser'];
    $tipousuario = $_SESSION['nivel'];

    // Prepare a consulta SQL com base no tipo de usuário
    if ($tipousuario == 'Aluno') {
        // Insere como aluno
        $sql = "INSERT INTO postagens (descricao, data, usuarioid) VALUES ('$postagem', NOW(), '$usuarioid')";
    } elseif ($tipousuario == 'Professor') {
        // Insere como professor
        $sql = "INSERT INTO postagens (descricao, data, usuarioid) VALUES ('$postagem', NOW(), '$usuarioid')";
    } elseif ($tipousuario == 'Administrador') {
        // Se tiver um caso para administrador, adicione aqui
        $sql = "INSERT INTO postagens (descricao, data, usuarioid) VALUES ('$postagem', NOW(), '$usuarioid')";
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
