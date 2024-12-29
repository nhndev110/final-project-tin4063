<?php

use App\Services\AuthService;
?>
<?php ob_start() ?>
<div class="card border-0">
  <div class="row g-0">
    <div class="col-md-4 d-flex align-items-center justify-content-center text-white">
      <div class="text-center">
        <img src="<?= is_null($user['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$user['id']}/{$user['profile_picture']}" ?>"
          alt="<?= $user['username'] ?>"
          class="rounded-circle"
          style="width: 150px; height: 150px; object-fit: cover;">
      </div>
    </div>

    <div class="col-md-8">
      <div class="card-body p-0">
        <div class="d-flex align-items-center mb-3">
          <h4 class="mb-0 me-2"><?= $user['full_name'] ?></h4>
          <p class="text-muted fs-6 mb-0">@<?= $user['username'] ?></p>
        </div>
        <div class="d-flex justify-content-start mb-3">
          <div class="text-center me-4">
            <h5 class="mb-0">1200</h5>
            <small class="text-muted">Người theo dõi</small>
          </div>
          <div class="text-center">
            <h5 class="mb-0">340</h5>
            <small class="text-muted">Đang theo dõi</small>
          </div>
        </div>
        <p><?= $user['bio'] ?? '' ?></p>
        <div class="d-flex">
          <?php if ($user['username'] !== AuthService::user()['username']) : ?>
            <button class="btn btn-primary rounded-pill">
              <i class="fa-solid fa-user-plus"></i>
              <span class="ms-1">Theo dõi</span>
            </button>
          <?php else: ?>
            <button class="btn btn-outline-secondary rounded-pill"
              data-bs-toggle="modal" data-bs-target="#editProfileModal">
              <i class="fa-solid fa-user-pen"></i>
              <span class="ms-1">Chỉnh sửa hồ sơ</span>
            </button>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>

<hr class="my-4">

<?php foreach ($posts as $post) : ?>
  <?php
  Post(
    $user['id'],
    $user['profile_picture'],
    $user['full_name'],
    $user['username'],
    $post['id'],
    $post['content'],
    $post['created_at'],
    $post['images'],
    $post['comments'],
    $post['status']
  )
  ?>
<?php endforeach ?>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editProfileModalLabel">Chỉnh sửa hồ sơ</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php if (exists_error('message')) : ?>
          <div class="alert alert-danger py-2 px-3" role="alert">
            <span style="font-size: 0.925rem;"><?= error('message') ?></span>
          </div>
        <?php endif ?>
        <form action="/users/update" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?= $user['id'] ?>">
          <div class="mb-3">
            <label for="full_name" class="form-label fw-medium">Họ và Tên</label>
            <input type="text"
              class="form-control"
              id="full_name"
              name="full_name"
              value="<?= $user['full_name'] ?>"
              required />
            <div class="text-danger mt-2"><?= error("full_name") ?></div>
          </div>
          <div class="mb-3">
            <label for="username" class="form-label fw-medium">Tên đăng nhập</label>
            <input type="text"
              class="form-control"
              id="username"
              name="username"
              value="<?= $user['username'] ?>"
              required />
            <div class="text-danger mt-2"><?= error("username") ?></div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label fw-medium">Email</label>
            <input type="email"
              class="form-control"
              id="email"
              name="email"
              value="<?= $user['email'] ?>"
              required />
            <div class="text-danger mt-2"><?= error("email") ?></div>
          </div>
          <div class="mb-3">
            <label for="profile_picture" class="form-label fw-medium">Ảnh đại diện</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture" />
          </div>
          <div class="mb-3">
            <label for="bio" class="form-label fw-medium">Tiểu sử</label>
            <textarea class="form-control" id="bio" name="bio" rows="3"><?= $user['bio'] ?></textarea>
          </div>
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary fw-medium">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
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

    $.ajax({
        url: $(this).prop("action"),
        type: $(this).prop("method"),
        data: $(this).serializeArray(),
        dataType: "json",
      })
      .done((data) => {
        $(this).trigger("reset");
        showComments(data.post_id);
        $(`#qty-comments-${data.post_id}`).text(data.qty_comments);
      });
  });

  $(".delete-post").click(function(ev) {
    ev.preventDefault();

    const postEl = $(this).closest(".card");

    if (confirm("Bạn có chắc chắn muốn xóa bài viết này?")) {
      $.ajax({
          url: $(this).prop("href"),
          type: "GET",
          dataType: "json",
        })
        .done((data) => {
          if (data.status) {
            postEl.remove();
          }
        });
    }
  });
</script>
<?php $scripts = ob_get_clean() ?>

<?php include(APP_ROOT . '/templates/layout.php') ?>