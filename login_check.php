<?php  session_start();
try {


  $user_code = $_POST['ID'];
  $user_pass = $_POST['password'];

  $user_code = htmlspecialchars($user_code, ENT_QUOTES, 'UTF-8');
  $user_pass = htmlspecialchars($user_pass, ENT_QUOTES, 'UTF-8');

  $user_pass = md5($user_pass);

  $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
  $user = 'root';
  $password = '';

  $dbh = new PDO($dsn, $user, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT * FROM todo_user WHERE ID = ?';
  $stmt = $dbh->prepare($sql);
  $stmt->execute([$_POST['ID']]);
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);


  //iDがDBに存在しているか確認
  if (!isset($rec['ID'])) {
    echo 'IDかパスワードが間違っています。';
    return false;
  }



  //パスワード確認後、sessionにIDを渡す
  if (password_verify($_POST['password'],$rec['PASSWORD'])) {
    session_regenerate_id(true); //session_idを新しく生成し置き換える
    $_SESSION['ID'] = $rec['ID'];
    $_SESSION['NAME']=$rec['NAME'];
    header("Location: todo_list.php");
    
  } else {
    echo 'メールアドレスorパスワードが間違っています';
    return false;
  }
} catch (Exception $e) {
  print 'ただいま生涯により大変ご迷惑をおかけしています';
  exit();
}
