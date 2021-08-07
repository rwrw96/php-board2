<?php 
require('dbconnect.php');
session_start();

$stmt = $db -> prepare('SELECT * FROM users WHERE id=?');
$stmt -> execute(array($_GET['id']));
$user = $stmt -> fetch();

$user_id = $user['id'];

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
	<h2>ユーザーページ</h2>
	<p>id：<?php echo htmlspecialchars($user['id'], ENT_QUOTES); ?></p>
	<p>名前：<?php echo htmlspecialchars($user['name'], ENT_QUOTES); ?></p>
	<p>メールアドレス：<?php echo htmlspecialchars($user['email'], ENT_QUOTES); ?></p>

	<a href="edit.php?id=<?php echo $user_id ?>">編集する</a>
</body>
</html>