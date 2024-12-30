<?php

use App\Services\AuthService;

$userLoggedIn = AuthService::user();
?>
<div class="d-flex align-items-center mb-2">
  <img src="<?= is_null_or_white_space($user['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$user['id']}/{$user['profile_picture']}" ?>"
    alt="<?= $user['username'] ?>"
    class="rounded-circle me-3"
    style="width: 40px; height: 40px; object-fit: cover;">
  <div>
    <h6 class="mb-0">
      <a class="link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="/users/<?= $user['username'] ?>">
        <?= htmlspecialchars($user['full_name']) ?>
      </a>
    </h6>
    <small class="text-muted">
      <span><?= date_format(date_create($post['created_at']), "d-m-Y H:i") ?></span>
      <span class="fw-bolder">&#183;</span>
      <?php if ($post['status']): ?>
        <i class="fa-solid fa-earth-americas"></i>
      <?php else: ?>
        <i class="fa-solid fa-lock"></i>
      <?php endif; ?>
    </small>
  </div>
  <?php if (AuthService::isLoggedIn() && $userLoggedIn['username'] === $user['username']): ?>
    <div class="dropdown ms-auto">
      <button class="btn btn-outline-light text-dark rounded-circle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-ellipsis"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end">
        <li>
          <a class="edit-post dropdown-item fw-medium" href="/posts/<?= $post['id'] ?>/edit">
            <i class="fa-solid fa-pen"></i>
            <span class="ms-1">Chỉnh sửa</span>
          </a>
        </li>
        <li>
          <a class="delete-post dropdown-item fw-medium" href="/posts/<?= $post['id'] ?>/delete">
            <i class="fa-solid fa-trash-can"></i>
            <span class="ms-1">Xoá bài viết</span>
          </a>
        </li>
      </ul>
    </div>
  <?php endif; ?>
</div>
<p class="card-text mb-2">
  <?= htmlspecialchars($post['content']) ?>
</p>
<?php if (!empty($images)): ?>
  <div class="swiper-container overflow-hidden">
    <div class="swiper-wrapper">
      <?php foreach ($images as $image): ?>
        <?php if (is_array($image) && isset($image['photo'])): ?>
          <div class="user-select-none swiper-slide">
            <img src="/assets/images/posts/<?= $post['id'] ?>/<?= $image['photo'] ?>"
              alt="Image" class="rounded"
              style="width: 150px; height: 150px; object-fit: cover;" />
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
<?php endif; ?>
<script>
  new Swiper('.swiper-container', {
    slidesPerView: 'auto',
    spaceBetween: 10,
    freeMode: true
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
</script>