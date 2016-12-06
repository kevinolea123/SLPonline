<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) 
{ 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $id = test_input($_POST['id']);

        $query = "UPDATE hr_db SET permlvl = 1 WHERE id=:id"; 
         
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
        echo "good";
}//end post
     
?>