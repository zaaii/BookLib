<?php
require("koneksi.php");
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

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

function insertDataBuku($data)
{
    // Digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;

    // Mengambil data dari tiap elemen dalam form
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $deskripsi_buku = htmlspecialchars($data["deskripsi_buku"]);
    $category_ids = is_array($data["category_ids"]) ? implode(',', $data["category_ids"]) : '';

    // Cek apakah ada file gambar_buku yang diunggah
    if (isset($_FILES["gambar_buku"]["tmp_name"]) && !empty($_FILES["gambar_buku"]["tmp_name"])) {
        $gambar_buku = $_FILES["gambar_buku"]["name"];
        $gambar_buku_tmp = $_FILES["gambar_buku"]["tmp_name"];
        move_uploaded_file($gambar_buku_tmp, "resources/cover/" . $gambar_buku);
    } else {
        $gambar_buku = '';
    }

    // Cek apakah ada file pdf_buku yang diunggah
    if (isset($_FILES["pdf_buku"]["tmp_name"]) && !empty($_FILES["pdf_buku"]["tmp_name"])) {
        $pdf_buku = $_FILES["pdf_buku"]["name"];
        $pdf_buku_tmp = $_FILES["pdf_buku"]["tmp_name"];
        move_uploaded_file($pdf_buku_tmp, "resources/ebook/" . $pdf_buku);
    } else {
        $pdf_buku = '';
    }

    // Query insert data
    $query = "INSERT INTO buku 
    VALUES 
    ('', '$judul_buku', '$penulis', '$penerbit', '$tahun_terbit', '$gambar_buku', '$pdf_buku', '$deskripsi_buku', '$category_ids')
    ";
    mysqli_query($koneksi, $query);

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
    $category_ids = is_array($data["category_ids"]) ? implode(',', $data["category_ids"]) : '';


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
                deskripsi_buku = '$deskripsi_buku',
                category_ids = '$category_ids'
            WHERE id_buku = $id_buku";

    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}


