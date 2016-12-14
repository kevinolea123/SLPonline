<?php
require "../zxcd9.php";
function upload_dir(){
  $dir = $_SERVER['PHP_SELF'];
  for($i=0;$i<strlen($dir);$i++){
  if(substr($dir,$i,1)=="/") $slashpos=$i;
  }
  $dir = substr($dir,0,$slashpos);
  $dir = $_SERVER['DOCUMENT_ROOT']."/docs/";
  return($dir);
}
  $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
  $_SESSION['uid'] = $_GET['id'];
  $involved = [];
    $query = " 
            SELECT m.hrdbid FROM hr_RVtags m LEFT JOIN hr_db t ON m.hrdbid = t.id
            WHERE 
            m.roverid = :rovid
            AND
            m.hrdbid = :hrdbid
        "; 
        $query_params = array( 
            ':rovid' => $_GET['id'], 
            ':hrdbid' => $_SESSION['id']
        ); 
        try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) 
        { die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $istagged = false;
        if( $stmt->rowCount() > 0) {
          $istagged = true;
        }
    $query = " 
            SELECT 
                m.id, 
                m.startdate, 
                m.starttime, 
                m.enddate, 
                m.endtime, 
                m.event, 
                m.venue, 
                m.remarks, 
                m.added, 
                m.addedby, 
                CONCAT(t.lastname, ', ', t.firstname) as name, 
                z.filename 
            FROM hr_rover m 
            LEFT JOIN hr_db t
            ON m.addedby = t.id
            LEFT JOIN doc_db z
            ON m.id=z.roverid
            WHERE 
                m.id = :id
        "; 
        $query_params = array( 
            ':id' => $_GET['id'] 
        ); 
       try 
        { $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) 
        { die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
        $owner = $row['addedby'];
        $involved[] = $owner;
        $parts = explode('-', $row['startdate']);
        $stdate  = "$parts[1]/$parts[2]/$parts[0]";
        $sdate  = "$parts[1]/$parts[2]";
        $parts = explode('-', $row['enddate']);
        $endate  = "$parts[1]/$parts[2]/$parts[0]";
        $edate  = "$parts[1]/$parts[2]";
       if ($_SESSION['id'] == $row['refid']) {
          $isdisabled = "";
        } else {
          $isdisabled = "disabled";
        }
if( isset($_POST['submit']) ){
    $file_name = $_FILES['uploadbtn']['name'];
    if($file_name=="") {
      die("No file selected");
    } else {
      $maxsize=50480000;
      $upl=1;
      $ext=date("mdY");
      $FILE_EXTS = array('pdf','jpg','jpeg','xls','xlsx','doc','docx');
      $file_name = $_FILES['uploadbtn']['name'];
      $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
      $file_size = $_FILES['uploadbtn']['size'];
      if (!in_array($file_ext, $FILE_EXTS)){
        die("Selected file is invalid.");
      }else{
        if($_FILES['uploadbtn']['size']>$maxsize){
            $upl=0;
            die("Filesize exceeded");
        }
        if($upl==1){
          $uploaddir = upload_dir();
          $uploadfile = $uploaddir.$ext.'_'.$_FILES['uploadbtn']['name'];
          if(move_uploaded_file($_FILES['uploadbtn']['tmp_name'], $uploadfile)){
              ?>
              <script>alert("Success!")</script>
              <?php
          $title = test_input($_POST['dsubject']);
          try {
            // prepare sql and bind parameters
            $stmt = $db->prepare("INSERT INTO doc_db (doctype,title,filename,filesize,remarks,added,hrdbid,roverid) 
            VALUES (:doctype,:title,:filename,:filesize,:remarks,:added,:hrdbid,:roverid)");
            $stmt->bindParam(':doctype', $type);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':filesize', $file_size);
            $stmt->bindParam(':remarks', $remarks);
            $stmt->bindParam(':added', $added);
            $stmt->bindParam(':hrdbid', $hrdbid);
            $stmt->bindParam(':roverid', $roverid);
                        // insert a row
            $type = $_POST['fileclass'];
            $filename = $ext.'_'.$_FILES['uploadbtn']['name'];
            $filetype = $file_ext;
            $remarks = $_POST['fileremarks'];
            $added = date("Y-m-d");
            $hrdbid = $_SESSION['id'];
            $roverid = $_GET['id'];
            $stmt->execute();
            }
          catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            }
            $refid = $db->lastInsertId();
          foreach($_SESSION['involved'] as $recip) {
                      if ($recip != $_SESSION['id']) {
                          addNotification($recip, $_SESSION['firstname'], "uploaded a file to", "ROVER", "http://slp.ph/hr/viewrover.php?id=".$_GET['id']);
                      }
                  }
            $_POST['submit'] == null;
            $_FILES['uploadbtn'] == null;
          }
        }//end if upload=1
      }//endifelse
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | HR</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" href="http://slp.ph/css/pikaday.css"/>
    <link rel="stylesheet" type="text/css" href="../css/DTbootstrap.css">
    <link href="../css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="../css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
    <style>
body {
    background-color: #f7f9fb;
    background-size: cover;
    font-family: "Lato";
}
.navbar-nav > li > a, .navbar-brand {
    padding-top:15px !important; 
    padding-bottom:0 !important;
    height: 45px;
}
.navbar {
  margin-bottom: 0
}
.navbar {min-height:45px !important;background-color: #000}
#bootstrapSelectForm .selectContainer .form-control-feedback {
    right: -15px;
}
.slidedown {
  -webkit-transform: scaleY(0);
       -o-transform: scaleY(0);
      -ms-transform: scaleY(0);
          transform: scaleY(0);
   -webkit-transform-origin: top;
       -o-transform-origin: top;
      -ms-transform-origin: top;
          transform-origin: top;
   -webkit-transition: -webkit-transform 0.2s ease;
            -o-transition: -o-transform 0.2s ease;
          -ms-transition: -ms-transform 0.2s ease;
                  transition: transform 0.2s ease;
}
.slidedown.active {
  -webkit-transform: scaleY(1);
       -o-transform: scaleY(1);
      -ms-transform: scaleY(1);
          transform: scaleY(1);
}
.successcontent {
  display:none;
}
.cleanselect {
  -webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;appearance:none;background:#fff url(arrows.png) no-repeat right 9px;
}
.form-control {
  margin-bottom: 1em
}
.custom-date-style {
  background-color: red !important;
}
.input{ 
}
.input-wide{
  width: 500px;
}
table a:not(.btn), .table a:not(.btn) {
  text-decoration: none;
}
.btn:hover, .btn:focus, .btn.focus {
  color: #000;
}
.disabled {
  background:rgba(1,1,1,0.2);
  border:0px solid;
  cursor:progress;
}
.spin {
  -webkit-animation: spin 1000ms infinite linear;
  -moz-animation: spin 1000ms infinite linear;
  -o-animation: spin 1000ms infinite linear;
  animation: spin 1000ms infinite linear;
}
@-moz-keyframes spin {
  from {
    -moz-transform: rotate(0deg);
  }
  to {
    -moz-transform: rotate(360deg);
  }
}
@-webkit-keyframes spin {
  from {
    -webkit-transform: rotate(0deg);
  }
  to {
    -webkit-transform: rotate(360deg);
  }
}
@keyframes spin {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
#slideout {
      z-index: 998;
      position: fixed;
      top: 25%;
      right: 0;
      width: 35px;
      padding: 12px 0;
      text-align: center;
      background: #5cb85c;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-border-radius: 5px 0px 0px 5px;
      -moz-border-radius: 5px 0px 0px 5px;
      border-radius: 5px 0px 0px 5px;
    }
    #slideout_inner {
      z-index: 999;
      position: fixed;
      top: 25%;
      right: -250px;
      background: #5cb85c;
      width: 250px;
      padding: 0;
      height: 170px;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      text-align: left;
      -webkit-border-radius: 0px 0 0px 5px;
      -moz-border-radius: 0px 0 0px 5px;
      border-radius: 0px 0 0px 5px;
    }
    #slideout_inner textarea {
      z-index: 999;
      margin-right: 5px;
      width: 210px;
      height: 100px;
      margin-bottom: 6px;
    }
    #slideout:hover {
      z-index: 999;
      right: 250px;
    }
    #slideout:hover #slideout_inner {
      z-index: 999;
      right: 0;
    }
    tbody tr {
  cursor: pointer;
}
.autocomplete-suggestions { cursor:pointer;border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { cursor:pointer;padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>
</head>
<body>
  <div id="slideout">
    <img src="http://img.usabilitypost.com.s3.amazonaws.com/1104/css_slideout/feedback.png" alt="Feedback" />
    <div id="slideout_inner">
      <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;"></span>
      <div id="formz">
      <form>
          <div class="form-group">
            <div class="col-sm-12">
                <textarea name="feedback" class="form-control" id="feedback" placeholder="Any comments or suggestions are welcome!" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3"></textarea>
            </div>
          </div>
      </form>
          <div class="form-group">
              <button class="btn btn-primary" id="sendfeedback" style="padding:4px;margin-left:1em">Submit</button>
          </div>
       </div>
    </div>
  </div>
<?php
include "../nav.php";
if( $stmt->rowCount() <= 0) {
    die("<div class='col-md-12'><center><h2>Oops!</h2>This user / record does not exist.<br><br><a href='index.php'><button class='btn btn-primary'>Go Back</button></a></center></div>");
}
?>
<div class="container-fluid"><br>
  <div class="row">
    <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <div class="row">
          <div class="col-md-10" style="background:#fff;">
            <b><font size="4"><?php echo $row['venue'] ?></font></b>
            <br>
            <script>
            function toTitleCase(str) {
                return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
                }
            </script>
            <span style="color:#999;">
              <?php echo $row['event']; ?><br>
              with 
              <?php 
                $stmt = $db->prepare("SELECT t.id, t.firstname FROM hr_RVtags m LEFT JOIN hr_db t ON m.hrdbid=t.id WHERE m.roverid = :roverid");
                $stmt->bindParam(':roverid', $_GET['id']);
                $stmt->execute();
                $rowCount = 0;
                while ($row9 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                  $rowCount++;
                  if ($_SESSION['id']!=$row9[0]) {
                    if($rowCount == $stmt->rowCount()) {
                      $involved[] = $row9[0];
                ?>
                <script>document.write(toTitleCase('<?php echo $row9[1]; ?>'));</script>
                <?php
                    } else {
                      ?>
                     <script>document.write(toTitleCase('<?php echo $row9[1].", "; ?>'));</script> 
                      <?php
                    }
                  }
                }
                $involved[] = 683;
                $involved[] = 332;
                $involved[] = 334;
                $_SESSION['involved'] = $involved;
              ?>
              <br>
            </span>
              <br>
              <b style=>"</b><?php echo $row['remarks'];?><b>"</b>
              <br><br>
              <div class="row" style="margin-bottom:1em;padding-left:0">
                <div class="col-md-6">
                  <b><span class="glyphicon glyphicon-file"></span> Files attached:</b><br>
                </div>
              </div>
              <div class="col-md-8">
              <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;width:100%">
                      <thead>
                        <tr>
                          <th colspan=""></th>
                          <th colspan="">Type</th>
                          <th colspan="">File</th>
                          <th colspan="3">Approval</th>
                        </tr>
                        <tr style="display:none">
                          <th>id</th>
                          <th>Type</th>
                          <th>File</th>
                          <th>Approval</th>
                          <th></th>
                          <th></th>
                        </tr>
                      </thead>
                </table>
                </div>
                <script>
                function parseDate(str) {
                  var zz = moment(str).format("D MMM");
                  var t = str.split("-");
                  var d = t[1]+"/"+t[2];
                  return zz;
                }
                function parseImg(str) {
                  if (str=="AM") {

                }
                }
                function approveFile(str) {
                  var formData = {
                              'action'                : 'approve',
                              'docid'                 : str
                            };
                    $.ajax({
                                   url: "fileFunctions.php",
                                   type: "POST",
                                   data: formData,
                                   success: function(data)
                                   {
                                      if (data == "good") {
                                        alert("Successfully approved!");
                                        window.location.reload();
                                      } else {
                                        alert(data);
                                      }
                                      return false;
                                   }
                                });//endAjax
                }
                 function deleteFile(str) {
                    var formData = {
                              'action'                : 'delete',
                              'docid'                 : str
                            };
                    var r = confirm("You are about to delete a record. This will be recorded. Are you sure?");
                    if (r == true) {
                                $.ajax({
                                   url: "fileFunctions.php",
                                   type: "POST",
                                   data: formData,
                                   success: function(data) {
                                      if (data == "good") {
                                        alert("Successfully deleted!");
                                        window.location.reload();
                                      } else {
                                        alert(data);
                                      }
                                      return false;
                                   }
                                });//endAjax
                    }
                    }
                function deleteComment(str) {
                    var formData = {
                              'action'                : 'delete_comment',
                              'docid'                 : str
                            };
                            console.log(formData);
                    var r = confirm("You are about to delete a comment. This will be recorded. Are you sure?");
                    if (r == true) {
                                $.ajax({
                                   url: "fileFunctions.php",
                                   type: "POST",
                                   data: formData,
                                   success: function(data) {
                                      if (data == "good") {
                                        alert("Successfully deleted!");
                                        window.location.reload();
                                      } else {
                                        alert(data);
                                      }
                                      return false;
                                   }
                                });//endAjax
                    }
                    }
                hasaccess = '<?php if($_SESSION["id"]==9 || $_SESSION["id"]==683 || $_SESSION["id"]==333 || $_SESSION["id"]==334) { echo "yes"; } ?>';
                var oTable = $('#viewdata').dataTable({
                  "aProcessing": true,
                  "aServerSide": true,
                  "orderCellsTop": true,
                  "ajax": "dt_files.php",
                  "dom": '<"top">rt<"bottom"><"clear">',
                  "language": {
                    "emptyTable": "No files are attached.."
                  },
                  "fnRowCallback":
                    function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                      $(nRow).attr('id', aData[0]);
                      return nRow;
                    },
                  "aoColumnDefs": [
                          { 
                             "aTargets":[2],
                              "mData": null,
                              "mRender": function( data, type, full) {
                                  if (data[3]==0) {
                                    if (data[1]=="Program Flow") {
                                      return '<td><a href="http://slp.ph/docs/'+data[2]+'" download style="color:blue">'+data[2]+'</a></td>';
                                    } else {
                                      return '<td>'+data[2]+'</td>';
                                    }
                                  } else {
                                    return '<td><a href="http://slp.ph/docs/'+data[2]+'" download style="color:blue">'+data[2]+'</a></td>';
                                  }
                              }
                          },
                          { 
                             "aTargets":[3],
                              "mData": null,
                              "mRender": function( data, type, full) {
                                  if (data[3]==0) {
                                    if (data[1]=="Program Flow") {
                                      return '<td><a href="http://slp.ph/docs/'+data[2]+'" download style="color:blue">'+data[2]+'</a></td>';
                                    } else {
                                        if (hasaccess == "yes") {
                                          return '<td><a href="http://slp.ph/docs/'+data[2]+'" download style="color:blue">'+data[2]+'</a></td>';
                                        } else {
                                          return '<td>'+data[2]+'</td>';
                                        }
                                    }
                                  } else {
                                    return '<td><a href="http://hr.slp.ph/docs/'+data[2]+'" download style="color:blue">'+data[2]+'</a></td>';
                                  }
                              }
                          },
                          { 
                             "aTargets":[4],
                             "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                              {
                                  $(nTd).css('text-align', 'center');
                              },
                              "mData": null,
                              "mRender": function( data, type, full) {
                                    if (data[3]>=1) {
                                      return '<td> - </td>';
                                    } else {
                                      if (data[1]=="Program Flow") {
                                        return '<td> - </td>';
                                      } else {
                                        return '<td><span id="'+data[0]+'" onclick="approveFile('+data[0]+')" class="label label-primary">Approve</span></td>';
                                      }
                                    }
                              }
                          },
                          { 
                             "aTargets":[5],
                             "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                              {
                                  $(nTd).css('text-align', 'center');
                              },
                              "mData": null,
                              "mRender": function( data, type, full) {
                                        return '<td><span onclick="deleteFile('+data[0]+')" class="label label-danger">Delete</span></td>';

                              }
                          },
                          { "bVisible": false, "aTargets":[<?php if ($_SESSION['id']==9 || $_SESSION['id']==683 || $_SESSION["id"]==333 || $_SESSION["id"]==334) { echo "0"; } else if ($_SESSION['id']==$owner) { echo "0,4"; } else { echo "0,4,5"; } ?>] }
                                  ]
                });
              </script>
              <br>
            </span>
          </div>
          <div class="col-md-2" style="text-align:right">
            Created by: <b><?php echo $row['name'];?></b>
              <br>
            <span style="color:#999;font-size:20px">
              <?php
                echo $sdate." - ".$edate;
              ?>
            </span>
          </div>
        </div><!--end row-->
        <div class="row" style="margin-top:1em">
          <?php
            if ($_SESSION['id']==9 || $_SESSION['id']==683 || $_SESSION['id']==$owner || $istagged == true || $_SESSION["id"]==333 || $_SESSION["id"]==334) {
          ?>
          <div class="col-md-6">
              <b>Comments:</b><br>
              <?php
              $stmt = $db->prepare("SELECT m.comment, t.firstname, DATE_FORMAT(DATE_ADD(m.added, INTERVAL 8 HOUR), '%m/%d/%y %h:%i %p'), m.id FROM hr_RVcomments m LEFT JOIN hr_db t ON m.addedby=t.id WHERE roverid = :roverid");
              $stmt->bindParam(':roverid', $_GET['id']);
              $stmt->execute();
              while ($row7 = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                    echo nl2br($row7[0])." <b style='color:#00ADDe'>".$row7[1]."</b> (".$row7[2].")";
                    if ($_SESSION['id']==9 || $_SESSION['id']==683) {
                      echo ' <span id="'.$row7[3].'" class="label label-danger" onclick="deleteComment(this.id)" style="cursor:pointer">Delete</span>';
                    }
                    echo "<br><br>";
              }
              if ($stmt->rowCount() <= 0) {
                echo "None";
              }
              echo "<br><br>";
              ?>
              <div class="form-group" style="margin-left:1em;margin-right:1em;margin-bottom:0;display:none;" id="commentsbox">
                      <textarea name="comment" class="form-control" id="comment" placeholder="Comments" style="resize:none;padding-top:8px;padding-bottom:4px;" rows="3"></textarea>
                      <button class="btn btn-primary" id="postcomment">Post Comment</button>
              </div>
          </div>
          <?php
            }
          ?>
        </div>
        <div class="row" style="padding:1em">
          <?php
                if ($_SESSION['permlvl'] > 0 || $_SESSION['id'] == $owner || $istagged==true || $_SESSION[id]==683) {
                  echo '<div class="pull-right"><button class="btn btn-info" style="padding:5px;margin-top:1em" id="attachbtn"><span class="glyphicon glyphicon-arrow-up"></span> &nbsp;Attach File</button>&nbsp; <div class="pull-right"><button class="btn btn-primary" style="padding:5px;margin-top:1em" id="commentsbtn"><span class="glyphicon glyphicon-text-size"></span> &nbsp;Comments</button>&nbsp; <button class="btn btn-success" style="padding:5px;margin-top:1em" id="editbtn"><span class="glyphicon glyphicon-cog"></span> &nbsp;Edit</button>&nbsp;';
                }
                if ($_SESSION['permlvl'] > 0 || $_SESSION['id'] == $owner) {
                  echo '<button class="btn btn-danger" id="deleterecord" style="padding:5px;margin-top:1em"><span class="glyphicon glyphicon-remove"></span> &nbsp;Delete</button>&nbsp;';
                }
                if ($istagged==true) {
                  echo '<button class="btn btn-danger" id="untagrecord" style="padding:5px;margin-top:1em"><span class="glyphicon glyphicon-remove"></span> &nbsp;Untag me</button>';
                }
              ?>
              <a href="http://slp.ph/hr/user.php?id=<?php echo $_SESSION['id']; ?>"><button class="btn btn-warning" style="padding:5px;margin-top:1em">Go Back</button></a></div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6" id="editpanel" style="display:none;">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <form class="form-horizontal" id="editForm" method="post" action="adduser.php" autocomplete="off">
            <div class="form-group" style="margin-left:1em;margin-right:1em">
   <div class="input-group">
      <input type="text" class="form-control" aria-label="..." placeholder="Start Date" id="startdate" name="startdate" >
    <div class="input-group-btn">
      <button id="ampm1" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 2px solid #dce4ec;">AM / PM <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" id="selectampm1">
          <li><a href="javascript:return false;">AM</a></li>
          <li><a href="javascript:return false;">PM</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
