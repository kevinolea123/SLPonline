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
if(empty($_SESSION['emailaddress'])) { 
    header("Location: login.php"); 
    die("Redirecting to login"); 
} else {
  $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
  $_SESSION['uid'] = $_GET['id'];
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
        try { 
          $stmt = $db->prepare($query); $result = $stmt->execute($query_params); } 
        catch(PDOException $ex) { 
          die("Failed to run query: " . $ex->getMessage()); } 
        $row = $stmt->fetch();
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
    <link rel="stylesheet" type="text/css" href="../css/DTbootstrap.css">
    <link href="../css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="../css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <script src="../js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../js/tag-it.js" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="../css/jquery.datepick.css"> 
<script type="text/javascript" src="../js/jquery.plugin.js"></script> 
<script type="text/javascript" src="../js/jquery.datepick.js"></script>
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
      z-index: 999;
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
      z-index: 999;
      width: 190px;
      height: 100px;
      margin-bottom: 6px;
    }
    #slideout:hover {
      z-index: 999;
      left: 250px;
    }
    #slideout:hover #slideout_inner {
      z-index: 999;
      left: 0;
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
.hasnotif {
  margin-top: -5px;
  background: #e74c3c;
  color: #fff;
}
.nonotif {
  margin-top: -5px;
  background: rgba(255,255,255,0.5);
}
</style>
</head>
<body>
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
<?php
include "../nav.php";
?>
<div class="container-fluid"><br>
  <div class="row">
    <div class="col-md-12" style="">
      <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
        <div class="row">
          <div class="col-md-12" style="background:#fff;text-align:center">
            <div class="col-md-offset-1 col-md-10"><center>
              <br>
              <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="viewdata" style="background-color:#fff;width:100%">
                      <thead>
                        <th>Date</th>
                        <th>Feedback</th>
                        <th>Response</th>
                        <th>Implementation</th>
                        <th>Feedbacker</th>
                        <th>id</th>
                      </thead>
                </table>
                <br>
                <button class="btn btn-warning" onclick="history.back()" style="padding:2px;padding-left:6px;padding-right:6px;font-size:14px">Go Back</button>
              </div>
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
                oTable = $('#viewdata').dataTable({
                  "aProcessing": true,
                  "aServerSide": true,
                  "orderCellsTop": true,
                  "ajax": "dt_feedback.php",
                  "order": [[5, "desc" ]],
                  "dom": '<"top">rt<"bottom"p><"clear">',
                  "language": {
                    "emptyTable": "No feedback submitted yet"
                  },
                  "fnRowCallback":
                    function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                      $(nRow).attr('link', aData[4]);
                      return nRow;
                    },
                  "aoColumnDefs": [ { 
                           "aTargets":[0],
                           "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                            {
                                $(nTd).css('text-align', 'left');
                            },
                            "mData": null,
                            "mRender": function( data, type, full) {
                                  return '<td>'+data[0]+'</td>'; 
                            }
                        },
                        { 
                           "aTargets":[1],
                           "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                            {
                                $(nTd).css('text-align', 'left');
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
                              $(nTd).css('width', '15%');
                          },
                          "mData": null,
                          "mRender": function( data, type, full) {
                                return '<td>'+data[2]+'</td>';
                          }
                        },
                        { 
                         "aTargets":[3],
                         "fnCreatedCell": function(nTd, sData, oData, iRow, iCol){
                              $(nTd).css('text-align', 'center');
                              $(nTd).css('width', '15%');
                          },
                          "mData": null,
                          "mRender": function( data, type, full) {
                              if (data[3] == 1) {
                                return '<td><span style="color:#5cb85c;" class="glyphicon glyphicon-ok"></span></td>'; 
                              } else {
                                return '<td> - </td>';
                              }
                          }
                        },
                          { "bVisible": false, "aTargets":[0,4,5] }
                });
                <?php if ($_SESSION['id']!=9) {
                ?>
                  oTable.fnFilter("^"+"<?php echo $_SESSION['id'];?>"+"$", 4, true, false, true);
                <?php
                }
                ?>
            </script>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
<br>
</div><!--endcontainerfluid-->
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
}); //endattach
$("#editbtn").click(function(event) {
  event.preventDefault();
  event.stopImmediatePropagation();
  $("#editpanel").show();
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
                   success: function(data)
                   {
                      if (data == "good") {
                        alert("Successfully deleted!");
                        history.back();
                      } else {
                        alert(data);
                      }
                      return false;
                   }
                });//endAjax
    }
});
$("#sendfeedback").click(function(event) {
      sendFeedback("hr_feedbackpage",$('textarea[name=feedback]').val(),"<?php echo $_SESSION['id']; ?>");
  });

}); //enddocready
</script>
<script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="../js/feedback.js"></script>
</body>
</html>
