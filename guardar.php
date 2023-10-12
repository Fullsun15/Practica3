<?php
if (isset($_POST['guardar'])) {
    $nombre_archivo = $_POST['nombre_archivo'];
    $contenido = $_POST['contenido'];
    $ubicacion = $_POST['ubicacion'];

    if ($ubicacion === 'afuera') {
        $ruta_archivo = "archivos/$nombre_archivo.txt";
    } else {
        $ruta_archivo = "carpetas/$ubicacion/$nombre_archivo.txt";
    }

    // Guardar el contenido en el archivo
    file_put_contents($ruta_archivo, $contenido);

    echo "Archivo guardado correctamente.";
}
header('Location: index.php')
?>
