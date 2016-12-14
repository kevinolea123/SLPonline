<?php
require "../zxcd9.php";

//start post
if(!empty($_POST)) 
{ 
//filter input
$_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


   if (empty($_POST["orgname"])) {
     echo "Missing name";
     die;
   }

   if (empty($_POST["psector"])) {
     echo "Missing partner type";
     die;
   }
   if (empty($_POST["pintervention"])) {
     echo "Missing intervention type";
     die;
   }

   if (empty($_POST["psic"])) {
     echo "Missing sector";
     die;
   }

   if (empty($_POST["address"])) {
     echo "Missing address";
     die;
   }


   if (empty($_POST["engagemeans"])) {
     echo "Missing means of engagement";
     die;
   }


   if (empty($_POST["region"])) {
     echo "Missing region";
     die;
   }

   if (empty($_POST["province"])) {
     echo "Missing province";
     die;
   }

   if (empty($_POST["municipality"])) {
     echo "Missing municipality";
     die;
   }

   if (empty($_POST["partnerid"])) {
     echo "Invalid edit. Missing partner.";
     die;
   }
         
        $query2 = " 
            UPDATE PRTemployers 
            SET orgname = :orgname, 
                psic = :psic, 
                website = :website, 
                established = :established, 
                psector= :psector, 
                pintervention=:pintervention,
                contactperson = :contactperson, 
                contacttitle = :contacttitle, 
                contactemail = :contactemail, 
                contactnumber = :contactnumber, 
                engagement_means = :engagemeans, 
                engagement_cost = :engagecost, 
                address = :address, 
                region = :region, 
                province = :province, 
                municipality = :municipality 
            WHERE 
                id = :id
        "; 
         
        $query_params2 = array(
            ':orgname' => $_POST['orgname'],  
            ':psic' => $_POST['psic'], 
            ':website' => $_POST['website'], 
            ':established' => $_POST['yearsofop'], 
            ':psector' => $_POST['psector'], 
            ':pintervention' => $_POST['pintervention'], 
            ':contactperson' => $_POST['contactperson'], 
            ':contacttitle' => $_POST['contacttitle'], 
            ':contactemail' => $_POST['contactemail'], 
            ':contactnumber' => $_POST['contactnumber'], 
            ':engagemeans' => $_POST['engagemeans'], 
            ':engagecost' => $_POST['engagecost'], 
            ':address' => $_POST['address'],  
            ':region' => $_POST['region'], 
            ':province' => $_POST['province'], 
            ':municipality' => $_POST['municipality'],
            ':id' => $_POST['partnerid']
        ); 
         
        try 
        { 
            $stmt = $db->prepare($query2); 
            $result = $stmt->execute($query_params2);

        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run queryyy: " . $ex->getMessage()); 
        } 
        echo "edited";
        
}//end post
     
?>