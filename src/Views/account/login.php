<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Đăng nhập - H.N.L</title>
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
      <div class="col-md-6 d-none d-md-block">
        <img src="https://via.placeholder.com/400x600" alt="" class="img-fluid" />
      </div>

      <div class="col-md-6">
        <div class="card p-4 shadow-sm">
          <h1 class="text-center mb-3 fw-bold fs-2" style="font-family: cursive;">H.N.L</h1>
          <form action="" method="post">
            <div class="mb-3">
              <input type="text" name="email" class="form-control" placeholder="Email" />
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" placeholder="Mật khẩu" />
            </div>
            <button type="submit" class="btn btn-primary fw-bold w-100">Đăng nhập</button>
          </form>
        </div>

        <div class="card mt-3 p-3 text-center shadow-sm">
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