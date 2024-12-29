<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng nhập - H.N.L</title>
  <meta name="description" content="Nơi Kết Nối Những Trái Tim Cô Đơn" />
  <meta name="keywords" content="mạng xã hội, hnl" />
  <meta name="author" content="H.N.L" />
  <link rel="icon" type="image/x-icon" href="/favicon.ico" />
  <link href="/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="/assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #fafafa;
    }

    .login-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
  </style>
</head>

<body>
  <div class="container login-container">
    <div class="row">
      <div class="col-6 d-none d-md-block">
        <img src="/assets/images/login.png" alt="login"
          class="img-fluid"
          style="height: 500px; width: 600px; object-fit: cover;" />
      </div>

      <div class="col-6 ms-auto">
        <div class="card p-4 shadow-sm" style="max-width: 350px;">
          <h1 class="text-center mb-3 fw-bold fs-2" style="font-family: cursive;">H.N.L</h1>
          <p class="text-center mb-3">Nơi Kết Nối Những Trái Tim Cô Đơn</p>
          <?php if (exists_error('message')) : ?>
            <div class="alert alert-danger py-2 px-3" role="alert">
              <span style="font-size: 0.925rem;"><?= error('message') ?></span>
            </div>
          <?php endif ?>
          <form action="/login" method="post">
            <div class="mb-3">
              <input type="text" name="email" class="form-control" placeholder="Email" value="<?= old("email") ?>" />
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" placeholder="Mật khẩu" />
            </div>
            <button type="submit" class="btn btn-primary fw-bold w-100">Đăng nhập</button>
          </form>
        </div>

        <div class="card mt-3 p-3 text-center shadow-sm" style="max-width: 350px;">
          <p class="m-0">
            Bạn chưa có tài khoản?
            <a href="/signup" class="text-decoration-none text-primary fw-bold">Đăng kí</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <script src="/assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>