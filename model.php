<?php
require("koneksi.php");
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

//fungsi untuk menampilkan data
function getData($tabel)
{
    // Digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;

    $query = "SELECT * FROM $tabel";
    $stmt = oci_parse($koneksi, $query);
    oci_execute($stmt);

    $rows = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $rows[] = $row;
    }

    return $rows;
}


//fungsi untuk menambah data buku
function insertDataBuku($data)
{
    // Digunakan untuk mengacu atau merujuk ke global variable
    global $koneksi;

    // Mengambil data dari tiap elemen dalam form
    $judul_buku = htmlspecialchars($data["judul_buku"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $penerbit = htmlspecialchars($data["penerbit"]);
    $tahun_terbit = htmlspecialchars($data["tahun_terbit"]);
    $gambar_buku = $_FILES["gambar_buku"]["name"];
    $pdf_buku = $_FILES["pdf_buku"]["name"];
    $deskripsi_buku = htmlspecialchars($data["deskripsi_buku"]);
    $category_ids = htmlspecialchars($data["category_ids"]);

    // Upload gambar buku
    $gambar_buku_tmp = $_FILES["gambar_buku"]["tmp_name"];
    move_uploaded_file($gambar_buku_tmp, "resources/cover/" . $gambar_buku);
    chmod('resources/cover/' . $gambar_buku, 0644);

    // Upload PDF buku
    $pdf_buku_tmp = $_FILES["pdf_buku"]["tmp_name"];
    move_uploaded_file($pdf_buku_tmp, "resources/ebook/" . $pdf_buku);
    chmod('resources/ebook/' . $pdf_buku, 0644);

    $query = "INSERT INTO buku SET 
            judul_buku = :judul_buku,
            penulis = :penulis,
            penerbit = :penerbit,
            tahun_terbit = :tahun_terbit,
            gambar_buku = :gambar_buku,
            pdf_buku = :pdf_buku,
            deskripsi_buku = :deskripsi_buku,
            category_ids = :category_ids
        WHERE id_buku = :id_buku";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ':judul_buku', $judul_buku);
    oci_bind_by_name($stmt, ':penulis', $penulis);
    oci_bind_by_name($stmt, ':penerbit', $penerbit);
    oci_bind_by_name($stmt, ':tahun_terbit', $tahun_terbit);
    oci_bind_by_name($stmt, ':gambar_buku', $new_cover_name);
    oci_bind_by_name($stmt, ':pdf_buku', $pdf_buku);
    oci_bind_by_name($stmt, ':deskripsi_buku', $deskripsi_buku);
    oci_bind_by_name($stmt, ':category_ids', $category_ids);
    oci_bind_by_name($stmt, ':id_buku', $id_buku);
    oci_execute($stmt);
    oci_execute($stmt);

    return oci_num_rows($stmt);
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
    $category_ids = htmlspecialchars($data["category_ids"]);

    // Cek apakah ada file gambar_buku yang diunggah
    if (isset($_FILES["gambar_buku"]["tmp_name"]) && !empty($_FILES["gambar_buku"]["tmp_name"])) {
        $gambar_buku = $_FILES["gambar_buku"]["name"];
        $gambar_buku_tmp = $_FILES["gambar_buku"]["tmp_name"];
        move_uploaded_file($gambar_buku_tmp, "resources/cover/" . $gambar_buku);
        chmod('resources/cover/' . $gambar_buku, 0777);
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
        chmod('resources/ebook/' . $pdf_buku, 0777);
    } else {
        // Jika tidak ada perubahan, tetap gunakan pdf_buku sebelumnya
        $bukuSebelumnya = getData("buku WHERE id_buku = $id_buku")[0];
        $pdf_buku = $bukuSebelumnya["pdf_buku"];
    }

    // Query update data
    $query = "UPDATE buku SET 
                judul_buku = :judul_buku,
                penulis = :penulis,
                penerbit = :penerbit,
                tahun_terbit = :tahun_terbit,
                gambar_buku = :gambar_buku,
                pdf_buku = :pdf_buku,
                deskripsi_buku = :deskripsi_buku,
                category_ids = :category_ids
            WHERE id_buku = :id_buku";

    $stmt = oci_parse($koneksi, $query);

    oci_bind_by_name($stmt, ':judul_buku', $judul_buku);
    oci_bind_by_name($stmt, ':penulis', $penulis);
    oci_bind_by_name($stmt, ':penerbit', $penerbit);
    oci_bind_by_name($stmt, ':tahun_terbit', $tahun_terbit);
    oci_bind_by_name($stmt, ':gambar_buku', $gambar_buku);
    oci_bind_by_name($stmt, ':pdf_buku', $pdf_buku);
    oci_bind_by_name($stmt, ':deskripsi_buku', $deskripsi_buku);
    oci_bind_by_name($stmt, ':category_ids', $category_ids);
    oci_bind_by_name($stmt, ':id_buku', $id_buku);

    oci_execute($stmt);

    $rowsAffected = oci_num_rows($stmt);

    oci_free_statement($stmt);

    return $rowsAffected;
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
    $sql = "DELETE FROM buku WHERE id_buku = :id_buku";

    // Prepare the statement
    $stmt = oci_parse($koneksi, $sql);

    // Bind the parameter
    oci_bind_by_name($stmt, ":id_buku", $id_buku);

    // Execute the statement
    oci_execute($stmt);

    // Get the number of affected rows
    $numRows = oci_num_rows($stmt);

    // Free the statement
    oci_free_statement($stmt);

    // Return the number of affected rows
    return $numRows;
}

/* 
    Fungsi Pencarian
*/

function getDataCari($query)
{
    global $koneksi;
    $stmt = oci_parse($koneksi, $query);
    oci_execute($stmt);

    $rows = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $rows[] = $row;
    }
    oci_free_statement($stmt);

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
    // Prepare the statement for OCI
    $stmt = oci_parse($koneksi, "SELECT * FROM favorit WHERE id_user = :id_user");
    oci_bind_by_name($stmt, ":id_user", $id_user);
    oci_execute($stmt);

    $rows = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $rows[] = $row;
    }
    oci_free_statement($stmt);

    return $rows;
}

