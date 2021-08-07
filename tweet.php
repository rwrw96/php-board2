<?php 
require('dbconnect.php');
session_start();

$tweet_id = $_GET['id'];

$stmt = $db -> prepare('SELECT * FROM tweets WHERE id=?');
$stmt -> execute(array($tweet_id));
$tweet = $stmt -> fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<h2>投稿詳細</h2>
	<p>投稿文：<?php echo $tweet['content']; ?></p>
	<p>日時：<?php echo $tweet['created_at']; ?></p>
	<?php if($tweet['user_id'] == $_SESSION['user']['id']): ?>
		<a href="tweet_edit.php?id=<?php echo $tweet_id; ?>">編集</a>
		<a href="delete.php?id=<?php echo $tweet_id; ?>">削除</a>
	<?php endif; ?>
	<a href="index.php">一覧へ</a>
</body>
</html>