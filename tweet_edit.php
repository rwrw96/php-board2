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

	<form action="tweet_edit_do.php?id=<?php echo $tweet_id; ?>" method="post">	
		<p><label for="content">投稿文</label></p>
		<input type="text" name="content" id="content" value="<?php echo $tweet['content']; ?>">
		<button type="submit">編集する</button>
	</form>
</body>
</html>