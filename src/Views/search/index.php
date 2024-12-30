<?php

use App\Services\AuthService;
use App\Services\FollowService;

?>
<?php ob_start() ?>
<h1 class="fs-4 fw-bold mb-4">Tìm kiếm</h1>
<form action="" method="get" class="w-100">
  <div class="input-group">
    <button class="btn border border-end-0 rounded-start-pill" type="submit">
      <i class="fa-solid fa-magnifying-glass"></i>
    </button>
    <input type="text"
      class="form-control shadow-none border border-start-0 rounded-end-pill px-0"
      placeholder="Tìm kiếm người dùng ..."
      value="<?= $_GET['q'] ?? '' ?>"
      name="q" autocomplete="off" autofocus />
  </div>
</form>
<ul class="nav nav-tabs my-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active"
      id="pills-user-tab"
      data-bs-toggle="pill"
      data-bs-target="#pills-user"
      type="button"
      role="tab"
      aria-controls="pills-user"
      aria-selected="true">Người dùng</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active"
    id="pills-user"
    role="tabpanel"
    aria-labelledby="pills-user-tab"
    tabindex="0">
    <?php foreach ($users as $user): ?>
      <?php
      $followerCount = FollowService::getFollowerCount($user['id']);
      FollowUserItemWithFollowers(
        $user['id'],
        $user['full_name'],
        $user['username'],
        $user['profile_picture'],
        $followerCount,
      );
      ?>
    <?php endforeach; ?>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>
