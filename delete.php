<?php 
require("dbconnect.php");
session_start();

$tweet_id =$_GET['id'];

$stmt = $db -> prepare('SELECT * FROM tweets WHERE id=?');
$stmt -> execute(array($tweet_id));
$tweet = $stmt -> fetch();

if ($tweet['user_id'] == $_SESSION['user']['id']){
    $stmt = $db -> prepare('DELETE FROM tweets WHERE id=?');
    $stmt -> execute(array($tweet_id));
    header('Location: index.php');
    exit();
} else {
    header('Location: index.php');
    exit();
}
    
?>