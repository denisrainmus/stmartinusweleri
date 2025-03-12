<?php include'header.php'; ?>
<head>
	<link rel="stylesheet" type="text/css" href="styles/elements.css">
<link rel="stylesheet" type="text/css" href="styles/elements_responsive.css">
<title>Profil - Gereja St. Martinus</title>
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

</style>
</head>

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>" data-speed="0.8"></div>
        <div class="home_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="home_content">
                            <div class="home_title"><span>PROFIL</span> PAROKI WELERI</div>
                            <div class="breadcrumbs">
                                <ul>
                                    <li><a href="index.php">Beranda</a></li>
                                    <li>Profil</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<!-- Accordions & Tabs -->

	<div class="accordions_tabs">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title"><h2>Profil Gereja St. Martinus Weleri</h2></div>
				</div>
			</div>

			<div class="row accordions_tabs_row">
				<div class="col-lg-12">
				
					<!-- Accordions -->
					<div class="accordions">
						
						<div class="elements_accordions">
                            <?php
                            $sql_romo = mysqli_query($konek, "SELECT nama_romo, judul_pesan, ucapan, hari, tanggal, gambar FROM ucapanromo ORDER BY created_at DESC LIMIT 1");
                            $data_romo = mysqli_fetch_assoc($sql_romo);
                        
                            if ($data_romo) {
                                $nama_romo = $data_romo['nama_romo'];
                                $judul_pesan = $data_romo['judul_pesan'];
                                $gambar = $data_romo['gambar'];
                                $ucapan = htmlspecialchars_decode($data_romo['ucapan']); // Menampilkan HTML dari CKEditor dengan benar
                                $hari = $data_romo['hari'];
                                $tanggal = $data_romo['tanggal'];
                            } else {
                                // Jika tidak ada data, beri nilai default agar tidak error
                                $nama_romo = "Tidak Ada Data";
                                $judul_pesan = "Tidak Ada Ucapan";
                                $gambar = "img/gambar/default.jpg"; // Gambar default
                                $ucapan = "Belum ada ucapan dari Romo.";
                                $hari = "-";
                                $tanggal = "-";
                            }
                            ?>
                        
                            <div class="accordion_container">
                                <div class="accordion d-flex flex-row align-items-center active"><div>Umat Beriman</div></div>
                                <div class="accordion_panel">
                                    <div>
                                        <p><strong><?php echo htmlspecialchars($nama_romo); ?><br> <em><?php echo htmlspecialchars($judul_pesan); ?></em></strong></p>
                                        <img src="<?php echo htmlspecialchars($gambar); ?>" width="70%" onerror="this.onerror=null;this.src='img/gambar/default.jpg';">
                                        <p><?php echo $ucapan; ?></p> <!-- Menampilkan teks CKEditor dengan format yang benar -->
                                        <p><small><?php echo htmlspecialchars($hari); ?>, <?php echo htmlspecialchars($tanggal); ?></small></p>
                                    </div>
                                </div>
                            </div>
                        </div>

							<div class="accordion_container">
   								<div class="accordion d-flex flex-row align-items-center">
      								<div>SEJARAH GEREJA</div>
    							</div>
    								<div class="accordion_panel">
        								<div>
										<?php
												// Pastikan koneksi tersedia
												if (!isset($konek)) {
													die("Koneksi database tidak tersedia.");
												}

												// Jalankan query
												$query = "SELECT * FROM sejarah"; // Pastikan tabel sesuai dengan yang ada di database
												$result = $konek->query($query);

												// Periksa apakah query berhasil dijalankan
												if (!$result) {
													die("Query gagal: " . $konek->error);
												}
												?>

												<?php
												if ($result->num_rows > 0) { // Perbaikan di sini
													while ($row = $result->fetch_assoc()) {
														echo "<h4>" . htmlspecialchars($row['judul']) . "</h4>";
														echo "<p>" . nl2br(htmlspecialchars($row['isi'])) . "</p>";
														echo "<small><em>" . date("d M Y", strtotime($row['tanggal'])) . "</em></small><hr>";
													}
												} else {
													echo "<p>Tidak ada data sejarah tersedia.</p>";
												}
												?>

										</div>
									</div>
								</div>

								<div class="accordion_container">
									<div class="accordion d-flex flex-row align-items-center"><div>Nama Pastor Paroki & Biarawan</div></div>
									<div class="accordion_panel">
										<div>
											<?php
											include 'koneksi.php'; // Pastikan file koneksi database sudah disertakan
											
											// Ambil semua Romo Paroki dari tabel umat
											$queryRomo = "SELECT nama_lengkap FROM umat WHERE posisi = 'Romo Paroki'";
											$resultRomo = mysqli_query($konek, $queryRomo);

											echo "<strong>Pastor Paroki:</strong><br>";
											if (mysqli_num_rows($resultRomo) > 0) {
												$no = 1;
												while ($row = mysqli_fetch_assoc($resultRomo)) {
													echo "$no. " . htmlspecialchars($row['nama_lengkap']) . "<br>";
													$no++;
												}
											} else {
												echo "Belum ada data Romo Paroki.<br>";
											}

											echo "<br><strong>Biarawan:</strong><br>";
											// Ambil semua Biarawan dari tabel umat
											$queryBiarawan = "SELECT nama_lengkap FROM umat WHERE posisi = 'Biarawan'";
											$resultBiarawan = mysqli_query($konek, $queryBiarawan);

											if (mysqli_num_rows($resultBiarawan) > 0) {
												$no = 1;
												while ($row = mysqli_fetch_assoc($resultBiarawan)) {
													echo "$no. " . htmlspecialchars($row['nama_lengkap']) . "<br>";
													$no++;
												}
											} else {
												echo "Belum ada data Biarawan.<br>";
											}

											echo "<br><strong>Biarawati:</strong><br>";
											// Ambil semua Biarawati dari tabel umat
											$queryBiarawati = "SELECT nama_lengkap FROM umat WHERE posisi = 'Biarawati'";
											$resultBiarawati = mysqli_query($konek, $queryBiarawati);

											if (mysqli_num_rows($resultBiarawati) > 0) {
												$no = 1;
												while ($row = mysqli_fetch_assoc($resultBiarawati)) {
													echo "$no. " . htmlspecialchars($row['nama_lengkap']) . "<br>";
													$no++;
												}
											} else {
												echo "Belum ada data Biarawati.<br>";
											}

											?>
										</div>
									</div>
								</div>

						</div>

					</div>
				</div>

			
			</div>
		</div>
	</div>

	<!-- Milestones -->

	<!-- Fetch counts from database -->
	<?php
	// Ambil data dari database
	$romoparoki = $konek->query("SELECT COUNT(*) as count FROM umat WHERE posisi = 'Romo Paroki'")->fetch_assoc()['count'];
	$omk = $konek->query("SELECT COUNT(*) as count FROM umat WHERE posisi = 'OMK'")->fetch_assoc()['count'];
	$biarawan = $konek->query("SELECT COUNT(*) as count FROM umat WHERE posisi = 'Biarawan'")->fetch_assoc()['count'];
	$biarawati = $konek->query("SELECT COUNT(*) as count FROM umat WHERE posisi = 'Biarawati'")->fetch_assoc()['count'];
	$totalUmat = $konek->query("SELECT COUNT(*) as count FROM umat")->fetch_assoc()['count'];

	// Total Biarawan & Biarawati
	$totalBiarawanBiarawati = $biarawan + $biarawati;

	$konek->close();
	?>


