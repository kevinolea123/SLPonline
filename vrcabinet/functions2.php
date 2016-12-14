<?php
        require "../zxcd9.php";
        require("../mailer/PHPMailerAutoload.php");
        require("../mailer/class.phpmailer.php");
        require("../mailer/class.smtp.php");
        function upload_dir(){
          $dir = $_SERVER['DOCUMENT_ROOT']."/docs/";
          return($dir);
        }
        function sendEmail($refidz,$uploadname,$doctype) {
        global $db;
                        $emailarray = $_POST['emailarray'];
                        $emailarray = explode(",", $emailarray);
                        try {
                          $idarray = [];
                          foreach($emailarray as $email) {
                            $stmt = $db->prepare("SELECT id FROM hr_db WHERE emailaddress = '".$email."'");
                            $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $idarray[] = $row['id'];
                                }
                          }
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                        try {
                            foreach($idarray as $id) {
                              $linkadd = "http://".$_SERVER[HTTP_HOST];
                              addNotificationDoc($id, $_SESSION['firstname'], "uploaded ", $_POST['doctype'].": ".$_POST['docsubject'], $linkadd."/vrcabinet/docview.php?id=".$refidz,$refidz);
                            }
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
          $from = "noreply@slp.ph";
          $fromname = "SLP";
        if ($doctype == "Blast") {
        ob_start();
        ?>
        <div class="bodycontainer" style="margin-top:1em;margin-bottom:1em">
        <div style="padding:0;width:100%!important;margin:0" marginheight="0" marginwidth="0"><center><table cellpadding="8" cellspacing="0" style="padding:0;width:100%!important;background:#ffffff;margin:0;background-color:#ffffff" border="0"><tr><td valign="top">
        <table cellpadding="0" cellspacing="0" style="border-radius:4px;border:1px #dceaf5 solid;border-collapse:none" border="0" align="center">
        <tr><td><table cellpadding="0" cellspacing="0" style="line-height:25px" border="0" align="center"><tr><td colspan="3" height="30"></td></tr><tr><td width="36"></td>
        <td width="454" align="center" style="color:#444444;border-collapse:collapse;font-size:9pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;max-width:454px" valign="top">
        <img src="http://www.slp.ph/docs/<?php echo $uploadname;?>" style="height:auto !important;max-width:500px !important;width: 100% !important;">
        Cant see this image? <a href="http://slp.ph/docs/<?php echo $uploadname; ?>" style="color:#4583ed">Click here</a><br>
        <td width="36"></td></tr><tr><td colspan="3" height="36"></td></tr></table></td></tr></table><table cellpadding="0" cellspacing="0" align="center" border="0"><tr><td height="10"></td></tr><tr><td style="padding:0;border-collapse:collapse"><table cellpadding="0" cellspacing="0" align="center" border="0"><tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;"><td width="200" align="left"></td>
        <td width="328" align="right"><span style="font-size:12px">Sent through <a href="http://www.slp.ph" style="text-decoration:none;color:#4583ed">SLP Online</a> by <span id="emailfrom"><?php echo $_SESSION["fullname"]; ?></span></span><br></td></td>
        </tr></table></td></tr></table></td></tr></table></center></div></div>
        <?php
                      $myvar = ob_get_clean();
        } else {
        ob_start();
        ?>
        <div class="bodycontainer" style="margin-top:1em;margin-bottom:1em">
        <div style="padding:0;width:100%!important;margin:0;" marginheight="0" marginwidth="0"><center><table cellpadding="8" cellspacing="0" style="padding:0;width:100%!important;background:#ffffff;margin:0;background-color:#ffffff" border="0"><tr><td valign="top">
        <table cellpadding="0" cellspacing="0" style="border-radius:4px;border:1px #dceaf5 solid;border-collapse:inherit" border="0" align="center"><tr><td colspan="3" height="6"></td></tr><tr style="line-height:0px"><td width="100%" style="font-size:0px" align="center" height="1">
          <img width="40px" style="max-height:104px;width:55px;margin-top:15px" alt="" src="http://slp.ph/imgs/emailslplogo.png"></td></tr><tr><td><table cellpadding="0" cellspacing="0" style="line-height:25px" border="0" align="center"><tr><td colspan="3" height="30"></td></tr><tr><td width="36"></td>
        <td width="454" align="left" style="color:#444444;border-collapse:collapse;font-size:11pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;max-width:454px" valign="top">
          Dear Sir/Madam,<br><br>
          This is to provide you with a copy of the <b id="emaildoctype" style=""><?php echo $_POST['doctype']; ?></b> with subject <b id="emailsubject"><?php echo $_POST['docsubject']; ?></b> 
          <?php if ($_POST['docdate']!=""||$_POST['docdate']=="0000-00-00") {
            echo "dated <b>".$_POST['docdate']."</b>";
          } ?>.
          <br><br>
          <i id="emailsummary"><?php echo str_replace("<br />", "", nl2br($_POST['remarks'])); ?></i>
          <br><br><table border="0" cellpadding="0" cellspacing="0" style="background-color:#18bc9c; border:0px solid #4285f4; border-radius:5px;">
                    <tr>
                        <td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:140%; padding-top:9px; padding-right:26px; padding-bottom:8px; padding-left:26px;">
                            <a href="http://slp.ph/vrcabinet/docview.php?id=<?php echo $refidz; ?>" target="_blank" style="color:#FFFFFF; text-decoration:none;">View Details</a>
                        </td>
                        <td align="center" valign="middle" style="background-color:#4285f4; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:140%; padding-top:9px; padding-right:26px; padding-bottom:8px; padding-left:26px; border-radius:5px;border-top-left-radius: 0px;border-bottom-left-radius: 0px">
                            <a href="http://slp.ph/docs/<?php echo $uploadname; ?>" target="_blank" style="color:#FFFFFF; text-decoration:none;">Download</a>
                        </td>
                    </tr>
          </table>
          <br>Thank you for your usual support and cooperation. Happy working!<br></td>
        <td width="36"></td>
        </tr><tr><td colspan="3" height="36"></td></tr></table></td></tr></table><table cellpadding="0" cellspacing="0" align="center" border="0"><tr><td height="10"></td></tr><tr><td style="padding:0;border-collapse:collapse"><table cellpadding="0" cellspacing="0" align="center" border="0"><tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;"><td width="200" align="left"></td>
        <td width="328" align="right"><span style="font-size:12px">Sent through <a href="http://slp.ph" style="text-decoration:none;color:#4583ed">SLP Online</a> by <span id="emailfrom"><?php echo $_SESSION['fullname']; ?></span></span></td>
        </tr></table></td></tr></table></td></tr></table></center></div>
        </div>
        <?php
                      $myvar = ob_get_clean();
        }
                      $mail = new PHPMailer();
                      $mail->IsSMTP();             
                      $mail->SMTPAuth = true;
                      $mail->SMTPSecure = 'ssl';
                      $mail->Host = "smtp.gmail.com";
                      $mail->Port = 465;
                      $mail->Username = "info@slp.ph";
                      $mail->Password = "turtles98!!";
                      $mail->From = "info@slp.ph";
                      $mail->FromName = "SLP";
                      $mail->IsHTML(true);
                      $mail->Subject = $_POST['docsubject'];
                      $mail->Body = $myvar;
                      foreach($emailarray as $email) {
                      $mail->AddAddress($email);
                      }
                     if(!$mail->Send()) {
                        echo "Mail Error: " . $mail->ErrorInfo;
                     }
        }
        //start post
        if(!empty($_POST)) 
        { 
        //filter input
        //$_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if($_POST['action'] == "getemails_regions") {
                $id = test_input($_POST['id']);
                $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region = :region");
                $stmt->bindParam(':region', $_POST['filter']);
                $stmt->execute();
                $emailarray = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $emailarray[] = $row['emailaddress'];
                    }
                    echo json_encode($emailarray);
            }
            if($_POST['action'] == "getemails_rpmo") {
                $id = test_input($_POST['id']);
                $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE designation=:designation");
                $stmt->bindParam(':designation', $_POST['filter']);
                $stmt->execute();
                $emailarray = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $emailarray[] = $row['emailaddress'];
                    }
                    echo json_encode($emailarray);
            }
            if($_POST['action'] == "getemails_npmo_all") {
                $id = test_input($_POST['id']);
                $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE region ='NPMO'");
                $stmt->execute();
                $emailarray = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $emailarray[] = $row['emailaddress'];
                    }
                    echo json_encode($emailarray);
            }
            if($_POST['action'] == "getemails_npmo") {
                $id = test_input($_POST['id']);
                $stmt = $db->prepare("SELECT emailaddress FROM hr_db m LEFT JOIN HRgroups n ON m.id=n.hr_dbid WHERE m.region ='NPMO' AND n.groupname=:groupname");
                $stmt->bindParam(':groupname', $_POST['filter']);
                $stmt->execute();
                $emailarray = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $emailarray[] = $row['emailaddress'];
                    }
                    echo json_encode($emailarray);
            }
            if($_POST['action'] == "getemails_individual") {
                $id = test_input($_POST['id']);
                $stmt = $db->prepare("SELECT emailaddress FROM hr_db WHERE id=:id ");
                $stmt->bindParam(':id', $_POST['filter']);
                $stmt->execute();
                $emailarray = [];
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $emailarray[] = $row['emailaddress'];
                    }
                    echo json_encode($emailarray);
            }
            if($_POST['action'] == "updatecomm") {
              $dt=date("Y-m-d");
                $stmt = $db->prepare("UPDATE doc_comments SET doc_comment=:dcom, added=:added, hrdbid=:hrdbid1 WHERE id=:id");
                $stmt->bindParam(':id', $_POST['docdbid']);
                $stmt->bindParam(':dcom', $_POST['dcom']);
                $stmt->bindParam(':added', $dt);
                $stmt->bindParam(':hrdbid1', $_SESSION['id']);
                $stmt->execute();
                echo "edited";
            }
            if($_POST['action'] == "deletecomm") {
                $stmt = $db->prepare("DELETE FROM doc_comments WHERE id=:id ");
                $stmt->bindParam(':id', $_POST['docdbid']);
                $stmt->execute();
                echo "deleted";
            }
             if($_POST['action'] == "comment") {
                $id = test_input($_POST['id']);
                $stmt = $db->prepare("INSERT INTO doc_comments (docdbid,doc_comment,added,hrdbid) VALUES (:docdbid,:doc_comment,:added,:hrdbid)");
                $stmt->bindParam(':docdbid', $_POST['docdbid']);
                $stmt->bindParam(':doc_comment', $_POST['comment']);
                $stmt->bindParam(':added', date("Y-m-d",time() + 86400));
                $stmt->bindParam(':hrdbid', $_SESSION['id']);
                $stmt->execute();
                byteMe($_SESSION['id'],'comment',0.25);
                echo "commented";
            }
            if($_POST['action'] == "editdetails") {
                $id = test_input($_POST['docdbid']);
                $doctype = test_input($_POST['doctype']);
                $title = test_input($_POST['docsubject']);
                $ddate = test_input($_POST['docdate']);
                $remarks = test_input($_POST['remarks']);
                $stmt = $db->prepare("UPDATE doc_db SET doctype=:doctype, title=:title, docdate=:docdate, remarks=:remarks WHERE id=:id");
                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':doctype', $doctype);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':docdate', $ddate);
                $stmt->bindParam(':remarks', $remarks);
                $stmt->execute();
                echo "edited";
            }
            if($_POST['action'] == "delete") {
                $docid = test_input($_POST['docdbid']);
                $stmt = $db->prepare("DELETE FROM doc_db WHERE id=:id ");
                $stmt->bindParam(':id', $docid);
                $stmt->execute();
                $stmt = $db->prepare("DELETE FROM notifications WHERE docdbid=:id");
                $stmt->bindParam(':id', $docid);
                $stmt->execute();
                $direc = $_SERVER['DOCUMENT_ROOT']."/docs/".$_POST['docfilename'];
                unlink($direc);
                echo "deleted";
            }
            if($_POST['action'] == "reupload") {
                    $ext=date("mdY");
                    $maxsize=9000000;
                    $FILE_EXTS = array('pdf','jpg','jpeg','png','xls','xlsx','doc','docx','zip');
                    $file_name = $_FILES['file']['name'];
                    $file_name = preg_replace("/ /", "-", $file_name);
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $file_size = $_FILES['file']['size'];
                    if($file_name=="") {
                      die("No file selected");
                    }
                    if (!in_array($file_ext, $FILE_EXTS)){
                      die("Selected file is invalid.");
                    }
                    if($_FILES['file']['size']>$maxsize) {
                        die("Filesize exceeded");
                    }
                    $uploaddir = upload_dir();
                    $uploadname = $ext.'_'.$_FILES['file']['name'];
                    $uploadfile = $uploaddir.$uploadname;
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                        try {
                            $stmt = $db->prepare("UPDATE doc_db SET filename=:filename, filesize=:filesize WHERE id=:id");
                            $stmt->bindParam(':id', $_POST["docdbid"]);
                            $stmt->bindParam(':filename', $uploadname);
                            $stmt->bindParam(':filesize', $file_size);
                            $stmt->execute();
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                    $direc = $_SERVER['DOCUMENT_ROOT']."/docs/".$_POST['docfilename'];
                    unlink($direc);
                    echo "Success";
            }
            if($_POST['action'] == "resend") {
                    $uploadname = $_POST['docfilename'];
                    $doctype = $_POST['doctype'];
                    sendEmail($_POST['docid'],$uploadname,$doctype);
                    byteMe($_SESSION['id'],'resend',1);
                    echo "Success";
            }
            if($_POST['action'] == "countDL") {
                $docdbidz = test_input($_POST["docdbid"]);  
                    try {
                            $stmt = $db->prepare("UPDATE doc_db SET downloads=downloads+1 WHERE id=:id");
                            $stmt->bindParam(':id', $docdbidz);
                            $stmt->execute();
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    byteMe($_SESSION['id'],'dl',0.10);
                    echo "counted";
            }
              if($_POST['action'] == "upload") {
                    $ext=date("mdY");
                    $maxsize=9000000;
                    $FILE_EXTS = array('pdf','jpg','jpeg','png','xls','xlsx','doc','docx','zip', 'ppt','pptx');
                    $file_name = $_FILES['file']['name'];
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $file_size = $_FILES['file']['size'];
                    if($file_name=="") {
                      die("No file selected");
                    }
                    if (!in_array($file_ext, $FILE_EXTS)){
                      die("Selected file is invalid.");
                    }
                    if($_FILES['file']['size']>$maxsize) {
                        die("Filesize exceeded");
                    }
                    $uploaddir = upload_dir();
                    $uploadname = $ext.'_'.$_FILES['file']['name'];
                    $uploadfile = $uploaddir.$uploadname;
                    if (file_exists($uploadfile)) {
                        die("Duplicate found. This file already exists.");
                    }
                    if (empty($_POST["docsubject"])) {
                         die("Missing Subject");
                    } else {
                         $subject = test_input($_POST["docsubject"]);
                    }
                    if ($_POST['docauthor']=="") {
                      $author = $_SESSION['id'];
                    } else {
                      $author = test_input($_POST["docauthor"]);  
                    }
                    $doctype = $_POST['doctype'];
                    $parts = explode('/', $_POST['resdate']);
                    $resdate  = "$parts[2]-$parts[0]-$parts[1]";
                    $parts = explode('/', $_POST['ddate']);
                    $dateondoc  = "$parts[2]-$parts[0]-$parts[1]";
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
                        try {
                            $stmt = $db->prepare("INSERT IGNORE INTO doc_db (doctype,title,author,filename,filesize,remarks,added,hrdbid,admindoctype,logtype,referenceno,sourceoffice,sourcename,sourcepos,destoffice,destname,destpos,datereceived,docdate) VALUES (:doctype,:title,:author,:filename,:filesize,:remarks,:added,:hrdbid,:admintype,:logtype,:refnumber,:sourceoffice,:sourcename,:sourcepos,:destoffice,:destname,:destpos,:resdate,:docdate)");
                            $stmt->bindParam(':doctype', $doctype);
                            $stmt->bindParam(':title', $_POST['docsubject']);
                            $stmt->bindParam(':author', $_POST['author']);
                            $stmt->bindParam(':filename', $uploadname);
                            $stmt->bindParam(':filesize', $file_size);
                            $stmt->bindParam(':remarks', $_POST['remarks']);
                            $stmt->bindParam(':added', date("Y-m-d",time() + 86400));
                            $stmt->bindParam(':hrdbid', $_SESSION['id']);
                            $stmt->bindParam(':admintype', $_POST['admintype']);
                            $stmt->bindParam(':logtype', $_POST['logtype']);
                            $stmt->bindParam(':refnumber', $_POST['refnumber']);
                            $stmt->bindParam(':sourceoffice', $_POST['sourceoffice']);
                            $stmt->bindParam(':sourcename', $_POST['sourcename']);
                            $stmt->bindParam(':sourcepos', $_POST['sourcepos']);
                            $stmt->bindParam(':destoffice', $_POST['destoffice']);
                            $stmt->bindParam(':destname', $_POST['destname']);
                            $stmt->bindParam(':destpos', $_POST['destpos']);
                            $stmt->bindParam(':resdate', $resdate);
                            $stmt->bindParam(':docdate', $dateondoc);
                            $stmt->execute();
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                  if ($_POST['switch']>0) {
                        $refid = $db->lastInsertId();
                        sendEmail($refid,$uploadname,$doctype);
                        byteMe($_SESSION['id'],'upload',3);
                        echo "Success";
                  } else {
                    echo "Success";
                  }
                    }
            }
            if($_POST['action'] == "reuploadadmin") {
                    $ext=date("mdY");
                    $maxsize=9000000;
                    $FILE_EXTS = array('pdf','jpg','jpeg','png','xls','xlsx','doc','docx','zip');
                    $file_name = $_FILES['file']['name'];
                    $file_name = preg_replace("/ /", "-", $file_name);
                    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                    $file_size = $_FILES['file']['size'];
                    if($file_name=="") {
                      die("No file selected");
                    }
                    if (!in_array($file_ext, $FILE_EXTS)){
                      die("Selected file is invalid.");
                    }
                    if($_FILES['file']['size']>$maxsize) {
                        die("Filesize exceeded");
                    }
                    $uploaddir = upload_dir();
                    $uploadname = $ext.'_'.$_FILES['file']['name'];
                    $uploadfile = $uploaddir.$uploadname;
                        try{
                               $edit = $db->prepare("Select filename from doc_db where id=:idoc");
                                $edit->bindParam(':idoc',$_SESSION['editid']);
                                $edit->execute();
                                   $edit_row = $edit->fetch(PDO::FETCH_ASSOC);
                                unlink('/SLP.PH22
                                    /docs/'.$edit_row['filename']);
                            }catch(PDOException $e){
                              echo "Error. ". $e->getMessage();
                            }
                    $parts = explode('/', $_POST['resdate']);
                    $resdate  = "$parts[2]-$parts[0]-$parts[1]";
                    $parts = explode('/', $_POST['ddate']);
                    $dateondoc  = "$parts[2]-$parts[0]-$parts[1]";
                    if(is_uploaded_file($_FILES['file']['tmp_name'])) {
                        try {
                            move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
                            $stmt = $db->prepare("UPDATE doc_db SET doctype=:doctype, title=:title, author=:author, filename=:filename, filesize=:filesize, remarks=:remarks, added=:added, hrdbid=:hrdbid, admindoctype=:admintype, logtype=:logtype,referenceno=:refnumber,sourceoffice=:sourceoffice,sourcename=:sourcename,sourcepos=:sourcepos,destoffice=:destoffice, destname=:destname,destpos=:destpos,datereceived=:resdate,dateondoc=:dateondoc,lastedited=:lastedited WHERE id=:id"); 
                            $stmt->bindParam(':id', $_SESSION['editid']);
                            $stmt->bindParam(':doctype', $_POST['doctype']);
                            $stmt->bindParam(':title', $_POST['docsubject']);
                            $stmt->bindParam(':author', $_POST['author']);
                            $stmt->bindParam(':filename', $uploadname);
                            $stmt->bindParam(':filesize', $file_size);
                            $stmt->bindParam(':remarks', $_POST['remarks']);
                            $stmt->bindParam(':added', date("Y-m-d",time() + 86400));
                            $stmt->bindParam(':hrdbid', $_SESSION['id']);
                            $stmt->bindParam(':admintype', $_POST['admintype']);
                            $stmt->bindParam(':logtype', $_POST['logtype']);
                            $stmt->bindParam(':refnumber', $_POST['refnumber']);
                            $stmt->bindParam(':sourceoffice', $_POST['sourceoffice']);
                            $stmt->bindParam(':sourcename', $_POST['sourcename']);
                            $stmt->bindParam(':sourcepos', $_POST['sourcepos']);
                            $stmt->bindParam(':destoffice', $_POST['destoffice']);
                            $stmt->bindParam(':destname', $_POST['destname']);
                            $stmt->bindParam(':destpos', $_POST['destpos']);
                            $stmt->bindParam(':resdate', $resdate);
                            $stmt->bindParam(':dateondoc', $dateondoc);
                            $stmt->bindParam(':lastedited', $_SESSION['id']);
                            $stmt->execute();
                        } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                    }
                 //  $direc = $_SERVER['DOCUMENT_ROOT']."/SLP.22/docs/".$uploadname;
                  //  unlink($direc);
                    echo "Success";
            }
        }//end post
?>
