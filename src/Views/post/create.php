<?php ob_start() ?>
<div class="row">
  <div class="col-8">
    <h1 class="fs-2 fw-bold mb-4">Tạo bài viết mới</h1>
    <form action="/post/save" method="post">
      <div class="mb-3">
        <textarea rows="3"
          name="content"
          id="content"
          placeholder="Nhập nội dung ..."
          class="form-control"></textarea>
      </div>
      <div class="mb-3">
        <input class="form-control" type="file" id="fileInput" multiple />
      </div>
      <div class="mb-3">
        <div id="imagePreview" class="row justify-content-start"></div>
      </div>
      <div class="d-grid justify-content-end">
        <button class="btn btn-primary" type="submit">Đăng</button>
      </div>
    </form>
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

      $.each(files, function(index, file) {
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const col = $("<div>")
              .addClass("col-3 mb-3");

            const img = $("<img>")
              .addClass("border shadow")
              .attr("src", e.target.result)
              .attr("alt", file.name)
              .css({
                height: "150px",
                objectFit: "cover",
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
