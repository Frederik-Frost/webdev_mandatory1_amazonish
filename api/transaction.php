<?php
//Validate the id to see if the sent id is a valid id
// DELETE MULTIPLE PRODUCTS     

require_once(__DIR__.'/../globals.php');
$db = _api_db();
// echo count($_POST['delete_item']);
try{
    //Begin transaction if 2 or more updates, deletes, inserts
    $db->beginTransaction();
    foreach ($_POST['delete_item'] as $itemId)
    {
        try{
            $q = $db->prepare('SELECT item_id FROM items WHERE item_id =  :item_id');
            $q->bindValue(':item_id', $itemId);
            $q->execute();
            $row = $q->fetch();
            if(!$row){
                $db->rollBack();
                http_response_code(400);
                echo "no item with this id";
                exit();
            } else{
                try{
                    $q = $db->prepare('DELETE FROM items WHERE item_id = :item_id');
                    $q->bindValue(':item_id', $itemId);
                    $q->execute();
                } catch(Exception $ex){
                    $db->rollBack();
                    echo "System under maintainance".__LINE__;
                    http_response_code(500);
                    exit();
                }
            }
        } catch(Exception $ex){
            $db->rollBack();
            echo "System under maintainance".__LINE__;
            http_response_code(500);
            exit();
        }
    };
    //Commit
    echo "deleted ".count($_POST['delete_item'])." Items";
    $db->commit();
} catch(Exception $ex){
    http_response_code(500);
    echo "System under maintainance".__LINE__;
    $db->rollBack();
    exit();
}