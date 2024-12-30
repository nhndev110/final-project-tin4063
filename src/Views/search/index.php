<?php

use App\Services\AuthService;
use App\Services\FollowService;

?>
<?php ob_start() ?>
<div class="row">
  <div class="col-8">
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
          <a href="/users/<?= htmlspecialchars($user['username']); ?>" class="text-decoration-none">
            <?php
            $followerCount = FollowService::countFollows($user['id']);
            FollowUserItemWithFollowers(
              $user['full_name'],
              $user['username'],
              $followerCount,
              $user['id']
            );
            ?>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
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