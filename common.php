<?php 
function sanitize($before){
  foreach($before as $key =>$value){
    $after[$key] = htmlspecialchars($value,ENT_QUOTES,'UTF-8');
  }
  return $after;
}

function db_connect(){
  $dsn ='mysql:dbname=todo;host=localhost;charset=utf8';
  $user='root';
  $password ='';

  $dbh =new PDO($dsn,$user,$password);

  $dbh->query('SET NAMES utf8');
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
  return $dbh;
}

