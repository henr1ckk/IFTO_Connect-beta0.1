<?php
session_start();
require_once 'conect.php';

if (isset($_POST['email']) && ($_POST['senha'])){
    $email = $_POST['email'];
    $pass = $_POST['senha'];

    $email = mysqli_real_escape_string($conect, $email);
    $pass = mysqli_real_escape_string($conect, $pass);

    // Verificando se é aluno
    $query_aluno = "SELECT id, nome, email, senha FROM alunos WHERE email = '$email'";
    $result_aluno = mysqli_query($conect, $query_aluno);
    $user_aluno = mysqli_fetch_assoc($result_aluno);

    // Verificando se é professor
    $query_professor = "SELECT id, nome, email, senha FROM professores WHERE email = '$email'";
    $result_professor = mysqli_query($conect, $query_professor);
    $user_professor = mysqli_fetch_assoc($result_professor);

    // Verificando se é admin
    $query_admin = "SELECT id, nome, email, senha FROM admins WHERE email = '$email'";
    $result_admin = mysqli_query($conect, $query_admin);
    $user_admin = mysqli_fetch_assoc($result_admin);

    // Verificação para Aluno
    if ($user_aluno && $pass == $user_aluno['senha']) {
        $_SESSION['iduser'] = $user_aluno['id'];
        $_SESSION['username'] = $user_aluno['nome'];
        $_SESSION['tipousuario'] = 'aluno';  // Define o tipo de usuário como aluno
        header('location: home.php');
        exit;
    }

    // Verificação para Professor
    if ($user_professor && $pass == $user_professor['senha']) {
        $_SESSION['iduser'] = $user_professor['id'];
        $_SESSION['username'] = $user_professor['nome'];
        $_SESSION['tipousuario'] = 'professor';  // Define o tipo de usuário como professor
        header('location: home.php');
        exit;
    }

    // Verificação para Admin
    if ($user_admin && $pass == $user_admin['senha']) {
        $_SESSION['iduser'] = $user_admin['id'];
        $_SESSION['username'] = $user_admin['nome'];
        $_SESSION['tipousuario'] = 'admin';  // Define o tipo de usuário como admin
        header('location: home.php');
        exit;
    }

    // Caso as credenciais sejam inválidas
    $_SESSION['msg'] = 'Informações Inválidas!';
    header('location: index.php');
    exit;
} else {
    header('location: index.php');
    exit;
}
?>
