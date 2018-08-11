<!DOCTYPE html>
<html>
<head>
<title>Details</title>
<style>
body
{
	margin-left:7cm;
	margin-right:7cm;
	font-size:20px;	
}
td, th
{
	padding:10px 10px 10px 10px;
}
#txt, pre
{
	font-family:Arial Black;
	
}
#txt
{
	padding:20px 10px 10px 10px;
}
</style>
</head>
<body>
<?php
$conn=oci_connect("system","oracle","localhost/orcl");
if(!$conn)
	echo "not connected to database";
/*else
	echo "connected <br>"; */


$q1 = " select name,name_parent,DOB,gender,nationality,religion,community,caste,aadhar_no,admission_date,branch,duration,leaving_sem,completed,leaving_date,conduct from conduct where reg_no='{$_POST['regno']}' ";
$rd_query1 = oci_parse($conn,$q1);
$r1=oci_execute($rd_query1);
/*echo $r1. "<br>";   */
$reg=$_POST['regno'];
?>
<center><h2>REPORT</h2>
<br><br>
<fieldset>
<table>
<br>
<tr><td>1. REGISTER NUMBER</td><td>: <?php echo $reg; ?> </td></tr>
<?php
$x=0;
	while (oci_fetch($rd_query1))
	{
		echo "<tr><td>2. NAME OF THE STUDENT</td><td>: " . oci_result($rd_query1,'NAME') . "</td></tr><tr></tr>";
		echo "<tr><td>3. NAME OF THE FATHER/MOTHER/GUARDIAN</td><td>: " . oci_result($rd_query1,'NAME_PARENT') . "</td></tr><tr></tr>";
		echo "<tr><td>4. DATE OF BIRTH</td><td>: " . oci_result($rd_query1,'DOB') . "</td></tr>";
		echo "<tr><td>5. GENDER       </td><td>: " . oci_result($rd_query1,'GENDER') . "</td></tr>";
		echo "<tr><td>6. NATIONALITY</td><td>: " . oci_result($rd_query1,'NATIONALITY') . "</td></tr><tr></tr>";
		echo "<tr><td>7. RELIGION</td><td>: " . oci_result($rd_query1,'RELIGION') . "</td></tr><tr></tr>";
		echo "<tr><td>8. COMMUNITY</td><td>: " . oci_result($rd_query1,'COMMUNITY') . "</td></tr><tr></tr>";
		echo "<tr><td>9. CASTE</td><td>: " . oci_result($rd_query1,'CASTE') . "</td></tr><tr></tr>";
		echo "<tr><td>10. AADHAR NUMBER</td><td>: " . oci_result($rd_query1,'AADHAR_NO') . "</td></tr><tr></tr>";
		echo "<tr><td>11. DATE OF ADMISSION</td><td>: " . oci_result($rd_query1,'ADMISSION_DATE') . "</td></tr><tr></tr>";
		
		echo "<tr><td>12. DEGREE TO WHICH THE STUDENT WAS ADMITTED/STUDIED</td><td>: " . oci_result($rd_query1,'BRANCH') . "</td></tr></pre>";
		echo "<tr><td>13. DURATION OF DEGREE/</td><td>: " . oci_result($rd_query1,'DURATION') . "</td></tr><tr></tr>";
		echo "<tr><td>14. SEMESTER STUDIED AT THE TIME OF LEAVING</td><td>: " . oci_result($rd_query1,'LEAVING_SEM') . "</td></tr><tr></tr>";
		echo "<tr><td>15. WHETHER COMPLETED THE DEGREE</td><td>: " . oci_result($rd_query1,'COMPLETED') . "</td></tr><tr></tr>";
		echo "<tr><td>16. ACTUAL DATE OF LEAVING</td><td>: " . oci_result($rd_query1,'LEAVING_DATE') . "</td></tr><tr></tr>";
		echo "<tr><td>17. CONDUCT AND CHARACTER</td><td>: " . oci_result($rd_query1,'CONDUCT') . "</td></tr><tr></tr>";
		$x++;
	}
if($x != 0)
{
?>
</table><br>


<?php 
}
else
{	
?>
	<br><b>Wrong Register Number</b><br><a href="reportlogin.html" >Go Back To Login</a>
<?php
}
oci_close($conn);
?>
<br><br>
<table id="txt">
<tr><td>SEAL</td><td><pre>                                </pre></td><td>
<pre>              DEAN       
College of Engineering Guindy
Anna University, Chennai-25</pre></td></tr>
</table>
</fieldset>
</center>
</body>
</html>