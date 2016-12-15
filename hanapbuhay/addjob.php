<?php
        require "../zxcd9.php";
        //start post
        if(!empty($_POST)) 
        { 
        //filter input

        date_default_timezone_set('Asia/Brunei');
        $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
           if (empty($_POST["sector"])) {
             echo "Missing Sector";
           die;
         } else {
             $sector = test_input($_POST["sector"]);
         }
           if (empty($_POST["subsector"])) {
             echo "Missing Sub-Sector";
           die;
         } else {
             $subsector = test_input($_POST["subsector"]);
         }
           if (empty($_POST["jobname"])) {
             echo "Missing jobname";
           die;
         } else {
             $jobname = test_input($_POST["jobname"]);
           if (!preg_match("/^[a-zA-Z0-9 ]*$/",$jobname)) {
               echo "jobname"; 
           die;
             }
           }
           if (empty($_POST["numopenings"])) {
             echo "Missing numopenings";
           die;
         } else {
             $numopenings = test_input($_POST["numopenings"]);
           if (!preg_match("/^[0-9]*$/",$numopenings)) {
               echo "numopenings"; 
           die;
             }
         }
           if (empty($_POST["workingdays"])) {
             echo "Missing workingdays";
           die;
         } else {
             $workingdays = test_input($_POST["workingdays"]);
           if (!preg_match("/^[0-9]*$/",$workingdays)) {
               echo "workingdays"; 
           die;
          }
         }
           if (empty($_POST["workinghours"])) {
             echo "Missing workinghours";
           die;
         } else {
             $workinghours = test_input($_POST["workinghours"]);
           if (!preg_match("/^[0-9]*$/",$workinghours)) {
               echo "workinghours"; 
           die;
          }
         }
           if (empty($_POST["employstatus"])) {
             echo "Missing employstatus";
           die;
         } else {
             $employstatus = test_input($_POST["employstatus"]);
           if (!preg_match("/^[a-zA-Z ]*$/",$employstatus)) {
               echo "employstatus"; 
           die;
          }
         }
            $prefsex = test_input($_POST["prefsex"]);
            if ($prefsex == "Male") {
                $prefsex = 0;
          } else if ($prefsex == "Female") {
                $prefsex = 1;
         }
            $prefage = test_input($_POST["prefage"]);
            $prefheight = test_input($_POST["prefheight"]);
            $requirements = test_input($_POST["requirements"]);
           if (empty($_POST["salary"])) {
             echo "Missing salary";
           die;
         } else {
             $salary = test_input($_POST["salary"]);
           if (!preg_match("/^[a-zA-Z0-9\-\, ]*$/",$salary)) {
               echo "salary"; 
           die;
          }
         }

           if (empty($_POST["partner"])) {
             echo "Partner name missing";
           die;
         } else {
             $partner = test_input($_POST["partner"]);
         }

           if (empty($_POST["province"])) {
             echo "province required";
           die;
         } else {
             $province = test_input($_POST["province"]);
         }
           if (empty($_POST["municipality"])) {
             echo "municipality required";
           die;
         } else {
             $municipality = test_input($_POST["municipality"]);
           }
             $description = test_input($_POST["description"]);

             $pintervention = test_input($_POST["pintervention"]);
           if (!preg_match("/^[a-zA-Z0-9\(\) ]*$/",$pintervention)) {
               echo "pintervention"; 
           die;
         }  
             $contactperson = test_input($_POST["contactperson"]);
           if (!preg_match("/^[a-zA-Z\.\, ]*$/",$contactperson)) {
               echo "contactperson"; 
           die;
         }
             $indirectpartner = test_input($_POST["indirectpartner"]);
             $contacttitle = test_input($_POST["contacttitle"]);
           if (!preg_match("/^[a-zA-Z\.\, ]*$/",$contacttitle)) {
               echo "contacttitle"; 
           die;
         }
             $contactnumber = test_input($_POST["contactnumber"]);
           if (!preg_match("/^[0-9]*$/",$contactnumber)) {
               echo "contactnumber"; 
           die;
         }  
           if (!empty($_POST["contactemail"])) {
                $contactemail = test_input($_POST["contactemail"]);
           if(!filter_var($_POST['contactemail'], FILTER_VALIDATE_EMAIL)) { 
                    echo "contactemail"; 
           die;
          } 
         }        
                 //EMAIL=====================
                $query = " 
                    SELECT 
                        1 
                    FROM PRTdemand 
                    WHERE
                        jobname = :jobname
                    AND
                        encodedby = :encodedby 
                    AND
                        startdate = :startdate 
                    AND
                        numopenings = :numopenings 
                ";        
                $query_params = array( 
                    ':jobname' => $_POST['jobname'],
                    ':encodedby' => $_SESSION['id'],
                    ':startdate' => $_POST['startdate'], 
                    ':numopenings' => $_POST['numopenings'], 
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
                //END EMAIL=====================
                $query2 = " 
                    INSERT IGNORE INTO PRTdemand ( 
                        partner, 
                        jobname, 
                        numopenings, 
                        startdate, 
                        workingdays, 
                        workinghours, 
                        employstatus, 
                        intervention, 
                        indirectpartner, 
                        salary, 
                        prefsex, 
                        prefage, 
                        prefheight, 
                        description, 
                        requirements, 
                        region, 
                        province, 
                        municipality, 
                        contactperson, 
                        contacttitle, 
                        contactemail,
                        contactnumber,
                        encodedby, 
                        encoded
                    ) VALUES ( 
                        :partner, 
                        :jobname, 
                        :numopenings, 
                        :startdate, 
                        :workingdays, 
                        :workinghours, 
                        :employstatus, 
                        :intervention, 
                        :indirectpartner, 
                        :salary, 
                        :prefsex, 
                        :prefage, 
                        :prefheight, 
                        :description, 
                        :requirements, 
                        :region, 
                        :province, 
                        :municipality, 
                        :contactperson, 
                        :contacttitle, 
                        :contactemail,
                        :contactnumber,
                        :encodedby,
                        :encoded
                    ) 
                "; 
                $parts = explode('/', $_POST['startdate']);
                $startdate  = "$parts[2]-$parts[0]-$parts[1]";
                if ($_SESSION["filter"] == "NPMO") {
                    $region = $_POST["region"];
                } else {
                    $region = $_SESSION["filter"];
                }

                $query_params2 = array(
                    ':partner' => $partner, 
                    ':jobname' => $jobname, 
                    ':numopenings' => $numopenings, 
                    ':startdate' => $startdate, 
                    ':workingdays' => $workingdays, 
                    ':workinghours' => $workinghours, 
                    ':employstatus' => $employstatus, 
                    ':intervention' => $pintervention, 
                    ':indirectpartner' => $indirectpartner, 
                    ':salary' => $salary, 
                    ':prefsex' => $prefsex, 
                    ':prefage' => $prefage, 
                    ':prefheight' => $prefheight, 
                    ':description' => $description,
                    ':requirements' => $requirements, 
                    ':region' => $region, 
                    ':province' => $province, 
                    ':municipality' => $municipality, 
                    ':contactperson' => $contactperson,
                    ':contacttitle' => $contacttitle, 
                    ':contactemail' => $contactemail,
                    ':contactnumber' => $contactnumber,
                    ':encodedby' => $_SESSION['id'],
                    ':encoded' => date('Y-m-d H:i:sa')
                ); 
                try { 
                    // Execute the query to create the user 
                    $stmt = $db->prepare($query2); 
                    $result = $stmt->execute($query_params2);

                } 
                catch(PDOException $ex) { 
                die("Failed to run queryyy: " . $ex->getMessage()); 
                }                 //getid
                $refid = $db->lastInsertId();
                //psic
                $sector = $_POST['sector'];
                $subsector = $_POST['subsector'];
                $subsector = explode(",", $subsector);
                $stmt = $db->prepare("INSERT INTO PRTdemandtags (demandid, sector, tag) VALUES (:demandid, :sector, :tag)");
                $stmt->bindParam(':demandid', $demandid);
                $stmt->bindParam(':sector', $sector);
                $stmt->bindParam(':tag', $tag);
                foreach($subsector as $val) {
                    $demandid = $refid;
                    $sector = $sector;
                    $tag = $val;
                    $stmt->execute();
                }
                byteMe($_SESSION['id'],'hb_jobs_add',1);
                echo "loginok";
        }//end post
?>
