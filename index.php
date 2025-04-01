<?php
require_once 'funciones.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/src/favicon.png" type="image/x-icon">
    <title>Personajes de Naruto</title>
    <!-- Bootstrap CSS -->
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
            max-height: 500px;
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
    <!-- Incluir el encabezado a la pagina -->
    <?php include "header.php" ?>

    <!-- Sección principal -->
    <main class="container mt-5 text-center">
        <h1 class="mb-3 text-warning text-shadow">PERSONAJES DE NARUTO</h1>
        <h2 class="mb-4">Lista de personajes de la serie animada Naruto</h2>
        <h3 style="background:rgb(255, 102, 0); padding:20px; border-radius:8px; color:#121212; font-weight: 600"><?php echo getCantidad(); ?> PERSONAJES REGISTRADOS ACTUALMENTE</h3>
    </main>

    <!-- Iterando cada personaje desde la base de datos -->
    <section class="container mt-4">
        <div class="row g-4">
            <?php
                $personajes = getPersonajes();
                foreach ($personajes as $personaje) {
                    $id = $personaje['id'];
                    $nombre = $personaje['nombre'];
                    $color = $personaje['color'];
                    $tipo = $personaje['tipo'];
                    $nivel = $personaje['nivel'];
                    $foto = $personaje['foto'];
            ?>
            <div class="col-md-4">


                <div class="card text-white" style="box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);">
                    <img src="<?php echo $foto; ?>" class="card-img-top" alt="foto del personaje">
                    <div class="card-body"">
                        <h3 class="card-title"><?php echo $nombre; ?></h3>
                        <p class="card-text"><span class="color-box" style="background-color: <?php echo $color; ?>; border-radius: 10px; width: 90%;"></span></p>
                        <p class="card-text"><?php echo $tipo; ?></p>
                        <p class="card-text">lvl <?php echo $nivel; ?></p>
                        <div class="d-flex justify-content-around mt-3" style="gap: 10px;">
                            <a href="editar.php?id=<?php echo $id; ?>" class="btn btn-warning btn-sm" style="width: 25%;">Editar</a>
                            <a href="eliminar.php?id=<?php echo $id; ?>" class="btn btn-danger btn-sm" style="width: 25%;">Eliminar</a>
                            <a href="descargar_pdf.php?id=<?php echo $id; ?>" class="btn btn-info btn-sm" style="width: 50%;">Descargar PDF</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </section>
</body>
</html>
