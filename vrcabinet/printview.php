<?php
    require "../zxcd9.php";
    if(!empty($_POST)) { 
        $_SESSION['pa'] = $_POST['printArray'];
    }
    ?>
    <html>
    <head>
    	<title>Print View</title>
    </head>
    <body>
    <table border="1" style="width:100%">
      <col width="150">
      <col width="150">
      <col width="200">
      <col width="100">
      <col width="250">
      <col width="100">
    <tr>
      <th>Reference No.</th>	
      <th>Date Received</th>	
      <th>Title/Subject</th>	
      <th>Office</th>	
      <th>Remarks</th>
      <th>Routing Action</th>
    </tr>	
    <?php
    	$printArray=$_SESSION['pa'];
    	//$printArray=explode(",",$printArray);
    	foreach($printArray as $printid) {
                          try {
                                  $sql = $db->prepare("SELECT d.referenceno as ref,d.datereceived as dt,d.title as t,d.sourceoffice as src,
                                  d.destoffice as dest,d.remarks as rem, group_concat(e.doc_comment,' [',e.added,']<br>') as gc,hr.firstname as fn FROM doc_db as d LEFT JOIN doc_comments as e ON e.docdbid=d.id 
                                   LEFT JOIN hr_db as hr ON hr.id=d.hrdbid
                                  WHERE e.docdbid=:id order by ref");
                                  $sql->bindParam(':id', $printid);
                                  $sql->execute();
                             //     $p=$prof->fetch(PDO::FETCH_ASSOC);
                            while($printview=$sql->fetch(PDO::FETCH_ASSOC)){                      	
                            	echo "<tr><td style='text-align:center'>".$printview['ref']."</td>
                          		<td style='text-align:center'>".$printview['dt']."</td>
                          		<td>".$printview['t']."</td>
                          		<td>[".$printview['src']." >>> ".$printview['dest']."]</td>
                          		<td><b>".goprint($printview['rem'])."</b><br>".$printview['gc']."<br></td><td></td>
                          		</tr>";                      		
                         		}
                                  } catch(PDOException $e) {
                                echo "Error: " . $e->getMessage();
                                }//en
      }
      function goprint($pv) {
        if ($pv=="undefined") {
          return "-";
        } else {
          return $pv;
        }
      }     
     ?>
    </table>
    <script>
    print();
</script>
</body>
</html>
