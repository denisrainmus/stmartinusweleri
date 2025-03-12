<?php include 'header.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/news.css">
    <link rel="stylesheet" type="text/css" href="styles/news_responsive.css">
    <title>Warta Gereja</title>
    <style>
        /* Background */
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

        /* Warta Section */
        .warta-section {
            padding: 60px 0;
            background-color: #f8f9fa;
            text-align: center;
        }
        .warta-section .section_title h2 {
            font-size: 26px;
            font-weight: bold;
            color: #800000;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        /* Filter Buttons */
        .filter-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .filter-btn {
            background: #800000;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }
        .filter-btn:hover, .filter-btn.active {
            background: #660000;
        }

        /* Warta Container */
        .warta-container, .pengumuman-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        /* Warta Berita */
        .warta-item {
            flex: 0 0 calc(45% - 20px);
            background: #ffffff;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease-in-out;
            padding: 15px;
            border: 1px solid #dee2e6;
        }
        .warta-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .warta-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s;
        }
        .warta-item img:hover {
            transform: scale(1.1);
        }
        .warta-item h5 {
            margin: 10px 0;
            font-size: 1rem;
            color: #333;
        }
        /* Mengubah warna link pada berita menjadi merah */
        .warta-item a {
            color: #800000;
            font-weight: bold;
            text-decoration: none;
        }
        
        .warta-item a:hover {
            text-decoration: underline;
        }

        /* Pengumuman */
        .pengumuman-item {
            flex: 0 0 100%;
            background: #ffffff;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 15px;
            text-align: left;
            border-left: 5px solid #800000;
        }
        .pengumuman-item h5 {
            margin-bottom: 8px;
            font-size: 18px;
            color: #800000;
        }
        .pengumuman-item p {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }
        .pengumuman-item .date-box {
            background-color: #800000;
            color: white;
            font-size: 13px;
            padding: 4px 8px;
            border-radius: 3px;
            display: inline-block;
            margin-top: 5px;
        }
        .pengumuman-item a {
            color: #800000;
            font-weight: bold;
            text-decoration: none;
        }
        .pengumuman-item a:hover {
            text-decoration: underline;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .warta-item {
                flex: 0 0 calc(100% - 20px);
            }
            .pengumuman-item {
                flex: 0 0 100%;
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
                        <div class="home_title"><span>WARTA</span> GEREJA</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>Warta</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Warta Section -->
<div class="warta-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title"><h2>Berita & Pengumuman</h2></div>
            </div>
        </div>

        <!-- Filter Buttons -->
        <div class="filter-container">
            <button class="filter-btn active" onclick="filterWarta('all')">Semua</button>
            <button class="filter-btn" onclick="filterWarta('warta')">Warta Berita</button>
            <button class="filter-btn" onclick="filterWarta('pengumuman')">Pengumuman</button>
        </div>

        <!-- Warta Berita -->
        <div class="warta-container" id="warta">
            <?php
                include 'koneksi.php';
                $qry = mysqli_query($konek, "SELECT * FROM tbl_blog ORDER BY tgl_posting DESC");
                while ($data = mysqli_fetch_assoc($qry)) {
                    $gambar = explode(",", $data['gambar'])[0]; // Ambil gambar pertama
            ?>
            <div class="warta-item">
                <img src="img/blog/<?php echo $gambar; ?>" alt="<?php echo htmlspecialchars($data['judul']); ?>">
                <h5><?php echo htmlspecialchars($data['judul']); ?></h5>
                <p><strong>Tanggal:</strong> <?php echo date('d-m-Y', strtotime($data['tgl_posting'])); ?></p>
                <a href="news_detail.php?id=<?php echo base64_encode($data['kode']); ?>">Baca Selengkapnya</a>
            </div>
            <?php } ?>
        </div>

        <!-- Pengumuman -->
        <div class="pengumuman-container" id="pengumuman">
            <?php
                $qry = mysqli_query($konek, "SELECT * FROM tbl_file ORDER BY kode ASC");
                while ($data = mysqli_fetch_assoc($qry)) {
            ?>
            <div class="pengumuman-item">
                <h5><?php echo htmlspecialchars($data['judul']); ?></h5>
                <p><strong>Tanggal:</strong> <?php echo date('d-m-Y', strtotime($data['tgl_posting'])); ?></p>
                <a href="p_detail.php?id=<?php echo base64_encode($data['judul']); ?>">Baca Selengkapnya</a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script>
    function filterWarta(category) {
        document.getElementById("warta").style.display = category === "warta" || category === "all" ? "flex" : "none";
        document.getElementById("pengumuman").style.display = category === "pengumuman" || category === "all" ? "flex" : "none";
    }
</script>

<?php include 'footer.php'; ?>
