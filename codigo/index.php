<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
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

    a {
        display: block;
        margin-top: 20px;
        text-align: center;
        color: #555;
        text-decoration: none;
        font-size: 14px;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
    <form action="verificar_login.php" method="post">
        E-mail: <br>
        <input type="text" name="email"> <br><br>
        Senha: <br>
        <input type="text" name="senha"> <br><br>

        <input type="submit" value="Logar">

        <a href="form_usuario.php">Não tem conta? Crie agora!</a>
    </form>
</body>
</html>