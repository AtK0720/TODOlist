<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <?php

  require_once("common.php");

  $post = sanitize($_POST);

  //各値の取り出し
  if (isset($post) == true) {
    $user_name = $post['name']; //TODO名
    $user_pass = $post['pass']; //ユーザー

  }
  //データベース接続・更新

  try {
    $dbh = db_connect();
    //ユーザー名の登録

  

    $sql = 'INSERT INTO todo_user(NAME,PASSWORD) VALUES(?,?)';
    $stmt = $dbh->prepare($sql);


    //データを放り込む
    $stmt->bindValue(1, $user_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $user_pass, PDO::PARAM_STR);

    $stmt->execute();

    //ユーザーIDの取得

    $sql = "SELECT ID,NAME FROM todo_user WHERE NAME='$user_name'";
    $res = $dbh->prepare($sql);
    $res->execute();

    foreach ($res as $result) {
      $user_id = $result['ID'];
      print 'ユーザーID :' . $user_id.'<Br>';
    }

    $dbh = null;


    print 'ユーザー名:　' . $user_name . 'で登録しました<br>';
    print '<a href="user_login.html">ログイン画面に進む</a>';



    unset($user_name, $user_pass);
  
  } catch (Exception $e) {
    print 'サーバーがおかしい';
  }


  ?>


</head>

<body>



</body>

</html>