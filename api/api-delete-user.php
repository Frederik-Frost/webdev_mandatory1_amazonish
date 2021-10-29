<?php
require_once(__DIR__.'/../globals.php');
try{
    $db = _api_db();
} catch(Exception $ex){
    _res(500, ['info' => 'System under maintainance', 'error' => __LINE__]);
}

try {
    $id = $_GET['id'];
    // echo 'Deleted user with id: '. $id;
    $query = $db->prepare('DELETE FROM users WHERE user_id = :id');
    $query->bindValue(':id', $id);
    $query->execute();

    $response = 'Deleted '.$query->rowCount().' user with id: '.$id;
    
    echo json_encode($response);

} catch(PDOException $ex){
    http_response_code(500);
    echo 'System under maintainance';
    exit();
}