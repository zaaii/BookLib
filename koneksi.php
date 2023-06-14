
<?php
//Koneksi database prosedural mysqli
$koneksi = mysqli_connect('10.0.0.17', 'booklib', 'Berbagiituindah123!', 'perpustakaan', 3306);

//Memeriksa koneksi
if(!$koneksi){
    echo 'Connection error: '. mysqli_connect_error();
}
?>