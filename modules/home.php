<?php
global $mysqli;
$bgImage = 'https://picsum.photos/1040/800/?blur=2';
?>
<!-- Hero -->
<section>
  <div class="dark:bg-neutral-900 text-white">
    <div
      class="container flex flex-col items-center px-4 py-16 pb-24 mx-auto text-center lg:pb-56 md:py-32 md:px-10 lg:px-32 dark:text-gray-900">
      <h1
        class="text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-cyan-600 sm:text-6xl xl:max-w-3xl">
        <span class="block">Explora un mundo de imágenes profesionales</span>
      </h1>
      <p class="mt-6 mb-8 text-lg sm:mb-12 xl:max-w-3xl dark:text-gray-100">La plataforma mas popular para los amantes
        de la fotografía, <br /> <span>empieza a monetizar lo que sabes hacer ✨</span></p>
      <div class="flex flex-wrap justify-center">
        <button type="button"
          class="px-8 py-3 m-2 text-lg font-semibold rounded dark:bg-gray-800 dark:text-gray-50">Empieza ahora</button>
        <button type="button"
          class="px-8 py-3 m-2 text-lg border rounded dark:border-gray-500 dark:text-gray-100">Explora</button>
      </div>
    </div>
  </div>
  <div class="w-5/6 mx-auto mb-12 -mt-20 rounded-lg shadow-md lg:-mt-40 dark:bg-gray-500"></div>
</section>
<!-- Cards: Section 1 -->
<section class="px-10 mb-20">
  <!-- <h2 class="my-5 text-white text-3xl">Fotografías para ti:</h2> -->
  <div class="flex w-full justify-evenly flex-wrap my-4 gap-2">
    <?php
    $query = "SELECT `idproducto`, `nombre_producto`, `idcategoria`, `descripcion`, `precio`, `puntuacion`, `url_imagen`, `fecha_creacion` FROM `productos` ORDER BY idproducto ASC LIMIT 3";
    if ($stmt = $mysqli->prepare($query)) {
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($idproducto, $nombre_producto, $idcategoria, $descripcion, $precio, $puntuacion, $url_imagen, $fecha_creacion);
        while ($stmt->fetch()) {
    ?>
    <div class="card w-96 bg-base-100 shadow-xl rounded-md overflow-hidden">
      <a href="?module=product_detail&idproducto=<?php echo $idproducto ?>">
        <figure><img class="aspect-video" src=<?php echo $url_imagen ?> alt="random" /></figure>
        <div class="card-body">
          <h2 class="card-title">
            <?php echo $nombre_producto ?>
          </h2>
          <p>
            L.
            <?php echo $precio ?>
          </p>
      </a>
      <div class="card-actions justify-end">
        <a class="btn btn-primary" href="javascript:addCart(<?php echo $idproducto ?>)">Agregar al carrito</a>
      </div>
    </div>
  </div>
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
  </div>
</section>
<!-- CTA -->
<section class="bg-gray-100 lg:py-12 lg:flex lg:justify-center mb-20">
  <div class="bg-white lg:mx-8 lg:flex lg:max-w-5xl lg:shadow-lg lg:rounded-lg">
    <div class="lg:w-1/2">
      <div class="h-64 bg-cover lg:rounded-lg lg:h-full"
        style="background-image:url('https://images.unsplash.com/photo-1593642532400-2682810df593?ixlib=rb-1.2.1&ixid=MXwxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&auto=format&fit=crop&w=750&q=80')">
      </div>
    </div>

    <div class="max-w-xl px-6 py-12 lg:max-w-5xl lg:w-1/2">
      <h2 class="text-2xl font-bold text-gray-800 md:text-3xl">Construye tus nuevas <span
          class="text-blue-600">ideas</span>y monetizalas</h2>
      <p class="mt-4 text-gray-600">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem
        modi reprehenderit vitae exercitationem aliquid dolores ullam temporibus enim expedita aperiam mollitia iure
        consectetur dicta tenetur, porro consequuntur saepe accusantium consequatur.</p>

      <div class="mt-8">
        <a href="#"
          class="px-5 py-2 font-semibold text-gray-100 transition-colors duration-300 transform bg-gray-900 rounded-md hover:bg-gray-700">Quiero
          saber mas</a>
      </div>
    </div>
  </div>
</section>
<!-- Carousel: Section 2 -->
<section class="w-full px-10 mb-20">
  <h2 class="text-2xl font-bold text-gray-800 md:text-3xl text-center">Mejores calificadas</h2>
  <p class="text-center">Encuentras todo lo que buscas</p>
  <div class="relative w-full flex gap-4 py-6 overflow-x-auto">
    <img class="h-48 aspect-video rounded-sm object-cover object-center dark:bg-gray-500"
      src="https://placeimg.com/740/580/arch/grayscale" alt="Image 1">
    <img class="h-48 aspect-video rounded-sm object-cover object-center dark:bg-gray-500"
      src="https://placeimg.com/640/480/arch/grayscale" alt="Image 2">
    <img class="h-48 aspect-video rounded-sm object-cover object-center dark:bg-gray-500"
      src="https://placeimg.com/642/482/arch/grayscale" alt="Image 3">
    <img class="h-48 aspect-video rounded-sm object-cover object-center dark:bg-gray-500"
      src="https://placeimg.com/650/490/arch/grayscale" alt="Image 4">
    <img class="h-48 aspect-video rounded-sm object-cover object-center dark:bg-gray-500"
      src="https://placeimg.com/645/485/arch/grayscale" alt="Image 5">
  </div>
</section>
<!-- Cards: Section 1 -->
<section class="px-10 mb-20">
  <h2 class="text-2xl font-bold text-gray-800 md:text-3xl mb-8">Explora por categorías:</h2>
  <div class="flex justify-evenly flex-wrap my-4 gap-2">
    <?php
    // inner join para traer el nombre de la categoría
    $query = "SELECT productos.idproducto, productos.nombre_producto, categorias.idcategoria, categorias.nombre_categoria, productos.descripcion, productos.url_imagen, productos.precio, productos.puntuacion FROM `productos` INNER JOIN categorias ON categorias.idcategoria=productos.idcategoria";
    if ($stmt = $mysqli->prepare($query)) {
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
        $stmt->bind_result($idproducto, $nombre_producto, $nombre_categoria, $idcategoria, $descripcion, $url_imagen, $precio, $puntuacion);
        while ($stmt->fetch()) {
    ?>
    <div class="flex flex-col items-center justify-center w-full max-w-sm mx-auto">
      <div class="w-full h-64 bg-gray-300 bg-center bg-cover rounded-lg shadow-md"
        style="background-image: url(<?php echo $url_imagen ?>)">
      </div>

      <div class="w-56 -mt-10 overflow-hidden bg-white rounded-lg shadow-lg md:w-64 dark:bg-gray-800">
        <h3 class="py-2 font-bold tracking-wide text-center text-gray-800 uppercase dark:text-white">
          <?php echo $idcategoria ?>
        </h3>

        <div class="flex items-center justify-between px-3 py-2 bg-gray-200 dark:bg-gray-700">
          <span class="font-bold text-gray-800 dark:text-gray-200">Lorem</span>
          <a class="px-2 py-1 text-xs font-semibold text-white uppercase transition-colors duration-300 transform bg-gray-800 rounded hover:bg-gray-700 dark:hover:bg-gray-600 focus:bg-gray-700 dark:focus:bg-gray-600 focus:outline-none"
            href="?module=products_by_category&idcategoria=<?php echo $nombre_categoria ?>">Ver
            categoría</a>
        </div>
      </div>
    </div>
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
  </div>
</section>
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