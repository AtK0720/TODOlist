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


//ユーザーIDチェック  
  if($user_name==''){
    print 'ユーザーIDが入力されていません<br>';
  }else{
    print 'ユーザーID：';
    print $user_name;
    print '<br>';
  }
//パスワードチェック

if($user_pass==''){
  print 'パスワードが入力されていません<br>';
}

if($user_pass!=$user_pass2){
  print 'パスワードが一致しません <br>';
}

if($user_name==''||$user_pass==''||$user_pass!==$user_pass2){
  print '<form>';
  print '<input type="button" onclick="history.back()" value="戻る">';
  print '</form>';
  }else
  {
      $user_pass=md5($user_pass);
      print '<form action="user_add_done.php" method="post">';
      print '<input type="hidden" name="name" value="'.$user_name.'">';
      print '<input type="hidden" name="pass" value="'.$user_pass.'">';
      print'以上のユーザーIDで登録します。よろしいですか？';
      print '<br>';
      print '<input type="button" onclick="history.back()" value="戻る">';
      print '<input type="submit" value="OK">';
      print '</form>';
  }




?>


</body>
</html>