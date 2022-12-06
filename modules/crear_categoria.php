<?php
global $mysqli;
$idcategoriaParam = $_GET['idcategoria'];
if ($idcategoriaParam) {
  $query = "SELECT idcategoria, nombre_categoria, descripcion FROM categorias where idcategoria=?";
  if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param('i', $idcategoriaParam);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
      $stmt->bind_result($idcategoria, $nombre_categoria, $descripcion);
      $stmt->fetch();
    } else {
      echo "<h3 class='text-center'>No categories found</h3>";
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
        <h3 class="text-lg font-medium leading-6 text-gray-900">Creación de categorías</h3>
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
                <label for="nombre_categoria" class="block text-sm font-medium text-gray-700">Nombre</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                  <input type="text" name="nombre_categoria" id="nombre_categoria"
                    class="block w-full flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    placeholder="Nombre de la fotografía"
                    value="<?php echo $nombre_categoria ? $nombre_categoria : '' ?>">
                </div>
              </div>
            </div>

            <div>
              <label for="descripcion" class="block text-sm font-medium text-gray-700">About</label>
              <div class="mt-1">
                <textarea id="descripcion" name="descripcion" rows="3"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm py-2 px-3 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                  placeholder="Agrega una descripcion"><?php echo $descripcion ? $descripcion : '' ?></textarea>
              </div>
            </div>

            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
              <a type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="<?php echo $idcategoriaParam ? 'javascript:updateCategoria()' : 'javascript:createCategoria()' ?>">
                <?php echo $idcategoriaParam ? 'Actualizar' : 'Guardar' ?>
              </a>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
<script>
  function createCategoria() {
    const url = '<?php echo $urlweb ?>services/ws_admin_categorias.php?accion=crear';

    fetch(url, {
      method: 'POST',
      body: JSON.stringify({
        nombre_categoria: document.getElementById('nombre_categoria').value,
        descripcion: document.getElementById('descripcion').value,
      }),
    })
      .then(response => response.json())
      .then(data => {
        alert('Categoria creada exitosamente');
      })
      .catch(error => {
        console.log(error);
      });
  }

  function updateCategoria() {
    const url = '<?php echo $urlweb ?>services/ws_admin_categorias.php?accion=actualizar';

    fetch(url, {
      method: 'POST',
      body: JSON.stringify({
        idcategoria:<?php echo $idcategoriaParam? $idcategoriaParam : 0 ?>,
        nombre_categoria: document.getElementById('nombre_categoria').value,
        descripcion: document.getElementById('descripcion').value,
      }),
    })
      .then(response => response.json())
      .then(data => {
        alert('Categoria actualizada exitosamente');
      })
      .catch(error => {
        console.log(error);
      });
  }
</script>