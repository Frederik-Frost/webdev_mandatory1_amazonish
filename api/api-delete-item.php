<?php
require_once(__DIR__.'/../globals.php');


$db = _api_db();
$productId = $_GET['item_id'];
try{
    $q = $db->prepare('DELETE FROM items WHERE item_id = :item_id');
    $q->bindValue(':item_id', $productId);
    $q->execute();
    echo "deleted  $productId";
}catch(Exception $ex){
    http_response_code(500);
    echo "System under maintainance".__LINE__;
}