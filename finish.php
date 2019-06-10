<?php


  try {

    $date = date('Y-m-d');
    //サニタイズ、データ接続
    require_once('common.php');
    $post = sanitize($_POST);
    $dbh = db_connect();


    //データベース更新

    $sql2 = "UPDATE todo_item SET FINISHED_DATE =? WHERE ID=?";
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->bindValue(1, $date, PDO::PARAM_STR); //FINISHED_DATE
    $stmt2->bindValue(2, $post['ID'], PDO::PARAM_STR); //ID検索
    $stmt2->execute();

    $dbh = null;


    header("Location: todo_list.php");
  } catch (Execption $e) {
    print "ただいま障害により大変ご迷惑をおかけしています。";
  }



  ?>