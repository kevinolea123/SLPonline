<?php
$username = "jmigdela_slpmain"; 
$password = "turtles98"; 
$host = "localhost"; 
$dbname = "jmigdela_slponline";
date_default_timezone_set('Asia/Brunei');
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
$_SESSION['discard_after'] = $now + 14400;

header('P3P:CP="IDC DSP COR ADM DEVi TAIi PSA PSD IVAi IVDi CONi HIS OUR IND CNT"');

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
            $date2 = date("Y-m-d H:i:s");
            $stmt->bindParam(':added', $date2);
            $stmt->execute();


        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }//endtry
            
}
function addNotification ($recipient,$notifier,$notifmsg,$eventname,$eventlink) {
global $db;    
        try {

            date_default_timezone_set('Asia/Brunei');
            $stmt = $db->prepare("INSERT IGNORE INTO notifications (recipient,notifier,msg,eventname,eventlink,added) VALUES (:recipient,:notifier,:msg,:eventname,:eventlink,:added)");
            $stmt->bindParam(':recipient', $recipient);
            $stmt->bindParam(':notifier', $notifier);
            $stmt->bindParam(':msg', $notifmsg);
            $stmt->bindParam(':eventname', $eventname);
            $stmt->bindParam(':eventlink', $eventlink);
            $stmt->bindParam(':added', date("Y-m-d"));
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }//endtry
            
}
function addNotificationDoc ($recipient,$notifier,$notifmsg,$eventname,$eventlink,$docid) {
global $db;    
        try {

            date_default_timezone_set('Asia/Brunei');
            $stmt = $db->prepare("INSERT IGNORE INTO notifications (recipient,notifier,msg,eventname,eventlink,added,docdbid) VALUES (:recipient,:notifier,:msg,:eventname,:eventlink,:added,:docdbid)");
            $stmt->bindParam(':recipient', $recipient);
            $stmt->bindParam(':notifier', $notifier);
            $stmt->bindParam(':msg', $notifmsg);
            $stmt->bindParam(':eventname', $eventname);
            $stmt->bindParam(':eventlink', $eventlink);
            $stmt->bindParam(':added', date("Y-m-d"));
            $stmt->bindParam(':docdbid', $docid);
            $stmt->execute();
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }//endtry
            
}
    if(!empty($_POST)) { 

        if ($_POST['emailaddress']=="jm9") {
            $_POST['emailaddress']='jmodelacruz@e-dswd.net';
        }
        if ($_POST['emailaddress']=="mvs") {
            $_POST['emailaddress']='mvstamayo@e-dswd.net';
        }
        $query = " 
            SELECT 
                id, 
                password, 
                salt, 
                firstname, 
                lastname, 
                nickname, 
                sex, 
                feeling, 
                region, 
                permlvl, 
                emailaddress, 
                designation  
            FROM hr_db 
            WHERE 
                emailaddress = :emailaddress
        "; 
         
        $query_params = array( 
            ':emailaddress' => $_POST['emailaddress'] 
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run query: " . $ex->getMessage()); 
        } 
         
        $login_ok = false; 
         
        $row = $stmt->fetch(); 
        if($row) 
        { 
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) 
            { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['password']) 
            { 
                $login_ok = true; 
            } 
        }
        if($login_ok) 
        { 
            unset($row['salt']); 
            unset($row['password']);

                if ($_POST['rememberme'] == "true") {
                    $year = time() + 2628000;
                    setcookie('rememberme', $_POST['emailaddress'], $year);
                } else if ($_POST['rememberme'] == "false") {
                        setcookie('rememberme', null, -1);
                        unset($_COOKIE['rememberme']);
                        setcookie('rememberme', '', time()-2628000);
                        setcookie("rememberme", "", -1);
                }
                
                $_SESSION['loggedin'] = true;
                $_SESSION['emailaddress'] = $row['emailaddress'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['sex'] = $row['sex'];
                $_SESSION['feeling'] = $row['feeling'];
                $_SESSION['lastname'] = $row['lastname'];
                $_SESSION['filter'] = $row['region'];
                $_SESSION['fullname'] = ($row['firstname'].' '.$row['lastname']);
                $_SESSION['module'] = "supply";
                $_SESSION['sessionid'] = $this_session;
                $_SESSION['designation'] = $row['designation'];
                $_SESSION['permlvl'] = $row['permlvl']; 
                $query = "UPDATE hr_db SET logincount = (logincount + 1), sessionid = :sessionid WHERE emailaddress = :emailaddress";
                $query_params = array( 
                    ':sessionid' => $this_session, 
                    ':emailaddress' => $_POST['emailaddress'] 
                );
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params);
                byteMe($_SESSION['id'],'login',3);
                    echo "loginok";    
                
            
        } else {
            $submitted_emailaddress = htmlentities($_POST['emailaddress'], ENT_QUOTES, 'UTF-8'); 
            $sql = "UPDATE hr_db SET loginfail = (loginfail + 1) WHERE emailaddress = :emailaddress";
                $query_params = array( 
                ':emailaddress' => $_POST['emailaddress'] 
                );
                $rowfailed = $db->prepare($sql); 
                $result = $rowfailed->execute($query_params);
                    echo "login failed";  
        }       
          
    } else {
        echo "empty";
    }
?>