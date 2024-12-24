<?php function Post()
{ ?>
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <div class="d-flex align-items-center mb-2">
        <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
        <div>
          <h6 class="mb-0">Jonathan Burke Jr.</h6>
          <small class="text-muted">
            <span>7:30 PM today</span>
            <span class="fw-bolder">&#183;</span>
            <i class="fa-solid fa-earth-americas"></i>
          </small>
        </div>
        <div class="dropdown ms-auto">
          <button class="btn btn-outline-light text-dark rounded-circle border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-ellipsis"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Chỉnh sửa</a></li>
            <li><a class="dropdown-item" href="#">Xoá bài viết</a></li>
          </ul>
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
          <span class="fw-medium ms-1">Thích (10)</span>
        </a>
        <a href="#" class="text-decoration-none text-dark">
          <i class="fa-regular fa-comments"></i>
          <span class="fw-medium">Bình luận (5)</span>
        </a>
      </div>
    </div>
    <div class="card-footer bg-white p-3">
      <div class="comments">
        <div class="d-flex mb-3">
          <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User" style="height: 40px; width: auto;">
          <div>
            <h6 class="mb-0">Jane Doe</h6>
            <small class="text-muted">7:45 PM today</small>
            <p class="mb-0">This is a sample comment. Great post!</p>
          </div>
        </div>
        <div class="d-flex mb-3">
          <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User" style="height: 40px; width: auto;">
          <div>
            <h6 class="mb-0">John Smith</h6>
            <small class="text-muted">7:50 PM today</small>
            <p class="mb-0">I totally agree with this post!</p>
          </div>
        </div>
      </div>
      <div class="d-flex">
        <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
        <form action="" class="d-flex flex-grow-1">
          <input type="text" class="form-control rounded-pill flex-grow-1 no-focus-ring" placeholder="Viết bình luận...">
          <button class="btn ms-1 rounded-circle">
            <i class="fa-solid fa-paper-plane text-primary"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<?php function FollowUserItem()
{ ?>
  <div class="d-flex align-items-center mb-3">
    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
    <div class="flex-grow-1">
      <h6 class="mb-0">nqhuy03</h6>
      <small class="text-muted">Nguyễn Quốc Huy</small>
    </div>
    <a href="#" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">Theo dõi</a>
  </div>
<?php } ?>

<?php function FollowUserItemWithFollowers()
{ ?>
  <div class="d-flex align-items-center mb-4">
    <img src="https://via.placeholder.com/40" class="rounded-circle me-3" alt="User">
    <div class="flex-grow-1">
      <h6 class="mb-0">nqhuy03</h6>
      <small class="text-muted">Nguyễn Quốc Huy</small>
      <span class="fw-bolder">&#183;</span>
      <small class="text-muted">1.063 Người theo dõi</small>
    </div>
    <a href="#" class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover fw-medium">Theo dõi</a>
  </div>
<?php } ?>

<?php function FollowSuggestions()
{ ?>
  <div class="container mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h6 class="mb-0">Gợi ý theo dõi</h6>
    </div>
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <?php FollowUserItem() ?>
    <?php endfor ?>
  </div>
<?php } ?>