<?php
include 'header.php';

// Ambil gambar dari tabel background
$query = "SELECT nama_background FROM background WHERE nama_background IS NOT NULL";
$result = $konek->query($query);

// Simpan gambar ke dalam array
$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row['nama_background'];
}

// Jika gambar kurang dari 3, biarkan gambar bisa sama di slider
if (count($images) < 3) {
    $images_to_display = $images; // Biarkan gambar tetap sama
} else {
    // Acak gambar dan pastikan tidak ada gambar yang sama pada slider 1, 2, dan 3
    shuffle($images); // Acak urutan gambar
    $images_to_display = array_slice($images, 0, 3); // Ambil 3 gambar pertama
}
?>

	<!-- Home -->
    <head>
    	<title>Gereja Santo Martinus Weleri</title>
    	
    	<!-- Pastikan menggunakan Font Awesome yang cepat -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <!-- Home Section -->
    <div class="home">
        <div class="home_slider_container">
            <!-- Home Slider -->
            <div class="owl-carousel owl-theme home_slider">
                
                <!-- Slider Item (TETAP SATU GAMBAR, TIDAK BERGESER) -->
                <div class="owl-item">
                        <div class="home_slider_background" style="background-image:url('<?php echo $images_to_display[0]; ?>')"></div>
                        <div class="home_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="home_content_inner">
                                            <div class="home_title"><h1>Selamat Datang Di Sistem Informasi</h1></div>
                                            <a href="tentang.php" class="home_clickable_box"> <!-- Seluruh Kotak Bisa Diklik -->
                                            <div class="home_text">
                                                <p>GEREJA KATOLIK ST. MARTINUS WELERI</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a> 
                </div>
                <div class="owl-item">
                        <div class="home_slider_background" style="background-image:url('<?php echo $images_to_display[1]; ?>')"></div>
                        <div class="home_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="home_content_inner">
                                            <div class="home_title"><h1>Jangan Sampai Ketinggalan Berita Menarik</h1></div>
                                            <a href="news_gereja.php" class="home_clickable_box"> <!-- Seluruh Kotak Bisa Diklik -->
                                            <div class="home_text">
                                                <p>WARTA PAROKI</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a> 
                </div>
                <div class="owl-item">
                    <div class="home_slider_background" style="background-image:url('<?php echo $images_to_display[2]; ?>')"></div>
                        <div class="home_content">
                            <div class="container">
                                <div class="row">
                                    <div class="col">
                                        <div class="home_content_inner">
                                            <div class="home_title"><h1>Paroki Paling Barat Keuskupan Agung Semarang</h1></div>
                                            <a href="contact.php" class="home_clickable_box"> <!-- Seluruh Kotak Bisa Diklik -->
                                            <div class="home_text">
                                                <p>LOKASI GEREJA KATOLIK ST. MARTINUS WELERI</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a> 
                </div>
            </div>
    
            <!-- Slider Progress -->
            <div class="home_slider_progress"></div>
        </div>
    </div>

	<!-- 3 Boxes -->

	  <section id="contact" class="wow fadeInUp">
	<div class="boxes">
		<div class="container">
			<div class="row">
				
				<!-- Box -->
				<div class="col-lg-8 box_col">
					<div class="box working_hours">
						<div class="box_icon d-flex flex-column align-items-start justify-content-center">
							<div style="width:29px; height:29px;">
								<img src="images/alarm-clock.svg" alt="">
							</div>
						</div>
						<div class="box_title">JADWAL MISA HARI INI</div>
                        <div class="working_hours_list">
                            <ul>
                                <?php
                                // Pastikan koneksi tersedia
                                include 'koneksi.php';
                        
                                // Set zona waktu ke WIB (Asia/Jakarta)
                                date_default_timezone_set('Asia/Jakarta');
                        
                                // Ambil tanggal & waktu saat ini
                                $today = date("Y-m-d");
                                $current_time = date("H:i:s");
                        
                                // Query untuk mencari misa yang masih akan berlangsung hari ini
                                $qry = mysqli_query($konek, "SELECT * FROM jadwal_misa 
                                                            WHERE tanggal = '$today' 
                                                            AND waktu >= '$current_time'
                                                            ORDER BY waktu ASC");
                        
                                if ($qry && mysqli_num_rows($qry) > 0) {
                                    while ($data = mysqli_fetch_assoc($qry)) {
                                        echo '
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <h4><div>Diadakan misa: ' . htmlspecialchars($data["nama_misa"]) . '</div></h4>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <h4><div>Di ' . htmlspecialchars($data["tempat"]) . ' Pukul ' . date("H:i", strtotime($data["waktu"])) . ' WIB</div></h4>
                                        </li>
                                        <li class="d-flex flex-row align-items-center justify-content-start">
                                            <h4><div>Penyelenggara: ' . htmlspecialchars($data["penyelenggara"]) . '</div></h4>
                                        </li>
                                        <hr>'; // Tambahkan garis pemisah jika ada lebih dari satu misa
                                    }
                                } else {
                                    echo '
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <h4><div>Tidak ada jadwal misa untuk hari ini.</div></h4>
                                    </li>';
                                }
                                ?>
                            </ul>
                        </div>

					</div>
				</div>


				<div class="col-lg-4 box_col">
					<div class="box box_emergency">
						<div class="box_icon d-flex flex-column align-items-start justify-content-center">
							<div style="width: 37px; height:37px; margin-left:-4px;">
								<img src="images/phone-call.svg" alt="">
							</div>
						</div>
						
						<?php
						// Koneksi ke database
						include 'koneksi.php';

						// Ambil nama Romo dari tabel umat berdasarkan posisi "Romo Paroki"
						$qry = mysqli_query($konek, "SELECT nama_lengkap FROM umat WHERE posisi = 'Romo Paroki' LIMIT 1");
						$data_romo = mysqli_fetch_assoc($qry);
						$nama_romo = !empty($data_romo['nama_lengkap']) ? $data_romo['nama_lengkap'] : "Romo Tidak Ditemukan";
						?>

						<div class="box_title">Emergency Konseling</div>
						<div class="box_emergency_text"><?php echo $nama_romo; ?></div>
            				<div class="contact-links">
                                <a href="https://api.whatsapp.com/send?phone=6281392809487&amp;text=Permisi%20<?php echo urlencode($nama_romo); ?>,%20Saya%20ingin%20bertanya%20soal...">
        							<span class="fa-stack fa-lg">
        								<img src="images/wa.svg" alt="WhatsApp" width="32px">
        							</span>Chat: 0813-9280-9487
        						</a> 
        						<br>
        						<a href="tel:081392809487" class="contact-link">
        							<span class="fa-stack fa-lg">
        							 <img src="images/telephone.png" alt="Telepon" width="32px">
        							</span>Call : 0813-9280-9487
        						</a>
                            </div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>
	<!-- About -->
  <section id="contact" class="wow fadeInUp">
	<div class="about">
		<div class="container">
			<div class="row row-lg-eq-height">
				<div class="col-lg-7">
					<div class="about_content">
						<div class="section_title"><h2>Santo Martinus Dari Torus</h2></div>
						<div class="about_text">
							<h4 align="justify-content-center">"Sebab sama seperti kilat memancar dari ujung langit yang satu ke ujung langit yang lain, demikian pulalah kelak halnya Anak Manusia pada hari kedatangan-Nya."</h4>
						</div>
						<div class="button about_button">
							<a href="https://www.bible.com/id/bible/306/luk.17.24">Lukas 17:24</a>
						</div>
					</div>
				</div>

				<!-- About Image -->
				<div class="col-lg-5">
					<div class="about_image"><img src="img/slide/martinustorus.jpg" alt=""></div>
				</div>
			</div>
		</div>
	</div>
</section>
	  <section id="contact" class="wow fadeInUp">
    	<div class="services">
    		<div class="container">
    			<div class="row">
    				<div class="col">
    					<div class="section_title"><h2>PENGUMUMAN GEREJA</h2></div>
    			    	</div>
    		       	</div>
    		    	<div class="row services_row">
    				<!-- Service -->
    				 <?php
                        $qry = mysqli_query($konek,"SELECT * FROM tbl_file where kode order by kode limit 200");
                        while ($data=mysqli_fetch_assoc($qry)) {
                      ?>
            			<div class="col-lg-4 col-md-6 service_col">
            						<div class="service text-center trans_200">
            							<div class="service_icon"><img class="svg" src="images/alarm-clock.svg" alt=""></div>
            							<div class="service_title trans_200"><?php echo $data['tgl_posting']; ?></div>
            							<div class="service_text">
            								<div class="service_title trans_200"><?php echo $data['judul']; ?></div>
            
            							</div>
            							<div class="button dept_button"><a href="p_detail.php?id=<?php echo base64_encode($data['judul']); ?>">Baca selengkapnya</a></div>
            						</div>
            				</div>
            			<?php } ?>
        			</div>
        		</div>
        	</div>
        </section>

	<!-- Call to action -->

    <div class="cta">
        <div class="cta_background parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>" data-speed="0.8"></div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="cta_content text-center">
                        <h2>MISA MINGGUAN</h2>
                        <p>MATIUS : 6 : 33 = Tetapi carilah dahulu Kerajaan Allah dan kebenarannya, maka semuanya itu akan ditambahkan kepadamu</p>
    
                        <?php
                        // Pastikan koneksi tersedia
                        include 'koneksi.php';
    
                        // Set zona waktu ke WIB (Asia/Jakarta)
                        date_default_timezone_set('Asia/Jakarta');
    
                        // Query untuk mengambil jadwal misa "Misa Sabtu Sore" dan "Misa Minggu Pagi"
                        $query = "SELECT nama_misa, hari, DATE_FORMAT(waktu, '%H:%i') AS jam_misa 
                                  FROM jadwal_misa 
                                  WHERE nama_misa IN ('Misa Sabtu Sore', 'Misa Minggu Pagi') 
                                  ORDER BY FIELD(nama_misa, 'Misa Sabtu Sore', 'Misa Minggu Pagi'), waktu ASC";
                        $result = mysqli_query($konek, $query);
    
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<div class='button cta_button'><a href='misa.php'>{$row['hari']} : {$row['jam_misa']} WIB</a></div>";
                            }
                        } else {
                            echo "<p>Tidak ada jadwal misa untuk Sabtu & Minggu saat ini.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>        
    </div>

<!-- Hentikan Owl Carousel agar tidak bisa digeser -->
<script>
$(document).ready(function(){
    $(".home_slider").owlCarousel({
        items: 1,  // Hanya satu slide
        loop: false,  // Tidak ada looping
        autoplay: false,  // Tidak otomatis bergeser
        mouseDrag: false,  // Tidak bisa digeser dengan mouse
        touchDrag: false,  // Tidak bisa digeser dengan sentuhan
        nav: false,  // Tidak ada tombol navigasi
        dots: false  // Tidak ada indikator dot
    });
});
</script>

	<!-- Footer -->

<?php include'footer.php'; ?>