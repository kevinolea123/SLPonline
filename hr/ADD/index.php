<?
require "../../zxcd9.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | HR</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="..imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="..imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/flatbootstrap.css"/>
    <link rel="stylesheet" href="../../css/bootstrapValidator.css"/>
    <script src="../../js/jquery-1.10.2.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../js/bootstrapValidator.js"></script>
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
.successcontent {
  display: none;
}
.cleanselect {
  -webkit-appearance:none;-moz-appearance:none;-ms-appearance:none;appearance:none;background:#fff url(../../imgs/arrows.png) no-repeat right 9px;
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
      position: fixed;
      top: 25%;
      left: 0;
      width: 35px;
      padding: 12px 0;
      text-align: center;
      background: #6DAD53;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      -webkit-border-radius: 0 5px 5px 0;
      -moz-border-radius: 0 5px 5px 0;
      border-radius: 0 5px 5px 0;
    }
#slideout_inner {
      position: fixed;
      top: 25%;
      left: -250px;
      background: #6DAD53;
      width: 250px;
      padding: 0;
      height: 165px;
      -webkit-transition-duration: 0.3s;
      -moz-transition-duration: 0.3s;
      -o-transition-duration: 0.3s;
      transition-duration: 0.3s;
      text-align: left;
      -webkit-border-radius: 0 0 5px 0;
      -moz-border-radius: 0 0 5px 0;
      border-radius: 0 0 5px 0;
    }
#slideout_inner textarea {
      width: 190px;
      height: 100px;
      margin-bottom: 6px;
    }
#slideout:hover {
      left: 250px;
    }
#slideout:hover #slideout_inner {
      left: 0;
    }
</style>
</head>
<body>
  <div id="slideout">
    <img src="http://img.usabilitypost.com.s3.amazonaws.com/1104/css_slideout/feedback.png" alt="Feedback" />
    <div id="slideout_inner">
      <span id="loadicon2" class="glyphicon glyphicon-refresh spin" style="color:#fff;font-size:50px;padding:10px;"></span>
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
<?php
include "../../nav.php";
if ($_SESSION['permlvl'] < 1) {
  echo "<div class='container-fluid'><div class='col-md-offset-2 col-md-8' style='margin-top:5em;text-align:center'><img src='../imgs/search.png'><br><br>Access to this function is only available to <b>HR focals.</b><br>If you believe you should have access to this, please send an email to jmodelacruz@e-dswd.net.";
  die;
}
?>
<script type="text/javascript" src="../../js/hrForm.js"></script>
<div class="container-fluid">
    <div class="row">
      <!--ifsuccess-->
      <div class="col-md-offset-2 col-md-8 successcontent">
        <center>
          <br><font size="70px" color="#5cb85c"><img src="../../imgs/upload.png">
          <br>Success!</font>
          <br><font size="4px">Your input has been added to the database.</font>
          <br><br><button class="btn btn-success" id="btnAddnew">Add new record</button>
      </div>
      <!--end ifsuccess-->
        <div class="col-md-offset-2 col-md-8" id="maincontent">
            <div class="row">
              <div class="col-sm-12" role="alert" style="border:0px solid;padding:5px 0px 15px 0px;font-size:20px">
                <center><img src="../../imgs/slplogo_med.png" width="100em"><br>
                Hi! Please fill out the form.
              </div>
            </div>
