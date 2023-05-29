<?php
include('../../../koneksi.php');
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM pengawasdosen WHERE nip = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        // Jika penghapusan berhasil, redirect kembali ke halaman sebelumnya
        header('Location: laporan_dsn.php');
        exit;
    } else {
        // Jika terjadi error saat menghapus, tampilkan pesan error
        echo "Gagal menghapus data.";
    }
} else {
    // Jika ID tidak tersedia, tampilkan pesan error
    echo "ID tidak tersedia.";
}
