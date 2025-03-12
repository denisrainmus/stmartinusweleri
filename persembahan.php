<?php include 'header.php'; ?>
<head>
    <link rel="stylesheet" type="text/css" href="styles/contact.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
    <title>Laporan Dana Persembahan</title>
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

        /* Tabel Responsif */
        .table-responsive {
            overflow-x: auto;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table th, .table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .table thead {
            background-color: #800000;
            color: white;
        }
        
        .table tbody tr:hover {
            background-color: #f5f5f5;
        }
        
        .table tbody tr:last-child {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        
        /* Teks tengah */
        .text-center {
            text-align: center;
        }
        
        /* Warna total persembahan */
        .total-persembahan {
            font-weight: bold;
            background-color: #ffd700;
        }
        /* Jarak antara home dan laporan */
        .home {
            margin-bottom: 50px; /* Beri jarak antara home dan laporan */
        }
        
        /* Pastikan home tidak menutupi elemen di bawahnya */
        .home_container {
            padding-bottom: 30px; /* Tambahkan padding bawah */
        }
        
        /* Tambahkan padding atas pada section laporan */
        .laporan {
            padding-top: 60px; /* Beri jarak agar tidak bertabrakan dengan home */
            padding-bottom: 60px; /* Jarak bawah */
            background-color: #f8f9fa; /* Warna latar belakang agar rapi */
        }
        
        /* Pastikan laporan tidak menabrak bagian atas */
        #laporan {
            margin-top: 60px; /* Jarak antara home dan laporan */
            overflow: auto; /* Hindari overlap */
        }
        
        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .laporan {
                padding-top: 40px;
                padding-bottom: 40px;
            }
            .home {
                margin-bottom: 30px;
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
                        <div class="home_title"><span>Dana</span> Persembahan</div>
                        <div class="breadcrumbs">
                            <ul>
                                <li><a href="index.php">Beranda</a></li>
                                <li>Persembahan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="laporan" class="wow fadeInUp">
    <div class="laporan">
        <div class="container">
            <div class="section-header">
                <h3>Data Persembahan</h3>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Misa</th>
                            <th>Kategori Kolekte</th>
                            <th>Total Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'koneksi.php';

                        // Query untuk mengambil total nominal berdasarkan Nama Misa dan Kategori
                        $query = "SELECT nama_misa, kategori, SUM(nominal) as total_nominal 
                                  FROM tbl_persembahan 
                                  GROUP BY nama_misa, kategori 
                                  ORDER BY nama_misa ASC";
                        $result = mysqli_query($konek, $query);

                        $total_persembahan_semua = 0; // Variabel untuk menghitung total keseluruhan

                        if (mysqli_num_rows($result) > 0) {
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $total_persembahan_semua += $row['total_nominal']; // Akumulasi total semua persembahan
                                echo "<tr>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_misa']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['kategori']) . "</td>";
                                echo "<td>Rp. " . number_format($row['total_nominal'], 0, ',', '.') . "</td>";
                                echo "</tr>";
                                $no++;
                            }

                            // Menampilkan total keseluruhan persembahan di bagian bawah tabel
                            echo "<tr class='total-persembahan'>";
                            echo "<td colspan='3' class='text-center'>Total Persembahan Semua</td>";
                            echo "<td>Rp. " . number_format($total_persembahan_semua, 0, ',', '.') . "</td>";
                            echo "</tr>";

                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Belum ada data persembahan.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>
<script>
  $(document).ready(function(){
      $('.parallax-window').parallax({imageSrc: $('.parallax-window').data('image-src')});
  });
</script>
<?php include 'footer.php'; ?>

<?php mysqli_close($konek); ?>