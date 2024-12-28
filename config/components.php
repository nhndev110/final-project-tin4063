<?php

use App\Services\AuthService;
use App\Services\LikeService;

/**
 * Tạo một bài viết mới.
 *
 * @param int $user_id ID của người dùng đã tạo bài viết.
 * @param string $full_name Tên đầy đủ của người dùng.
 * @param string $username Tên đăng nhập của người dùng.
 * @param int $post_id ID của bài viết.
 * @param string $content Nội dung của bài viết.
 * @param string $created_at Ngày và giờ tạo bài viết.
 * @param int $likes Số lượt thích mà bài viết đã nhận được.
 * @param array $images Một mảng các hình ảnh liên quan đến bài viết.
 * @param array $comments Một mảng các bình luận về bài viết.
 * @param bool $status Trạng thái của bài viết (ví dụ: đã xuất bản hay chưa).
 */
function Post(
  int $user_id,
  $profile_picture,
  string $full_name,
  string $username,
  int $post_id,
  string $content,
  string $created_at,
  array $images,
  array $comments,
  bool $status
) { ?>
  <?php $userLogin = AuthService::user() ?>
  <div class="card shadow-sm mb-4">
    <div class="card-body pb-2">
      <div class="d-flex align-items-center mb-2">
        <img src="<?= is_null($profile_picture) ? "/assets/images/no-avatar.png" : "/assets/images/users/$user_id/$profile_picture" ?>"
          alt="<?= $username ?>"
          class="rounded-circle me-3"
          style="width: 40px; height: 40px; object-fit: cover;">
        <div>
          <h6 class="mb-0">
            <a class="link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="/users/<?= $username ?>">
              <?= htmlspecialchars($full_name) ?>
            </a>
          </h6>
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
        <?php if (AuthService::isLoggedIn() && $userLogin['username'] === $username): ?>
          <div class="dropdown ms-auto">
            <button class="btn btn-outline-light text-dark rounded-circle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-ellipsis"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item fw-medium" href="#">
                  <i class="fa-solid fa-pen"></i>
                  <span class="ms-1">Chỉnh sửa</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item fw-medium" href="/posts/<?= $post_id ?>/delete">
                  <i class="fa-solid fa-trash-can"></i>
                  <span class="ms-1">Xoá bài viết</span>
                </a>
              </li>
            </ul>
          </div>
        <?php endif; ?>
      </div>
      <p class="card-text">
        <?= htmlspecialchars($content); ?>
      </p>
      <?php if (!empty($images)): ?>
        <div class="swiper-container overflow-hidden mb-2">
          <div class="swiper-wrapper">
            <?php foreach ($images as $image): ?>
              <?php if (is_array($image) && isset($image['photo'])): ?>
                <div class="user-select-none swiper-slide">
                  <img src="/assets/images/posts/<?= $post_id ?>/<?= $image['photo'] ?>"
                    alt="Image" class="rounded"
                    style="width: 150px; height: 150px; object-fit: cover;" />
                </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="d-flex justify-content-between align-items-center">
        <?php if (LikeService::isPostLiked($post_id)) : ?>
          <a href="/posts/<?= $post_id ?>/like" class="btn-like text-decoration-none py-1 px-3 rounded">
            <i class="fa-solid fa-thumbs-up"></i>
            <span class="fw-medium ms-1">Thích (<?= LikeService::countLikes($post_id) ?>)</span>
          </a>
        <?php else: ?>
          <a href="/posts/<?= $post_id ?>/like" class="btn-like text-dark text-decoration-none py-1 px-3 rounded">
            <i class="fa-regular fa-thumbs-up"></i>
            <span class="fw-medium ms-1">Thích (<?= LikeService::countLikes($post_id) ?>)</span>
          </a>
        <?php endif ?>
        <div href="#" class="text-decoration-none text-dark py-1 px-3">
          <i class="fa-regular fa-comments"></i>
          <span class="fw-medium">Bình luận (<?= count($comments); ?>)</span>
        </div>
      </div>
    </div>
    <div class="card-footer bg-white p-0">
      <div class="comments px-3" style="max-height: 300px; overflow-y: auto;">
        <?php foreach ($comments as $comment): ?>
          <?php $comment_user = $comment['user'] ?>
          <div class="d-flex my-3">
            <img src="<?= is_null($comment_user['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$comment_user['id']}/{$comment_user['profile_picture']}" ?>"
              alt="<?= $comment_user['username'] ?>"
              class="rounded-circle me-3"
              style="width: 40px; height: 40px; object-fit: cover;">
            <div>
              <h6 class="mb-0">
                <a class="link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="/users/<?= $comment_user['username'] ?>">
                  <?= $comment_user['full_name'] ?>
                </a>
              </h6>
              <small class="text-muted"><?= htmlspecialchars($comment['created_at']) ?></small>
              <p class="mb-0"><?= htmlspecialchars($comment['content']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="d-flex px-3 py-2 border-top">
        <img src="<?= is_null($userLogin['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$userLogin['id']}/{$userLogin['profile_picture']}" ?>"
          alt="<?= $userLogin['username'] ?>"
          class="rounded-circle me-3"
          style="width: 40px; height: 40px; object-fit: cover;">
        <form action="/posts/<?= $post_id ?>/comment/create" method="post" class="d-flex flex-grow-1">
          <input type="hidden" name="user_id" value="<?= $userLogin['id'] ?>">
          <input type="text" name="content"
            class="form-control rounded-pill flex-grow-1 no-focus-ring"
            placeholder="Viết bình luận..." autocomplete="off" />
          <button class="btn ms-1 rounded-circle">
            <i class="fa-solid fa-paper-plane text-primary"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<?php function FollowUserItemWithFollowers(
  string $full_name,
  string $username,
  int $followers,
  int $followed_id
) { ?>
  <div class="d-flex align-items-center mb-4">
    <img src="/assets/images/no-avatar.png"
      class="rounded-circle me-3"
      alt="User"
      style="width: 40px; height: 40px; object-fit: cover;" />
    <div class="flex-grow-1">
      <h6 class="mb-0"><?= htmlspecialchars($username); ?></h6>
      <small class="text-muted"><?= htmlspecialchars($full_name); ?></small>
      <span class="fw-bolder">&#183;</span>
      <small class="text-muted"><?= htmlspecialchars($followers); ?> Người theo dõi</small>
    </div>
    <a href="/follow/create/<?= $followed_id ?>" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">
      <i class="fa-solid fa-user-plus"></i>
      <span>Theo dõi</span>
    </a>
  </div>
<?php } ?>