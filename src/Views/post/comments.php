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
      <small class="text-muted"><?= date_format(date_create($comment['created_at']), "d-m-Y H:i") ?></small>
      <p class="mb-0"><?= htmlspecialchars($comment['content']) ?></p>
    </div>
  </div>
<?php endforeach; ?>