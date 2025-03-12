<?php include 'header.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/news.css">
    <link rel="stylesheet" type="text/css" href="styles/news_responsive.css">
    <title>WARTA PENGUMUMAN</title>
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

        /* Container berita */
        .news {
            padding: 20px 0;
        }
        .news .container {
            padding: 0 15px;
        }
        /* Menata kotak pengumuman secara horizontal */
        .news-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        /* Kotak pengumuman dengan layout horizontal */
        .news_post {
            display: flex;
            flex-direction: row;
            background: #fff;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            max-width: 700px;
            margin: 0 auto 20px auto;
        }
        .news_post:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        /* Gambar di sebelah kiri */
        .news_image {
            flex: 0 0 120px;
            margin-right: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .news_image img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 5px;
        }
        /* Konten pengumuman di sebelah kanan */
        .news_body {
            flex: 1;
            text-align: left;
        }
        .news_title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .news_info ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .news_info ul li {
            font-size: 13px;
            color: #555;
        }
        .news_date_box {
            background-color: #800000;
            color: white;
            font-size: 13px;
            padding: 4px 8px;
            border-radius: 3px;
            margin: 8px 0;
            display: inline-block;
        }
        .news_excerpt {
            font-size: 14px;
            color: #333;
            margin: 8px 0;
            text-align: justify;
        }
        /* Tombol 'SELENGKAPNYA' yang lebih kecil */
        .button.about_button a {
            text-decoration: none;
            background: #800000;
            color: #fff;
            padding: 1px 8px;
            border-radius: 5px;
            transition: background 0.3s ease;
            font-size: 10px;
        }
        .button.about_button a:hover {
            background: #800000;
        }
        /* Sidebar */
        .sidebar {
            /* Menetapkan lebar minimum agar daftar tidak menyusut */
            min-width: 250px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            font-size: 16px;
            font-weight: bold;
            color: #800000;
            padding: 5px 0;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #800000;
        }
        .sidebar ul li a:hover {
            text-decoration: underline;
        }
        /* Responsive: untuk layar kecil, tampilkan layout vertikal */
        @media (max-width: 576px) {
            .news_post {
                flex-direction: column;
                align-items: center;
            }
            .news_image {
                margin-right: 0;
                margin-bottom: 10px;
            }
            .news_body {
                text-align: center;
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
                        <div class="home_title"><span>WARTA</span> PENGUMUMAN</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>Pengumuman</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pengumuman -->
<div class="news">
    <div class="container">
        <div class="row">
            <!-- Pengumuman Posts -->
            <div class="col-lg-8">
                <div class="news-container">
                    <?php
                        include 'koneksi.php';
                        // Mengambil data dari tbl_file
                        $qry = mysqli_query($konek, "SELECT * FROM tbl_file WHERE kode ORDER BY kode LIMIT 200");
                        while ($data = mysqli_fetch_assoc($qry)) {
                    ?>
                    <div class="news_post">
                        <div class="news_image">
                            <!-- Menggunakan icon default sebagai gambar pengumuman -->
                            <img src="images/alarm-clock.svg" alt="Icon Pengumuman">
                        </div>
                        <div class="news_body">
                            <div class="news_title">
                                <a href="p_detail.php?id=<?php echo base64_encode($data['judul']); ?>">
                                    <?php echo $data['judul']; ?>
                                </a>
                            </div>
                            <div class="news_info">
                                <ul>
                                    <li class="news_author"><span>Post </span><a href="#"><?php echo $data['user']; ?></a></li>
                                </ul>
                            </div>
                            <div class="news_date_box">
                                <?php echo date('d-m-Y', strtotime($data['tgl_posting'])); ?>
                            </div>
                            <!-- Cuplikan isi pengumuman -->
                            <div class="news_excerpt">
                                <?php echo substr($data['konten'], 0, 150) . '...'; ?>
                            </div>
                            <div class="button about_button">
                                <a href="p_detail.php?id=<?php echo base64_encode($data['judul']); ?>">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- List Pengumuman -->
                    <div class="sidebar_categories sidebar_section">
                        <div class="sidebar_section_title">
                            <div class="sidebar_title">LIST</div>
                        </div>
                        <ul>
                            <?php
                                $qry = mysqli_query($konek, "SELECT * FROM tbl_file WHERE kode ORDER BY kode LIMIT 10");
                                $no = 1;
                                while ($data = mysqli_fetch_assoc($qry)) {
                            ?>
                            <li>
                                <?php echo $no; ?>. 
                                <a href="p_detail.php?id=<?php echo base64_encode($data['judul']); ?>">
                                    <?php echo $data['judul']; ?>
                                </a>
                            </li>
                            <?php $no++; } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>
<script>
   $(document).ready(function(){
       $('.parallax-window').parallax({imageSrc: $('.parallax-window').data('image-src')});
   });
</script>
<?php include 'footer.php'; ?>
