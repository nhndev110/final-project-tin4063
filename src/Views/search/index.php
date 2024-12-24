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
          placeholder="Tìm kiếm người dùng ..."
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
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active"
        id="pills-user"
        role="tabpanel"
        aria-labelledby="pills-user-tab"
        tabindex="0">
        <?php for ($i = 1; $i <= 5; $i++): ?>
          <?php FollowUserItemWithFollowers(
            "Nguyễn Hoàng Nhân",
            "nguyenhoangnhan",
            340,
          ) ?>
        <?php endfor ?>
      </div>
    </div>
  </div>
  <div class="col-4" style="height: 100%;">
    <?php FollowSuggestions([
      ["username" => "nguyenvanan", "full_name" => "Nguyễn Văn An"],
      ["username" => "tranthibich", "full_name" => "Trần Thị Bích"],
      ["username" => "lehoangphong", "full_name" => "Lê Hoàng Phong"],
      ["username" => "phamthihong", "full_name" => "Phạm Thị Hồng"],
      ["username" => "hoangminhtuan", "full_name" => "Hoàng Minh Tuấn"]
    ]) ?>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>