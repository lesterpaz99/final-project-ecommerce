<?php
global $mysqli;
$idcategoria = $_GET['idcategoria'];
$query = "SELECT idproducto, nombre_producto, precio, url_imagen FROM productos where idcategoria=?";
if ($stmt = $mysqli->prepare($query)) {
  $stmt->bind_param('i', $idcategoria);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($idproducto, $nombre_producto, $precio, $url_imagen);
    $stmt->fetch();
  } else {
    echo "<h3 class='text-center'>No products found</h3>";
  }
} else {
  echo '<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Error!</h4><p>Something went wrong, please try again later.</p>
  </div>';
}
?>
<div class="bg-white">
  <div class="mx-auto max-w-2xl py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
    <h2 class="mb-6 text-2xl font-bold tracking-tight text-gray-900">Fotografías en esta categoría</h2>

    <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
      <a href="?module=product_detail&idproducto=<?php echo $idproducto ?>" class="group">
        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-w-7 xl:aspect-h-8">
          <img src="<?php echo $url_imagen ?>"
            alt="Tall slender porcelain bottle with natural clay textured body and cork stopper."
            class="h-full w-full object-cover object-center group-hover:opacity-75">
        </div>
        <h3 class="mt-4 text-sm text-gray-700">
          <?php echo $nombre_producto ?>
        </h3>
        <p class="mt-1 text-lg font-medium text-gray-900">L.
          <?php echo $precio ?>
        </p>
      </a>

      <!-- More products... -->
    </div>
  </div>
</div>