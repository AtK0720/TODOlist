<?php
session_start();
session_regenerate_id(true);
if (isset($_SESSION['ID']) == false) {
  print 'ログインしてください<br>';
  print '<a href="user_login.html">会員ログイン</a><br>';
  print '<br>';
  exit();
  //エラー画面に飛ばす。
} else {
  print 'ようこそ';
  print $_SESSION['NAME'];
  print 'さん ';
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
  <title>一覧画面</title>






</head>

<body>
  <h1>作業一覧</h1>

  <button onclick="location.href='todo_register.php'">作業登録</button>
  <br>

  <form method="post" action="search.php">
    <input type="text" name="search" id="">
<input type="submit" value="検索">
  </form>




  <?php
  try {
//作業項目の一覧
    require_once('common.php');
    $dbh = db_connect();


    //データの取り出し
    $sql = 'SELECT ID,NAME,USER,EXPIRE_DATE,FINISHED_DATE FROM todo_item';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    //データのカウント

    $count = $stmt->rowCount();

    //データベース切断
    $dbh = null;

    //各値の取得
    for ($j = 0; $j < $count; $j++) {
      //NAME
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      $todo_id[] = $rec['ID'];
      $todo_name[] = $rec['NAME'];
      $todo_user[] = $rec['USER'];
      $todo_expire[] = $rec['EXPIRE_DATE'];
      $todo_finish[] = $rec['FINISHED_DATE'];
      //
    }


    print 'データの数は' . $count . 'やで<br>';
  } catch (Exception $e) {
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
        <td><?php
            //担当者IDと名前の照合

            $dbh = db_connect();
            $sql2 = "SELECT NAME FROM todo_user WHERE ID=?";
            $stmt2 = $dbh->prepare($sql2);
            $stmt2->execute([$todo_user[$i]]);
            $rec = $stmt2->fetch(PDO::FETCH_ASSOC);

            $user_name = $rec['NAME'];

            print $user_name; ?></td>
        <td><?php print $todo_expire[$i]; ?></td>
        <td><?php
            //完了or未完了の判断
            if ($todo_finish[$i] == '0000-00-00') {
              print '未完了';
            } else {
              print $todo_finish[$i];
            }
            ?></td>
        <td>
          <form method="post">
            <input type="hidden" name="ID" value="<?php print $todo_id[$i] ?>">
            <?php
            //更新ボタンの出力
            if (isset($todo_name[$i]) == true) {
              print  '<input type="submit" formaction="finish.php" value="完了">';
            }
            ?>
            <input type="hidden" name="ID2" value="<?php print $todo_id[$i] ?>">
            <?php
            if (isset($todo_name[$i]) == true) {
              print '<input type="submit" formaction="update.php" value="更新">';
            }
            ?>
            <input type="hidden" name="ID3" value="<?php print $todo_id[$i] ?>">
            <?php
            if (isset($todo_name[$i]) == true) {
              print '<input type="submit" formaction="delete_check.php" value="削除">';
            }
            ?>
          </form>
        </td>
      </tr>
    <?php  } ?>

  </table>



</body>

</html>