<?php
$username = "jmigdela_slpmain"; 
$password = "turtles98"; 
$host = "localhost"; 
$dbname = "jmigdela_slponline";

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
try 
{ 
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    $db->exec("SET time_zone = '+0:00'");
} 
catch(PDOException $ex) 
{ 
    die("Failed to connect: " . $ex->getMessage()); 
} 
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
session_start(); 
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['discard_after'] = $now + 1800;
//testinput
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
function byteMe ($recipient,$page,$amt) {
global $db;    
        try {

            date_default_timezone_set('Asia/Brunei');
            $stmt = $db->prepare("INSERT IGNORE INTO bytez (hrdbid,pagename,amt,added) VALUES (:hrdbid,:pagename,:amt,:added)");
            $stmt->bindParam(':hrdbid', $recipient);
            $stmt->bindParam(':pagename', $page);
            $stmt->bindParam(':amt', $amt);
            $date1 = date("Y-m-d H:i:s");
            $stmt->bindParam(':added', $date1);
            $stmt->execute();
            
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }//endtry

            
}

//start post
if(!empty($_POST)) 
{ 
//filter input
//$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


     if($_POST['action'] == "comment") {
        $id = test_input($_POST['id']);
        date_default_timezone_set('Asia/Brunei');
        $stmt = $db->prepare("INSERT INTO shoutbox (hrdbid,msg,added) VALUES (:hrdbid,:msg,:added)");
        $stmt->bindParam(':hrdbid', $_POST['hrdbid']);
        $stmt->bindParam(':msg', $_POST['comment']);
        $date2 = date("Y-m-d H:i:s");
        $stmt->bindParam(':added', $date2);
        $stmt->execute();
        byteMe($_SESSION['id'],'comment',0.25);

        echo "commented";
    }



}//end post
     
?>
