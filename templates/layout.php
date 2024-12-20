<!-- /templates/layout.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <title>H.N.L - Mạng Xã Hội Dành Cho Người Việt</title>
  <meta charset="UTF-8" />
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
  </style>
  <?= $styles ?? "" ?>
</head>

<body>
  <div id="wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-3 position-fixed start-0 border-end" style="height: 100%;">
          <div id="sidebar" class="py-4">
            <a class="navbar-brand" href="#">
              <h2 class="text-center fw-bold fs-2 m-0" style="font-family: cursive;">H.N.L</h2>
            </a>
            <p class="text-center">Mạng Xã Hội Dành Cho Người Việt</p>
            <div class="list-group mt-4">
              <?php $uri = $_SERVER['REQUEST_URI'] ?>
              <a href="/home" class="list-group-item list-group-item-action <?= str_starts_with($uri, '/home') ? 'active' : '' ?> rounded-pill border">
                <i class="fa-solid fa-house"></i>
                <span class="ms-1">Trang chủ</span>
              </a>
              <a href="/search" class="list-group-item list-group-item-action <?= str_starts_with($uri, '/search') ? 'active' : '' ?> rounded-pill mt-2 border">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="ms-1">Tìm kiếm</span>
              </a>
              <a href="/post/create" class="list-group-item list-group-item-action <?= str_starts_with($uri, '/post/create') ? 'active' : '' ?> rounded-pill mt-2 border">
                <i class="fa-regular fa-square-plus"></i>
                <span class="ms-1">Tạo mới</span>
              </a>
              <a href="/profile" class="list-group-item list-group-item-action rounded-pill <?= str_starts_with($uri, '/profile') ? 'active' : '' ?> mt-2 border">
                <i class="fa-regular fa-user"></i>
                <span class="ms-1">Hồ sơ</span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-9 py-4" style="margin-left: 25%;">
          <?= $content ?? "" ?>
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
