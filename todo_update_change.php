<?php

require_once("common.php");
$post = sanitize($_POST);

//各値の取り出し
if (isset($post) == true) {
  $name = $post['name']; //TODO名
  $user = $post['user']; //ユーザー
  $year = $post['yyyy']; //年//
  $month = $post['mm']; //月
  $day = $post['dd'];
  $todoID=$post['ID222'];
}

//日付の合成

if ($month < 10) {
  $month = "0" . $month;
}
if ($day < 10) {
  $day = "0" . $day;
}

$expire_date = $year . "-" . $month . "-" . $day;

if($name==''){
  print 'タスク名を入力してください';
  print '<a href="todo_register.php">登録画面に戻る</a>';
}

else{
//データベース接続・更新

try {
  $dbh = db_connect();

  $sql = 'UPDATE todo_item SET NAME=?,USER=?,EXPIRE_DATE=?,FINISHED_DATE=? WHERE ID=?';
  $stmt = $dbh->prepare($sql);

  //データを放り込む
  $stmt->bindValue(1, $name, PDO::PARAM_STR);
  $stmt->bindValue(2, $user, PDO::PARAM_STR);
  $stmt->bindValue(3, $expire_date, PDO::PARAM_STR);
  $stmt->bindValue(4, "0000-00-00", PDO::PARAM_STR);
  $stmt->bindValue(5,$todoID,PDO::PARAM_STR);
  $stmt->execute();
  $dbh = null;

  unset($name, $user, $expire_date);

} catch (Exception $e) { }

//なんらかの方法で飛ばしたい
header('Location: todo_list.php');
exit();

}