function isFavorite($id_user, $id_buku)
{
    global $koneksi;

    // Prepare the statement for OCI
    $stmt = oci_parse($koneksi, "SELECT * FROM favorit WHERE id_user = :id_user AND id_buku = :id_buku");

    // Bind the parameters
    oci_bind_by_name($stmt, ":id_user", $id_user);
    oci_bind_by_name($stmt, ":id_buku", $id_buku);
    oci_execute($stmt);

    // Check if any rows are returned
    $numRows = oci_fetch_all($stmt, $rows);

    // Free the statement
    oci_free_statement($stmt);

    return $numRows > 0;
}

function removeFavorite($id_user, $id_buku)
{
    global $koneksi;

    // Prepare the statement for OCI
    $stmt = oci_parse($koneksi, "DELETE FROM favorit WHERE id_user = :id_user AND id_buku = :id_buku");
    oci_bind_by_name($stmt, ":id_user", $id_user);
    oci_bind_by_name($stmt, ":id_buku", $id_buku);
    oci_execute($stmt);

    // Free the statement
    oci_free_statement($stmt);
}

function addFavorite($id_user, $id_buku)
{
    global $koneksi;

    // Prepare the statement for OCI
    $stmt = oci_parse($koneksi, "INSERT INTO favorit VALUES ('', :id_user, :id_buku)");
    oci_bind_by_name($stmt, ":id_user", $id_user);
    oci_bind_by_name($stmt, ":id_buku", $id_buku);

    // Execute the statement
    oci_execute($stmt);

    // Free the statement
    oci_free_statement($stmt);
}

