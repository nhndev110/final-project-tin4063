<?php ob_start() ?>
<div class="card border-0">
  <div class="row g-0">
    <div class="col-md-4 d-flex align-items-center justify-content-center text-white">
      <div class="text-center">
        <img src="https://via.placeholder.com/200"
          alt="Profile Picture"
          class="rounded-circle"
          style="width: 200px; height: 200px;">
      </div>
    </div>

    <div class="col-md-8">
      <div class="card-body p-0">
        <h4 class="mb-3">Nguyễn Hoàng Nhân</h4>
        <div class="d-flex justify-content-start mb-3">
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
        <div class="d-flex">
          <button class="btn btn-primary rounded-pill">
            <i class="fa-solid fa-user-plus"></i>
            <span>Theo dõi</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<hr class="my-4">

<div class="row">
  <div class="col-8">
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <?php Post() ?>
    <?php endfor ?>
  </div>
  <div class="col-4">
    <?php FollowSuggestions() ?>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>