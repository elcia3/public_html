<?php
define(HOST, "localhost");
define(USER, "shizu");
define(PW, "shizu");
define(DB, "cs1");

$connect = mysqli_connect(HOST,USER,PW) or die('Could not connect to mysql server.' );
mysqli_select_db($connect,DB) or die('Could not select database.');
mysqli_set_charset($connect, "utf8");

$term = strip_tags(substr($_POST['search_term'],0, 100));
$term = mysqli_real_escape_string($connect,$term);

$sql = "SELECT member_name FROM members where member_name like '%$term%' order by member_name asc";
$result = mysqli_query($connect,$sql);

if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    $string[] = $row['member_name'];
  }
}

$words = array();
foreach($string as $word){
  if(mb_stripos($word, $term) !== FALSE){
    $words[] = $word;
  }
}

header("Content-Type: application/json; charset=utf-8");
echo json_encode($words);

