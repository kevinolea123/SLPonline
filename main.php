<?php
require "zxcd9.php";
byteMe($_SESSION['id'],'main',0.10);
$stmt = $db->prepare("SELECT COUNT(id) as total FROM hr_db WHERE CONFIRMED = 1 UNION SELECT COUNT(id) FROM hr_db UNION SELECT SUM(numopenings) FROM PRTdemand UNION SELECT COUNT(id) FROM PRTsupply UNION SELECT SUM(amt) FROM bytez m WHERE m.hrdbid='".$_SESSION['id']."' UNION SELECT SUM(amt) FROM bytez");
$stmt->execute();
$totalarray = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $totalarray[] = $row['total'];
}
function timeago($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1)
    {
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

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
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
    <title>SLP Online</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/flatbootstrap.min.css"/>
    <link href="css/jquery.cssemoticons.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/jquery.dataTables.js"></script>
    <script src="js/DTbootstrap.js"></script>
    <script src="js/jquery.cssemoticons.min.js" type="text/javascript"></script>
    <style>

 #small { font-size: 12px; }
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
.dashpanel {
  border:solid 1px #c5d6de;background:#fff;text-align: center;
  height:100%;
  border-radius: 4px;
}
.bluetext {
  color: #00ADDe;
}
.padfix {
  padding-right: 0;
  margin-bottom:1em;
  margin-right: 1em;
}
.padfix2{
  padding-right:0em;
  padding-left: 1em;
}
.padfix3 {
  padding-left:1em;
  padding-right:0;
}
.padfix4 {
  padding: 1em;
  padding-right:0;
}
.dashpanelheader {
  font-weight:900;padding-top:0.5em;padding-left:1em;font-size:18px;
  margin-bottom: 0;text-align: left;
}
@media (min-width: 990px) {
  .slpdrop {
    font-weight:900;
    font-size:22px;
  }
  .padfix {
    padding-right: 0;
    margin-right: 0;
    margin-bottom: 0;
  }
  .padfix2{
    padding-right:0em;
    padding-left: 2em;
  }
  .padfix3 {
    padding-left:0;
    padding-right: 1em;
  }
  .padfix4 {
    padding: 1em;
    padding-right:1em;
  }
}
.dashpanelsubhead {
  text-align:left;padding-left:1.2em;margin-bottom:0;padding-bottom:0;
}
thead th {
  text-align: center;
  cursor: pointer;
}
.dataTables_paginate {
  float:none;
}
h3 {
  font-weight: 400
}
.nopad {
  margin:0;
  padding:0;
  padding-top:4px;
}
.nopad::after {
    color: #ccc;
    content: attr(data-bg-text);
    display: block;
    font-size: 12px;
    text-align:right;
    line-height: 1;
    padding:0;
    margin:0;
    margin-top: 0px;
    position: relative;
    bottom: 0px;
    right: 0px;
}
.labelhover:hover {
  background: #000;
  color: #fff;
}

.pagination {
  display: inline-block;
  padding-left: 0;
  margin: 20px 0;
  border-radius: 4px;
}
.pagination > li {
  display: inline;
}
.pagination > li > a,
.pagination > li > span {
  position: relative;
  float: left;
  padding: 6px 12px;
  margin-left: -1px;
  line-height: 1.42857143;
  color: #337ab7;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #ddd;
}
.pagination > li:first-child > a,
.pagination > li:first-child > span {
  margin-left: 0;
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.pagination > li:last-child > a,
.pagination > li:last-child > span {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}
.pagination > li > a:hover,
.pagination > li > span:hover,
.pagination > li > a:focus,
.pagination > li > span:focus {
  z-index: 3;
  color: #23527c;
  background-color: #eee;
  border-color: #ddd;
}
.pagination > .active > a,
.pagination > .active > span,
.pagination > .active > a:hover,
.pagination > .active > span:hover,
.pagination > .active > a:focus,
.pagination > .active > span:focus {
  z-index: 2;
  color: #fff;
  cursor: default;
  background-color: #337ab7;
  border-color: #337ab7;
}
.pagination > .disabled > span,
.pagination > .disabled > span:hover,
.pagination > .disabled > span:focus,
.pagination > .disabled > a,
.pagination > .disabled > a:hover,
.pagination > .disabled > a:focus {
  color: #777;
  cursor: not-allowed;
  background-color: #fff;
  border-color: #ddd;
}
.pagination-lg > li > a,
.pagination-lg > li > span {
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
}
.pagination-lg > li:first-child > a,
.pagination-lg > li:first-child > span {
  border-top-left-radius: 6px;
  border-bottom-left-radius: 6px;
}
.pagination-lg > li:last-child > a,
.pagination-lg > li:last-child > span {
  border-top-right-radius: 6px;
  border-bottom-right-radius: 6px;
}
.pagination-sm > li > a,
.pagination-sm > li > span {
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
}
.pagination-sm > li:first-child > a,
.pagination-sm > li:first-child > span {
  border-top-left-radius: 3px;
  border-bottom-left-radius: 3px;
}
.pagination-sm > li:last-child > a,
.pagination-sm > li:last-child > span {
  border-top-right-radius: 3px;
  border-bottom-right-radius: 3px;
}
.pagermid {
  width:100%;
  margin:0;
  padding:0;
  text-align: left
}
.hoverme {
  background:#3a4455;
}
.hoverme:hover {
  background:#303641;
}
.hoverme .background{
    color: rgba(0,0,0,0.3);
    position: absolute;
    bottom: 0px;
    right: 15px;
    z-index: 9999999;
}
.hoverme .background_left{
    color: rgba(0,0,0,0.3);
    position: absolute;
    bottom: 0px;
    left: 15px;
    z-index: 9999999;
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
<?php require "nav.php"; ?>
  <div id="slideout">
    <img src="http://img.usabilitypost.com.s3.amazonaws.com/1104/css_slideout/feedback.png" alt="Feedback" />
    <div id="slideout_inner">
      <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;display:none;"></span>
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
<div class="row" style="margin-right:0">

  <div class="col-md-3 padfix padfix2" style="">
    <div class="row">
      <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:center;padding:1em">
        <?php
        $prof = $db->prepare("SELECT * FROM hr_profilepics WHERE hrdbid=:hrdbid");
        $prof->bindParam(':hrdbid', $_SESSION['id']);
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
        ?>
        <br><br>
        <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?><br>
        <?php echo $_SESSION['designation']; ?><br>
        <a href="hr/user.php?id=<?php echo $_SESSION['id']; ?>"><span class="label label-info labelhover">View Profile Page</span></a><br>
        <br>
        <span class="glyphicon glyphicon-flash"></span>Bytez: <b><?php echo number_format($totalarray[4]); ?></b><br>
        <span class="glyphicon glyphicon-question-sign" id="tooltip1" data-toggle="popover" data-original-title="Bytez <span class='glyphicon glyphicon-flash'>" data-content="Bytez are automatically earned by using the system. What are they for? Nothing for now." rel="popover" data-placement="top" data-trigger="hover" ></span>
      </div>
    </div>
    <div class="row" style="margin-top:1em">
  <div style="background:#f6f8fa;font-size:15px;padding:1em;padding-left:1.5em;border:solid 1px #c5d6de;margin-left:0.9em;text-align:center;padding-top:0.8em;padding-bottom:0.8em">
            <b>Recent Activities</b>
          </div>
       
    <div style="border:solid 1px #c5d6de;margin-left:1.1em;background:#fff;padding:1em;padding-left:1.5em;padding-right:1.5em;font-size:12px;padding-bottom:0">
       
          
     <?php 

try {

     $stmt1=$db->prepare("SELECT bz.pagename,h2.firstname,h2.lastname,bz.added,hp1.name,h2.id,h2.sex FROM bytez_recent as bz LEFT JOIN hr_db as h2 ON h2.id=bz.hrdbid LEFT JOIN hr_profilepics as hp1 on h2.id=hp1.hrdbid ORDER BY bz.added DESC LIMIT 2");
            $stmt1->execute();

            while($rowsb=$stmt1->fetch(PDO::FETCH_NUM,pdo::FETCH_ORI_NEXT)) { 

              if($rowsb[4]=="") {
                        if($rowsb[6]==0) {
                            if($rowsb[0]=="upload") { 
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;'.$rowsb[0].'ed a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="uploadpic") {
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Uploaded his new profile photo.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="reuploadpic") {
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Updated his profile picture.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="deleted"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Deleted a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=='hb_partner_adds') {  
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a partner.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=='hb_jobs_add') {  
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a job.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=='hb_supply_add') {  
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a participant.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }
                        }else {
                            if($rowsb[0]=="upload") { 
                              echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;'.$rowsb[0].'ed a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="uploadpic"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Uploaded her new profile photo.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="reuploadpic"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Updated her profile picture.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="deleted"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Deleted a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="hb_partner_adds"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a partner.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="hb_jobs_add"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a job.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }elseif($rowsb[0]=="hb_supply_add"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a participant.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                            }
                        }

                } else {
                      
                    if($rowsb[6]==0){                    
                        if($rowsb[0]=="upload") { 
                              echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;'.$rowsb[0].'ed a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="uploadpic"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Uploaded his new profile photo.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="reuploadpic"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Updated his profile picture.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="deleted"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Deleted a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="hb_partner_adds"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a partner.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="hb_jobs_add"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a job.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="hb_supply_add"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a participant.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }
                    }else{
                        if($rowsb[0]=="upload") { 
                              echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;'.$rowsb[0].'ed a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="uploadpic"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Uploaded her new profile photo.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="reuploadpic"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Updated her profile picture.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="deleted"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Deleted a file in E-Library<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="hb_partner_adds"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a partner.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="hb_jobs_add"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a job.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }elseif($rowsb[0]=="hb_supply_add"){
                                  echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowsb[5].'"><img src="../docs/profilepics/'.$rowsb[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowsb[1].' '.$rowsb[2].'</b></a>&nbsp;Added a participant.<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowsb[3])).'</span></div></div><hr>';
                        }
                    }
              }        
         }

}catch(PDOException $e) {
 echo "Error: " . $e->getMessage();
}

try {
    $stmt=$db->prepare("SELECT w.wall_msg,h.firstname,h.sex,w.wallposted,p.name,h.lastname,h.id,w.wallowner,h1.firstname,h1.lastname,w.wallposter FROM hr_wallposts as w LEFT JOIN hr_db as h on w.wallposter=h.id LEFT JOIN hr_profilepics as p on p.hrdbid=h.id LEFT JOIN hr_db as h1 on h1.id=w.wallowner ORDER BY w.wallpostid DESC LIMIT 3");
    $stmt->execute();
    while($rowWP=$stmt->fetch(PDO::FETCH_NUM,pdo::FETCH_ORI_NEXT)) { 

     if($rowWP[7]==$rowWP[10]){
               if($rowWP[4]=="" ) {
                        if($rowWP[2]==0) {             
                         echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowWP[6].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowWP[1].' '.$rowWP[5].'</a></b><br>'.date("M j - h:i a",strtotime($rowWP[3])).'</span><br><p class="text" id="small">'.$rowWP[0].'</p></div></div><hr>';
                        } else {
                          echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowWP[6].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowWP[1].' '.$rowWP[5].'</a></b><br>'.date("M j - h:i a",strtotime($rowWP[3])).'</span><br><p class="text" id="small">'.$rowWP[0].'</p></div></div><hr>';
                        }
               } else {  

                  
                        echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowWP[6].'"><img src="../docs/profilepics/'.$rowWP[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowWP[1].' '.$rowWP[5].'</a></b></b><br></span><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowWP[3])).'</span><br><p class="text" id="small">'.$rowWP[0].'</p></div></div><hr style="padding-bottom:0">';
               }
      } else {
              if($rowWP[4]=="" ) {
                          if($rowWP[2]==0) {             
                           echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowWP[6].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowWP[1].' '.$rowWP[5].'</a><span class="glyphicon glyphicon-triangle-right"></span><a href="../hr/user.php?id='.$rowWP[7].'">'.$rowWP[8].'&nbsp;'.$rowWP[9].'</a></b><br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowWP[3])).'</span><br><p class="text" id="small">'.$rowWP[0].'</p></div></div><hr>';
                          } else {
                            echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowWP[6].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowWP[1].' '.$rowWP[5].'</a><span class="glyphicon glyphicon-triangle-right"></span><a href="../hr/user.php?id='.$rowWP[7].'">'.$rowWP[8].'&nbsp;'.$rowWP[9].'</a></b><br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowWP[3])).'</span><br><p class="text" id="small">'.$rowWP[0].'</p></div></div><hr>';
                          }
                 } else {  

                    
                          echo '<div class="row"><div class="col-md-3"><a href="../hr/user.php?id='.$rowWP[6].'"><img src="../docs/profilepics/'.$rowWP[4].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$rowWP[1].' '.$rowWP[5].'</a><span class="glyphicon glyphicon-triangle-right"></span><a href="../hr/user.php?id='.$rowWP[7].'">'.$rowWP[8].'&nbsp;'.$rowWP[9].'</a></b><br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($rowWP[3])).'</span><br><p class="text" id="small">'.$rowWP[0].'</p></div></div><hr style="padding-bottom:0">';
                 }



      }

    }
}catch(PDOException $e) {
 echo "Error: " . $e->getMessage();
}
       

    ?>

    </div>
   </div>
  </div>
    <div class="col-md-3" style="padding:1em;padding-top:0;padding-right:0">

  <div class="row" style="padding-left:1em;padding-right:0.5em"> 
<!--<div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;padding:1em;padding-left:1.5em;padding-right:1.5em;font-size:12px;padding-bottom:0"> -->
  <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;padding:0;">

        <!--shoutbox table-->
        <table class="table table-bordered" style="margin-top:0em;line-height:0.9;vertical-align:middle;border:0;padding:0" id="shoutbox">
          <thead style="background:#f6f8fa;">
            <th style="font-size:15px;"><b>National Shoutbox</b></th>
          </thead> 
        
       <!--   <tbody style="height:800px;overflow-y:scroll;display:block"> -->
            <tbody style="height:800px;overflow:hidden;">
<?php
      $stmtcom = $db->prepare("SELECT t.firstname, m.msg, m.added, t.region, t.id,hp.name,t.lastname,t.sex,hp.name FROM shoutbox as m LEFT JOIN hr_db as t ON m.hrdbid=t.id LEFT JOIN hr_profilepics as hp on hp.hrdbid=t.id  ORDER BY m.id DESC LIMIT 9");
      $stmtcom->execute();
      while ($row8 = $stmtcom->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
         //   echo '<tr><td style="font-size:12px;vertical-align:middle"><div class="row nopad" style="vertical-align:middle" data-bg-text="'.timeago(strtotime($row8[2])).'"><div class="col-sm-12 nopad" style="text-align:left;line-height:1.1;padding-left:0.7em">'.$row8[1].' -<a href="hr/user.php?id='.$row8[4].'" style="color:#00ADDe;text-decoration:none">'.ucwords(strtolower($row8[0])).'</a></span><span style="color:#888;"> ('.$row8[3].')</span></div><div class="clearfix"></div></div></td></tr>';
        if($row8[8]=="") {
              if($row8[7]==0) {
                  echo '<tr><td style="font-size:12px;vertical-align:middle;width:10%"><div class="row nopad"><div class="col-md-3"><a style="text-decoration:none;" href="../hr/user.php?id='.$row8[4].'"><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$row8[0].' '.$row8[6].'</a> ('.$row8[3].')<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($row8[2])).'</span><br><span style="color:#2c3e50;font-size:12px;font-weight: normal;"><p class="text" id="small">'.$row8[1].'</p></span></div></div></td></tr>';
              } else {
                  echo '<tr><td style="font-size:12px;vertical-align:middle;width:10%"><div class="row nopad"><div class="col-md-3"><a style="text-decoration:none;" href="../hr/user.php?id='.$row8[4].'"><img src="../imgs/female.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$row8[0].' '.$row8[6].'</a> ('.$row8[3].')<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($row8[2])).'</span><br><span style="color:#2c3e50;font-size:12px;font-weight: normal;"><p class="text" id="small">'.$row8[1].'</p></span></div></div></td></tr>';
              }
        } else {
          
              echo '<tr><td style="font-size:12px;vertical-align:middle;width:10%"><div class="row nopad"><div class="col-md-3"><a style="text-decoration:none;" href="../hr/user.php?id='.$row8[4].'"><img src="../docs/profilepics/'.$row8[5].'" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><b>'.$row8[0].' '.$row8[6].'</a> ('.$row8[3].')<br><span style="color:#999;font-size:9px">'.date("M j - h:i a",strtotime($row8[2])).'</span><br><span style="color:#2c3e50;font-size:12px;font-weight: normal;"><p class="text" id="small">'.$row8[1].'</p></span></div></div></td></tr>';
        }        



      }
?>
          </tbody>
        </table>
        <!--shoutbox table-->


        <div class="form-group" style="margin:0;padding:0 1em 0 1em;margin-bottom:1em;">
                    <div class="input-group" style="margin-bottom:0;margin-top:0.8em">
                      <input id="comment" name="comment" class="form-control" placeholder="" style="height:31.4px">
                      <div class="input-group-btn">
                        <button id="postcomment" class="btn btn-primary" style="padding:2px 8px 4px 8px">Post</button>
                      </div>
                    </div><!-- /input-group -->
        </div>
       
      </div>

  </div>
  </div>
  <div class="col-md-3" style="padding:1em;padding-top:0;padding-right:0;padding-left:0.5em">


<div class="row" style="padding-top:0em;padding-left:1em;padding-right:0.5em">
    <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:center;padding:1em;padding-left:1.5em;padding-right:1.5em;">
        <div class="row" style="padding-right:1.6em;margin-bottom:0;padding-bottom:0;padding-left:1.6em">
          <p class="pull-left" style="font-size: 12px; color:#ccc">Posted by: ITU</p>
          <p class="pull-right" style="font-size: 12px; color:#ccc">07 December 2016</p>
        </div>
        <div style="color:#444444;border-collapse:collapse;font-size:14pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;">
        Congratulations SLP!
      </div>
      <img src="http://www.slp.ph/imgs/nprew.png" style="max-width:100%">
      <br><br>
      Our sincerest congratulations on the successful NPREW at Hotel Rembrandt, Quezon City, Metro Manila last Dec. 01-04.
      <br><br>
      <div style="font-size:1em;">
      Reference Videos:<br>
      NPREW 2016: Thrusts and Priorities<br><a href="https://www.youtube.com/playlist?list=PL0FtyzDtfxFkxmKnVtptLqeLVvhFVQiBy"><span class="label label-danger">Watch Here</span></a><br><br>
      NPREW 2016: Issues and Concerns<br><a href="https://www.youtube.com/playlist?list=PL0FtyzDtfxFlDpGAQ5lPTclR00RbifxJ1"><span class="label label-danger">Watch Here</span></a>
      </div><br>
    </div>
  </div>

<div class="row" style="padding-top:1em;padding-left:1em;padding-right:0.5em">
    <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:center;padding:1em;padding-left:1.5em;padding-right:1.5em;">
        <div class="row" style="padding-right:1.6em;margin-bottom:0;padding-bottom:0;padding-left:1.6em">
          <p class="pull-left" style="font-size: 12px; color:#ccc">Posted by: ITU</p>
          <p class="pull-right" style="font-size: 12px; color:#ccc">22 September 2016</p>
        </div>
        <div style="color:#444444;border-collapse:collapse;font-size:14pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;">
        Organize E-Library into folders? We hear you!
      </div>
      <br>
      <img src="http://www.slp.ph/imgs/elibraryupdate.png" style="max-width:100%">
      <br>
      Thanks for the feedback. Your suggestions have helped make <a href="http://www.slp.ph" style="text-decoration:none;color:#4583ed">SLP.PH</a> COOLer and better with its E-Library update!
      <br><br>
      <b>But we're not done!</b>
      <br>
      You can help make it even better by uploading:
      <div>
          <ul style=" display: inline-block;
        text-align:left;">
            <li>Manuals and Guides</li>
            <li>Policy Documents</li>
            <li>Templates and Forms</li>
          </ul>
      </div>
      <span style="text-align:justify">As an incentive, we are giving an <span style="color:#2ecc71;font-weight:bold">additional 20 bytez for <b>all</b> E-Lib uploads that fall under the above categories</span> (promo runs til Sept. 31)! Again, thank you for your continued support. Happy working!</span>
      <br>
      <br>
    </div>
  </div>


  </div>
  <div class="col-md-3" style="padding:1em;padding-top:0em;border:0px solid blue;padding-left:0.5em;padding-right:0.5em;margin-top:0">
  <div class="col-md-11" style="padding-right:0">
      
      <div style="border:0px solid blue;margin-top:0;padding-top:0">

          <div style="position:relative;margin-top:0">
            <div style="text-align:center;padding-right:4em;border-radius:5px;color:#fff;padding-top:1em;padding-bottom:1em;font-size:15px;padding-left:0" class="hoverme">
              <div class="background" style="font-size:40px"><span class="glyphicon glyphicon-user"></span></div>
              <h3 style="margin-bottom:0;margin-top:0;display:inline-block;color:#fff;font-weight:900" id="hr1"></h3> / <h3 style="color:#fff;margin-bottom:0;margin-top:0;display:inline-block;font-size:16px" id="hr2"></h3><br>
              <span style="color:#fff">Confirmed Accounts</span>
            </div>
          </div>

          <div style="margin-top:1em;position:relative">
            <div style="text-align:center;padding:0;border-radius:5px;padding:1em;color:#fff" class="hoverme">
              <div class="background" style="font-size:24px"><span class="glyphicon glyphicon-home"></span></div>
              <div class="background_left" style="font-size:40px"><img src="imgs/building.png" style="width:30px;opacity:0.3"></div>
              
              <div style="border:0px solid;padding-left:1.5em;padding-right:1.5em">
                <table style="width:100%;border:0px solid">
                  <tr>
                        <td style="border-right:1px solid">
                          <h3 style="margin-bottom:0;margin-top:0;display:inline-block;color:#fff;font-weight:900;font-size:24px" id="hb1"></h3>
                          <br>Demand
                        </td>
                        <td>
                          <h3 style="margin-bottom:0;margin-top:0;display:inline-block;color:#fff;font-weight:900;font-size:24px" id="hb2"></h3>
                          <br>Supply
                        </td>
                  </tr>
                </table>
              </div>

            </div>
          </div>

    <div style="position:relative;margin-top:1em">
      <div style="text-align:center;padding-right:4em;border-radius:5px;color:#fff;padding-top:1em;padding-bottom:1em;font-size:15px;padding-left:0" class="hoverme">
        <div class="background" style="font-size:40px"><img src="imgs/keyboard.png" style="width:36px;opacity:0.3;margin-bottom:10px"></div>
        <h3 style="margin-bottom:0;margin-top:0;display:inline-block;color:#fff;font-weight:900" id="by1"></h3><br>
        <span style="color:#fff">Bytez of User Activity</span>
      </div>
    </div>
</div>


<div class="dashpanel" style="margin-top:1em;position:relative;">
          <table class="table table-bordered" style="margin-top:0em;line-height:0.9;vertical-align:middle;border:0;margin-bottom:1em">
              <thead style="background:#f6f8fa">
                <th><b>Feedback for System Development</b></th>
              </thead>
          </table>
          
          <div class="form-group" style="vertical-align:middle;margin-bottom:1em;padding-bottom:1em">
              <div class="col-sm-4">
                Currently Viewing:
              </div>
              <div class="col-sm-8">
                    <select class="form-control" onchange="filterCategory()" id="filterstatus">
                      <option value="3">Completed</option>
                      <option value="2">In Development</option>
                      <option value="1">For discussion</option>
                      <option value="0" selected>New</option>
                    </select>
              </div>
          </div><br>
          <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;width:100%;margin-bottom:0;margin-top:1em">
                    <thead style="background:#f6f8fa">
                      <tr>
                        <th></th>
                        <th>Submitted Feedback</th>
                        <th>Votes</th>
                        <th>Status &nbsp;<span class="glyphicon glyphicon-question-sign" id="tooltip2" data-toggle="popover" data-original-title="Status" data-content="<span class='glyphicon glyphicon-ok colgreen'></span> <span style='font-size:13px'>- Accepted / Completed</span><br><span class='glyphicon glyphicon-adjust' style='color:#5cb85c'></span> <span style='font-size:13px'>- Accepted / Queued</span><br><span class='glyphicon glyphicon-eye-open' style='color:#f0ad4e'></span> <span style='font-size:13px'>- Viewed / For Discussion</span>" rel="popover" data-placement="top" data-trigger="hover" style="margin-top:3px"></span></th>
                        <th>Already?</th>
                        <th></th>
                      </tr>
                    </thead>
              </table>
      </div>




  </div>

  </div>
</div>
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
<script src="js/countUp.js"></script>
<script type="text/javascript" src="js/feedback.js"></script>
<script>
$("#tooltip1").popover({html : true});
$("#tooltip2").popover({html : true});

$("#comment").keyup(function (e) {
    if (e.keyCode == 13) {
      if ($("#comment").val() == "") {
        return false;
      }
  $("#postcomment").html("...");
  document.getElementById("postcomment").disabled = true;
    var formData = {
      'action'        : "comment",
      'hrdbid'       : "<?php echo $_SESSION['id']; ?>",
      'comment'       : $('input[name=comment]').val()
    };
                $.ajax({
                   url: "addcomment.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "commented") {
                        $("#shoutbox").prepend('<tr><td style="font-size:12px;vertical-align:middle"><div class="row nopad" style="vertical-align:middle" data-bg-text="now"><div class="col-sm-12 nopad" style="text-align:left;line-height:1.1;padding-left:1em"> '+$('input[name=comment]').val()+' -<a href="http://slp.ph/hr/viewdata/user.php?id=" style="color:#00ADDe;text-decoration:none"><?php echo $_SESSION["firstname"]; ?></a></span><span style="color:#888;"> (<?php echo $_SESSION["filter"];?>)</span></div><div class="clearfix"></div></div></td></tr>');
                        $("#comment").val("");
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
      'hrdbid'       : "<?php echo $_SESSION['id']; ?>",
      'comment'       : $('input[name=comment]').val()
    };
                $.ajax({
                   url: "addcomment.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "commented") {
                        $("#shoutbox").prepend('<tr><td style="font-size:12px;vertical-align:middle"><div class="row nopad"><div class="col-md-3"><a style="text-decoration:none;" href="../hr/user.php?id="><img src="../imgs/partner.png" width="50" height="50" style="border-radius:50%"></div><div class="col-md-9"><a href="http://slp.ph/hr/viewdata/user.php?id=" style="font-weight:bold;text-decoration:none"><?php echo $_SESSION["firstname"].' '.$_SESSION["lastname"]; ?></a>&nbsp;</span><span style="font-weight:bold">(<?php echo $_SESSION["filter"];?>)</span> <span style="color:#888;"> <br>now</span><br>'+$('input[name=comment]').val()+'</div><div class="clearfix"></div></div></td></tr>');
                        
                          



                        $("#comment").val("");
                      } else {
                        alert(data);
                      }
                        $("#postcomment").html("Post");
                        document.getElementById("postcomment").disabled = false;
                   }
                });
                //endAjax
}); //endpost
console.log('<?php echo json_encode($totalarray); ?>');
$.fn.DataTable.ext.pager.numbers_length = 2;
  oTable = $('#viewdata').dataTable({
    "aProcessing": true,
    "aServerSide": true,
    "orderCellsTop": true,
    "oLanguage": {
          "oPaginate": {
          "sPrevious": "",
          "sNext": "",
          }
    },
    "pageLength": 4,
    "order": [[2, "desc" ]],
    "ajax": "dt_feedbackmain.php",
    "dom": '<"top">rt<"bottom"><"row"<"pagermid"p>><"clear">',
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
                    $(nTd).css('text-align', 'left');
                    $(nTd).css('font-size', '13px');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return '<td>'+data[1]+'</td>';
                }
            },
            { 
               "aTargets":[2],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                    $(nTd).css('width', '10%');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    if (data[4]>0) {
                      return '<td><b style="font-weight:900;font-size:20px">'+data[2]+'</b><br><span class="label label-danger" onclick="triggerVote('+data[0]+',0)" style="cursor:pointer">Unvote</span></td>';
                    } else {
                      return '<td><b style="font-weight:900;font-size:20px">'+data[2]+'</b><br><span class="label label-success" onclick="triggerVote('+data[0]+',1)" style="cursor:pointer"><span class="glyphicon glyphicon-arrow-up"></span> Vote</span></td>';
                    }                    
                }
            },
            { 
               "aTargets":[3],
               "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                {
                    $(nTd).css('text-align', 'center');
                    $(nTd).css('width', '18%');
                },
                "mData": null,
                "mRender": function( data, type, full) {
                    return "<td>"+data[3]+"</td>";
                }
            },
            { "bVisible": false, "aTargets":[0,3,4,5] }
                    ]
  });
