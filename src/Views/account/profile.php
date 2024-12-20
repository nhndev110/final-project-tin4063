<?php ob_start() ?>
<div class="card">
  <div class="row g-0">
    <div class="col-md-4 d-flex align-items-center justify-content-center text-white">
      <div class="text-center">
        <img src="https://via.placeholder.com/200"
          alt="Profile Picture"
          class="rounded-circle border border-3 border-white mb-3"
          style="width: 200px; height: 200px;">
      </div>
    </div>

    <div class="col-md-8">
      <div class="card-body">
        <h4 class="mb-3">Nguyễn Hoàng Nhân</h4>
        <div class="d-flex justify-content-start mb-3">
          <div class="text-center me-4">
            <h5 class="mb-0">250</h5>
            <small class="text-muted">Bài viết</small>
          </div>
          <div class="text-center me-4">
            <h5 class="mb-0">1200</h5>
            <small class="text-muted">Người theo dõi</small>
          </div>
          <div class="text-center">
            <h5 class="mb-0">340</h5>
            <small class="text-muted">Đang theo dõi</small>
          </div>
        </div>
        <p>Tôi là Nhân</p>
        <div class="d-flex gap-2">
          <button class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-user-plus"></i>
            <span>Theo dõi</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-8">
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <div class="card shadow-sm mt-4">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
            <div>
              <h6 class="mb-0">Jonathan Burke Jr.</h6>
              <small class="text-muted">Shared publicly - 7:30 PM today</small>
            </div>
            <div class="dropdown ms-auto">
              <button class="btn btn-outline-secondary rounded-circle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Xoá bài viết</a></li>
              </ul>
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
        <div class="card-footer bg-light">
          <!-- Danh sách bình luận -->
          <div class="comments mb-3">
            <div class="d-flex mb-2">
              <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User" style="height: 40px; width: auto;">
              <div>
                <h6 class="mb-0">Jane Doe</h6>
                <small class="text-muted">7:45 PM today</small>
                <p class="mb-0">This is a sample comment. Great post!</p>
              </div>
            </div>
            <div class="d-flex mb-2">
              <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User" style="height: 40px; width: auto;">
              <div>
                <h6 class="mb-0">John Smith</h6>
                <small class="text-muted">7:50 PM today</small>
                <p class="mb-0">I totally agree with this post!</p>
              </div>
            </div>
          </div>
          <!-- Form thêm bình luận -->
          <div class="d-flex">
            <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
            <input type="text" class="form-control rounded-pill" placeholder="Viết bình luận...">
            <button class="btn btn-primary ms-2 rounded-circle">
              <i class="fa-regular fa-paper-plane"></i>
            </button>
          </div>
        </div>
      </div>
    <?php endfor ?>
  </div>
  <div class="col-4 mt-4" style="height: 100%;">
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
