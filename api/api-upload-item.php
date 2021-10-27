<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();

//TODO MAKE SURE THE USER IS LOGGED IN

//Validate
if(!isset($_POST['item_price']) || $_POST['item_price'] == ''){ http_response_code(400); echo 'item needs price'; exit();}

if(!isset($_POST['item_name'])){ http_response_code(400); echo 'item name required'; exit();}
if(strlen($_POST['item_name']) < _ITEM_MIN_LEN){ http_response_code(400); echo 'item name must be at least '. _ITEM_MIN_LEN .' characters'; exit();}
if(strlen($_POST['item_name']) > _ITEM_MAX_LEN){ http_response_code(400); echo 'item name must be no longer than '. _ITEM_MAX_LEN .' characters'; exit();}

try{
    $item_id = bin2hex(random_bytes(16));
    $q = $db->prepare('INSERT INTO items VALUES(:item_id, :item_name, :item_price)');
    $q->bindValue(':item_id', $item_id);
    $q->bindValue(':item_name', $_POST['item_name']);
    $q->bindValue(':item_price', $_POST['item_price']);
    $q->execute();
    echo $item_id;
}catch(Exception $ex){
    http_response_code(500);
    echo "System under maintainance ".__LINE__;
}