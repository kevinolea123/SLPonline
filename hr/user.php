<?php
require "../zxcd9.php";
  byteMe($_SESSION['id'],'hr_profile',0.10);
  $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
   $_SESSION['uid'] = $_GET['id'];
    $_SESSION['pageid'] = $_GET['id'];
  $query = "SELECT firstname, middlename, lastname, nickname, sex, birthdate, emailaddress, contactnumber, designation, position, employstatus, employdate, fundsource, region, province, municipality, comptype, compyear, compstatus, compnotes, inactive, feeling FROM hr_db WHERE id = :id";
  $query_params = array(':id' => $_GET['id']);
        try { 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params);
        } catch(PDOException $ex) { 
            echo "failed";
            die;
        }
        $row = $stmt->fetch();
        $filter = $row['region'];
        if ($filter == "NPMO") {
          $filter = "";
        }
function timeago($ptime) {
    $etime = time() - $ptime;
    if ($etime < 1){
        return 'just now';
    }
    $a = array( 365 * 24 * 60 * 60  =>  'year',
                 30 * 24 * 60 * 60  =>  'month',
                      24 * 60 * 60  =>  'day',
                           60 * 60  =>  'hour',
                                60  =>  'minute',
                                 1  =>  'second'
                );
    $a_plural = array( 'year'   => 'years',
                       'month'  => 'months',
                       'day'    => 'days',
                       'hour'   => 'hours',
                       'minute' => 'minutes',
                       'second' => 'seconds'
                );
    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" href="../../css/pikaday.css"/>
    <link rel="stylesheet" type="text/css" href="../css/DTbootstrap.css">
    <link href="../css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="../css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <link href="../css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/tag-it.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="../js/jquery.cssemoticons.min.js" type="text/javascript"></script>
    <style>
 #small { font-size: 15px; }
 #large { font-size: 72px; }
 #regular { font-size: 20px; }
 .wrapped { width: 350px; }
body {
    background-color: #f7f9fb;
    background-size: cover;
    font-family: "Lato";
}
.navbar-nav > li > a, .navbar-brand {
    padding-top:15px !important; 
    padding-bottom:0 !important;
    height: 40px;
    
}
.navbar {min-height:45px !important;background-color: #000}
#bootstrapSelectForm .selectContainer .form-control-feedback {
    right: -15px;
}
.disabled {
  background:rgba(1,1,1,0.2);
  border:0px solid;
  cursor:progress;
}
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
.autocomplete-suggestions { cursor:pointer;border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { cursor:pointer;padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }

.spinner {
  margin: 20px auto 0;
  width: 90px;
  text-align: center;
}
.spinner > div {
  width: 20px;
  height: 50px;
  background-color: #333;
  border-radius: 10px;
  display: inline-block;
  -webkit-animation: sk-bouncedelay 1.6s infinite ease-in-out both;
  animation: sk-bouncedelay 1.6s infinite ease-in-out both;
}
.spinner .bounce1 {
    background: red;
  -webkit-animation-delay: -1.2s;
  animation-delay: -1.2s;
}
.spinner .bounce2 {
    background: yellow;
  -webkit-animation-delay: -0.8s;
  animation-delay: -0.8s;
}

.spinner .bounce3 {
    background: blue;
  -webkit-animation-delay: -0.4s;
  animation-delay: -0.4s;
}
@-webkit-keyframes sk-bouncedelay {
  0%, 80%, 100% { -webkit-transform: scale(0) }
  40% { -webkit-transform: scale(1.0) }
}
@keyframes sk-bouncedelay {
  0%, 80%, 100% { 
    -webkit-transform: scale(0.0);
    transform: scale(0.0);
  } 40% { 
    -webkit-transform: scale(2.0);
    transform: scale(1.0);
  }
}
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 999999;
    background-color: rgba(255,255,255,0.8);
    text-align: center;
    vertical-align: middle;
}
.vcenter {
  min-height: 90%;  
  min-height: 90vh; 
  display: -webkit-box;
  display: -moz-box;
  display: -ms-flexbox;
  display: -webkit-flex;
  display: flex; 
      -webkit-box-align : center;
  -webkit-align-items : center;
       -moz-box-align : center;
       -ms-flex-align : center;
          align-items : center;
  width: 100%;
         -webkit-box-pack : center;
            -moz-box-pack : center;
            -ms-flex-pack : center;
  -webkit-justify-content : center;
          justify-content : center;
}
table {
  border-collapse: inherit;
}
.slpdrop {
  margin-bottom:1em;
}
.slpdropsub {
  background: #000;
  color:#fff;
}
.slpdropsub li a {
  background: #000;
  color:#fff;
}
-webkit-tap-highlight-color: rgba(0,0,0,0);
button {
    outline: none;
}
.navbar-default .navbar-nav > .open > a, .navbar-default .navbar-nav > .open > a:hover, .navbar-default .navbar-nav > .open > a:focus {
  background: #000;
}
thead th {
  text-align: center;
  cursor: pointer;
}
h3 {
  font-weight: 400
}
.smallfont {
  font-size: 13px;
}
.btn-sm {
  padding: 4px 8px 4px 8px;
}
.link-hover:hover {
  color:#333;
  cursor: pointer;
}
.dropdown-menu {
    min-width: 0px;
}
tbody tr {
  cursor: pointer;
}
#userdetails table tr td {
  cursor: default;
}
#box {

}
#overlay {  
  position: absolute;
  top: 1.5em;
  left: 2.5em;
  text-align:center;
  opacity:0;
    -webkit-transition: opacity .25s ease;
    -moz-transition: opacity .25s ease;
}
#box:hover #overlay {
  opacity:1;
}
</style>
</head>
<body>
         <div id="box" style="margin-bottom:1em">
