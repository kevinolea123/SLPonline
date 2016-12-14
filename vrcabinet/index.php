<?php 
    require "../zxcd9.php";
    byteMe($_SESSION['id'],'vc_search',0.10);
    $stmt = $db->prepare("SELECT doctype, COUNT(id) as total FROM `doc_db` GROUP BY doctype");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        switch($row['doctype']) {
            case "Admin Doc": $count_admin=$row['total']; break;
            case "Blast": $count_blast=$row['total']; break;
            case "Guide / Manual": $count_guide=$row['total']; break;
            case "Project Proposal": $count_proposal=$row['total']; break;
            case "Policy Document": $count_policy=$row['total']; break;
            case "Report": $count_report=$row['total']; break;
            case "Template / Form": $count_template=$row['total']; break;
        }
    }
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
        <script src="../js/jquery-1.10.2.min.js"></script>
        <link rel="stylesheet" href="../css/flatbootstrap.css"/>
        <link rel="stylesheet" href="../css/fileicon.css"/>
        <link rel="stylesheet" href="../css/pikaday.css"/>
        <script type="text/javascript" src="../js/jquery.autocomplete.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
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
    .disabled {
        background:rgba(1,1,1,0.2);
        border:0px solid;
        cursor:progress;
    }
      ::-webkit-input-placeholder {
        font-size: 17px;
        text-align: center;
    }
      :-moz-placeholder { /* older Firefox*/
        font-size: 17px;
        text-align: center;
    }
        ::-moz-placeholder { /* Firefox 19+ */ 
        font-size: 17px;
        text-align: center;
    } 
    :-ms-input-placeholder { 
        font-size: 17px; 
        text-align: center;
    }
    .dtsubhead {
        line-height: 0.5;
        font-size:11px;
        color:#777;
        text-decoration: none;
        margin-top: -5px;
        padding-top: 0;
    }
    .linkhover {
        color:#00ADDe;
    }
    .linkhover:hover {
        color:#333;
    }
    table.table thead .sorting {
        background: url('../imgs/sort_both.png') no-repeat center right;
        cursor:pointer;
    }
    table tr {
        cursor: pointer;
    }
    .autocomplete-suggestions { cursor:pointer;border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
    .autocomplete-suggestion { cursor:pointer;padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-no-suggestion { padding: 2px 5px;}
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: bold; color: #000; }
    .autocomplete-group { padding: 2px 5px; }
    .autocomplete-group strong { font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
    .totalfilecount {
        text-align:center;font-weight:normal;font-size:26px;vertical-align:middle;
    }
    .foldericon {
        width:40px;
        height:40px;
        padding:1em;
    }
    </style>
    </head>
    <body>
      <div id="slideout">
        <img src="../imgs/feedback.png" alt="Feedback" />
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
          <div class="row" style="padding-top:-1em">
              <div class="col-md-3" id="maincontent" style="margin-top:2em;margin-bottom:0em;text-align:center;padding-left:3em">
                  <div style="border:solid 0px #c5d6de;background:none;text-align:left;padding:0;margin-bottom:0;height:160px;padding-left:1em" id="cont1">
                  </div>  
              </div>
              <div class="col-md-8" id="searchblock" style="padding:2em;">
                    <div style="margin-top:2em">
                      <div class="form-group">
                          <input id="searchme" class="form-control" placeholder="Search keywords..." style="height:50px;text-align:center;padding-left:0"/><center>
                          <button class="btn btn-danger" id="categoryback" style="display:none;margin-top:0.8em;padding:6px 10px 6px 10px;"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp; Show All Categories</button>
                          <button id="advancedbtn" class="btn btn-info" style="padding:6px 10px 6px 10px;margin-top:0.8em"><span class="glyphicon glyphicon-search"></span> Advanced Search</button> 
                          <a href="upload.php"><button class="btn btn-success" style="padding:6px 10px 6px 10px;margin-top:0.8em"><span class="glyphicon glyphicon-cloud-upload"></span> Upload</button></a>
                          <button id="printme" class="btn btn-warning" style="padding:6px 10px 6px 10px;margin-top:0.8em"><span class="glyphicon glyphicon-print"></span> Print Selected</button>
                      </div>
                    </div>
              </div>
          </div>
          <div class="row" id="advancedsearch" style="padding:2em;padding-bottom:0;display:none;padding-top:1em">
            <div class="col-sm-6">
                  <div class="form-group">
                    <select class="form-control" onchange="filterCategory()" id="fCategory">
                      <option value="">Filter by Category</option>
                      <?php
                            $sql = $db->prepare("SELECT * FROM libhr_doctype order by hrdocname");
                            $sql->execute();
                            while($hrdocname=$sql->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                              <option value="<?php echo $hrdocname['hrdocname']; ?>"><?php echo $hrdocname['hrdocname']; ?></option>
                      <?php
                            }
                      ?>
                            <option>Blast</option>
                    </select>
                  </div>
                   <div class="form-group">
                    <div class="form-group" style="margin-top:1em;" id="docdate">
                          <input class="form-control" placeholder="Filter by Date" style="" id="ddate" name="ddate"/><center>
                      </div>
                  </div>
            </div>
            <div class="col-sm-6">
                  <div class="form-group">
                    <select class="form-control" onchange="filterType()" id="fType">
                      <option value="">Filter by File Type</option>
                      <option>pdf</option>
                      <option>png</option>
                      <option>jpg</option>
                      <option>jpeg</option>
                      <option>xls</option>
                      <option>xlsx</option>
                      <option>doc</option>
                      <option>docx</option>
                    </select>
                  </div>
                     <div class="form-group">
                    <input type="text" name="autocompleteajax" id="autocompleteajax" class="form-control" placeholder="Search by Uploader"/>
                    <input type="hidden" id="autocomplete-ajax-x" disabled="disabled"/>
                  </div>
            </div>
            <div class="col-sm-6">
                          <input class="form-control" placeholder="Filter by Date Received" style="" id="dr" name="dr"/><center>
            </div>
            <div class="col-sm-2">
              <button id="resetfilters" class="btn btn-warning col-md-12" style="padding:6px 10px 6px 10px;">Reset Filters</button>
            </div>
             <div class="col-sm-4">
                          <input type="hidden"/><center>
            </div>
         </div>
          <div class="row" id="dttablerow">
            <div class="col-md-12" style="padding: 2em 3em 2em 3em">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="folders" style="background-color:#fff;width:100%;line-height:0.5;">
                  <thead style="width:100%">
                    <tr style="width:100%">     
                    <th style="width:70%;" colspan="2">Files by Category</th>
                    <th>Total Files</th>
                    <th>Latest Activity</th>
                    </tr>
                  </thead>
                  <tr onclick="gotofiles('Admin Doc');">
                    <td class="foldericon"><img src="../imgs/foldericon.png" style="width:100%;"></td>
                    <td style="border-left:0px"><div style="font-size:18px;font-weight:bold;">Admin Docs</div>For advisories, memorandums, etc.</td>
                    <td class="totalfilecount"><?php echo $count_admin; ?></td>
                    <td>-</td>
                  </tr>
                  <tr onclick="gotofiles('Blast');">
                    <td class="foldericon"><img src="../imgs/foldericon.png" style="width:100%;"></td>
                    <td><div style="font-size:18px;font-weight:bold;">Blasts</div>For previously sent email blasts</td>
                    <td class="totalfilecount"><?php echo $count_blast; ?></td>
                    <td>-</td>
                  </tr>
                  <tr onclick="gotofiles('Guide / Manual');">
                    <td class="foldericon"><img src="../imgs/foldericon.png" style="width:100%;"></td>
                    <td><div style="font-size:18px;font-weight:bold;">Guides & Manuals</div>-</td>
                    <td class="totalfilecount"><?php echo $count_guide; ?></td>
                    <td>-</td>
                  </tr>
                  <tr onclick="gotofiles('Project Proposal');">
                    <td class="foldericon"><img src="../imgs/foldericon.png" style="width:100%;"></td>
                    <td><div style="font-size:18px;font-weight:bold;">Project Proposals</div>For reference in best practices</td>
                    <td class="totalfilecount"><?php echo $count_proposal; ?></td>
                    <td>-</td>
                  </tr>
                  <tr onclick="gotofiles('Policy Document');">
                    <td class="foldericon"><img src="../imgs/foldericon.png" style="width:100%;"></td>
                    <td><div style="font-size:18px;font-weight:bold;">Policy Documents</div>For all SLP relevant policies</td>
                    <td class="totalfilecount"><?php echo $count_policy; ?></td>
                    <td>-</td>
                  </tr>
                  <tr onclick="gotofiles('Report');">
                    <td class="foldericon"><img src="../imgs/foldericon.png" style="width:100%;"></td>
                    <td><div style="font-size:18px;font-weight:bold;">Reports</div>For physical and financial accomplishment and other reports</td>
                    <td class="totalfilecount"><?php echo $count_report; ?></td>
                    <td>-</td>
                  </tr>
                  <tr onclick="gotofiles('Template / Form');">
                    <td class="foldericon"><img src="../imgs/foldericon.png" style="width:100%;"></td>
                    <td><div style="font-size:18px;font-weight:bold;">Templates & Forms</div>-</td>
                    <td class="totalfilecount"><?php echo $count_template; ?></td>
                    <td>-</td>
                  </tr>
                </table>
            </div>
          </div>
          <div class="row" id="dttablerow2" style="display:none">
            <div class="col-md-12" style="padding: 2em 3em 2em 3em">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-hover hover" id="docdata" style="background-color:#fff;width:100%;line-height:0.5;">
                <thead>
                  <tr>
                  <th style="background:none"></th>
                  <th>Title / Subject</th>
                  <th><center>Category</center></th>
                  <th><center>Doc. Type</th>
                  <th><center>Reference No.</th>
                  <th><center>Office</th>
                  <th><center>Date Received </th>
                  <th>filetype</th>
                  <th>region</th>
                  <th>fileext</th>
                  <th>filename</th>
                  <th>id</th>
                  <th>hrdbid</th>
                  <th></th>
                  <th><center>Uploader</th>
                  </tr>
                </thead>
                </table>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog" style="margin-top:3em">
            <div class="modal-dialog modal-sm">
              <div class="modal-content" style="padding:1em;">
                      <h3 style="color:#5cb85c;">Success!</h3>
                      <button type="button" class="btn btn-primary pull-right" style="background:#5cb85c;border:0;margin-top:0;padding:5px 10px 5px 10px" id="okaybtn" data-dismiss="modal">Okay</button>
                      <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- Modal -->
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
    <script src="../js/DTbootstrap.js"></script>
    <script>
                    function com(x) {
                        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    admin = <?php echo $count_admin; ?>;
                    blast = <?php echo $count_blast; ?>;
                    guide = <?php echo $count_guide; ?>;
                    propo = <?php echo $count_proposal; ?>;
                    policy = <?php echo $count_policy; ?>;
                    report = <?php echo $count_report; ?>;
                    form = <?php echo $count_template; ?>;
                    totalcounter = <?php echo ($count_admin+$count_blast+$count_guide+$count_proposal+$count_policy+$count_report+$count_template); ?>;
    $(function () {
        $(document).ready(function () {
          var colors = Highcharts.getOptions().colors;
            $('#cont1').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie',
                    backgroundColor: null,
                    margin: [0,0,0,0],
                    spacing: 0,
                },
                title: {
                       text: totalcounter,
                       verticalAlign: 'middle',
                       y: 0,
                       x: 0,
                       style: {
                            fontFamily: 'Lato', 
                            fontSize: '26px',
                            fontWeight: 'bold',
                        }
                },
                subtitle: {
                    text: 'Total Files',
                    verticalAlign: 'middle',
                    y: 15,
                    x: 0,
                    style: {
                            fontFamily: 'Lato', 
                            fontSize: '12px',
                        }
                },

                tooltip: {
                    formatter: function() {
                        var point = this.point,
                            s = '<span style="color:#000;font-size:11">' + point.name +': <b>'+ Highcharts.numberFormat(this.point.y,0,'.',',') +'</b><br/>';
                        if (point.drilldown) {
                            s += '<span style="color:#000;font-size:11">Click to view regional';
                        } else if (!point.drilldown) {
                            s = this.point.name +': <b>'+ Highcharts.numberFormat(this.point.y,0,'.',',') +'</b><br/>';
                        } else {
                            s += '<span style="color:#000;font-size:10">Click to return';
                        }
                        return s;
                    },
                    hideDelay: 0
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        size:'100%',
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                legend: {
                  layout: 'horizontal',
                  align: 'center',
                  verticalAlign: 'bottom',
                  floating: false,
                  backgroundColor: '',
                  //width: 300,
                  //x: 50,
                  itemStyle: {
                     font: 'Lato, sans-serif',
                     fontSize: '10px'
                  },
                  enabled: false
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Users',
                    colorByPoint: true,
                    innerSize: '70%',
                    data: [{
                        name: 'Admin Docs',
                        y: parseInt(admin),
                        color: colors[2]
                        
                    }, {
                        name: 'Blasts',
                        y: parseInt(blast),
                        color: colors[0]
                    }, {
                        name: 'Guides & Manuals',
                        y: parseInt(guide),
                        color: colors[3]
                    }, {
                        name: 'Project Proposals',
                        y: parseInt(propo),
                        color: colors[4]
                    }, {
                        name: 'Policy Documents',
                        y: parseInt(policy),
                        color: colors[5]
                    }, {
                        name: 'Reports',
                        y: parseInt(report),
                        color: colors[6]
                    }, {
                        name: 'Templates & Forms',
                        y: parseInt(form),
                        color: colors[7]
                    }]
                }]
            });
        });
    });
                </script>
    <script>
    function gotofiles(filetype) {
      if (tableshown==false) {
          tableshown=true;
          $("#dttablerow").css( "display", "none" );
          $("#dttablerow2").css( "display", "block" );
          $("#categoryback").css( "display", "inline-block" );
          oTable.fnFilter("^"+filetype+"$", 2, true, false, true);
          if (filetype=="Admin Doc") {
            $("#printme").css( "display", "inline-block" );
            oTable.fnSetColumnVis( 2, false,false );
            oTable.fnSetColumnVis( 3, true,true );
            oTable.fnSetColumnVis( 4, true,true );
            oTable.fnSetColumnVis( 5, true,true );
          } else {
            oTable.fnSetColumnVis( 2, true,true );
            oTable.fnSetColumnVis( 3, false,false );
            oTable.fnSetColumnVis( 4, false,false );
            oTable.fnSetColumnVis( 5, false,false );
          }
       }
    }
    function filterCategory() {
      var category = document.getElementById("fCategory").value;
        oTable.fnFilter("^"+category+"$", 2, true, false, true);
    }

    function filterType() {
      var category = document.getElementById("fType").value;
        oTable.fnFilter(category, 8, true, false, true);
    }
    $("#resetfilters").click(function(event) {
      oTable.fnFilter("",2,false);
      oTable.fnFilter("",0,false);
      oTable.fnFilter("",4,false);
      oTable.fnFilter("",10,false);
      oTable.fnFilter("",13,false);
      oTable.fnFilter("",6,false);
    });
    function toTitleCase(str) {
        return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    }
    printArray = [];
    clickedArray = [];
    function printID(idnum,cb) {
        if (cb.checked == true) {
          printArray.push(idnum);
          clickedArray.push(idnum);
        } else {
          var pa = printArray.indexOf(parseInt(idnum));
          if (pa > -1) {
            printArray.splice(pa, 1);
          }
        }

    }
    $.fn.DataTable.ext.pager.numbers_length = 5;
      oTable = $('#docdata').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        "orderCellsTop": true,
        "ajax": "dt_docdb222.php",
        "dom": '<"top">rt<"bottom"ip><"clear">',
        "aaSorting": [9,'desc'],
        "fnRowCallback":
          function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            $(nRow).attr('id', aData[0]);
            $(nRow).attr('type', aData[2]);
            return nRow;
          },
        "aoColumnDefs": [
                { 
                   "aTargets":[0],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                        $(nTd).css('width', '20px');
                        $(nTd).css('vertical-align', 'middle');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                      file_ext = data[8].substr(data[8].lastIndexOf('.')+1);
                      if (data[8]!==null && data[2]=="Admin Doc") {
                            if (file_ext == "docx") {
                              return '<td><div class="file-icon file-icon-sm" data-type="doc"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            } else if (file_ext == "pdf") {
                              return '<td><div class="file-icon file-icon-sm" data-type="pdf"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            } else if (file_ext == "xls") {
                              return '<td><div class="file-icon file-icon-sm" data-type="xls"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this);"></td>';
                            } else if (file_ext == "xlsx") {
                              return '<td><div class="file-icon file-icon-sm" data-type="xlsx"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this);"></td>';
                            } else if (file_ext == "png") {
                              return '<td><div class="file-icon file-icon-sm" data-type="png"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            } else if (file_ext == "jpg") {
                              return '<td><div class="file-icon file-icon-sm" data-type="jpg"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            } else if (file_ext == "zip") {
                              return '</td><td><div class="file-icon file-icon-sm" data-type="zip"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            } else if (file_ext == "pptx") {
                              return '</td><td><div class="file-icon file-icon-sm" data-type="pptx"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            } else if (file_ext == "ppt") {
                              return '<td><div class="file-icon file-icon-sm" data-type="ppt"></div></td><td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            } else {
                              return '<td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            }
                    } else if (data[8]!=null) {
                            if (file_ext == "docx") {
                              return '<td><div class="file-icon file-icon-sm" data-type="doc"></div></td>';
                            } else if (file_ext == "pdf") {
                              return '<td><div class="file-icon file-icon-sm" data-type="pdf"></div></td>';
                            } else if (file_ext == "xls") {
                              return '<td><div class="file-icon file-icon-sm" data-type="xls"></div></td>';
                            } else if (file_ext == "xlsx") {
                              return '<td><div class="file-icon file-icon-sm" data-type="xlsx"></div></td>';
                            } else if (file_ext == "png") {
                              return '<td><div class="file-icon file-icon-sm" data-type="png"></div></td>';
                            } else if (file_ext == "jpg") {
                              return '<td><div class="file-icon file-icon-sm" data-type="jpg"></div></td>';
                            } else if (file_ext == "zip") {
                              return '</td><td><div class="file-icon file-icon-sm" data-type="zip"></div></td>';
                            } else if (file_ext == "pptx") {
                              return '</td><td><div class="file-icon file-icon-sm" data-type="pptx"></div></td>';
                            } else if (file_ext == "ppt") {
                              return '<td><div class="file-icon file-icon-sm" data-type="ppt"></div></td>';
                            } else {
                              return '<td><input type="checkbox" onclick="printID('+data[0]+',this)"></td>';
                            }
                    }
                  }
                },
                { 
                   "aTargets":[1],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'left');
                        $(nTd).css('line-height', '1.1');
                        $(nTd).css('vertical-align', 'middle');
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
                        $(nTd).css('width', '16%');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                        return '<td>'+data[2]+'</td>';
                    }
                },
                { 
                   "aTargets":[3],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                        $(nTd).css('width', '16%');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                        if (data[12]=="Outgoing") {
                          return '<td><span class="glyphicon glyphicon-export" style="color:#e74c3c"></span> '+data[11]+'</td>';
                        } else if (data[12]=="Incoming") {
                          return '<td><span class="glyphicon glyphicon-import colgreen"></span> '+data[11]+'</td>';
                        } else {
                          return '<td>'+data[11]+'</td>';
                        }
                    }
                },
                { 
                   "aTargets":[4],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                        $(nTd).css('width', '16%');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                        return '<td>'+data[13]+'</td>';
                    }
                },
                { 
                   "aTargets":[5],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                        $(nTd).css('width', '14%');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                        return '<td>'+data[14]+' <span class="glyphicon glyphicon-arrow-right" style="font-size:12px"></span> '+data[16]+'</td>';
                    }
                },
                { 
                   "aTargets":[14],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                        $(nTd).css('width', '16%');
                        $(nTd).css('line-height', '1.1');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                        return '<td><span class="dtsubhead">By:</span> <a href="../hr/user.php?id='+data[10]+'" class="linkhover" style="text-decoration:none;line-height:0.7;font-size:12px">'+toTitleCase(data[3])+'</a> <span class="dtsubhead" style="line-height:0.7">('+data[6]+')</span><br><span class="dtsubhead">on <font color="black">'+data[4]+'</font></span></td>';
                    }
                },
                { 
                   "aTargets":[13],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                        $(nTd).css('width', '16%');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                        return '<td>'+data[4]+'</td>';
                    }
                },
                { 
                   "aTargets":[6],
                   "fnCreatedCell": function(nTd, sData, oData, iRow, iCol)
                    {
                        $(nTd).css('text-align', 'center');
                        $(nTd).css('width', '16%');
                    },
                    "mData": null,
                    "mRender": function( data, type, full) {
                        return '<td>'+data[18]+'</td>';
                    }
                },
                { "bVisible": false, "aTargets":[7,8,9,10,11,12,13] }
                        ]
      });
          //oTable.fnFilter('<?php echo $filter;?>',6);
            $('#docdata').on( 'click', 'tbody tr', function () {
                var redirection = $(this).attr('id');
                var type = $(this).attr('type');
                var indexz = printArray.indexOf(parseInt(redirection));
                var indexy = clickedArray.indexOf(parseInt(redirection));

                if (type == "Admin Doc" && indexy == -1) {
                    window.location.href = "docview2.php?id="+redirection;
                } else if (indexy == -1) {
                    window.location.href = "docview3.php?id="+redirection;
                }

                if (indexz == -1 && indexy > -1) {
                    var pa = clickedArray.indexOf(parseInt(redirection));
                    if (pa > -1) {
                      clickedArray.splice(pa, 1);
                    }
                }
            });
    $(document).ready(function() {
      tableshown=false;
      $("#categoryback").css( "display", "none" );
      $("#printme").css( "display", "none" );

    $("#searchme").keyup(function() {
       if (tableshown==false) {
          tableshown=true;
          $("#dttablerow").css( "display", "none" );
          $("#dttablerow2").css( "display", "block" );
          $("#categoryback").css( "display", "inline-block" );
       } else {
          if (document.getElementById('searchme').value == "") {
            tableshown=false;
            $("#dttablerow").css( "display", "block" );
            $("#dttablerow2").css( "display", "none" );
            $("#categoryback").css( "display", "none" );
          }
       }
       oTable.fnFilter(this.value);
    }); 
            //$("#angelimg").hide().delay( 400 ).fadeIn( 500 );
            //$("#searchblock").hide().delay( 1000 ).slideDown( 400 );
    advance = 0;
    $("#advancedbtn").click(function(event) {
      if (advance==0) {
        $("#advancedsearch").fadeIn();
        $("#advancedbtn").html('<span class="glyphicon glyphicon-search"></span> Hide Advanced Search');
        advance = 1;
      } else {
        $("#advancedsearch").fadeOut();
        $("#advancedbtn").html('<span class="glyphicon glyphicon-search"></span> Advanced Search');
        advance = 0;
      }
    });
    $("#categoryback").click(function(event) {
        tableshown=false;
        $("#categoryback").css( "display", "none" );
        $("#dttablerow").css( "display", "block" );
        $("#dttablerow2").css( "display", "none" );
        $("#searchme").val("");
        $("#printme").css( "display", "none" );
    });
    $("#printme").click(function(event) {
          var formData = {
            'action'        : "printview",
            'printArray'    : printArray
          };
          console.log(printArray);      
              $.ajax({
                 url: "printview.php",
                 type: "POST",
                 data: formData,
                 success: function(data)
                 {
                      location.href = "printview.php";
                 }
              });//endAjax
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
          'page'        : "cabinet_index",
          'feedback'    : $('textarea[name=feedback]').val(),
          'feedbacker'    : "<?php echo $_SESSION['id']; ?>"
        };
                    $.ajax({
                       url: "http://slp.ph/hr/sendfeedback.php",
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
      }); //endHRSUBMIT
    });
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
                oTable.fnFilter("^"+suggestion.data+"$", 10, true, false, true);
            },
            onHint: function (hint) {
                $('#autocomplete-ajax-x').val(hint);
            },
            onInvalidateSelection: function() {
                $('#selction-ajax').html('Selected Partner: <b><font color="#e74c3c">none</font></b>');
            }
        });
    });
    });
    </script>
    <script type="text/javascript" src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="../js/pikaday.min.js"></script>
    <script>
        var picker = new Pikaday({ 
          field: $('#ddate')[0], 
          format: 'M/D/YYYY', 
          onSelect: function() {
                oTable.fnFilter(this.getMoment().format('YYYY-MM-DD'), 13, true, false, true);
          }
        });
            var picker = new Pikaday({ 
          field: $('#dr')[0], 
          format: 'M/D/YYYY', 
          onSelect: function() {
                oTable.fnFilter(this.getMoment().format('YYYY-MM-DD'), 6, true, false, true);
          }
        });
</script>
</body>
</html>
