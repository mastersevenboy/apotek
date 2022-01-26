-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2021 at 02:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotek`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`) VALUES
(1, 'Arif Junaedi Purnomo', 'admin', '$2y$10$9702eQ5HAGt2R9iCOH0pOOU08rcR.91w2Qjaalqj87kEjbkWFxHl6'),
(3, 'Saras', 'admin1', '$2y$10$W4o.vPeCXnEZjlpImhHP2uQbtiwuzHTZICppydtWEBoyS4fxH68aa');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_detail` int(11) NOT NULL,
  `nama_obat` varchar(200) NOT NULL,
  `jumlah` double NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `produsen` varchar(50) NOT NULL,
  `harga_beli` double NOT NULL,
  `id_pem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_detail`, `nama_obat`, `jumlah`, `id_supplier`, `produsen`, `harga_beli`, `id_pem`) VALUES
(2, 'Siladex', 50, 1, 'PT Ultra Oskadon', 1000, 2),
(3, 'Paracitamol', 20, 1, 'PT Ultra Oskadon', 4500, 3),
(4, 'Antangin', 40, 4, 'Sidomuncul', 1500, 4),
(5, 'Procol', 40, 4, 'PT Ultra Sakti', 4000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_dtl` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `kode_obat` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_dtl`, `transaksi_id`, `kode_obat`, `jumlah`) VALUES
(26, 23, 'SLDX', 1),
(27, 24, 'INST', 1),
(29, 26, 'SLDX', 1),
(30, 26, 'BTDN', 1),
(32, 28, 'ENTR01', 1),
(33, 29, 'SLDX', 1),
(34, 29, 'INST', 1),
(37, 32, 'ENTR01', 1),
(38, 33, 'ENTR01', 1),
(39, 34, 'ENTR01', 1),
(40, 35, 'PRCL', 1);

--
-- Triggers `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `kurangi_stok_obat` BEFORE INSERT ON `detail_transaksi` FOR EACH ROW BEGIN
	DECLARE stok_sisa INT;
    SELECT stok INTO stok_sisa FROM obat WHERE kode = NEW.kode_obat;
    IF stok_sisa < NEW.jumlah THEN
    	SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Stok tidak mencukupi';
    END IF;
	UPDATE obat SET stok = stok - NEW.jumlah WHERE kode = NEW.kode_obat;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `kode` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `nama_obat` varchar(255) NOT NULL,
  `produsen` varchar(100) NOT NULL,
  `stok` int(11) UNSIGNED NOT NULL,
  `foto` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`kode`, `supplier_id`, `nama_obat`, `produsen`, `stok`, `foto`, `harga`, `keterangan`) VALUES
('BTDN', 1, 'Bethadine', 'Ovo', 8, '2019-07-04-11-23-20_5d1e27f85dc0b.jpg', 10000, 'Obat luka\r\ncocok untuk luka terkena pisau, jatuh, tabrakan \r\npemakain secukupnya'),
('ENTR01', 1, 'Entro Stop', 'Elevina', 6, '2019-07-04-11-22-33_5d1e27c92eb50.jpg', 5000, 'Obat Mencret\r\ncocok untuk orang yang sedang sakit perut atau diare\r\npemakaian 3 kali sehari\r\nuntuk anak dosis 1/2, dewasa 1'),
('INST', 1, 'Insto', 'Limo', 2, '2019-07-04-11-27-04_5d1e28d83a4df.jpg', 15000, 'Obat tetes mata baik untuk mata iritasi, beleken\r\npemakain 2 kali sehari, pagi dan malam hari'),
('PRCL', 4, 'Procol', 'PT Ultra Sakti', 39, '2021-02-25-08-15-49_6037a305983f7.jpg', 4000, 'Untuk dewasa\r\nbaik untuk penderita  batuk, panas, pilek\r\nbentuk obat tablet\r\ndimakan 3 x 1 hari'),
('SLDX', 1, 'Siladex', 'Limo', 9, '2019-07-04-11-26-06_5d1e289e36909.jpg', 15000, 'Obat Batuk\r\ncocok untuk yang mengalami batuk berdahak, batuk kering dan batuk biasa\r\npemakain 3 kali sehari sendok makan');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `admin_id` int(11) NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tgl`, `admin_id`, `total`) VALUES
(2, '2021-02-23', 1, 50000),
(3, '2021-02-25', 1, 90000),
(4, '2021-02-25', 1, 60000),
(5, '2021-02-25', 1, 160000);

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `id_profil` int(15) NOT NULL,
  `nama_tk` varchar(100) NOT NULL,
  `alamat_tk` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`id_profil`, `nama_tk`, `alamat_tk`, `logo`, `no_hp`) VALUES
(1, 'APOTEK NAN FARMA', 'Dusun 2 Cipaku, Kec. Mrebet, Kab. Purbalingga, Jawa Tengah', '20210302_224206.png', '028119992');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_sp` int(11) NOT NULL,
  `nama_sp` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(100) NOT NULL,
  `telp` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_sp`, `nama_sp`, `alamat`, `kota`, `telp`) VALUES
(1, 'Froksas', 'Padang Bulan', 'Medan', '021-6553888'),
(4, 'Biotakara herbal', 'jl.sleman no.40', 'yogyakarta', '0281-9874421'),
(5, 'Biotekes Jakarta', 'Jakarta Barat, Jl. Soedirman No.20', 'Jakarta', '085781800211');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `tgl` datetime NOT NULL,
  `nama_pembeli` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `transaksi_total` double NOT NULL,
  `jumlah_uang` double NOT NULL,
  `transaksi_kembalian` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `tgl`, `nama_pembeli`, `admin_id`, `transaksi_total`, `jumlah_uang`, `transaksi_kembalian`) VALUES
(23, '2020-12-02 07:39:37', 'supri', 1, 15000, 15000, 0),
(24, '2020-12-04 08:25:21', 'Zam Zami', 1, 15000, 20000, 5000),
(26, '2021-02-07 06:27:15', 'Sindi', 1, 25000, 50000, 25000),
(28, '2021-02-07 06:45:54', 'Mega', 1, 5000, 10000, 5000),
(29, '2021-02-07 09:17:55', 'Trajudin', 1, 30000, 50000, 20000),
(32, '2021-02-07 09:30:47', 'Rustam', 1, 5000, 10000, 5000),
(33, '2021-02-07 09:35:23', 'Rustam', 1, 5000, 20000, 15000),
(34, '2021-02-07 09:54:41', 'Warsinah', 1, 5000, 50000, 45000),
(35, '2021-03-02 07:14:24', 'Saras', 1, 4000, 50000, 46000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_supplier` (`id_supplier`),
  ADD KEY `id_pem` (`id_pem`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_dtl`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `kode_obat` (`kode_obat`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `obat_ibfk_1` (`supplier_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`id_profil`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_sp`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_dtl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `id_profil` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`id_supplier`) REFERENCES `supplier` (`id_sp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pembelian_ibfk_3` FOREIGN KEY (`id_pem`) REFERENCES `pembelian` (`id_pembelian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`kode_obat`) REFERENCES `obat` (`kode`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_3` FOREIGN KEY (`kode_obat`) REFERENCES `obat` (`kode`) ON DELETE CASCADE;

--
-- Constraints for table `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_sp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id_admin`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
