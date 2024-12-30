<?php

use App\Services\AuthService;
?>
<?php ob_start() ?>
<h1 class="fs-4 fw-bold mb-4">Bản Tin Mới Nhất</h1>
<?php if (empty($posts)): ?>
  <p class="fs-3 text-secondary fw-bold text-center">Chưa có bài viết mới nào</p>
<?php else: ?>
  <?php foreach ($posts as $post) : ?>
    <?php
    Post(
      $post['user']['id'],
      $post['user']['profile_picture'],
      $post['user']['full_name'],
      $post['user']['username'],
      $post['id'],
      $post['content'],
      $post['created_at'],
      $post['images'],
      $post['comments'],
      $post['status']
    )
    ?>
  <?php endforeach ?>
<?php endif ?>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
  $(".btn-like").click(function(ev) {
    ev.preventDefault();

    $.ajax({
        url: $(this).prop("href"),
        type: "GET",
        dataType: "json",
      })
      .done((data) => {
        if (data.status) {
          $(this).html(`
            <div class="text-primary">
              <i class="fa-solid fa-thumbs-up"></i>
              <span class="fw-medium ms-1">
                Thích (${data.likes})
              </span>
            </div>
          `);
        } else {
          $(this).html(`
            <div class="text-dark">
              <i class="fa-regular fa-thumbs-up"></i>
              <span class="fw-medium ms-1">
                Thích (${data.likes})
              </span>
            </div>
          `);
        }
      });
  });

  function showComments(postId) {
    $.ajax({
        url: `/posts/${postId}/comments`,
        type: "GET",
        dataType: "html",
      })
      .done((data) => {
        $(`#comments-${postId}`).html(data);
      });
  }

  $(".form-comment").submit(function(ev) {
    ev.preventDefault();

    const data = $(this).serializeArray();

    const contentObj = data.find(obj => obj.name === "content");
    const content = contentObj.value.trim() ?? "";

    if (content === "") {
      alert("Vui lòng nhập nội dùng bình luận");
      return;
    }

    $.ajax({
        url: $(this).prop("action"),
        type: $(this).prop("method"),
        data: data,
        dataType: "json",
      })
      .done((data) => {
        $(this).trigger("reset");
        showComments(data.post_id);
        $(`#qty-comments-${data.post_id}`).text(data.qty_comments);
      });
  });
</script>
<?php $scripts = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>