<?php 
require "../nav.php"; 
?>
  <div class="col-md-3 padfix padfix2" style="border:solid 1px #c5d6de;margin-left:4em;background:#fff;text-align:center;padding:2em">
      <div style="margin-left:1em;background:#fff;text-align:center;padding:1em;padding-top:0">
<?php
if ($_SESSION['permlvl']>0 || ($_SESSION['permlvl']<1 && $_SESSION['id']==$_SESSION['pageid'])  ) { 
?>
    <div id="overlay">
        <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#uploadprofile">
          <span class="glyphicon glyphicon-picture"></span> Upload Picture
        </button>      
    </div>
<?php
}
      try {
        $prof = $db->prepare("SELECT * FROM hr_profilepics WHERE hrdbid=:hrdbida");
        $prof->bindParam(':hrdbida', $_SESSION['pageid']);
        $prof->execute();
        $p=$prof->fetch();
              if($p['hrdbid']=="") {
                      if ($row['sex'] == 0) {
                        echo '<img src="../imgs/partner.png" style="margin-bottom:1em">';
                      } else {
                        echo '<img src="../imgs/female.png" style="margin-bottom:1em">';
                      }     
              } else {
              echo '<img src="../../docs/profilepics/'.$p['name'].'" border="2" alt="myprofilepicture" width="200" height="200" vspace="5" style="border-radius:50%" />';
              }   
} catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
}
          $byte = $db->prepare("SELECT SUM(amt) as total FROM bytez m WHERE m.hrdbid='".$_GET['id']."' ");
          $byte->execute();
          $bytez = $byte->fetch();
    try {
        $admin = $db->prepare("SELECT count(id) as encoded FROM DOCDB WHERE hrdbid=:hrdbida");
        $admin->bindParam(':hrdbida', $_SESSION['pageid']);
        $admin->execute();
        $admun=$admin->fetch();
  } catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
        }
    try {
        $adminU = $db->prepare("SELECT groupname FROM hr_groups WHERE HRDBid=:hrdbida");
        $adminU->bindParam(':hrdbida', $_SESSION['pageid']);
        $adminU->execute();
        $admunit=$adminU->fetch();
  } catch(PDOException $e) {
              echo "Error: " . $e->getMessage();
        }
   ?> 
          <br>
          <span style="font-size:15px;font-weight:200;margin-top:1em">
          <?php
          $fullnamez = $row['firstname'].' '.$row['middlename'].' '.$row['lastname'];
          if ($row['nickname'] != "") {
            echo '('.$row['nickname'].')<br>'.ucwords(strtolower($fullnamez));
          } else {
            echo ucwords(strtolower($fullnamez));
          } ?>
          </span>
          <br>
          <span style="font-size:13px;color:#888"><?php echo $row['designation'];?><br>
          <?php if ($row['region'] == "NPMO") { echo $row['region']; } else { echo $row['region'].' - '.$row['province'].' - '.$row['municipality']; }?>
          </span><br>
          </div>
          <div class="dropdown" style="padding-top:0">
          <?php
            if ($_SESSION['permlvl']>0) {
          ?>
            <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Actions <span class="caret"></span>
            </button>
                <ul class="dropdown-menu" role="menu">
                      <li id="deleteacct"><a href="#" style="color:#000"><span class="glyphicon glyphicon-warning-sign"></span> &nbsp;Delete Account</a></li>
                      <li id="levelup"><a href="#" style="color:#000"><span class="glyphicon glyphicon-arrow-up"></span> &nbsp;Level up</a></li>
                      <li id="resetpass"><a href="#" style="color:#000"><span class="glyphicon glyphicon-eye-open"></span> &nbsp;Reset Password</a></li>
                      <li id="resendconfirm"><a href="#" style="color:#000"><span class="glyphicon glyphicon-eye-open"></span> &nbsp;Resend Confirm</a></li>
                </ul>
          <?php
            }
            if ($_SESSION['id']==$_GET['id'] || $_SESSION['permlvl']>0) {

         echo ' <a href="edit.php?id='.$_GET['id'].'" style="color:#000">'; ?>
            <button type="button" class="btn btn-info btn-sm" id='editprofile'>
              Edit Profile &nbsp;<span class="glyphicon glyphicon-cog"></span>
            </button></a>
          <?php
            }
          ?>
            <br>
            </div>

          <hr style="height:1px;border:none;color:#c5d6de;background-color:#c5d6de; margin-right:-30px; margin-left:-30px;margin-bottom:0.75em"/>
          <span class="glyphicon glyphicon-question-sign" id="tooltip3" data-toggle="popover" data-original-title="Bytez <span class='glyphicon glyphicon-flash'>" data-content="Bytez are automatically earned by using the system. What are they for? Nothing for now." rel="popover" data-placement="top" data-trigger="hover"></span>
          Bytez: <b><?php echo number_format($bytez['total']); ?></b><span class="glyphicon glyphicon-flash"></span><br>


          <?php  if($admunit['groupname']=="Administrative Support Unit") {  
          ?>
           <span class="glyphicon glyphicon glyphicon-th"  rel="popover" data-placement="top" data-trigger="hover" ></span>
          Encoded:
          <?php echo "<b>".$admun['encoded']."</b><br>"; } 
          ?> 
