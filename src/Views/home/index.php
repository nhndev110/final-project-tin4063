<?php ob_start() ?>
<div class="row">
  <div class="col-8">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
          <div>
            <h6 class="mb-0">Jonathan Burke Jr.</h6>
            <small class="text-muted">Shared publicly - 7:30 PM today</small>
          </div>
        </div>
        <p class="card-text">
          Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hate as they create awesome tools to help create filler text for everyone from bacon lovers to Charlie Sheen fans.
        </p>
        <div class="swiper-container overflow-hidden mb-3">
          <div class="swiper-wrapper">
            <div class="user-select-none swiper-slide">
              <img src="https://via.placeholder.com/150" alt="Image 1" class="rounded" />
            </div>
            <div class="user-select-none swiper-slide">
              <img src="https://via.placeholder.com/150" alt="Image 2" class="rounded" />
            </div>
            <div class="user-select-none swiper-slide">
              <img src="https://via.placeholder.com/150" alt="Image 3" class="rounded" />
            </div>
            <div class="user-select-none swiper-slide">
              <img src="https://via.placeholder.com/150" alt="Image 3" class="rounded" />
            </div>
            <div class="user-select-none swiper-slide">
              <img src="https://via.placeholder.com/150" alt="Image 3" class="rounded" />
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <a href="#" class="text-decoration-none text-primary">
            <i class="fa-solid fa-thumbs-up"></i>
            <span>Like (10)</span>
          </a>
          <a href="#" class="text-decoration-none text-dark">
            <i class="fa-regular fa-comments"></i>
            <span>Bình luận (5)</span>
          </a>
        </div>
      </div>
    </div>
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
            <div>
              <h6 class="mb-0">Jonathan Burke Jr.</h6>
              <small class="text-muted">Shared publicly - 7:30 PM today</small>
            </div>
          </div>
          <p class="card-text">
            Lorem ipsum represents a long-held tradition for designers, typographers and the like. Some people hate it and argue for its demise, but others ignore the hate as they create awesome tools to help create filler text for everyone from bacon lovers to Charlie Sheen fans.
          </p>
          <div class="d-flex justify-content-between align-items-center">
            <a href="#" class="text-decoration-none text-dark">
              <i class="fa-regular fa-thumbs-up"></i>
              <span>Like</span>
            </a>
            <a href="#" class="text-decoration-none text-dark">
              <i class="fa-regular fa-comments"></i>
              <span>Bình luận (5)</span>
            </a>
          </div>
        </div>
      </div>
    <?php endfor ?>
  </div>
  <div class="col-4" style="height: 100%;">
    <div class="container mb-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Gợi ý theo dõi</h6>
        <a href="#" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">Xem tất cả</a>
      </div>
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <div class="d-flex align-items-center mb-3">
          <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
          <div class="flex-grow-1">
            <h6 class="mb-0">nqhuy03</h6>
            <small class="text-muted">Nguyễn Quốc Huy</small>
          </div>
          <a href="#" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">Theo dõi</a>
        </div>
      <?php endfor ?>
    </div>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>
