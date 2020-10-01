<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["msg"])) {
	if (strlen($_POST["msg"])>0 && strlen($_POST["msg"])<1001) {
		$stmt = $pdo->prepare('INSERT INTO messages (userid, message) VALUES (:id, :msg)');
		$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
		$stmt->bindParam(':msg', $_POST["msg"], PDO::PARAM_STR);
		$stmt->execute();
		unset($stmt);
	}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["init"])) {
	$stmt = $pdo->prepare('(SELECT msgid, usersent, message, msgtime FROM messages WHERE userid=:id ORDER BY msgtime DESC LIMIT 24) ORDER BY msgtime');
	$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->execute();
	$stmt=$stmt->fetchAll(PDO::FETCH_NUM);
	print_r(json_encode($stmt, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
	unset($stmt);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["aid"])) {
	$stmt = $pdo->prepare('SELECT msgid, message, msgtime FROM messages WHERE userid=:id AND usersent=0 AND msgid>:aid ORDER BY msgtime');
	$aid = (int) $_POST["aid"];
	$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
	$stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
	$stmt->execute();
	$stmt=$stmt->fetchAll(PDO::FETCH_NUM);
	print_r(json_encode($stmt, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
	unset($stmt);
//restructure indexes, describe both queries to ensure you use indexes efficiently
}
?>