<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'koneksi.php';

// Mengatur timezone ke WIB (Asia/Jakarta)
date_default_timezone_set('Asia/Jakarta');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['berita_id']) || empty($_POST['berita_id'])) {
        die("<script>alert('Error: ID berita tidak boleh kosong.'); window.history.back();</script>");
    }

    // Decode berita_id dari Base64
    $berita_id = base64_decode($_POST['berita_id'], true);
    if (!$berita_id || !ctype_digit($berita_id)) {
        die("<script>alert('Error: ID berita tidak valid.'); window.history.back();</script>");
    }
    $berita_id = intval($berita_id);

    $parent_id = isset($_POST['parent_id']) && ctype_digit($_POST['parent_id']) ? intval($_POST['parent_id']) : 0;
    $nama = trim($_POST['nama']);
    $komentar = trim($_POST['komentar']);

    if (empty($nama) || empty($komentar)) {
        die("<script>alert('Error: Semua kolom harus diisi!'); window.history.back();</script>");
    }

    // Cek apakah berita_id ada di database
    $stmt = $konek->prepare("SELECT kode FROM tbl_blog WHERE kode = ?");
    if (!$stmt) {
        die("<script>alert('Error SQL: " . mysqli_error($konek) . "'); window.history.back();</script>");
    }
    $stmt->bind_param("i", $berita_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        die("<script>alert('Error: Berita tidak ditemukan.'); window.history.back();</script>");
    }
    $stmt->close();

    // Mendapatkan waktu saat ini (WIB)
    $tanggal = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

    // Insert komentar dengan status "Belum Disetujui" (keterangan = 0) dan menyimpan waktu komentar
    $query = "INSERT INTO tbl_komentar (berita_id, parent_id, nama, komentar, keterangan, tanggal) VALUES (?, ?, ?, ?, 0, ?)";
    $stmt = $konek->prepare($query);
    
    if (!$stmt) {
        die("<script>alert('Error SQL: " . mysqli_error($konek) . "'); window.history.back();</script>");
    }
    
    $stmt->bind_param("iisss", $berita_id, $parent_id, $nama, $komentar, $tanggal);
    
    if ($stmt->execute()) {
        // Redirect kembali ke halaman berita setelah sukses
        echo "<script>alert('Komentar berhasil dikirim! Akan ditampilkan setelah disetujui oleh admin.'); window.location.href='news_detail.php?id=" . urlencode(base64_encode($berita_id)) . "';</script>";
        exit();
    } else {
        die("<script>alert('Error saat menyimpan komentar: " . mysqli_error($konek) . "'); window.history.back();</script>");
    }

    $stmt->close();
}
?>
