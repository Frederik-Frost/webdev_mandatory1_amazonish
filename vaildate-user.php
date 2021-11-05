<?php
//To do: Verify the key (must be 32 characters)
//To do: Connect to the db
//To do: update the verified to 1 if match
//To do: Say congrats to the user

if(!isset($_GET['key'])){
    echo "mmm..... suspicious (key is missing)";
    exit();
}
if(strlen($_GET['key']) != 32){
    echo "mmm..... suspicious (key is not 32 chars)";
    exit();
}

?>