function deleteDataBuku($id_buku)
{
    //digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;
    //delete cover book from folder
    $bukuSebelumnya = getData("buku WHERE id_buku = $id_buku")[0];
    $gambar_buku = $bukuSebelumnya["gambar_buku"];
    unlink("resources/cover/" . $gambar_buku);
    //delete pdf book from folder
    $pdf_buku = $bukuSebelumnya["pdf_buku"];
    unlink("resources/ebook/" . $pdf_buku);
    mysqli_query($koneksi, "DELETE FROM buku WHERE id_buku = $id_buku");
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

function getFavorit($id_user)
{
    global $koneksi;
    $query = "SELECT * FROM favorit WHERE id_user = $id_user";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function isFavorite($id_user, $id_buku)
{
    global $koneksi;
    $query = "SELECT * FROM favorit WHERE id_user = $id_user AND id_buku = $id_buku";
    $result = mysqli_query($koneksi, $query);
    return mysqli_num_rows($result) > 0;
}

function removeFavorite($id_user, $id_buku)
{
    global $koneksi;
    $query = "DELETE FROM favorit WHERE id_user = $id_user AND id_buku = $id_buku";
    $result = mysqli_query($koneksi, $query);
}

function addFavorite($id_user, $id_buku)
{
    global $koneksi;
    // Perform the necessary database operations to add the book to favorites for the given user
    $query = "INSERT INTO favorit VALUES ('', '$id_user', '$id_buku')";
    $result = mysqli_query($koneksi, $query);
}

// recommended books
function recommendation()
{
    global $koneksi;
    $query = "SELECT * FROM buku ORDER BY RAND() LIMIT 5";
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

/*
    Fungsi Auth
*/

// Fungsi Register

function register($data)
{
    global $koneksi;

    $full_name = htmlspecialchars($data["full_name"]);
    $email = htmlspecialchars($data["email"]);
    $password = mysqli_real_escape_string($koneksi, $data["password"]);
    $date_created = date("Y-m-d");

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $id_user = rand(1111, 9999);

    // Tambahkan user baru ke database
    $query = "INSERT INTO users (id_user, full_name, email, password, role, date_created) VALUES('$id_user', '$full_name', '$email', '$password', 'member', '$date_created')";
    $result = mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function isEmailExist($email)
{
    global $koneksi;
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);
    return mysqli_num_rows($result) > 0;
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
function deleteUser($id)
{
    global $koneksi;

    // Hapus foto profil user
    $query2 = "SELECT user_photo FROM users WHERE id_user = $id";
    $results = mysqli_query($koneksi, $query2);
    if ($results && mysqli_num_rows($results) > 0) {
        $resultz = mysqli_fetch_assoc($results);
        $foto = $resultz['user_photo'];

        // Check if the photo exists before unlinking
        if (!empty($foto) && file_exists("resources/profile/$foto")) {
            if (is_dir("resources/profile/$foto")) {
                // Remove the directory and its contents
                $files = glob("resources/profile/$foto/*");
                foreach ($files as $file) {
                    unlink($file);
                }
                rmdir("resources/profile/$foto");
            } else {
                // Unlink the file
                unlink("resources/profile/$foto");
            }
        }
    }
    $query = "DELETE FROM users WHERE id_user = $id";
    $result = mysqli_query($koneksi, $query);

    return $result;
}

// Fungsi Check apakah User yang adap ada sesion masih ada di database
function isSessionStillAlive($session)
{

    // Mengambil Informasi Dari Session Aktif
    $id = $session['id_user'];
    $email = $session['email'];

    // Mengambil Informasi user dari database
    global $koneksi;
    $query = "SELECT * FROM users WHERE id_user = '$id' AND email = '$email'";
    $result = mysqli_query($koneksi, $query);
    $result = mysqli_fetch_assoc($result);

    if ($id == $result['id_user'] && $email == $result['email']) {
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

//change password
function changePassword($data)
{
    global $koneksi;

    $id_user = $_SESSION["id_user"];
    $password = mysqli_real_escape_string($koneksi, $data["cpass"]);
    $new_password = mysqli_real_escape_string($koneksi, $data["npass"]);

    // Cek password
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
    $row = mysqli_fetch_assoc($result);
    if (!password_verify($password, $row["password"])) {
        $messagePass = "Password lama salah!";
        return false;
    }

    // Enkripsi password
    $new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Query update data
    $query = "UPDATE users SET password = '$new_password' WHERE id_user = $id_user";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

/* 
    Fungsi Pencarian
*/

/*

/*
    Fungsi Auth
*/

/* 
    Fungsi Edit Profil
*/

function getPageName()
{
    // Mendapatkan nama file halaman saat ini dari URL
    $currentPage = basename($_SERVER['PHP_SELF']);

    // Mengganti ekstensi file dengan string kosong
    $pageName = str_replace('.php', '', $currentPage);

    // Mengganti tanda underscore (_) dengan spasi
    $pageName = str_replace('-', ' ', $pageName);

    // Mengembalikan nama halaman yang sudah diubah
    return ucfirst($pageName);
}

function insertDataCategory($data)
{
    // Digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;

    // Mengambil data dari tiap elemen dalam form
    $category_name = htmlspecialchars($data["category_name"]);
    $category_description = htmlspecialchars($data["category_description"]);

    $id_category = uniqid(1, 99);
    // Query insert data
    $query = "INSERT INTO categories 
    VALUES 
    ('$id_category', '$category_name', '$category_description')
    ";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function deleteDataCategory($id_category)
{
    global $koneksi;

    // Query delete data
    mysqli_query($koneksi, "DELETE FROM categories WHERE id_category = '$id_category'");
    return mysqli_affected_rows($koneksi);
}

function updateDataCategory($data)
{
    // Digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;

    // Mengambil data dari tiap elemen dalam form
    $id_category = $data["id_category"];
    $category_name = htmlspecialchars($data["category_name"]);
    $category_description = htmlspecialchars($data["category_description"]);

    // Query update data
    $query = "UPDATE categories SET category_name = '$category_name', category_description = '$category_description' WHERE id_category = '$id_category'";
    mysqli_query($koneksi, $query);

    return mysqli_affected_rows($koneksi);
}

function checkRole($session)
{
    $role = $session['role'];
    if ($role != 'admin') {
        return header("Location:index.php");
    }
    return true;
}

function forgetPassword($data)
{
    global $koneksi;

    $email = $data["email"];
    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) === 1) {
        $id_user = $row["id_user"];
        $token = uniqid();
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $query = "INSERT INTO forgot_password VALUES ('', '$id_user', '$token', '$expiration')";
        mysqli_query($koneksi, $query);

        $mailer = new PHPMailer(true);

        try {
            // SMTP configuration for Gmail
            $smtpHost = 'smtp.porkbun.com';
            $smtpPort = 587;
            $smtpUsername = 'admin@booklib.app'; // Your Gmail email address
            $smtpPassword = 'adminbooklib'; // Your Gmail password

            // Set up SMTP configuration
            $mailer->isSMTP();
            $mailer->Host = $smtpHost;
            $mailer->Port = $smtpPort;
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = 'ssl';
            $mailer->Username = $smtpUsername;
            $mailer->Password = $smtpPassword;

            // Set up email content
            $mailer->setFrom($smtpUsername, 'BookLib System');
            $mailer->addAddress($email);
            $mailer->Subject = 'Reset Password';
            $mailer->Body = "Klik link berikut untuk reset password anda: https://booklib.app/reset-password.php?token=$token";

            // Send email
            $mailer->send();

            return true;
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $mailer->ErrorInfo;
            return false;
        }
    }
}

function newPassword($npass, $npass2)
{
    global $koneksi;

    $token = $_GET["token"];
    if ($npass != $npass2) {
        return false;
    }

    $result = mysqli_query($koneksi, "SELECT * FROM forgot_password WHERE token = '$token'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) === 1) {
        $id_user = $row["user_id"];
        $resultUser = mysqli_query($koneksi, "SELECT * FROM users WHERE id_user = '$id_user'");
        $rowUser = mysqli_fetch_assoc($resultUser);
        $email = $rowUser["email"];
        $npassHash = password_hash($npass, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = '$npassHash' WHERE id_user = '$id_user'";
        mysqli_query($koneksi, $query);
        $query2 = "DELETE FROM forgot_password WHERE token = '$token'";
        mysqli_query($koneksi, $query2);

        $mailer = new PHPMailer(true);

        try {
            // SMTP configuration for Gmail
            $smtpHost = 'smtp.gmail.com';
            $smtpPort = 587;
            $smtpUsername = 'systembooklib@gmail.com'; // Your Gmail email address
            $smtpPassword = 'papnbsocmetxmpon'; // Your Gmail password

            // Set up SMTP configuration
            $mailer->isSMTP();
            $mailer->Host = $smtpHost;
            $mailer->Port = $smtpPort;
            $mailer->SMTPAuth = true;
            $mailer->SMTPSecure = 'tls';
            $mailer->Username = $smtpUsername;
            $mailer->Password = $smtpPassword;

            // Set up email content
            $mailer->setFrom($smtpUsername, 'BookLib System');
            $mailer->addAddress($email);
            $mailer->Subject = 'Reset Password BERHASIL!';
            $mailer->Body = "Password anda telah direset. Jika anda tidak merasa melakukan reset password, segera hubungi admin.";

            // Send email
            $mailer->send();

            return true;
        } catch (Exception $e) {

            return false;
        }
    } else {
        return false;
    }
}

function checkToken($token)
{
    global $koneksi;

    $token = $_GET["token"];
    $result = mysqli_query($koneksi, "SELECT * FROM forgot_password WHERE token = '$token'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) === 1) {
        $expiration = $row["expiration"];
        if (date('Y-m-d H:i:s') > $expiration) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

//count last register user in users table
function lastRegister()
{
    global $koneksi;
    $query = "SELECT COUNT(*) as count FROM users";
    $result = mysqli_query($koneksi, $query);
    $lastRecord = mysqli_fetch_assoc($result)['count'];
    return $lastRecord;
}

function loginSession($userId)
{
    global $koneksi;

    // Get the current login time
    $loginTime = date('Y-m-d H:i:s');

    // Insert the login session into the sessions table
    $query = "INSERT INTO sessions (user_id, login_time) VALUES ('$userId', '$loginTime')";
    mysqli_query($koneksi, $query);

    // Get the session ID of the inserted row
    $sessionId = mysqli_insert_id($koneksi);

    // Return the session ID
    return $sessionId;
}

function logoutSession($sessionId)
{
    global $koneksi;

    // Get the current logout time
    $logoutTime = date('Y-m-d H:i:s');

    // Update the logout time in the sessions table
    $query = "UPDATE sessions SET logout_time = '$logoutTime' WHERE session_id = '$sessionId'";
    mysqli_query($koneksi, $query);
}

function getSessionCount($timeRange)
{
    global $koneksi;
    $query = "SELECT COUNT(*) as count FROM sessions WHERE login_time >= '$timeRange'";
    $result = mysqli_query($koneksi, $query);
    $count = mysqli_fetch_assoc($result)['count'];
    return $count;
}

// Function to format the count and percentage values
function formatCount($count, $percentage)
{
    $formattedCount = number_format($count);
    $formattedPercentage = number_format($percentage, 2) . '%';
    $arrowIcon = $percentage >= 0 ? 'ri-arrow-up-s-fill' : 'ri-arrow-down-s-fill';
    $textClass = $percentage >= 0 ? 'text-success' : 'text-danger';

    return "<div class='mb-1 text-black'>$formattedCount<span class='$textClass'><i class='$arrowIcon'></i>$formattedPercentage</span></div>";
}