<?php 
    include 'config/database.php';
    include 'layout/header.php';
    include 'config/functions.php';
    if(isset($_POST['submit'])){
        if(login($_POST,$conn) > 0){

        }
    }
    if($_SESSION['login'] == true){
      header("Location: " . $baseUrl.'dashboard');
      exit();
    }
?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Silahkan Login !!</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>
      <?php if(isset($_SESSION['message'])){ ?>
      <div class="alert alert-<?= $_SESSION['status'] ?>" role="alert">
        <center><?= $_SESSION['message'] ?></center>
      </div>
      <?php } ?>
      <?php 
        unset($_SESSION['message']);
        unset($_SESSION['status']);
      ?>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="id_number" class="form-control" placeholder="Number ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<?php 
    include 'config/footer.php';
?>
