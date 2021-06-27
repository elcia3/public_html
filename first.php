<?php

//database settings
$dsn = 'mysql:host=localhost; dbname=cs1; charset=utf8';
$user = 'shizu';
$password = 'shizu';

//connection check
try{
    $dbh = new PDO($dsn, $user, $password);
} catch(PDOException $e) {
    print($e->getTraceAsString());
    echo 'can not connect database. error:' . $e->getMessage();
    exit;
}


//post from form.php
$id =  $_POST['id'];

define('maxview', 10);

//store sql
$sql = "SELECT * from zipShizuoka where CONCAT(zip,kana1,kana2,kana3,addr1,addr2,addr3) like '%$id%'";

//store sql result
$stmt = $dbh->query($sql);

//display result
foreach($stmt as $row){
    echo $row['zip'];
    echo $row['addr1'];
    echo $row['addr2'];
    echo $row['addr3'];
    echo '<br>';
}


?>


<html>

</html>
    