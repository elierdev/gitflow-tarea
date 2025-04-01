<?php
    require_once 'db_configs.php';
    require_once 'funciones.php';

    if (isset($_POST['nombre']) && isset($_POST['color']) && isset($_POST['tipo']) && isset($_POST['nivel']) && isset($_POST['foto'])) {
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $color = mysqli_real_escape_string($conexion, $_POST['color']);
        $tipo = mysqli_real_escape_string($conexion, $_POST['tipo']);
        $nivel = mysqli_real_escape_string($conexion, $_POST['nivel']);
        $foto = mysqli_real_escape_string($conexion, $_POST['foto']);

        $sql = "INSERT INTO personajes (nombre, color, tipo, nivel, foto) VALUES ('$nombre', '$color', '$tipo', '$nivel', '$foto')";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error al crear personaje: " . mysqli_error($conexion);
            header("Location: index.php");
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear personaje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
            
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #f39c12;
            font-family: 'Arial', sans-serif;
        }

        

        label {
            font-size: 1.1rem;
            margin-top: 15px;
            display: block;
            color: #f39c12;
            font-family: 'Arial', sans-serif;
        }

        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #f39c12;
            background-color: #2c3e50;
            color: #ecf0f1;
            font-size: 1rem;
            font-family: 'Arial', sans-serif;
        }

        input[type="submit"] {
            background-color: #f39c12;
            color: white;
            cursor: pointer;
            border: none;
            font-weight: bold;
            font-family: 'Arial', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: #e67e22;
            font-family: 'Arial', sans-serif;
        }

        .card {
            background-color: #1e1e1e;
            border: none;
            margin-bottom: 20px;
        }

        .card img {
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .color-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }

        .color-picker-container {
            padding: 0;
            margin: 0;
            width: 100%;
        }
        input[type="color"] {
            width: 100%;
            height: 30px;
            margin-top: 5px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #f39c12;
        }
        .card-body {
            padding: 15px;
        }

    </style>
</head>
<body>
    <?php include "header.php" ?>
    <div class="container">
        <h1>Crear personaje</h1>
        <form action="crear.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ej: Naruto Uzumaki" required><br>

            <label for="color">Color:</label>
            <input class="color" type="color" id="color" name="color" required><br>

            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" placeholder="Ej: Hokage" required><br>

            <label for="nivel">Nivel:</label>
            <input type="text" id="nivel" name="nivel" placeholder="Ej: 25" required><br>

            <label for="foto">URL de la Foto:</label>
            <input type="text" id="foto" name="foto" placeholder="Ej: https://i.pinimg.com/736x/d8/e3/04/d8e3040372030c633df7f7ee5034dfef.jpg" required><br>

            <input type="submit" value="Crear">
        </form>
    </div>
</body>
</html>
