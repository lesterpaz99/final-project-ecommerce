<?php
global $mysqli;
$idproducto = $_GET['idproducto'];
$query = "SELECT idproducto, nombre_producto, descripcion, precio, puntuacion, url_imagen FROM productos where idproducto=?";
if ($stmt = $mysqli->prepare($query)) {
  $stmt->bind_param('i', $idproducto);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
    $stmt->bind_result($idproducto, $nombre_producto, $descripcion, $precio, $puntuacion, $url_imagen);
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
  <div class="pt-6">
    <nav aria-label="Breadcrumb">
      <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <li>
          <div class="flex items-center">
            <a href="#" class="mr-2 text-sm font-medium text-gray-900">Detalle de la fotografía</a>
            <svg width="16" height="20" viewBox="0 0 16 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
              aria-hidden="true" class="h-5 w-4 text-gray-300">
              <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
            </svg>
          </div>
        </li>

        <li>
          <div class="flex items-center">
            <a href="#" class="mr-2 text-sm font-medium text-gray-900">
              <?php echo $nombre_producto ?>
            </a>
          </div>
        </li>
      </ol>
    </nav>

    <div class="flex gap-4 mb-4">
      <!-- Image photo -->
      <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:gap-x-8 lg:px-8">
        <div class="overflow-hidden rounded-lg">
          <img src="<?php echo $url_imagen ?>" alt="" class="h-full w-full object-cover object-center">
        </div>
      </div>
      <!-- Photo info -->
      <div
        class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
          <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
            <?php echo $nombre_producto ?>
          </h1>
        </div>

        <!-- Options -->
        <div class="mt-4 lg:row-span-3 lg:mt-0">
          <h2 class="sr-only">Product information</h2>
          <p class="text-3xl tracking-tight text-gray-900">L.
            <?php echo $precio ?>
          </p>

          <!-- Reviews -->
          <div class="mt-6">
            <h3 class="sr-only">Puntuación</h3>
            <div class="flex items-center">
              <div class="flex items-center">
                <!--
                Heroicon name: mini/star

                Active: "text-gray-900", Default: "text-gray-200"
              -->
                <?php
                for ($i = 0; $i < $puntuacion; $i++) {
                  echo '<svg class="text-gray-900 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                  clip-rule="evenodd" />
              </svg>';
                }
                for ($i = 0; $i < 5 - $puntuacion; $i++) {
                  echo '<svg class="text-gray-200 h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd"
                  d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z"
                  clip-rule="evenodd" />
              </svg>';
                }
                ?>

              </div>
              <!-- <p class="sr-only">4 out of 5 stars</p> -->
              <a href="#" class="ml-3 text-sm font-medium text-indigo-600 hover:text-indigo-500"> Reviews</a>
            </div>
          </div>

          <form class="mt-10">

            <!-- Sizes -->
            <div class="mt-10">
              <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium text-gray-900">Tamaño</h3>
              </div>

              <fieldset class="mt-4">
                <legend class="sr-only">Elige un tamaño</legend>
                <div class="grid grid-cols-4 gap-4 sm:grid-cols-8 lg:grid-cols-4">
                  <!-- Active: "ring-2 ring-indigo-500" -->
                  <label
                    class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-gray-50 text-gray-200 cursor-not-allowed">
                    <input type="radio" name="size-choice" value="XXS" disabled class="sr-only"
                      aria-labelledby="size-choice-0-label">
                    <span id="size-choice-0-label">Tamaño original</span>

                    <span aria-hidden="true"
                      class="pointer-events-none absolute -inset-px rounded-md border-2 border-gray-200">
                      <svg class="absolute inset-0 h-full w-full stroke-2 text-gray-200" viewBox="0 0 100 100"
                        preserveAspectRatio="none" stroke="currentColor">
                        <line x1="0" y1="100" x2="100" y2="0" vector-effect="non-scaling-stroke" />
                      </svg>
                    </span>
                  </label>

                  <!-- Active: "ring-2 ring-indigo-500" -->
                  <label
                    class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                    <input type="radio" name="size-choice" value="XS" class="sr-only"
                      aria-labelledby="size-choice-1-label">
                    <span id="size-choice-1-label">Pequeña</span>

                    <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                    <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                  </label>

                  <!-- Active: "ring-2 ring-indigo-500" -->
                  <label
                    class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                    <input type="radio" name="size-choice" value="S" class="sr-only"
                      aria-labelledby="size-choice-2-label">
                    <span id="size-choice-2-label">Mediana</span>

                    <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                    <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                  </label>

                  <!-- Active: "ring-2 ring-indigo-500" -->
                  <label
                    class="group relative border rounded-md py-3 px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-6 bg-white shadow-sm text-gray-900 cursor-pointer">
                    <input type="radio" name="size-choice" value="M" class="sr-only"
                      aria-labelledby="size-choice-3-label">
                    <span id="size-choice-3-label">Grande</span>

                    <!--
                    Active: "border", Not Active: "border-2"
                    Checked: "border-indigo-500", Not Checked: "border-transparent"
                  -->
                    <span class="pointer-events-none absolute -inset-px rounded-md" aria-hidden="true"></span>
                  </label>

                </div>
              </fieldset>
            </div>

            <a type="submit"
              class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 py-3 px-8 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
              href="javascript:addCart(<?php echo $idproducto ?>)">Agregar
              al carrito</a>
          </form>
        </div>

        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pb-16 lg:pr-8">
          <!-- Description and details -->
          <div>
            <h3 class="sr-only">Description</h3>

            <div class="space-y-6">
              <p class="text-base text-gray-900">
                Descripción:
                <?php echo $descripcion ?>
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
<script>
  function addCart(idproducto) {
    const url = '<?php echo $urlweb ?>services/carrito.php?accion=add&idproducto=' + idproducto;

    fetch(url, {
      method: 'POST',
      body: JSON.stringify({
        idproducto
      })
    })
      .then(response => response.json())
      .then(data => {
        alert('Producto agregado al carrito');
      })
      .catch(error => {
        console.log(error);
      });
  }
</script>