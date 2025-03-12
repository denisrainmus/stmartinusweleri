<?php 
include 'header.php'; 
include 'koneksi.php';

error_reporting(0);

// Validasi ID Berita
if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("<script>alert('ID berita tidak ditemukan!'); window.location.href='news_gereja.php';</script>");
}

$id = base64_decode($_GET["id"], true);
if (!$id || !ctype_digit($id)) {
    die("<script>alert('ID berita tidak valid!'); window.location.href='news_gereja.php';</script>");
}
$id = intval($id);

// Ambil detail berita
$stmt = $konek->prepare("SELECT * FROM tbl_blog WHERE kode = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    die("<script>alert('Berita tidak ditemukan!'); window.location.href='news_gereja.php';</script>");
}

$gambar_array = !empty($data['gambar']) ? explode(",", $data['gambar']) : [];

// URL saat ini untuk dibagikan
$current_url = "https://stmartinusweleri.com/news_detail.php?id=" . htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8');
?>

<head>
    <link rel="stylesheet" type="text/css" href="styles/news.css">
    <link rel="stylesheet" type="text/css" href="styles/news_responsive.css">
    <title>St. Martinus - <?php echo htmlspecialchars($data['judul']); ?></title>
    <meta property="og:title" content="<?php echo htmlspecialchars($data['judul']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars(substr(strip_tags($data['konten']), 0, 150)) . '...'; ?>">
    <meta property="og:url" content="<?php echo $current_url; ?>">
    <meta property="og:type" content="article">

    <!-- Menentukan gambar utama berita -->
    <?php 
    if (!empty($gambar_array)) {
        $og_image = "https://stmartinusweleri.com/img/blog/" . $gambar_array[0]; 
    } else {
        $og_image = "https://stmartinusweleri.com/images/default-news.jpg"; // Gambar default jika tidak ada gambar di berita
    }
    ?>
    <meta property="og:image" content="<?php echo $og_image; ?>">
    <meta property="og:image:secure_url" content="<?php echo $og_image; ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($data['judul']); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars(substr(strip_tags($data['konten']), 0, 150)) . '...'; ?>">
    <meta name="twitter:image" content="<?php echo $og_image; ?>">
    <style>
        /* Background tetap proporsional di semua perangkat */
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

        /* Tata letak konten berita dan sidebar */
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

        /* Konten berita lebih luas */
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

        .news-content img {
            max-width: 100%;
            height: auto;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
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
        
        /* Styling tombol submit komentar */
        .btn-submit-komentar {
            background-color: #800000;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        
        .btn-submit-komentar:hover {
            background-color: #660000;
        }
        
        .reply-btn {
            background-color: #800000;
            color: white;
            border: none;
            padding: 1px 5px;
            font-size: 10px;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 0px;
        }
        
        .reply-btn:hover {
            background-color: #660000;
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
                        <div class="home_title"><span>BERITA</span> DETAIL</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li><a href="news_gereja.php">News</a></li>
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

        <div class="news-image">
            <?php foreach ($gambar_array as $gambar) {
                echo "<img src='img/blog/$gambar' alt='News Image'>";
            } ?>
        </div>

        <div class="news-text">
            <?php echo $data['konten']; ?> <!-- CKEditor menyimpan format HTML -->
        </div>

        <div class="share_buttons">
            <p><strong>Bagikan Berita Ini:</strong></p>
            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($data['judul'] . ' ' . $current_url); ?>" target="_blank">
                <img src="images/wa.svg" alt="WhatsApp">
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($current_url); ?>&text=<?php echo urlencode($data['judul']); ?>" target="_blank">
                <img src="images/twitter.svg" alt="Twitter">
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>" target="_blank">
                <img src="images/facebook.svg" alt="Facebook">
            </a>
        </div>

        <a href="news_gereja.php" class="back-button">Kembali</a>
        
        <!-- Form Komentar -->
        <div class="comments-section">
            <h4>Komentar</h4>
            <form method="POST" action="submit_comment.php">
                <input type="hidden" name="berita_id" value="<?php echo base64_encode($id); ?>">
                <input type="hidden" name="parent_id" id="parent_id" value="0">
        
                <div class="form-group">
                    <label>Nama Anda</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
        
                <div class="form-group">
                    <label>Komentar</label>
                    <textarea name="komentar" class="form-control" rows="3" required></textarea>
                </div>
        
                <button type="submit" class="btn-submit-komentar">Kirim Komentar</button>
            </form>
        </div>
        <br>
        <!-- Daftar Komentar -->
        <div class="comments-list">
            <h4>Daftar Komentar</h4>
            <div id="comments-container">
                <?php
                function tampilkan_komentar($parent_id, $berita_id, $level = 0) {
                    global $konek;
                    $stmt = mysqli_prepare($konek, "SELECT id, nama, komentar, tanggal FROM tbl_komentar WHERE berita_id = ? AND parent_id = ? AND keterangan = 1 ORDER BY tanggal ASC");
                    mysqli_stmt_bind_param($stmt, "ii", $berita_id, $parent_id);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    
                    while ($komentar = mysqli_fetch_assoc($result)) {
                        echo "<div class='comment-box' style='margin-left: " . ($level * 20) . "px;'>";
                        echo "<strong>" . htmlspecialchars($komentar['nama']) . "</strong> <small>(" . date('d-m-Y H:i', strtotime($komentar['tanggal'])) . ")</small>";
                        echo "<p>" . nl2br(htmlspecialchars($komentar['komentar'])) . "</p>";
                        echo "<button class='reply-btn' data-id='" . $komentar['id'] . "'>Balas</button>";

                        tampilkan_komentar($komentar['id'], $berita_id, $level + 1);

                        echo "</div>";
                    }

                    mysqli_stmt_close($stmt);
                }

                tampilkan_komentar(0, $id);
                ?>
            </div>
        </div>
    </div>

    <div class="sidebar">
        <h4>List Berita</h4>
        <ul>
            <?php
            $qry = $konek->prepare("SELECT kode, judul FROM tbl_blog ORDER BY tgl_posting DESC LIMIT 10");
            $qry->execute();
            $result = $qry->get_result();
            $no = 1;
            while ($berita = $result->fetch_assoc()) {
                echo "<li>$no. <a href='news_detail.php?id=" . base64_encode($berita['kode']) . "'>" . htmlspecialchars($berita['judul']) . "</a></li>";
                $no++;
            }
            $qry->close();
            ?>
        </ul>
    </div>
</div>

<script>
document.querySelectorAll(".reply-btn").forEach(button => {
    button.addEventListener("click", function() {
        document.getElementById("parent_id").value = this.getAttribute("data-id");
        document.querySelector("textarea[name='komentar']").focus();
    });
});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>
<script>
  $(document).ready(function(){
      $('.parallax-window').parallax({imageSrc: $('.parallax-window').data('image-src')});
  });
</script>

<?php include 'footer.php'; ?>