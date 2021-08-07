<?php 
require('dbconnect.php');
session_start();

if (!empty($_POST)){
	if (empty($_POST['email'])){
		$error['email'] = 'blank';
	}
	if (empty($_POST['password'])){
		$error['password'] = 'blank';
	}

	if (empty($error)){

		$stmt = $db -> prepare('SELECT * FROM users WHERE email=?');
		$stmt -> execute(array($_POST['email']));
		$login_user = $stmt -> fetch();

		if (password_verify($_POST['password'], $login_user['password'])){

			$_SESSION['user'] = $login_user;
			$login_user_id = $login_user['id'];
			header("Location: mypage.php?id=$login_user_id");
			exit();
		}
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
  <h2>ログイン</h2>
	<form action="" method="post">
	<p><label for="email">メールアドレス</label></p>
		<?php if ($error['email'] === 'blank'): ?>
			<h4>メールアドレスを入力してください</h4>
		<?php endif; ?>
		<input type="text" name="email" id="email">
		<p><label for="password">パスワード</label></p>
		<?php if ($error['password'] === 'blank'): ?>
			<h4>パスワードを入力してください</h4>
		<?php endif; ?>
		<input type="text" name="password" id="password">
		<button type="submit">登録する</button>
	</form>

	<a href="signup.php">新規登録はこちら</a>
</body>
</html>