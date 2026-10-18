<?php
session_start();
require_once "verificar_sessao.php";
require_once "conexao.php";


$usuario_id = $_SESSION['idusuario'] ?? null;
$postagem_id = $_POST['postagem_id'] ?? null;

if ($usuario_id && $postagem_id) {
   
    $sql_verifica = "SELECT * FROM curtida WHERE idusuario = $usuario_id AND idpostagem = $postagem_id";
    $resultado = mysqli_query($conexao, $sql_verifica);

    if (mysqli_num_rows($resultado) > 0) {
       
        $sql_acao = "DELETE FROM curtida WHERE idusuario = $usuario_id AND idpostagem = $postagem_id";
    } else {
        
        $sql_acao = "INSERT INTO curtida (idusuario, idpostagem) VALUES ($usuario_id, $postagem_id)";
    }

    mysqli_query($conexao, $sql_acao);
}


header("Location: listar_postagem.php");
exit;
?>