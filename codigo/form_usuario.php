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
        justify-content: center;
        align-items: center;
    }

    form {
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        width: 300px;
        border: 1px solid #ddd;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="text"]:focus {
        outline: 1px solid #555;
    }

    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #555;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #333;
    }
</style>
</head>
<body>
    <form action="salvar_usuario.php" method="post">
        Nome: <br>
        <input type="text" name="nome"> <br><br>
        Apelido: <br>
        <input type="text" name="apelido"> <br><br>
        E-mail: <br>
        <input type="text" name="email"> <br><br>
        Senha: <br>
        <input type="text" name="senha"> <br><br>
        Foto: <br>
        <input type="text" name="foto"> <br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>