<hr style="height:1px;border:none;color:#c5d6de;background-color:#c5d6de; margin-right:-30px; margin-left:-30px; margin-top:0.75em"/>
           <table style="width:100%" id="userdetails" style="border:2px solid red;text-align:left">
                <tr><td style="font-size:14px"><b><span class="glyphicon glyphicon-envelope"></span> </b></td><td style="font-size:14px;text-align:left"><?php echo $row['emailaddress'];?></td></tr>
                <tr><td style="font-size:14px"><b><span class="glyphicon glyphicon-earphone"></span> </b></td><td style="font-size:14px;text-align:left"><?php echo $row['contactnumber'];?></td></tr>
                <tr><td style="font-size:14px"><b><span class="glyphicon glyphicon-calendar"></span> </b></td><td style="font-size:14px;text-align:left"><?php echo $row['employdate'];?></td></tr>
            <?php if ($_SESSION['permlvl']>0) { 
            ?>
            <tr style="color:#d9534f;font-size:14px"><td><b>Employment: </b></td><td style="font-size:14px"><?php echo $row['employstatus'];?></td></tr>
                <tr style="color:#d9534f;font-size:14px"><td><b>Fund Source: </b></td><td style="font-size:14px"><?php echo $row['fundsource'];?></td></tr>
                <tr style="color:#d9534f;font-size:14px"><td><b>Birthdate: </b></td><td style="font-size:14px"><?php echo $row['birthdate'];?></td></tr>
                <?php } ?>
            </table>
            <hr style="height:1px;border:none;color:#c5d6de;background-color:#c5d6de; margin-right:-30px; margin-left:-30px;margin-bottom:0.75em"/>
            <h6 style="text-align:center width:100%">LOGIN ATTEMPTS</h6>
            <hr style="height:1px;border:none;color:#c5d6de;background-color:#c5d6de; margin-right:-30px; margin-left:-30px; margin-top:0.75em"/>
            <div id="container" style="min-width: 200px; height: 180px; max-width: 200px; margin: 0 auto"></div>
      <hr style="height:1px;border:none;color:#c5d6de;background-color:#c5d6de; margin-right:-30px; margin-left:-30px;margin-bottom:0.75em"/>
      <h6 style="text-align:center width:100%">WORKING GROUPS &nbsp;<span class="glyphicon glyphicon-question-sign" id="tooltip1" data-toggle="popover" data-original-title="Technical Working Groups" data-content="<span class='glyphicon glyphicon-star' style='color:#ffcc09'></span> - Indicates head / focal person<br><b>NITWG</b> - National Inter-agency TWG<br><b>DSWD</b> - TWG within DSWD<br><b>SLP</b> - TWG within SLP" rel="popover" data-placement="top" data-trigger="hover" ></span></h6>
      <hr style="height:1px;border:none;color:#c5d6de;background-color:#c5d6de; margin-right:-30px; margin-left:-30px; margin-top:0.75em"/>
         <table style="width:100%" style="padding:1em;text-align:left" id="userdetails">
              <tr><td colspan="2" style="font-size:14px; text-align:center"><b> &nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#requestTWG" style="margin-top:2px;padding:0;padding-left:3px;padding-right:3px;font-size:11px;font-weight:bold">Request Change</button> &nbsp;<?php if ($_SESSION['id']==9) { echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#twgmodal" style="margin-top:2px;padding:0;padding-left:3px;padding-right:3px;font-weight:bold;font-size:11px">Add</button>'; } ?></b></td></tr>
                                  <?php
                                  try {
                                    $stmt3 = $db->prepare("SELECT groupname, groupdesc, isactive, groupleader FROM hr_groups WHERE HRDBid = :HRDBid");
                                    $stmt3->bindParam(':HRDBid', $_GET['id']);
                                    $stmt3->execute();
                                  } catch(PDOException $e) {
                                      echo "Error: " . $e->getMessage();
                                  }//endtry
                                      while ($row4 = $stmt3->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                                      if ($row4[3]==1) {
                                          $row4[3]=" &nbsp;<span class='glyphicon glyphicon-star' style='color:#ffcc09'></span>";
                                    } else {
                                          $row4[3]="";
                                        }
                                     if ($row4[1]==null) {
                                          echo '<tr><td style="font-size:12px">'.$row4[0].$row4[3].'</td><td style="font-size:13px;"></td></tr>'; 
                                   } else {
                                          echo '<tr><td style="font-size:12px">'.$row4[0].$row4[3].'</td><td style="font-size:13px;"><center>'.$row4[1].'</center></td></tr>'; 
                                        }
                                      }
                                  ?>
            </table><br>
            </div>
          </div>
        </div>
  <div class="col-md-8 padfix padfix2" style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:center;margin-bottom:1em">
      <div style="margin-left:1em;background:#fff;text-align:center;padding:1em;">
          <b style="font-size:20px">
<?php if ($row['nickname'] != "") {
            echo $row['nickname'];
          } else {
            echo $row['firstname'];
} ?>'s Wall</b>
              </div>
                <div class="col-md-10 padfix padfix2" style="border:0;background:#fff;text-align:left;padding-left:5em;margin-bottom:1em;">
                    <div class="input-group" style="margin:1em;padding:0;margin-left:1em;margin-right:1em;background:#fff;text-align:center;padding:0">
                      <input id="comment" name="comment" class="form-control" placeholder="" style="margin-left:6em;height:31.4px">
                      <div class="input-group-btn">
                        <button id="postcomment" class="btn btn-primary" style="padding:2px 8px 4px 8px; margin-left:6em">Post</button>
                      </div>
                    </div>
                </div>
          <table style="margin:1em;width:90%">            
