<?php
require "../zxcd9.php";
if (isset($_POST['resendid'])) {
  $_SESSION['resendid'] = $_POST['resendid'];
  die("visitpage");
}
        $stmt = $db->prepare("SELECT * FROM doc_db WHERE id=:id ");
        $stmt->bindParam(':id', $_SESSION['resendid']);
        $stmt->execute();
        $rowe = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | VR Cabinet</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" href="../css/pikaday.css"/>
    <link href="../css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="../css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/tag-it.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
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
     background: #ff3030;
     -webkit-animation-delay: -1.2s;
     animation-delay: -1.2s;
}
.spinner .bounce2 {
     background: #fee123;
     -webkit-animation-delay: -0.8s;
     animation-delay: -0.8s;
}

.spinner .bounce3 {
    background: #0071ce;
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
</style>
</head>
<body>
<div class="loader vcenter" style="display:none;" id="loadoverlay">
    <div class="spinner" style="margin-top:-2em;text-align:center">
      <h3 style="font-weight:normal;display:block">Resending..</h3><br>
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
</div>
  <div id="slideout">
    <img src="http://slp.ph/imgs/feedback.png" alt="Feedback" />
    <div id="slideout_inner">
      <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;display:none"></span>
      <div id="formz">
      <form>
          <div class="form-group">
            <div class="col-sm-12">
                <textarea name="feedback" maxlength="250" class="form-control" id="feedback" placeholder="Any comments or suggestions are welcome!" style="resize:none;padding-top:8px;padding-bottom:8px;" rows="3"></textarea>
            </div>
          </div>
      </form>
          <div class="form-group">
              <button class="btn btn-primary" id="sendfeedback" style="padding:4px;margin-left:1em">Submit</button>
          </div>
      </div>
    </div>
  </div>
<?php include "../nav.php"; ?>
<script>
emailmaster = [];
i = 0;
function changeValue2(str){
      $("#nonesel").hide();//noneselected placeholder
      var option=$("#"+str+" option:selected").val();//get selected
      $("#subsector").tagit("createTag", option);//create tag
      $('#'+str).get(0).selectedIndex = 0;//reset selector
      if (str=="recip_region") {//if region
          var aData = { 
            'action'    : "getemails_regions", 
            'filter'    : option
          }
          $("#recip_region").prop('disabled',true);
          $.ajax({
             url: "functions.php",
             type: "POST",
             data: aData,
             success: function(data)
             {
                emailmaster.push([option,data]);
                console.log(emailmaster);
             },
             dataType:"json"
          });//endajax
      }
      if (str=="recip_rpmo") {//if region
          var aData = { 
            'action'    : "getemails_rpmo", 
            'filter'    : option
          }
          $.ajax({
             url: "functions.php",
             type: "POST",
             data: aData,
             success: function(data)
             {
                emailmaster.push([option,data]);
                console.log(emailmaster);
             },
             dataType:"json"
          });//endajax
      }
      if (str=="recip_npmo") {//if npmo
          if (option == "All NPMO") {
              aData = { 
                'action'    : "getemails_npmo_all", 
                'filter'    : option
              }
          } else if (option == "Director") {
              aData = { 'action'    : "getemails_rpmo", 'filter'    : option}
          } else if (option == "DPM - PMEF") {
              aData = { 'action'    : "getemails_rpmo", 'filter'    : option}
          } else if (option == "DPM - OPS") {
              aData = { 'action'    : "getemails_rpmo", 'filter'    : option}
          } else {
              aData = { 
                'action'    : "getemails_npmo", 
                'filter'    : option
              }
          }
          $.ajax({
             url: "functions.php",
             type: "POST",
             data: aData,
             success: function(data)
             {
                emailmaster.push([option,data]);
                console.log(emailmaster);
             },
             dataType:"json"
          });//endajax
      }
}
function removeIsRegion(str) {
  var regionlistarray = ["NCR","CAR","REGION I","REGION II","REGION III","REGION IV-A","REGION IV-B","REGION V","REGION VI","REGION VII","REGION VIII","REGION IX","REGION X","REGION XI","REGION XII","CARAGA","ARMM","NIR"]
  if (regionlistarray.indexOf(str) > -1) {
      $("#recip_region").prop('disabled',false);
  }
}
function getEmail(str,str2) {
          var aData = { 
            'action'    : "getemails_individual", 
            'filter'    : str
          }
          $.ajax({
             url: "functions.php",
             type: "POST",
             data: aData,
             success: function(data)
             {
                emailmaster.push([str2,data]);
                console.log(emailmaster);
             },
             dataType:"json"
          });//endajax
}
function typeChange(){
      var option=$("#doctypeselector option:selected").html();
      if (option == "Internal Memorandum (within CO)" || option == "External Memorandum (to regions)") {
        $("#emaildoctype").html("memorandum");
      } else {
        $("#emaildoctype").html(option);
      }
}
</script>
<div class="container-fluid">
  <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
      <div class="row">
          <div class="col-md-12" id="searchblock">
                <div class="col-md-offset-2 col-md-8" style="margin-top:0">
                  <h2 style="font-weight:bold;margin-bottom:0">Resend</h2>
                  File: <span style="color:#00ADDe"><?php echo $rowe['title'];?></span>
<form id="myForm" method="POST" enctype="multipart/form-data">
                  <div id="notificationpanel" style="margin-top:1em;">
                    <hr>
                    Email notifications will be sent to the selected recipients. Please note that due to technical restrictions, we can only notify one (1) region at a time (for now). There are no restrictions for NPMO or RPMO group recipients.
                    <br><br>
                    <b>Notify Groups</b><br>
                    <div class="col-md-4" style="margin-left:0;padding-left:0;padding-right:0">
                      <div class="form-group">
                          <select onchange="changeValue2(this.id)" class="form-control" id="recip_npmo">
                            <option value="">Select NPMO</option>
                            <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM lib_npmo order by npmoname");
                              //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                        while($npmoname=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <option value=" <?php echo $npmoname['npmoname']; ?>"> <?php echo $npmoname['npmoname']; ?> </option>
                      <?php
                        }
                              } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                        ?>
                      </select>
                    <!-- upto this -->      
                      </div>
                  </div>
                  <div class="col-md-4" onchange="changeValue2(this.id)" style="padding-right:0;padding-left:0" id="recip_rpmo">
                      <div class="form-group">
                          <select class="form-control">
                            <option value="">Select RPMO</option>
                            <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM lib_rpmo order by rpmoname");
                              //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                        while($rpmoname=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <option value=" <?php echo $rpmoname['rpmoname']; ?>"> <?php echo $rpmoname['rpmoname']; ?> </option>
                      <?php
                        }
                              } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                        ?>
                      </select>
                    <!-- upto this -->           
                      </div>
                  </div>
                  <div class="col-md-4" style="margin-right:0;padding-right:0;padding-left:0" >
                      <div class="form-group">
                          <select class="form-control" onchange="changeValue2(this.id)" id="recip_region">
                            <option value="">Select Entire Region</option>
                            <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM lib_regions order by regname");
                              //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                        while($regname=$sql->fetch(PDO::FETCH_ASSOC))
                        {
                      ?>
                        <option value=" <?php echo $regname['regname']; ?>"> <?php echo $regname['regname']; ?> </option>
                      <?php
                        }
                              } catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                            }//en
                        ?>
                      </select>
                    <!-- upto this -->  
                      </div>
                  </div>
    <?PhP
    $sql = "SELECT id, CONCAT(lastname, ', ', firstname) as name FROM hr_db";
    $partnerIDArray = [];
    $partnerArray = [];

    foreach ($db->query($sql) as $results)
    {
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
    $(document).ready(function() {
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
            $("#nonesel").hide();//noneselected placeholder
            window.selectPartner = suggestion.data;
            getEmail(suggestion.data, suggestion.value);
            $("#subsector").tagit("createTag", suggestion.value);
            $('#autocompleteajax').val('');
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
    $('#autocompleteajax2').autocomplete({
        lookup: countriesArray,
        lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
            var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
            return re.test(suggestion.value);
        },
        onSelect: function(suggestion) {
            $('#autocompleteajax2').val(suggestion.value);
            window.selectPartner2 = suggestion.data;
        },
        onHint: function (hint) {
            $('#autocomplete-ajax-x-2').val(hint);
        },
        onInvalidateSelection: function() {
        }
    });
});
});
</script>
                  <b>Notify Individuals</b><br>
                  <div class="form-group">
                    <input type="text" name="autocompleteajax" id="autocompleteajax" class="form-control" placeholder="Search for individuals.."/>
                    <input type="hidden" id="autocomplete-ajax-x" disabled="disabled"/>
                  </div>
                  <div class="col-md-2" style="margin-bottom:2em;text-align:left;margin-top:0.5em">
                    <b>RECIPIENTS:</b>
                  </div>
                  <div class="col-md-10" style="margin-bottom:1em"><div id="nonesel" style="display:inline;margin-left:0;padding-left:0;margin-top:1em;line-height:32px"><i>-none selected-</i></div>
                    <input name="subsector" id="subsector" value="" type="">
                  </div>
                  <b>Email Message Preview</b>
                  <div class="form-group" style="border:1px solid #000;" id="emailpreview">
                    <?php
                    if ($rowe['doctype']=="Blast") {
                    ?>
                  <div class="bodycontainer" style="margin-top:1em;margin-bottom:1em">
                  <div style="padding:0;width:100%!important;margin:0" marginheight="0" marginwidth="0"><center><table cellpadding="8" cellspacing="0" style="padding:0;width:100%!important;background:#ffffff;margin:0;background-color:#ffffff" border="0"><tr><td valign="top">
                  <table cellpadding="0" cellspacing="0" style="border-radius:4px;border:1px #dceaf5 solid;border-collapse:none" border="0" align="center">
                  <tr><td><table cellpadding="0" cellspacing="0" style="line-height:25px" border="0" align="center"><tr><td colspan="3" height="30"></td></tr><tr><td width="36"></td>
                  <td width="454" align="center" style="color:#444444;border-collapse:collapse;font-size:9pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;max-width:454px" valign="top">
                  <div style="border:1px solid #ccc;background:#e1e1e1;height:130px;width:90%;vertical-align:middle;font-size:12px;line-height:1.1"><h3>Your image here</h3><br>Recommended file size: 500kb<br>Larger file size may not load on mobile devices</div>
                  Cant see this image? <a href="#" style="color:#4583ed">Click here</a>
                  <td width="36"></td></tr><tr><td colspan="3" height="36"></td></tr></table></td></tr></table><table cellpadding="0" cellspacing="0" align="center" border="0"><tr><td height="10"></td></tr><tr><td style="padding:0;border-collapse:collapse"><table cellpadding="0" cellspacing="0" align="center" border="0"><tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;"><td width="200" align="left"></td>
                  <td width="328" align="right"><span style="font-size:12px">Sent through <a href="http://slp.ph" style="text-decoration:none;color:#4583ed">SLP Online</a> by <span id="emailfrom"><?php echo $_SESSION["fullname"]; ?></span></span><br></td></td>
                  </tr></table></td></tr></table></td></tr></table></center></div></div>
                  <hr style="margin-bottom:0">
                    <?php
                    } else {
                    ?>
<!--EMAIL-->
                  <div class="bodycontainer" style="margin-top:1em;margin-bottom:1em">
                  <div style="padding:0;width:100%!important;margin:0" marginheight="0" marginwidth="0"><center><table cellpadding="8" cellspacing="0" style="padding:0;width:100%!important;background:#ffffff;margin:0;background-color:#ffffff" border="0"><tr><td valign="top">
                  <table cellpadding="0" cellspacing="0" style="border-radius:4px;border:1px #dceaf5 solid;border-collapse:none" border="0" align="center"><tr><td colspan="3" height="6"></td></tr><tr style="line-height:0px"><td width="100%" style="font-size:0px" align="center" height="1">
                    <img width="40px" style="max-height:104px;width:55px;margin-top:15px" alt="" src="http://slp.ph/imgs/emailslplogo.png"></td></tr><tr><td><table cellpadding="0" cellspacing="0" style="line-height:25px" border="0" align="center"><tr><td colspan="3" height="30"></td></tr><tr><td width="36"></td>
                  <td width="454" align="left" style="color:#444444;border-collapse:collapse;font-size:11pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;max-width:454px" valign="top">
                    Dear Sir/Madam,<br><br>
                    This is to provide you with a copy of the <b id="emaildoctype" style="color:red">Doc Type</b> with subject <b id="emailsubject" style="color:red">Document Title / Subject</b> <span id="emaildate"></span>.
                    <br><br>
                    <i id="emailsummary" style="color:red">Remarks / Summary</i>
                    <br><br>
                    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#18bc9c; border:0px solid #4285f4; border-radius:5px;">
                              <tr>
                  <td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:140%; padding-top:9px; padding-right:26px; padding-bottom:8px; padding-left:26px;">
                    <a href="" target="_blank" style="color:#FFFFFF; text-decoration:none;">View Details</a>
                  </td>
                  <td align="center" valign="middle" style="background-color:#4285f4; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:140%; padding-top:9px; padding-right:26px; padding-bottom:8px; padding-left:26px; border-radius:5px;border-top-left-radius: 0px;border-bottom-left-radius: 0px">
                    <a href="" target="_blank" style="color:#FFFFFF; text-decoration:none;">Download</a>
                  </td>
            </tr>
  </table>
  <br>
  Thank you for your usual support and cooperation. Happy working!
  <br>
    </td>
                <td width="36"></td>
                </tr><tr><td colspan="3" height="36"></td></tr></table></td></tr></table><table cellpadding="0" cellspacing="0" align="center" border="0"><tr><td height="10"></td></tr><tr><td style="padding:0;border-collapse:collapse"><table cellpadding="0" cellspacing="0" align="center" border="0"><tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;"><td width="200" align="left"></td>
                <td width="328" align="right"><span style="font-size:12px">Sent through <a href="http://slp.ph" style="text-decoration:none;color:#4583ed">SLP Online</a> by <span id="emailfrom"><?php echo $_SESSION['fullname']; ?></span></span></td>
                </tr></table></td></tr></table></td></tr></table></center></div>

                  </div>
                  <hr style="margin-bottom:0">
                  <!--EMAIL-->
                    <?php
                    }
                    ?>

                </div><!--end notifpanel-->    
              </form>
          </div>
          <div class="col-md-12" style="padding-right:0">
                  <button id="uploadBtn" class="btn btn-success pull-right" style="padding:6px 10px 6px 10px;margin-top:0.8em"><span class="glyphicon glyphicon-cloud-upload"></span> Send Notification</button>
          </div>
      </div>
  </div>
