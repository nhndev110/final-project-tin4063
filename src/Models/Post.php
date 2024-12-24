<?php

namespace App\Models;

use App\Core\BaseModel;

class Post extends BaseModel
{
  protected string $table = "posts";

  public function getOne($id)
  {
    return $this->query("SELECT * FROM $this->table WHERE id = $id");
  }
}
