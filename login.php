<?php
session_start();
require_once 'conect.php';

if (isset($_POST['email']) && ($_POST['senha'])){
    $email = $_POST['email'];
    $pass = $_POST['senha'];

    $email = mysqli_real_escape_string($conect, $email);
    $pass = mysqli_real_escape_string($conect, $pass);

    // Verificando se é aluno
    $query = "SELECT id, nome, email, senha, nivel FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conect, $query);
    $user = mysqli_fetch_assoc($result);


    // Verificação para Aluno
    if ($user && $pass == $user['senha']) {
        $_SESSION['iduser'] = $user['id'];
        $_SESSION['username'] = $user['nome'];
        $_SESSION['nivel'] = $user['nivel'];  // Define o tipo de usuário como aluno
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
