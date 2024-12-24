<?php function Post(
  string $full_name,
  string $username,
  string $created_at,
  string $content,
  array $images,
  int $likes,
  array $comments,
  bool $status
) { ?>
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
        <div>
          <h6 class="mb-0"><?= htmlspecialchars($full_name); ?></h6>
          <small class="text-muted">
            <span><?= htmlspecialchars($created_at); ?></span>
            <span class="fw-bolder">&#183;</span>
            <?php if ($status): ?>
              <i class="fa-solid fa-earth-americas"></i>
            <?php else: ?>
              <i class="fa-solid fa-lock"></i>
            <?php endif; ?>
          </small>
        </div>
        <?php if (isset($_SESSION['loggedInUsername']) && $username === $_SESSION['loggedInUsername']): ?>
          <div class="dropdown ms-auto">
            <button class="btn btn-outline-light text-dark rounded-circle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="#">Chỉnh sửa</a></li>
              <li><a class="dropdown-item" href="#">Xoá bài viết</a></li>
            </ul>
          </div>
        <?php endif; ?>
      </div>
      <p class="card-text">
        <?= htmlspecialchars($content); ?>
      </p>
      <?php if (!empty($images)): ?>
        <div class="swiper-container overflow-hidden mb-3">
          <div class="swiper-wrapper">
            <?php foreach ($images as $image): ?>
              <div class="user-select-none swiper-slide">
                <img src="<?= htmlspecialchars($image); ?>"
                  alt="Image" class="rounded img-fluid"
                  style="width: 150px; height: 150px; object-fit: cover;" />
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="d-flex justify-content-between align-items-center">
        <a href="#" class="text-decoration-none text-primary">
          <i class="fa-solid fa-thumbs-up"></i>
          <span class="fw-medium ms-1">Thích (<?= htmlspecialchars($likes); ?>)</span>
        </a>
        <a href="#" class="text-decoration-none text-dark">
          <i class="fa-regular fa-comments"></i>
          <span class="fw-medium">Bình luận (<?= count($comments); ?>)</span>
        </a>
      </div>
    </div>
    <div class="card-footer bg-white p-3">
      <div class="comments">
        <?php foreach ($comments as $comment): ?>
          <div class="d-flex mb-3">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User" style="height: 40px; width: auto;">
            <div>
              <h6 class="mb-0"><?= htmlspecialchars($comment['full_name']); ?></h6>
              <small class="text-muted"><?= htmlspecialchars($comment['created_at']); ?></small>
              <p class="mb-0"><?= htmlspecialchars($comment['content']); ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="d-flex">
        <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
        <form action="" class="d-flex flex-grow-1">
          <input type="text" class="form-control rounded-pill flex-grow-1 no-focus-ring" placeholder="Viết bình luận...">
          <button class="btn ms-1 rounded-circle">
            <i class="fa-solid fa-paper-plane text-primary"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<?php function FollowUserItem(
  string $username,
  string $full_name
) { ?>
  <div class="d-flex align-items-center mb-3">
    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
    <div class="flex-grow-1">
      <h6 class="mb-0"><?= htmlspecialchars($username); ?></h6>
      <small class="text-muted"><?= htmlspecialchars($full_name); ?></small>
    </div>
    <a href="#" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">Theo dõi</a>
  </div>
<?php } ?>

<?php function FollowUserItemWithFollowers(
  string $username,
  string $full_name,
  int $followers
) { ?>
  <div class="d-flex align-items-center mb-4">
    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
    <div class="flex-grow-1">
      <h6 class="mb-0"><?= htmlspecialchars($username); ?></h6>
      <small class="text-muted"><?= htmlspecialchars($full_name); ?></small>
      <span class="fw-bolder">&#183;</span>
      <small class="text-muted"><?= htmlspecialchars($followers); ?> Người theo dõi</small>
    </div>
    <a href="#" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">Theo dõi</a>
  </div>
<?php } ?>

<?php function FollowSuggestions(
  array $suggestions
) { ?>
  <div class="container mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="mb-0">Gợi ý theo dõi</h6>
    </div>
    <?php foreach ($suggestions as $suggestion): ?>
      <?php FollowUserItem($suggestion['username'], $suggestion['full_name']); ?>
    <?php endforeach; ?>
  </div>
<?php } ?>