<?php


//ユーザーIDを参照させて、担当者の項目にほうりこむ
//valueにIDを入れて、optionの部分にユーザーIDの名前を表示する

?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>作業登録</title>


</head>
<body>
  <h1>作業登録</h1>
  
<form action="todo_register_change.php" method="post">

  <h2>作業登録</h2>
    <span>項目名</span>
    <textarea type="text" name="name" ></textarea>
    <br>
    <span>担当者</span>
    <select name="user">
      <option value="str2">ここにPHPで担当者を入れる</option></select>
  <br>
    <span>期限</span>
    
    <?php
echo "<select name=\"yyyy\">";
for ($i = 2015; $i < 2025; $i++) {
    echo "<option>".$i;
}
echo "</select> 年　";

echo "<select name=\"mm\">";
for ($i = 1; $i < 13; $i++) {
    echo "<option>".$i;
}
echo "</select> 月　";

echo "<select name=\"dd\">";
for ($i = 1; $i < 32; $i++) {
    echo "<option>".$i;
}
echo "</select> 日　";

?>
<br>
<button type="submit"　name="submit">登録</button>
<button type="button" onclick="history.back()">戻る</button>
</form>
</body>
</html>