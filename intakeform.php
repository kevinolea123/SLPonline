<!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>Intake Form</title>
  <link rel="stylesheet" href="css/flatbootstrap.css"/>
    <link rel="stylesheet" href="css/bootstrapValidator.css"/>
    <link href="css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript" src="js/bootstrapValidator.js"></script>
    <script src="js/tag-it.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<style>
    body {
    background-color: white;
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
  display:none;
}
. {
  -webkit-appearance:none;
  -moz-appearance:none;
  -ms-appearance:none;
  appearance:none;background:#fff url(../../../imgs/arrows.png) no-repeat right 9px;
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
tbody tr {
  cursor: pointer;
}
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
  background-color: #2c3e50;
  color: #fff;
}
.input-group {
  margin-bottom:0.5em;margin-right:1em;margin-left:1em;
}
.col-md-4 {
}
@media only screen and (min-device-width : 320px) and (max-device-width : 480px) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-width : 321px) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (max-width : 320px) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and ( min-width: 320px )
and (max-device-height: 568px)
and (orientation : landscape) 
and (-webkit-min-device-pixel-ratio : 2) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and ( min-width: 320px )
and (max-device-height: 568px)
and (orientation : portrait) 
and (-webkit-min-device-pixel-ratio : 2) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and ( min-width: 375px )
and (max-width: 667px)
and (orientation : landscape) 
and (-webkit-min-device-pixel-ratio : 2) {
    .col-md-4 { 
      background-color: #007ee5;
}
}

@media only screen and ( min-width: 375px )
and (max-width: 667px)
and (orientation : portrait) 
and (-webkit-min-device-pixel-ratio : 2) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and ( min-device-width: 414px )
 and (max-device-height: 736px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 2){
    .col-md-4 { 
      background-color: #007ee5;
}
}

