<?php
    require "../zxcd9.php";
    function getFilesize($bytes, $decimals = 2) {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }
    if (isset($_GET['id'])) {
      $_GET  = filter_input_array(INPUT_GET, FILTER_SANITIZE_NUMBER_INT);
      $stmt = $db->prepare("SELECT m.remarks, m.doctype, m.added, m.title, m.filesize, m.filename, m.downloads, n.firstname, n.id as hrid, m.author FROM doc_db m LEFT JOIN hr_db n ON m.hrdbid=n.id WHERE m.id = :id");
      $stmt->bindParam(':id', $_GET['id']);
      $stmt->execute();
      $rowdv = $stmt->fetch();
      $file_ext = pathinfo($rowdv['filename'], PATHINFO_EXTENSION);
    } else {
      header("Location: index.php");
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="utf-8">
        <title>SLP</title>
        <meta name="description" content="SLP DSWD Livelihood"/>
        <meta name="viewport" content="width=1000, initial-scale=1.0, maximum-scale=1.0">
        <link rel="shortcut icon" href="imgs/favicon.ico" type="image/x-icon">
        <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/flatbootstrap.css"/>
        <script src="../js/jquery-1.10.2.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../css/fileicon.css"/>
        <style>
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
    .dashpanel {
      border:solid 1px #c5d6de;margin:1em;margin-top:0;background:#fff;text-align: center;
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
    .editbtn {
        color:#18bc9c;
    }
    .delbtn{
        color:#e74c3c;
    }
    .colorgray {
        color:#999;
    }
    </style>
    </head>
    <body>
    <?php require "../nav.php"; ?>
    <div class="row" style="margin-right:0">
      <div class="col-md-offset-3 col-md-6 padfix padfix2" style="">
        <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:center;padding:1em">
          <div class="row">
            <div class="col-sm-3"><center>
              <div class="file-icon file-icon-lg" data-type="<?php echo $file_ext; ?>" style="margin-bottom:10px"></div>
              <span class="label label-info" style="font-weight:400;font-size:14px;cursor:pointer" id="goDL"><span style="padding-top:10px"><span class="glyphicon glyphicon-download" style="vertical-align:middle;font-size:14px;top:-1px"></span></span> Download</span>
            </div>
            <div class="col-sm-6" style="text-align:left">
              <b><?php echo $rowdv['title']; ?> </b><span class="smallfont">(<?php echo getFilesize($rowdv['filesize']); ?>)</span><br>
              <div class="smallfont"> 
                <span class="colorgray"><?php echo $rowdv['doctype']; ?><br>
                Uploader:</span> <a href="http://slp.ph/hr/user.php?id=<?php echo $rowdv['hrid']; ?>" style="color:#00ADDe"><?php echo $rowdv['firstname']; ?></a><br>
                <span class="colorgray">Date Uploaded:</span> <?php echo $rowdv['added']; ?><br>
                <span class="colorgray">Downloads:</span> <?php echo $rowdv['downloads']; ?><br><br>
                <span class="colorgray">Remarks/Summary:<br></span>
                <span style="line-height:0.7"><?php echo nl2br($rowdv['remarks']); ?></span>
              </div>
            </div>
            <div class="col-sm-3" style="text-align:right;font-size:12px;padding-right:1em">
                <div class="col-sm-6"><a href="" id="sharelink"><span class="glyphicon glyphicon-link" style="font-size:28px"></span><br>Share</a></div>
                <div class="col-sm-6"><a href="" id="resendfile"><span class="glyphicon glyphicon-envelope" style="font-size:28px"></span><br>Send</a></div>
            </div>
          </div>
          <div class="row" style="margin-top:1em;text-align:right;padding-right:1em;color:#00ADDe;font-size:14px">
            <?php if ($_SESSION['permlvl']>0||$_SESSION['id']==$rowdv['hrid']) { ?> 
            <span class="link-hover" id="reupfile"><span class="glyphicon glyphicon-upload"></span> Reupload &nbsp;</span>
            <span class="link-hover editbtn" id="editfile"><span class="glyphicon glyphicon-pencil"></span> Edit &nbsp; </span>
            <span class="link-hover delbtn" id="delfile"><span class="glyphicon glyphicon-trash"></span> Delete</span>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-right:0;margin-top:1em">
      <div class="col-md-offset-3 col-md-6 padfix padfix2" style="">
        <div style="border:solid 1px #c5d6de;margin-left:1em;background:#fff;text-align:left;padding:1em;padding-left:2em">
            <div class="row">
              <div class="form-group" style="padding-left:1em;padding-right:2em;padding-top:0.5em">
                <b>Comments:</b><br>
                <table class="table table-bordered" style="font-size:13px" id="commentable">
                <!--comments-->
                <?php
                  $stmtcom = $db->prepare("SELECT m.doc_comment, t.firstname, m.added, t.id FROM doc_comments m LEFT JOIN hr_db t ON m.hrdbid=t.id WHERE m.docdbid = :docdbid");
                  $stmtcom->bindParam(':docdbid', $_GET['id']);
                  $stmtcom->execute();
                  while ($row7 = $stmtcom->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
                        echo "<tr><td>".$row7[0]." <span style='color:#999;font-size:13px'>-".$row7[1]." (".date("m/d", strtotime($row7[2])).")</span></td></tr>";
                  }
                  if ($stmtcom->rowCount() <= 0) {
                    echo "-none-";
                  }
                  ?>
                  <!--comments-->
                  </table>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-10">
                <div class="form-group">
                  <input class="form-control" placeholder="Type comment here.." id="commentbox" name="commentbox">
                </div>
              </div>
              <div class="col-sm-2" style="margin-left:0;padding-left:0">
                <div class="form-group">
                  <button class="btn btn-primary" id="postcomment">Post</button>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="padding:1em;padding-top:0.5em">
                      <h3 style="color:#00ADDe;margin-bottom:6px">Shareable Link</h3>
                        <div class="form-group" style="margin-bottom:1em;margin-top:1em">
                          <input id="doclink" class="form-control" value="http://slp.ph/vrcabinet/docview.php?id=<?php echo $_GET['id']; ?>">
                        </div><!-- /input-group -->
                      <button type="button" class="btn btn-primary pull-right" style="border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Close</button>
                      <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- Modal -->
    <script>
    $('#goDL').click(function(){
      var formData = {
          'action'        : "countDL",
          'docdbid'       : "<?php echo $_GET['id']; ?>",
        };
            $.ajax({
              type: "POST",
              url: "functions.php",
              data: formData,
              success: function(data) {
                      if (data == "counted") {
                        location.href="http://slp.ph/docs/<?php echo $rowdv['filename']; ?>"
                      } else {
                        alert(data);
                      }
              }
          });
    });
    $("#resendfile").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
      var formData = { 'resendid' : '<?php echo $_GET["id"]; ?>' };
            $.ajax({
              type: "POST",
              url: "resend.php",
              data: formData,
              success: function(data) {
                      if (data == "visitpage") {
                        location.href="resend.php"
                      }
                    }
              });
    });
    $("#sharelink").click(function(event) {
    event.preventDefault();
    event.stopImmediatePropagation();
      $('#myModal').modal();
    });
    $("#editfile").click(function(event) {
            var formData = { 'editid' : '<?php echo $_GET["id"]; ?>' };
            $.ajax({
              type: "POST",
              url: "editdetails.php",
              data: formData,
              success: function(data) {
                      if (data == "visitpage") {
                        location.href="editdetails.php"
                      }
                    }
              });
    });
    $("#reupfile").click(function(event) {
            var formData = { 'reupid' : '<?php echo $_GET["id"]; ?>' };
            $.ajax({
              type: "POST",
              url: "reupload.php",
              data: formData,
              success: function(data) {
                      if (data == "visitpage") {
                        location.href="reupload.php"
                      }
                    }
              });
    });
    $("#postcomment").click(function(event) {
      $("#postcomment").html("...");
      document.getElementById("postcomment").disabled = true;
        var formData = {
          'action'        : "comment",
          'docdbid'       : "<?php echo $_GET['id']; ?>",
          'comment'       : $('input[name=commentbox]').val()
        };
                    $.ajax({
                       url: "functions.php",
                       type: "POST",
                       data: formData,
                       success: function(data)
                       {
                          if (data == "commented") {
                            $("#commentable").append("<tr><td>"+$('input[name=commentbox]').val()+" <span style='color:#999;font-size:13px'>- <?php echo $_SESSION['firstname']; ?> (now)</span></td></tr>");
                          } else {
                            alert(data);
                          }
                            $("#postcomment").html("Post");
                            document.getElementById("postcomment").disabled = false;
                       }
                    });
                    //endAjax
    }); //endpost
    $("#delfile").click(function(event) {
      var r = confirm("You are about to delete a record. This will be recorded. Are you sure?");
      if (r == true) {
        var formData = {
          'action'        : "delete",
          'docdbid'       : "<?php echo $_GET['id']; ?>",
          'docfilename'   : "<?php echo $rowdv['filename'] ?>"
        };
                    $.ajax({
                       url: "functions.php",
                       type: "POST",
                       data: formData,
                       success: function(data)
                       {
                          if (data == "deleted") {
                            alert("Success!");
                            location.href = "index.php";
                        } else {
                            alert(data);
                        }
                       }
                    });
                    //endAjax
      }
    }); //endpost
</script>
</body>
</html>
