<?php

use App\Services\AuthService;
use App\Services\FollowService;

$userLoggedIn = AuthService::user();
?>
<?php ob_start() ?>
<div class="card border-0">
  <div class="row g-0">
    <div class="col-md-4 d-flex align-items-center justify-content-center text-white">
      <div class="text-center">
        <img src="<?= is_null_or_white_space($user['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$user['id']}/{$user['profile_picture']}" ?>"
          alt="<?= $user['username'] ?>"
          class="rounded-circle object-fit-cover"
          style="width: 150px; height: 150px; object-position: center;">
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
            <h5 class="mb-0"><?= $follower_count ?></h5>
            <small class="text-muted">Người theo dõi</small>
          </div>
          <div class="text-center">
            <h5 class="mb-0"><?= $followed_count ?></h5>
            <small class="text-muted">Đang theo dõi</small>
          </div>
        </div>
        <h3 class="fs-5 mb-1">Giới thiệu</h3>
        <p><?= $user['bio'] ?? '' ?></p>
        <div class="d-flex">
          <?php if ($user['username'] !== $userLoggedIn['username']) : ?>
            <?php if (FollowService::isFollowing($user['id'])) : ?>
              <a href="/users/<?= $user['id'] ?>/follow" class="btn btn-outline-primary rounded-pill">
                <i class="fa-solid fa-user-check"></i>
                <span class="ms-1">Đang theo dõi</span>
              </a>
            <?php else : ?>
              <a href="/users/<?= $user['id'] ?>/follow" class="btn btn-primary rounded-pill">
                <i class="fa-solid fa-user-plus"></i>
                <span class="ms-1">Theo dõi</span>
              </a>
            <?php endif ?>
          <?php else: ?>
            <a href="/users/<?= $user['username'] ?>/edit" class="edit-profile btn btn-outline-secondary rounded-pill"
              data-bs-toggle="modal" data-bs-target="#editProfileModal">
              <i class="fa-solid fa-user-pen"></i>
              <span class="ms-1">Chỉnh sửa hồ sơ</span>
            </a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>
</div>

<hr class="my-4">

<?php if (empty($posts)): ?>
  <p class="fs-3 text-secondary fw-bold text-center">Không có bài viết</p>
<?php else: ?>
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
<?php endif ?>

<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editProfileModalLabel">Chỉnh sửa hồ sơ</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>

<div class="modal fade" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editPostModalLabel">Chỉnh sửa bài viết</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>
<?php $content = ob_get_clean() ?>

<?php ob_start() ?>
<script>
  $(function() {
    $(".edit-profile").click(function(ev) {
      ev.preventDefault();

      $.ajax({
          url: $(this).prop("href"),
          type: "GET",
          dataType: "html",
        })
        .done((data) => {
          $("#editProfileModal .modal-body").html(data);
          $("#editProfileModal").modal("show");
        });
    });

    $(".edit-post").click(function(ev) {
      ev.preventDefault();

      $.ajax({
          url: $(this).prop("href"),
          type: "GET",
          dataType: "html",
        })
        .done((data) => {
          $("#editPostModal .modal-body").html(data);
          $("#editPostModal").modal("show");
        });
    });

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
  });
</script>
<?php $scripts = ob_get_clean() ?>

<?php include(APP_ROOT . '/templates/layout.php') ?>
