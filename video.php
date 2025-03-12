<?php include'header.php'; ?>
<head>
<link rel="stylesheet" type="text/css" href="styles/services.css">
<link rel="stylesheet" type="text/css" href="styles/services_responsive.css">
	<title>Video Smart</title>
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

/* Container video tetap responsif */
.video-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    padding: 20px;
}

/* Menyesuaikan jumlah kolom di berbagai ukuran layar */
.video-item {
    flex: 0 0 calc(33.33% - 20px); /* 3 kolom di layar besar */
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    overflow: hidden;
    text-align: center;
    transition: all 0.3s ease-in-out;
    padding: 15px;
    border: 1px solid #dee2e6;
}

.video-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.video-item iframe {
    width: 100%;
    height: 200px;
    border-radius: 8px;
}

/* Judul video */
.video-item h5 {
    margin: 10px 0;
    font-size: 1rem;
    color: #333;
}

/* Untuk tablet */
@media (max-width: 992px) {
    .video-item {
        flex: 0 0 calc(50% - 20px); /* 2 kolom */
    }
}

/* Untuk HP */
@media (max-width: 576px) {
    .video-item {
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
                        <div class="home_title"><span>VIDEO</span> GEREJA</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>Video</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	<!-- Services -->

	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title"><h2>Daftar Video</h2></div>
				</div>
			</div>


			<div class="row services_row">
				 <?php
			     $qry = mysqli_query($konek,"SELECT * FROM tbl_video where kode order by kode limit 100");
			     while ($data=mysqli_fetch_assoc($qry)) {
			     parse_str(parse_url($data['alamat'], PHP_URL_QUERY), $params);
                $video_id = $params['v'] ?? basename(parse_url($data['alamat'], PHP_URL_PATH));
	            ?>
				<div class="col-lg-6 col-md-6 service_col">
					<div class="service_title trans_200"><?php echo $data['nama']; ?></div>
							<iframe width="100%" height="290" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
				</div>
		        <?php } ?>
			</div>
		</div>
	</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>
<script>
  $(document).ready(function(){
      $('.parallax-window').parallax({imageSrc: $('.parallax-window').data('image-src')});
  });
</script>	

<?php include'footer.php'; ?>