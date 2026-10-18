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
        div {
            border-style: solid;
            padding: 10px;
        }

        .postagens {
            border-color: blue;
        }

        .postagem {
            border-color: black;
            margin: 10px;
        }

        .comentarios {
            border-color: green;
        }

        .curtido {
            background-color: #ffcccc; /* Deixa o botão avermelhado se já curtiu */
        }
    </style>
</head>

<body>
    <h2>Lista de postagens</h2>
    <a href="home.php">Voltar para Home</a><br><br>

    <!-- tabela -->
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

            // --- LÓGICA DE CURTIDAS PARA CADA POST ---
            // 1. Conta o total de curtidas desta postagem no banco
            $sql_total = "SELECT COUNT(*) AS total FROM curtida WHERE idpostagem = $idpostagem";
            $res_total = mysqli_query($conexao, $sql_total);
            $dados_total = mysqli_fetch_assoc($res_total);
            $total_curtidas = $dados_total['total'];

            // 2. Verifica se o usuário logado já curtiu esta postagem
            $sql_user = "SELECT * FROM curtida WHERE idpostagem = $idpostagem AND idusuario = $usuario_logado_id";
            $res_user = mysqli_query($conexao, $sql_user);
            $usuario_curtiu = mysqli_num_rows($res_user) > 0;
            // ----------------------------------------

            echo "<div class='postagem'>";

            echo "<div>";
            echo "<img src='$foto' width='30'> ";
            echo "$nome";
            echo " - " . $data_hora;
            echo "</div>";

            echo "<p>$texto</p>";

            // --- FORMULÁRIO DO BOTÃO DE CURTIR ---
            ?>
            <form action="curtir.php" method="POST">
    <input type="hidden" name="postagem_id" value="<?= $idpostagem ?>">
    
    <button type="submit" class="<?= $usuario_curtiu ? 'curtido' : '' ?>">
        <?php if ($usuario_curtiu): ?>
            <!-- Se já curtiu: mostra a imagem do coração vermelho -->
            <img src="../imagens/curtir.png" width="25" alt="Descurtir">
        <?php else: ?>
            <!-- Se ainda não curtiu: mostra a imagem do coração cinza/vazio -->
            <img src="../imagens/curtir1.png" width="25" alt="Curtir"> 
        <?php endif; ?>
    </button>

    <span><?= $total_curtidas ?> curtida(s)</span>


                <span><?= $total_curtidas ?> curtida(s)</span>
            </form>
            <?php
            // -------------------------------------

            //caixa dos comentarios
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
                // listar comentários aqui

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