<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <?php
  require_once('common.php');
  $post=sanitize($_POST);

  if(isset($post)==true){
    $todoID=$post['ID3'];
  }


?>
</head>
<body>
<h1 class="title">削除確認画面</h1>

<form action="delete_done.php" method="post">
  
  <h2>削除確認</h2>

<p>項目を削除します。よろしいですか？</p>

<input type="hidden" name="ID" value="<?php print $todoID ?>">
<input type="submit" value="削除">
<button type="button" onclick="history.back()">戻る</button>
</form>
</body>
</html>