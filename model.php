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

/* 
    Fungsi Pencarian
*/

function getDataCari($query)
{
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function cariDataBuku($keyword)
{
    // Query cari data
    $query = "SELECT * FROM buku WHERE
                judul_buku LIKE '%$keyword%' OR
                penulis LIKE '%$keyword%' OR
                penerbit LIKE '%$keyword%' OR
                tahun_terbit LIKE '%$keyword%'
            ";
    return getDataCari($query);
}

/*
    Fungsi Menambahkan buku ke favorit
*/

function getFavorit($id_user) {
    global $koneksi;
    $query = "SELECT * FROM favorit WHERE id_user = $id_user";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function isFavorite($id_user, $id_buku) {
    global $koneksi;
    $query = "SELECT * FROM favorit WHERE id_user = $id_user AND id_buku = $id_buku";
    $result = mysqli_query($koneksi, $query);
    return mysqli_num_rows($result) > 0;
}

function removeFavorite($id_user, $id_buku) {
    global $koneksi;
    $query = "DELETE FROM favorit WHERE id_user = $id_user AND id_buku = $id_buku";
    $result = mysqli_query($koneksi, $query);
}

function addFavorite($id_user, $id_buku) {
    global $koneksi;
    // Perform the necessary database operations to add the book to favorites for the given user
    $query = "INSERT INTO favorit VALUES ('', '$id_user', '$id_buku')";
    $result = mysqli_query($koneksi, $query);
}

/*
    Fungsi Auth
*/

// Fungsi Register

function register($data)
{
    global $koneksi;

    $id_user = uniqid();
    $full_name = htmlspecialchars($data["full_name"]);
    $email = htmlspecialchars($data["email"]);
    $password = mysqli_real_escape_string($koneksi, $data["password"]);

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan user baru ke database
    $query = "INSERT INTO users VALUES('$id_user', '$full_name', '$email', '$password', '', '', '', 'member')";
    $result = mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

// Fungsi Login

function login($data)
{
    global $koneksi;

    $email = $data["email"];
    $password = $data["password"];

    // Cek apakah email ada di database
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");

    if (mysqli_num_rows($result) === 1) {
        // Cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            // Set session
            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $row["id_user"];
            $_SESSION["full_name"] = $row["full_name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["password"] = $row["password"];
            $_SESSION["gender"] = $row["gender"];
            $_SESSION["birth_date"] = $row["birth_date"];
            $_SESSION["user_photo"] = $row["user_photo"];
            $_SESSION["role"] = $row["role"];

            // Cek apakah remember me dicentang
            if (isset($data["remember"])) {
                // Buat cookie
                setcookie("id_user", $row["id_user"], time() + 60);
                setcookie("key", hash("sha256", $row["email"]), time() + 60);
            }

            return true;
        }
    }

    return false;
}

// Fungsi Logout

function logout()
{
    // Hapus session
    $_SESSION = [];
    session_destroy();

    // Hapus cookie
    setcookie("id_user", "", time() - 60);
    setcookie("key", "", time() - 60);

    header("Location: index.php");
    exit;
}

// Fungsi Delete User
function deleteUser($id){
    global $koneksi;

    // Query Delete User
    $query = "DELETE FROM users WHERE id_user = $id";
    $result = mysqli_query($koneksi, $query);

    return $result;
}

// Fungsi Check apakah User yang adap ada sesion masih ada di database
function isSessionStillAlive($session){

    // Mengambil Informasi Dari Session Aktif
    $id = $session['id_user'];
    $email = $session['email'];

    // Mengambil Informasi user dari database
    global $koneksi;
    $query = "SELECT * FROM users WHERE id_user = '$id' AND email = '$email'";
    $result = mysqli_query($koneksi, $query);
    $result = mysqli_fetch_assoc($result);

    if($id == $result['id_user'] && $email == $result['email']) {
        return true;
    } else {
        return false;
    }
}


/* 
    Fungsi Edit Profil
*/

function editProfil($data)
{
    global $koneksi;

    $id_user = $_SESSION["id_user"];
    $full_name = htmlspecialchars($data["full_name"]);
    $email = htmlspecialchars($data["email"]);
    $gender = isset($data["gender"]) ? $data["gender"] : "";
    $user_photo = isset($_FILES["user_photo"]["name"]) ? $_FILES["user_photo"]["name"] : "";
    $birth_date = htmlspecialchars($data["birth_date"]);

    if (!empty($user_photo)) {
        $target_dir = "resources/profile/"; // Directory where you want to store the uploaded photos
        $target_file = $target_dir . basename($_FILES["user_photo"]["name"]);
        move_uploaded_file($_FILES["user_photo"]["tmp_name"], $target_file);
    }

    // Query update data
    $query = "UPDATE users SET 
                full_name = '$full_name',
                email = '$email',
                gender = '$gender',
                user_photo = '$user_photo',
                birth_date = '$birth_date'
            WHERE id_user = $id_user";
    
    mysqli_query($koneksi, $query);
    return mysqli_affected_rows($koneksi);
}