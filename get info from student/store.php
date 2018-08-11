<!DOCTYPE html>
<html>
<head>
<title>Store</title>
</head>
<body>
<?php
$conn=oci_connect("system","oracle","localhost/orcl");
if(!$conn)
	echo "not connected";
/*else
	echo "connected <br>";
*/

$aadhar=$_POST['aadhar_no'];
$format = "/^[0-9]{12}$/";
/*if(preg_match($aadhar,$format) === 1)*/
if(preg_match("/^\d+\.?\d*$/",$aadhar) && strlen($aadhar)==12)
{

$q1 = "update conduct set name_parent='{$_POST['name_parent']}',caste='{$_POST['caste']}',aadhar_no='{$_POST['aadhar_no']}',admission_date=to_date('{$_POST['admission_date']}','YYYY-MM-DD') where reg_no='{$_POST['regno']}'";
$rd_query1 = oci_parse($conn,$q1);
$r1=oci_execute($rd_query1);
/* echo $r1. "<br>";                     */

echo "<h3>SUCCESSFULLY UPDATED YOUR PROFILE</h3>";
oci_close($conn);
}
else
{  
?>
	<form action="phpconn1.php" method="POST"><input type="hidden" name="regno" value="<?php echo $_POST['regno']; ?>">
	<h3>INVALID AADHAR NUMBER</h3>
	<input type="submit" value="Go Back To Details Page">
	</form>
<?php
}

if($_GET['rel']==0)
{
	echo $_GET['religion'];

	$religion=$_GET['religion'];
	$query2 = "select * from religion ";
	$rd_query2 = oci_parse($conn,$query2);
	$r2=oci_execute($rd_query2);
	$count=0;
	while(oci_fetch($rd_query2))
	{
		$count++;
	}
 	echo $count;
	$incr=$count+1;
	$query3 = "insert into religion(r_sno,r_name) values($incr,$religion) ";
	$rd_query3 = oci_parse($conn,$query3);
	$r3=oci_execute($rd_query3);
}



?>


</body>
</html>