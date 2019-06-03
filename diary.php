<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<h1>5/31</h1>  

user_add_checkでこけた。
具体的にはIDの重複チェック時、

<?php 
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
        print 'サーバーがおかしい';}?>

以上を設定し、IDがサーバー上のものと重複していないか確認したかった。
上記のコード以下で、重複している場合は $errorの出力をif文で判定し戻るボタンのみ表示する。
また、$error==''だった場合は、パスワードの送信フォームに飛びたかった。
しかし、重複していない場合、$errorがnullになってしまい、if文で判定できなくなった。
結果的には、$errorをサーバー接続より上で空変数で定義することで解決。
空変数はめちゃくちゃ大事だ。


</body>
</html>