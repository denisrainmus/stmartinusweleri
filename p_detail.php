<?php 
include 'header.php'; 
include 'koneksi.php';

error_reporting(0);
$id = base64_decode($_GET["id"]);
$sqlku = mysqli_query($konek, "SELECT * FROM tbl_file WHERE judul='$id'");
$data  = mysqli_fetch_array($sqlku);

// Jika data tidak ditemukan, tampilkan pesan error
if (!$data) {
    die("<script>alert('Pengumuman tidak ditemukan!'); window.location.href='index.php';</script>");
}

// URL saat ini untuk dibagikan
$current_url = "https://stmartinusweleri.com/p_detail.php?id=" . htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles/news.css">
    <link rel="stylesheet" type="text/css" href="styles/news_responsive.css">
    <title>St. Martinus - <?php echo htmlspecialchars($data['judul']); ?></title>
    <style>
        /* Background tetap proporsional di semua perangkat */
        .home_background {
            position: relative;
            width: 100%;
            height: 60vh; /* Default untuk laptop */
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
        }

        /* Untuk tampilan HP, background tetap proporsional */
        @media (max-width: 768px) {
            .home_background {
                height: 40vh;
                background-attachment: scroll;
            }
        }

        /* Tata letak konten pengumuman dan sidebar */
        .news-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 40px;
        }

        /* Konten pengumuman lebih luas */
        .news-content {
            flex: 3;
        }

        /* Sidebar tetap ada di sebelah kanan di laptop */
        .sidebar {
            flex: 1;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        
        .sidebar ul li {
            font-size: 16px;
            font-weight: bold;
            color: #800000; /* Warna teks */
            padding: 5px 0;
        }
        
        .sidebar ul li a {
            text-decoration: none;
            color: #800000; /* Warna link */
        }
        
        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        /* Pastikan di HP sidebar tetap di bawah, tidak di samping */
        @media (max-width: 992px) {
            .news-container {
                flex-direction: column;
            }
        }

        h3 {
            text-align: center;
            color: #800000;
            margin-bottom: 20px;
        }

        .news-meta {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .share_buttons {
            margin-top: 20px;
            text-align: center;
        }

        .share_buttons img {
            margin: 5px;
            width: 32px;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .share_buttons img:hover {
            transform: scale(1.1);
        }

        .back-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #800000;
            color: white;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: background 0.3s ease-in-out;
        }

        .back-button:hover {
            background-color: #660000;
        }
    </style>
</head>

<div class="home">
    <div class="home_background" style="background-image: url('<?php echo $background_image; ?>');"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title"><span>PENGUMUMAN</span> DETAIL</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li><?php echo htmlspecialchars($data['judul']); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news-container">
    <div class="news-content">
        <h3><?php echo htmlspecialchars($data['judul']); ?></h3>
        <p class="news-meta">Tanggal Posting: <?php echo date('d-m-Y', strtotime($data['tgl_posting'])); ?> | Post: <?php echo htmlspecialchars($data['user']); ?></p>

        <div class="news-text">
            <?php echo $data['konten']; ?> <!-- CKEditor menyimpan format HTML -->
        </div>
        <div class="share_buttons">
            <p><strong>Teruskan Pengumuman Ini:</strong></p>
            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($data['judul'] . ' ' . $current_url); ?>" target="_blank">
                <img src="images/wa.svg" alt="WhatsApp">
            </a>
        </div>
        <a href="index.php" class="back-button">Kembali</a>
    </div>

    <!-- Sidebar tetap ada dan tidak naik ke samping di HP -->
    <div class="sidebar">
        <h4>List Pengumuman</h4>
        <ul>
            <?php
            $qry = mysqli_query($konek, "SELECT * FROM tbl_file ORDER BY tgl_posting DESC LIMIT 10");
            $no = 1; 
            while ($data = mysqli_fetch_assoc($qry)) {
            ?>
            <li><?php echo $no; ?>. <a href="p_detail.php?id=<?php echo base64_encode($data['judul']); ?>"><?php echo $data['judul']; ?></a></li>
            <?php 
            $no++; 
            } 
            ?>
        </ul>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>

<?php include 'footer.php'; ?>