</div>
<div class="form-group" style="margin-left:1em;margin-right:1em">
    <div class="input-group">
      <input type="text" class="form-control" aria-label="..." placeholder="End Date" id="enddate" name="enddate" >
      <div class="input-group-btn">
        <button id="ampm2" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 2px solid #dce4ec;">AM / PM <span class="caret"></span></button>
        <ul class="dropdown-menu dropdown-menu-right" id="selectampm2">
          <li><a href="javascript:return false;">AM</a></li>
          <li><a href="javascript:return false;">PM</a></li>
        </ul>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
</div>
      <div class="form-group" style="margin-right:1em;margin-left:1em;margin-bottom:0">
            <select class="form-control cleanselect" name="event" id="event" required>
            <option selected><?php echo $row["event"]; ?></option>
                 <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_event order by hreventname");
                              //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                        
                        while($hreventname=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <option value=" <?php echo $hreventname['hreventname']; ?>"> <?php echo $hreventname['hreventname']; ?> </option>
                      <?php
                        }
                              } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                      ?>
                      </select>
                    <!-- upto this -->                    
                          </div>
                          <div class="form-group" style="margin-left:1em;margin-right:1em;margin-bottom:0">
                              <input type="text" class="form-control" value="<?php echo $row['venue'];?>" id="venue" name="venue">
                          </div>
                          <div class="form-group" style="margin-left:1em;margin-right:1em;margin-bottom:0">
                              <textarea name="remarks" maxlength="255" class="form-control" id="remarks" placeholder="Remarks" style="resize:none;padding-top:8px;padding-bottom:4px;" rows="3"><?php echo $row['remarks'];?></textarea>
                          </div>
                          <div class="form-group" style="margin-left:1em;margin-right:1em">
                              <input type="text" name="autocompleteajax" id="autocompleteajax" class="form-control" placeholder="Tag other people.."/>
                              <input type="hidden" id="autocomplete-ajax-x" disabled="disabled"/>
                          </div>
                              <span id="tagpart" style="padding-left:5px;display:none;margin-left:1em;margin-right:1em">Tagged:</span>
                          <div class="form-group" style="margin-bottom:0.2em;margin-left:1em;margin-right:1em" id="idg">
                              <input name="subsector" id="subsector" value="" type="">
                          </div>
  </form>
        <button id="addrover" class="btn btn-success pull-right" style="margin-right:1em">Save Changes</button>
      </div>
    </div>
    <div class="col-md-6" id="uploadpanel" style="display:none;">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <h2 style="font-weight:bold">Attach Files</h2>
            <form id="form1" method="POST" action="" enctype="multipart/form-data">
                    <div class="input-group" style="margin-right:1em;margin-left:1em;margin-bottom:0">
                      <input id="uploadfilename" class="form-control" placeholder="Choose file.." disabled="disabled">
                      <div class="input-group-btn">
                        <div class="fileUpload btn btn-primary">
                            <span><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Choose File</span>
                            <input id="uploadbtn" name="uploadbtn" type="file" class="upload" required/>
                        </div>
                      </div>
                    </div><!-- /input-group -->
                    <span style="font-size:12px;margin-left:1em;margin-bottom:1em">Supported file types: PDF, DOC, XLSX, PNG, JPG</span>
                    <span style="font-size:12px;margin-right:1em;margin-bottom:1em" class="pull-right">Maximum file size: 5MB</span><br>
                    <div class="form-group" style="margin-right:1em;margin-left:1em;margin-bottom:0;margin-top:1em">
                        <select class="form-control cleanselect" name="fileclass" id="fileclass" required>
                          <option value="">Select Document Type</option>
                     <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_doctype order by hrdocname");
                              //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                      while($hrdocname=$sql->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                        <option value=" <?php echo $hrdocname['hrdocname']; ?>"> <?php echo $hrdocname['hrdocname']; ?> </option>
                      <?php }
                       if ($_SESSION['permlvl']>0) { 
                        ?>
                        <option>Blast</option>
                        <?php
                        }
                              } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                        ?>
                      </select>
                   <!--   upto this      -->     
                    </div>
                    <div class="form-group" style="margin-top:1em;margin-left:1em;margin-right:1em;" id="docsubject">
                      <input class="form-control" placeholder="Document Title / Subject" style="" id="dsubject" name="dsubject" required/><center>
                  </div>
                  <div class="form-group" style="margin-top:1em;margin-left:1em;margin-right:1em;" id="docdate">
                      <input class="form-control" placeholder="Date Written / Created" style="" id="ddate" name="ddate" required/><center>
                  </div>
                  <div class="form-group" style="margin-right:1em;margin-left:1em;margin-bottom:0">
                      <input type="text" class="form-control" placeholder="Remarks" id="fileremarks" name="fileremarks">
                  </div>
                      <button id="submit" name="submit" class="btn btn-info pull-right" type="submit" style="margin-right:1em">Upload File</button>
            </form>
      </div>
    </div>
  </div>
