<?php
$username = "slpuser"; 
$password = "turtles9"; 
$host = "localhost"; 
$dbname = "slponline"; 

$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'); 
try 
{ 
    $db = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password, $options);
    $db->exec("SET time_zone = '+0:00'");
} 
catch(PDOException $ex) 
{ 
    die("Failed to connect: " . $ex->getMessage()); 
} 
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
session_start(); 
$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['discard_after'] = $now + 1800;
if ($_SESSION['exporttype']=="partners") {
echo "SLP ONLINE - HANAPBUHAY - PARTNERS (http://slp.ph)<br>";
echo "Downloaded on ".date("m/d/Y H:i:s")."<br><br>";
?>
<table border="1">
    <tr>
		<th>PARTNER NAME</th>
		<th>SECTOR</th>
		<th>PARTNER TYPE</th>
		<th>PARTNER INTERVENTION</th>
		<th>REGION</th>
		<th>PROVINCE</th>
		<th>CITY/MUNI</th>
		<th>EXACT ADDRESS</th>
		<th>CONTACT NAME</th>
		<th>CONTACT TITLE</th>
		<th>CONTACT EMAIL</th>
		<th>CONTACT NUMBER</th>
		<th>OPENINGS</th>
		<th>VIEW OPENINGS</th>
	</tr>
<?php
	$filter = $_SESSION['filter'];
	if ($filter == "NPMO") {
	$stmt = $db->prepare("SELECT m.orgname, m.psic, m.ptype, m.pintervention, m.region, m.province, m.municipality, m.address, m.contactperson, m.contacttitle, m.contactemail, m.contactnumber, SUM(z.numopenings), m.id FROM PRTemployers m LEFT JOIN PRTdemand z ON z.partner=m.id GROUP BY m.orgname"); 
	} else {
	$stmt = $db->prepare("SELECT m.orgname, m.psic, m.ptype, m.pintervention, m.region, m.province, m.municipality, m.address, m.contactperson, m.contacttitle, m.contactemail, m.contactnumber, SUM(z.numopenings), m.id FROM PRTemployers m LEFT JOIN PRTdemand z ON z.partner=m.id GROUP BY m.orgname"); 
	}

	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
	    echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$row[7].'</td><td>'.$row[8].'</td><td>'.$row[9].'</td><td>'.$row[10].'</td><td>'.$row[11].'</td><td>'.$row[12].'</td><td>http://slp.ph/hanapbuhay/partnerdetails.php?id='.$row[13].'</td></tr>';
	}

} else {
echo "SLP ONLINE - HANAPBUHAY - JOBS (http://slp.ph)<br>";
echo "Downloaded on ".date("m/d/Y H:i:s")."<br><br>";
	?>
<table border="1">
    <tr>
		<th>JOB NAME</th>
		<th>PARTNER</th>
		<th>OPENINGS</th>
		<th>START DATE</th>
		<th>WORKING DAYS /WEEK</th>
		<th>WORKING HOURS /WEEK</th>
		<th>EMPLOYMENT STATUS</th>
		<th>INTERVENTION</th>
		<th>INDIRECT PARTNER</th>
		<th>SALARY RANGE</th>
		<th>PREF. SEX</th>
		<th>PREF. AGE</th>
		<th>PREF. HEIGHT</th>
		<th>DESCRIPTION</th>
		<th>REQUIREMENTS</th>
		<th>REGION</th>
		<th>PROVINCE</th>
		<th>CITY/MUNI</th>
		<th>EXACT ADDRESS</th>
		<th>CONTACT NAME</th>
		<th>CONTACT TITLE</th>
		<th>CONTACT EMAIL</th>
		<th>CONTACT NUMBER</th>
		<th>ENCODED BY</th>
		<th>ENCODED ON</th>
	</tr>
<?php
	$filter = $_SESSION['filter'];
	if ($filter == "NPMO") {
	$stmt = $db->prepare("SELECT m.jobname, n.orgname, SUM(m.numopenings), m.startdate, m.workingdays, m.workinghours, m.employstatus, m.intervention, m.indirectpartner, m.salary, m.prefsex, m.prefage, m.prefheight, m.description, m.requirements, m.region, m.province, m.municipality, m.contactperson, m.contacttitle, m.contactemail, m.contactnumber, m.encodedby, m.encoded FROM PRTdemand m LEFT JOIN PRTemployers n ON m.partner=n.id GROUP BY m.jobname"); 
	} else {
	$stmt = $db->prepare("SELECT m.orgname, m.psic, m.ptype, m.pintervention, m.region, m.province, m.municipality, m.address, m.contactperson, m.contacttitle, m.contactemail, m.contactnumber, SUM(z.numopenings), m.id FROM PRTemployers m LEFT JOIN PRTdemand z ON z.partner=m.id GROUP BY m.orgname"); 
	}

	$stmt->execute();

	while ($row = $stmt->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
	      echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$row[7].'</td><td>'.$row[8].'</td><td>'.$row[9].'</td><td>'.$row[10].'</td><td>'.$row[11].'</td><td>'.$row[12].'</td><td>'.$row[13].'</td><td>'.$row[14].'</td><td>'.$row[15].'</td><td>'.$row[16].'</td><td>'.$row[17].'</td><td>'.$row[18].'</td><td>'.$row[19].'</td><td>'.$row[20].'</td><td>'.$row[21].'</td><td>'.$row[22].'</td><td>'.$row[23].'</td><td>'.$row[24].'</td></tr>';
	}

}
echo "</table>";
?>