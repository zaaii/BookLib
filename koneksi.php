<?php
//Koneksi database prosedural mysqli
$koneksi = mysqli_connect('localhost', 'root', '', 'webook');

//Memeriksa koneksi
if(!$koneksi){
    echo 'Connection error: '. mysqli_connect_error();
}
?>