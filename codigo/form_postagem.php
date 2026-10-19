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

    form {
        display: flex;
        flex-direction: column;
        width: 250px;
        padding: 20px;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    input[type="text"] {
        padding: 12px;
        margin-top: 8px;
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
        padding: 12px;
        margin-top: 8px;
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
</style>
</head>
<body>
    <form action="salvar_postagem.php">
        Texto: <br>
        <input type="text" name="texto"> <br><br>

        <input type="submit" value="Publicar">
    </form>
</body>
</html>