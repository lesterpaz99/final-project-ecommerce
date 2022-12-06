<div class="relative" aria-labelledby="slide-over-title" aria-modal="true">
  <div class="bg-gray-500 bg-opacity-75 transition-opacity"></div>

  <div>
    <div>
      <div class="pointer-events-none">
        <div class="pointer-events-auto w-[80%] mx-auto">
          <div class="flex h-full flex-col overflow-y-scroll bg-white shadow-xl">
            <div class="flex-1 overflow-y-auto py-6 px-4 sm:px-6">
              <div class="flex items-start justify-between">
                <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Carrito de compras</h2>
                <div class="ml-3 flex h-7 items-center">
                </div>
              </div>

              <div class="mt-8">
                <div class="flow-root">
                  <ul role="list" class="-my-6 divide-y divide-gray-200">
                    <?php
                    global $mysqli;
                    $query = "SELECT carrito.idcarrito, carrito.idproducto, productos.nombre_producto, productos.url_imagen, productos.precio FROM `carrito` INNER JOIN productos ON productos.idproducto=carrito.idproducto";
                    if ($stmt = $mysqli->prepare($query)) {
                      $stmt->execute();
                      $stmt->store_result();
                      if ($stmt->num_rows > 0) {
                        $stmt->bind_result($idcarrito, $idproducto, $nombre_producto, $url_imagen, $precio);
                        $total;
                        while ($stmt->fetch()) {
                          $total += $precio;
                    ?>
                    <li class="flex py-6">
                      <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img src="<?php echo $url_imagen ?>"
                          alt="Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt."
                          class="h-full w-full object-cover object-center">
                      </div>

                      <div class="ml-4 flex flex-1 flex-col">
                        <div>
                          <div class="flex justify-between text-base font-medium text-gray-900">
                            <h3>
                              <a href="#">
                                <?php echo $nombre_producto ?>
                              </a>
                            </h3>
                            <p class="ml-4">L.
                              <?php echo $precio ?>
                            </p>
                          </div>
                          <!-- <p class="mt-1 text-sm text-gray-500">
                            <?php echo $nombre_categoria ?>
                          </p> -->
                        </div>
                        <div class="flex flex-1 items-end justify-between text-sm">

                          <div class="flex">
                            <a type="button" class="font-medium text-indigo-600 hover:text-indigo-500"
                              href="javascript:removeFromCart(<?php echo $idcarrito ?>)">Eliminar</a>
                          </div>
                        </div>
                      </div>
                    </li>
                    <?php
                        }
                      } else {
                        echo "<h3 class='text-center'>No products found</h3>";
                      }
                    } else {
                      echo '<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Error!</h4><p>Something went wrong, please try again later.</p>
  </div>';
                    }
                    ?>

                    <!-- More products... -->
                  </ul>
                </div>
              </div>
            </div>

            <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
              <div class="flex justify-between text-base font-medium text-gray-900">
                <p>Total</p>
                <p>L.
                  <?php echo $total ?>
                </p>
              </div>
              <div class="mt-6">
                <a href="#"
                  class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Pagar</a>
              </div>
              <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                <p>
                  o
                  <a type="button" class="font-medium text-indigo-600 hover:text-indigo-500" href="?module=home">
                    Continuar Comprando
                    <span aria-hidden="true"> &rarr;</span>
                  </a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function removeFromCart(idcarrito) {
    const url = '<?php echo $urlweb ?>services/carrito.php?accion=delete&idcarrito=' + idcarrito;

    fetch(url, {
      method: 'POST',
      body: JSON.stringify({
        idcarrito
      })
    })
      .then(response => response.json())
      .then(data => {
        const row = document.getElementById(idcarrito);
        // remove the row from the table
        row.remove();
        alert('Producto removido del carrito');
      })
      .catch(error => {
        console.log(error);
      });
  }
</script>