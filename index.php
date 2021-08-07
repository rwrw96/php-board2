<?php
require('dbconnect.php');
session_start();

$user = $_SESSION['user'];

$tweets = $db -> prepare('SELECT * FROM tweets, users WHERE users.id=tweets.user_id');
$tweets -> execute();

$stmt = $db -> prepare('SELECT * FROM tweets WHERE id=?');
$stmt -> execute(array($_GET['reply']));
$reply = $stmt -> fetch();

if (isset($user)){
	if (!empty($_POST['content'])){
		$stmt = $db -> prepare('INSERT INTO tweets SET content=?, user_id=?,reply_id=?, created_at=NOW()');
		$stmt -> execute(array($_POST['content'], $user['id'], $reply['id']));
		
		header('Location: index.php');
		exit();
	}
}

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
	<?php if (isset($user)): ?>
		<a href="mypage.php?id=<?php echo $user['id'] ?>">マイページへ</a>
	<?php else: ?>
		<a href="login.php">ログインはこちら</a>
	<?php endif; ?>
  <h2>投稿一覧</h2>
		<form action="" method="post">
			<p><label for="content">投稿</label></p>
			<input type="text" name="content" id="content" value="<?php echo $reply['content']; ?>">
			<button type="submit">投稿する</button>
		</form>

		<?php foreach($tweets as $tweet): ?>
			<hr>
			<p>投稿者：<a href="mypage.php?id=<?php echo $tweet['user_id']; ?>"><?php echo htmlspecialchars($tweet['name'], ENT_QUOTES); ?></a></p>
			<p>投稿：<a href="tweet.php?id=<?php echo $tweet[0]; ?>"><?php echo htmlspecialchars($tweet['content'], ENT_QUOTES); ?></a></p>
			<p>日時：<?php echo htmlspecialchars($tweet['created_at'], ENT_QUOTES); ?></p>
			<p><a href="index.php?reply=<?php echo $tweet[0]; ?>">返信する</a></p>
		<?php endforeach; ?>
</body>
</html>