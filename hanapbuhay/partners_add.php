<?php
require "../zxcd9.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>SLP | Partners</title>
    <meta name="description" content="SLP DSWD Livelihood"/>
    <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
    <link rel="shortcut icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/flatbootstrap.css"/>
    <link rel="stylesheet" href="../css/bootstrapValidator.css"/>
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrapValidator.js"></script>
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
.successcontent {
  display:none;
}
.mainlink {
  font-size: 1.8em;
  margin-top: 1px;
}
.form-group div {
  margin-bottom: 0.5em;
}
.disabled {
  background:rgba(1,1,1,0.2);
  border:0px solid;
  cursor:progress;
}
</style>
</style>
</head>
<body>
<?php include '../nav.php'; ?>
<div class="container-fluid">
    <div class="row" style="padding-top:2em;display:none" id="successcontent">
      
    </div>
    <div style="padding-top:2em;" id="maincontent">
      <div class="row">
        <div class="col-md-offset-1 col-md-10" ><center>
            <div class="col-md-12">
              <span class="mainlink cl-effect-1"><b>Partner</b> Registration</span><br>
            </div>
        </div>
      </div>
      <div class="col-md-offset-2 col-md-8" id="main">
        <form id="partnerForm" method="post" action="" autocomplete="off">
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="orgname" class="form-control" id="orgname" placeholder="Organization / Company Name">
                              </div>
                            </div>
                            <div class="form-group">
                                        <div class="col-sm-6" >
                                          <select class="form-control" name="psector" id="psector">
                                            <option value="" selected="">-Partner Sector-</option>
                                            <option >NGO</option>
                                            <option >Private</option>
                                            <option >CSO</option>
                                            <option >NGA</option>
                                            <option >MFI</option>
                                          </select>
                                        </div>
                            </div>
                            <div class="form-group"> 
                            <div class="col-sm-6">
                                        <select class="form-control" name="pintervention" id="pintervention" required>
                                            <option value="" selected>-Intervention Type-</option>
                                            <option >Direct Employment</option>
                                            <option >Training Service Provider</option>
                                            <option >Market Linkage</option>
                                            <option >Services (Financial / Nonfinancial)</option>
                                        </select>
                            </div>
                         <!--   <div class="col-sm-6" id="indirectholder" style="display:none;">
                                    <input type="text" name="indirectpartner" id="indirectpartner" class="form-control" placeholder="Indirect Partner Name">
                            </div> -->
                            </div>
                            <div class="form-group">
                                  <div class="col-sm-12">
                                        <select class="form-control cleanselect" name="psic" id="psic" required>
                                          <option value="" selected>-Primary Industry-</option>
                                          <option>Agriculture Forestry and Fishery</option>
                                          <option>Automotive and Land Transportation</option>
                                          <option>Construction</option>
                                          <option>Decorative Crafts</option>
                                          <option>Electronics</option>
                                          <option>Footwear and Leathergoods</option>
                                          <option>Furniture and Fixtures</option>
                                          <option>Garments</option>
                                          <option>Government</option>
                                          <option>HHC (Human Health/Health Care)</option>
                                          <option>Heating Ventilation Airconditioning and Refrigeration</option>
                                          <option>Information and Communication Technology</option>
                                          <option>Manufacturing</option>
                                          <option>Maritime</option>
                                          <option>Metals and Engineering</option>
                                          <option>Processed Food & Beverages</option>
                                          <option>Pyrotechnics</option>
                                          <option>SOS (Social Community Development and other Services)</option>
                                          <option>Tourism (Hotel and Restaurant)</option>
                                          <option>TVET</option>
                                          <option>Utilities (Water Supply Sewerage Waste Management etc)</option>
                                          <option>Visual Arts</option>
                                          <option>Wholesale and Retail Trading</option>
                                        </select>
                                  </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="address" class="form-control" id="address" placeholder="Office Address (Number/Unit, Street, Town/Brgy)">
                              </div>
                            </div>
                            <div class="form-group">
                                        <div class="col-sm-5">
                                          <input name="yearsofop" type="number" class="form-control" id="yearsofop" placeholder="Year Established">
                                        </div>
                                        <div class="col-sm-7">
                                          <div class="input-group">
                                            <span class="input-group-addon" id="sizing-addon2">http://</span>
                                            <input type="text" class="form-control" id="website" name="website" placeholder="Website Address" aria-describedby="sizing-addon2">
                                          </div>
                                        </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="contactperson" class="form-control" id="contactperson" placeholder="Contact Person">
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-12">
                                <input name="contacttitle" class="form-control" id="contacttitle" placeholder="Contact Person Title">
                              </div>
                            </div>
                            <div class="form-group">
                                  <div class="col-sm-5">
                                    <input name="contactemail" class="form-control" id="contactemail" placeholder="Contact Email">
                                  </div>
                                  <div class="col-sm-7">
                                    <input name="contactnumber" class="form-control" id="contactnumber" placeholder="Contact Number (Mobile)">
                                  </div>
                            </div>
                            <div class="form-group">
                                  <div class="col-sm-5">
                                        <select class="form-control" name="engagemeans" id="engagemeans" required>
                                            <option value="" selected>-Means of Engagement-</option>
                                            <option>Partnership Meeting</option>
                                            <option>Partnership Forum</option>
                                            <option>Job Fair</option>
                                        </select>
                                  </div>
                                  <div class="col-sm-7">
                                    <input class="form-control" id="engagecost" name="engagecost" type="number" placeholder="Cost of Engagement (if app. / hosted by FO)">
                                  </div>
                            </div>
                             <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control cleanselect" id="region" name="region" onChange='getProv(this.value)' required>
                                <option value="" selected>Select Region</option>
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
                            <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control" id="prov" name="prov" onChange='getCity(this.value)' disabled required>           
                                <option value="" selected>Select Province</option>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                              <select class="form-control cleanselect" id="city" name="city" onChange='getBrgy(this.value)' disabled required>
                                <option value="" selected>City/Municipality</option>
                              </select>
                            </div>
                        </div>
                                  <div class="form-group">
                                              <div class="col-sm-12">
                                                <div class="input-group" style="margin-bottom:0">
                                                  <span class="input-group-addon" id="tooltip1" data-original-title="Preferred Area" data-content="To make this partner available to other regions" rel="popover" data-placement="top" data-trigger="hover" style="font-size:12px;margin-bottom:0">
                                                    <span style="font-size:16px">Preffered Area 1</span> <span class="glyphicon glyphicon-info-sign"></span>
                                                  </span>
                                                        <select class="form-control" name="reg1" id="reg1">
                                                          <option value="" selected>Select Region</option>
                                                          <option value="CAR">Cordillera Administrative Region</option>
                                                          <option value="NCR">National Capital Region</option>
                                                          <option value="REGION I">REGION I: Ilocos Region</option>
                                                          <option value="REGION II">REGION II: Cagayan Valley</option>
                                                          <option value="REGION III">REGION III: Central Luzon</option>
                                                          <option value="REGION IV-A">REGION IV-A: CALABARZON</option>
                                                          <option value="REGION IV-B">REGION IV-B: MIMAROPA</option>
                                                          <option value="REGION V">REGION V: Bicol</option>
                                                          <option value="REGION VI">REGION VI: Western Visayas</option>
                                                          <option value="REGION VII">REGION VII: Central Visayas</option>
                                                          <option value="REGION VIII">REGION VIII: Eastern Visayas</option>
                                                          <option value="REGION IX">REGION IX: Zamboanga Peninsula</option>
                                                          <option value="REGION X">REGION X: Northern Mindanao</option>
                                                          <option value="REGION XI">REGION XI: Davao</option>
                                                          <option value="REGION XII">REGION XII: SOCCSKSARGEN</option>
                                                          <option>CARAGA</option>
                                                          <option>ARMM</option>
                                                          <option value="NIR">Negros Island Region</option>
                                                        </select>
                                                <span class="input-group-addon" id="addsharedloc" style="cursor:pointer;background:#3498db;font-size:20px;color:#fff"><b>+</b></span>
                                              </div>
                                          </div>
                                  </div>
                          <div id="newinput" style="display:block" class="form-group"></div>
                                 
                          </form>
                            <div class="form-group">
                              <div class="col-sm-6">
                                <div id="statusdisp" class="col-sm-12" style="color:red;text-align:center"></div>
                              </div>
                              <div class="col-sm-6" style="text-align:right;margin-bottom:2em;margin-top:5px">
                                <div class="col-md-2" style="text-align:left;vertical-align:middle;padding-top:7px">
                                <span id="loadicon" class="glyphicon glyphicon-refresh spin" style="font-size:30px;"></span>
                                </div>
                                <a href=""><button id="formsubmit" class="col-md-offset-1 btn btn-success col-md-9" data-text="Hooray!">Register</button></a>
                              </div>
                            </div>
                </div>
    </div>
    <div class="col-md-2"></div>