<br>
      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
        <div class="modal-dialog modal-sm">
          <div class="modal-content" style="padding:1em;padding-top:0.5em;">
                  <h3 style="color:#5cb85c;margin-bottom:6px">Success!</h3>
                  <span style="font-size:13px" id="sucsubtext">Boom</span><br><br>
                  <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                  <div class="clearfix"></div>
          </div>
        </div>
      </div>
<!-- Modal -->
</div><!--endcontainerfluid-->
<?PhP
$sql = "SELECT id, CONCAT(lastname, ', ', firstname) as name FROM hr_db";
$partnerIDArray = [];
$partnerArray = [];
foreach ($db->query($sql) as $results) {
  $partnerIDArray[] = intval($results["id"]);
  $partnerArray[] = $results["name"];
}
$object = new StdClass;
$i = 0;
foreach ($partnerIDArray as $foo)
{
  $object->$foo = $partnerArray[$i];
  $i++;
}
?>
<script>
  window.selectPartner = "";
  window.taggedPeople = [];
$(function () {
    'use strict';
    var countriesArray = $.map(<?php echo json_encode($object);?>, function (value, key) { return { value: value, data: key }; });
    $('#autocompleteajax').autocomplete({
        lookup: countriesArray,
        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
            var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
            return re.test(suggestion.value);
        },
        onSelect: function(suggestion) {
            window.selectPartner = suggestion.data;
            $('#idg').show();
            $("#subsector").tagit("createTag", suggestion.value);
            $('#autocompleteajax').val('');
            $("#tagpart").show();
            window.taggedPeople.push(suggestion.data);
            console.log(window.taggedPeople);
        },
        onHint: function (hint) {
            $('#autocomplete-ajax-x').val(hint);
        },
        onInvalidateSelection: function() {
            $('#selction-ajax').html('Selected Partner: <b><font color="#e74c3c">none</font></b>');
        }
    });
});
  $('#subsector').tagit({
        readOnly: true,
        onTagClicked: function(evt, ui) {
            var tagname = ($('#subsector').tagit('tagLabel', ui.tag));
            $("#subsector").tagit("removeTagByLabel", tagname);
        }
    });
    $('#idg').hide();
