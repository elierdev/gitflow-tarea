<?php
// Importar modulos
require_once 'db_configs.php';
require "librerias/vendor/autoload.php";

// Usar el modulo
use Mpdf\Mpdf;
use Mpdf\Tag\B;

if (isset($_GET['id'])) {
    // evitar SQL Injection
    $id = intval($_GET['id']);

    // Consultar la información del personaje
    $sql = "SELECT * FROM personajes WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && $row = mysqli_fetch_assoc($resultado)) {
        $nombre = htmlspecialchars($row['nombre']);
        $color = htmlspecialchars($row['color']);
        $tipo = htmlspecialchars($row['tipo']);
        $nivel = htmlspecialchars($row['nivel']);
        $foto = htmlspecialchars($row['foto']);


        $imgData = "";
        if (file_exists($foto)) {
            $imgData = base64_encode(file_get_contents($foto));
            $foto = "data:image/jpeg;base64," . $imgData;
        }


        $html = "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Character Card</title>
                <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'>
                <style>
                    body { font-family: Arial, sans-serif; text-align: center; background-color: #121212; color: white; padding: 20px; }
                    .card { max-width: 400px; margin: auto; background-color: #333; padding: 15px; border-radius: 10px; box-shadow: 0 0 20px rgba(255, 255, 255, 0.3); }
                    img { max-width: 100%; border-radius: 10px; }
                    .color-box { display: inline-block; height: 20px; border-radius: 10px; width: 90%; }
                </style>
            </head>
            <body style='display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #121212;'>
                <div class='card text-white'>
                    <img src='$foto' class='card-img-top' alt='Foto del personaje' style='max-height: 500px; object-fit: cover;'>
                    <div class='card-body'>
                        <h3 class='card-title' style='color: white; margin-top: 10px; font-size: 1.5rem; font-weight: bold;'>$nombre</h3>
                        <div class='color-box' style='background-color: $color; border-radius: 10px; width: 90%; height: 20px; margin: auto;'></div>
                        <p class='card-text' style='font-size: 1.2rem;'><b>Tipo: </b>$tipo</p>
                        <p class='card-text' style='font-size: 1.2rem;'><b>Level: </b> $nivel</p>
                    </div>
                </div>
            </body>
            </html>";


        // Generar el PDF
        try {
            $mpdf = new Mpdf();
            $mpdf->WriteHTML($html);
            $mpdf->Output("reporte.pdf", "D");
        } catch (\Mpdf\MpdfException $e) {
            echo "Error al generar PDF: " . $e->getMessage();
        }
    } else {
        echo "No se encontró el personaje.";
    }
}