</div>

<script>
/*function intervent() {
  var intervent = $('#pintervention option:selected').val();
  if (intervent == "Training" || intervent == "Placement") {
      $('#indirectholder').slideDown(500);
  }
  if (intervent == "Direct Employment") {
      $('#indirectholder').fadeOut(500);
  }
} */
function getProv(val) {

  var formData = { 'region' : $('#region option:selected').val() };
  $.ajax({
  type: "POST",
  url: "getProv.php",
  data: formData,
  success: function(data) {
            $("#prov").prop('disabled', false);
            $("#prov").html(data);
        }

  });
}
function getCity(val) {

  var formData = { 'provi' : $('#prov option:selected').val() };
  $.ajax({
  type: "POST",
  url: "getCity.php",
  data: formData,
  success: function(data) {
            $("#city").prop('disabled', false);
            $("#city").html(data);
        }

  });
}
function getBrgy(val) {
  var formData = { 'city' : $('#city option:selected').val() };
  $.ajax({
  type: "POST",
  url: "getBrgy.php",
  data: formData,
  success: function(data) {
            $("#brgy").prop('disabled', false);
            $("#brgy").html(data);
        }

  });
}
$("#loadicon").hide();
$('#tooltip1').popover();
prefloc = 1;
$("#btnAddnew").click(function() {
  location.reload();
});
$("#addsharedloc").click(function() {
  addForm();
});
prefloc = 1;
function addForm() {
  prefloc++;
  var newdiv = document.createElement('div');
      newdiv.setAttribute("id", "pref"+prefloc+"");
  newdiv.innerHTML = '<div class="col-sm-12">'+
                                                '<div class="input-group" style="margin-bottom:0">'+
                                                  '<span class="input-group-addon" id="tooltip1" data-original-title="Preferred Area" data-content="To make this partner available to other regions" rel="popover" data-placement="top" data-trigger="hover" style="font-size:12px;margin-bottom:0">'+
                                                   ' <span style="font-size:16px">Preferred Area '+prefloc+'</span> <span class="glyphicon glyphicon-info-sign"></span>'+
                                                  '</span>'+
                                                        '<select class="form-control cleanselect" name="reg'+prefloc+'" id="reg'+prefloc+'" required>'+
                                                          '<option value="" selected>Select Region</option>'+
                                                          '<option value="CAR">Cordillera Administrative Region</option>'+
                                                         ' <option value="NCR">National Capital Region</option>'+
                                                        '  <option value="REGION I">REGION I: Ilocos Region</option>'+
                                                       '   <option value="REGION II">REGION II: Cagayan Valley</option>'+
                                                      '    <option value="REGION III">REGION III: Central Luzon</option>'+
                                                     '     <option value="REGION IV-A">REGION IV-A: CALABARZON</option>'+
                                                    '      <option value="REGION IV-B">REGION IV-B: MIMAROPA</option>'+
                                                   '       <option value="REGION V">REGION V: Bicol</option>'+
                                                  '        <option value="REGION VI">REGION VI: Western Visayas</option>'+
                                                 '         <option value="REGION VII">REGION VII: Central Visayas</option>'+
                                                '          <option value="REGION VIII">REGION VIII: Eastern Visayas</option>'+
                                               '           <option value="REGION IX">REGION IX: Zamboanga Peninsula</option>'+
                                              '            <option value="REGION X">REGION X: Northern Mindanao</option>'+
                                             '             <option value="REGION XI">REGION XI: Davao</option>'+
                                            '              <option value="REGION XII">REGION XII: SOCCSKSARGEN</option>'+
                                        '                  <option>CARAGA</option>'+
                                       '                   <option>ARMM</option>'+
                                      '                    <option value="NIR">Negros Island Region</option>'+
                                     '                   </select>'+
                                   '           </div>'+
                                   '       </div>';
  document.getElementById("newinput").appendChild(newdiv);
}
/*$("#formsubmit").click(function() {
  var formData = {
          'action'             : 'addPartners',
          'partnerid'          : '<?php echo $_GET["id"]; ?>',
          'orgname'            : $('input[name=orgname]').val(),        
          'psector'              : $('#psector option:selected').val(),
          'pintervention'      : $('#pintervention option:selected').val(),
          'psic'               : $('#psic option:selected').val(),
          'address'            : $('input[name=address]').val(),          
          'yearsofop'          : $('input[name=yearsofop]').val(),
          'website'            : $('input[name=website]').val(),        
          'contactperson'      : $('input[name=contactperson]').val(),  
          'contacttitle'      : $('input[name=contacttitle]').val(),          
          'contactemail'       : $('input[name=contactemail]').val(),
          'contactnumber'      : $('input[name=contactnumber]').val(),          
          'engagemeans'        : $('#engagemeans option:selected').val(),          
          'engagecost'         : $('input[name=engagecost]').val(),          
          'region'             : $('#region option:selected').text(),
          'province'           : $('#prov option:selected').text(),
          'municipality'       : $('#city option:selected').text()
        };
                $.ajax({
                   url: "functions.php",
                   type: "POST",
                   data: formData,
                   success: function(data)
                   {
                      if (data == "Success") {
                        alert("Success!");
                        window.location.href="partners_add.php"
                        
                      } else {
                        alert(data);
                      }

                   }
                });//endAjax
});*/

</script>
<script type="text/javascript" src="../js/partnerForm.js"></script>
</body>
</html>