// recommended books
function recommendation()
{
    global $koneksi;

    // Prepare the statement for OCI
    $stmt = oci_parse($koneksi, "SELECT * FROM (SELECT * FROM buku ORDER BY DBMS_RANDOM.RANDOM) WHERE ROWNUM <= 5");
    oci_execute($stmt);

    $rows = [];
    while ($row = oci_fetch_assoc($stmt)) {
        $rows[] = $row;
    }

    // Free the statement
    oci_free_statement($stmt);

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
    $password =  $data["password"];
    $date_created = date("Y-m-d");

    // Enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    $id_user = rand(1111, 9999);
    $query = "INSERT INTO users (id_user, full_name, email, password, role, date_created) VALUES(:id_user, :full_name, :email, :password, 'member', TO_DATE(:date_created, 'YYYY-MM-DD'))";

    // Prepare the statement for OCI
    $stmt = oci_parse($koneksi, $query);

    // Bind the parameters
    oci_bind_by_name($stmt, ":id_user", $id_user);
    oci_bind_by_name($stmt, ":full_name", $full_name);
    oci_bind_by_name($stmt, ":email", $email);
    oci_bind_by_name($stmt, ":password", $password);
    oci_bind_by_name($stmt, ":date_created", $date_created);
    oci_execute($stmt);

    $numRows = oci_num_rows($stmt);

    // Free the statement
    oci_free_statement($stmt);

    return $numRows;
}


function isEmailExist($email)
{
    global $koneksi;

    // Prepare the statement for OCI
    $stmt = oci_parse($koneksi, "SELECT * FROM users WHERE email = :email");
    oci_bind_by_name($stmt, ":email", $email);
    oci_execute($stmt);

    $numRows = oci_fetch_all($stmt, $rows);
    oci_free_statement($stmt);

    return $numRows > 0;
}

// Fungsi Login

function login($data)
{
    global $koneksi;

    $email = $data["email"];
    $password = $data["password"];

    // Cek apakah email ada di database
    $stmt = oci_parse($koneksi, "SELECT * FROM users WHERE email = :email");
    oci_bind_by_name($stmt, ":email", $email);
    oci_execute($stmt);

    // Fetch the row
    $row = oci_fetch_assoc($stmt);

    if ($row !== false) {
        // Cek password
        if (password_verify($password, $row["PASSWORD"])) {
            // Set session
            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $row["ID_USER"];
            $_SESSION["full_name"] = $row["FULL_NAME"];
            $_SESSION["email"] = $row["EMAIL"];
            $_SESSION["password"] = $row["PASSWORD"];
            $_SESSION["gender"] = $row["GENDER"];
            $_SESSION["birth_date"] = $row["BIRTH_DATE"];
            $_SESSION["user_photo"] = $row["USER_PHOTO"];
            $_SESSION["role"] = $row["ROLE"];

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

// Fungsi Delete User
function deleteUser($id)
{
    global $koneksi;

    // Hapus foto profil user
    $query2 = "SELECT user_photo FROM users WHERE id_user = :id";
    $stmt2 = oci_parse($koneksi, $query2);
    oci_bind_by_name($stmt2, ":id", $id);
    oci_execute($stmt2);

    if (($row = oci_fetch_assoc($stmt2)) !== false) {
        $foto = $row['USER_PHOTO'];

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

    $query = "DELETE FROM users WHERE id_user = :id";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":id", $id);
    $result = oci_execute($stmt);

    return $result;
}


// Fungsi Check apakah User yang adap ada sesion masih ada di database
function isSessionStillAlive($session)
{
    // Check if the necessary session variables exist
    if (isset($session['id_user']) && isset($session['email'])) {
        // Mengambil Informasi Dari Session Aktif
        $id = $session['id_user'];
        $email = $session['email'];

        // Mengatur koneksi ke database Oracle
        global $koneksi;

        // Mengambil Informasi user dari database
        $query = "SELECT * FROM users WHERE id_user = :id AND email = :email";
        $stmt = oci_parse($koneksi, $query);
        oci_bind_by_name($stmt, ':id', $id);
        oci_bind_by_name($stmt, ':email', $email);
        oci_execute($stmt);

        $result = oci_fetch_assoc($stmt);

        if ($id == $result['ID_USER'] && $email == $result['EMAIL']) {
            return true;
        }
    }

    return false;
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
                full_name = :full_name,
                email = :email,
                gender = :gender,
                user_photo = :user_photo,
                birth_date = :birth_date
            WHERE id_user = :id_user";

    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":full_name", $full_name);
    oci_bind_by_name($stmt, ":email", $email);
    oci_bind_by_name($stmt, ":gender", $gender);
    oci_bind_by_name($stmt, ":user_photo", $user_photo);
    oci_bind_by_name($stmt, ":birth_date", $birth_date);
    oci_bind_by_name($stmt, ":id_user", $id_user);

    oci_execute($stmt);

    return oci_num_rows($stmt);
}

//change password
function changePassword($data)
{
    global $koneksi;

    $id_user = $_SESSION["id_user"];
    $password = $_POST["cpass"];
    $new_password = $_POST["npass"];

    // Cek password
    $query = "SELECT * FROM users WHERE id_user = '$id_user'";
    $stmt = oci_parse($koneksi, $query);
    oci_execute($stmt);
    $row = oci_fetch_assoc($stmt);
    if (!password_verify($password, $row["PASSWORD"])) {
        $messagePass = "Password lama salah!";
        return false;
    }

    // Enkripsi password
    $new_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Query update data
    $query = "UPDATE users SET password = :new_password WHERE id_user = :id_user";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":new_password", $new_password);
    oci_bind_by_name($stmt, ":id_user", $id_user);
    oci_execute($stmt);

    return oci_num_rows($stmt);
}

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
    $unique_id = rand(1, 99);
    // Mengambil data dari tiap elemen dalam form
    $category_name = htmlspecialchars($data["category_name"]);
    $category_description = htmlspecialchars($data["category_description"]);
    // Query insert data
    $query = "INSERT INTO categories 
    VALUES 
    ('$unique_id', '$category_name', '$category_description')
    ";
    $stmt = oci_parse($koneksi, $query);
    oci_execute($stmt);

    return oci_num_rows($stmt);
}

