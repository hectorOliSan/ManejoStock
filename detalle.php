<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalle del Producto</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<?php
require "funcionamiento/conexion.php";
include "funcionamiento/elementos.php";
include "funcionamiento/querysR.php";
session_start();
include 'funcionamiento/datos_sesion.php';
?>

<body style="background-color: <?php echo $colorfondo ?>; font-family: <?php echo $tipoletra ?>;">
  <?php
  $accion = $_GET['accion'] != null ? $_GET['accion'] : header('Location:listado.php');
  $accion == "Detalle" ? "" : header('Location:listado.php');
  $id = array_key_exists('id', $_GET) ? $_GET['id'] : "";

  if ($accion == "Detalle") {
    $producto = obtenerPro($id);
    $familia = obtenerProFam($producto['familia']);
  }
  ?>

  <div class="d-flex justify-content-between align-items-center p-3">
    <div class="d-flex align-items-center">
      <a href="index.php" class="mx-2 btn btn-sm btn-danger"><i class="bi bi-power"></i></a>
      <p class="m-0">Cerrar Sesión</p>
    </div>
    <div class="d-flex align-items-center">
      <p class="m-0 font-monospace">Usuario: <b><?php echo $nombrecompleto ?></b></p>
      <form method="POST" action="perfil.php">
        <input type="hidden" name="php" value="detalle.php">
        <input type="hidden" name="accion" value="Detalle">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="mx-2 btn btn-sm btn-secondary"><i class='bi bi-gear-fill'></i></button>
      </form>
    </div>
  </div>

  <div class="container">
    <br>
    <div class="row">
      <div class="col-12">
        <h1 class="font-monospace text-center">Detalle Producto</h1>
      </div>
    </div>

    <div class="card col-8 m-3 mx-auto bg-primary bg-opacity-25">
      <div class="card-header text-center font-monospace fs-5">
        <?php echo $producto['nombre'] ?>
      </div>
      <div class="card-body">
        <h5 class="card-title text-center">Código: <?php echo $producto['id'] ?></h5>
        <p class="card-text">Nombre: <?php echo $producto['nombre'] ?></p>
        <p class="card-text">Nombre Corto: <?php echo $producto['nombre_corto'] ?></p>
        <p class="card-text">Código Familia:
          <?php echo $familia['cod'] ?> - <?php echo $familia['nombre'] ?>
        </p>
        <p class="card-text">PVP (€): <?php echo $producto['pvp'] ?></p>
        <p class="card-text">Descripción: <?php echo $producto['descripcion'] ?></p>
      </div>
    </div>

    <div class="row">
      <a class="col-2 mx-auto m-1 btn btn-secondary" href="listado.php">Volver</a>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>