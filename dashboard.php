<?php $menu = "Index"; ?>
<?php include "header.php"; ?>
<!-- Content Wrapper. Contains page content -->
<style>
    .bg-admin {
      background-image: url('img/bg-admin1.PNG');
      background-size: 20%;
  } 
</style>
<div class="content-wrapper p-2 bg-admin">
    <div class="card">
        <div class="card-header">
            <div class="text-left col-md-6">
                <h5>Selamat Datang <?= $_SESSION['username']; ?></h5>
            </div>
        </div>
        <div class="card-body table-responsive">
            <a href="logout.php">Logout</a>    
        </div> 
    </div>
</div>
<!-- /.content-wrapper -->
<?php include "footer.php"; ?>