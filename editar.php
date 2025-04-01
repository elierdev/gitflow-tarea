<?php
require_once 'db_configs.php';
require_once 'funciones.php';

$nombre = $color = $tipo = $nivel = $foto = ""; // Inicializar variables
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Si se recibe un formulario por POST, actualizar datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $color = mysqli_real_escape_string($conexion, $_POST['color']);
    $tipo = mysqli_real_escape_string($conexion, $_POST['tipo']);
    $nivel = mysqli_real_escape_string($conexion, $_POST['nivel']);
    $foto = mysqli_real_escape_string($conexion, $_POST['foto']);

    $sql = "UPDATE personajes SET nombre='$nombre', color='$color', tipo='$tipo', nivel='$nivel', foto='$foto' WHERE id=$id";
    if (mysqli_query($conexion, $sql)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al editar personaje: " . mysqli_error($conexion);
    }
}

// Obtener datos del personaje si hay un ID válido
if ($id > 0) {
    $check_query = "SELECT * FROM personajes WHERE id = $id";
    $check_result = mysqli_query($conexion, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $row = mysqli_fetch_assoc($check_result);
        $nombre = $row['nombre'];
        $color = $row['color'];
        $tipo = $row['tipo'];
        $nivel = $row['nivel'];
        $foto = $row['foto'];
    } else {
        echo "El personaje con ID $id no existe.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar personaje</title>
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
        <h1>Editar personaje</h1>
        <form action="editar.php?id=<?php echo $id; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required value="<?php echo htmlspecialchars($nombre); ?>">
            
            <label for="color">Color:</label>
            <input type="color" id="color" name="color" required value="<?php echo htmlspecialchars($color); ?>">
            
            <label for="tipo">Tipo:</label>
            <input type="text" id="tipo" name="tipo" required value="<?php echo htmlspecialchars($tipo); ?>">
            
            <label for="nivel">Nivel:</label>
            <input type="text" id="nivel" name="nivel" required value="<?php echo htmlspecialchars($nivel); ?>">
            
            <label for="foto">URL de la Foto:</label>
            <input type="text" id="foto" name="foto" required value="<?php echo htmlspecialchars($foto); ?>">
            
            <input type="submit" value="Guardar">
        </form>
    </div>
</body>
</html>
