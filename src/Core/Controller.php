<?php

namespace App\Core;

class Controller
{
  protected function render($view_name, $data = [])
  {
    extract($data);

    include APPROOT . "\src\Views\\$view_name.php";
  }
}
