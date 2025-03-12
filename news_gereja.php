<?php include 'header.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/news.css">
    <link rel="stylesheet" type="text/css" href="styles/news_responsive.css">
    <title>WARTA SMART</title>
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

/* Container berita tetap responsif */
.news-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

/* Kotak berita */
.news_post {
    display: flex;
    flex-direction: column;
    gap: 15px;
    background: #fff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.news_post:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Gambar berita */
.news_image {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.news_image img {
    width: 150px;
    height: auto;
    object-fit: cover;
    border-radius: 5px;
}

/* Judul berita */
.news_body {
    text-align: center;
}

/* Kotak tanggal */
.news_date_box {
    background-color: #800000;
    color: white;
    font-size: 14px;
    padding: 5px;
    border-radius: 3px;
    margin-top: 10px;
    display: inline-block;
}

/* Sidebar */
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

    </style>
</head>

<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>" data-speed="0.8"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title"><span>WARTA</span> SMART</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>WARTA</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- News -->
<div class="news">
    <div class="container">
        <div class="row">
            <!-- News Posts -->
            <div class="col-lg-8">
                <div class="news_posts">
                    <?php
                    include 'koneksi.php';
                    $qry = mysqli_query($konek, "SELECT * FROM tbl_blog ORDER BY tgl_posting DESC LIMIT 100");
                    while ($data = mysqli_fetch_assoc($qry)) {
                        $gambar_array = explode(",", $data['gambar']);
                    ?>
                    <div class="news_post">
                        <div class="news_image">
                            <?php foreach ($gambar_array as $gambar) {
                                echo "<img src='img/blog/$gambar' alt=''>";
                            } ?>
                        </div>
                        <div class="news_body">
                            <div class="news_title"><a href="news_detail.php?id=<?php echo base64_encode($data['kode']); ?>"><?php echo $data['judul']; ?></a></div>
                            <div class="news_info">
                                <ul>
                                    <li class="news_author"><span>Post</span><a href="#"> <?php echo $data['user']; ?></a></li>
                                </ul>
                            </div>
                            <div class="news_date_box"><?php echo date('d-m-Y', strtotime($data['tgl_posting'])); ?></div>
                            <div class="button about_button">
                                <a href="news_detail.php?id=<?php echo base64_encode($data['kode']); ?>">SELENGKAPNYA</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Categories -->
                    <div class="sidebar_categories sidebar_section">
                        <div class="sidebar_section_title">
                            <div class="sidebar_title">LIST</div>
                        </div>
                        <ul>
                            <?php
                            $qry = mysqli_query($konek, "SELECT * FROM tbl_blog ORDER BY tgl_posting DESC LIMIT 10");
                            $no = 1;
                            while ($data = mysqli_fetch_assoc($qry)) {
                            ?>
                            <li><?php echo $no; ?>. <a href="news_detail.php?id=<?php echo base64_encode($data['kode']); ?>"><?php echo $data['judul']; ?></a></li>
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