<?php
      $stmtcom = $db->prepare("SELECT t.firstname, m.wall_msg, m.wallposted, t.region, t.id, m.wallpostid FROM hr_wallposts m LEFT JOIN hr_db t ON m.wallposter=t.id WHERE m.wallowner = :wallowner ORDER BY m.wallpostid DESC LIMIT 10");
      $stmtcom->bindParam(':wallowner', $_GET['id']);
      $stmtcom->execute();
      while ($row8 = $stmtcom->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
      if($_SESSION['permlvl']>0 || $_SESSION['id']==$row8[4]) {
            echo '<tr style="cursor:default;"><td style="font-size:15px;vertical-align:middle"><div class="col-sm-12" style="text-align:left;line-height:1.1;padding-left:0.7em"><span class="text" id="small">'.$row8[1].'</span><br><span style="font-size:12px"><a href="http://slp.ph/hr/user.php?id='.$row8[4].'" style="color:#00ADDe;text-decoration:none">'.ucwords(strtolower($row8[0])).'</a></span><span style="color:#444;font-size:12px"> ('.$row8[3].') <span style="color:#888;font-size:12px">'.timeago(strtotime($row8[2])).'</span></span></span>&nbsp;&nbsp;<span class="glyphicon glyphicon-edit" onclick="editwp('.$row8[5].');" style="color:#34495e;font-size:12px"></span>&nbsp;<span class="glyphicon glyphicon-remove" onclick="delwp('.$row8[5].');" style="color:#e74c3c;font-size:12px"></span><br><br><br></div><div class="clearfix"></div></div></td></tr>';
     }else{
             echo '<tr style="cursor:default;"><td style="font-size:15px;vertical-align:middle"><div class="col-sm-12" style="text-align:left;line-height:1.1;padding-left:0.7em"><span class="text" id="small">'.$row8[1].'</span></p><br><span style="font-size:12px"><a href="http://slp.ph/hr/user.php?id='.$row8[4].'" style="color:#00ADDe;text-decoration:none">'.ucwords(strtolower($row8[0])).'</a></span><span style="color:#444;font-size:12px"> ('.$row8[3].') <span style="color:#888;font-size:12px">'.timeago(strtotime($row8[2])).'</span></span></span><br><br><br></div><div class="clearfix"></div></div></td></tr>';
          }
      }
?>
          </table>
        </div>
      </div>  
  <div class="col-md-8 padfix padfix2" style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:center;margin-bottom:1em">
      <div style="margin-left:1em;background:#fff;text-align:left;padding:1em">
            <h3 style="margin-bottom:0"><b>ROVER</b></h3>
            Click on rows to view more<br><br>
      <div class="col-md-12 padfix padfix2" style="border:0;background:#fff;text-align:left;padding:0;margin-bottom:2em">
            <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;width:100%;text-align:left;">
                    <thead style="text-align:left;">
                      <tr>
                        <th colspan="4" style="text-align:left;cursor:default">When</th>
                        <th colspan="4" style="text-align:left;cursor:default">Where</th>
                        <th colspan="4" style="text-align:left;cursor:default">What</th>
                      </tr>
                      <tr style="display:none">
                        <th>id</th>
                        <th>When</th>
                        <th>End Date</th>
                        <th>Event</th>
                        <th>Where</th>
                        <th>What</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
              </table>
              <!--<a href="rover.php"><button class="btn btn-warning">Dashboard Preview</button></a>-->
              <script>
              function parseDate(str) {
                var zz = moment(str).format("D MMM");
                var t = str.split("-");
                var d = t[1]+"/"+t[2];
                return zz;
              }
              function parseDate2(str) {
                var zz = moment(str).format("D-MMMM");
                var t = zz.split("-");
                var d = "<center><b style='font-size:16px'>"+t[0]+"</b><br>"+t[1];
                return d;
              }
              function parseImg(str) {
                if (str=="AM") {

                }
              }
              oTable = $('#viewdata').dataTable({
                "aProcessing": true,
                "aServerSide": true,
                "orderCellsTop": true,
                "ajax": "hr_rover.php",
                "aaSorting": [9,'desc'],
                "dom": '<"top">rt<"bottom"p><"clear">',
                "fnRowCallback":
                  function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                    $(nRow).attr('id', aData[0]);
                    return nRow;
                  },
                "aoColumnDefs": [
                        { 
                           "aTargets":[1],
                           "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                            {
                                $(nTd).css('text-align', 'center');
                                $(nTd).css('width', '19%');
                                $(nTd).css('font-size', '12.5px');
                            },
                            "mData": null,
                            "mRender": function( data, type, full) {
                                if (data[1] == data[2]) {
                                  return '<td style="vertical-align:middle"><div style="vertical-align:middle">'+parseDate2(data[1])+'</div></td>'; 
                                } else {
                                  return '<td><div class="col-md-5" style="margin:0;padding:0">'+parseDate2(data[1])+' '+data[6]+'</div> <div style="margin:0;padding:0" class="col-md-1">-</div> <div class="col-md-5" style="margin:0;padding:0">'+parseDate2(data[2])+' '+data[7]+'</div></td>';
                                }
                            }
                        },
                        { 
                           "aTargets":[2],
                           "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('width', '20%');
                            }
                        },
                        { 
                           "aTargets":[5],
                           "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('font-size', '14px');
                            },
                            "mData": null,
                            "mRender": function( data, type, full) {
                                return '<td><span style="color:#00AADe;font-weight:bold;">'+data[3]+'</span> - '+data[5]+'</td>';
                            }
                        },
                       { 
                           "aTargets":[8],
                           "fnCreatedCell": function(nTd, sData, oData, iRow, iCol) {
                                $(nTd).css('text-align', 'center');
                                $(nTd).css('font-size', '14px');
                            },
                            "mData": null,
                            "mRender": function( data, type, full) { 
                                if (data[9]>0) {
                                  return '<td><a href="viewrover.php?id='+data[0]+'"><span class="label label-success">File</span><br><span class="label label-primary">More</span></a></td>';
                                } else {
                                  return '<td><a href="viewrover.php?id='+data[0]+'"><span class="label label-primary">More</span></a></td>';
                                }                              
                            }
                        },
                        { 
                           "aTargets":[9],
                            "mData": null,
                            "mRender": function( data, type, full) {
                                return '<td>'+data[8]+'</td>';
                            }
                        },
                        { "bVisible": false, "aTargets":[0,2,3,6,7,9] }
                                ]
              });
