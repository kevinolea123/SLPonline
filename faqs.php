<?php require("zxcd9.php");
byteMe($_SESSION['id'],'faqs',0.10); ?>

<!DOCTYPE html>
<html>
<head>
  <title>SLP.PH | FAQs</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/flatbootstrap.min.css"/>
  <script src="js/jquery-1.10.2.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
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

  .jumbotron {
      background-color: lightblue;
      padding: 5px 5px;
  }
  .list-group-item {
    border:0;
  }
  </style>

<body>
<?php require("nav.php"); ?>

      <div class="container">
      <div class="jumbotron" style="margin-left: 200px; margin-right: 200px">
       <center>
       <h1 style="color:black;"><b>Feeling lost?</b></h1>
        <p style="color:black;">Learn the basics of SLP.PH by checking the <br>Frequently Asked Questions</p>
        </center>
      </div>
      </div>

          <div class="container">
            
                   <div class="panel panel-default panel-primary" style="margin-left: 200px; margin-right: 200px">
                     <div class="panel-heading">
                       <h1 class="panel-title"><img src="imgs/question-user.png" class="img-rounded" style="width: 30px; height: 30px"><b> Frequently Asked Questions (FAQs)</b></h1>
                     </div>
                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse1"></span>
                             <a data-toggle="collapse" href="#collapse1"><b>How can I help a friend register for an SLP.PH account?</b></a>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/call-man-black.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                         <ul class="list-group">
                           <li class="list-group-item">
                           <p align="justify">
                           Registration to SLP.PH is by invitation only. Contact the focal persons in your region responsible for sending e-mail invitations to request for an account.</p></li>
                         </ul>
                    </div>
                  </div>
                        </div>

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse2"></span>
                             <a data-toggle="collapse" href="#collapse2"><b>After being provided with an account, how to log-in?</b></a>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/verify-icon-black.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                          <ul class="list-group">
                            <li class="list-group-item"><p align="justify">After confirming your account from the e-mail that has been sent to you, you will be logged-in to your SLP.PH main profile edit page. Verify your personal information and create your new password. Once you set up everything, you can now fully utilize the functions of the site.</p></li>
                          </ul>
                    </div>
                  </div>
                        </div>

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse3"></span>
                            <a data-toggle="collapse" href="#collapse3"><b>How can I change my password?</b></a>
                          </div>                                 
                          <div id="collapse3" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/change-password-black.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">After confirming your account from the e-mail that has been sent to you, you will be logged-in to your SLP.PH main profile edit page. Verify your personal information and create your new password. Once you set up everything, you can now log-in and fully utilize the functions of the site.</p></li>
                          </ul>
                    </div>
                  </div>
                        </div>

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse4"></span>
                            <a data-toggle="collapse" href="#collapse4"><b>What should I do if I forgot my password?</b></a>
                          </div>                                 
                          <div id="collapse4" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/lock.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">Click Forgot Password and a dialogue box will appear. Enter your e-mail address, click Submit to receive a password retrieval notification e-mail. On the e-mail message sent to you, click Recover Password to create a new password in order to regain access to your account.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div>

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse5"></span>
                            <a data-toggle="collapse" href="#collapse5"><b>Where should I go to edit my personal details?</b></a>
                          </div>                                 
                          <div id="collapse5" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/edit-profile.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">At the top of the menu bar, click Human Resources and look for My Profile. Upon clicking, you will be directed to your main profile page, click Actions below your profile photo then select Edit Profile to go to the HR Edit page to do the necessary changes. Save by clicking the Save Edit button below the page.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div>


                        <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse6"></span>
                            <a data-toggle="collapse" href="#collapse6"><b>How can I upload a profile photo?</b></a>
                          </div>                                 
                          <div id="collapse6" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/photographer.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">Go to your profile page and upon hovering the mouse pointer on your default profile image, the Upload Photo option will be shown. Click it and a modal window will appear which will allow you to browse images from your device. Once you have your desired image, select Upload and wait for the success notification. Same thing goes when reuploading. Please take note that only PNG, JPG, JPEG, TIFF, BMP files not more than 10MB are accepted.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div>

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse71"></span>
                            <a data-toggle="collapse" href="#collapse71"><b>What is the purpose of ROVER?</b></a>
                          </div>                               
                          <div id="collapse71" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/man-observe.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">The ROVER functions as a tool for recording your accomplishments as well as in keeping track of your activities. It also allows users to upload their feedback on reports. ROVER also allows you to track the activities of other staff and focal persons that works for SLP.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div>

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse7"></span>
                            <a data-toggle="collapse" href="#collapse7"><b>How can I search for files uploaded on SLP.PH?</b></a>
                          </div>                                 
                          <div id="collapse7" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/search-file.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">The E-Library menu provides a search box for you to key in the details of the file that you are searching. The Advanced Search feature is also available for a more precise searching.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div>       

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse8"></span>
                            <a data-toggle="collapse" href="#collapse8"><b>What about downloading and uploading of files on the E-Library?</b></a>
                          </div>                                 
                          <div id="collapse8" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/two-arrows.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">To download, click the file that you wish to download and a new page will appear. Click the blue Download button just beside the file details to download the file. When uploading, click Upload, attach your file and fill up the required fields prior to uploading. An e-mail notification will be sent to your e-mail address confirming the success of your upload.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div> 

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse9"></span>
                            <a data-toggle="collapse" href="#collapse9"><b>What file formats are allowed for uploading?</b></a>
                          </div>                                 
                          <div id="collapse9" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/upload-folder.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">Currently, the E-Library accepts PDF, DOC, XLSX, PNG, JPG and ZIP files. Take note that the maximum file size allowed is only up to 8MB.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div> 

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse10"></span>
                            <a data-toggle="collapse" href="#collapse10"><b>I want to familiarize myself more with SLP.PH but I don't have a regular internet connection to practice. How?</b></a>
                          </div>                                 
                          <div id="collapse10" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/worker-watching.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">The Support section under the HanapBuhay page contains short video tutorials on how to use the basic functions of SLP.PH. These videos are downloadable so once you have an internet access, you can save these videos on your device for later viewing.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div> 

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse11"></span>
                            <a data-toggle="collapse" href="#collapse11"><b>I'm always in the field. Do we have a mobile application to conveniently access SLP.PH?</b></a>
                          </div>                                 
                          <div id="collapse11" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/mobile-app-dev.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">An actual Android mobile application version of this system is in the works to provide SLP staff who are always on the go an uninterrupted and convenient online access to the services of SLP.PH anywhere.</p></li>
                          </ul>
                    </div>  
                  </div>
                        </div> 

                  <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse111"></span>
                            <a data-toggle="collapse" href="#collapse111"><b>How do i go to the SLPIS website?</b></a>
                          </div>                                 
                          <div id="collapse111" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/mobile-app-dev.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">The SLPIS website can be accessed through the following link: <a href="http://slpis.dswd.gov.ph" target="blank">http://slpis.dswd.gov.ph</a></p></li>
                          </ul>
                    </div>  
                  </div>
                        </div> 

                            <div class="panel-body"><span class="glyphicon glyphicon-menu-down" data-toggle="collapse" aria-hidden="true" href="#collapse12"></span>
                            <a data-toggle="collapse" href="#collapse12"><b>Wait I have brilliant ideas to make the site more exciting, where to?</b></a>
                          </div>                                 
                          <div id="collapse12" class="panel-collapse collapse">
                  <div class="row"><img src="imgs/idea.png" class="img-rounded" style="width: 100px; height: 100px">
                    <div class="col-md-10">
                        <ul class="list-group">
                           <li class="list-group-item"><p align="justify">We highly appreciate comments and suggestions which you think will provide significant enhancements to the overall functionality and design of SLP.PH. How? Just click the green Feedback form located on the left side of your homepage, type in your cool ideas, send and we'll do the rest. Your suggestions will appear on the Feedback for System Development section located on the main page and can be voted by you and other users. This interactive feature allows other users to set which suggestions should be prioritized. Real-time update regarding with the status of your suggestion is also available.</li>
                          </p></ul>
                    </div>  
                  </div>
                        </div> 

                        <br>
    
              <div class="panel-footer">
               <center><b>Still have questions? <br> Send your concerns or comments anytime.</b>
              <p><br><a class="btn btn-primary btn-md" href="#" role="button">Contact us!</a></p></center>
            </div>
          </div>

              <center><sup>Copyright © 2016 SLP.PH. All rights reserved.</sup></center>

</body>
</html>
