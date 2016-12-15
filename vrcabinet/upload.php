<?php
    require "../zxcd9.php";
    byteMe($_SESSION['id'],'vc_upload',0.10);
            $stmt = $db->prepare("SELECT MAX(id) as id FROM doc_db");
            $stmt->execute();
            $rowz = $stmt->fetch();
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
    .row-eq-height {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display:         flex;
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
                 if(option=="All Livelihood")
                 {  aData = { 'action'    : "getemails_liv"}  }
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
          var eblast = '<div class="bodycontainer" style="margin-top:1em;margin-bottom:1em">\
          <div style="padding:0;width:100%!important;margin:0" marginheight="0" marginwidth="0"><center><table cellpadding="8" cellspacing="0" style="padding:0;width:100%!important;background:#ffffff;margin:0;background-color:#ffffff" border="0"><tr><td valign="top">\
          <table cellpadding="0" cellspacing="0" style="border-radius:4px;border:1px #dceaf5 solid;border-collapse:none" border="0" align="center">\
          <tr><td><table cellpadding="0" cellspacing="0" style="line-height:25px" border="0" align="center"><tr><td colspan="3" height="30"></td></tr><tr><td width="36"></td>\
          <td width="454" align="center" style="color:#444444;border-collapse:collapse;font-size:9pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;max-width:454px" valign="top">\
          <div style="border:1px solid #ccc;background:#e1e1e1;height:130px;width:90%;vertical-align:middle;font-size:12px;line-height:1.1"><h3>Your image here</h3><br>Recommended file size: 500kb<br>Larger file sizes may not load on mobile devices</div>\
          Cant see this image? <a href="#" style="color:#4583ed">Click here</a>\
          <td width="36"></td></tr><tr><td colspan="3" height="36"></td></tr></table></td></tr></table><table cellpadding="0" cellspacing="0" align="center" border="0"><tr><td height="10"></td></tr><tr><td style="padding:0;border-collapse:collapse"><table cellpadding="0" cellspacing="0" align="center" border="0"><tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;"><td width="200" align="left"></td>\
          <td width="328" align="right"><span style="font-size:12px">Sent through <a href="http://slp.ph" style="text-decoration:none;color:#4583ed">SLP Online</a> by <span id="emailfrom"><?php echo $_SESSION["fullname"]; ?></span></span><br></td></td>\
          </tr></table></td></tr></table></td></tr></table></center></div></div>\
          <hr style="margin-bottom:0">';
          var edefault = '<div class="bodycontainer" style="margin-top:1em;margin-bottom:1em"><div style="padding:0;width:100%!important;margin:0" marginheight="0" marginwidth="0"><center><table cellpadding="8" cellspacing="0" style="padding:0;width:100%!important;background:#ffffff;margin:0;background-color:#ffffff" border="0"><tr><td valign="top"><table cellpadding="0" cellspacing="0" style="border-radius:4px;border:1px #dceaf5 solid;border-collapse:none" border="0" align="center"><tr><td colspan="3" height="6"></td></tr><tr style="line-height:0px"><td width="100%" style="font-size:0px" align="center" height="1"><img width="40px" style="max-height:104px;width:55px;margin-top:15px" alt="" src="http://slp.ph/imgs/emailslplogo.png"></td></tr><tr><td><table cellpadding="0" cellspacing="0" style="line-height:25px" border="0" align="center"><tr><td colspan="3" height="30"></td></tr><tr><td width="36"></td>\
          <td width="454" align="left" style="color:#444444;border-collapse:collapse;font-size:11pt;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;;max-width:454px" valign="top">\
          Dear Sir/Madam,<br><br>This is to provide you with a copy of the <b id="emaildoctype" style="color:red">Doc Type</b> with subject <b id="emailsubject" style="color:red">Document Title / Subject</b> <span id="emaildate"></span>.<br><br><i id="emailsummary" style="color:red">Remarks / Summary</i><br><br>\
          <table border="0" cellpadding="0" cellspacing="0" style="background-color:#18bc9c; border:0px solid #4285f4; border-radius:5px;"><tr><td align="center" valign="middle" style="color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:140%; padding-top:9px; padding-right:26px; padding-bottom:8px; padding-left:26px;"><a href="" target="_blank" style="color:#FFFFFF; text-decoration:none;">View Details</a>\
          </td><td align="center" valign="middle" style="background-color:#4285f4; color:#FFFFFF; font-family:Helvetica, Arial, sans-serif; font-size:15px; font-weight:bold; line-height:140%; padding-top:9px; padding-right:26px; padding-bottom:8px; padding-left:26px; border-radius:5px;border-top-left-radius: 0px;border-bottom-left-radius: 0px">\
          <a href="" target="_blank" style="color:#FFFFFF; text-decoration:none;">Download</a></td></tr></table><br>Thank you for your usual support and cooperation. Happy working!<br></td><td width="36"></td>\
          </tr><tr><td colspan="3" height="36"></td></tr></table></td></tr></table><table cellpadding="0" cellspacing="0" align="center" border="0"><tr><td height="10"></td></tr><tr><td style="padding:0;border-collapse:collapse"><table cellpadding="0" cellspacing="0" align="center" border="0"><tr style="color:#a8b9c6;font-size:11px;font-family:proxima_nova,&#39;Open Sans&#39;,&#39;Lucida Grande&#39;,&#39;Segoe UI&#39;,Arial,Verdana,&#39;Lucida Sans Unicode&#39;,Tahoma,&#39;Sans Serif&#39;"><td width="200" align="left"></td>\
          <td width="328" align="right"><span style="font-size:12px">Sent through <a href="http://slp.ph" style="text-decoration:none;color:#4583ed">SLP Online</a> by <span id="emailfrom"><?php echo $_SESSION["fullname"]; ?></span></span></td>\
          </tr></table></td></tr></table></td></tr></table></center></div></div><hr style="margin-bottom:0">';
          if (option=="Blast") {
              $("#emailpreview").html(eblast);
          } else {
              $("#emailpreview").html(edefault);
              if (option == "Internal Memorandum (within CO)" || option == "External Memorandum (to regions)") {
                $("#emaildoctype").html("memorandum");
              } else {
                $("#emaildoctype").html(option);
              }
          }
    }
    </script>
    <div class="container-fluid">
      <div class="col-md-12" style="padding-left:3em;padding-right:3em">
    <form id="myForm" method="POST" enctype="multipart/form-data">
     <div class="row row-eq-height" style="height:100%;border:solid 1px #c5d6de;margin-bottom:3em">
                    <div class="col-md-5" style="background-color:#007ee5;padding:2em;color:#fff">
                      SLP E-Library<h3>FILE UPLOADS</h3>
                      Uploading regular files:
                      <ul>
                        <li>Choose the file from your computer or storage device.</li>
                        <li>Click "Select Document Type" to choose the file category.</li>
                        <li>Fill out the required fields and click "Upload" to submit to E-Library.</li>
                      </ul>
                      Uploading admin document files:
                      <ul>
                        <li>Choose the file from your computer or storage device.</li>
                        <li>Select "Admin Document" category from the "Select Document Type" dropdown list to see the additional fields.</li>
                        <li>Fill out the required areas and click "Upload" to submit to E-Library.</li>
                      </ul>
                      Sending e-mail notifications:
                      <ul>
                        <li>Click the notification button and choose the respective offices or type the names of individuals. Submit to E-Library by clicking the "Submit and Send Notification" button.</li>
                      </ul>
                    </div>
                    <div class="col-md-7" style="padding:3em;color:#000;padding-top:2em">
                      <div class="input-group" style="margin-bottom:0;margin-top:0">
                          <input id="uploadfilename" class="form-control" placeholder="Choose file.." disabled="disabled">
                          <div class="input-group-btn">
                            <div class="fileUpload btn btn-primary">
                                <span><span class="glyphicon glyphicon-folder-open"></span> &nbsp; Choose File</span>
                                <input id="theupload" name="theupload" type="file" class="upload" />
                            </div>
                          </div>
                        </div>
                        <!-- /input-group -->
                        <span style="font-size:12px;margin-bottom:1em">Supported file types: PDF, DOC, XLSX, PNG, JPG, ZIP, PPT</span>
                        <span style="font-size:12px;margin-bottom:1em" class="pull-right">Maximum file size: 8MB</span><br>
    <script>
    function typeChange2(){
    var selection = $('#doctypeselector option:selected').val();
    console.log(selection);
          if (selection == "Admin Doc") {
                 $("#admintypeholder").fadeIn(); $("#logtypeholder").fadeIn(); $("#refnumberholder").fadeOut(); $("#officeholder").fadeIn(); 
                 $("#nameholder").fadeIn();$("#resdateholder").fadeIn(); 
                 $("#posholder").fadeIn();   
        } else {
                 $("#admintypeholder").fadeOut(); $("#logtypeholder").fadeOut(); $("#refnumberholder").fadeOut(); $("#officeholder").fadeOut(); 
                 $("#nameholder").fadeOut();$("#resdateholder").fadeOut(); 
                 $("#posholder").fadeOut();
        }
    }
    function typeChange3(){
    $('#refnumber').val($('#logtype option:selected').val()+'-'+$('#admintype option:selected').val()+'<?php 
      date_default_timezone_set('Asia/Brunei');
     // $date = date('Ymj',time()+ 50400);
      $date = date('mdY');
      echo '-'.$date.'-'.($rowz['id'] + 1) ?>');
    }
    </script>
                      <div class="form-group" style="margin-top:1em">
                          <select class="form-control" onchange="typeChange2()" id="doctypeselector">
                            <option value="">Select Document Type</option>
                            <!-- get this --> 
                          <?php
                          try {
                                  $sql = $db->prepare("SELECT * FROM libhr_doctype order by hrdocname");
                                  //$prof->bindParam(':hrdbida', $_SESSION['pageid']);
                                  $sql->execute();
                             //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                            while($hreventname=$sql->fetch(PDO::FETCH_ASSOC))
                            {
                          ?>
                            <option value="<?php echo $hreventname['hrdocname']; ?>"><?php echo $hreventname['hrdocname']; ?></option>
                          <?php
                            }
                                  } catch(PDOException $e) {
                                echo "Error: " . $e->getMessage();
                                }//en
                            ?>
                        <!-- upto this -->
                            <?php if ($_SESSION['permlvl']>0) {?>
                            <option>Blast</option>
                            <?php } ?>
                          </select>
                      </div>
                      <div class="form-group" style="display: none; margin-top:1em" id="admintypeholder">
                          <select class="form-control" id="admintype" name="admintype" >
                            <option value="">Select Admin Document Type</option>
                            <!-- get this --> 
                          <?php
                          try {
                                  $sql = $db->prepare("SELECT * FROM libhr_subdoctype order by hrsubdocname");
                                  $sql->execute();
                                        while($hreventname1=$sql->fetch(PDO::FETCH_ASSOC))
                                        {
                           ?>
                                  <option value="<?php echo $hreventname1['hrsubdoccode']; ?>"><?php echo $hreventname1['hrsubdocname']; ?></option>
                            <?php
                                        } 
                                  } catch(PDOException $e) {
                                        echo "Error: " . $e->getMessage();
                                  }
                            ?>
                        <!-- upto this -->
                        </select>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group" style="display: none" id="logtypeholder">
                           <select class="form-control" id="logtype" name="logtype" >
                            <option value="">Select Log Type</option>
                            <option value="I" id="in">Incoming</option>
                            <option value="O" id="out">Outgoing</option>
                            </select>
                              <div class="col-sm-8">
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group" style="display: none" id="refnumberholder">
                           <input class="form-control" placeholder="Reference Number" id="refnumber" name="refnumber" disabled/><center>
                            <div class="col-sm-8">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group" style="" id="docsubject">
                          <input class="form-control" placeholder="Document Title / Subject" style="" id="dsubject" name="dsubject"/><center>
                      </div>
                      <div class="form-group" style="" id="authorholder">
                          <input type="text" name="author" id="autocompleteajax2" class="form-control" placeholder="Author (if applicable)"/>
                          <input type="hidden" id="autocomplete-ajax-x-2" disabled="disabled"/>
                      </div>
                      <div class="row" id="officeholder" style="display:none;">
                        <div class="col-sm-6">
                          <div class="input-group">
                           <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-import" ></span></span>
                          <input type="text" name="sourceoffice" id="autocompleteajax3" class="form-control" placeholder="Source Office" /><center>
                          <input type="hidden" id="autocomplete-ajax-x-3" disabled="disabled"/>
                          </div>
                        </div>
                       <div class="col-sm-6">
                          <div class="input-group">
                           <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-export"></span></span>
                           <input type="text" name="destoffice" id="autocompleteajax4" class="form-control" placeholder="Destination Office" /><center>
                          <input type="hidden" id="autocomplete-ajax-x-4" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                      <div class="row" id="nameholder" style="display:none">
                        <div class="col-sm-6">
                          <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-import"></span></span>
                           <input type="text" name="sourcename" id="autocompleteajax5" class="form-control" placeholder="Source Name" /><center>
                           <input type="hidden" id="autocomplete-ajax-x-5" disabled="disabled"/>

                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-export"></span></span>
                           <input type="text" name="destname" id="autocompleteajax6" class="form-control" placeholder="Destination Name"/><center>
                           <input type="hidden" id="autocomplete-ajax-x-6" disabled="disabled"/>
                          </div>
                        </div>
                      </div>
                     <div class="row" id="posholder" style="margin-bottom:1em;display:none">
                        <div class="col-sm-6">
                          <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-import"></span></span>
                            <input type="text" name="sourcepos" id="autocompleteajax7" class="form-control" placeholder="Source Position" /><center>
                            <input type="hidden" id="autocomplete-ajax-x-7" disabled="disabled"/>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="input-group">
                          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-export"></span></span>
                           <input type="text" name="destpos" id="autocompleteajax8" class="form-control" placeholder="Destination Position" /><center>
                           <input type="hidden" id="autocomplete-ajax-x-8" disabled="disabled"/>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group" style="" id="ddateholder">
                            <input class="form-control" placeholder="Date on Document" style="" id="ddate" name="ddate" /><center>
                            <div class="col-sm-8"></div>
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group" style="display:none;" id="resdateholder">
                           <input class="form-control" placeholder="Date Received" style="" id="resdate" name="resdate" /><center>
                            <div class="col-sm-8">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group" style="">
                          <textarea rows="3" class="form-control" placeholder="Remarks" style="padding-top:0.6em;resize:none" id="remarks" name="remarks" ></textarea><center>
                      </div>
                      <div style="display:block;font-weight:bold">Send a notification for this upload: &nbsp; <div id="theswitch" class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate bootstrap-switch-id-custom-switch-01 bootstrap-switch-off"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-primary">YES</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">NO</span><input type="checkbox" checked="" data-toggle="switch" id="custom-switch-01"></div></div></div>
                      <div id="notificationpanel" style="margin-top:1em;display:none">
                        <hr>
                        Email notifications will be sent to the selected recipients. Please note that due to technical restrictions, we can only notify one (1) region at a time (for now). You have the option to send this to more regions, one at a time, after the initial upload. There are no restrictions for NPMO or RPMO group recipients.
                        <br><br>
                        <b>Notify Groups</b><br>
                        <div class="col-md-4" style="margin-left:0;padding-left:0;padding-right:0">
                          <div class="form-group">
                              <select onchange="changeValue2(this.id)" class="form-control" id="recip_npmo">
                                <option value="">Select NPMO</option>
                                <option>All NPMO</option>
                                <option>Director</option>
                                <option>DPM - PMEF</option>
                                <option>DPM - OPS</option>
                                <option value="Management Committee">Man. Comm.</option>
                                <option value="Administrative Support Unit">Admin</option>
                                <option value="Capacity Building Unit">Capacity Building Unit</option>
                                <option value="Finance Unit">Finance</option>
                                <option value="Information Technology Unit">IT</option>
                                <option value="Operations Unit">Operations</option>
                                <option value="Partnerships Unit">Partnerships</option>
                                <option value="Monitoring and Evaluation Unit">PM&E</option>
                                <option value="Social Marketing Unit">SM/KM</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4" onchange="changeValue2(this.id)" style="padding-right:0;padding-left:0" id="recip_rpmo">
                          <div class="form-group">
                              <select class="form-control">
                                <option value="">Select RPMO</option>
                                <option value="Regional Director">All Regional Directors</option>
                                <option value="ARDO">All ARDOs</option>
                                <option value="ARDA">All ARDAs</option>
                                <option value="Regional Project Coordinator">All RPCs</option>
                                <option value="CDED Officer">All CDEDOs</option>
                                <option value="External Relations Officer">All EROs</option>
                                <option value="M&E Officer for Finance">All M&E Finance</option>
                                <option value="M&E Officer for Operations">All M&E Operations</option>
                                <option value="Training Officer">All Training Officers</option>
                                <option value="Provincial Coordinator">All PCs</option>
                              </select>
                          </div>
                      </div>
                      <div class="col-md-4" style="margin-right:0;padding-right:0;padding-left:0" >
                          <div class="form-group">
                              <select class="form-control" onchange="changeValue2(this.id)" id="recip_region">
                                <option value="">Select Entire Region</option>
                                <option>NPMO</option>
                                <option>NCR</option>
                                <option>CAR</option>
                                <option>REGION I</option>
                                <option>REGION II</option>
                                <option>REGION III</option>
                                <option>REGION IV-A</option>
                                <option>REGION IV-B</option>
                                <option>REGION V</option>
                                <option>REGION VI</option>
                                <option>REGION VII</option>
                                <option>REGION VIII</option>
                                <option>REGION IX</option>
                                <option>REGION X</option>
                                <option>REGION XI</option>
                                <option>REGION XII</option>
                                <option>CARAGA</option>
                                <option>ARMM</option>
                                <option>NIR</option>
                              </select>
                          </div>
                      </div>
    <?php
    $sql = "SELECT id, CONCAT(lastname, ', ', firstname) as name FROM hr_db";
    //$partnerIDArray = [];
    //$partnerArray = [];
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
     <?php
    $sql1 = "SELECT * FROM doc_directory";
    //$partnerIDArray = [];
    //$partnerArray = [];
    foreach ($db->query($sql1) as $results1)
    {
      $partnerIDArray1[] = intval($results1["id"]);
      $partnerArray1[] = $results1["srcoffice"];
    }
    $object = new StdClass;
    $i = 0;
    foreach ($partnerIDArray1 as $so)
    {
      $object->$so = $partnerArray1[$i];  
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
        $('#autocompleteajax3').autocomplete({
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#autocompleteajax3').val(suggestion.value);
                window.selectPartner3 = suggestion.data;
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x-3').val(hint);
            },
            onInvalidateSelection: function() {         
            }
        });
           $('#autocompleteajax4').autocomplete({
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#autocompleteajax4').val(suggestion.value);
                window.selectPartner4 = suggestion.data;
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x-4').val(hint);
            },
            onInvalidateSelection: function() {         
            }
        });

    });
    });
    </script>
      <?php
    $sql2 = "SELECT * FROM doc_directory";
    //$partnerIDArray = [];
    //$partnerArray = [];
    foreach ($db->query($sql2) as $results2)
    {
      $partnerIDArray2[] = intval($results2["id"]);
      $partnerArray2[] = $results2["srcname"];
    }
    $object = new StdClass;
    $i = 0;
    foreach ($partnerIDArray2 as $sn)
    {
      $object->$sn = $partnerArray2[$i];  
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
        $('#autocompleteajax5').autocomplete({
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#autocompleteajax5').val(suggestion.value);
                window.selectPartner5 = suggestion.data;
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x-5').val(hint);
            },
            onInvalidateSelection: function() {         
            }
        });
           $('#autocompleteajax6').autocomplete({
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#autocompleteajax6').val(suggestion.value);
                window.selectPartner6 = suggestion.data;
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x-6').val(hint);
            },
            onInvalidateSelection: function() {         
            }
        });

    });
    });
    </script>
     <?php
    $sql3 = "SELECT * FROM doc_directory";
    //$partnerIDArray = [];
    //$partnerArray = [];
    foreach ($db->query($sql3) as $results3)
    {
      $partnerIDArray3[] = intval($results3["id"]);
      $partnerArray3[] = $results3["srcpos"];
    }
    $object = new StdClass;
    $i = 0;
    foreach ($partnerIDArray3 as $sp)
    {
      $object->$sp = $partnerArray3[$i];  
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
        $('#autocompleteajax7').autocomplete({
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#autocompleteajax7').val(suggestion.value);
                window.selectPartner7 = suggestion.data;
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x-7').val(hint);
            },
            onInvalidateSelection: function() {         
            }
        });
           $('#autocompleteajax8').autocomplete({
            lookup: countriesArray,
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                $('#autocompleteajax8').val(suggestion.value);
                window.selectPartner8 = suggestion.data;
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x-8').val(hint);
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
                    </div><!--end notifpanel-->
                  </form>
              </div>
              <div class="col-md-12" style="padding-right:0">
                      <button type="button" id="uploadBtn" class="btn btn-success pull-right" style="padding:6px 10px 6px 10px;margin-top:0.8em" onclick="typeChange3()"><span class="glyphicon glyphicon-cloud-upload"></span> Upload</button>
              </div>
          </div>
      </div>
    </div>
    <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="padding:1em;padding-top:0.5em">
                      <h3 style="color:#5cb85c;margin-bottom:6px">Success!</h3>
                       <span style="font-size:13px" id="sucsubtext">Your document was successfully upload and your Reference Number is: </span><br>
                      <span style="font-size:13px">Note: If you sent email notifications, emails may take 30mins to arrive in inbox</span><br><br>
                      <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                      <div class="clearfix"></div>
              </div>
            </div>
          </div>

          </div>
          <!-- Modal -->
    <script>
    $(document).ready(function() {
      document.getElementById("theupload").onchange = function () {
      document.getElementById("uploadfilename").value = this.value;
      };
    $("#remarks").keyup(function() {
      var text = $("#remarks").val();
      text = text.replace(/\r?\n/g, '<br />');
       $('#emailsummary').html(text);
    });
       $("#dsubject").keyup(function() {
       $('#emailsubject').html(this.value);
    });  
       $("#title").prop('required',true);
    switchClass = 0;
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
    $("#theswitch").click(function(event) {
        if (switchClass == 0) {
            $("#theswitch").removeClass("bootstrap-switch-off");
            $("#theswitch").addClass("bootstrap-switch-on");
            $("#notificationpanel").slideDown();
            $("#uploadBtn").html('<span class="glyphicon glyphicon-cloud-upload"></span> Upload and Send Notifications');
            switchClass = 1;
        } else {
            $("#theswitch").removeClass("bootstrap-switch-on");
            $("#theswitch").addClass("bootstrap-switch-off");
            $("#notificationpanel").fadeOut();
            $("#uploadBtn").html('<span class="glyphicon glyphicon-cloud-upload"></span> Upload');
            switchClass = 0;
        }
    });
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
           file1 = $('#theupload').prop('files')[0];
           fd.append('action', 'upload');
           fd.append('file', file1);
           fd.append('doctype', $('#doctypeselector option:selected').val());
           fd.append('docsubject', $('input[name=dsubject]').val());
           fd.append('author', $('input[name=author]').val());
           fd.append('ddate', $('input[name=ddate]').val());
           fd.append('remarks', $('textarea[name=remarks]').val());
           fd.append('admintype', $('#admintype option:selected').text());
           fd.append('logtype', $('#logtype option:selected').text());
           fd.append('refnumber', $('input[name=refnumber]').val());
           fd.append('sourceoffice',$('#autocompleteajax3').val());
           fd.append('sourcename', $('#autocompleteajax5').val());
           fd.append('destoffice', $('#autocompleteajax4').val());
           fd.append('destname', $('#autocompleteajax6').val());
           fd.append('resdate', $('input[name=resdate]').val());
           fd.append('destpos', $('#autocompleteajax8').val());
           fd.append('sourcepos', $('#autocompleteajax7').val());
           fd.append('switch', switchClass);
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
                     $("#sucsubtext").html("Your document was successfully upload and your Reference Number is: <br><b>"+$('input[name=refnumber]').val()+"</b>");
                      $('#myModal').modal();
                      $('#myModal').on('hidden.bs.modal', function () {
                          location.href = "index.php";
                      });
                        
                        } else {
                          alert(data);
                        }
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
          format: 'M/D/YYYY', 
          onSelect: function() {
                $('#emaildate').html("dated <b style='color:red'>"+this.getMoment().format('M/D/YYYY')+"</b>");
          }
        });
        var picker = new Pikaday({ 
          field: $('#resdate')[0], 
          format: 'M/D/YYYY'
        });
</script>
</body>
</html>
