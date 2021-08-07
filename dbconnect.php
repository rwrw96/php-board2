<?php 
try {
    $db = new PDO ('mysql:dbname=boarddb; host=mydb.cle5jiuhhe8w.ap-northeast-1.rds.amazonaws.com; charset=utf8', 'root', 'kazuki108');
} catch (PDOException $e) {
    echo $e -> getMessage();
    exit();
}
?>