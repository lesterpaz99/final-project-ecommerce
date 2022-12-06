<?php
global $mysqli;
$idproductoParam = $_GET['idproducto'];
if ($idproductoParam) {
  $query = "SELECT idproducto, nombre_producto, idcategoria, descripcion, precio, puntuacion, url_imagen FROM productos where idproducto=?";
  if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param('i', $idproductoParam);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $stmt->bind_result($idproducto, $nombre_producto, $idcategoria, $descripcion, $precio, $puntuacion, $url_imagen);
      $stmt->fetch();
    } else {
      echo "<h3 class='text-center'>No products found</h3>";
    }
  } else {
    echo '<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Error!</h4><p>Something went wrong, please try again later.</p>
  </div>';
  }
}
?>
<div>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="p-8">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Creación de productos</h3>
        <p class="mt-1 text-sm text-gray-600">n/a
        </p>
      </div>
    </div>
    <div class="mt-5 md:col-span-2 md:mt-0">
      <form action="#" method="POST">
        <div class="shadow sm:overflow-hidden sm:rounded-md">
          <div class="space-y-6 bg-white px-4 py-5 sm:p-6">
            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="nombre_producto" class="block text-sm font-medium text-gray-700">Nombre</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="nombre_producto" id="nombre_producto"
                    class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Nombre de la fotografía"
                    value="<?php echo $nombre_producto ? $nombre_producto : '' ?>">
                </div>
              </div>
            </div>

            <div class="col-span-6 sm:col-span-3">
              <label for="idcategoria" class="block text-sm font-medium text-gray-700">Categoría</label>
              <select id="idcategoria" name="idcategoria" autocomplete="idcategoria"
                class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                <?php
                $query = "SELECT idcategoria, nombre_categoria FROM categorias";
                if ($stmt = $mysqli->prepare($query)) {
                  $stmt->execute();
                  $stmt->store_result();
                  if ($stmt->num_rows > 0) {
                    $stmt->bind_result($idcategoria, $nombre_categoria);
                    $idcategoriaB = $idcategoria;
                    while ($stmt->fetch()) {
                ?>
                <option value="<?php echo $idcategoria ?>" <?php echo $idcategoriaB == $idcategoria ? 'selected' : '' ?>>
                  <?php echo $nombre_categoria ?>
                </option>
                <?php
                    }
                  }
                }
                ?>
              </select>
            </div>

            <div>
              <label for="descripcion" class="block text-sm font-medium text-gray-700">About</label>
              <div class="mt-1">
                <textarea id="descripcion" name="descripcion" rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  placeholder="Agrega una descripcion"><?php echo $descripcion ? $descripcion : '' ?></textarea>
              </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="number" name="precio" id="precio"
                    class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Precio" min="0" value="<?php echo $precio ? $precio : '' ?>">
                </div>
              </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
              <div class="col-span-3 sm:col-span-2">
                <label for="puntuacion" class="block text-sm font-medium text-gray-700">Puntuacion</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="number" name="puntuacion" id="puntuacion"
                    class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Puntuacion (1 - 5)" min="1" max="5"
                    value="<?php echo $puntuacion ? $puntuacion : '' ?>">
                </div>
              </div>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700">Fotografía / Producto</label>
              <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                <div class="space-y-1 text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                    aria-hidden="true">
                    <path
                      d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <div class="flex text-sm text-gray-600">
                    <label for="file-upload"
                      class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
                      <span>Subir archivo</span>
                      <input id="file-upload" name="file-upload" type="file" class="sr-only">
                    </label>
                    <p class="pl-1">o arrastra y suelta aquí</p>
                  </div>
                  <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 10MB</p>
                </div>
              </div>
              <div class="space-y-6 bg-white py-5 sm:p-6">
                <div class="grid grid-cols-3 gap-6">
                  <div class="col-span-3 sm:col-span-2">
                    <div class="mt-1 flex rounded-md shadow-sm">
                      <span
                        class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500">http://</span>
                      <input type="text" name="url_imagen" id="url_imagen"
                        class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                        placeholder="www.path_image.com" value="<?php echo $url_imagen ? $url_imagen : '' ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
              <a type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="<?php echo $idproductoParam ? 'javascript:updateProduct()' : 'javascript:createProducto()' ?>">
                <?php echo $idproductoParam ? 'Actualizar' : 'Guardar' ?>
              </a>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<script>
  function createProducto() {
    const url = '<?php echo $urlweb ?>services/ws_admin_productos.php?accion=crear';

    fetch(url, {
      method: 'POST',
      body: JSON.stringify({
        nombre_producto: document.getElementById('nombre_producto').value,
        idcategoria: document.getElementById('idcategoria').value,
        descripcion: document.getElementById('descripcion').value,
        precio: document.getElementById('precio').value,
        url_imagen: document.getElementById('url_imagen').value,
        puntuacion: document.getElementById('puntuacion').value,
      }),
    })
      .then(response => response.json())
      .then(data => {
        alert('Producto creado exitosamente');
      })
      .catch(error => {
        console.log(error);
      });
  }

  function updateProduct() {
    const url = '<?php echo $urlweb ?>services/ws_admin_productos.php?accion=actualizar';

    fetch(url, {
      method: 'POST',
      body: JSON.stringify({
        idproducto:<?php echo $idproductoParam ? $idproductoParam: 0?>,
        nombre_producto: document.getElementById('nombre_producto').value,
        idcategoria: document.getElementById('idcategoria').value,
        descripcion: document.getElementById('descripcion').value,
        precio: document.getElementById('precio').value,
        url_imagen: document.getElementById('url_imagen').value,
        puntuacion: document.getElementById('puntuacion').value,
      }),
    })
      .then(response => response.json())
      .then(data => {
        alert('Producto actualizado exitosamente');
      })
      .catch(error => {
        console.log(error);
      });
  }
</script>