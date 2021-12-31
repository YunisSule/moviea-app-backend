<?php

require "../include/headers.php";
require "../include/functions.php";
try {
    $db = dbConnection();
    $body = json_decode(file_get_contents('php://input'));
    $title_id = filter_var($body->title_id, FILTER_SANITIZE_STRING);
    $region = filter_var($body->region, FILTER_SANITIZE_STRING);
    

    $sql = "SELECT aliases.region, titles.*, title_genres.genre, names_.*, num_votes, average_rating
    FROM aliases
    INNER JOIN title_ratings ON aliases.title_id = title_ratings.title_id
    INNER JOIN titles ON aliases.title_id = titles.title_id
    INNER JOIN title_genres ON titles.title_id = title_genres.title_id
    INNER JOIN directors ON titles.title_id = directors.title_id
    LEFT JOIN names_ ON directors.name_id = names_.name_id
    where titles.title_id= :title_id AND region = :region";

    $prepared = $db->prepare($sql);
    $prepared->bindValue(':title_id', $title_id,PDO::PARAM_STR);
    $prepared->bindValue(':region', $region,PDO::PARAM_STR);
   


    $prepared->execute();
    $rows = $prepared->fetch(PDO::FETCH_ASSOC);

    echo json_encode($rows);


} catch(PDOException $e){
    echo $e->getMessage();
}
