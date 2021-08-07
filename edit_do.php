<?php 
require('dbconnect.php');
session_start();

$user_id = $_GET['id'];

if (!empty($_POST['name']) && !empty($_POST['email'])){
    
    $stmt = $db -> prepare('UPDATE users SET name=?, email=?, updated_at=NOW() WHERE id=?');
    $stmt -> execute(array($_POST['name'], $_POST['email'], $user_id));
    header("Location: mypage.php?id=$user_id");
    exit();
} else {
    header("Location: edit.php?id=$user_id");
    exit();
}
    
?>