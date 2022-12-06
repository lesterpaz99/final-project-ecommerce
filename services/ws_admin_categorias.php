<?php
require('../config.php');

$accion = isset($_GET['accion']) ? $_GET['accion'] : 'default';

try {
  switch ($accion) {
    case 'crear':
      $json = file_get_contents('php://input');
      $data = json_decode($json);

      if (isset($data)) {
        $strsql = 'INSERT INTO categorias (nombre_categoria, descripcion) VALUES (?, ?)';
        $stmt = $mysqli->prepare($strsql);
        $stmt->bind_param('ss', $data->nombre_categoria, $data->descripcion);
        $stmt->execute();
        if ($stmt->errno == 0) {
          $text = 'Categoria creada exitosamente';
        } else {
          $text = 'Error al crear la categoria' . $stmt->error;
        }
      } else {
        $text = 'Error al crear la categoria' . $mysqli->error;
      }
      break;
    case 'actualizar':
      $json = file_get_contents('php://input');
      $data = json_decode($json);

      if (isset($data)) {
        $strsql = 'UPDATE categorias SET nombre_categoria = ?, descripcion = ?';
        $stmt = $mysqli->prepare($strsql);
        $stmt->bind_param('sisssii', $data->nombre_categoria, $data->descripcion);
        $stmt->execute();
        if ($stmt->errno == 0) {
          $text = 'Categoria actualizada exitosamente';
        } else {
          $text = 'Error al actualizar la categoria' . $stmt->error;
        }
      } else {
        $text = 'Error al actualizar la categoria' . $mysqli->error;
      }
      break;
    case 'eliminar':
      $json = file_get_contents('php://input');
      $data = json_decode($json);

      if (isset($data)) {
        $strsql = 'DELETE FROM categorias WHERE idcategoria = ?';
        $stmt = $mysqli->prepare($strsql);
        $stmt->bind_param('i', $data->idcategoria);
        $stmt->execute();
        if ($stmt->errno == 0) {
          $text = 'Categoria eliminada exitosamente';
        } else {
          $text = 'Error al eliminar la categoria' . $stmt->error;
        }
      } else {
        $text = 'Error al eliminar la categoria' . $mysqli->error;
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
    "text" => 'Ha ocurrido un error con la categoria: ' . $e->getMessage()
  );
  echo json_encode($jsonreturn);
}
?>