function deleteDataCategory($id_category)
{
    global $koneksi;

    // Query delete data
    $query = "DELETE FROM categories WHERE id_category = :id_category";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":id_category", $id_category);
    oci_execute($stmt);

    return oci_num_rows($stmt);
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
    $query = "UPDATE categories SET category_name = :category_name, category_description = :category_description WHERE id_category = :id_category";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":category_name", $category_name);
    oci_bind_by_name($stmt, ":category_description", $category_description);
    oci_bind_by_name($stmt, ":id_category", $id_category);
    oci_execute($stmt);

    return oci_num_rows($stmt);
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
    $result = oci_parse($koneksi, "SELECT id_user FROM users WHERE email = :email");
    oci_bind_by_name($result, ":email", $email);
    oci_execute($result);
    $row = oci_fetch_assoc($result);

    if (oci_num_rows($result) === 1) {
        $id_user = $row["ID_USER"];
        $token = uniqid();
        $rand = rand(1, 99);
        $expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $query = "INSERT INTO forgot_password (rand, id_user, token, expiration) VALUES (:rand, :id_user, :token, TO_DATE(:expiration, 'YYYY-MM-DD HH24:MI:SS'))";
        $stmt = oci_parse($koneksi, $query);
        oci_bind_by_name($stmt, ":rand", $rand);
        oci_bind_by_name($stmt, ":id_user", $id_user);
        oci_bind_by_name($stmt, ":token", $token);
        oci_bind_by_name($stmt, ":expiration", $expiration);
        oci_execute($stmt);

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
            $mailer->Subject = 'Reset Password';
            $mailer->Body = "Klik link berikut untuk reset password anda: http://129.158.212.115/BookLib/reset-password.php?token=$token";

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

    $result = oci_parse($koneksi, "SELECT * FROM forgot_password WHERE token = :token");
    oci_bind_by_name($result, ":token", $token);
    oci_execute($result);
    $row = oci_fetch_assoc($result);

    if (oci_num_rows($result) === 1) {
        $id_user = $row["id_user"];

        $resultUser = oci_parse($koneksi, "SELECT * FROM users WHERE id_user = :id_user");
        oci_bind_by_name($resultUser, ":id_user", $id_user);
        oci_execute($resultUser);
        $rowUser = oci_fetch_assoc($resultUser);
        $email = $rowUser["email"];
        $npassHash = password_hash($npass, PASSWORD_DEFAULT);

        $query = "UPDATE users SET password = :npassHash WHERE id_user = :id_user";
        $stmt = oci_parse($koneksi, $query);
        oci_bind_by_name($stmt, ":npassHash", $npassHash);
        oci_bind_by_name($stmt, ":id_user", $id_user);
        oci_execute($stmt);

        $query2 = "DELETE FROM forgot_password WHERE token = :token";
        $stmt2 = oci_parse($koneksi, $query2);
        oci_bind_by_name($stmt2, ":token", $token);
        oci_execute($stmt2);

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
    $result = oci_parse($koneksi, "SELECT * FROM forgot_password WHERE token = :token");
    oci_bind_by_name($result, ":token", $token);
    oci_execute($result);
    $row = oci_fetch_assoc($result);

    if (oci_num_rows($result) === 1) {
        $expiration = $row["expiration"];
        if (date('Y-m-d H:i:s') > $expiration) {
            return false;
        }
        return true;
    } else {
        return false;
    }
}

function lastRegister()
{
    global $koneksi;
    $query = "SELECT COUNT(*) as count FROM users";
    $result = oci_parse($koneksi, $query);
    oci_execute($result);
    $lastRecord = oci_fetch_assoc($result)['count'];
    return $lastRecord;
}

function loginSession($userId)
{
    global $koneksi;

    // Get the current login time
    $loginTime = date('Y-m-d H:i:s');

    // Insert the login session into the sessions table
    $query = "INSERT INTO sessions (user_id, login_time) VALUES (:userId, TO_DATE(:loginTime, 'YYYY-MM-DD HH24:MI:SS'))";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":userId", $userId);
    oci_bind_by_name($stmt, ":loginTime", $loginTime);
    oci_execute($stmt);

    // Get the session ID of the inserted row
    $sessionId = oci_fetch_assoc($stmt)['session_id'];

    // Return the session ID
    return $sessionId;
}


