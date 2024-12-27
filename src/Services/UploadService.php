<?php

namespace App\Services;

use Exception;

class UploadService
{
  public static function uploadMultipleFile($files, $directory_path): array
  {
    $directory_path = APP_ROOT . $directory_path;
    if (!is_dir($directory_path)) {
      if (!mkdir($directory_path)) {
        throw new Exception("Failed to create directory: $directory_path");
      }
    }

    $files_name = [];
    $file_quantity = count($files['name']);
    for ($i = 0; $i < $file_quantity; $i++) {
      $file = [
        'name' => $files['name'][$i],
        'type' => $files['type'][$i],
        'tmp_name' => $files['tmp_name'][$i],
        'error' => $files['error'][$i],
        'size' => $files['size'][$i]
      ];

      $file_path = $directory_path . '/' . $file['name'];
      if (!move_uploaded_file($file['tmp_name'], $file_path)) {
        throw new Exception("Failed to move uploaded file: " . $file['name']);
      }

      $files_name[] = $file['name'];
    }

    return $files_name;
  }
}
