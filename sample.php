<?php

require_once("functions.php");

$errors = array();

if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $memo = $_POST['memo'];

  $name = htmlspecialchars($name, ENT_QUOTES);
  $memo = htmlspecialchars($memo, ENT_QUOTES);

  if ($name === '') {
    $errors['name'] = 'お名前が入力されていません。';
  }

  if ($memo === '') {
    $errors['memo'] = 'メモが入力されていません。';
  }


  if (count($errors) === 0) {

    $dbh=db_connect();

    $sql = 'INSERT INTO tasks (name, memo, done) VALUES (?, ?, 0)';
    $stmt = $dbh->prepare($sql);


    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $memo, PDO::PARAM_STR);

    $stmt->execute();

    $dbh = null;

    unset($name, $memo);
  }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>TODOリスト</title>
</head>

<body>
  <h1>TODOリスト</h1>
  <?php
  if (isset($errors)) {
    print("<ul>");
    foreach ($errors as $value) {
      print("<li>");
      print($value);
      print("</li>");
    }
    print("</ul>");
  }
  ?>
  <form action="sample.php" method="post">
    <ul>
      <li><span>タスク名</span><input type="text" name="name" value="<?php if (isset($name)) {
                                                                    print($name);
                                                                  } ?>"></li>
      <li><span>メモ</span><textarea name="memo"><?php if (isset($memo)) {
                                                  print($memo);
                                                } ?></textarea></li>
      <li><input type="submit" name="submit"></li>
    </ul>
  </form>
<?php  
 
 $dbh=db_connect();

 $sql ='SELECT id,name,memo,done FROM tasks ORDER BY id DESC';
 $stmt = $dbh->prepare($sql);
 $stmt->execute();
 $dbh=null;

 print('<dl>');

 while($task =$stmt->fetch(PDO::FETCH_ASSOC)){
   print "<dt>";
   print $task["name"];
   echo "</dt>";

   print "<dd>";
   print $task["memo"];
   print "</dd>";

 }

 print('</dl>');



?>


</body>

</html>