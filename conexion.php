<?php

//$con = new PDO("sqlsrv:server=DESKTOP-IB90627\SQLEXPRESS;database=bd_sistemainventarios","sa","posada1234");

?>
<?php

$serverName = "DESKTOP-IB90627\SQLEXPRESS"; 
$connectionOptions = array(
    "Database" => "entregasdb",
    "Uid" => "sa", 
    "PWD" => "posada1234"  
);


$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
?>
