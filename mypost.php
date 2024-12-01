<?php 
session_start();
require_once 'conect.php';
require_once 'funcoes.php';

if (!isset($_SESSION['iduser'])) {
    $_SESSION['msg'] = 'Login Necessário!';
    header('location:index.php');
    exit;
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
    <link rel="stylesheet" href="mypost.css">
    <title>Minhas Postagens</title>
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <h2>IFTO Connect</h2>
                    <?php
                    echo "<h3>Publicações de $username.</h3>";
                    ?>
                    <a href="home.php">Página Inicial</a>
                    <a href="postagem.php">Publicar Algo</a>
                    <a style="opacity: 100%;" href="mypost.php">Minhas Postagens</a>
                    <a class="sair" href="exit.php">Sair</a>
                </li>
            </ul>
        </nav>
    </header>

    <?php 
    // Mensagem de aviso, se existir
    if (isset($_SESSION['msg'])) {
        echo '<p class="aviso">' . $_SESSION['msg'] . '</p>';
        unset($_SESSION['msg']);
    }

    $iduser = $_SESSION['iduser'];
    
    // SQL para buscar apenas as postagens do usuário logado
    $sql = "SELECT postagens.*, 
            COALESCE(usuarios.nome) AS nome, usuarios.nivel AS nivel 
            FROM postagens 
            LEFT JOIN usuarios ON postagens.usuarioid = usuarios.id
            WHERE 
            (postagens.usuarioid = $iduser)
            ORDER BY postagens.data DESC;";

    $result = mysqli_query($conect, $sql);
    
    // 
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Removeu a verificação aqui pois a consulta já filtra por id do usuário
            echo '<div class="post">';
            echo '<p class="name">@' . htmlspecialchars($row['nome']) . '</p>';
            echo '<p class="conteudo">' . htmlspecialchars($row['descricao']) . '</p>';
            echo '<p class="hora">' . tempoDesde($row['data']) . '</p>';// Chama a função para formatar a data
            echo '</div>';
            echo "<div class='acoes'>";
            echo "<a class='ex' href='excluir.php?id={$row['id']}' onclick='return confirm(\"Tem certeza que deseja excluir a Postagem?\")'>Excluir</a>";
            echo "</div>";
        }
    } else {
        echo "<p class='aviso'>Nenhuma postagem encontrada.</p>";
    }

    mysqli_close($conect);
    ?>
</body>

</html>
