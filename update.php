<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>更新画面</title>
  <?php

  require_once('common.php');
  $post = sanitize($_POST);
  $dbh = db_connect();


  $sql = 'SELECT * FROM todo_item WHERE ID=?';
  $stmt = $dbh->prepare($sql);
  $stmt->execute([$_POST['ID2']]);
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);

  $ID = $rec['ID'];
  $todo_name = $rec['NAME'];
  $todo_user = $rec['USER'];
  $expire_date = $rec['EXPIRE_DATE'];


  //担当者取得

  $sql2 = 'SELECT ID,NAME FROM todo_user';
  $stmt2 = $dbh->prepare($sql2);
  $stmt2->execute();

$count =$stmt2->rowCount();

  for($j=0;$j<$count;$j++){
  $rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);
  $user_id[]=$rec2['ID'];
  $user_name[]=$rec2['NAME'];
}

    ?>

  </head>

  <body>
    <h1>作業更新</h1>

    <form action="todo_update_change.php" method="post">
    <input type="hidden" name="ID222" value="<?php print $post["ID2"]?>">

      <h2>作業更新</h2>
      <span>項目名</span>
      <textarea type="text" name="name"><?php print $todo_name ?></textarea>
      <br>
      <span>担当者</span>

      <select name="user">
      <?php
      //for文でぶん回して担当者を取得
      for($i=0;$i<$count;$i++){

      print "<option value=".$user_id[$i].">$user_name[$i]</option>";
    }
      
      ?>
      </select>
      <br>
      <span>期限</span>

      <?php
      echo "<select name=\"yyyy\">";
      for ($i = 2015; $i < 2025; $i++) {
        echo "<option>" . $i;
      }
      echo "</select> 年　";

      echo "<select name=\"mm\">";
      for ($i = 1; $i < 13; $i++) {
        echo "<option>" . $i;
      }
      echo "</select> 月　";

      echo "<select name=\"dd\">";
      for ($i = 1; $i < 32; $i++) {
        echo "<option>" . $i;
      }
      echo "</select> 日　";

      ?>
      <br>
      <span>完了</span>
<input type="checkbox" name="isFinish">　完了した
      <br>
      <button type="submit" 　name="submit">更新</button>
      
    </form>
  </body>

  </html>