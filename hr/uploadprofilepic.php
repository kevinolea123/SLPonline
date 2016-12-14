<?php
require "../zxcd9.php";
function upload_dir(){
  $dir = $_SERVER['DOCUMENT_ROOT']."/docs/profilepics/";
  return($dir);
}
if(!empty($_POST)) 
{ 
    if($_POST['action'] == "uploadpics") 
    {

        date_default_timezone_set('Asia/Brunei');
            $ext=date("mdY");
            $maxsize=10000000;
            $FILE_EXTS = array('jpg','jpeg','png', 'bmp', 'JPG', 'JPEG', 'PNG', 'BMP');         
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
            $uploadname = $ext.'_'.$_SESSION['pageid'].'.'.$file_ext;
            $uploadfile = $uploaddir.$uploadname;
            if(move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir."/".$uploadname )) {
            try { 
                      byteMe($_SESSION['id'],'uploadpic',15);
                      $stmt = $db->prepare("INSERT INTO hr_profilepics(hrdbid, name, filename ,dtetme) VALUES (:id, :file, :file1,:dt)");
                      $stmt->bindParam(':id',$_SESSION['pageid']);
                      $stmt->bindParam(':file', $uploadname);
                      $stmt->bindParam(':file1', $file_name );
                      $date2 = date("Y-m-d h:i:sa");
                      $stmt->bindParam(':dt', $date2);
                      $stmt->execute(); 
            } 
            catch(PDOException $e)  {
                      echo "Error: " . $e->getMessage();
            }
            if ($_POST['switch']>0) 
                    {
                          $refid = $db->lastInsertId();
                          sendEmail($refid,$uploadname,$doctype);
                          byteMe($_SESSION['id'],'upload',3);
                          echo "Success";
                    } 
                    else 
                    {
                      echo "Success";
                    }
        }             
        }
    if($_POST['action'] == "reuploadpics") {

        date_default_timezone_set('Asia/Brunei');
            $ext=date("mdY");
            $maxsize=5000000;
             $FILE_EXTS = array('jpg','jpeg','png', 'bmp', 'JPG', 'JPEG', 'PNG', 'BMP');          
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
            $uploadname = $ext.'_'.$file_name;
            $uploadname2 = $ext.'_'.$_SESSION['pageid'].'.'.$file_ext;
            $uploadfile = $uploaddir.$uploadname2;
            try {
                   
                    $edit = $db->prepare("SELECT name FROM hr_profilepics WHERE hrdbid=:hrdbidz");
                    $edit->bindParam(':hrdbidz',$_SESSION['pageid']);
                    $edit->execute();
                    $edit_row = $edit->fetch(PDO::FETCH_ASSOC);
                    unlink($uploaddir.$edit_row['name']);
            } catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
              } 
            if(move_uploaded_file($_FILES['file']['tmp_name'], $uploaddir."/".$uploadname2 )) {
               try {
                      byteMe($_SESSION['id'],'uploadpic',3);
                      $stmt = $db->prepare("UPDATE hr_profilepics SET name=:file, filename=:filez1, dtetme=:dt WHERE hrdbid=:pageid");
                      $stmt->bindParam(':pageid',$_SESSION['pageid']);
                      $stmt->bindParam(':file', $uploadname2);
                      $stmt->bindParam(':filez1', $file_name );
                      $date2 = date("Y-m-d h:i:sa");
                      $stmt->bindParam(':dt', $date2);
                    $stmt->execute();
                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
         echo "Success";
      }
}
?>
