<?php
session_start();
require_once 'conect.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['iduser'])) {
    $_SESSION['msg'] = 'Login Necessário!';
    header('Location: index.php'); // Redireciona para a página de login
    exit; // Encerra o script após redirecionar
}
// Obtém as informações da sessão
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="post.css">
    <title>Postar Algo</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <h2>
                        IFTO Connect
                    </h2>
                    <a href="home.php">Página Inicial</a>
                    <a style="opacity: 100%;" href="postagem.php">Publicar Algo</a>
                    <a href="mypost.php">Minhas Postagens</a>
                    <a class="sair" href="exit.php">Sair</a>
                </li>
            </ul>
        </nav>
    </header>
    <div>
        <!-- Formulário para publicar -->
        <form action="post.php" method="post">
            <label for="ipost">
                <?php echo "Pensando em Algo, $username?";?>
            </label>
            <textarea name="postagem" id="ipost" cols="30" rows="10" required placeholder="Digite aqui..."></textarea>
            <input class="button" type="submit" value="Publicar">
        </form>
    </div>
    <?php
    // Exibe mensagens de erro ou sucesso
    if (isset($_SESSION['msg'])) {
        echo '<p class="aviso">' . $_SESSION['msg'] . '</p>';
        unset($_SESSION['msg']); // Remove a mensagem após exibir
    }
    ?>
</body>
</html>
