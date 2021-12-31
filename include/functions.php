<?php

function dbConnection(){

    try{
        $db = new PDO('mysql:host=localhost;dbname=imdb', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo $e->getMessage();    
    }

    return $db;
}