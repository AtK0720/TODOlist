<?php 

require_once('common.php');
  $post=sanitize($_POST);
  if(isset($post)==true){
    $todoID=$post['ID'];

  }

$dbh=db_connect();

$sql="DELETE FROM todo_item WHERE ID=?";
$stmt=$dbh->prepare($sql);

$stmt->execute([$post['ID']]);

$dbh=null;

header("Location:todo_list.php");

?>