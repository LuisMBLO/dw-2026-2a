<?php
    require_once "verificar_sessao.php";
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
        justify-content: center;
        align-items: center;
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
    }

    a:hover {
        background-color: #e0e0e0;
    }

    a:last-of-type {
        color: #d63031;
    }
</style>
</head>
<body>
    <a href="form_postagem.php">Nova postagem</a> <br>
    <a href="listar_postagem.php">Ver postagens</a> <br>
    <a href="deslogar.php">Sair...</a>
</body>
</html>