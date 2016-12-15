<?php
require "../zxcd9.php";
//start post
if(!empty($_POST)) 
{ 
//filter input
$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);



   if (empty($_POST["orgname"])) {
     echo "Organization Name is required";
     die;
   } else {
     $orgname = test_input($_POST["orgname"]);
   }
   if (empty($_POST["psic"])) {
     echo "Primary Industry is required";
     die;
   } else {
     $psic = test_input($_POST["psic"]);
   }

   if (empty($_POST["contactperson"])) {
     echo "Contact person is required";
     die;
   } else {
     $contactperson = test_input($_POST["contactperson"]);
     if (!preg_match("/^[a-zA-Z ]*$/",$contactperson)) {
       echo "contactperson"; 
       die;
     }
   }

   if(empty($_POST['pintervention'])) {
   echo "Intervention type is required";
   die;
   } else {
   $pintervention = test_input($_POST['pintervention']);
   }


   if (empty($_POST["contactnumber"])) {
     echo "Contact number is required";
     die;
   } else {
     $contactnumber = test_input($_POST["contactnumber"]);
     if (!preg_match("/^[0-9]*$/",$contactnumber)) {
       echo "contactnumber"; 
       die;
     }
   }

   
        $contactemail = test_input($_POST["contactemail"]);
        if(!filter_var($_POST['contactemail'], FILTER_VALIDATE_EMAIL)) { 
            echo "contactemail"; 
            die;
        } 
    
  if (empty($_POST["address"])) {
     echo "Address is required";
     die;
   } else {
     $address = test_input($_POST["address"]);
     if (!preg_match("/^[a-zA-Z0-9\,\.\#\- ]*$/",$address)) {
       echo "address"; 
       die;
     }
   }

    $contactnumber = test_input($_POST["contactnumber"]);
    if (!preg_match("/^[0-9]*$/",$contactnumber)) {
       echo "contactnumber"; 
       die;
    }

    $established = test_input($_POST["yearsofop"]);
    if (!preg_match("/^[0-9\/]*$/",$established)) {
       echo "established"; 
       die;
    }
     $website = test_input($_POST["website"]);
     $psector = $_POST["psector"];
  
     
     $contacttitle = test_input($_POST["contacttitle"]);

     $npmo = 0;
     if ($_SESSION['filter']=="NPMO") {
      $npmo = 1;
     }
date_default_timezone_set('Asia/Brunei');
        $query2 = " 
            INSERT IGNORE INTO PRTemployers ( 
                orgname, 
                psic, 
                contactperson, 
                contacttitle, 
                contactemail, 
                contactnumber, 
                address, 
                established, 
                psector,
                website,
                pintervention, 
                region, 
                province, 
                municipality, 
                created, 
                createdby, 
                engagement_means, 
                engagement_cost, 
                npmo
                ) VALUES ( 
                :orgname, 
                :psic, 
                :contactperson, 
                :contacttitle, 
                :contactemail, 
                :contactnumber, 
                :address, 
                :established, 
                :psector,
                :website, 
                :pintervention,
                :region, 
                :province, 
                :municipality, 
                :created, 
                :createdby, 
                :engagement_means, 
                :engagement_cost, 
                :npmo
                
            ) 
        "; 
        $query_params2 = array( 
            ':orgname' => $orgname, 
            ':psic' => $psic, 
            ':contactperson' => $contactperson, 
            ':contacttitle' => $contacttitle, 
            ':contactemail' => $contactemail, 
            ':contactnumber' => $contactnumber, 
            ':address' => $address, 
            ':established' => $established, 
            ':psector' => $psector,
            ':website' => $website, 
            ':pintervention' => $pintervention,
            ':region' => $_POST['region'], 
            ':province' => $_POST['province'], 
            ':municipality' => $_POST['municipality'],
            ':created' => date("Y-m-d H:i:sa"),
            ':createdby' => $_SESSION['id'], 
            ':engagement_means' => $_POST['engagemeans'], 
            ':engagement_cost' => $_POST['engagecost'],
            ':npmo' => $npmo
           
        ); 
         
        try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query2); 
            $result = $stmt->execute($query_params2);

        } 
        catch(PDOException $ex) 
        { 
            die("Failed to run queryyy: " . $ex->getMessage()); 
        }


        $refid = $db->lastInsertId();
        $postregion = explode(',', $_POST['regionarray']);

        $stmt = $db->prepare("INSERT INTO PRTemployersloc (refid, region, province, municipality, isorig) VALUES (:refid, :region, :province, :municipality, :isorig)");
        $stmt->bindParam(':refid', $locrefid);
        $stmt->bindParam(':region', $regL);
        $stmt->bindParam(':province', $provL);
        $stmt->bindParam(':municipality', $muniL);
        $stmt->bindParam(':isorig', $origL);

        $reglength = count($postregion);
        for ($i=0;$i<($reglength+1);$i++) {
            $locrefid= $refid;
            if ($i == 0) {
                $regL = $_POST['region'];
                $provL = $_POST['province'];
                $muniL = $_POST['municipality'];
                $origL = 1;
            } else {
                $regL = $postregion[($i-1)];
                $provL = "";
                $muniL = "";
                $origL = 0;
            }
            $stmt->execute();
        }
        
        byteMe($_SESSION['id'],'hb_partner_adds',1);
  echo "loginok";      
}//end post
     
?>