$('#viewdata').on( 'click', 'tbody tr', function () {
          var redirection = $(this).attr('id');
          window.location.href = "viewrover.php?id="+redirection;
        });
            </script>
          <div class="col-md-10 padfix padfix2" style="border:0;background:#fff;text-align:left;padding-left:8em;margin-bottom:1em;">
            <div style="padding-top:3em; <?php if ($_SESSION['permlvl'] > 0 || ($_SESSION['id'] == $_GET['id'])) { echo ''; } else { echo 'display:none;'; } ;?>">
              <form id="postRover" action="" method="post">
                        <div class="form-group">
                            <div class="input-group">
                              <input class="form-control" aria-label="..." placeholder="Start Date" style="" id="startdate" name="startdate" required/>
                              <div class="input-group-btn">
                                <button id="ampm1" type="button" class="btn dropdown-toggle" data-toggle="dropdown" style="border: 2px solid #dce4ec;background:#dce4ec">AM / PM <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" id="selectampm1">
                                  <li><a href="javascript:return false;">AM</a></li>
                                  <li><a href="javascript:return false;">PM</a></li>
                                </ul>
                              </div><!-- /btn-group -->
                            </div><!-- /input-group -->
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                              <input type="text" class="form-control" aria-label="..." placeholder="End Date" id="enddate" name="enddate">
                              <div class="input-group-btn">
                                <button id="ampm2" type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: 2px solid #dce4ec;background:#dce4ec">AM / PM <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" id="selectampm2">
                                  <li><a href="javascript:return false;">AM</a></li>
                                  <li><a href="javascript:return false;">PM</a></li>
                                </ul>
                              </div><!-- /btn-group -->
                            </div><!-- /input-group -->
                        </div>
                          <div class="form-group">
                              <select class="form-control cleanselect" name="event" id="event" required>
                                <option value="" selected>Select Event</option>
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
                          <div class="form-group">
                              <input type="text" class="form-control" placeholder="Venue" id="venue" name="venue">
                          </div>
                          <div class="form-group">
                              <textarea name="remarks" maxlength="255" class="form-control" id="remarks" placeholder="Purpose" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3"></textarea>
                          </div>
