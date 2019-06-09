<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php
  require_once('common.php');

  $post=sanitize($_POST);
  $user_name=$post['name'];
  $user_pass=$post['password'];
  $user_pass2=$post['password2'];
  $error='';


//ユーザーIDチェック  
  if($user_name==''){
    print 'ユーザー名が入力されていません<br>';
  }else{
    print 'ユーザー名：';
    print $user_name;
    print '<br>';
  }

  try{  $dbh = db_connect();

    //ID重複チェック
    $sql='SELECT * FROM todo_user';
    $stmt=$dbh->prepare($sql);
    $stmt->execute();

        while ($item = $stmt->fetch()) {
          if ($item['NAME'] == $user_name) {
            $error = '<p class="error">ご希望のユーザー名は既に使用されています。</p>';
            print $error.'<br>';
            $dbh =null;
            
          } 
}
        }
      catch (Exception $e) {
        print 'サーバーがおかしい';}



//パスワードチェック



if($user_pass==''){
  print 'パスワードが入力されていません<br>';
}

if($user_pass!==$user_pass2){
  print 'パスワードが一致しません <br>';
}


if(!$error==''){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
}
elseif($user_name==''||$user_pass==''||$user_pass!==$user_pass2){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
  }else
  {
      $user_pass=password_hash($user_pass,PASSWORD_DEFAULT);
      print '<form action="user_add_done.php" method="post">';
      print '<input type="hidden" name="name" value="'.$user_name.'">';
      print '<input type="hidden" name="pass" value="'.$user_pass.'">';
      print'以上のユーザー名で登録します。よろしいですか？';
      print '<br>';
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '<input type="submit" value="OK">';
      print '</form>';
  }




?>


</body>
</html>