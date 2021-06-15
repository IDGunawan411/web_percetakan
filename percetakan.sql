-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2021 at 11:07 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `percetakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` varchar(100) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `no_telp`, `alamat`, `email`, `password`) VALUES
('CS0001', 'Gunawan Prasetyoz', '0822494951570', 'Jl. Al-Baliyah, Pabuaran RT05/RW012 , Cibinongz, Bogor, Jawa Barat', 'gunawanprasetyoz313@gmail.com', ''),
('CS0002', 'Chandra', '08222334', 'Depok, Jawa Barat', 'cs@gail.com', 'er'),
('CS0003', 'Data002', '082249495157', 'Depok, Jawa Tengah', 'gugunsyah61@yahoo.com', ''),
('CS0004', 'Data005', '082249495157', 'Jakarta Pusat', 'gugunsyah61@yahoo.com', ''),
('CS0005', 'Hendrik', '10239102', 'kajsjksajksasa', 'bjir@gmail.com', ''),
('CS0006', 'Contoh4', '02932390AS', 'as', 'asgdasd@gmail.com', ''),
('CS0007', 'Customerz', '082249495157', 'Jl. bogorz', 'gunawanprasetyo313@gmail.com', ''),
('CS0008', 'Gunawan', '082249495157', 'bogor', 'gunawanprasetyo313@gmail.com', ''),
('CS0009', 'Customersss', '09128', 'jlbogord', 'wok@gmail.com', 'er');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_dtransaksi` varchar(100) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nama_transaksi` varchar(100) NOT NULL,
  `ukuran_cetak` varchar(100) NOT NULL,
  `quantity` varchar(100) NOT NULL,
  `jenis_bahan` varchar(100) NOT NULL,
  `total_cetak` varchar(100) NOT NULL,
  `jasa_design` varchar(100) NOT NULL,
  `ket_design` varchar(100) NOT NULL,
  `total_design` varchar(100) NOT NULL,
  `total_harga` varchar(100) NOT NULL,
  `jenis_transaksi` varchar(100) NOT NULL,
  `ket_transaksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_dtransaksi`, `id_transaksi`, `nama_transaksi`, `ukuran_cetak`, `quantity`, `jenis_bahan`, `total_cetak`, `jasa_design`, `ket_design`, `total_design`, `total_harga`, `jenis_transaksi`, `ket_transaksi`) VALUES
('TI050521KAMJU', 'TR0001', 'Cetak Brosur', '', '10', 'Kertas A4', '10000', 'Tidak', '', '', '10000', 'Cetak', ''),
('TI050521MDVXW', 'TR0002', 'Cetak Undangan 500/pcs', '', '500', 'Kertas A4', '500000', 'Tidak', '', '', '500000', 'Cetak', ''),
('TI100521DZRLF', 'TR0005', 'Cetak ID Card', '', '15', 'Card 4R', '15000', 'Tidak', '', '', '15000', 'Cetak', ''),
('TI100521FSTZU', 'TR0006', 'Cetak Undangan 500/pcs', '', '500', 'Kertas A4', '500000', 'Tidak', '', '', '500000', 'Cetak', ''),
('TI100521UMAWV', 'TR0005', 'Cetak Foto 4R', '', '10', 'Card 4R', '10000', 'Tidak', '', '', '10000', 'Cetak', ''),
('TI100521WPBRN', 'TR0006', 'Buku TA', '', '110', 'Kertas HVS', '55000', 'Tidak', '', '', '55000', 'Cetak', ''),
('TI100521WUYIO', 'TR0006', 'Cetak Poster', '', '5', 'Kertas A3', '5000', 'Tidak', '', '', '5000', 'Cetak', ''),
('TO050521DTUGN', 'TR0001', 'Cetak Spanduk', '2m x 2m', '1', 'Bahan Spanduk', '40000', 'Tidak', '', '', '40000', 'Cetak', ''),
('TO050521FOZGE', 'TR0003', 'Cetak Poster', '3.5m x 2.5m', '2', 'Bahan Spanduk', '175000', 'Tidak', '', '', '175000', 'Cetak', ''),
('TO100521PJEDB', 'TR0005', 'Cetak Spanduk', '4m x 3m', '1', 'Bahan Spanduk', '120000', 'Tidak', '', '', '120000', 'Cetak', ''),
('TP050521NUCHI', 'TR0001', 'Laminating', '', '10', '', '', '', '', '', '15000', 'Produk', 'ddadadadasdadaasd'),
('TP100521WHJAO', 'TR0006', 'Jilid Buku', '', '1', '', '', '', '', '', '1000', 'Produk', 'Jilid Buku Ta');

-- --------------------------------------------------------

--
-- Table structure for table `file_design`
--

