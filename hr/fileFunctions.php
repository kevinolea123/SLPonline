<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) 
{ 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = test_input($_POST['docid']);
        if ($_POST['action'] == 'approve') {
        if ($_SESSION['id']==9) {
                $query = " 
                    UPDATE doc_db 
                    SET approved = 1 
                    WHERE 
                        id = :id
                ";
        } else if ($_SESSION['id']==662) {
                $query = " 
                    UPDATE doc_db 
                    SET approved = 2 
                    WHERE 
                        id = :id
                ";
            }
                $query_params = array( 
                    ':id' => $id 
                ); 
                try { 
                    $stmt = $db->prepare($query); 
                    $result = $stmt->execute($query_params); 
                    if ($stmt == true) {
                        echo "good";
                    }
                } 
                catch(PDOException $ex) { 
                    die("Failed to run query: " . $ex->getMessage()); 
                }
        }
        if ($_POST['action'] == 'delete') {
                $query = "DELETE FROM doc_db WHERE id = :id";
                $query_params = array( 
                    ':id' => $id 
                ); 
        try { 
                    $stmt = $db->prepare($query); 
                    $result = $stmt->execute($query_params); 
                } 
                catch(PDOException $ex) { 
                    die("Failed to run query: " . $ex->getMessage()); 
                }
        }
        if ($_POST['action'] == 'delete_comment') {
                $query = "DELETE FROM hr_RVcomments WHERE id = :id";
                $query_params = array( 
                    ':id' => $id 
                ); 
         try { 
                    $stmt = $db->prepare($query); 
                    $result = $stmt->execute($query_params); 
                    if ($stmt == true) {
                        echo "good";
                    }
                } 
                catch(PDOException $ex) { 
                    die("Failed to run query: " . $ex->getMessage()); 
                } 
            }
        if($_POST['action']=="editwp") {
            date_default_timezone_set('Asia/Brunei');
            $stmt=$db->prepare("UPDATE hr_wallposts SET wall_msg=:ewp,wallposted=:wallposted,wallposter=:wallposter WHERE wallpostid=:wpid");
            $stmt->bindparam(':wpid',$_SESSION['editid']);
            $stmt->bindParam(':ewp',$_POST['ewp']);   
            $stmt->bindParam(':wallposted', date('Y-m-d H:i:s'));
            $stmt->bindParam(':wallposter', $_SESSION['id']);
            $stmt->execute();
            echo "edited";
        }
        if($_POST['action'] == "delwp") {
                      $stmt = $db->prepare("DELETE FROM hr_wallposts WHERE wallpostid = :wpid");
                      $stmt->bindParam(':wpid',$_POST['wpid']);
                      $stmt->execute();
                      echo "deleted";
        }
}//end post
?>