<?PhP
$sql = "SELECT id, CONCAT(lastname, ', ', firstname) as name FROM hr_db";
//$partnerIDArray = [];
//$partnerArray = [];
foreach ($db->query($sql) as $results) {
  $partnerIDArray[] = intval($results["id"]);
  $partnerArray[] = $results["name"];
}
?>
<script>
$(document).ready(function() {
  window.selectPartner = "";
  window.taggedPeople = [];
$(function () {
    'use strict';
    var partnerIDArray = <?php echo json_encode($partnerIDArray);?>;
    var partnerArray = <?php echo json_encode($partnerArray);?>;
    var arr = [];
    var element = {};
    
    for (var i = 0; i < partnerArray.length; i++) {
        var idname=partnerIDArray[i];
        var name=partnerArray[i];
        element[idname] = name;
    }
    var countriesArray = $.map(element, function (value, key) { return { value: value, data: key }; });
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
});
</script>
</form>
          <div class="form-group">
                <input type="text" name="autocompleteajax" id="autocompleteajax" class="form-control" placeholder="Tag other people.."/>
                <input type="hidden" id="autocomplete-ajax-x" disabled="disabled"/>
          </div>
                <span id="tagpart" style="padding-left:5px;display:none">Tagged:</span>
                <div class="form-group" style="margin-bottom:0.2em;" id="idg">
                <input name="subsector" id="subsector" value="" type="">
          </div>
                <button id="addrover" class="btn btn-success pull-right" style="">Add Record</button>
              </div>
          </div>
       </div>
    </div>
</div></div>
</div><!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
        <div class="modal-dialog modal-sm">
          <div class="modal-content" style="padding:1em;padding-top:0.5em;">
                  <h3 style="color:#5cb85c;margin-bottom:6px">Success!</h3>
                  <span style="font-size:13px" id="sucsubtext">Profile picture uploaded.</span><br><br>
                  <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                  <div class="clearfix"></div>
          </div>
        </div>
      </div>
    <!-- Modal -->
  <div class="modal fade" id="requestTWG" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="padding:1em">
        <div class="modal-body">
              <div class="form-group" style="margin-bottom:0">
                <select class="form-control" id="reqtwg_option">
                  <option value="">Add/Edit/Delete</option>
                  <option>Add</option>
                  <option>Edit</option>
                  <option>Delete</option>
                </select>
              </div>
              <div class="form-group" style="margin-bottom:0">
                <input class="form-control" id="reqtwg_name" name="reqtwg_name" placeholder="Complete name of TWG">
              </div>
              <div class="form-group" style="margin-bottom:0">
                <input class="form-control" id="reqtwg_remarks" name="reqtwg_remarks" placeholder="Explanation / Remarks">
              </div>
              <button type="button" class="btn btn-primary pull-right" style="margin-top:0;" id="saveRequest">Send Request</button>
              <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
    <!-- Modal -->
  <div class="modal fade" id="uploadprofile" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="padding:1em" id="upprof">
        <div class="modal-body">
              <div class="form-group" style="margin-bottom:0">
<h3 style="margin-top:0">Profile Picture</h3>
            <form id="myForm" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="dt" value="<?php echo date("m-d-Y h:i:sa"); ?>" />
                  <div class="input-group" style="margin-bottom:0;margin-top:1em">
                      <input id="uploadfilename" class="form-control" placeholder="Choose image.." disabled="disabled">
                      <div class="input-group-btn">
                        <div class="fileUpload btn btn-primary">
                            <span><span class="glyphicon glyphicon-camera"></span> &nbsp; Choose Image</span>
                            <input type="file" id="userfile" name="userfile" class="upload" required/>
                        </div>
                      </div>
                    </div><!-- /input-group -->
                    <span style="font-size:12px;margin-bottom:1em">Supported file types: PNG, JPG, JPEG, TIFF, BMP</span>
                    <span style="font-size:12px;margin-bottom:2em" class="pull-right">Maximum file size:10MB</span><br>
<?php
             try {
                    $at = $db->prepare("SELECT * FROM hr_profilepics WHERE hrdbid=:id");
                    $at->bindParam(':id', $_SESSION['pageid']);
                    $at->execute();
                    $rows=$at->fetch();
            } catch(PDOException $e) {
                  echo "Error: " . $e->getMessage();
                  }//endtry
             if ( ($_SESSION['permlvl']>0 && $rows['hrdbid']==$_SESSION['pageid']) || ($_SESSION['permlvl']<1 && $rows['hrdbid']==$_SESSION['pageid']) ) { 
// reupload 
?>        
            <button type="button" id="profileBtnRe" class="btn btn-info pull-left" style="padding:6;margin-top:1.2em;margin-bottom:2em">
            <span class="glyphicon glyphicon-cloud-upload"></span> Reupload</button>
            <br><br>
 <?php
 }
if ( ($_SESSION['permlvl']>0 && $rows['hrdbid']!=$_SESSION['pageid']) || ($_SESSION['permlvl']<1 && $rows['hrdbid']!=$_SESSION['pageid']) ) { 
// upload 
 ?>
            <button type="button" id="profileBtn" class="btn btn-info pull-left" style="padding:6;margin-top:1.2em;margin-bottom:2em">
            <span class="glyphicon glyphicon-cloud-upload"></span> Upload</button>
            <br><br>
<?php 
}
?>
  </form>
            </body>
            </html>  
          </div>
        </div>
      </div>
    </div>
  </div>
<!-- Modal -->
  <div class="modal fade" id="twgmodal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content" style="padding:1em;padding-top:0">
        <div class="modal-body" style="padding-top:0">
          <h2>Technical Working Groups</h2>
              <div class="form-group" >
                <select class="form-control" style="margin-bottom:0" id="twgname">
                    <option value="" selected>Select TWG</option>
                    <option>Management Committee</option>
                    <option>Operations Unit</option>
                  </select>
              </div>
              <div class="form-group">
                  <select class="form-control" style="margin-bottom:0" id="twgtype">
                    <option value="" selected>Select Type</option>
                    <option>NITWG</option>
                    <option>DSWD</option>
                    <option>SLP</option>
                  </select>
              </div>
              <div class="form-group">
                  <select class="form-control" style="margin-bottom:0" id="twgstatus">
                    <option value="" selected>Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
              </div>
              <div class="form-group">
                  <select class="form-control" style="margin-bottom:0" id="twgmember">
                    <option value="" selected>Select Membership</option>
                    <option value="1">Focal Person</option>
                    <option value="0">Alternate</option>
                  </select>
              </div>
              <button type="button" class="btn btn-primary pull-right" style="margin-top:0;" id="saveTWG">Save</button>
              <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.text').emoticonize({
        //delay: 800,
        //animate: false,
        //exclude: 'pre, code, .no-emoticons'
      });
      $('#toggle-headline').toggle(
        function(){
          $('#large').unemoticonize({
            //delay: 800,
            //animate: false
          })
        }, 
        function(){
          $('#large').emoticonize({
            //delay: 800,
            //animate: false
          })
        }
      );
    })
  </script>
