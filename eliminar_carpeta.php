<?php
function eliminarCarpetaRecursivamente($carpeta) {
    if (is_dir($carpeta)) {
        $archivos = scandir($carpeta);
        foreach ($archivos as $archivo) {
            if ($archivo != '.' && $archivo != '..') {
                $ruta = $carpeta . '/' . $archivo;
                if (is_dir($ruta)) {
                    eliminarCarpetaRecursivamente($ruta);
                } else {
                    unlink($ruta);
                }
            }
        }
        rmdir($carpeta);
    }
}

if (isset($_GET['carpeta'])) {
    $carpeta = $_GET['carpeta'];

    // Verifica que el nombre de la carpeta sea seguro (puedes agregar más validaciones si es necesario).
    if (preg_match('/^[A-Za-z0-9_\-]+$/', $carpeta)) {
        $ruta_carpeta = 'carpetas/' . $carpeta;

        if (is_dir($ruta_carpeta)) {
            eliminarCarpetaRecursivamente($ruta_carpeta);
            echo "Carpeta '$carpeta' y su contenido han sido eliminados con éxito.";
            header('Location: seleccionar.php');
        } else {
            echo "La carpeta '$carpeta' no existe.";
        }
    } else {
        echo "Nombre de carpeta no válido.";
    }
} else {
    echo "No se proporcionó el nombre de la carpeta a eliminar.";
}
?>
