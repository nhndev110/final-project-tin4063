<?php

use App\Services\AuthService;

ob_start() ?>
<div class="row">
  <div class="col-8">
    <h1 class="fs-4 fw-bold mb-4">Bản Tin Mới Nhất</h1>
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <?php Post(
        1,
        null,
        "Nguyễn Hoàng Nhân",
        "nhndev110",
        2,
        "Bắt đầu từ ngày mai, 25/12/2024, chỉ những tài khoản đã xác thực mới được phép đăng tải, bình luận và chia sẻ thông tin trên mạng xã hội. Đây là quy định mới trong Nghị định số 147. Trong vòng 90 ngày kể từ ngày 25/12, tất cả tổ chức, doanh nghiệp và cá nhân, cả trong nước và quốc tế, cung cấp thông tin xuyên biên giới vào Việt Nam đều phải xác thực các tài khoản đang hoạt động của người sử dụng dịch vụ mạng xã hội theo quy định.",
        "21h10",
        [
          "https://via.placeholder.com/600x400",
          "https://via.placeholder.com/400x600",
          "https://via.placeholder.com/800x600",
          "https://via.placeholder.com/800x600",
          "https://via.placeholder.com/800x600",
          "https://via.placeholder.com/800x600",
        ],
        [
          ["full_name" => "Nguyễn Văn An", "created_at" => "22h00", "content" => "Điều này làm cho việc sử dụng mạng xã hội trở nên khó khăn hơn."],
          ["full_name" => "Trần Thị Bích", "created_at" => "22h05", "content" => "Tôi nghĩ đây là quy định cần thiết."],
          ["full_name" => "Lê Hoàng Phong", "created_at" => "22h10", "content" => "Tôi đồng tình với quy định này."],
          ["full_name" => "Phạm Thị Hồng", "created_at" => "22h15", "content" => "Tôi không đồng ý với quy định này."],
          ["full_name" => "Hoàng Minh Tuấn", "created_at" => "22h20", "content" => "Tôi chưa biết quy định này."],
        ],
        true
      ) ?>
    <?php endfor ?>
  </div>
  <div class="col-4">
    <div class="d-flex align-items-center mb-4 p-3 bg-light rounded shadow-sm">
      <img src="/assets/images/no-avatar.png"
        class="rounded-circle me-3 border border-secondary"
        alt="User"
        style="width: 50px; height: 50px; object-fit: cover;" />
      <div class="flex-grow-1">
        <h6 class="mb-0 fw-bold"><?= htmlspecialchars(AuthService::user()['username']); ?></h6>
        <small class="text-muted"><?= htmlspecialchars(AuthService::user()['full_name']); ?></small>
      </div>
    </div>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>