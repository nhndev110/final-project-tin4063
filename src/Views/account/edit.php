<?php if (exists_error('message')) : ?>
  <div class="alert alert-danger py-2 px-3" role="alert">
    <span style="font-size: 0.925rem;"><?= error('message') ?></span>
  </div>
<?php endif ?>
<form action="/users/update" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="id" value="<?= $user['id'] ?>">
  <input type="hidden" name="old_profile_picture" value="<?= $user['profile_picture'] ?>">
  <div class="mb-3">
    <label for="fullName" class="form-label fw-medium">Họ và Tên</label>
    <input type="text"
      class="form-control"
      id="fullName"
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
      disabled
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