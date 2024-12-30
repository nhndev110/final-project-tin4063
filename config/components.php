<?php

use App\Services\AuthService;
use App\Services\FollowService;
use App\Services\LikeService;

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
  <?php $userLoggedIn = AuthService::user() ?>
  <div class="card shadow-sm mb-4">
    <div class="card-body pb-2">
      <div id="post-detail-<?= $post_id ?>" class="mb-2">
        <div class="d-flex align-items-center mb-2">
          <img src="<?= is_null_or_white_space($profile_picture) ? "/assets/images/no-avatar.png" : "/assets/images/users/$user_id/$profile_picture" ?>"
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
              <span><?= date_format(date_create($created_at), "d-m-Y H:i") ?></span>
              <span class="fw-bolder">&#183;</span>
              <?php if ($status): ?>
                <i class="fa-solid fa-earth-americas"></i>
              <?php else: ?>
                <i class="fa-solid fa-lock"></i>
              <?php endif; ?>
            </small>
          </div>
          <?php if (AuthService::isLoggedIn() && $userLoggedIn['username'] === $username): ?>
            <div class="dropdown ms-auto">
              <button class="btn btn-outline-light text-dark rounded-circle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="edit-post dropdown-item fw-medium" href="/posts/<?= $post_id ?>/edit">
                    <i class="fa-solid fa-pen"></i>
                    <span class="ms-1">Chỉnh sửa</span>
                  </a>
                </li>
                <li>
                  <a class="delete-post dropdown-item fw-medium" href="/posts/<?= $post_id ?>/delete">
                    <i class="fa-solid fa-trash-can"></i>
                    <span class="ms-1">Xoá bài viết</span>
                  </a>
                </li>
              </ul>
            </div>
          <?php endif; ?>
        </div>
        <p class="card-text mb-2">
          <?= htmlspecialchars($content) ?>
        </p>
        <?php if (!empty($images)): ?>
          <div class="swiper-container overflow-hidden">
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
      </div>
      <div class="d-flex justify-content-between align-items-center">
        <?php if (LikeService::isPostLiked($post_id)) : ?>
          <a href="/posts/<?= $post_id ?>/like" class="btn-like text-decoration-none py-1 px-3 rounded">
            <div class="text-primary">
              <i class="fa-solid fa-thumbs-up"></i>
              <span class="fw-medium ms-1">
                Thích (<?= LikeService::countLikes($post_id) ?>)
              </span>
            </div>
          </a>
        <?php else: ?>
          <a href="/posts/<?= $post_id ?>/like" class="btn-like text-decoration-none py-1 px-3 rounded">
            <div class="text-dark">
              <i class="fa-regular fa-thumbs-up"></i>
              <span class="fw-medium ms-1">
                Thích (<?= LikeService::countLikes($post_id) ?>)
              </span>
            </div>
          </a>
        <?php endif ?>
        <div href="#" class="text-decoration-none text-dark py-1 px-3">
          <i class="fa-regular fa-comments"></i>
          <span class="fw-medium">Bình luận (<span id="qty-comments-<?= $post_id ?>"><?= count($comments); ?></span>)</span>
        </div>
      </div>
    </div>
    <div class="card-footer bg-white p-0">
      <div id="comments-<?= $post_id ?>" class="px-3" style="max-height: 300px; overflow-y: auto;">
        <?php foreach ($comments as $comment): ?>
          <?php $comment_user = $comment['user'] ?>
          <div class="d-flex my-3">
            <img src="<?= is_null_or_white_space($comment_user['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$comment_user['id']}/{$comment_user['profile_picture']}" ?>"
              alt="<?= $comment_user['username'] ?>"
              class="rounded-circle me-3"
              style="width: 40px; height: 40px; object-fit: cover;">
            <div>
              <h6 class="mb-0">
                <a class="link-dark link-underline-opacity-0 link-underline-opacity-75-hover" href="/users/<?= $comment_user['username'] ?>">
                  <?= $comment_user['full_name'] ?>
                </a>
              </h6>
              <small class="text-muted">
                <?= date_format(date_create($comment['created_at']), "d-m-Y H:i") ?>
              </small>
              <p class="mb-0"><?= htmlspecialchars($comment['content']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="d-flex px-3 py-2 border-top">
        <img src="<?= is_null_or_white_space($userLoggedIn['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$userLoggedIn['id']}/{$userLoggedIn['profile_picture']}" ?>"
          alt="<?= $userLoggedIn['username'] ?>"
          class="rounded-circle me-3"
          style="width: 40px; height: 40px; object-fit: cover;">
        <form action="/posts/<?= $post_id ?>/comments/create" method="post" class="form-comment d-flex flex-grow-1">
          <input type="hidden" name="user_id" value="<?= $userLoggedIn['id'] ?>">
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
) {
  $is_following = FollowService::isFollowing($followed_id);
?>
  <div class="d-flex align-items-center mb-4">
    <img src="/assets/images/no-avatar.png"
      class="rounded-circle me-3"
      alt="User"
      style="width: 40px; height: 40px; object-fit: cover;" />
    <div class="flex-grow-1">
      <h6 class="mb-0">
        <a href="/users/<?= htmlspecialchars($username) ?>" class="link-dark link-underline-opacity-0 link-underline-opacity-75-hover">
          <?= htmlspecialchars($username) ?>
        </a>
      </h6>
      <small class="text-muted"><?= htmlspecialchars($full_name) ?></small>
      <span class="fw-bolder">&#183;</span>
      <small class="text-muted"><?= $followers ?> Người theo dõi</small>
    </div>
    <?php if ($is_following): ?>
      <a href="/users/<?= $followed_id ?>/follow"
        class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">
        <i class="fa-solid fa-user-check"></i>
        <span>Đã theo dõi</span>
      </a>
    <?php else: ?>
      <a href="/users/<?= $followed_id ?>/follow"
        class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">
        <i class="fa-solid fa-user-plus"></i>
        <span>Theo dõi</span>
      </a>
    <?php endif; ?>
  </div>
<?php } ?>
