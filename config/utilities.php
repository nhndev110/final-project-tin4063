<?php

/**
 * Thêm 1 view vào
 */
function view($view, $data = [])
{
  $file = APP_ROOT . '\src\Views' . '\\' . $view . '.php';

  if (is_readable($file)) {
    extract($data);
    require_once $file;
  } else {
    die('<h1> 404 Page not found </h1>');
  }
}


/**
 * Điều hướng sang trang khác
 */
function redirect($url)
{
  header("Location: $url");
  return;
}
