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

function redirect(string $url)
{
  header("Location: $url");
  return;
}

function redirect_back()
{
  header("Location: {$_SERVER['HTTP_REFERER']}");
  return;
}

function redirect_with_error(string $url, array $error = [])
{
  $_SESSION['error'] = $error;
  header("Location: $url");
  return;
}

function redirect_with_error_and_input(string $url, array $error = [], array $input = [])
{
  $_SESSION['error'] = $error;
  $_SESSION['old'] = $input;
  header("Location: $url");
  return;
}

function exists_error($key)
{
  return isset($_SESSION['error'][$key]);
}

function error($key)
{
  $error = $_SESSION['error'][$key] ?? '';
  unset($_SESSION['error'][$key]);
  return $error;
}

function old($key)
{
  $old = $_SESSION['old'][$key] ?? '';
  unset($_SESSION['old'][$key]);
  return $old;
}

function dd($data)
{
  echo '<pre>';
  var_dump($data);
  echo '</pre>';
  die();
}
