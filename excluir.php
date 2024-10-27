<?php 
    session_start();
    require_once 'conect.php';

    if(isset($_GET['id'])){
        $idpost = $_GET['id'];

            $query = "DELETE FROM postagens WHERE id = $idpost";

            if(mysqli_query($conect, $query)){
                $_SESSION['msg'] = "Postagem exluída do sucesso!";
                header('location:mypost.php');
                exit;
            }else{
                $_SESSION['msg'] = "Erro ao exluir Postagem!";
                header('location: mypost.php');
                exit;
            }
    }else{
        $_SESSION['msg'] = "Postagem não encontrada!";
    }
    header('location:mypost.php');
    exit;
?>