<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();

//TODO MAKE SURE THE USER IS LOGGED IN

// //Validate
// if(!isset($_POST['item_price'])){ http_response_code(400); echo 'item needs price required'; exit();}

// if(!isset($_POST['item_name'])){ http_response_code(400); echo 'item name required'; exit();}
// if(strlen($_POST['item_name']) < _ITEM_MIN_LEN){ http_response_code(400); echo 'item name must be at least '. _ITEM_MIN_LEN .' characters'; exit();}
// if(strlen($_POST['item_name']) > _ITEM_MAX_LEN){ http_response_code(400); echo 'item name must be no longer than '. _ITEM_MAX_LEN .' characters'; exit();}

$data = json_decode(file_get_contents('php://input'), true);

if( !$data["item_id"]){http_response_code(400); echo 'no id'; exit();}
try{
    $q = $db->prepare('UPDATE items SET item_name = :item_name, item_price = :item_price WHERE item_id = :item_id');
    $q->bindValue(':item_name', $data['item_name']);
    $q->bindValue(':item_price', $data['item_price']);
    $q->bindValue(':item_id', $data['item_id']);
    $q->execute();
    $response = ["info" => "Succesfully updated", "item_id" => $data['item_id'],"item_name" => $data['item_name'], "item_price" => $data['item_price'],"updated" => true];
    echo json_encode($response);

}catch(Exception $ex){
    http_response_code(500);
    echo "System under maintainance".__LINE__;
}
