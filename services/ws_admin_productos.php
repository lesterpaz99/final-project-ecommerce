<?php
require('../config.php');

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'default';

try {
  switch ($accion) {
    case 'crear':
      $json = file_get_contents('php://input');
      $data = json_decode($json);

      if (isset($data)) {
        $strsql = 'INSERT INTO productos (nombre_producto, idcategoria, descripcion, url_imagen, precio, puntuacion) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = $mysqli->prepare($strsql);
        $stmt->bind_param('sisssi', $data->nombre_producto, $data->idcategoria, $data->descripcion, $data->url_imagen, $data->precio, $data->puntuacion);
        $stmt->execute();
        if ($stmt->errno == 0) {
          $text = 'Producto creado exitosamente';
        } else {
          $text = 'Error al crear el producto' . $stmt->error;
        }
      } else {
        $text = 'Error al crear el producto' . $mysqli->error;
      }
      break;
    case 'actualizar':
      $json = file_get_contents('php://input');
      $data = json_decode($json);

      if (isset($data)) {
        $strsql = 'UPDATE productos SET nombre_producto = ?, idcategoria = ?, descripcion = ?, url_imagen = ?, precio = ?, puntuacion = ? WHERE idproducto = ?';
        $stmt = $mysqli->prepare($strsql);
        $stmt->bind_param('sisssii', $data->nombre_producto, $data->idcategoria, $data->descripcion, $data->url_imagen, $data->precio, $data->puntuacion, $data->idproducto);
        $stmt->execute();
        if ($stmt->errno == 0) {
          $text = 'Producto actualizado exitosamente';
        } else {
          $text = 'Error al actualizar el producto' . $stmt->error;
        }
      } else {
        $text = 'Error al actualizar el producto' . $mysqli->error;
      }
      break;
    case 'eliminar':
      $json = file_get_contents('php://input');
      $data = json_decode($json);

      if (isset($data)) {
        $strsql = 'DELETE FROM productos WHERE idproducto = ?';
        $stmt = $mysqli->prepare($strsql);
        $stmt->bind_param('i', $data->idproducto);
        $stmt->execute();
        if ($stmt->errno == 0) {
          $text = 'Producto eliminado exitosamente';
        } else {
          $text = 'Error al eliminar el producto' . $stmt->error;
        }
      } else {
        $text = 'Error al eliminar el producto' . $mysqli->error;
      }
      break;
    case 'default':
      break;
  }

  $jsonreturn = array(
    "text" => $text
  );
  echo json_encode($jsonreturn);
} catch (Exception $e) {
  $jsonreturn = array(
    "text" => 'Ha ocurrido un error con el producto: ' . $e->getMessage()
  );
  echo json_encode($jsonreturn);
}
?>