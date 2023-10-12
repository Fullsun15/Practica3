<?php
if (isset($_GET['archivo_existente'])) {
    $nombre_archivo_original = urldecode($_GET['archivo_existente']); // Nombre original del archivo
    $ruta_archivo_original = "archivos/$nombre_archivo_original";

    if (strpos($nombre_archivo_original, '/') !== false) {
        // Si el nombre del archivo contiene una barra "/", entonces está dentro de una carpeta
        $ruta_archivo_original = "carpetas/$nombre_archivo_original";
    }

    if (file_exists($ruta_archivo_original)) {
        $contenido = file_get_contents($ruta_archivo_original);
    } else {
        $contenido = "El archivo no existe.";
    }
} else {
    $nombre_archivo_original = '';
    $contenido = '';
}

if (isset($_POST['guardar_cambios'])) {
    $nombre_archivo_original = $_POST['nombre_archivo_original'];
    $nombre_archivo_nuevo = $_POST['nombre_archivo_nuevo'];
    $ubicacion_destino = $_POST['ubicacion_destino'];

    $ruta_archivo_original = strpos($nombre_archivo_original, '/') !== false ? "carpetas/$nombre_archivo_original" : "archivos/$nombre_archivo_original";

    if (file_exists($ruta_archivo_original)) {
        $nombre_archivo_nuevo_con_ruta = $ubicacion_destino . '/' . $nombre_archivo_nuevo;
        $ruta_archivo_nuevo = "carpetas/$nombre_archivo_nuevo_con_ruta";

        // Verifica si el archivo de destino ya existe y, si es así, elimínalo
        if (file_exists($ruta_archivo_nuevo)) {
            unlink($ruta_archivo_nuevo);
        }

        rename($ruta_archivo_original, $ruta_archivo_nuevo);

        // Actualizar el contenido del archivo
        file_put_contents($ruta_archivo_nuevo, $_POST['contenido']);

        // Redirigir al mismo archivo con el nuevo nombre de archivo
        header('Location: seleccionar.php');
        exit();
    } else {
        echo "El archivo no existe en la ubicación actual.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bloc de Notas - Editar</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <div>
    <nav id="bloc" class="nav-wrapper deep-purple lighten-1">
        <div class="container">
        <a class="brand-logo center">Bloc de Notas - Abrir/Editar</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php"><i class="material-icons left">desktop_windows</i>Regresar al Inicio</a></li>
        </ul>
        </div>
    </nav>
    </div>
<br>
    <form method="POST" action="abrir.php">
        <input type="hidden" name="nombre_archivo_original" value="<?php echo htmlspecialchars($nombre_archivo_original); ?>">
        <div class="input-field">
            <input type="text" name="nombre_archivo_nuevo" value="<?php echo htmlspecialchars($nombre_archivo_original); ?>">
            <label for="nombre_archivo_nuevo">Nombre del archivo:</label>
        </div>
        <br>
        <label for="contenido">Contenido:</label>
        <textarea class="materialize-textarea" name="contenido" rows="10" cols="50"><?php echo htmlspecialchars($contenido); ?></textarea>
        <br>
        <br>
        <button class="btn waves-effect deep-purple lighten-1" type="submit" name="guardar_cambios">Guardar Cambios
            <i class="material-icons right">send</i>
        </button>
    </form>

    <div class="center-align">
       <a href="seleccionar.php" class="pink lighten-5 black-text btn">Regresar</a>
    </div>
<br><br><br><br>
    <footer class="page-footer deep-purple lighten-1">
    <div class="footer-copyright">
        <div class="container">
            Copyright ©2023 rubilopez.site
            <a class="left" href="https://github.com/Fullsun15/Practica3.git" target="_blank"><img src="https://cdn-icons-png.flaticon.com/512/25/25231.png" width="35px" height="35px"></a>
        </div>
    </div>
</footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
