<?php
//APIs almost never reply with HTML
//APIs almost always reply with JSON and HTTP status codes
// 200 = ok (everything in 200, -> e.g. 201, 202, 204)
// 30x = redirect - In APIs almost never used
// 40x = client error -
// 50x = server error -

// http_response_code(400);
// echo "{$_POST['name']} {$_POST['lastName']}";
// echo $_POST['name'].' '.$_POST['lastName'];  

//TO DO
// VALIDATE THE DATA

//ERROR FIRST
require_once(__DIR__.'/../globals.php');
//Validate firstName
if( !isset($_POST['firstName']) ){send_400("Name is required");}
if( strlen($_POST['firstName']) < 2 ){send_400("Name must be at least 2 characters");}
if( strlen($_POST['firstName']) > 20 ){send_400("Name cannot be more than 5 characters");}

//Validate lastName
if( !isset($_POST['lastName']) ){send_400("Last name is required");}
if( strlen($_POST['lastName']) < 2 ){send_400("Last name must be at least 2 characters");}
if( strlen($_POST['lastName']) > 20 ){send_400("Last name cannot be more than 5 characters");}

//Validate email
if( !isset($_POST['email']) ){send_400("Email is required");}
if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ){send_400("Email is invalid");}

if( !isset($_POST['password']) ){_res('400', ['info' => 'Password required']);}
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN ){_res('400', ['info' => 'Password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN ){_res('400', ['info' => 'Password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}

// Connect to DB
//include / require

$password = $_POST['password'];
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$db = _api_db();
try{
    // Insert data in the DB
    $query = $db->prepare('INSERT INTO users VALUES(:user_id, :user_name, :user_last_name, :user_email, :user_password)');
    $query->bindValue(":user_id", null); //The db will set user_id automatically with SERIAL
    $query->bindValue(":user_name", $_POST['firstName']);
    $query->bindValue(":user_last_name", $_POST['lastName']);
    $query->bindValue(":user_email", $_POST['email']);
    $query->bindValue(":user_password", $hashed_password);
    $query->execute();

    $user_id = $db->lastinsertid();

    //SUCCESS
    header('Content-Type: application/json');
    // echo '{"info":"user created","user_id": "'.$user_id.'"}';
    $response = ["info" => "User created", "user_id" => $user_id , "created" => true];
    echo json_encode($response);

}catch(Exception $ex){
    http_response_code(500);
    echo 'System under maintainance';
    exit();
}

// Function to manage error responding
function send_400($errorMessage){
    header('Content-Type: application/json');
    http_response_code(400);
    $response = ["info" => $errorMessage];
    echo json_encode($response);
    exit(); // can also use die(); or exit;
}






