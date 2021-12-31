<?php

require "../include/headers.php";
require "../include/functions.php";
try {
    $db = dbConnection();
    $body = json_decode(file_get_contents('php://input'));
    $region = filter_var($body->region, FILTER_SANITIZE_STRING);
    $genre = filter_var($body->genre, FILTER_SANITIZE_STRING);
    $start_year = filter_var($body->release_year, FILTER_SANITIZE_STRING);
    $title_type = filter_var($body->title_type, FILTER_SANITIZE_STRING);

    $sql = "SELECT aliases.title_id, aliases.title, aliases.region, titles.title_type, titles.start_year, title_genres.genre, titles.runtime_minutes 
    FROM aliases 
    INNER JOIN titles ON aliases.title_id = titles.title_id 
    INNER JOIN title_genres ON titles.title_id = title_genres.title_id where region = :region AND start_year = :start_year AND title_type = :title_type AND genre = :genre";

    $prepared = $db->prepare($sql);
    $prepared->bindValue(':region', $region,PDO::PARAM_STR);
    $prepared->bindValue(':genre', $genre,PDO::PARAM_STR);
    $prepared->bindValue(':title_type', $title_type,PDO::PARAM_STR);
    $prepared->bindValue(':start_year', $start_year,PDO::PARAM_STR);


    $prepared->execute();
    $rows = $prepared->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($rows);


} catch (\Throwable $th) {
    //throw $th;
}
