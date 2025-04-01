<?php
require_once 'db_configs.php';
require_once 'funciones.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conexion, $_GET['id']);  

    $check_query = "SELECT * FROM personajes WHERE id = $id";
    $check_result = mysqli_query($conexion, $check_query);

    if (mysqli_num_rows($check_result) == 0) {
        echo "El personaje con ID $id no existe.";
        exit;
    }

    if (isset($_POST['si'])) {
        
        $sql = "DELETE FROM personajes WHERE id = $id";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error al eliminar personaje: " . mysqli_error($conexion);
            header("Location: index.php");
            exit;
        }
    } elseif (isset($_POST['no'])) {
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
    <title>Eliminar personaje</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #ffffff;
        }
        .card {
            background-color: #1e1e1e;
            border: none;
        }
        .card img {
            max-height: 200px;
            object-fit: cover;
        }
        .color-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }
    </style>
    
</head>
<body>
    <?php include "header.php" ?>
    <div class="container">
        <form action="eliminar.php?id=<?php echo $id; ?>" method="post">
            <h1>Eliminar personaje</h1>
            <h2>¿Estás seguro de que quieres eliminar este personaje?</h2>
            <input style="padding: 20px 50px; margin: 10px; background-color:rgb(255, 72, 72); color: #ffffff; border: none; border-radius: 5px; font-size: 1.3rem;" type="submit" name="si" value="Si">
            <input style="padding: 20px 50px; margin: 10px; background-color:rgb(255, 255, 255); color:rgb(0, 0, 0); border: none; border-radius: 5px; font-size: 1.3rem;" type="submit" name="no" value="No">
        </form>
    </div>
</body>
</html>
