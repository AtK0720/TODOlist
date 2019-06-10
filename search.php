<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php

    require_once('common.php');
    $post = sanitize($_POST);

    if (isset($post) == true) {
        $search = $_POST['search'];
    }

    $dbh = db_connect();

    $sql = "SELECT * FROM todo_item WHERE NAME LIKE '%$search%'";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $count=$stmt->rowCount();

//書き出し用
for ($j = 0; $j < $count; $j++) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $result_id[]=$rec['ID'];
    $result_name[] = $rec['NAME'];
    $result_userID[]= $rec['USER'];
    $result_expire[]=$rec['EXPIRE_DATE'];
    $result_finish[]=$rec['FINISHED_DATE'];
}
    //ユーザー名を拾う




    ?>
</head>

<body>

<h1>検索結果画面</h1>
<h2>検索結果</h2>

<button type="button" onclick="history.back()">戻る</button>

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
        <td><?php print $result_name[$i]; ?></td>
        <td><?php
            //担当者IDと名前の照合

            $dbh = db_connect();
            $sql2 = "SELECT NAME FROM todo_user WHERE ID=?";
            $stmt2 = $dbh->prepare($sql2);
            $stmt2->execute([$result_userID[$i]]);
            $rec2 = $stmt2->fetch(PDO::FETCH_ASSOC);

            $result_username = $rec2['NAME'];

            print $result_username; ?></td>
        <td><?php print $result_expire[$i]; ?></td>
        <td><?php
            //完了or未完了の判断
            if ($result_finish[$i] == '0000-00-00') {
              print '未完了';
            } else {
              print $result_finish[$i];
            }
            ?></td>
        <td>
          <form method="post">
            <input type="hidden" name="ID" value="<?php print $result_id[$i] ?>">
            <?php
            //更新ボタンの出力
            if (isset($result_name[$i]) == true) {
              print  '<input type="submit" formaction="finish.php" value="完了">';
            }
            ?>
            <input type="hidden" name="ID2" value="<?php print $result_id[$i] ?>">
            <?php
            if (isset($result_name[$i]) == true) {
              print '<input type="submit" formaction="update.php" value="更新">';
            }
            ?>
            <input type="hidden" name="ID3" value="<?php print $result_id[$i] ?>">
            <?php
            if (isset($result_name[$i]) == true) {
              print '<input type="submit" formaction="delete_check.php" value="削除">';
            }
            ?>
          </form>
        </td>
      </tr>
    <?php  } ?>

  </table>

  <button type="button" onclick="history.back()">戻る</button>


</body>

</html>