</div>
</div>
<!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
        <div class="modal-dialog modal-sm">
          <div class="modal-content" style="padding:1em;padding-top:0.5em;">
                  <h3 style="color:#5cb85c;margin-bottom:6px">Resent!</h3>
                  <span style="font-size:13px">Note: Emails sent may take 30mins to arrive</span><br><br>
                  <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                  <div class="clearfix"></div>
          </div>
        </div>
      </div>
      <!-- Modal -->
<script>
$(document).ready(function() {
$('#subsector').tagit({
        readOnly: true,
        onTagClicked: function(evt, ui) {
            var tagname = $('#subsector').tagit('tagLabel', ui.tag);
            $("#subsector").tagit("removeTagByLabel", tagname);
        },
        beforeTagRemoved: function(event, ui) {
            var tagname = $('#subsector').tagit('tagLabel', ui.tag);
            console.log(tagname);
            removeIsRegion(tagname);
            for(var k = 0; k < emailmaster.length; k++){
                if(emailmaster[k][0] == tagname){
                    emailmaster.splice(k,1);
                }
            }
            var emailindex = emailmaster.indexOf(tagname);
            console.log(emailmaster);
        }
});
        //$("#angelimg").hide().delay( 400 ).fadeIn( 500 );
        //$("#searchblock").hide().delay( 1000 ).slideDown( 400 );

$("#uploadBtn").click(function(event) {
    if ($('#doctypeselector option:selected').val() == "") {
      alert("Please select Document Type");
      return false;
    }
    if ($('input[name=dsubject]').val() == "") {
      alert("Please enter Document Title / Subject");
      return false;
    }
    emailfinal = [];
    for (var i in emailmaster) {
      emailfinal.push(emailmaster[i][1]);
    }
     $("#loadoverlay").show();
     var fd = new FormData;                  
     fd.append('action', 'resend');
     fd.append('docid', '<?php echo $_SESSION["resendid"]; ?>');
     fd.append('docfilename', '<?php echo $rowe["filename"]; ?>');
     fd.append('doctype', '<?php echo $rowe["doctype"]; ?>');
     fd.append('docsubject', '<?php echo $rowe["title"]; ?>');
     fd.append('docauthor', '<?php echo $rowe["docauthor"]; ?>');
     fd.append('docdate', '<?php echo $rowe["docdate"]; ?>');
     fd.append('remarks', '<?php echo $rowe["remarks"]; ?>');
     fd.append('emailarray', emailfinal.toString());
     $.ajax({
                url: 'functions.php',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: fd,                         
                type: 'post',
                success: function(data){
                    $("#loadoverlay").hide();
                    if (data=="Success") {
                      $('#myModal').modal();
                      $('#myModal').on('hidden.bs.modal', function () {
                          location.href = "http://slp.ph/vrcabinet";
                      })
                    } else {
                      alert(data);
                    }
                }
      });
});
});
</script>
<script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
</body>
</html>
