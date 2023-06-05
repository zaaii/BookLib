<?php
// put environment yang diperlukan buat server
// Kalo buat windows bisa di comment aja
// putenv("LD_LIBRARY_PATH=/usr/lib/oracle/19.10/client64/lib");
// putenv("ORACLE_HOME=/usr/lib/oracle/19.10/client64");
// putenv("PATH=$PATH:/usr/lib/oracle/19.10/client64/bin");
// putenv("TNS_ADMIN=/usr/lib/oracle/19.10/client64/lib/network/admin");

$username = 'DBUSER';
$password = 'Berbagiituindah1';

$connectionString = "booklibdb1_high";

$koneksi = oci_connect($username, $password, $connectionString, 'AL32UTF8');
if (!$koneksi) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>