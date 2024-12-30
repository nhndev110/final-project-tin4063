<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Đăng kí - H.N.L</title>
  <link href="/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="/assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light text-dark">
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="border rounded p-4 bg-white shadow-sm">
        <h1 class="text-center fw-bold mb-3 fs-2" style="font-family: cursive;">H.N.L</h1>
        <p class="text-center">Đăng ký để xem ảnh và video từ bạn bè của bạn.</p>
        <?php if (exists_error('message')) : ?>
          <div class="alert alert-danger py-2 px-3" role="alert">
            <span style="font-size: 0.925rem;"><?= error('message') ?></span>
          </div>
        <?php endif ?>
        <form method="post" action="/signup">
          <div class="mb-3">
            <input type="text"
              name="full_name"
              class="form-control"
              value="<?= old("full_name") ?>"
              placeholder="Họ và tên của bạn" />
            <div class="text-danger mt-2"><?= error("full_name") ?></div>
          </div>
          <div class="mb-3">
            <input type="text"
              name="username"
              class="form-control"
              value="<?= old("username") ?>"
              placeholder="Tên người dùng" />
            <div class="text-danger mt-2"><?= error("username") ?></div>
          </div>
          <div class="mb-3">
            <input type="email"
              name="email"
              value="<?= old("email") ?>"
              class="form-control"
              placeholder="Email của bạn" />
            <div class="text-danger mt-2"><?= error("email") ?></div>
          </div>
          <div class="mb-3">
            <input type="password"
              name="password"
              class="form-control"
              value="<?= old("password") ?>"
              placeholder="Mật khẩu" />
            <div class="text-danger mt-2"><?= error("password") ?></div>
          </div>
          <div class="mb-3">
            <input type="password"
              name="confirm_password"
              value="<?= old("confirm_password") ?>"
              class="form-control"
              placeholder="Xác nhận mật khẩu" />
            <div class="text-danger mt-2"><?= error("confirm_password") ?></div>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary fw-bold">Đăng kí</button>
          </div>
        </form>
      </div>

      <div class="text-center mt-3 border rounded p-3 bg-white shadow-sm">
        <p class="mb-0">
          Bạn đã có tài khoản chưa?
          <a href="/login" class="text-decoration-none text-primary fw-bold">Đăng nhập</a>
        </p>
      </div>
    </div>
  </div>

  <script src="/assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>