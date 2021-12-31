<?php

require "../include/headers.php";
require "../include/functions.php";

$db = dbConnection();

$sql = "SELECT * FROM regions";

$prepare = $db->prepare($sql);

$prepare->execute();
$rows = $prepare->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($rows);