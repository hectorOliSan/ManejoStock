<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Producto</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<?php
require "funcionamiento/conexion.php";
include "funcionamiento/elementos.php";
include "funcionamiento/querysR.php";
include "funcionamiento/querysCUD.php";
session_start();
include 'funcionamiento/datos_sesion.php';
?>

<body style="background-color: <?php echo $colorfondo ?>; font-family: <?php echo $tipoletra ?>;">
  <?php
  !empty($_GET) && !array_key_exists('accion', $_GET) ? header('Location:listado.php') : "";
  $accion = array_key_exists('accion', $_GET) ? $_GET['accion'] : "";
  $accion == "Mover Stock" ? "" : header('Location:listado.php');
  $id = array_key_exists('id', $_GET) ? $_GET['id'] : "";

  if (sizeof($_GET) == 5) moverStock($_GET);

  $producto = obtenerPro($id);
  $stock = obtenerProStock($id);
  ?>

  <div class="d-flex justify-content-between align-items-center p-3">
    <div class="d-flex align-items-center">
      <a href="index.php" class="mx-2 btn btn-sm btn-danger"><i class="bi bi-power"></i></a>
      <p class="m-0">Cerrar Sesión</p>
    </div>
    <div class="d-flex align-items-center">
      <p class="m-0 font-monospace">Usuario: <b><?php echo $nombrecompleto ?></b></p>
      <form method="POST" action="perfil.php">
        <input type="hidden" name="php" value="moverstock.php">
        <input type="hidden" name="accion" value="Mover Stock">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="mx-2 btn btn-sm btn-secondary"><i class='bi bi-gear-fill'></i></button>
      </form>
    </div>
  </div>

  <div class="container">
    <br>
    <div class="row">
      <div class="col-12">
        <h1 class="font-monospace text-center">Mover Stock</h1>
        <?php
        echo "<h3 class='font-monospace text-center'>Producto: " .
          $producto['id'] . " - " . $producto['nombre_corto'] . "</h3>";
        if (empty($stock)) {
          echo "<br><br>";
          echo "<h3 class='text-center fw-bold'>";
          echo "Actualmente no existe stock de este producto";
          echo "</h3>";
          echo "<br><br>";
        } else {
        ?>
          <br>
          <table class="table table-striped align-middle text-center">
            <thead>
              <tr>
                <th>Tienda</th>
                <th>Stock</th>
                <th>Nueva Tienda</th>
                <th>Nº Unidades</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($stock as $clave => $valor) {
                echo "<form method='GET' action='moverstock.php'>";
                echo "<input type='hidden' name='tienda' value='" . $valor['tienda_id'] . "'>";
                echo "<p></p>";
                echo "<tr>";
                echo "<td>" . $valor['tienda'] . "</td>";
                echo "<th>" . $valor['unidades'] . "</th>";
                echo "<th>";
                $tienda = obtenerTienda($valor['tienda_id']);
              ?>
                <select class='form-select' name='nueva_tienda' required>;
                  <?php
                  foreach ($tienda as $clave_t => $valor_t) {
                    echo "<option value='" . $valor_t['id'] . "'>" . $valor_t['nombre'] . "</option>";
                  }
                  ?>
                </select>
            <?php
                echo "</th>";
                echo "<td>";
                echo "<input type='number' class='form-control' name='unidades'
                  min=1 max='" . $valor['unidades'] . "' placeholder='Unidades' value='' required>";
                echo "</td>";
                echo "<td>";
                crearBoton("Mover Stock", "primary", "moverstock.php", $id);
                echo "</td>";
                echo "</tr>";
                echo "</form>";
              }
            }
            ?>
            </tbody>
          </table>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <a class="col-3 mx-auto m-1 btn btn-secondary" href="listado.php">Volver</a>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>