CREATE TABLE `file_design` (
  `id_file` varchar(100) NOT NULL,
  `id_dtransaksi` varchar(100) NOT NULL,
  `link_file` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file_design`
--

INSERT INTO `file_design` (`id_file`, `id_dtransaksi`, `link_file`, `keterangan`) VALUES
('FL050521BASUM', 'TO050521DTUGN', 'view-source:https://adminlte.io/themes/v3/pages/forms/advanced.html', 'Gmail adalah layanan surel milik Google. Pengguna dapat mengakses Gmail dalam bentuk surat web HTTPS, protokol POP3 atau IMAP4. Gmail diluncurkan dengan sistem undangan dalam bentuk Beta pada 1 April 2004 dan tersedia untuk publik pada 7 Februari 2007 meski masih menyandang status Beta'),
('FL050521CVIXM', 'TI050521MDVXW', 'https://adminlte.io/themes/v3/pages/UI/general.html', 'There is a problem that we need to fix. A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.'),
('FL050521ELRKH', 'TI050521KAMJU', 'https://www.petanikode.com/php-upload-file/', 'Gmail adalah layanan surel milik Google. Pengguna dapat mengakses Gmail dalam bentuk surat web HTTPS, protokol POP3 atau IMAP4.'),
('FL050521VEBCO', 'TO050521FOZGE', 'http://localhost:90/TA/Data_Dtransaksi/v_dtransaksi_add_outdoor.php?id=TR0003', 'Untuk mendaftar ke Gmail, buatlah Akun Google. Anda dapat menggunakan nama pengguna dan sandi untuk login ke Gmail dan produk Google lainnya seperti ');

-- --------------------------------------------------------

--
-- Table structure for table `jasa_design`
--

CREATE TABLE `jasa_design` (
  `id_design` varchar(100) NOT NULL,
  `id_dtransaksi` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `tanggal_cetak` varchar(100) NOT NULL,
  `waktu_mulai` varchar(100) NOT NULL,
  `waktu_selesai` varchar(100) NOT NULL,
  `waktu_total` varchar(100) NOT NULL,
  `status_cetak` varchar(100) NOT NULL,
  `total_design` varchar(100) NOT NULL,
  `nama_file` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bahan`
--

CREATE TABLE `jenis_bahan` (
  `id_bahan` varchar(100) NOT NULL,
  `nama_bahan` varchar(100) NOT NULL,
  `harga_bahan` varchar(100) NOT NULL,
  `status_bahan` varchar(100) NOT NULL,
  `ket_bahan` varchar(100) NOT NULL,
  `harga_supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_bahan`
--

INSERT INTO `jenis_bahan` (`id_bahan`, `nama_bahan`, `harga_bahan`, `status_bahan`, `ket_bahan`, `harga_supplier`) VALUES
('BN100521GFPWT', 'Kertas HVS', '500', 'Tersedia', '1', '200'),
('BN100521RDESG', 'Card 4R', '1000', 'Tersedia', '1', '700'),
('BN100521RXSNF', 'Kertas A3', '1000', 'Tersedia', '1', '500'),
('BN260421GQDXP', 'Kertas A4', '1000', 'Tersedia', '1', '500'),
('BN260421HJGYF', 'Bahan Spanduk', '10000', 'Tersedia', '2', '5000');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_produk`
--

CREATE TABLE `jenis_produk` (
  `id_produk` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `harga_produk` varchar(100) NOT NULL,
  `status_produk` varchar(100) NOT NULL,
  `ket_produk` varchar(100) NOT NULL,
  `harga_supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_produk`
--

INSERT INTO `jenis_produk` (`id_produk`, `nama_produk`, `harga_produk`, `status_produk`, `ket_produk`, `harga_supplier`) VALUES
('PR100521ROGQF', 'Jilid Buku', '1000', 'Tersedia', '', '500'),
('PR260421MKCRH', 'Laminating', '1500', 'Tersedia', '-', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id_konfigurasi` int(11) NOT NULL,
  `nama_konfigurasi` varchar(100) NOT NULL,
  `isi_konfigurasi` varchar(500) NOT NULL,
  `jenis_konfigurasi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id_konfigurasi`, `nama_konfigurasi`, `isi_konfigurasi`, `jenis_konfigurasi`) VALUES
(1, 'Nama Perusahaan', 'CV. HIKMAH GRAPHIA', '1'),
(2, 'Contact', '082249495157', '1'),
(3, 'Email', 'admin@gmail.com', '1'),
(4, 'Biling Design/m', '500', '2'),
(5, 'Alamat', 'Jl. Raya Jakarta - Bogor\r\nNo. 49, KM 40, Jawa Barat', '1');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pengeluaran`
--

CREATE TABLE `laporan_pengeluaran` (
  `nama_bahan` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL,
  `tanggal_transaksi` varchar(100) NOT NULL,
  `total_pengeluaran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_pengeluaran`
--

INSERT INTO `laporan_pengeluaran` (`nama_bahan`, `qty`, `tanggal_transaksi`, `total_pengeluaran`) VALUES
('Laminating', '10', '2021-05-10', '10000'),
('Jilid Buku', '1', '2021-05-10', '500'),
('Bahan Spanduk', '4', '2021-05-10', '480000'),
('Card 4R', '25', '2021-05-10', '17500'),
('Kertas A3', '5', '2021-05-10', '2500'),
('Kertas A4', '1010', '2021-05-10', '505000'),
('Kertas HVS', '110', '2021-05-10', '22000');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_transaksi`
--

CREATE TABLE `laporan_transaksi` (
  `id_transaksi` varchar(100) NOT NULL,
  `id_customer` varchar(100) NOT NULL,
  `nama_customer` varchar(100) NOT NULL,
  `tanggal_transaksi` varchar(100) NOT NULL,
  `jumlah_transaksi` varchar(100) NOT NULL,
  `total_transaksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_transaksi`
--

INSERT INTO `laporan_transaksi` (`id_transaksi`, `id_customer`, `nama_customer`, `tanggal_transaksi`, `jumlah_transaksi`, `total_transaksi`) VALUES
('TR0001', 'CS0009', 'Customersss', '2021-05-10', '3', '65000'),
('TR0002', 'CS0009', 'Customersss', '2021-05-10', '1', '500000'),
('TR0003', 'CS0009', 'Customersss', '2021-05-10', '1', '175000'),
('TR0005', 'CS0005', 'Hendrik', '2021-05-10', '3', '145000'),
('TR0006', 'CS0001', 'Gunawan Prasetyoz', '2021-05-10', '4', '561000');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` varchar(100) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `nama_gambar` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `waktu_upload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_transaksi`, `nama_gambar`, `keterangan`, `waktu_upload`) VALUES
('PM050521KRDUG', 'TR0003', 'TR0003-Customersss-2021-05-05.png', 'Save', '2021-05-05 11:43:30'),
('PM050521RDTCI', 'TR0002', 'TR0002-Customersss-2021-05-05.png', 'Pembayaran Gunawan ', '2021-05-05 11:31:33'),
('PM050521SYXZK', 'TR0001', 'TR0001-Customersss-2021-05-05.png', 'Pembayaran Gunawan Prasetyo', '2021-05-05 11:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(100) NOT NULL,
  `id_customer` varchar(100) NOT NULL,
  `tanggal_transaksi` varchar(100) NOT NULL,
  `jumlah_transaksi` varchar(100) NOT NULL,
  `total_transaksi` varchar(100) NOT NULL,
  `ket_pembayaran` varchar(100) NOT NULL,
  `status_transaksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_customer`, `tanggal_transaksi`, `jumlah_transaksi`, `total_transaksi`, `ket_pembayaran`, `status_transaksi`) VALUES
('TR0001', 'CS0009', '2021-05-10', '3', '65000', 'Lunas', '2'),
('TR0002', 'CS0009', '2021-05-10', '1', '500000', 'Lunas', '2'),
('TR0003', 'CS0009', '2021-05-10', '1', '175000', 'Lunas', '2'),
('TR0004', 'CS0001', '2021-05-06', '', '', '', '1'),
('TR0005', 'CS0005', '2021-05-10', '3', '145000', 'Lunas', '1'),
('TR0006', 'CS0001', '2021-05-10', '4', '561000', 'Lunas', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `level`) VALUES
('US0001', 'gun', 'er', 'Gunawan Prasetyo', 'gunawanprasetyo313@gmail.com', 'CS'),
('US0002', 'Admin', 'er', 'Designer Pro', 'gunawanprasetyo313@gmail.com', 'Designer'),
('US0003', 'Nub', 'er', 'Designer Nub', 'nub@gmail.com', 'Designer'),
('US0004', 'pimpinan', 'er', 'Pimpinan Perusahaan', 'pimpinan@mail.com', 'Pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_dtransaksi`);

--
-- Indexes for table `file_design`
--
ALTER TABLE `file_design`
  ADD PRIMARY KEY (`id_file`);

--
-- Indexes for table `jasa_design`
--
ALTER TABLE `jasa_design`
  ADD PRIMARY KEY (`id_design`);

--
-- Indexes for table `jenis_bahan`
--
ALTER TABLE `jenis_bahan`
  ADD PRIMARY KEY (`id_bahan`);

--
-- Indexes for table `jenis_produk`
--
ALTER TABLE `jenis_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id_konfigurasi`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id_konfigurasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
