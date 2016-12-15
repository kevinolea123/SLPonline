<?php
    require "../zxcd9.php";
    //start post
    if(!empty($_POST)) 
    { 
    //filter input

    date_default_timezone_set('Asia/Brunei');
    $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
       if (empty($_POST["firstname"])) {
         echo "firstname";
       die;
     } else {
         $firstname = test_input($_POST["firstname"]);
       if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
           echo "firstname"; 
       die;
         }
       }
       if (empty($_POST["middlename"])) {
         echo "middlename";
       die;
     } else {
         $midname = test_input($_POST["middlename"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$midname)) {
           echo "middlename"; 
        die;
         }
       }

       if (empty($_POST["sector"])) {
         echo "Sub-sector is required";
       die;
     } else {
         $sector = test_input($_POST["sector"]);
     }

       if (empty($_POST["subsector"])) {
         echo "Sub-sector is required";
       die;
     } else {
         $subsector = test_input($_POST["subsector"]);
     }
       if (empty($_POST["lastname"])) {
         echo "lastname";
       die;
     } else {
         $lastname = test_input($_POST["lastname"]);
       if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
           echo "lastname"; 
       die;
      }
     }
       if (empty($_POST["birthdate"])) {
             echo "birthdate";
       die;
     } else {
             $birthdate = test_input($_POST["birthdate"]);
       if (!preg_match("/^[0-9\/]*$/",$birthdate)) {
               echo "birthdate";
       die;
      }
     }
       $height = test_input($_POST["height"]);
       $pantawidid = test_input($_POST["pantawidid"]);
       $contactnumber = test_input($_POST["contactnumber"]);
       if (!preg_match("/^[0-9]*$/",$contactnumber)) {
           echo "contactnumber"; 
       die;
        }
       if (empty($_POST["birthdate"])) {
             echo "birthdate";
       die;
     } else {
        $birthdate = test_input($_POST["birthdate"]);
       if (!preg_match("/^[0-9\/]*$/",$birthdate)) {
               echo "birthdate";
       die;
      }
     } 
        $prov = test_input($_POST["province"]);
        $city = test_input($_POST["municipality"]);
        $brgy = test_input($_POST["brgy"]);         
             //DUPLICATE CHECK=====================
        $parts = explode('/', $_POST['birthdate']);
        $bdate  = "$parts[2]-$parts[0]-$parts[1]";
        $query = " 
            SELECT 
                lastname, 
                firstname, 
                birthdate 
            FROM PRTsupply 
            WHERE 
                lastname = :lastname 
            AND
                firstname = :firstname
            AND
                birthdate = :birthdate
            ";              
        $query_params = array( 
            ':lastname' => $_POST['lastname'],
            ':firstname' => $_POST['firstname'],
            ':birthdate' => $bdate 
            );  
            try { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) { 
            die("Failed to run query: " . $ex->getMessage()); 
            } 
             
            $row = $stmt->fetch(); 
            if($row) { 
            die("duplicate entry"); 
            } 
            //END DUPLICATE=====================
        $query2 = " 
            INSERT IGNORE INTO PRTsupply ( 
                firstname, 
                middlename, 
                lastname, 
                sex, 
                birthdate, 
                pantawidid, 
                remarks, 
                hasNSO, 
                hasNBI, 
                encoded, 
                encodedby, 
                height, 
                contactnumber, 
                education, 
                region, 
                province, 
                municipality, 
                brgy
            ) VALUES ( 
                :firstname, 
                :middlename, 
                :lastname, 
                :sex, 
                :birthdate, 
                :pantawidid, 
                :remarks, 
                :hasNSO, 
                :hasNBI, 
                :encoded,
                :encodedby, 
                :height, 
                :contactnumber, 
                :education, 
                :region, 
                :province, 
                :municipality, 
                :brgy
                ) 
            ";   
             if ($_POST['sex'] == "Male") {
                $sex = 0;
             } else {
                $sex = 1;
             }
            $query_params2 = array( 
                ':firstname' => $firstname, 
                ':middlename' => $midname, 
                ':lastname' => $lastname, 
                ':sex' => $sex, 
                ':birthdate' => $bdate, 
                ':pantawidid' => $pantawidid, 
                ':remarks' => $_POST["remarks"], 
                ':hasNSO' => $_POST["hasnso"], 
                ':hasNBI' => $_POST["hasnbi"], 
                ':encoded' => date("Y-m-d H:i:sa"), 
                ':encodedby' => $_SESSION["id"], 
                ':height' => $height, 
                ':contactnumber' => $contactnumber, 
                ':education' => $_POST['education'], 
                ':region' => $_POST['region'], 
                ':province' => $prov, 
                ':municipality' => $city, 
                ':brgy' => $brgy 
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
            //getid
            $query = " 
                SELECT 
                    id 
                FROM PRTsupply 
                WHERE 
                    lastname = :lastname 
                AND 
                    birthdate = :birthdate
                AND 
                    firstname = :firstname
            "; 
            $query_params = array( 
                ':lastname' => $_POST['lastname'],
                ':birthdate' => $bdate, 
                ':firstname' => $_POST['firstname']
            ); 
            try { 
                $stmt = $db->prepare($query); 
                $result = $stmt->execute($query_params); 
            } 
            catch(PDOException $ex) { 
                die("Failed to run query: " . $ex->getMessage()); 
            }
            $row = $stmt->fetch();
            $refid = $row['id'];
            //psic
            $subsector = explode(",", $subsector);
            $stmt = $db->prepare("INSERT INTO PRTsupplytags (supplyrefid, sector, tag) VALUES (:supplyrefid, :sector, :tag)");
            $stmt->bindParam(':supplyrefid', $supplyrefid);
            $stmt->bindParam(':sector', $sector);
            $stmt->bindParam(':tag', $tag);
            foreach($subsector as $val) {
                $supplyrefid = $refid;
                $sector = $sector;
                $tag = $val;
                $stmt->execute();
            }
            byteMe($_SESSION['id'],'hb_supply_add',1);
            echo "loginok";
    }//end post
?>
