<?php 
require('dbconnect.php');
session_start();

$user_id = $_GET['id'];

if ($_SESSION['user']['id'] !== $_GET['id']){
    header("Location: mypage.php?id=$user_id");
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

  <form action="edit_do.php?id=<?php echo $user_id; ?>" method="post" enctype="multipart/form-data">
	<p><label for="name">名前</label></p>
		<input type="text" name="name" id="name" value="<?php echo $_SESSION['user']['name']; ?>">
		<p><label for="email">メールアドレス</label></p>
		<input type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email']; ?>">
		<p><label for="image">画像</label></p>
		<input type="file" name="image" id="image">
		<button type="submit">編集する</button>
	</form>
</body>
</html>