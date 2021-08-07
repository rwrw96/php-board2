<?php 
try {
    $db = new PDO ('mysql:dbname=boarddb; host=localhost; charset=utf8', 'root', 'root');
} catch (PDOException $e) {
    echo $e -> getMessage();
    exit();
}
?>