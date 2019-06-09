<?php 

  require_once('common.php');
  $dbh = db_connect();


$sql2 = "UPDATE todo_item SET FINISHED_DATE =?";
$stmt2 = $dbh->prepare($sql2);
$stmt2->bindValue(1, 0000-00-00, PDO::PARAM_STR); //FINISHED_DATE
$stmt2->execute();

$dbh = null;








?>