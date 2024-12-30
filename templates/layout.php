<?php

use App\Services\AuthService;

$userLoggedIn = AuthService::user();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>H.N.L - Nơi Kết Nối Những Trái Tim Cô Đơn</title>
  <meta charset="UTF-8" />
  <meta name="description" content="Nơi Kết Nối Những Trái Tim Cô Đơn" />
  <meta name="keywords" content="mạng xã hội, hnl" />
  <meta name="author" content="H.N.L" />
  <link rel="icon" type="image/x-icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="/assets/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <link href="/assets/plugins/bootstrap/bootstrap.min.css" rel="stylesheet" />
  <link href="/assets/plugins/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <style>
    #sidebar .active {
      font-weight: 500;
      border: none !important;
    }

    .swiper-wrapper {
      display: flex;
    }

    .swiper-slide {
      flex-shrink: 0;
      width: auto;
    }

    .no-focus-ring:focus {
      outline: none;
      box-shadow: none;
    }

    .btn-like,
    .btn-comment {
      transition: .3s;
    }

    .btn-like:hover,
    .btn-comment:hover {
      background-color: rgba(0, 0, 0, 0.05);
    }

    .comments::-webkit-scrollbar {
      width: 6px;
    }

    .comments::-webkit-scrollbar-track {
      background-color: #f1f1f1;
      border-radius: 4px;
    }

    .comments::-webkit-scrollbar-thumb {
      background-color: #aaa;
      border-radius: 4px;
    }

    .comments::-webkit-scrollbar-thumb:hover {
      background-color: #999;
    }

    .user-card {
      transition: .3s;
    }

    .user-card:hover {
      background-color: rgba(0, 0, 0, 0.05) !important;
    }
  </style>
  <?= $styles ?? "" ?>
</head>

<body>
  <div id="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-3 position-fixed start-0 border-end" style="height: 100%;">
          <div id="sidebar" class="py-4 d-flex flex-column" style="height: 100%;">
            <a class="navbar-brand" href="/home">
              <h2 class="text-center fw-bold fs-2 m-0" style="font-family: cursive;">H.N.L</h2>
            </a>
            <p class="text-center">Nơi Kết Nối Những Trái Tim Cô Đơn</p>
            <div class="list-group mt-4">
              <?php $uri = $_SERVER['REQUEST_URI'] ?>
              <a href="/home" class="list-group-item list-group-item-action <?= str_starts_with($uri, '/home') ? 'active' : '' ?> rounded-pill border">
                <i class="fa-solid fa-house"></i>
                <span class="ms-1">Trang chủ</span>
              </a>
              <a href="/search"
                class="list-group-item list-group-item-action <?= str_starts_with($uri, '/search') ? 'active' : '' ?> rounded-pill mt-2 border">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="ms-1">Tìm kiếm</span>
              </a>
              <a href="/posts/create"
                class="list-group-item list-group-item-action <?= str_starts_with($uri, '/posts/create') ? 'active' : '' ?> rounded-pill mt-2 border">
                <i class="fa-regular fa-square-plus"></i>
                <span class="ms-1">Tạo mới</span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-6 py-4" style="margin-left: 25%;">
          <?= $content ?? "" ?>
        </div>

        <div class="col-3">
          <div class="user-card d-flex align-items-center justify-content-between mt-4 pe-3 bg-light rounded shadow-sm">
            <a href="/users/<?= $userLoggedIn['username'] ?>" class="d-flex py-3 ps-3 align-items-center text-decoration-none text-dark">
              <img src="<?= is_null_or_white_space($userLoggedIn['profile_picture']) ? "/assets/images/no-avatar.png" : "/assets/images/users/{$userLoggedIn['id']}/{$userLoggedIn['profile_picture']}" ?>"
                class="rounded-circle me-3"
                alt="User"
                style="width: 50px; height: 50px; object-fit: cover;" />
              <div class="flex-grow-1">
                <h6 class="mb-0 fw-medium">
                  <?= htmlspecialchars($userLoggedIn['username']) ?>
                </h6>
                <small class="text-muted">
                  <?= htmlspecialchars($userLoggedIn['full_name']); ?>
                </small>
              </div>
            </a>
            <a href="/logout" class="btn btn-danger btn-sm rounded-circle">
              <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="/assets/plugins/jquery/jquery.min.js"></script>
  <script src="/assets/plugins/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="/assets/plugins/swiper/swiper-bundle.min.js"></script>
  <script>
    new Swiper('.swiper-container', {
      slidesPerView: 'auto',
      spaceBetween: 10,
      freeMode: true
    });
  </script>
  <?= $scripts ?? "" ?>
</body>

</html>