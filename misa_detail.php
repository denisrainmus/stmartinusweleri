<?php 
include 'header.php'; 
include 'koneksi.php';

// Ambil ID dari GET dan decode
$id_misa = intval(base64_decode($_GET["id"]));

// Cek apakah ID valid
if ($id_misa <= 0) {
    die("<script>alert('ID tidak valid!'); window.location.href='misa.php';</script>");
}

// Ambil detail jadwal misa dari database
$sqlMisa = mysqli_query($konek, "SELECT * FROM jadwal_misa WHERE id_misa='$id_misa'");
$dataMisa = mysqli_fetch_array($sqlMisa);

// Jika data tidak ditemukan, tampilkan pesan error
if (!$dataMisa) {
    die("<script>alert('Data tidak ditemukan!'); window.location.href='misa.php';</script>");
}

// Ambil total persembahan dari tabel tbl_persembahan berdasarkan id_misa
$sqlTotal = mysqli_query($konek, "SELECT SUM(nominal) AS total_persembahan FROM tbl_persembahan WHERE id_misa='$id_misa'");
$totalPersembahan = mysqli_fetch_assoc($sqlTotal);
$total = ($totalPersembahan['total_persembahan']) ? $totalPersembahan['total_persembahan'] : 0;
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles/services.css">
    <link rel="stylesheet" type="text/css" href="styles/services_responsive.css">
    <title>Detail Misa</title>
    <style>
        .detail-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            text-align: center;
            color: #800000;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        th {
            text-align: left;
            color: #800000;
        }

        .total {
            font-size: 1.2rem;
            font-weight: bold;
            color: #333;
            text-align: right;
        }

        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #800000; /* Warna biru */
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }

        .back-button:hover {
            background-color: #004999;
        }

        .home_background {
            position: relative;
            width: 100%;
            min-height: 60vh;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }

        @media (max-width: 768px) {
            .home_background {
                min-height: 40vh;
                background-attachment: scroll;
            }
        }
    </style>
</head>

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>" data-speed="0.8"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title"><span>DETAIL</span> MISA</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li><a href="misa.php">Jadwal Misa</a></li>
                                <li>Detail Misa</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="detail-container">
    <h3>DETAIL JADWAL MISA</h3>
    <table>
        <tr><th>Hari</th><td><?php echo htmlspecialchars($dataMisa['hari']); ?></td></tr>
        <tr><th>Tanggal</th><td><?php echo date('d-m-Y', strtotime($dataMisa['tanggal'])); ?></td></tr>
        <tr><th>Pukul</th><td><?php echo date('H:i', strtotime($dataMisa['waktu'])); ?></td></tr>
        <tr><th>Nama Misa</th><td><?php echo htmlspecialchars($dataMisa['nama_misa']); ?></td></tr>
        <tr><th>Tempat</th><td><?php echo htmlspecialchars($dataMisa['tempat']); ?></td></tr>
        <tr><th>Penyelenggara</th><td><?php echo htmlspecialchars($dataMisa['penyelenggara']); ?></td></tr>
        <tr><th>Total Persembahan</th><td class="total"><?php echo "Rp " . number_format($total, 0, ',', '.'); ?></td></tr>
    </table>
    <a href="misa.php" class="back-button">Kembali</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>
<script>
  $(document).ready(function(){
      $('.parallax-window').parallax({imageSrc: $('.parallax-window').data('image-src')});
  });
</script>

<?php include 'footer.php'; ?>
