<?php

use App\Services\AuthService;

ob_start() ?>
<div class="card border-0">
  <div class="row g-0">
    <div class="col-md-4 d-flex align-items-center justify-content-center text-white">
      <div class="text-center">
        <img src="/assets/images/no-avatar.png"
          alt="Profile Picture"
          class="rounded-circle"
          style="width: 150px; height: 150px; object-fit: cover;">
      </div>
    </div>

    <div class="col-md-8">
      <div class="card-body p-0">
        <h4 class="mb-3"><?= $user['full_name'] ?></h4>
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
        <p>Tôi là Nhân</p>
        <?php if ($user['username'] !== AuthService::user()['username']) : ?>
          <div class="d-flex">
            <button class="btn btn-primary rounded-pill">
              <i class="fa-solid fa-user-plus"></i>
              <span>Theo dõi</span>
            </button>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>
</div>

<hr class="my-4">

<div class="row">
  <div class="col-8">
    <?php foreach ($posts as $post) : ?>
      <?php
      Post(
        $user['id'],
        $user['full_name'],
        $user['username'],
        $post['id'],
        $post['content'],
        $post['created_at'],
        0,
        $post['images'],
        $post['comments'],
        $post['status']
      )
      ?>
    <?php endforeach ?>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>