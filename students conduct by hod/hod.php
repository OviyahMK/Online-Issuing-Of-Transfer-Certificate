<!DOCTYPE html>
<html>
<head>
<title>Branch</title>
<style>
body
{
	margin-left:7cm;
	margin-right:7cm;
	font-size:20px;
}
</style>
</head>
<body>
<center><br><br>

<fieldset><br><br>
<?php
$conn=oci_connect("system","oracle","localhost/orcl");
if(!$conn)
	echo "not connected";
/*else
	echo "connected <br>";*/

$q1 = "select distinct branch from conduct where HOD_id='{$_POST['em_no']}'";
$rd_query1 = oci_parse($conn,$q1);
$r1=oci_execute($rd_query1);
/*echo $r1. "<br>";*/
?>
<form action="conduct.php" method="POST">
BRANCH : <select name="branch" id="branch" required>
<option value="">select branch</option>
<?php
$x=0;
while(oci_fetch($rd_query1))
{
?>	
	<option value="<?php echo oci_result($rd_query1,'BRANCH'); ?>" > <?php echo oci_result($rd_query1,'BRANCH') . "</option>";
	$x++;
}
if($x != 0)
{
?>

</select><br><br>
<input type="hidden" name="em_no" value="<?php echo $_POST['em_no']; ?>">
<input type="submit" value="submit"><br><br>
</form>
</center>

<?php
}
else
{
?>
	<br><b>Wrong Employee Number. No Branches Available</b><br><a href="hodlogin.html" > Go Back To Login</a>

<?php
}
oci_close($conn);
?>


</body>
</html>