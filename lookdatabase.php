<?php
$dsn = 'mysql:dbname=****;host=localhost';
$user = '****';
$password = '****';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "CREATE TABLE IF NOT EXISTS users"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
    . "address TEXT,"
    . "pass TEXT"
	.");";
    $stmt = $pdo->query($sql);

    /*$id = 3;
	$sql = 'delete from users where id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();*/



$sql = 'SELECT * FROM users';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
        echo $row['name'].',';
        echo $row['address'].',';
		echo $row['pass'].'<br>';
	echo "<hr>";
    }
    ?>