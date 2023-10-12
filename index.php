<!DOCTYPE html>
<html>
<head>
    <title>Bloc de Notas</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.cs">
</head>
<body>
<div>
  <nav id="bloc" class="nav-wrapper deep-purple darken-1">
    <div class="container">
      <a class="brand-logo center">Bloc de Notas</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="seleccionar.php"><i class="material-icons left">folder_open</i>Abrir Carpetas</a></li>
      </ul>
    </div>
  </nav>
</div>
<div class="container">
    <div class="container">
        <br><br>
        <h6 class="card-panel pink lighten-5 black-text center">Crear Carpetas</h6>
        <!-- Formulario para crear carpetas -->
        <form method="POST" action="crear_carpeta.php">
        <div class="input-field">
            <input type="text" name="nombre_carpeta">
            <label for="nombre_carpeta">Nombre de la carpeta:</label>
            </div>
            <button class="btn waves-effect deep-purple darken-1" type="submit" name="crear_carpeta">Crear Carpeta
                <i class="material-icons right">create_new_folder</i>
            </button>
        </form>
        <br><br>
        <h6 class="card-panel pink lighten-5 black-text center">Crear Notas</h6>
        <!-- Formulario para guardar notas -->
        <form method="POST" action="guardar.php">
            <div class="input-field">
                <input type="text" name="nombre_archivo" required>
                <label for="nombre_archivo">Nombre del archivo:</label>
            </div>
            <br>
            <textarea class="materialize-textarea" name="contenido" rows="10" cols="50" placeholder="Escriba Texto"></textarea>
            <br>
            <!-- Campo de selección para elegir la ubicación de la nota -->
            <label for="ubicacion" >Ubicación:</label>
            <select class="browser-default" name="ubicacion" required>
                <?php
                $carpetas = glob('carpetas/*', GLOB_ONLYDIR);
                foreach ($carpetas as $carpeta) {
                    $nombre_carpeta = basename($carpeta);
                    echo "<option value='$nombre_carpeta'>Dentro de '$nombre_carpeta'</option>";
                }
                ?>
            </select>
            <br>
            <button class="btn waves-effect deep-purple darken-1" type="submit" name="guardar">Guardar
                <i class="material-icons right">send</i>
            </button>
        </form>
        <br>
    </div>
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
