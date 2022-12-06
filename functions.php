<?php
class Functions
{
  var $mysqli;
  function __construct()
  {
    $this->mysqli = $mysqli;
  }

  function openModule($idModule)
  {
    if (file_exists("modules/$idModule.php")) {
      require "modules/$idModule.php";
    } else {
      echo "<img src='https://www.gstatic.com/youtube/src/web/htdocs/img/monkey.png' class='img-fluid' alt='404'>";
    }
  }
}
?>