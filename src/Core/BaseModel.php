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
    if (is_null(self::$connection)) self::$connection = DB::getConnection();

    if (empty($this->table)) {
      throw new Exception("The \$table property must be defined in the subclass " . static::class);
    }
  }

  /**
   * Lấy tất cả các bản ghi từ bảng
   *
   * @return array
   */
  public static function all(): array
  {
    $sql = "SELECT * FROM " . (new static())->table;
    return DB::query($sql);
  }

  /**
   * Lấy một bản ghi theo ID
   *
   * @param int $id
   * @return array|null
   */
  public static function find(int $id)
  {
    $sql = "SELECT * FROM " . (new static())->table . " WHERE id = ?";
    return DB::query($sql, [$id])[0] ?? null;
  }

  /**
   * Thêm một bản ghi mới vào bảng tương ứng.
   *
   * @param array $data Mảng dữ liệu chứa các cặp khóa-giá trị tương ứng với các cột và giá trị cần thêm vào bảng.
   * @return int Trả về ID của bản ghi vừa được thêm vào nếu thành công, ngược lại trả về 0.
   *
   * Cách sử dụng:
   *
   * $data = [
   *     'column1' => 'value1',
   *     'column2' => 'value2',
   *     // ...
   * ];
   *
   * $id = BaseModel::create($data);
   */
  public static function create(array $data): int
  {
    $table = (new static())->table;
    $columns = implode(', ', array_keys($data));
    $placeholders = implode(', ', array_fill(0, count($data), '?'));
    $types = str_repeat('s', count($data));

    $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
    $stmt = self::$connection->prepare($sql);

    if (!$stmt) {
      throw new Exception("Prepare statement failed: " . self::$connection->error);
    }

    $stmt->bind_param($types, ...array_values($data));
    return $stmt->execute() ? self::$connection->insert_id : 0;
  }

  /**
   * Cập nhật một bản ghi
   *
   * @param int $id
   * @param array $data
   * @return bool
   */
  public static function update(int $id, array $data): bool
  {
    $table = (new static())->table;
    $updates = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));

    $sql = "UPDATE $table SET $updates WHERE id = ?";
    return DB::execute($sql, array_merge(array_values($data), [$id]));
  }

  /**
   * Xóa một bản ghi
   *
   * @param int $id
   * @return bool
   */
  public static function delete(int $id): bool
  {
    $table = (new static())->table;

    $sql = "DELETE FROM $table WHERE id = ?";
    return DB::execute($sql, [$id]);
  }
}
