<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();
try{
    $query = $db->prepare('SELECT * FROM items');
    $query->execute();
    $data = $query->fetchAll();
    echo json_encode($data);
}catch(PDOException $ex){
    echo 'System under maintainance';
    exit();
}