oTable.fnFilter("0", 3, true, false, true);
oTable.fnSort([5,'desc']);
function filterCategory() {
  var category = document.getElementById("filterstatus").value;
  if (category == "") {
    oTable.fnFilter("", 3, true, false, true);
  } else {
    oTable.fnFilter("^"+category+"$", 3, true, false, true);
    oTable.fnSort( [0,'desc'] );
  }
}

$("#profileBtn").click(function(event) {
     $("#loadoverlay").show();
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
                      $('#myModal').modal();
                       $("#uploadprofile").hide()
                      $('#myModal').on('hidden.bs.modal', function () {
                          location.href = "user.php?id=<?php echo $_SESSION['pageid']; ?>";
                      })
                    } else {
                      alert(data);
                    }
                }
          });
    });
/////////////////////////////////////////////////////////

$("#sendfeedback").click(function(event) {
      sendFeedback("maindashboard",$('textarea[name=feedback]').val(),"<?php echo $_SESSION['id']; ?>");
});
  function triggerVote(str,str2) {
    var formData = {
              'action' : str2, 
              'feedbackid' : str
            };
    $.ajax({
                   url: "castvote.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "good") {
                        $("#sucsubtext").html("Vote updated.")
                        $('#myModal').modal();
                        $('#myModal').on('hidden.bs.modal', function () {
                            location.reload();
                        })
                      } else if (data == "alreadyvote") {
                        alert("You already voted for this");
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
  }

var options = {
  useEasing : true, 
  useGrouping : true, 
  separator : ',', 
  decimal : '.', 
  prefix : '', 
  suffix : '' 
};
var c1 = new CountUp("hr1", 0, "<?php echo $totalarray[0]; ?>", 0, 2.5, options);
var c2 = new CountUp("hr2", 0, "<?php echo $totalarray[1]; ?>", 0, 2.5, options);
var c3 = new CountUp("hb1", 0, "<?php echo $totalarray[2]; ?>", 0, 2.5, options);
var c4 = new CountUp("hb2", 0, "<?php echo $totalarray[3]; ?>", 0, 2.5, options);
var c5 = new CountUp("by1", 0, "<?php echo $totalarray[5]; ?>", 0, 2.5, options);
c1.start();
c2.start();
c3.start();
c4.start();
c5.start();
</script>
</body>
</html>
