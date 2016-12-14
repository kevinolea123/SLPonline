<?php
    require "../zxcd9.php";
    if (isset($_POST['reupid'])) {
      $_SESSION['reupid'] = $_POST['reupid'];
      die("visitpage");
    }
            $stmt = $db->prepare("SELECT * FROM doc_db WHERE id=:id ");
            $stmt->bindParam(':id', $_SESSION['reupid']);
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
        <img src="http://img.usabilitypost.com.s3.amazonaws.com/1104/css_slideout/feedback.png" alt="Feedback" />
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
    <div class="container-fluid">
      <div class="col-md-12" style="">
          <div style="background:#fff;margin-bottom:1em;padding:1.2em;" class="col-md-12">
          <div class="row">
              <div class="col-md-12" id="searchblock">
                    <div class="col-md-offset-2 col-md-8" style="margin-top:0">
                      <h2 style="font-weight:bold;margin-bottom:0">REUPLOAD FILE</h2>
                      File: <span style="color:#00ADDe"><?php echo $rowe['title'];?></span>
    <form id="myForm" method="POST" enctype="multipart/form-data">
                      <div class="input-group" style="margin-bottom:0;margin-top:1em">
                          <input id="uploadfilename" class="form-control" placeholder="Choose file.." disabled="disabled">
                          <div class="input-group-btn">
                            <div class="fileUpload btn btn-primary">
                                <span><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Choose File</span>
                                <input id="theupload" name="theupload" type="file" class="upload" required/>
                            </div>
                          </div>
                        </div><!-- /input-group -->
                  </form>
              </div>
              <div class="col-md-12" style="padding-right:0">
                      <button id="uploadBtn" class="btn btn-success pull-right" style="padding:6px 10px 6px 10px;margin-top:0.8em"><span class="glyphicon glyphicon-cloud-upload"></span> Reupload</button>
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
                      File reuploaded!
                      <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                      <div class="clearfix"></div>
              </div>
              
            </div>
          </div>
          <!-- Modal -->
    <script>
    $(document).ready(function() {
    $("#uploadBtn").click(function(event) {
         $("#loadoverlay").show();
         var fd = new FormData;                  
         file1 = $('#theupload').prop('files')[0];
         fd.append('action', 'reupload');
         fd.append('docdbid', '<?php echo $_SESSION["reupid"]; ?>');
         fd.append('file', file1);
         fd.append('docfilename', '<?php echo $rowe["filename"]; ?>');
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
    });//end docready
</script>
</body>
</html>
