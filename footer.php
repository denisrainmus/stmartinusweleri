<?php require_once 'koneksi.php'; ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


	<footer class="footer">
		<div class="footer_container">
			<div class="container">
				<div class="row">
					
					<!-- Footer - About -->
					<div class="col-lg-4 footer_col">
						<div class="footer_about">
							<div class="footer_logo_container">
								<a href="index.php" class="d-flex flex-column align-items-center justify-content-center">
									<div class="logo_content">
										<div class="logo d-flex flex-row align-items-center justify-content-center">
                                            <div class="logo_text">SANTO MARTINUS<span>WELERI</span></div>
                                            <img src="images/cross.svg" alt="Cross Icon" width="15" height="25">
                                        </div>
										<div class="logo_sub">KOMSOS GEREJA</div>
									</div>
								</a>
							</div>
							<div class="footer_about_text">
								<p>"CARILAH DULU KERAJAAN ALAAH DAN KEBENARAN NYA"</p>
							</div>
                            <ul class="footer_about_list">
                                <li>
                                    <div class="footer_about_icon"><img src="images/phone-call.svg" alt="Telepon"></div>
                                    <span><a href="tel:(0294)641046">(0294)641046</a></span>
                                </li>
                                <li>
                                    <div class="footer_about_icon"><img src="images/envelope.svg" alt="Email"></div>
                                    <span><a href="mailto:komsos.stmartinus@gmail.com">komsos.stmartinus@gmail.com</a></span>
                                </li>
                                <li>
                                    <div class="footer_about_icon"><img src="images/placeholder.svg" alt="Alamat"></div>
                                    <span>Jl. Raya Utama Tengah No.119, Nawangsari I, Nawangsari, Kec. Weleri, Kabupaten Kendal, Jawa Tengah 51355</span>
                                </li>
                            </ul>
						</div>
					</div>

					<!-- Footer - Links -->
					<div class="col-lg-4 footer_col">
						<div class="footer_links footer_column">
						<div class="footer_title">Daftar Pengumuman</div>
							<ul>
								<?php
								// Sertakan koneksi database
								include 'koneksi.php';

								// Ambil data pengumuman dari database sesuai dengan query yang digunakan di bagian Service
								$qry = mysqli_query($konek, "SELECT * FROM tbl_file WHERE kode ORDER BY kode LIMIT 8");

								while ($data = mysqli_fetch_assoc($qry)) {
									echo '<li><a href="p_detail.php?id=' . base64_encode($data['judul']) . '">' . htmlspecialchars($data['judul']) . '</a></li>';
								}
								?>
							</ul>
						</div>
					</div>


					<!-- Footer - News -->
					<div class="col-lg-4 footer_col">
						<div class="footer_news footer_column">
							<div class="footer_title">Berita Terbaru</div>
							<!-- <ul> -->
							<ul>
									  <?php
								            $qry = mysqli_query($konek,"SELECT * FROM tbl_blog where kode order by tgl_posting desc limit 5");
								            while ($data=mysqli_fetch_assoc($qry)) {
								          ?>
								<li>
									<div class="footer_news_title"><a href="news_detail.php?id=<?php echo base64_encode($data['kode']); ?>"><?php echo $data['judul']; ?></a></div>
									<a href="news_detail.php?id=<?php echo base64_encode($data['kode']); ?>">Baca Selengkapnya </a>
								</li>

							<?php } ?>
							</ul>
							<!-- </ul> -->
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright text-center">
		    <br>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col text-center">
                        <h4>&copy; SMART Weleri <?php echo date('Y'); ?></h4>
                        <div class="footer_social mt-2">
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="https://www.facebook.com/KomSosSMartWel"><i class="fa-brands fa-facebook" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.youtube.com/@komsosweleri7091"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a></li>
                                <li class="list-inline-item"><a href="https://www.instagram.com/komsos.martinus.id/"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
	</footer>
</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/custom.js"></script>





<!-- <script src="js/jquery-3.2.1.min.js"></script> -->
<!-- <script src="styles/bootstrap4/popper.js"></script> -->
<!-- <script src="styles/bootstrap4/bootstrap.min.js"></script> -->
<script src="plugins/greensock/TweenMax.min.js"></script>
<script src="plugins/greensock/TimelineMax.min.js"></script>
<script src="plugins/scrollmagic/ScrollMagic.min.js"></script>
<script src="plugins/greensock/animation.gsap.min.js"></script>
<script src="plugins/greensock/ScrollToPlugin.min.js"></script>
<script src="plugins/progressbar/progressbar.min.js"></script>
<!-- <script src="plugins/easing/easing.js"></script> -->
<!-- <script src="plugins/parallax-js-master/parallax.min.js"></script> -->
<script src="js/elements.js"></script>
<script src="js/services.js"></script>

<script>
document.addEventListener('contextmenu', function(event) {
    event.preventDefault(); // Nonaktifkan klik kanan
});

document.addEventListener('keydown', function(event) {
    if (event.ctrlKey && (event.key === 'c' || event.key === 'u' || event.key === 'a' || event.key === 's' || event.key === 'x')) {
        event.preventDefault(); // Nonaktifkan Ctrl+C, Ctrl+U, Ctrl+A, Ctrl+S, Ctrl+X
    }
});

document.addEventListener('selectstart', function(event) {
    event.preventDefault(); // Nonaktifkan pemilihan teks
});

document.addEventListener('dragstart', function(event) {
    event.preventDefault(); // Nonaktifkan drag gambar/teks
});
</script>

</body>
</html>