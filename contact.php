<?php include 'header.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/contact.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
    <title>Contact Sekretariat Gereja</title>
    <style>
    
    /* Section: Home Background */
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
    
    /* Contact Section */
    .contact {
        padding: 60px 0;
        background-color: #f8f9fa;
    }
    
    /* Contact Info List */
    .contact_about_list {
        list-style: none;
        padding: 0;
    }
    
    .contact_about_list li {
        display: flex;
        align-items: center;
        gap: 15px; /* Beri jarak antara ikon dan teks */
        margin-bottom: 15px;
        font-size: 16px;
        font-weight: bold;
    }
    
    /* Ukuran ikon dibuat seragam */
    .contact_about_icon {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 40px; /* Ukuran seragam */
        height: 40px;
        background: #800000;
        border-radius: 50%; /* Membuat ikon berbentuk lingkaran */
        text-align: center;
        flex-shrink: 0; /* Hindari penyusutan ikon */
    }
    
    /* Ukuran gambar dalam ikon agar sesuai */
    .contact_about_icon img {
        width: 20px;
        height: 20px;
        object-fit: contain;
    }
    
    /* Efek hover pada ikon */
    .contact_about_icon:hover {
        background: #660000;
        transition: 0.3s;
    }
    
    .contact_about_list li span {
        color: #333;
    }
    
    /* Form Section */
    .form {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .form h3 {
        font-size: 22px;
        font-weight: bold;
        color: #800000;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .form-group {
        margin-bottom: 15px;
    }
    
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
        transition: 0.3s;
    }
    
    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #800000;
        outline: none;
        box-shadow: 0 0 8px rgba(128, 0, 0, 0.3);
    }
    
    /* Tombol Kirim Pesan */
    .btn-primary {
        background: #800000;
        color: white;
        border: none;
        padding: 12px;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
        transition: 0.3s;
        border-radius: 5px;
    }
    
    .btn-primary:hover {
        background: #660000;
    }
    
    /* Google Map */
    .contact_map {
        margin-top: 30px;
    }
    
    .google_map iframe {
        width: 100%;
        height: 450px;
        border-radius: 10px;
    }
    
    /* Responsiveness */
    @media (max-width: 768px) {
        .form {
            padding: 20px;
        }
    
        .contact_about_list li {
            font-size: 14px;
        }
    
        .btn-primary {
            font-size: 14px;
            padding: 10px;
        }
    }

    </style>
</head>

<!-- Section: Home -->
<div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php echo $background_image; ?>" data-speed="0.8"></div>
    <div class="home_container">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home_content">
                        <div class="home_title"><span>Contact</span> / Lokasi</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Section: Contact -->
<div class="contact">
    <div class="container">
        <div class="row">
            <!-- Contact Info -->
            <div class="col-lg-6">
                <div class="section_title"><h2>GEREJA SANTO MARTINUS WELERI</h2></div>
                <ul class="contact_about_list">
                    <li><div class="contact_about_icon"><img src="images/phone-call.svg" alt=""></div><span>(0294) 641046</span></li>
                    <li><div class="contact_about_icon"><img src="images/envelope.svg" alt=""></div><span>komsos.stmartinus@gmail.com</span></li>
                    <li><div class="contact_about_icon"><img src="images/placeholder.svg" alt=""></div><span>Jl. Raya Utama Tengah No.119, Nawangsari I, Nawangsari, Kec. Weleri, Kabupaten Kendal, Jawa Tengah 51355</span></li>
                </ul>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6 form_col">
                <section id="contact" class="wow fadeInUp">
                    <div class="container">
                        <div class="form">
                            <h3>KONSULTASI / PESAN</h3>
                            <form method="POST">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="txtnama" class="form-control" placeholder="Nama Lengkap" required maxlength="100">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="email" class="form-control" name="txtemail" placeholder="Email" required maxlength="100">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="txthandphone" placeholder="HandPhone" required maxlength="15" pattern="[0-9]+" title="Gunakan hanya angka">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="txtpesan" rows="5" placeholder="Pesan Anda" required maxlength="500"></textarea>
                                </div>
                                <input type="submit" name="btnsimpan" class="btn btn-primary" value="Kirim Pesan">
                            </form>

                            <?php
                            include 'koneksi.php';

                            if (isset($_POST["btnsimpan"])) {
                                // Sanitasi & Validasi Input
                                $txtnama = htmlspecialchars(strip_tags($_POST['txtnama']));
                                $txtemail = filter_var($_POST['txtemail'], FILTER_SANITIZE_EMAIL);
                                $txthandphone = preg_replace('/[^0-9]/', '', $_POST['txthandphone']); // Hanya angka
                                $txtpesan = htmlspecialchars(strip_tags($_POST['txtpesan']));
                                $tglreg = date("Y-m-d H:i:s");
                                $keterangan = 0; // Default 0 (belum dibaca oleh admin)
                            
                                // Validasi Email
                                if (!filter_var($txtemail, FILTER_VALIDATE_EMAIL)) {
                                    echo "<script>alert('Format email tidak valid!');</script>";
                                    exit();
                                }
                            
                                // Menggunakan Prepared Statements untuk keamanan SQL Injection
                                $stmt = $konek->prepare("INSERT INTO tbl_pesan (nama, hp, email, pesan, tanggal, keterangan) VALUES (?, ?, ?, ?, ?, ?)");
                                $stmt->bind_param("sssssi", $txtnama, $txthandphone, $txtemail, $txtpesan, $tglreg, $keterangan);
                            
                                if ($stmt->execute()) {
                                    echo "<script>alert('Pesan berhasil dikirim! Kami akan segera menghubungi Anda.'); window.location.href='contact.php';</script>";
                                } else {
                                    echo "<script>alert('Gagal menyimpan pesan. Silakan coba lagi.');</script>";
                                }
                            
                                $stmt->close();
                                $konek->close();
                            }
                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Contact Map -->
        <div class="row map_row">
            <div class="col">
                <div class="contact_map">
                    <div class="map">
                        <div id="google_map" class="google_map">
                            <div class="map_container">
                                <div id="map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.3074985185726!2d110.07031797574007!3d-6.973001768280269!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7042156dccaa2b%3A0xc57d606394e899c9!2sGereja%20Katolik%20St.%20Martinus%2C%20Weleri!5e0!3m2!1sen!2sid!4v1728970777853!5m2!1sen!2sid" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
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