<script>
var sex;
function ismale() {
  sex = "0";
  console.log(sex);
}
function isfemale() {
  sex = "1";
  console.log(sex);
}
</script>
<form class="form-horizontal" id="hrForm" method="post" action="" autocomplete="off">
                          <div class="form-group">
                            <label for="firstname" class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-10">
                              <input name="firstname" class="form-control" id="firstName" placeholder="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="midname" class="col-sm-2 control-label">Middle Name</label>
                            <div class="col-sm-10">
                              <input name="midname" class="form-control" id="midName" placeholder="">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-10">
                              <input name="lastname" class="form-control" id="lastName" placeholder="">
                            </div>
                          </div>
                          <div class="row" >
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="nickname" class="col-sm-4 control-label">Nick Name</label>
                                  <div class="col-sm-8">
                                    <input name="nickname" class="form-control" id="nickname" placeholder="">
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="extname" class="col-sm-4 control-label">Ext Name</label>
                                  <div class="col-sm-8">
                                    <input name="extname" class="form-control" id="extName" placeholder="e.g.: Jr., Sr.">
                                  </div>
                                </div>
                              </div>
                          </div>
                           <div class="row" >
                              <div class="col-sm-6">
                                  <div class="form-group">
                                        <label for="sex" class="col-sm-4 control-label">Sex</label>
                                        <div class="radio col-sm-4">
                                          <label>
                                            <input type="radio" name="sex" value="0" onclick="ismale()"/> Male
                                        </label>
                                        </div>
                                        <div class="radio col-sm-4">
                                          <label>
                                            <input type="radio" name="sex" value="1" onclick="isfemale()"/> Female
                                        </label>
                                        </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Birthdate</label>
                                      <div class="col-sm-8">
                                          <input type="text" class="form-control" name="birthdate" id="birthdate" placeholder="MM/DD/YYYY" />
                                      </div>
                                  </div>
                                </div>
                          </div>
                          <div class="row" >
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="emailaddress" class="col-sm-4 control-label">Email</label>
                                  <div class="col-sm-8">
                                    <input name="emailaddress" class="form-control" id="emailaddress" placeholder="you@e-dswd.net">
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="extName" class="col-sm-4 control-label">Mobile Number</label>
                                  <div class="col-sm-8">
                                    <input class="form-control" name="contactnumber" id="contactnumber" placeholder="09991234567">
                                  </div>
                                </div>
                              </div>
                        </div>
                        <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="designation" class="col-sm-4 control-label">Designation</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" name="designation" id="designation">
                                          <option value="" selected>Select Designation</option>
                                         <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_designation order by hrdesignationname");
                              //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                      while($hrdesignationname=$sql->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                        <option value=" <?php echo $hrdesignationname['hrdesignationname']; ?>"> <?php echo $hrdesignationname['hrdesignationname']; ?> </option>
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
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="designation" class="col-sm-4 control-label">Position</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" id="position" name="position" id="position">
                                          <option value="" selected>Select Position</option>
                                          <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_position order by hrpositionname");
                              //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                              $sql->execute();
                         //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                        
                        while($hrpositionname=$sql->fetch(PDO::FETCH_ASSOC)){
                      ?>
                        <option value=" <?php echo $hrpositionname['hrpositionname']; ?>"> <?php echo $hrpositionname['hrpositionname']; ?> </option>
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
                              </div>
                         </div>
                        <div class="row">
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="designation" class="col-sm-4 control-label">Employment Status</label>
                                <div class="col-sm-8">
                                      <select class="form-control cleanselect" name="employstatus" id="employstatus">
                                        <option value="" selected>Select Status</option>
                                        <option>Regular</option>
                                        <option>Contractual</option>
                                        <option>MOA</option>
                                        <option>Job Order</option>
                                      </select>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6">
                              <div class="form-group">
                                <label for="designation" class="col-sm-4 control-label">Fund Source</label>
                                <div class="col-sm-8">
                                      <select class="form-control cleanselect" name="fundsource" id="fundsource">
                                        <option value="" selected>Select Source</option>
 <!-- get this --> 
                      <?php
                      try {
                              $sql = $db->prepare("SELECT * FROM libhr_fundsource order by hrfundsourcename");
                              $sql->execute();
                        
                                      while($hrfundsourcename=$sql->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                      <option value=" <?php echo $hrfundsourcename['hrfundsourcename']; ?>"> <?php echo $hrfundsourcename['hrfundsourcename']; ?> </option>
                                    <?php
                                      }
                      } catch(PDOException $e) {
                              echo "Error: " . $e->getMessage();
                      }
                        ?>
                      </select>
<!-- up to this -->   
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-6">
                                              <div class="form-group">
                                                  <label class="col-sm-4 control-label">Date of Employment</label>
                                                  <div class="col-xs-8">
                                                      <input type="text" class="form-control" name="employdate" id="employdate" placeholder="MM/DD/YYYY" />
                                                  </div>
                                              </div>
                                            </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Regional Office</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="region" id="region" onchange="getProv()" required>
                                            <option value="" selected>Select Office</option>
                  <?php
                      $query = "SELECT * FROM lib_regions"; 
                      try 
                      { $stmt = $db->prepare($query); $result = $stmt->execute(); } 
                      catch(PDOException $ex) 
                      { die("Failed to run query: " . $ex->getMessage()); } 
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                         echo "<option value='".$row["regid"]."'>".$row['regname']."</option>";
                      }
                  ?>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                        </div>
                        <div class="row">
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="designation" class="col-sm-4 control-label">Province</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" id="province" name="province" onchange="getCitymun()">
                                          <option value="" selected>-</option>
                                        </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-6">
                                <div class="form-group">
                                  <label for="designation" class="col-sm-4 control-label">Municipality</label>
                                  <div class="col-sm-8">
                                        <select class="form-control cleanselect" id="municipality" name="municipality" >
                                          <option value="" selected>-</option>
                                        </select>
                                  </div>
                                </div>
                              </div>
                      </div>
                      <div class="form-group">
                            <label for="remarks" class="col-sm-2 control-label">Remarks</label>
                            <div class="col-sm-10">
                              <input name="remarks" class="form-control" id="remarks" placeholder="">
                            </div>
                      </div><br>
                      <div class="col-md-offset-2 col-md-10"><center><b>DSWD-SLP Issued Computers</b><br>
                      This will be used as a reference in the distribution of new laptops, desktops, or tablets.</center><hr style="border:1.5px solid #d4dcde;"></div>
                      <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Type of DSWD issued computer</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="comptype" id="comptype" required>
                                            <option selected>None issued</option>
                                            <option>Desktop</option>
                                            <option>Laptop</option>
                                            <option>Tablet</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Year Issued</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="compyear" id="compyear" required>
                                            <option selected>-</option>
                                            <option>2011</option>
                                            <option>2012</option>
                                            <option>2013</option>
                                            <option>2014</option>
                                            <option>2015</option>
                                            <option>2016</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                        </div>
                        <div class="row">
                                <div class="col-sm-6">
                                  <div class="form-group">
                                    <label for="designation" class="col-sm-4 control-label">Condition</label>
                                    <div class="col-sm-8">
                                          <select class="form-control cleanselect" name="compstatus" id="compstatus" required>
                                            <option selected>-</option>
                                            <option>Working</option>
                                            <option>Not working</option>
                                          </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="form-group">
                                      <label class="col-sm-4 control-label">Notes</label>
                                      <div class="col-sm-8">
                                          <input type="text" class="form-control" name="compnotes" id="compnotes" placeholder="" />
                                      </div>
                                  </div>
                                </div>
                        </div>
                        <div class="row" style="margin-bottom:2em">
                          <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" id="captchaOperation"></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="captcha" placeholder="Anti-Spam"/>
                                </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <div class="col-sm-4" style="text-align:right;vertical-align:middle;padding-top:7px">
                                <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="font-size:30px;"></span>
                              </div>
                              <div class="col-sm-8">
                                </form>
                                <button id="hrsubmit" class="btn col-sm-12 btn-success has-feedback" style="font-size:18px">Submit</button>
                                <div id="statusdisp" class="col-sm-12" style="color:red;text-align:center"></div>
                              </div>
                            </div>
                          </div>
                      </div>
    </div>
    </div>
    <div class="col-md-2"></div>
