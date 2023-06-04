<?php
// putenv("LD_LIBRARY_PATH=/usr/lib/oracle/19.10/client64/lib");
// putenv("ORACLE_HOME=/usr/lib/oracle/19.10/client64");
// putenv("PATH=$PATH:/usr/lib/oracle/19.10/client64/bin");
// putenv("TNS_ADMIN=/usr/lib/oracle/19.10/client64/lib/network/admin");

$username = 'DBUSER';
$password = 'Berbagiituindah1';

$connectionString = "booklibdb1_high";

$conn = oci_connect($username, $password, $connectionString, 'AL32UTF8');
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$sql = 'SELECT * FROM USERS';
$stmt = oci_parse($conn, $sql);
oci_execute($stmt);

while ($row = oci_fetch_assoc($stmt)) {
    // Process each row of data
    // var_dump($row);
    echo "$row[FULL_NAME]";
    echo "<br>";
    echo "<br>";
}

oci_free_statement($stmt);

$query = 'SELECT * FROM TESTING';
$result = oci_parse($conn, $query);
oci_execute($result);

$rows = oci_fetch_all($result, $res);
echo $rows." Rows";
// var_dump($rows);
    echo "<br>";
    echo "<br>";
oci_free_statement($result);
oci_close($conn);
?>

<?php
phpinfo();
?>