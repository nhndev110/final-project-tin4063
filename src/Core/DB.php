<?php

namespace App\Core;

use Exception;
use mysqli;

class DB
{
  /**
   * Kết nối mysqli
   * @var mysqli|null
   */
  protected static ?mysqli $connection = null;

  /**
   * Kết nối cơ sở dữ liệu
   */
  private static function connect()
  {
    self::$connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (self::$connection->connect_error) {
      throw new Exception("Database connection failed: " . self::$connection->connect_error);
    }

    self::$connection->set_charset(DB_CHARSET);
  }

  public static function getConnection()
  {
    if (is_null(self::$connection)) self::connect();
    return self::$connection;
  }

  /**
   * - Thực thi một truy vấn SQL và trả về các bản ghi
   * - **Cách sử dụng**: $this->query("SELECT * FROM ten_bang WHERE ten_cot = ?", [$value]);
   *
   * @param string $sql Câu truy vấn SQL cần thực thi.
   * @param array $params Một mảng kết hợp các tham số cần bind vào câu truy vấn.
   * @return array
   */
  public static function query(string $sql, array $params = [])
  {
    if (is_null(self::$connection)) self::connect();
    $stmt = self::$connection->prepare($sql);

    if (!$stmt) {
      throw new Exception("Query failed: " . self::$connection->error);
    }

    if (!empty($params)) {
      $types = '';
      foreach ($params as $param) {
        $types .= is_int($param) ? 'i' : (is_double($param) ? 'd' : 's');
      }
      $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
  }

  /**
   * Thực hiện các thao tác cơ sở dữ liệu như cập nhật, tạo mới và xóa.
   *
   * **Cách sử dụng**:
   * - Cập nhật: $this->execute("UPDATE table_name SET column1 = ? WHERE id = ?", [$value1, $id]);
   * - Tạo mới: $this->execute("INSERT INTO table_name (column1, column2) VALUES (?, ?)", [$value1, $value2]);
   * - Xóa: $this->execute("DELETE FROM table_name WHERE id = ?", [$id]);
   *
   * @param string $sql Câu truy vấn SQL cần thực thi.
   * @param array $params Một mảng kết hợp các tham số cần bind vào câu truy vấn.
   * @return bool Trả về true nếu thành công, false nếu thất bại.
   */
  public static function execute(string $sql, array $params): bool
  {
    if (is_null(self::$connection)) self::connect();
    $stmt = self::$connection->prepare($sql);

    if (!$stmt) {
      throw new Exception("Prepare statement failed: " . self::$connection->error);
    }

    $types = '';
    foreach ($params as $param) {
      $types .= is_int($param) ? 'i' : (is_double($param) ? 'd' : 's');
    }

    $stmt->bind_param($types, ...$params);
    return $stmt->execute();
  }
}
