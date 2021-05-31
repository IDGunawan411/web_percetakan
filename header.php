<?php include "koneksi.php";
session_start();
// if($_SESSION['id_user'] == NULL || $_SESSION['id_customer'] == NULL){
//   header("location:../index.php?pesan=akses");
// }
date_default_timezone_set("Asia/Jakarta");
function tgl($tanggal)
{
    $bulan_arr    = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    // $hari_arr     = ['', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    $ex           = explode('-', $tanggal);
    $hari         = date('N', strtotime($tanggal));
    $tanggal_indo = $ex[2] . ' ' . $bulan_arr[(int)$ex[1]] . ' ' . $ex[0];

    return $tanggal_indo;
}
function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, '', '.');
    return $hasil_rupiah;
}

// Generate laporan perhari
// =====================================
  $date = date('Y-m-d');
  mysqli_query($koneksi,"DELETE FROM laporan_transaksi WHERE tanggal_transaksi = '$date'");
  mysqli_query($koneksi,"INSERT INTO laporan_transaksi 
  SELECT t.id_transaksi, t.id_customer, c.nama_customer, t.tanggal_transaksi, t.jumlah_transaksi, t.total_transaksi 
    FROM transaksi t INNER JOIN customer c on c.id_customer = t.id_customer WHERE tanggal_transaksi = '$date' AND t.ket_pembayaran = 'Lunas'");
  // =====================================
mysqli_query($koneksi,"DELETE FROM laporan_pengeluaran WHERE tanggal_transaksi = '$date'");
$qsum = mysqli_query($koneksi,"SELECT nama_transaksi, quantity,tanggal_transaksi
FROM `detail_transaksi` INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi
where jenis_bahan = '' AND tanggal_transaksi = '$date'");
while($dsum = mysqli_fetch_array($qsum)){
  $nama_produk = $dsum['nama_transaksi'];
  $qty         = $dsum['quantity'];
  $tanggal_transaksi = $dsum['tanggal_transaksi'];

  $qsum1 = mysqli_query($koneksi,"SELECT harga_supplier FROM jenis_produk WHERE nama_produk = '$nama_produk'");
  while($dsum1 = mysqli_fetch_array($qsum1)){
      $total_pengeluaran = (int)$dsum1['harga_supplier'] * (int)$qty;
      mysqli_query($koneksi,"INSERT INTO laporan_pengeluaran(nama_bahan,qty,tanggal_transaksi,total_pengeluaran) VALUES('$nama_produk','$qty','$tanggal_transaksi','$total_pengeluaran')");
  }
}

$qsum2 = mysqli_query($koneksi, "SELECT jenis_bahan as nama_bahan,SUM(quantity) as qty,tanggal_transaksi
FROM `detail_transaksi` INNER JOIN transaksi on transaksi.id_transaksi = detail_transaksi.id_transaksi 
where (tanggal_transaksi = '$date') AND ((jasa_design = 'Tidak' AND ket_pembayaran = 'Lunas') OR (ket_design = 'Selesai' AND ket_pembayaran = 'Lunas')) 
GROUP BY jenis_bahan");
while($dsum2 = mysqli_fetch_array($qsum2)){
  $nama_bahan   = $dsum2['nama_bahan'];
  $qty1          = $dsum2['qty'];
  $tanggal_transaksi1 = $dsum2['tanggal_transaksi'];

  $qsum3 = mysqli_query($koneksi,"SELECT harga_supplier,ket_bahan FROM jenis_bahan WHERE nama_bahan = '$nama_bahan'");
  while($dsum3 = mysqli_fetch_array($qsum3)){
      if($dsum3['ket_bahan'] == '2'){

        $qsum4 = mysqli_query($koneksi,"SELECT total_harga FROM detail_transaksi WHERE jenis_bahan = '$nama_bahan'");
        while($dsum4 = mysqli_fetch_array($qsum4)){
          $total_pengeluaran1 = (int)$dsum4['total_harga'] * (int)$qty1;
          // $total_pengeluaran1 = (int)$dsum3['harga_supplier'] * (int)$qty1;
        }

      }else{
        $total_pengeluaran1 = (int)$dsum3['harga_supplier'] * (int)$qty1;
      }
      mysqli_query($koneksi,"INSERT INTO laporan_pengeluaran(nama_bahan,qty,tanggal_transaksi,total_pengeluaran) VALUES('$nama_bahan','$qty1','$tanggal_transaksi1','$total_pengeluaran1')");
  }
}
// =====================================
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Percetakan</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <!-- ================================================ -->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="../plugins/jszip/jszip.min.js"></script>
  <script src="../plugins/pdfmake/pdfmake.min.js"></script>
  <script src="../plugins/pdfmake/vfs_fonts.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- SweetAlert2 -->
  <!-- <script src="asset/sweetalert2.js"></script> -->
  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script src="../plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <!-- Select2 -->
  <script src="../plugins/select2/js/select2.full.min.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

    });
  </script>
</head>
<style>
    .bg-admin {
      background-image: url('../img/bg-admin1.PNG');
      background-size: 20%;
    }
    body{ 
      font-family:Arial, Helvetica, sans-serif;
      /* font-family: sans-serif; */

    }

</style>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large "></i>
          <!-- <span class="badge badge-warning navbar-badge">15</span> -->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">Keluar Sekarang</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="btn-logout dropdown-item">
            <i class="fas fa-times mr-2"></i> Logout
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
        <script>
          $(document).ready(function() {
            $(".btn-logout").click( function(){
              Swal.fire({
                  title: 'Apaka yakin ingin logout?',
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonText: 'Kofirmasi',
                  cancelButtonText: 'Batal'
                }).then((result) => {
                  if (result.value) {
                    window.location.href='../logout.php'
                  } 
                })
            });
          });
          </script>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8"> -->
      <span class="brand-text font-weight-light">Administrator</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/linux1.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION['nama_lengkap']; ?></a>
        </div>
      </div>

      <?php if($_SESSION['level']=="CS") {?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-header"><?= $_SESSION['level'] == "CS" ? "Customer Service" : "Designer"; ?></li>
            <!-- Menu dashboard -->
            <li class="nav-item has-treeview <?= $menu == "CS_Index" ? 'menu-open' : '' ?>">
              <a href="../Data_Transaksi/dashboard.php" class="nav-link <?= $menu == "CS_Index" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard</p>
              </a>
            </li>
            <!-- Menu Transaksi -->
            <li class="nav-item has-treeview <?= $menu == "CS_Transaksi" ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == "CS_Transaksi" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-money-check"></i>
                <p>
                  Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Transaksi/v_transaksi.php" class="nav-link <?= $menu == "CS_Transaksi" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Transaksi</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Menu Produk -->
            <li class="nav-item has-treeview <?= $menu == "CS_Produk" || $menu == "CS_Bahan" ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == "CS_Produk" || $menu == "CS_Bahan" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-drafting-compass"></i>
                <p>
                  Produk
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Produk/v_produk.php" class="nav-link <?= $menu == "CS_Produk" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Produk</p>
                  </a>
                </li>
                <li class="nav-item mb-1">
                  <a href="../Data_Produk/v_bahan.php" class="nav-link <?= $menu == "CS_Bahan" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Bahan</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Menu Customer -->
            <li class="nav-item has-treeview <?= $menu == "CS_Customer" ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == "CS_Customer" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Customer
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Customer/v_customer.php" class="nav-link <?= $menu == "CS_Customer" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Customer</p>
                  </a>
                </li>
              </ul>
            </li>
            <!-- Menu Konfigurasi -->
            <li class="nav-item has-treeview <?= $menu == "CS_Konfigurasi" ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == "CS_Konfigurasi" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Konfigurasi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Konfigurasi/v_konfigurasi.php" class="nav-link <?= $menu == "CS_Konfigurasi" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Konfigurasi</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      <?php }elseif ($_SESSION['level'] == "Designer"){ ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-header"><?= $_SESSION['level'] == "CS" ? "Customer Service" : "Designer"; ?></li>
            <!-- Menu dashboard -->
            <li class="nav-item has-treeview <?= $menu == "DB_Design" ? 'menu-open' : '' ?>">
              <a href="../Data_Design/dashboard.php" class="nav-link <?= $menu == "DB_Design" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard</p>
              </a>
            </li>
            <!-- Menu Design -->
            <li class="nav-item has-treeview <?= $menu == "Design_Pengajuan" || $menu == "Design_Saya" ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == "Design_Pengajuan" || $menu == "Design_Saya" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-money-check"></i>
                <p>
                  List Design
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Design/v_design_pengajuan.php" class="nav-link <?= $menu == "Design_Pengajuan" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Pengajuan</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Design/v_design.php" class="nav-link <?= $menu == "Design_Saya" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Design</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      <?php }elseif ($_SESSION['level'] == "Pimpinan"){?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-header">Pimpinan Perusahaan</li>
            <!-- Menu dashboard -->
            <li class="nav-item has-treeview <?= $menu == "DB_Design" ? 'menu-open' : '' ?>">
              <a href="dashboard.php" class="nav-link <?= $menu == "DB_Design" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard</p>
              </a>
            </li>
            <!-- Menu Design -->
            <li class="nav-item has-treeview <?= $menu == "TR_Pimpinan" || $menu == "LP_Pimpinan"  ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == "TR_Pimpinan" || $menu == "LP_Pimpinan" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-money-check"></i>
                <p>
                  Laporan
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="v_laporan_transaksi.php" class="nav-link <?= $menu == "TR_Pimpinan" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Transaksi</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="v_laporan_pengeluaran.php" class="nav-link <?= $menu == "LP_Pimpinan" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Pengeluaran</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      <?php }else{ ?>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-legacy" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-header">Customer</li>
            <!-- Menu dashboard -->
            <li class="nav-item has-treeview <?= $menu == "ON_CS" ? 'menu-open' : '' ?>">
              <a href="dashboard_customer.php" class="nav-link <?= $menu == "ON_CS" ? 'active' : '' ?>">
                <i class="nav-icon fas fa-home"></i>
                <p> Dashboard</p>
              </a>
            </li>
            <!-- Menu Design -->
            <li class="nav-item has-treeview <?= $menu == "ON_TR" || $menu == "ON_DTR" || $menu == "CS_Transaksi" ?  'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= $menu == "ON_TR" || $menu == "ON_DTR" || $menu == "CS_Transaksi" ?  'active' : '' ?>">
                <i class="nav-icon fas fa-money-check"></i>
                <p>
                  Menu Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Online/v_transaksi_on.php" class="nav-link <?= $menu == "ON_TR"  || $menu == "CS_Transaksi" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data Transaksi</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview p-1">
                <li class="nav-item mb-1">
                  <a href="../Data_Online/v_laporan_pengeluaran.php" class="nav-link <?= $menu == "ON_DTR" ? 'bg-info rounded' : '' ?>">
                    <i class="fas fa-bars nav-icon"></i> 
                    <p>Data History</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      <?php } ?>

    </div>
    <!-- /.sidebar -->
  </aside>