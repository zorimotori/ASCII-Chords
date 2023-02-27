<?php

require_once "../classes/AppStart.php";

AppStart::startApp();

$connection = (new Database())->getConnection();
$filenames = $connection->prepare("SELECT `filename` FROM `files`");
$filenames->execute();
$songs = $filenames->fetchAll();

echo json_encode($songs, JSON_UNESCAPED_UNICODE);

?>
