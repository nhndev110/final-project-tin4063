<?php

use App\Services\AuthService;
?>
<?php ob_start() ?>
<div class="row">
  <div class="col-8">
    <h1 class="fs-2 fw-bold mb-4">Tạo bài viết mới</h1>
    <form action="/posts/save" method="post" enctype="multipart/form-data">
      <div class="mb-3">
        <select name="status" class="form-select btn btn-outline-light fw-medium text-dark border w-25">
          <option value="1" selected>Công khai</option>
          <option value="0">Chỉ mình tôi</option>
        </select>
        <div class="text-danger mt-2"><?= error("status") ?></div>
      </div>
      <div class="mb-3">
        <textarea rows="3"
          name="content"
          id="content"
          placeholder="Nhập nội dung ..."
          autofocus
          class="form-control"></textarea>
        <div class="text-danger mt-2"><?= error("content") ?></div>
      </div>
      <div class="mb-3">
        <input class="form-control" type="file" name="fileInput[]" id="fileInput" multiple />
      </div>
      <div class="mb-3">
        <div id="imagePreview" class="row justify-content-start"></div>
      </div>
      <div class="d-grid justify-content-end">
        <button class="btn btn-primary fw-medium" type="submit">
          <i class="fas fa-paper-plane"></i>
          <span class="ms-1">Đăng</span>
        </button>
      </div>
    </form>
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

<?php ob_start() ?>
<script>
  $(document).ready(function() {
    $("#fileInput").on("change", function(event) {
      const files = event.target.files;
      const $previewContainer = $("#imagePreview");

      $previewContainer.empty();

      Array.from(files).forEach(file => {
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const col = $("<div>", {
              class: "col-3 mb-3"
            });
            const img = $("<img>", {
              class: "border shadow rounded",
              src: e.target.result,
              alt: file.name,
              css: {
                height: "150px",
                objectFit: "cover",
              }
            });

            col.append(img);
            $previewContainer.append(col);
          };
          reader.readAsDataURL(file);
        }
      });
    });
  });
</script>
<?php $scripts = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>