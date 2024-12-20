<?php ob_start() ?>
<div class="row">
  <div class="col-8">
    <form action="" method="get" class="w-100">
      <div class="input-group">
        <button class="btn border border-end-0 rounded-start-pill" type="submit">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
        <input type="text"
          class="form-control shadow-none border border-start-0 rounded-end-pill px-0"
          style="font-size: 0.875rem;"
          placeholder="Tìm kiếm"
          name="search" />
      </div>
    </form>
    <ul class="nav nav-tabs my-3" id="pills-tab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active"
          id="pills-user-tab"
          data-bs-toggle="pill"
          data-bs-target="#pills-user"
          type="button"
          role="tab"
          aria-controls="pills-user"
          aria-selected="true">Người dùng</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link"
          id="pills-post-tab"
          data-bs-toggle="pill"
          data-bs-target="#pills-post"
          type="button"
          role="tab"
          aria-controls="pills-post"
          aria-selected="false">Bài viết</button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active"
        id="pills-user"
        role="tabpanel"
        aria-labelledby="pills-user-tab"
        tabindex="0">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <div class="d-flex align-items-center mb-4">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
            <div class="flex-grow-1">
              <h6 class="mb-0">nqhuy03</h6>
              <small class="text-muted">Nguyễn Quốc Huy</small>
              <span>|</span>
              <small class="text-muted">1.063 Người theo dõi</small>
            </div>
            <a href="#" class="btn btn-link text-primary text-decoration-none fw-medium">Theo dõi</a>
          </div>
        <?php endfor ?>
      </div>
      <div class="tab-pane fade"
        id="pills-post"
        role="tabpanel"
        aria-labelledby="pills-post-tab"
        tabindex="0">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <div class="card shadow-sm mt-4">
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
    </div>
  </div>
  <div class="col-4" style="height: 100%;">
    <div class="container mb-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="mb-0">Gợi ý theo dõi</h6>
        <a href="#" class="text-primary text-decoration-none fw-medium">Xem tất cả</a>
      </div>
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <div class="d-flex align-items-center mb-3">
          <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
          <div class="flex-grow-1">
            <h6 class="mb-0">nqhuy03</h6>
            <small class="text-muted">Nguyễn Quốc Huy</small>
          </div>
          <a href="#" class="btn btn-link fw-medium text-primary text-decoration-none">Theo dõi</a>
        </div>
      <?php endfor ?>
    </div>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>