<?php 
require('dbconnect.php');
session_start();

$user_id = $_GET['id'];
$stmt = $db -> prepare('SELECT * FROM users WHERE id=?');
$stmt -> execute(array($user_id));
$edit_user = $stmt -> fetch();

if ($_SESSION['user']['id'] !== $_GET['id']){
	header("Location: mypage.php?id=$user_id");
}

if (isset($_POST['name']) && isset($_POST['email'])){
    $stmt = $db -> prepare('UPDATE users SET name=?, email=?,updated_at=NOW() WHERE id=?');
    $stmt -> execute(array($_POST['name'], $_POST['email'], $user_id));
		

		if ($_FILES['image']['name'] !== ''){
			move_uploaded_file($_FILES['image']['tmp_name'], 'user_images/' . $_FILES['image']['name']);
			$stmt = $db -> prepare('UPDATE users SET image=?, updated_at=NOW() WHERE id=?');
      $stmt -> execute(array($_FILES['image']['name'], $user_id));
		} else {
			$stmt = $db -> prepare('UPDATE users SET image=?, updated_at=NOW() WHERE id=?');
      $stmt -> execute(array($edit_user['image'], $user_id));
		}

    header("Location: mypage.php?id=$user_id");
    exit();
} else {
    header("Location: edit.php?id=$user_id");
    exit();
}
    
?>