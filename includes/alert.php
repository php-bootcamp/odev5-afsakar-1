<?php if (isset($_SESSION["alert"])): ?>
  <?php if ($_SESSION["alert"] == "success"): ?>
    <div class="alert alert-success">
      <?=$_SESSION["text"]?>
    </div>
  <?php elseif ($_SESSION["alert"] == "error"): ?>
    <div class="alert alert-danger">
      <?=$_SESSION["text"]?>
    </div>
  <?php endif; ?>
  <?php unset($_SESSION["alert"]); ?>
  <?php unset($_SESSION["text"]); ?>
<?php endif; ?>
