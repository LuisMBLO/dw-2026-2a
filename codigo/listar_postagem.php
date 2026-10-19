<?php
session_start();
require_once "verificar_sessao.php";
require_once "conexao.php";

// Guardamos o ID do usuário logado em uma variável separada
$usuario_logado_id = $_SESSION['idusuario'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        margin: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        box-sizing: border-box;
        color: #333;
    }

    h2 {
        text-align: center;
    }

    a {
        display: block;
        width: 200px;
        padding: 12px;
        margin: 8px;
        background-color: white;
        color: #333;
        text-align: center;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-sizing: border-box;
    }

    a:hover {
        background-color: #e0e0e0;
    }

    .postagens {
        width: 100%;
        max-width: 600px;
        padding: 10px;
        background-color: transparent;
        border: none;
        box-sizing: border-box;
    }

    .postagem {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 15px;
        margin: 10px 0;
        overflow-wrap: anywhere;
    }

    .postagem div {
        border: none;
        padding: 5px 0;
    }

    .postagem img {
        vertical-align: middle;
        object-fit: cover;
    }

    .postagem p {
        margin: 15px 0;
        line-height: 1.5;
    }

    .comentarios {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin-top: 15px;
    }

    .comentarios div {
        border-bottom: 1px solid #eee;
        padding: 8px 0;
        overflow-wrap: anywhere;
    }

    form {
        margin-top: 10px;
    }

    input[type="text"] {
        width: 70%;
        padding: 10px;
        background-color: white;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        box-sizing: border-box;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: #aaa;
    }

    input[type="submit"] {
        padding: 10px 12px;
        background-color: white;
        color: #333;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        font-family: Arial, sans-serif;
    }

    input[type="submit"]:hover {
        background-color: #e0e0e0;
    }

    button {
        padding: 5px 8px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #e0e0e0;
    }

    button.curtido {
        background-color: #ffcccc;
        border-color: #d63031;
    }

    button img {
        width: 25px;
        height: 25px;
    }

    @media (max-width: 480px) {
        body {
            padding: 10px;
        }

        .postagens {
            padding: 0;
        }

        .postagem {
            padding: 12px;
        }

        input[type="text"] {
            width: 100%;
            margin-bottom: 8px;
        }

        input[type="submit"] {
            width: 100%;
        }
    }
</style>
</head>

<body>
    <h2>Lista de postagens</h2>
    <a href="home.php">Voltar para Home</a><br><br>

 
    <div class="postagens">
        <?php
        $sql = "SELECT postagem.idpostagem, postagem.texto, postagem.data_hora, usuario.idusuario, usuario.nome, usuario.apelido, usuario.foto
        FROM postagem, usuario
        WHERE postagem.idusuario = usuario.idusuario;";

        $resultados = mysqli_query($conexao, $sql);

        while ($linha = mysqli_fetch_array($resultados)) {
            $idpostagem = $linha['idpostagem'];
            $texto = $linha['texto'];
            $data_hora = $linha['data_hora'];
            $idusuario = $linha['idusuario'];

            $foto = $linha['foto'];
            $nome = $linha['nome'];
            $apelido = $linha['apelido'];

           
            
            $sql_total = "SELECT COUNT(*) AS total FROM curtida WHERE idpostagem = $idpostagem";
            $res_total = mysqli_query($conexao, $sql_total);
            $dados_total = mysqli_fetch_assoc($res_total);
            $total_curtidas = $dados_total['total'];

          
            $sql_user = "SELECT * FROM curtida WHERE idpostagem = $idpostagem AND idusuario = $usuario_logado_id";
            $res_user = mysqli_query($conexao, $sql_user);
            $usuario_curtiu = mysqli_num_rows($res_user) > 0;
           
            echo "<div class='postagem'>";

            echo "<div>";
            echo "<img src='$foto' width='30'> ";
            echo "$nome";
            echo " - " . $data_hora;
            echo "</div>";

            echo "<p>$texto</p>";

            ?>
            <form action="curtir.php" method="POST">
    <input type="hidden" name="postagem_id" value="<?= $idpostagem ?>">
    
    <button type="submit" class="<?= $usuario_curtiu ? 'curtido' : '' ?>">
        <?php if ($usuario_curtiu): ?>
          
            <img src="../imagens/curtir.png" width="25" alt="Descurtir">
        <?php else: ?>
            
            <img src="../imagens/curtir1.png" width="25" alt="Curtir"> 
        <?php endif; ?>
    </button>



             <span><?= $total_curtidas ?> curtida(s)</span>
            </form>
            <?php
           

            
            $sql3 = "SELECT comentario.idcomentario, comentario.idpostagem, comentario.texto, usuario.idusuario, usuario.nome, usuario.apelido, usuario.foto
            FROM comentario, usuario
            WHERE idpostagem = $idpostagem
            AND comentario.idusuario = usuario.idusuario
            ORDER BY comentario.idcomentario ASC;";

            $comentarios = mysqli_query($conexao, $sql3);

            if (mysqli_num_rows($comentarios) == 0) {
                echo "<br>Essa postagem não possui comentários.";
            } else {
                echo "<div class='comentarios'>";
               

                while ($comentario = mysqli_fetch_array($comentarios)) {
                    $texto_comentario = $comentario['texto'];
                    $foto_usuario_comentario = $comentario['foto'];

                    echo "<div>";
                    echo "<img src='imagem_usuario/$foto_usuario_comentario' width='20'> ";
                    echo $texto_comentario;
                    echo "</div>";
                }
        ?>
                <form action="salvar_comentario.php" method="POST">
                    <input type="hidden" name="idpostagem" value="<?= $idpostagem ?>">
                    <input type="text" name="texto">
                    <input type="submit" value="Comentar">
                </form>

        <?php
                echo "</div>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>