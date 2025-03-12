<?php include 'header.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/services.css">
    <link rel="stylesheet" type="text/css" href="styles/services_responsive.css">
    <title>Jadwal Misa</title>
    <style type="text/css">
        .misa-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .misa-item {
            flex: 0 0 calc(25% - 20px);
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            text-align: center;
            transition: all 0.3s ease-in-out;
            padding: 20px;
            border: 1px solid #dee2e6;
            cursor: pointer;
        }

        .misa-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .misa-item h5 {
            font-size: 1.6rem;
            color: #800000;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease-in-out;
        }

        .misa-item h5:hover {
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.8);
        }

        .misa-item p {
            font-size: 1rem;
            color: #555;
            margin: 8px 0;
        }

        .misa-item strong {
            color: #333;
        }

        @media (max-width: 768px) {
            .misa-item {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .misa-item {
                flex: 0 0 calc(100% - 20px);
            }
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
                        <div class="home_title"><span>JADWAL</span> MISA</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>Jadwal Misa</li>
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
                <div class="features_container misa-container">
                    <?php
                    include 'koneksi.php';

                    // Ambil jadwal misa yang belum lewat dari hari ini atau yang memiliki nama "Misa Sabtu Sore" atau "Misa Minggu Pagi"
                    $qry = mysqli_query($konek, "SELECT id_misa, hari, tanggal, waktu, nama_misa, tempat, penyelenggara 
                                                 FROM jadwal_misa 
                                                 WHERE tanggal >= CURDATE() 
                                                 OR nama_misa IN ('Misa Sabtu Sore', 'Misa Minggu Pagi') 
                                                 ORDER BY tanggal ASC");

                    while ($data = mysqli_fetch_assoc($qry)) {
                        $encoded_id = base64_encode($data['id_misa']);
                    ?>
                        <div class="misa-item" onclick="window.location.href='misa_detail.php?id=<?php echo $encoded_id; ?>'">
                            <h5><?php echo htmlspecialchars($data['nama_misa']); ?></h5>
                            <p><strong>Hari:</strong> <?php echo htmlspecialchars($data['hari']); ?></p>
                            <p><strong>Tanggal:</strong> <?php echo date('d M Y', strtotime($data['tanggal'])); ?></p>
                            <p><strong>Waktu:</strong> <?php echo htmlspecialchars($data['waktu']); ?></p>
                            <p><strong>Tempat:</strong> <?php echo htmlspecialchars($data['tempat']); ?></p>
                            <p><strong>Penyelenggara:</strong> <?php echo htmlspecialchars($data['penyelenggara']); ?></p>
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
