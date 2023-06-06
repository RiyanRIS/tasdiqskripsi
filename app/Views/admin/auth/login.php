<?php
$cfg = new \SConfig();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Page | <?= (@$cfg->_namaApp ?? "") ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=site_url('assets/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=site_url('assets/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Notifications css -->
  <link href="<?=site_url('assets/')?>plugins/toastr/toastr.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=site_url('assets/')?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b>Form</b>Login</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="text-center">
        <img class="login-box-msg text-center" src="<?= (@$cfg->_logoSekolah ?? "") ?>" alt="" width="132px">
      </div>
      <p class="h4 login-box-msg"><?= (@$cfg->_namaSekolah ?? "") ?></p>
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->

      <form action="" method="post">
        <?php
          $is_inv_username = (@$err['username'] ? 'is-invalid' : '');
          $is_inv_password = (@$err['password'] ? 'is-invalid' : '');
        ?>
        <div class="input-group mb-3">
          <input type="text" value="<?=@$username?>" autofocus="true" required="true" name="username" class="form-control <?= $is_inv_username ?>" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            Username masih kosong
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" required="true" name="password" class="form-control <?= $is_inv_password ?>" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <div class="invalid-feedback">
            Password masih kosong
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div> -->

        <div class="social-auth-links text-center mb-3">
          <!-- <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a> -->
          <button type="submit" class="btn btn-success">LOGIN</button>
        </div>
      </form>


      <p class="mb-0">
        Belum punya akun? <a href="#" class="text-center">Daftar Sekarang</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?=site_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=site_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Notifications Plugin -->
<script src="<?= site_url('assets/') ?>plugins/toastr/toastr.min.js"></script>

<script>
<?php if(session()->has('msg')){
if(session()->get('msg')[0] == 1){ ?>
    toastr.success("<?= session()->get('msg')[1] ?>", 'Berhasil');
<?php }elseif(session()->get('msg')[0] == 0){ ?>
    toastr.error("<?= session()->get('msg')[1] ?>", 'Gagal');
<?php }
} ?>
</script>

<!-- AdminLTE App -->
<script src="<?=site_url('assets/')?>dist/js/adminlte.min.js"></script>
</body>
</html>
