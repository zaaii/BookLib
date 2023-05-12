<?php
// Memanggil fungsi deleteDataBuku yang telah dibuat sebelumnya
require_once 'model.php';

// Memeriksa apakah ID buku yang akan dihapus ada dalam parameter URL
if (isset($_GET['id_buku'])) {
    $id_buku = $_GET['id_buku'];

    // Memanggil fungsi deleteDataBuku untuk menghapus data buku berdasarkan ID
    $result = deleteDataBuku($id_buku);

    if ($result) {
        // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman daftar buku
        echo "
        <script>
        alert('Successfully deleted book');
        document.location.href = 'admin-books.php';
        </script>
        ";
    } else {
        // Jika terjadi kesalahan dalam penghapusan, tampilkan pesan kesalahan atau lakukan penanganan sesuai kebutuhan
        echo 'Failed to delete book.';
    }
} else {
    // Jika ID buku tidak ditemukan dalam parameter URL, tampilkan pesan atau lakukan penanganan sesuai kebutuhan
    echo 'Book ID not found.';
}
?>
