<?php 
require('dbconnect.php');
session_start();


$user_id = $_GET['id'];

if ($_SESSION['user']['id'] !== $_GET['id']){
    header("Location: mypage.php?id=$user_id");
}

if (!empty($_POST)){
	if (empty($_POST['name'])){
		$error['name'] = 'blank';
	}
	if (empty($_POST['email'])){
		$error['email'] = 'blank';
	}
	if ($_POST['email'] === $exist_user['email']){
		$error['email'] = 'already';
	}

	if (empty($error)){
		header("Location: edit_do.php?id=$user_id");
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
  <form action="edit_do.php?id=<?php echo $user_id ?>" method=post>
	<p><label for="name">名前</label></p>
		<?php if ($error['name'] === 'blank'): ?>
			<h4>名前を入力してください</h4>
		<?php endif; ?>
		<input type="text" name="name" id="name" value="<?php echo $_SESSION['user']['name']; ?>">
		<p><label for="email">メールアドレス</label></p>
		<?php if ($error['email'] === 'blank'): ?>
			<h4>メールアドレスを入力してください</h4>
		<?php endif; ?>
		<?php if ($error['email'] === 'already'): ?>
			<h4>そのメールアドレスは既に使用されています</h4>
		<?php endif; ?>
		<input type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>">
		<button type="submit">編集する</button>
	</form>
</body>
</html>