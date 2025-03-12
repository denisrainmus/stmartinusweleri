<?php include 'header.php'; ?>
<head>
  <link rel="stylesheet" type="text/css" href="styles/services.css">
  <link rel="stylesheet" type="text/css" href="styles/services_responsive.css">
  <title>Media Gereja</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
  <style>
    /* Section Styling */
    .media-section {
        padding: 60px 0;
        background-color: #f8f9fa;
        text-align: center;
    }
    .media-section .section_title h2 {
        font-size: 26px;
        font-weight: bold;
        color: #800000;
        margin-bottom: 30px;
        text-transform: uppercase;
    }

    /* Gallery & Video Container */
    .gallery-container, .video-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
    }

    /* Gallery & Video Item */
    .gallery-item, .video-item {
        flex: 0 0 calc(25% - 20px);
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
        text-align: center;
        transition: all 0.3s ease-in-out;
        padding: 15px;
        border: 1px solid #dee2e6;
    }
    .gallery-item img, .video-item iframe {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: transform 0.3s;
        cursor: pointer;
    }
    .gallery-item img:hover {
        transform: scale(1.1);
    }
    .gallery-item h5, .video-item h5 {
        margin: 10px 0;
        font-size: 1rem;
        color: #333;
    }

    /* Filter Buttons */
    .filter-container {
        text-align: center;
        margin-bottom: 20px;
    }
    .filter-container button {
        padding: 10px 20px;
        margin: 5px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
        background-color: #800000;
        color: white;
    }
    .filter-container button:hover, .filter-container button.active {
        background-color: #660000;
    }

    /* Responsiveness */
    @media (max-width: 768px) {
        .gallery-item, .video-item {
            flex: 0 0 calc(50% - 20px);
        }
    }
    @media (max-width: 480px) {
        .gallery-item, .video-item {
            flex: 0 0 calc(100% - 20px);
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
            <div class="home_title"><span>MEDIA</span> GEREJA</div>
            <div class="breadcrumbs">
              <ul>
                <li><a href="index.php">Beranda</a></li>
                <li>Media</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br>
<!-- Filter Section -->
<div class="filter-container">
    <button onclick="filterMedia('all')" class="active">Semua</button>
    <button onclick="filterMedia('gallery')">Galeri</button>
    <button onclick="filterMedia('video')">Video</button>
</div>

<!-- Container untuk Media -->
<div id="gallery-section" class="media-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title"><h2>Galeri Gereja</h2></div>
            </div>
        </div>
        <div class="gallery-container">
            <?php
                include 'koneksi.php';
                $qry = mysqli_query($konek, "SELECT * FROM tbl_folio ORDER BY kode DESC");
                while ($data = mysqli_fetch_assoc($qry)) {
                    $gambar_url = "img/folio/" . $data['gambar'];
                    $formatted_date = date("d-m-Y H:i:s", strtotime($data['tanggal']));
            ?>
            <div class="gallery-item">
                <a href="<?php echo $gambar_url; ?>" data-lightbox="galeri" data-title="<?php echo htmlspecialchars($data['nama']); ?>">
                    <img src="<?php echo $gambar_url; ?>" alt="<?php echo htmlspecialchars($data['nama']); ?>" loading="lazy">
                </a>
                <h5><?php echo htmlspecialchars($data['nama']); ?></h5>
                <p><strong>Tanggal:</strong> <?php echo $formatted_date; ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<div id="video-section" class="media-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section_title"><h2>Video Gereja</h2></div>
            </div>
        </div>
        <div class="video-container">
            <?php
                $qry = mysqli_query($konek, "SELECT * FROM tbl_video ORDER BY kode DESC");
                while ($data = mysqli_fetch_assoc($qry)) {
                    parse_str(parse_url($data['alamat'], PHP_URL_QUERY), $params);
                    $video_id = $params['v'] ?? basename(parse_url($data['alamat'], PHP_URL_PATH));
            ?>
            <div class="video-item">
                <h5><?php echo htmlspecialchars($data['nama']); ?></h5>
                <iframe src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen loading="lazy"></iframe>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
      filterMedia('all'); // Default: Tampilkan Semua
  });

  function filterMedia(type) {
      let gallerySection = document.getElementById("gallery-section");
      let videoSection = document.getElementById("video-section");

      document.querySelectorAll('.filter-container button').forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');

      if (type === "gallery") {
          gallerySection.style.display = "block";
          videoSection.style.display = "none";
      } else if (type === "video") {
          gallerySection.style.display = "none";
          videoSection.style.display = "block";
      } else {
          gallerySection.style.display = "block";
          videoSection.style.display = "block";
      }
  }
</script>

<?php include 'footer.php'; ?>
