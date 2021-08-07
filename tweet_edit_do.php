<?php 
require('dbconnect.php');
session_start();

$tweet_id = $_GET['id'];
$stmt = $db -> prepare('SELECT * FROM tweets WHERE id=?');
$stmt -> execute(array($tweet_id));
$tweet = $stmt -> fetch();

if ($tweet['user_id'] == $_SESSION['user']['id']){
	$stmt = $db -> prepare('UPDATE tweets SET content=? WHERE id=?');
	$stmt -> execute(array($_POST['content'], $tweet_id));
	header("Location: tweet.php?id=$tweet_id");
	exit();
} else {
	header('Location: index.php');
	exit();
}    
?>