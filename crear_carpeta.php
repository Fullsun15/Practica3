<?php
if (isset($_POST['crear_carpeta'])) {
    $nombre_carpeta = $_POST['nombre_carpeta'];

    // Verificar si la carpeta ya existe
    if (!file_exists("carpetas/$nombre_carpeta")) {
        mkdir("carpetas/$nombre_carpeta", 0777, true);
        echo "Carpeta '$nombre_carpeta' creada correctamente.";
    } else {
        echo "La carpeta '$nombre_carpeta' ya existe.";
    }
}
header('Location: index.php')
?>
