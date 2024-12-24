<?php

namespace App\Core;

class Router
{
  private $routes = [];

  public function addRoute($pattern, $callback)
  {
    $regex = '#^' . $pattern . '(\?.*)?$#';
    $this->routes[$regex] = $callback;
  }

  public function match($uri)
  {
    // Sort routes by specificity (longer patterns first)
    uksort($this->routes, function ($a, $b) {
      return strlen($b) - strlen($a);
    });

    foreach ($this->routes as $pattern => $callback) {
      if (preg_match($pattern, $uri, $matches)) {
        array_shift($matches); // Remove the full match
        call_user_func_array($callback, $matches);
        return;
      }
    }

    header("HTTP/1.0 404 Not Found");
    echo "404 Not Found";
  }
}
