<?php
  session_start();
  $url_base="https://organic-space-spork-v9gpgj99rv72vrv-8080.app.github.dev/";
  // Verificar si el usuario ha iniciado sesión y si es un alumno
  
  if (isset($_SESSION["usuario"]) && $_SESSION["tipo"] === "maestro") {
    $id_usuario = $_SESSION['id']; // Asegúrate de que esta sesión exista
    $correo = $_SESSION['correo']; // Aquí se asigna el valor del correo electrónico
    $password = isset($_SESSION['password']) ? $_SESSION['password'] : ""; // Verificar si la clave existe en la sesión
    $usuario = $_SESSION['usuario'];
    $id = $id_usuario;
    $id = isset($_SESSION['id']) ? $_SESSION['id'] : "";
  
    // Mover el bloque de código que recupera los datos de la base de datos aquí
    $conexion = mysqli_connect("db", "mariadb", "mariadb", "mariadb");
  
    $sentencia = $conexion->prepare("SELECT * FROM usuario WHERE id = ?");
    $sentencia->bind_param("i", $id);
    $sentencia->execute();
  
    $resultado = $sentencia->get_result();
    $registro = $resultado->fetch_assoc();
  
    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];
  
    // Actualizar los datos de la sesión
    $_SESSION['usuario'] = $usuario;
    $_SESSION['password'] = $password;
    $_SESSION['correo'] = $correo;
  } else {
    header("Location: login.php");
    exit();
  }
  ?>
<!doctype html>
<html lang="en">
<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script
  src="https://code.jquery.com/jquery-3.6.4.min.js"
  integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
  crossorigin="anonymous"></script>

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

  <script src="http://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<style>
  body {
    background: rgb(9,162,168);
    background: linear-gradient(90deg, rgba(9,162,168,1) 0%, rgba(9,164,168,1) 36%, rgba(9,23,168,1) 72%, rgba(27,140,219,1) 100%);
  }
  .card {
    background: linear-gradient(90deg, #e3ffe7 0%, #d9e7ff 100%);
  }
  .nav-link:hover {
        font-weight: bold;
        color: green;
    }
    .l-nav-links {
        color: black; /* Color predeterminado */
    }

    .l-nav-links:hover {
        font-weight: bold;
        color: red; /* Color al pasar el cursor */
    }
</style>
  <header>
    <!-- place navbar here -->
  </header>
<nav class="navbar navbar-expand navbar-light bg-light">
    <ul class="nav navbar-nav">
    <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == $url_base . 'index_M.php') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>index_M.php" aria-current="page">Cursos Sabatinos<span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == $url_base . '') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>secciones/ficha_inscripcion/">Ficha de Inscripción</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == $url_base . '') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>">Nuevo Ingreso</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($_SERVER['PHP_SELF'] == $url_base . '') ? 'active' : ''; ?>" href="<?php echo $url_base; ?>">Reingreso</a> 
        </li>
        <li class="nav-item">
            <a class="nav-link l-nav-links" href="<?php echo $url_base; ?>cerrar.php">Cerrar sesión</a>
        </li> 
    </ul>
</nav>


  <main class="container">