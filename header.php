<?php include'koneksi.php';
// Ambil satu background secara acak dari database
$qry = mysqli_query($konek, "SELECT nama_background FROM background ORDER BY RAND() LIMIT 1");
$data = mysqli_fetch_assoc($qry);
$background_image = isset($data['nama_background']) ? $data['nama_background'] : 'img/backgrounds/default.jpg';
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta name="google-site-verification" content="vIPcgP1v3ywRxXc98mnuVrpvJUGpiZHm1yuni-E2cXU">    
<meta charset="utf-8">
<link href="santomartinus.gif" rel="icon">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Santo Martinus Weleri">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<style>
/* Perbaikan menu mobile agar bisa di-scroll */
.menu_inner.menu_mm {
    max-height: 80vh;
    overflow-y: auto;
    touch-action: pan-y;
}

/* Menu Mobile: Geser dari kanan dan warna lebih terang */
.menu_container.menu_mm {
    position: fixed;
    top: 0;
    right: -100%;
    width: 75%;
    height: 100vh;
    background: #f8f9fa;
    transition: right 0.3s ease-in-out;
    box-shadow: -5px 0 10px rgba(0, 0, 0, 0.2);
    z-index: 9999;
    padding-top: 20px;
}

/* Saat menu dibuka */
.menu_container.menu_mm.active {
    right: 0;
}

/* Tombol Close Menu */
.menu_close_container {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 24px;
    cursor: pointer;
    color: #333;
}

/* Memastikan ikon close terlihat jelas */
.menu_close_container i {
    font-size: 28px;
    color: #800000; /* Warna merah agar terlihat jelas */
}

/* Tampilan daftar menu agar vertikal */
.menu_list.menu_mm {
    list-style: none;
    padding: 0;
    margin: 0;
}

/* Item menu agar tersusun ke bawah */
.menu_list.menu_mm li {
    display: block;
    padding: 12px 20px;
    border-bottom: 1px solid #ddd;
}

/* Link menu agar rapi */
.menu_list.menu_mm li a {
    display: block;
    color: #333;
    font-weight: bold;
    font-size: 16px;
    text-decoration: none;
}

/* Efek hover */
.menu_list.menu_mm li a:hover {
    color: #007bff;
}

/* Perbaikan tampilan "Lapor Komsos" */
.menu_extra {
    background: #800000;
    color: white;
    text-align: center;
    font-weight: bold;
    font-size: 16px;
    padding: 15px;
    position: absolute;
    bottom: 0;
    width: 100%;
}
/* Styling untuk search box di header */
.search-container {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 10px auto;
}

.search-container input {
    padding: 8px;
    width: 250px;
    border: 1px solid #ddd;
    border-radius: 4px;
    outline: none;
}

.search-container button {
    padding: 8px;
    border: none;
    background: #800000;
    color: white;
    cursor: pointer;
    border-radius: 4px;
}

.search-container button:hover {
    background: #660000;
}
</style>

</head>
<body>

<div class="super_container">
    
    <!-- Header -->
    <header class="header trans_200">
        
        <!-- Top Bar -->
        <div class="top_bar">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="top_bar_content d-flex flex-row align-items-center justify-content-start">
                            <div class="top_bar_item"><a href="contact.php">Alamat:</a></div>
                            <div class="top_bar_item"><a href="contact.php">Jl. Raya Utama Tengah No.119, Nawangsari I, Kec. Weleri 51355</a></div>
                            <div class="search-container">
                                <form action="search.php" method="GET">
                                    <input type="text" name="q" placeholder="Cari Berita..." required>
                                    <button type="submit"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Header Content -->
        <div class="header_container">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header_content d-flex flex-row align-items-center justify-content-start">
                            <nav class="main_nav ml-auto">
                                <ul>
                                    <li><a href="index.php">BERANDA</a></li>
                                    <li><a href="tentang.php">PROFIL</a></li>
                                    <li><a href="warta.php">WARTA</a></li>
                                    <li><a href="misa.php">JADWAL MISA</a></li>
                                    <li><a href="media.php">GALERI</a></li>
                                    <li><a href="persembahan.php">PERSEMBAHAN</a></li>
                                    <li><a href="contact.php">KONTAK</a></li>
                                </ul>
                            </nav>
                            <!-- Tombol Hamburger -->
                            <button class="navbar-toggler hamburger ml-auto" type="button">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- Logo -->
		<div class="logo_container_outer">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="logo_container">
							<a href="index.php">
								<div class="logo_content d-flex flex-column align-items-start justify-content-center">
									<div class="logo_line"></div>
									<div class="logo d-flex flex-row align-items-center justify-content-center">
										<div class="logo_text"> Santo Martinus<span> Weleri</span></div>
										<img src="images/cross.svg" alt="Cross Icon" width="40" height="50">
									</div>
									<div class="logo_sub">KOMSOS GEREJA</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>	
		</div>
    </header>

    <!-- Menu Mobile -->
    <div class="menu_container menu_mm">
    
        <div class="search-container">
            <form action="search.php" method="GET">
                <input type="text" name="q" placeholder="Cari Berita..." required>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>
    
        <!-- Menu Items -->
        <div class="menu_inner menu_mm">
            <ul class="menu_list menu_mm">
                <li class="menu_item menu_mm"><a href="index.php"><i class="fa fa-home"></i> BERANDA</a></li>
                <li class="menu_item menu_mm"><a href="tentang.php"><i class="fa fa-church"></i> PROFIL</a></li>
                <li class="menu_item menu_mm"><a href="warta.php"><i class="fa fa-newspaper"></i> WARTA</a></li>
                <li class="menu_item menu_mm"><a href="misa.php"><i class="fa fa-calendar-alt"></i> JADWAL MISA</a></li>
                <li class="menu_item menu_mm"><a href="media.php"><i class="fa fa-images"></i> GALERI</a></li>
                <li class="menu_item menu_mm"><a href="persembahan.php"><i class="fa fa-hand-holding-heart"></i> PERSEMBAHAN</a></li>
                <li class="menu_item menu_mm"><a href="contact.php"><i class="fa fa-envelope"></i> KONTAK</a></li>
            </ul>
        </div>
    
        <!-- "Lapor Komsos" agar tetap terlihat -->
        <div class="menu_extra">
            <a href="tel:(0294)641046" class="text-light">Lapor Komsos ST. Martinus : (0294) 641046</a>
        </div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const menu = document.querySelector('.menu_container.menu_mm');
    const menuToggle = document.querySelector('.hamburger');
    const menuClose = document.querySelector('.menu_close_container');
    const searchInput = document.querySelector('.menu_container.menu_mm .search-container input');

    // Fungsi untuk membuka menu
    menuToggle.addEventListener('click', function () {
        menu.classList.add('active');
    });

    // Fungsi untuk menutup menu (jika tombol close diklik)
    if (menuClose) {
        menuClose.addEventListener('click', function () {
            menu.classList.remove('active');
        });
    }

    // Cegah menu tertutup saat mengetik dalam input pencarian
    searchInput.addEventListener('focus', function (event) {
        event.stopPropagation(); // Menghentikan event global
    });

    // Cegah menu tertutup jika klik di dalam menu
    menu.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    // Tutup menu hanya jika klik di luar menu (kecuali input pencarian)
    document.addEventListener('click', function (event) {
        if (!menu.contains(event.target) && event.target !== menuToggle) {
            menu.classList.remove('active');
        }
    });
});
</script>



</body>
</html>
