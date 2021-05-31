<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Percetakan</title>
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="asset/sweetalert2.js"></script>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/select2/js/select2.full.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>

<body class="hold-transition login-page bg-admin">
<style>
    .bg-admin{
        background: url('img/BG-LOGIN2.PNG');
        height: 100vh;
        background-size: cover;
        background-position: center;
    }
    .rounded{
        border-radius: 100px !important;
    }
</style>

<?php 
if(isset($_GET['pesan'])){
    $arr_pesan  = array("eror","akses","register_gagal","register_sukses","register_usernm","register_kurang");
    $arr_icon   = array("error","warning","error","success","info","warning");
    $arr_tittle = array("Username atau password salah !","Anda tidak memiliki akses !","Password tidak sesuai !","Register berhasil !","Username sudah digunakan !","Data belum lengkap !"); 

    for($i = 0;$i < 6;$i++){
        if($_GET['pesan']=="$arr_pesan[$i]"){ ?>
            <script type='text/javascript'>
                $(document).ready( function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    Toast.fire({
                        icon: "<?= $arr_icon[$i]; ?>",
                        title: '&nbsp;&nbsp; <?= $arr_tittle[$i]; ?>',
                    })
                });
            </script> 
            <?php
        } 
    }
}
?>
<script>
    $(document).ready(function() {
        $(".show-pass").hide();
        $(".hide-pass").click( function() {
            $(".input-pass").attr("type", "text");
            $(".show-pass").show();
            $(".hide-pass").hide();
        });
        $(".show-pass").click( function() {
            $(".input-pass").attr("type", "password");
            $(".show-pass").hide();
            $(".hide-pass").show();
        });
    });
</script>
<div class="login-box">
    <div class="card card-outline card-dark shadow-lg bg-white p-2">
        <div class="card-header text-center bgcard">
            <h3 class="text-center">#<a class="text-info">Selamat</a> Datang</h3>
        </div>
        <div class="card-body">
            <p class="text-center mb-4">Sign in to start your session</p>
            <form action="cek_login.php" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control border-right-0" placeholder="Masukan Username" name="username" id="username" value="<?php if(isset($_GET['us'])){echo $_GET['us'];}?>">
                    <div class="input-group-append">
                        <div class="input-group-text border-left-0 bg-white">
                            <span class="far fa-user-circle text-info"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="input-pass form-control border-right-0 <?php if(isset($_GET['pesan'])){ if($_GET['pesan']=='eror'){echo "is-invalid";}}?>" placeholder="Password" name="password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text border-left-0 bg-white">
                            <i class="ion ion-close text-danger hide-pass"></i>
                            <i class="fas fa-check text-success show-pass"></i>
                        </div>
                    </div>
                </div>
                <span class="text-danger" id="notif-pass"></span>
                <div class="row mb-3">
                    <div class="col-md-12"><a href="#" data-toggle="modal" class="" data-target="#LupaPassword">Lupa password ?</a></div>
                </div>
                <hr>
                <div class="row mb-2">
                    <div class="col-md-4 mb-2"></div>      
                    <div class="col-md-4 mb-2">
                        <a href="#" data-toggle="modal" class="btn btn-outline-danger btn-sm btn-block btn-flat" data-target="#exampleModal">Register</a>
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="submit" class="btn btn-outline-primary btn-sm btn-block btn-flat" value="Login">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Register-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Register Account 
            </div>
            <div class="modal-body login-card-body">
                <form action="register.php" method="post" class="row">
                    <div class="input-group mb-3">
                        <?php
                            include "koneksi.php";
                            $um = mysqli_query($koneksi, "SELECT MAX(substr(id_user,3,4)) as max_id FROM user");
                            $dm = mysqli_fetch_array($um);
                            $max_id  = $dm['max_id'] + 1; 
                            $id_user = "US".Sprintf('%04s',$max_id)
                        ?>
                        <input type="text" class="form-control" name="id_user" id="id_user" value="<?= $id_user; ?>" readonly>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fab fa-google"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="far fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Password" name="password" id="password">
                        <input type="text" class="form-control" placeholder="Retype Password" name="password2" id="password2">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="far fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="far fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="far fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="level" id="level" class="form-control select2">
                            <option class="form-control" value="0">- Pilih Level -</option>
                            <option class="form-control" value="Admin CS">Admin CS</option>
                            <option class="form-control" value="Designer">Designer</option>
                            <option class="form-control" value="Pimpinan">Pimpinan</option>
                        </select>
                    </div>
                    
                    <input type="submit" class="btn btn-info btn-sm" value=" Simpan ">
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Register-->
<div class="modal fade" id="LupaPassword" tabindex="-1" role="dialog" aria-labelledby="LupaPasswordLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                Lupa Password 
            </div>
            <div class="modal-body login-card-body">
                <form action="#" method="post" class="row">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Masukan e-mail.." name="lupa-pass" id="lupa-pass">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <span>Password akan dikirim melalui gmail ...</span>
                    </div>
                    <input type="submit" class="btn btn-dark btn-sm" value=" Simpan ">
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
