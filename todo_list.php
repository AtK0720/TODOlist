<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['user_login']) == false) {
  print 'ようこそゲスト様<br>';
  print '<a href="user_login.html">会員ログイン</a><br>';
  print '<br>';
} else {
  print 'ようこそ';
  print $_SESSION['user_name'];
  print '様 ';
  print '<a href="user_logout.php">ログアウト</a><br>';
  print '<br>';
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>






</head>

<body>
  <h1>作業一覧</h1>

  <?php
  try {

    $dsn = 'mysql:dbname=todo;host=localhost;charset=utf8';
    $user = 'root';
    $password = '';
    $dbh  = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



      //データの取り出し
    $sql = 'SELECT ID,NAME,USER,EXPIRE_DATE,FINISHED_DATE FROM todo_item';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    //データのカウント

    $count = $stmt->rowCount();

    //データベース切断
    $dbh = null;

//各値の取得
for($j=0;$j<$count;$j++){
  //NAME
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  $todo_name[]=$rec['NAME'];
  $todo_user[] = $rec['USER'];
  $todo_expire[]=$rec['EXPIRE_DATE'];
  $todo_finish[]=$rec['FINISHED_DATE'];
  //
}






    print 'データの数は' . $count . 'やで<br>';


   }catch(Exception $e){
    print 'なんかサーバーにつながらへんで';
    exit();
  }

  ?>
  <br><br>

  <table border="1">
    <tr>
      <td>項目名</td>
      <td>担当者</td>
      <td>期限</td>
      <td>完了</td>
      <td>操作</td>
    </tr>
    <?php //繰り返しで表にぶち込む

    for ($i = 0; $i < $count; $i++) { ?>
      <tr>
        <td><?php print $todo_name[$i]; ?></td>
        <td><?php print $todo_user[$i]; ?></td>
        <td><?php print $todo_expire[$i]; ?></td>
        <td><?php
        //完了or未完了の判断
        if($todo_finish[$i] == '0000-00-00'){
          print '未完了';
        }else{
          print $todo_finish[$i];
        }
       ?></td>
        <td>
          <form action="finish.php" method="post">
            <input type="hidden" name="max" value="<?php print $count ?>">
          <?php 
          //更新ボタンの出力
        if(isset($todo_name[$i])==true){

          print  '<input type="submit" value="完了" name="<?php print "finish".$i ?>">';
        }
        
        
        
        
        ?>
        </form>
      </td>
      </tr>
    <?php  } ?>

  </table>



</body>

</html>