@media only screen and (min-device-width: 414px) and (max-device-height: 736px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 2){
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 2){
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 2){
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 3){
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width: 320px) and (max-device-height: 640px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 3){
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width: 360px) and (max-device-height: 640px) and (orientation : landscape) and (-webkit-device-pixel-ratio: 3){
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width: 360px) and (max-device-height: 640px) and (orientation : portrait) and (-webkit-device-pixel-ratio: 3){
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : landscape) and (-webkit-min-device-pixel-ratio : 2) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and (min-device-width : 768px) and (max-device-width : 1024px) and (orientation : portrait) and (-webkit-min-device-pixel-ratio : 2) {
    .col-md-4 { 
      background-color: #007ee5;
}
}
@media only screen and ( min-width: 1224px )
{
    .col-md-4 {  
      height: 1800px;
      background-color: #007ee5;
}
}
}
}
@media only screen and ( min-width: 1824px ){
    .col-md-4 { 
      background-color: #007ee5;
}
}
.row-buffer {
margin-top:20px;
margin-bottom:;
}
.row-even {
background-color:#007ee5;
}
.autocomplete-suggestions { cursor:pointer;border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
.autocomplete-suggestion { cursor:pointer;padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-no-suggestion { padding: 2px 5px;}
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: bold; color: #000; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
      </style>
      </head>
    <body>
            <div class="container-fluid">
                  <div class="col-md-12" style="padding-left:7em;padding-right:7em;padding-top:3em;padding-bottom:1em;">
             <form id="myForm" method="POST" enctype="multipart/form-data">
                  <div class="row row-eq-height " style="height:100%; margin-bottom:0em">
                        <div class="col-md-4" style="padding:2em;color:#fff; border:solid 1px #c5d6de; margin:0 auto;">
                        <body bgcolor="#007ee5"><center><h3>SLP INTAKE FORM</h3></center><br>
                        <ul><b>DETAILS OF CONCERN:</b><br><br>
                        <i>NOTE: </i><br>
                           The complainant could attach any pertinent document/s as additional basis to support his/her complaint.</li>
                         <br><br>
                        <b>RECORDING OF COMPLAINT:</b><br><br>
                           <li>A complaint should be encoded by the receiving officer to data base (excel file) to track and record all complaints/ grievances received by the program. However, if queries or request for information about the program does not need to be recorded into the FMP tracking file (excel file), the receiving staff may directly give appropriate response to the inquiry.  <br>
                           The receiving officer who will record the grievance (either PDO, PC, RPC/M&E or tapped Admin Assistant) will assign a tracking number for each grievance transaction using excel file. Below are the details to be encoded/ recorded.</li><br>
                        <i>NOTE: </i><br>
                           <li> In the absence of an online tracking system/ information system, complete information should be gathered through available means.</li>
                        Assigning of Tracking Number (to be placed/indicated in column 1) will be based on the date the grievance was filed/received. Example, a certain grievance was received by the staff/office on January 26, 2015. So the TN will be:
                        <ul><li>160126-1 (YYMMDD)-[Assigned Number]</li></ul>
                        <ul><li>160126-1 (YYMMDD)-[Assigned Number]</li></ul>
                      </ul>
                      </body>
            </div>
            <div class="col-sm-8" style="padding:3em;color:#000; border:solid 1px #c5d6de; padding-top:2em">
                    <div class="input-group" style="margin-bottom:0;margin-top:0;margin-left:0;margin-right:0">
                        <h2><center>SLP INTAKE FORM</center></h2><br>
                            <div class="row">
                            <div class="form-group">
                                <div class="col-sm-12" style="text-align:left;">
                                <div class="col-sm-6" style="text-align:left;">
                                      <b>Date Received:</b><br>
                                        <input type="text" id="datepicker" name="datereceived" class="form-control" placeholder="Select Date"/>
                                        <div class="col-sm-6" style="text-align:center;font-size: 11px;">
                                        <i>(For DSWD Staff)</i>
                                </div>
                                </div>
                                <div class="col-sm-6" style="text-align:left;">
                                      <b>Date Resolved:</b><br>
                                        <input type="text" style="" id="datepic"  name="dateresolved" class="form-control" placeholder="Select Date"/>
                                        <div class="col-sm-6" style="text-align:center;font-size: 11px;">
                                        <i>(For DSWD Staff)</i>
                               </div>
                               </div>
                               </div>
                            <div class = "row">
                            <div class="form-group">
                            <div class="checkbox">
                            <div class="input-group" style="margin-left:=1;">
                            <div class="input-group" style="margin-left:=1;">
                            <div class="col-sm-12" style="text-align:left;">
                            <div class="col-sm-4">
                            <div class="margin-top: 1em"></div>
                                      <b>Submitted to:</b><br>
                                  <label><input type="checkbox"> NMPO</label><br>
                                  <label><input type="checkbox"> RPMO</label><br>
                                  <label><input type="checkbox"> POO</label><br>
                                  <label><input type="checkbox"> Municipal</label><br>
                                  <label><input type="checkbox"> Barangay</label>         
                            </div>
                            <div class="checkbox">
                            <div class="col-sm-4">
                                      <b>Mode of Filling:</b><br>
                                  <label><input type="checkbox"> Letter</label><br>
                                  <label><input type="checkbox"> Email</label><br>
                                  <label><input type="checkbox"> Phone call/Text</label><br>
                                  <label><input type="checkbox"> Report from Field Visits</label><br>
                                  <label><input type="checkbox"> Media</label>
                            </div>
                            <br>
                            <div class="col-sm-4">
                                   <label><input type="checkbox"> Walk-in/Verbal Narration</label><br>
                                   <label><input type="checkbox"> Others(Specify):</label>
                                   <input type="text" name="others" class="form-control" placeholder="Input Details"/>
                            </div>
                            </div> 
                            </div>   
                            <div class="col-sm-12" style="padding:1em">
                                      <h4><left>COMPLAINANT/SENDER'S INFORMATION</left></h4>
                            </div>
                            <div class="form-group">
                            <div class="col-sm-12" style="text-align:left;">
                                            <b>FULL NAME:</b><br>
                            </div>
                            <div class="col-sm-4" style="text-align:left;">
                                     <input type="text" name="fname" class="form-control" placeholder="First Name"/>
                            <div style="text-align:center;font-size:11px;">
                                            <i>(First Name)</i>
                            </div>
                            </div>
                            <div class="col-sm-4" style="text-align:left;">
                                  <input type="text" name="mname" class="form-control" placeholder="Middle Name"/>
                            <div style="text-align:center;font-size:11px;">
                                        <i>(Middle Name)</i>
                            </div>
                            </div>
                            <div class="col-sm-4" style="text-align:left;">
                          <input type="text" name="lname" class="form-control" placeholder="Last Name"/>
                            <div style="text-align:center;font-size:11px;">
                                        <i>(Last Name)</i>
                            </div>    
                            </div>
                            </div>
                            <div class = "row">
                            <div class="form-group">
                            <div class="radio">
                            <div class="col-sm-12" style="text-align:left;"><br>
                            <div class="col-sm-6" style="text-align:left;">
                                        <b>Sex:</b>&nbsp;&nbsp;&nbsp;
                            <select class="form-control">
                                <option value=""hidden>--/--</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            </div>                                 
                            <div class="col-sm-6" style="text-align:left;">
                                       <b>Pantawid Beneficiary?</b>&nbsp;&nbsp;&nbsp;
                            <select class="form-control">>
                                <option value=""hidden>--/--</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                            </div>
                              <br>
                              <br>
                            <div class="form-group">
                               <div class="col-sm-12" style="text-align:left;">
                               <br>
                            <div class="row">
                               <div class="col-sm-6" style="text-align:left;">

                                        <b>IP Group:</b>
                            <input type="text" name="ip" class="form-control" placeholder="Input Group"/>
                            <div class="col-sm-12" style="text-align:center;font-size:11px;">
                                        <i>(If Applicable)</i>
                               </div>
                               </div>         
                               <div class="col-sm-6" style="text-align:left;">
                                        <b>Household ID No.:</b>
                            <input type="text" name="household" class="form-control" placeholder="Input Household ID Number"/>
                                <div class="col-sm-12" style="text-align:center;font-size:11px;">
                                        <i>(Indicate If Pantawid Benefiary)</i>
                              </div>
                              </div>
                              </div>
                            <div class ="row">
                            <div class="form-group">
                            <div class="checkbox">
                                <div class="col-sm-12" style="text-align:left;">
                                <div class="col-sm-4">
                                        <b>Position/Designation:</b><br>
                            <label><input type="checkbox"> BL/LGU Staff/Official</label><br>
                            <label><input type="checkbox"> NGA/NGO/CSO Staff</label><br>
                            <label><input type="checkbox"> DSWD/SLP.Staff</label><br>
                             <label><input type="checkbox">Participant</label><br>
                           </div>
                           <br>
                           <div class="col-sm-4">
                            <label><input type="checkbox"> Ordinary Resident</label><br>
                            <label><input type="checkbox" style="text-align:right;" >Others</label>
                            <input type="text" name="other" class="form-control" placeholder="Input Details"/>
                            </div>
                            </div>  
                            </div> 
                            </div> 
                            </div>     
                            <div class="form-group">
                            <div class="row">
                            <div class="col-sm-12" style="text-align:;">
                             <h4><left>DETAILS OF CONCERN</left></h4><br> 
                                        <b>ADDRESS: </b><br> <br>
                            </div>
                            <div class="col-sm-6" style="text-align:left;">
                                        <b>Street/Purok: </b>
                            <input type="text" name="street" class="form-control" placeholder="Enter Street/Purok"/>
                            </div>
                            <div class= "col-sm-6" style="text-align:left;">
                                        <b>Barangay: </b>
                            <input type="text" name="barangay" class="form-control" placeholder="Enter Barangay"/>
                            </div>
                            <div class="col-sm-6" style="text-align:left;">
                                        <b>Municipality: </b>
                            <input type="text" name="municipality" class="form-control" placeholder="Enter Municipality"/>
                            </div>
                            <div class="col-sm-6" style="text-align:left;">
                                       <b>Province: </b>
                            <input type="text" name="province" class="form-control" placeholder="Enter Province"/>
                            </div>
                            <div class ="form-group">
                            <div class="col-sm-12" style="text-align:left;">
                        <div class="select">
                                      <b>Region: </b>
                        <select class="form-control">
                            <option value=""hidden>--/--</option>
                            <option value="armm">ARMM</option>
                            <option value="car">CAR</option>
                            <option value="caraga">CARAGA</option>
                            <option value="ncr">NCR</option>
                            <option value="nir">NIR</option>
                            <option value="npmo">NPMO</option>
                            <option value="region1">REGION I</option>
                            <option value="region2">REGION II</option>
                            <option value="region3">REGION III</option>
                            <option value="region4a">REGION IV-A</option>
                            <option value="region4b">REGION IV-B</option>
                            <option value="region5">REGION V</option>
                            <option value="region6">REGION VI</option>
                            <option value="region7">REGION VII</option>
                            <option value="region8">REGION VIII</option>
                            <option value="region9">REGION IX</option>
                            <option value="region10">REGION X</option>
                            <option value="region11">REGION XI</option>
                            <option value="region12">REGION XII</option>
                        </select>
                        </div>
                        <div class="row">
                           <div class="col-sm-6" style="text-align:left;">
                            <b>Contact No.: </b>
                                 <input type="text" name="contact" class="form-control" placeholder="Enter Contact Number"/>
                           </div>
                            <div class="col-sm-6" style="text-align:left;"> 
                            <b>Email Address: </b>
                                 <input type="text" name="email address" class="form-control" placeholder="Enter Email Address"/>
                            </div>
                            </div>
                            
                            </div>
                            <div class="col-sm-12" style="text-align:left ;">
                                 <b>Nature of Complain/ Concern</b> &nbsp; (Provide short description of concern)<br>
 <textarea rows="4" cols="50" name="natureofcomplain" class="form-control" placeholder="Provide short description of concern "/></textarea> 
                           <div class ="row">
                           <div class="col-sm-12" style="text-align:left;">
                           <div class="input-group" style="margin-left:2em;">
                           <br>
                                  <input type="checkbox"><b> CONFIDENTIAL</b><br><br>
                            </div> 
                            <div class="col-sm-4">
                                    <b>Subject of Complaint:</b><br>
                                  <label><input type="checkbox"> B/LGU Staff/Official</label><br>
                                  <label><input type="checkbox"> NGA/NGO/CSO Staff</label><br>
                                  <label><input type="checkbox"> DSWD/SLP-Staff</label><br>
                                  <label><input type="checkbox"> Participants</label>
                            </div>
                            <br>
                            <div class="col-sm-4">
                                  <label><input type="checkbox"> Ordinary Resident</label><br>
                                  <label><input type="checkbox"> Others</label><br>
                                  <input type="text" name="oth" class="form-control" placeholder="Input Details"/>
                           </div>
                           </div>
                           </div> 
                           </div> 
<script>
    $(document).ready(function() {
    $("#datepicker").datepicker();
  });
</script>   
<script>
    $(document).ready(function() {
    $("#datepic").datepicker();
  });
</script>     
   </div>
   </div>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script> 
<style>
.glyphicon.spinning {
    animation: spin 1s infinite linear;
    -webkit-animation: spin2 1s infinite linear;
}
@keyframes spin {
    from {
        transform: scale(1) rotate(0deg);
    }
    to {
        transform: scale(1) rotate(360deg);
    }
}
@-webkit-keyframes spin2 {
    from {
        -webkit-transform: rotate(0deg);
    }
    to {
        -webkit-transform: rotate(360deg);
    }
}
</style>
<script>
  angular.module("formDemo", [])

    .controller("LocationFormCtrl", function ($scope, $timeout) {
    $scope.searchButtonText = "Submit";
    $scope.test = "true";

    $scope.search = function () {
        $scope.enable = "false";
        $scope.test = "true";
        $scope.searchButtonText = "Process";
        // Do your searching here
        
        $timeout(function(){
            $scope.enable = "true";
            $scope.searchButtonText = "Submitted";
        }, 2000);
    }
});
</script>
<div ng-app="formDemo" ng-controller="LocationFormCtrl" style="text-align:center;">
    <div>
        <button type="submit" class="btn btn-success" ng-click="search()" ng-disabled="enable=='false'"> 
            <span ng-show="searchButtonText == 'Process'"><i class="glyphicon glyphicon-refresh spinning"></i></span>
            {{ searchButtonText }}
        </button>
    </div>
</div>
