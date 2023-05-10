<?php
include "koneksi.php";

session_start();
error_reporting(0);
if (!isset($_SESSION['email'])) {
    header("Location: auth/login.php");
    exit;
} else {
    header("Location: dashboard.php");
    exit;
}
?>