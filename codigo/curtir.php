<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Postagens</title>

</head>
<body>

<h1>Postagens</h1>

<?php foreach ($postagens as $post): ?>
    <div class="postagem">

        <h3>
            <?= htmlspecialchars($post["nome"]) ?>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($post["conteudo"])) ?>
        </p>

        <form action="curtir.php" method="POST">
            <input
                type="hidden"
                name="postagem_id"
                value="<?= (int) $post["id"] ?>"
            >

            <button
                type="submit"
                class="curtir <?= $post["usuario_curtiu"] ? 'curtido' : '' ?>"
                <?= !$usuario_id ? 'disabled' : '' ?>
            >
                <?= $post["usuario_curtiu"]
                    ? ' Descurtir'
                    : ' Curtir' ?>
            </button>

            <span>
                <?= (int) $post["total_curtidas"] ?>
                curtida(s)
            </span>
        </form>

    </div>
<?php endforeach; ?>

</body>
</html>