<script>
$( document ).ready(function() {
  $("#tooltip1").popover({
        html : true
      });
  $("#tooltip3").popover({
        html : true
      });
$("#saveFeeling").click(function(event) {
  var formData = {
      'id'        : "<?php echo $_GET['id']; ?>",
      'feeling'   : document.getElementById("feelvalue").value
      };
                $.ajax({
                   url: "addfeel.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                        $("#sucsubtext").html("Status update added")
                        $('#myModal').modal();
                        $('#myModal').on('hidden.bs.modal', function () {
                            location.reload();
                        })
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
});
$("#saveTWG").click(function(event) {
  var formData = {
      'id'        : "<?php echo $_GET['id']; ?>",
      'twgname'   : $('#twgname option:selected').val(),
      'twgtype'   : $('#twgtype option:selected').val(),
      'twgstatus' : $('#twgstatus option:selected').val(),
      'twgmember' : $('#twgmember option:selected').val()
      };
                $.ajax({
                   url: "addTWG.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                        $("#sucsubtext").html("TWG added")
                        $('#myModal').modal();
                        $('#myModal').on('hidden.bs.modal', function () {
                            location.reload();
                        })
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
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
                       url: "addrover.php",
                       type: "POST",
                       data: formData,
                       success: function(data) {
                          if (data == "good") {
                            $("#sucsubtext").html("Rover record added")
                            $('#myModal').modal();
                            document.getElementById("startdate").value = "";
                            document.getElementById("enddate").value = "";
                            document.getElementById("remarks").value = "";
                            $("#addrover").html("Add Record");
                            $('#event').get(0).selectedIndex = 0;
                            var table = $('#viewdata').DataTable();
                            table.ajax.reload();
                        } else {
                            alert(data);
                          }
                       }
                    });//endAjax
      } else {
        alert(errorlist);
      }
    });
  $('#subsector').tagit({
        readOnly: true,
        onTagClicked: function(evt, ui) {
            var tagname = ($('#subsector').tagit('tagLabel', ui.tag));
            $("#subsector").tagit("removeTagByLabel", tagname);
        }
    });
    $('#idg').hide();
  $("#loadicon").hide();
  $("#deleteacct").click(function(event) {
    var r = confirm("You are about to delete a record. This will be recorded. Are you sure?");
    if (r == true) {
      var formData = {
      'id'        : "<?php echo $_GET['id']; ?>",
      'deleter'   : "<?php echo $_SESSION['id']; ?>"
      };
                $.ajax({
                   url: "delrecord.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                        alert("Success!");
                        location.href = "index.php";
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
    }
  });
  $("#levelup").click(function(event) {
        var formData = {
          'id'        : "<?php echo $_GET['id']; ?>"
        };
        $.ajax({
           url: "levelup.php",
           type: "POST",
           data: formData,
           success: function(data) {
              if (data == "good") {
                $("#sucsubtext").html("User level increased")
                $('#myModal').modal();
                $('#myModal').on('hidden.bs.modal', function () {
                    location.reload();
                })
            } else {
                alert(data);
              }
           }
        });//endAjax
  });
  $("#resetpass").click(function(event) {
    console.log("asdf2");
        var formData = {
          'id'        : "<?php echo $_GET['id']; ?>"
        };
        $.ajax({
           url: "resetpass.php",
           type: "POST",
           data: formData,
           success: function(data) {
              if (data == "good") {
                $("#sucsubtext").html("Password reset")
                        $('#myModal').modal();
                        $('#myModal').on('hidden.bs.modal', function () {
                            location.reload();
                        })
              } else {
                alert(data);
              }
           }
        });//endAjax
  });
  $("#resendconfirm").click(function(event) {
        var formData = {
          'id'        : "<?php echo $_GET['id']; ?>"
        };
        $.ajax({
           url: "resend.php",
           type: "POST",
           data: formData,
           success: function(data) {
              if (data == "good") {
                $("#sucsubtext").html("Confirmation email resent")
                $('#myModal').modal();
              } else {
                alert(data);
              }
           }
        });//endAjax
  });
  $("#saveRequest").click(function(event) {
        var formData = {
          'option'         : $('#reqtwg_option option:selected').val(),
          'twgname'        : $('input[name=reqtwg_name]').val(),
          'twgremarks'        : $('input[name=reqtwg_remarks]').val()
        };
        $.ajax({
           url: "reqTWG.php",
           type: "POST",
           data: formData,
           success: function(data) {
              if (data == "good") {
                $("#sucsubtext").html("TWG change request sent")
                        $('#myModal').modal();
                        $('#myModal').on('hidden.bs.modal', function () {
                            location.reload();
                        })
              } else {
                alert(data);
              }
           }
        });//endAjax
  });
  // UPLOAD BUTTON
$("#profileBtn").click(function(event) {
     $("#loadoverlay").show();
     document.getElementById("profileBtn").disabled = true;
     var fd = new FormData;                  
     file1 = $('#userfile').prop('files')[0];
     fd.append('action', 'uploadpics');
     fd.append('file', file1);
     $.ajax({
                url: 'uploadprofilepic.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: fd,                         
                type: 'POST',
                success: function(data){
                    $("#loadoverlay").hide();

                    if (data=="Success") {
                      $('#myModal').modal();
                       $("#uploadprofile").hide()
                      $('#myModal').on('hidden.bs.modal', function () {
                          location.href = "user.php?id=<?php echo $_SESSION['pageid']; ?>";
                      })
                     ;
                    } else {
                      alert(data);
                    }
                }
      });
}); 
// REUPLOAD BUTTON 
$("#profileBtnRe").click(function(event) {
     $("#loadoverlay").show();
     document.getElementById("profileBtnRe").disabled = true;
     $("#profileBtnRe").disabled = true;
     var fd1 = new FormData;                  
     file2 = $('#userfile').prop('files')[0];
     fd1.append('action', 'reuploadpics');
     fd1.append('file', file2);
     $.ajax({
                url: 'uploadprofilepic.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: fd1,                         
                type: 'post',
                success: function(data){
                    $("#loadoverlay").hide();
                    if (data=="Success") {
                      $("#profileBtnRe").disabled = false;
                      document.getElementById("profileBtnRe").disabled = false;
                      $('#myModal').modal();
                       $("#uploadprofile").hide()
                      $('#myModal').on('hidden.bs.modal', function () {
                          location.href = "user.php?id=<?php echo $_SESSION['pageid']; ?>";
                      })
                    } else {
                      alert(data);
                      document.getElementById("profileBtnRe").disabled = false;
                      $("#profileBtnRe").disabled = false;
                    }
                }
          });
    });
/////////////////////////////////////////////////////////
  $("#comment").keyup(function (e) {
    if (e.keyCode == 13) {
      if ($("#comment").val() == "") {
        return false;
      }
  $("#postcomment").html("...");
  document.getElementById("postcomment").disabled = true;
    var formData = {
      'action'        : "comment",
      'hrdbid'       : "<?php echo $_GET['id']; ?>",
      'comment'       : $('input[name=comment]').val()
    };
                $.ajax({
                   url: "addwallpost.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                        $("#comment").val("");
                        location.reload();
                      } else {
                        alert(data);
                      }
                        $("#postcomment").html("Post");
                        document.getElementById("postcomment").disabled = false;
                   }
                });
                //endAjax
    }
 });
$("#postcomment").click(function(event) {
if ($("#comment").val() == "") {
  return false;
}
  $("#postcomment").html("...");
  document.getElementById("postcomment").disabled = true;
    var formData = {
      'action'        : "comment",
      'hrdbid'       : "<?php echo $_GET['id']; ?>",
      'comment'       : $('input[name=comment]').val()
    };
                $.ajax({
                   url: "addwallpost.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "good") {
                        $("#comment").val("");
                        location.reload();
                      } else {
                        alert(data);
                      }
                        $("#postcomment").html("Post");
                        document.getElementById("postcomment").disabled = false;
                   }
                });
                //endAjax
}); //endpost
  $("#sendfeedback").click(function(event) {
      sendFeedback("viewdata_user",$('textarea[name=feedback]').val(),"<?php echo $_SESSION['id']; ?>");
  });
    var heights = $(".wellz").map(function() {
        return $(this).height();
    }).get(),
    maxHeight = Math.max.apply(null, heights);
    $(".wellz").height(maxHeight);
    var picker2 = new Pikaday({ 
      field: $('#startdate')[0], 
      format: 'M/D/YYYY'
    });
    var picker3 = new Pikaday({ 
      field: $('#enddate')[0], 
      format: 'M/D/YYYY'
    });
});
</script>
<script type="text/javascript" src="../js/feedback.js"></script>
<script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
<script src="../../js/pikaday.min.js"></script>
<script>
$(document).ready(function() {
  document.getElementById("userfile").onchange = function () {
    document.getElementById("uploadfilename").value = this.value;
  };
});
</script>
<?php
//$filter = $_SESSION['filter'];
        /*if ($filter == "NPMO") {*/