</div>
<script>
function getProv() {
  var formData = { 
    'action' : 'province',
    'regionid' : $('#region option:selected').val()
  };
  $.ajax({
  type: "POST",
  url: "getLocations.php",
  data: formData,
  success: function(data) {
        if($("#region").val()=="NPMO"){
            $("#province").prop('disabled', true);
            $("#province").val(" ");
            $("#municipality").prop('disabled', true);
            $("#municipality").val(" ");
            
          }else{
            $("#province").prop('disabled', false);
            $("#province").html(data);

          }
        }
  });
}
function getCitymun() {
  var formData = { 
    'action' : 'citymun',
    'provid' : $('#province option:selected').val()
  };
  $.ajax({
  type: "POST",
  url: "getLocations.php",
  data: formData,
  success: function(data) {
            $("#municipality").prop('disabled', false);
            $("#municipality").html(data);
        }
  });
}
$(document).ready(function() {
$("#loadicon").hide();
$("#hrsubmit").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#statusdisp").html('');
  $('#hrForm').bootstrapValidator('validate');
  return false;
}); //endHRSUBMIT
$('#btnAddnew').click(function() {
  location.reload();
  $('#hrForm').data('bootstrapValidator').resetForm(true);
  $('#hrForm').bootstrapValidator('resetForm', true);
  document.getElementById("hrsubmit").disabled = false;
  document.getElementById("hrsubmit").classList.remove("disabled");
  $("#hrsubmit").html('Submit');
      $(".successcontent").hide();
      $("#maincontent").show();
});//endreset
});//end DOC READY
</script>
<script>
$(document).ready(function() {
  $("#loadicon2").hide();
  $("#sendfeedback").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
    $("#loadicon2").show();
    $("#feedback").hide();
    $("#sendfeedback").html('Processing..');
    document.getElementById("sendfeedback").classList.add("disabled");
    document.getElementById("sendfeedback").disabled = true;
    var formData = {
      'page'        : "add_index",
      'feedback'    : $('textarea[name=feedback]').val(),
      'feedbacker'    : "<?php echo $_SESSION['id']; ?>"
    };
                $.ajax({
                   url: "../sendfeedback.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "good") {
                        $("#loadicon2").hide();
                        document.getElementById("formz").innerHTML = "<div style='padding:10px;color:#fff'><h2>Feedback Sent!</h2>Thank you!</div>"
                      } else {
                        alert(data);
                        $("#loadicon2").hide();
                        $("#feedback").show();
                        $("#sendfeedback").html('Submit');
                        document.getElementById("sendfeedback").classList.remove("disabled");
                        document.getElementById("sendfeedback").disabled = false;
                      }
                      return false;
                   }
                });//endAjax
  }); //endHRSUBMIT
}); //enddocready
</script>
</body>
</html>
