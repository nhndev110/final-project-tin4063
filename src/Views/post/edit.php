<form id="frmUpdatePost" action="/posts/save" method="post" enctype="multipart/form-data">
  <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
  <div class="mb-3">
    <select name="status" class="form-select btn btn-outline-light fw-medium text-dark border" style="width: 180px;">
      <option value="1" <?= $post['status'] ? 'selected' : '' ?>>Công khai</option>
      <option value="0" <?= $post['status'] ?: 'selected' ?>>Chỉ mình tôi</option>
    </select>
    <div class="text-danger mt-2"><?= error("status") ?></div>
  </div>
  <div class="mb-3">
    <textarea rows="3"
      name="content"
      id="content"
      placeholder="Nhập nội dung ..."
      autofocus
      class="form-control"><?= $post['content'] ?></textarea>
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
      <span class="ms-1">Cập nhật</span>
    </button>
  </div>
</form>
<script>
  $(function() {
    // render multiple images
    $("#fileInput").on("change", function(event) {
      const files = event.target.files;
      const $previewContainer = $("#imagePreview");

      $previewContainer.empty();

      Array.from(files).forEach(file => {
        if (file.type.startsWith("image/")) {
          const reader = new FileReader();
          reader.onload = function(e) {
            const col = $("<div>", {
              class: "col-4 mb-3"
            });
            const img = $("<img>", {
              class: "border shadow rounded",
              src: e.target.result,
              alt: file.name,
              css: {
                height: "120px",
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

    // handle update post
    $("#frmUpdatePost").on("submit", function handleUpdatePost(ev) {
      ev.preventDefault();

      const data = $(this).serializeArray();

      const contentObj = data.find(obj => obj.name === 'content');
      const content = contentObj ? contentObj.value : '';

      if (content.trim().length === 0) {
        alert("Vui lòng nhập nội dung");
        return;
      }

      const files = $("#fileInput")[0].files;

      let formData = new FormData();

      for (let i = 0; i < files.length; i++) {
        formData.append('fileInput[]', files[i]);
      }

      data.forEach(item => {
        formData.append(item.name, item.value);
      });

      $.ajax({
        url: $(this).prop("action"),
        type: $(this).prop("method"),
        data: formData,
        dataType: "json",
        processData: false,
        contentType: false,
        success: function(resp) {
          showPostDetail(resp.post_id);
          $("#editPostModal").modal("hide");
        }
      });
    });

    function showPostDetail(postId) {
      $.ajax({
        url: `/posts/${postId}/detail`,
        type: "GET",
        dataType: "html",
      }).done((data) => {
        $(`#post-detail-${postId}`).html(data);
      });
    }
  });
</script>