<?php include 'header.php'; ?>
<head>
<link rel="stylesheet" type="text/css" href="styles/services.css">
<link rel="stylesheet" type="text/css" href="styles/services_responsive.css">
<title>Galeri Gereja</title>
<style type="text/css">
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

/* Container galeri tetap responsif */
.gallery-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

/* Menyesuaikan jumlah kolom di berbagai ukuran layar */
.gallery-item {
    flex: 0 0 calc(25% - 20px); /* 4 kolom di layar besar */
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    overflow: hidden;
    text-align: center;
    transition: all 0.3s ease-in-out;
    padding: 15px;
    border: 1px solid #dee2e6;
}

.gallery-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.gallery-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s;
}

.gallery-item img:hover {
    transform: scale(1.1);
}

.gallery-item h5 {
    margin: 10px 0;
    font-size: 1rem;
    color: #333;
}

/* Untuk tablet */
@media (max-width: 768px) {
    .gallery-item {
        flex: 0 0 calc(50% - 20px); /* 2 kolom */
    }
}

/* Untuk HP */
@media (max-width: 480px) {
    .gallery-item {
        flex: 0 0 calc(100% - 20px); /* 1 kolom */
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
                        <div class="home_title"><span>GALLERY</span> GEREJA</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>Gallery</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="features">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="features_container gallery-container">
                    <?php
                    include 'koneksi.php'; // Pastikan koneksi ke database sudah benar
                    $qry = mysqli_query($konek, "SELECT * FROM tbl_folio ORDER BY kode LIMIT 200");
                    while ($data = mysqli_fetch_assoc($qry)) {
                        // Menggunakan gambar dari folder img/folio
                        $gambar_url = "img/folio/" . $data['gambar'];
                        // Ambil tanggal yang disimpan di database
                        $tanggal = $data['tanggal']; 
                        $formatted_date = date("d-m-Y H:i:s", strtotime($tanggal)); // Format tanggal dan waktu
                    ?>
                        <div class="gallery-item">
                            <img src="<?php echo $gambar_url; ?>" alt="<?php echo htmlspecialchars($data['nama']); ?>">
                            <h5><?php echo htmlspecialchars($data['nama']); ?></h5>
                            <!-- Tampilkan tanggal dan waktu -->
                            <p><strong>Tanggal:</strong> <?php echo $formatted_date; ?></p>
                        </div>
                    <?php } ?>
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