function logoutSession($sessionId)
{
    global $koneksi;

    // Get the current logout time
    $logoutTime = date('Y-m-d H:i:s');

    // Update the logout time in the sessions table
    $query = "UPDATE sessions SET logout_time = TO_DATE(:logoutTime, 'YYYY-MM-DD HH24:MI:SS') WHERE session_id = :sessionId";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":logoutTime", $logoutTime);
    oci_bind_by_name($stmt, ":sessionId", $sessionId);
    oci_execute($stmt);
}

function getSessionCount($timeRange)
{
    global $koneksi;
    $query = "SELECT COUNT(*) as count FROM sessions WHERE login_time >= TO_DATE(:timeRange, 'YYYY-MM-DD HH24:MI:SS')";
    $stmt = oci_parse($koneksi, $query);
    oci_bind_by_name($stmt, ":timeRange", $timeRange);
    oci_execute($stmt);
    $count = oci_fetch_assoc($stmt)['COUNT'];
    return $count;
}

function formatCount($count, $percentage)
{
    $formattedCount = number_format($count);
    $formattedPercentage = number_format($percentage, 2) . '%';
    $arrowIcon = $percentage >= 0 ? 'ri-arrow-up-s-fill' : 'ri-arrow-down-s-fill';
    $textClass = $percentage >= 0 ? 'text-success' : 'text-danger';

    return "<div class='mb-1 text-black'>$formattedCount<span class='$textClass'><i class='$arrowIcon'></i>$formattedPercentage</span></div>";
}
