<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('config.php') ?>
 <?php require_once('inc/header.php') ?>
<body class="hold-transition lockscreen">
  <script>
    start_loader()
  </script>
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?php echo base_url ?>"><strong><?php echo $_settings->info('name') ?></strong></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo $_settings->info('logo') ?>" alt="System Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" id="e-login">
      <div class="input-group">
        <input type="password" class="form-control" name="code" placeholder="Establishement Code">

        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div id="msg"></div>
  <div class="help-block text-center">
    Enter Establishement Code <br>
      <a href="<?php echo base_url ?>admin/">Go to Admin Panel</a>

  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/script.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>