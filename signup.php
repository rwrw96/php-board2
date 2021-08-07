<?php
require('dbconnect.php');
session_start();


$stmt = $db -> prepare('SELECT * FROM users WHERE email=?');
$stmt -> execute(array($_POST['email']));
$exist_user = $stmt -> fetch();

if (!empty($_POST)){
	if (empty($_POST['name'])){
		$error['name'] = 'blank';
	}
	if (empty($_POST['email'])){
		$error['email'] = 'blank';
	}
	if (empty($_POST['password'])){
		$error['password'] = 'blank';
	}
	if ($_POST['email'] === $exist_user['email']){
		$error['email'] = 'already';
	}


	if (empty($error)){	

		$pass = password_hash($_POST['password'], PASSWORD_BCRYPT);

		$stmt = $db -> prepare('INSERT INTO users SET name=?, email=?, password=?, created_at=NOW()');
		$stmt -> execute(array($_POST['name'], $_POST['email'], $pass));
		
		$stmt = $db -> prepare('SELECT * FROM users WHERE email=?');
		$stmt -> execute(array($_POST['email']));
		$new_user = $stmt -> fetch();
		
		$user_id = $new_user['id'];
		$_SESSION['id'] = $new_user['id'];
		header("Location: mypage.php?id=$user_id");
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

	<h2>新規登録</h2>

	<form action="" method="post">
		<p><label for="name">名前</label></p>
		<?php if ($error['name'] === 'blank'): ?>
			<h4>名前を入力してください</h4>
		<?php endif; ?>
		<input type="text" name="name" id="name">
		<p><label for="email">メールアドレス</label></p>
		<?php if ($error['email'] === 'blank'): ?>
			<h4>メールアドレスを入力してください</h4>
		<?php endif; ?>
		<?php if ($error['email'] === 'already'): ?>
			<h4>そのメールアドレスは既に使用されています</h4>
		<?php endif; ?>
		<input type="text" name="email" id="email">
		<p><label for="password">パスワード</label></p>
		<?php if ($error['password'] === 'blank'): ?>
			<h4>パスワードを入力してください</h4>
		<?php endif; ?>
		<input type="text" name="password" id="password">
		<button type="submit">登録する</button>
	</form>

	<a href="login.php">ログインはこちら</a>
</body>
</html>