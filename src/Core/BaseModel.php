<?php

namespace App\Core;

use Exception;
use mysqli;

abstract class BaseModel
{
  /**
   * Kết nối mysqli
   * @var mysqli|null
   */
  protected static ?mysqli $connection = null;

  /**
   * Tên bảng trong cơ sở dữ liệu
   * @var string
   */
  protected string $table;

  /**
   * Khởi tạo kết nối cơ sở dữ liệu
   */
  public function __construct()
  {
    if (is_null(self::$connection)) $this->connect();

    if (empty($this->table)) {
      throw new Exception("The \$table property must be defined in the subclass " . static::class);
    }
  }

  /**
   * Kết nối cơ sở dữ liệu
   */
  private function connect()
  {
    self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (self::$connection->connect_error) {
      throw new Exception("Database connection failed: " . self::$connection->connect_error);
    }

    self::$connection->set_charset(DB_CHARSET);
  }

  /**
   * Lấy tất cả các bản ghi từ bảng
   *
   * @return array
   */
  public function all(): array
  {
    $sql = "SELECT * FROM {$this->table}";
    $result = self::$connection->query($sql);

    if (!$result) {
      throw new Exception("Query failed: " . self::$connection->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  /**
   * Lấy một bản ghi theo ID
   *
   * @param int $id
   * @return array|null
   */
  public function find(int $id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id = ?";
    $stmt = self::$connection->prepare($sql);

    if (!$stmt) {
      throw new Exception("Prepare statement failed: " . self::$connection->error);
    }

    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc() ?: null;
  }

  /**
   * Thêm một bản ghi mới
   *
   * @param array $data
   * @return bool
   */
  public function create(array $data): bool
  {
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $types = str_repeat('s', count($data));

    $sql = "INSERT INTO {$this->table} ($columns) VALUES ($placeholders)";
    $stmt = self::$connection->prepare($sql);

    if (!$stmt) {
      throw new Exception("Prepare statement failed: " . self::$connection->error);
    }

    $stmt->bind_param($types, ...array_values($data));
    return $stmt->execute();
  }

  /**
   * Cập nhật một bản ghi
   *
   * @param int $id
   * @param array $data
   * @return bool
   */
  public function update(int $id, array $data): bool
  {
    $updates = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));
    $types = str_repeat('s', count($data)) . 'i';

    $sql = "UPDATE {$this->table} SET $updates WHERE id = ?";
    $stmt = self::$connection->prepare($sql);

    if (!$stmt) {
      throw new Exception("Prepare statement failed: " . self::$connection->error);
    }

    $stmt->bind_param($types, ...array_merge(array_values($data), [$id]));
    return $stmt->execute();
  }

  /**
   * Xóa một bản ghi
   *
   * @param int $id
   * @return bool
   */
  public function delete(int $id): bool
  {
    $sql = "DELETE FROM {$this->table} WHERE id = ?";
    $stmt = self::$connection->prepare($sql);

    if (!$stmt) {
      throw new Exception("Prepare statement failed: " . self::$connection->error);
    }

    $stmt->bind_param('i', $id);
    return $stmt->execute();
  }
}
