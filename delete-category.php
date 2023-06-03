<?php
// Memanggil fungsi deleteDataCategory yang telah dibuat sebelumnya
require_once 'model.php';

// Memeriksa apakah ID kategori yang akan dihapus ada dalam parameter URL
if (isset($_GET['id_category'])) {
    $id_category = $_GET['id_category'];

    // Memanggil fungsi deleteDataCategory untuk menghapus data kategori berdasarkan ID
    $result = deleteDataCategory($id_category);

    if ($result) {
        // Jika penghapusan berhasil, arahkan pengguna kembali ke halaman daftar kategori
        echo "
        <script>
        alert('Successfully deleted category');
        document.location.href = 'admin-category.php';
        </script>
        ";
    } else {
        // Jika terjadi kesalahan dalam penghapusan, tampilkan pesan kesalahan atau lakukan penanganan sesuai kebutuhan
        echo 'Failed to delete category.';
    }
} else {
    // Jika ID kategori tidak ditemukan dalam parameter URL, tampilkan pesan atau lakukan penanganan sesuai kebutuhan
    echo 'Category ID not found.';
}
?>