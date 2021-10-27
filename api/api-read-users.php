<?php
$db = require_once('./db.php');

try{
    $query = $db->prepare('SELECT * FROM users');
    $query->execute();
    $data = $query->fetchAll();
    echo json_encode($data);
}catch(PDOException $ex){
    echo 'System under maintainance';
    exit();
}