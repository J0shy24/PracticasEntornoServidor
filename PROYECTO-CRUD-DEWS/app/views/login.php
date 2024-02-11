<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>CRUD DE USUARIOS</title>
    <link href="../../web/css/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="web/js/funciones.js"></script>
    <style>
        #content{
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="content">
            <form method="post">
                Usuario: <input type="text" name="usuario" size="20">
                Contraseña: <input type="text" name="contrasena" size="20">
                <button type="submit">Iniciar Sesion</button>
            </form>
        </div>
    </div>
</body>