//$stmt = $db->prepare("SELECT count(id) as total, count(case when confirmed = '1' then 1 else null end) as confirmed FROM HRDB"); 
$stmt = $db ->prepare("SELECT logincount + loginfail as total,logincount as logincount, loginfail as loginfail from hr_db where id = :hrdbid");
$stmt->bindParam(':hrdbid', $_SESSION['pageid']);
        /*} else {
$stmt = $db->prepare("SELECT count(id) as total, count(case when isnew = '1' then 1 else null end) as confirmed FROM HRDB WHERE region = '".$filter."'");           
        }*/
$stmt->execute();
$row = $stmt->fetch();
?>
<script>
$(function () {
    $(document).ready(function () {
      var colors = Highcharts.getOptions().colors,
        logincount = '<?php echo $row["logincount"]; ?>',
        loginfail = '<?php echo $row["loginfail"]; ?>';
        total = <?php echo $row['total']; ?>
        // Build the chart
        $('#container').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie',
                backgroundColor: null
            },
            title: {
                   text: total,
                   verticalAlign: 'middle',
                   y: -12,
                   style: {
                        fontFamily: 'Lato', 
                        fontSize: '30px',
                        fontWeight: 'bold',
                    }
            },
            subtitle: {
                text: 'Total',
                verticalAlign: 'middle',
                y: 2,
                style: {
                        fontFamily: 'Lato', 
                        fontSize: '14px',
                    }
            },
            tooltip: {
                formatter: function() {
                    var point = this.point,
                        s = point.name+': <b>'+point.y.toFixed(0)+'</b>';
                    return s;
                },
                hideDelay: 0
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            legend: {
              layout: 'horizontal',
              align: 'center',
              verticalAlign: 'bottom',
              floating: false,
              backgroundColor: '',
              itemStyle: {
                 font: 'Lato, sans-serif',
              },
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Users',
                colorByPoint: true,
                innerSize: '75%',
                data: [{
                    name: 'SUCCESS',
                    y: parseInt(logincount),
                    color: '#2c3e50'
                    
                }, {
                    name: 'FAIL',
                    y: parseInt(loginfail),
                    color: '#d8d8d8'
                }]
            }]
        });
    });
});
function editwp(row1) {
        var formData = { 'editid' : row1 };
        $.ajax({
          type: "POST",
          url: "editwallpost.php",
          data: formData,
          success: function(data) {
                  if (data == "visitpage") {
                    location.href="editwallpost.php";
                  }
                }
          });
}
function delwp(row){
  var r = confirm("Do you want to delete this comment?");
 if (r == true) {
    var formData = {
      'action'        : "delwp",
      'wpid'       : row
   };
                $.ajax({
                   url: "fileFunctions.php",
                   type: "POST",
                   data: formData,
                   success: function(data) {
                      if (data == "deleted") {
                        alert("Success!");
                        location.href = "user.php?id=<?php echo $_GET['id']; ?>";
                      } else {
                        alert(data);
                          
                      }
                   }
                });
                //endAjax
  }
 //endpost
}
</script>
</body>
</html>
