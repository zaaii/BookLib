<?php
require("koneksi.php");

//fungsi untuk menampilkan data
function getData($tabel)
{
    //digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;
    $result = mysqli_query($koneksi, "SELECT * FROM $tabel");
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

//fungsi untuk menambah data buku
function insertDataBuku($data)
{
    //digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;
    //Mengambil data dari tiap elemen dalam form
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $gambar_buku = $_FILES["gambar_buku"]["name"];
    $pdf_buku = $_FILES["pdf_buku"]["name"];
    $deskripsi_buku = htmlspecialchars($data["deskripsi_buku"]);

    // Upload gambar buku
    $gambar_buku_tmp = $_FILES["gambar_buku"]["tmp_name"];
    move_uploaded_file($gambar_buku_tmp, "resources/cover/" . $gambar_buku);

    // Upload PDF buku
    $pdf_buku_tmp = $_FILES["pdf_buku"]["tmp_name"];
    move_uploaded_file($pdf_buku_tmp, "resources/ebook/" . $pdf_buku);

    //query insert data
    $query = "INSERT INTO buku 
    VALUES 
    ('', '$judul_buku', '$penulis', '$penerbit', '$tahun_terbit', '$gambar_buku','$pdf_buku','$deskripsi_buku')
    ";
    $result = mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

//fungsi untuk menghapus data buku
function hapusDataBuku($id_buku)
{
    //digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = $id_buku");
    return mysqli_affected_rows($koneksi);
}

//fungsi untuk mengedit data buku
function updateDataBuku($data)
{
    // Mengambil koneksi ke database
    global $koneksi;

    // Mengambil data dari tiap elemen dalam form
    $id_buku = $data["id_buku"];
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $deskripsi_buku = htmlspecialchars($data["deskripsi_buku"]);

    // Cek apakah ada file gambar_buku yang diunggah
    if (isset($_FILES["gambar_buku"]["tmp_name"]) && !empty($_FILES["gambar_buku"]["tmp_name"])) {
        $gambar_buku = $_FILES["gambar_buku"]["name"];
        $gambar_buku_tmp = $_FILES["gambar_buku"]["tmp_name"];
        move_uploaded_file($gambar_buku_tmp, "resources/cover/" . $gambar_buku);
    } else {
        // Jika tidak ada perubahan, tetap gunakan gambar_buku sebelumnya
        $bukuSebelumnya = getData("buku WHERE id_buku = $id_buku")[0];
        $gambar_buku = $bukuSebelumnya["gambar_buku"];
    }

    // Cek apakah ada file pdf_buku yang diunggah
    if (isset($_FILES["pdf_buku"]["tmp_name"]) && !empty($_FILES["pdf_buku"]["tmp_name"])) {
        $pdf_buku = $_FILES["pdf_buku"]["name"];
        $pdf_buku_tmp = $_FILES["pdf_buku"]["tmp_name"];
        move_uploaded_file($pdf_buku_tmp, "resources/ebook/" . $pdf_buku);
    } else {
        // Jika tidak ada perubahan, tetap gunakan pdf_buku sebelumnya
        $bukuSebelumnya = getData("buku WHERE id_buku = $id_buku")[0];
        $pdf_buku = $bukuSebelumnya["pdf_buku"];
    }

    // Query update data
    $query = "UPDATE buku SET 
                judul_buku = '$judul_buku',
                penulis = '$penulis',
                penerbit = '$penerbit',
                tahun_terbit = '$tahun_terbit',
                gambar_buku = '$gambar_buku',
                pdf_buku = '$pdf_buku',
                deskripsi_buku = '$deskripsi_buku'
            WHERE id_buku = $id_buku";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function deleteDataBuku($id_buku)
{
    // Mengambil koneksi ke database
    global $koneksi;

    // Query delete data
    $query = "DELETE FROM buku WHERE id_buku = $id_buku";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}