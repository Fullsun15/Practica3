<!DOCTYPE html>
<html>
<head>
    <title>Ver Carpeta</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
    <?php
        if (isset($_GET['carpeta'])) {
            $carpeta_seleccionada = $_GET['carpeta'];
            $ruta_carpeta = "carpetas/$carpeta_seleccionada";
            
            // Si se ha intentado renombrar la carpeta
            if (isset($_POST['nuevo_nombre_carpeta'])) {
                $nuevo_nombre_carpeta = $_POST['nuevo_nombre_carpeta'];
                $ruta_carpeta_nueva = "carpetas/$nuevo_nombre_carpeta";
                
                if (file_exists($ruta_carpeta)) {
                    if (!file_exists($ruta_carpeta_nueva)) {
                        rename($ruta_carpeta, $ruta_carpeta_nueva);
                        $carpeta_seleccionada = $nuevo_nombre_carpeta;
                    } else {
                        echo "El nombre de carpeta ya existe.";
                    }
                }
            }
            ?>
            <div>
                <nav id="bloc" class="nav-wrapper deep-purple darken-1">
                    <div class="container">
                        <a class="brand-logo center">Contenido de la carpeta <?php echo "$carpeta_seleccionada" ?></a>
                        <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="index.php"><i class="material-icons left">desktop_windows</i>Regresar al Inicio</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
            
            <div class="container">
            <?php
            echo "<form method='POST' action='ver_carpeta.php?carpeta=$carpeta_seleccionada'>"; ?>
            <div class="input-field">
                <input type='text' name='nuevo_nombre_carpeta'>
                <label for='nuevo_nombre_carpeta'>Nuevo nombre de carpeta:</label>
            </div>
            
            <button class="btn waves-effect pink lighten-5 black-text" type="submit" name="renombrar_carpeta">Renombrar Carpeta</button>
            <?php
            echo "</form>";

            if (isset($_GET['eliminar'])) {
                $archivo_a_eliminar = $_GET['eliminar'];
                $ruta_archivo_a_eliminar = "$ruta_carpeta/$archivo_a_eliminar";

                if (file_exists($ruta_archivo_a_eliminar)) {
                    if (unlink($ruta_archivo_a_eliminar)) {
                        
                    } else {
                        echo "No se pudo eliminar el archivo '$archivo_a_eliminar'.";
                    }
                } else {
                    echo "El archivo '$archivo_a_eliminar' no existe.";
                }
            }
            ?>
            <br>
            <a href="seleccionar.php" class="waves-effect deep-purple darken-1 btn">Regresar</a>
            <?php
            $archivos = glob("$ruta_carpeta/*.txt");
            if (count($archivos) > 0) {
                echo "<table class='striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Nombre</th>";
                echo "<th>Fecha de última modificación</th>";
                echo "<th>Tipo de archivo</th>";
                
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($archivos as $archivo) {
                    date_default_timezone_set('America/Caracas');
                    $nombre_archivo = basename($archivo);
                    $ultima_modificacion = date("Y-m-d H:i:s", filemtime($archivo));

                    echo "<tr>";
                    echo "<td><i class='material-icons'>note</i><a href='abrir.php?archivo_existente=$carpeta_seleccionada/$nombre_archivo'>$nombre_archivo</a></td>";
                    echo "<td>$ultima_modificacion</td>";
                    echo "<td>Archivo</td>";
                    echo "<td><a href='ver_carpeta.php?carpeta=$carpeta_seleccionada&eliminar=$nombre_archivo' class='btn red'>Eliminar</a></td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "La carpeta está vacía.";
                header('Location: seleccionar.php');
            }
        } else {
            echo "La carpeta no existe.";
        }
        ?>
    </div>
<br><br><br><br><br>
    <footer class="page-footer deep-purple darken-1">
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