<div class="milestones">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title"><h2>JUMLAH PENGURUS & UMAT GEREJA</h2></div>
            </div>
        </div>
        <div class="row milestones_container">
            
            <!-- Milestone: Romo Paroki -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/user.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="<?php echo $romoparoki; ?>">0</div>
                    <div class="milestone_text">Romo Paroki</div>
                </div>
            </div>

            <!-- Milestone: OMK -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/user.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="<?php echo $omk; ?>">0</div>
                    <div class="milestone_text">OMK</div>
                </div>
            </div>

            <!-- Milestone: Biarawan & Biarawati -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/user.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="<?php echo $totalBiarawanBiarawati; ?>">0</div>
                    <div class="milestone_text">Biarawan & Biarawati</div>
                </div>
            </div>

            <!-- Milestone: Total Umat -->
            <div class="col-lg-3 milestone_col">
                <div class="milestone text-center">
                    <div class="milestone_icon"><img src="images/user.svg" alt=""></div>
                    <div class="milestone_counter" data-end-value="<?php echo $totalUmat; ?>">0</div>
                    <div class="milestone_text">Total Umat</div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<br>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>
<script>
  $(document).ready(function(){
      $('.parallax-window').parallax({imageSrc: $('.parallax-window').data('image-src')});
  });
</script>
<?php include'footer.php'; ?>