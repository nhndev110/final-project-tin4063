<?php ob_start() ?>
<div class="row">
  <div class="col-8">
    <?php for ($i = 1; $i <= 5; $i++): ?>
      <?php Post() ?>
    <?php endfor ?>
  </div>
  <div class="col-4" style="height: 100%;">
    <?php FollowSuggestions() ?>
  </div>
</div>
<?php $content = ob_get_clean() ?>
<?php include(APP_ROOT . '/templates/layout.php') ?>