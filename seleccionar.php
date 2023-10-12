<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar Carpeta</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
<body>
<div>
  <nav id="bloc" class="nav-wrapper deep-purple darken-1">
    <div class="container">
      <a class="brand-logo center">Seleccionar Carpeta</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="index.php"><i class="material-icons left">desktop_windows</i>Regresar al Inicio</a></li>
      </ul>
    </div>
  </nav>
</div>
<br>
    <div class="container">
        <h2 class="card-panel pink lighten-5 black-text ">Carpetas Disponibles:</h2>

        <table class="striped">
            <thead>
                <tr>
                    <th></th> <!-- Columna para el icono de carpeta -->
                    <th>Nombre</th>
                    <th>Fecha de última modificación</th>
                    <th>Tipo de archivo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $carpetas = glob('carpetas/*', GLOB_ONLYDIR);
                date_default_timezone_set('America/Caracas');
                foreach ($carpetas as $carpeta) {
                    $nombre_carpeta = basename($carpeta);
                    $ultima_modificacion = date("Y-m-d H:i:s", filemtime($carpeta));
                    echo "<tr>";
                    echo "<td><i class='material-icons'>folder</i></td>"; 
                    echo "<td><a href='ver_carpeta.php?carpeta=$nombre_carpeta'>$nombre_carpeta</a></td>";
                    echo "<td>$ultima_modificacion</td>";
                    echo "<td>Carpeta</td>";
                    echo "<td><a href='eliminar_carpeta.php?carpeta=$nombre_carpeta' class='btn red'>Eliminar</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <br><br><br><br>
    </div>

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
