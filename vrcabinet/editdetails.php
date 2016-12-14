<?php
    require "../zxcd9.php";
    if (isset($_POST['editid'])) {
      $_SESSION['editid'] = $_POST['editid'];
      die("visitpage");
    }
            $stmt = $db->prepare("SELECT * FROM doc_db WHERE id=:id ");
            $stmt->bindParam(':id', $_SESSION['editid']);
            $stmt->execute();
            $rowe = $stmt->fetch();
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>SLP | E-Library</title>
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
    </style>
    </head>
    <body>
    <div class="loader vcenter" style="display:none;" id="loadoverlay">
        <div class="spinner" style="margin-top:-2em;text-align:center">
          <h3 style="font-weight:normal;display:block">Uploading..</h3><br>
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
                      <h2 style="font-weight:bold;margin-bottom:0">EDIT</h2>
    <form id="myForm" method="POST" enctype="multipart/form-data">
                      <div class="form-group" style="margin-top:1em">
                          <select class="form-control" onchange="typeChange()" id="doctypeselector" required>
                            <option><?php echo $rowe['doctype']; ?></option>
                            <option>Select Document Type</option>
                         <!-- get this --> 
                          <?php
                          try {
                                  $sql = $db->prepare("SELECT * FROM libhr_doctype order by hrdocname");
                                  //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                                  $sql->execute();
                             //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                            while($hrdocname=$sql->fetch(PDO::FETCH_ASSOC))
                            {
                          ?>
                            <option value=" <?php echo $hrdocname['hrdocname']; ?>"> <?php echo $hrdocname['hrdocname']; ?> </option>
                          <?php
                            }
                                  } catch(PDOException $e) {
                                echo "Error: " . $e->getMessage();
                                }//en
                            ?>
                          </select>   
                      </div>
                      <div class="form-group" style="margin-top:1em;" id="docsubject">
                          <input class="form-control" placeholder="Document Title / Subject" style="" id="dsubject" name="dsubject" value="<?php echo $rowe['title']; ?>" required/><center>
                      </div>
                      <div class="form-group" style="margin-top:1em;" id="docdate">
                          <input class="form-control" placeholder="Date Written / Created" style="" id="ddate" name="ddate" value="<?php echo $rowe['docdate']; ?>"/><center>
                      </div>
                      <div class="form-group" style="margin-top:1em">
                          <textarea class="form-control" placeholder="Remarks / Summary" style="padding-top:0.6em;resize:none;" rows="3" id="remarks" name="remarks" required/><?php echo str_replace("<br />", "", nl2br($rowe['remarks'])); ?></textarea><center>
                      </div>
                  <div class="col-md-12" style="padding-right:0">
                      <button id="editBtn" class="btn btn-success pull-right" style="padding:6px 10px 6px 10px;margin-top:0.8em"><span class="glyphicon glyphicon-cloud-upload"></span> Save Details</button>
                  </div>
          </div>
      </div>
    </div>
    </div>
    <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="padding:1em;">
                      <h3 style="color:#5cb85c;">Success!</h3>
                      Details have been edited!
                      <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                      <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- Modal -->
    <script>
    $(document).ready(function() {
    $("#title").prop('required',true);
    switchClass = 0;
    $("#editBtn").click(function(event) {
        $("#editBtn").html("Processing..");
        document.getElementById("editBtn").disabled = true;
        if ($('#doctypeselector option:selected').val() == "") {
          alert("Please select Document Type");
          return false;
        }
        if ($('input[name=dsubject]').val() == "") {
          alert("Please enter Document Title / Subject");
          return false;
        }
        var formData = {
          'action'      : "editdetails",
          'docdbid'     : "<?php echo $_SESSION['editid']; ?>",
          'doctype'     : $('#doctypeselector option:selected').val(),
          'docsubject'  : $('input[name=dsubject]').val(),
          'docdate'     : $('input[name=ddate]').val(),
          'remarks'     : $('textarea[name=remarks]').val()
        };
         $.ajax({
                       url: "functions.php",
                       type: "POST",
                       data: formData,
                    success: function(data){
                        if (data=="edited") {
                          $('#myModal').modal();
                          $('#myModal').on('hidden.bs.modal', function () {
                              window.location.href = "http://slp.ph/vrcabinet/docview.php?id=<?php echo $_SESSION['editid']; ?>";
                          })
                        } else {
                          alert(data);
                        }
                        $("#editBtn").html('<span class="glyphicon glyphicon-cloud-upload"></span> Save Details');
                        document.getElementById("editBtn").disabled = false;
                    }
          });
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
          'page'        : "angel_main",
          'feedback'    : $('textarea[name=feedback]').val(),
          'feedbacker'    : "<?php echo $_SESSION['id']; ?>"
        };
                    $.ajax({
                       url: "sendfeedback.php",
                       type: "POST",
                       data: formData,
                       success: function(data)
                       {
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
      }); //endfeedback
    });
    </script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="../js/pikaday.min.js"></script>
    <script>
        var picker = new Pikaday({ 
          field: $('#ddate')[0], 
          format: 'M/D/YYYY'
        });
</script>
</body>
</html>
