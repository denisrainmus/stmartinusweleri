<?php
include 'koneksi.php';

// Cek apakah pengguna memasukkan kata kunci
if (!isset($_GET['q']) || empty($_GET['q'])) {
    echo "<script>alert('Silakan masukkan kata kunci!'); window.location.href='index.php';</script>";
    exit();
}

$keyword = "%" . mysqli_real_escape_string($konek, $_GET['q']) . "%";

// Mencari berita yang mengandung kata kunci
$sql = $konek->prepare("SELECT kode FROM tbl_blog WHERE judul LIKE ? OR konten LIKE ? ORDER BY tgl_posting DESC");
$sql->bind_param("ss", $keyword, $keyword);
$sql->execute();
$result = $sql->get_result();

// Jika tidak ada hasil
if ($result->num_rows == 0) {
    echo "<script>alert('Berita tidak ditemukan.'); window.location.href='news_gereja.php';</script>";
    exit();
}

// Jika hanya ada 1 hasil, langsung redirect ke `news_detail.php`
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    header("Location: news_detail.php?id=" . base64_encode($row['kode']));
    exit();
}

// Jika ada lebih dari 1 hasil, arahkan ke halaman daftar berita dengan filter keyword
header("Location: news_gereja.php?search=" . urlencode($_GET['q']));
exit();
?>
