<?php


try {

    require_once('common.php');

    $post = sanitize($_POST);
    $user_id = $post['ID'];
    $user_pass = $post['password'];
    $user_pass = md5($user_pass);

    $dbh = db_connect();

    $sql = 'SELECT * FROM todo_user WHERE ID=? AND PASSWORD=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $user_id;
    $data[] = $user_pass;
    $stmt->execute($data);


    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($rec == false) {

        print 'IDかパスワードがまちがっています <br>';
        print '<a href="user_login.html">戻る</a>';
    } else {
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $rec['name'];
        header('Location: todo_list.php');
        exit();
    }
} catch (Exception $e) { }
