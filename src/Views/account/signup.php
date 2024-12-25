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

        <form method="post" action="/signup">
          <div class="mb-3">
            <input type="text"
              name="full_name"
              class="form-control"
              placeholder="Họ và tên của bạn"
              required />
          </div>
          <div class="mb-3">
            <input type="text"
              name="username"
              class="form-control"
              placeholder="Tên người dùng"
              required />
          </div>
          <div class="mb-3">
            <input type="password"
              name="password"
              class="form-control"
              placeholder="Mật khẩu"
              required />
          </div>
          <div class="mb-3">
            <input type="password"
              name="confirm_password"
              class="form-control"
              placeholder="Xác nhận mật khẩu"
              required />
          </div>
          <div class="mb-3">
            <input type="text"
              name="email"
              class="form-control"
              placeholder="Email của bạn"
              required />
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