$(document).ready(function() {
document.getElementById("uploadbtn").onchange = function () {
    document.getElementById("uploadfilename").value = this.value;
};
var found3 = [];
    $("select option").each(function() {
        if($.inArray(this.value, found3) != -1) $(this).remove();
        found3.push(this.value);
    });
  time1 = "";
  time2 = "";
  $('#selectampm1 li').on('click', function(){
      time1 = $(this).text();
      $('#ampm1').html(time1 + ' <span class="caret"></span>');
  });
  $('#selectampm2 li').on('click', function(){
      time2 = $(this).text();
      $('#ampm2').html(time2 + ' <span class="caret"></span>');
  });
document.getElementById("startdate").value = '<?php echo $stdate; ?>';
document.getElementById("enddate").value = '<?php echo $endate; ?>';
document.getElementById("ampm1").innerHTML = '<?php echo $row["starttime"]; ?>  <span class="caret"/>';
time1 = document.getElementById("ampm1").value = '<?php echo $row["starttime"]; ?>';
document.getElementById("ampm2").innerHTML = '<?php echo $row["endtime"]; ?>  <span class="caret"/>';
time2 = document.getElementById("ampm2").value = '<?php echo $row["endtime"]; ?>';
$("#addrover").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    errors = 0;
    errorlist = "";
    if ($('input[name=startdate]').val() == "") {
      errors++;
      errorlist = "Please enter start date\n";
    }
    if ($('input[name=enddate]').val() == "") {
      errors++;
      errorlist = errorlist + "Please enter end date\n";
    }
    if (time1 == "") {
      errors++;
      errorlist = errorlist + "Please select time (AM/PM) for start date\n";
    }
    if (time2 == "") {
      errors++;
      errorlist = errorlist + "Please select time (AM/PM) for end date\n";
    }
    if ($('#event option:selected').val() == "") {
      errors++;
      errorlist = errorlist + "Please select event";
    }
    if (errors == 0) {
      $("#addrover").html("Processing..");
      var formData = {
              'id'                 : '<?php echo $_GET["id"]; ?>',
              'startdate'          : $('input[name=startdate]').val(),
              'starttime'          : time1,
              'enddate'            : $('input[name=enddate]').val(),
              'endtime'            : time2,
              'event'              : $('#event option:selected').val(),
              'venue'              : $('input[name=venue]').val(),
              'remarks'            : $('textarea[name=remarks]').val(),
              'subsector'          : window.taggedPeople.toString()
            };
      $.ajax({
                       url: "editrover.php",
                       type: "POST",
                       data: formData,
                       success: function(data) {
                          if (data == "good") {
                            $("#sucsubtext").html("Record edited")
                            $('#myModal').modal();
                            $('#myModal').on('hidden.bs.modal', function () {
                                location.reload();
                            })
                          } else {
                            alert(data);
                          }
                       }
                    });//endAjax
      } else {
        alert(errorlist);
      }
    });
});//end doc ready
</script>
<script>
$(document).ready(function() {
  function parseDate(str) {
                var zz = moment(str).format("D MMM");
                var t = str.split("-");
                var d = t[1]+"/"+t[2];
                return zz;
              }
$("#loadicon").hide();
$("#hrsubmit").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
$("#statusdisp").html('');
$('#editForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT
$("#attachbtn").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#uploadpanel").show();
  location.href = "#uploadpanel";
}); //endattach
$("#commentsbtn").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#commentsbox").show();
  $("#commentsbtn").hide();
}); //endattach
$("#editbtn").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#editpanel").show();
  location.href = "#editpanel";
}); //endedit
$("#postcomment").click(function(event) {
  var formData = {
              'roverid'            : '<?php echo $_GET["id"]; ?>',
              'comment'            : $('textarea[name=comment]').val()
            };
      $.ajax({
                       url: "addcomment.php",
                       type: "POST",
                       data: formData,
                       success: function(data) {
                          if (data == "good") {
                            $("#sucsubtext").html("Comment added")
                            $('#myModal').modal();
                            $('#myModal').on('hidden.bs.modal', function () {
                                location.reload();
                            })
                          } else {
                            alert(data);
                          }
                       }
                    });//endAjax
}); //endedit
$("#goback").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  history.back();
}); //endHRSUBMIT
$("#deleterecord").click(function(event) {
    var r = confirm("You are about to delete a record. This will be recorded. Are you sure?");
    if (r == true) {
      var formData = {
      'id'        : "<?php echo $_GET['id']; ?>"
    };
                $.ajax({
                   url: "delrecord_rover.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                            $("#sucsubtext").html("Deleted successfully")
                            $('#myModal').modal();
                            $('#myModal').on('hidden.bs.modal', function () {
                                history.back();
                            })
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
    }
});
$("#sendfeedback").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    $("#loadicon").show();
    $("#feedback").hide();
    $("#sendfeedback").html('Processing..');
    document.getElementById("sendfeedback").classList.add("disabled");
    document.getElementById("sendfeedback").disabled = true;
    var formData = {
      'page'        : "viewrover",
      'feedback'    : $('textarea[name=feedback]').val(),
      'feedbacker'    : "<?php echo $_SESSION['id']; ?>"
    };
                $.ajax({
                   url: "../sendfeedback.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                        $("#loadicon").hide();
                        document.getElementById("formz").innerHTML = "<div style='padding:10px;color:#fff'><h2>Feedback Sent!</h2>Thank you!</div>"
                      } else {
                        alert(data);
                        $("#loadicon").hide();
                        $("#feedback").show();
                        $("#sendfeedback").html('Submit');
                        document.getElementById("sendfeedback").classList.remove("disabled");
                        document.getElementById("sendfeedback").disabled = false;
                      }
                      return false;
                   }
                });//endAjax
  }); //endHRSUBMIT
$("#untagrecord").click(function(event) {
    var r = confirm("This cannot be undone. Still untag yourself?");
    if (r == true) {
      var formData = {
      'rovid'        : "<?php echo $_GET['id']; ?>",
      'hrid'        : "<?php echo $_SESSION['id']; ?>"
    };
                $.ajax({
                   url: "untag_rover.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                            $("#sucsubtext").html("Untagged")
                            $('#myModal').modal();
                            $('#myModal').on('hidden.bs.modal', function () {
                                history.back();
                            })
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
    }
});
}); //enddocready
</script>
<script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
<script src="http://slp.ph/js/pikaday.min.js"></script>
<script>
    var picker = new Pikaday({ 
      field: $('#ddate')[0], 
      format: 'M/D/YYYY'
    });
    var picker2 = new Pikaday({ 
      field: $('#startdate')[0], 
      format: 'M/D/YYYY'
    });
    var picker3 = new Pikaday({ 
      field: $('#enddate')[0], 
      format: 'M/D/YYYY'
    });
</script>
</body>
</html>
