<?php
if(isset("$_POST['']"))
?>

<!DOCTYPE html>
<html>
<head>
<title>Details</title>
<script type="text/javascript">
function checkvalue(val)
{
    if(val==="0")
       	document.getElementById("others").innerHTML='<input type="text" name="religion"  required placeholder="religion">';
    else
       	document.getElementById("others").innerHTML="";
}

</script> 
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
<?php
include("conn.php")
/*else
	echo "connected <br>"; */  


$q1 = " select name,DOB,gender,branch from conduct where reg_no='{$_POST['regno']}' ";
$rd_query1 = oci_parse($conn,$q1);
$r1=oci_execute($rd_query1);
/* echo $r1. "<br>";    */   


$q = "select r_sno,r_name from religion";
$rd_query = oci_parse($conn,$q);
$r=oci_execute($rd_query);
//echo $r. "<br>";



?>
<center><h2>DETAILS</h2>
<br><br>
<fieldset>
<form action="store.php" method="post">
<table>
<br>
<?php
$x=0;
	while (oci_fetch($rd_query1))
	{
		echo "<tr><td>NAME</td><td>: " . oci_result($rd_query1,'NAME') . "</td></tr><tr></tr>";
		echo "<tr><td>DATE OF BIRTH</td><td>: " . oci_result($rd_query1,'DOB') . "</td></tr>";
		echo "<tr><td>GENDER       </td><td>: " . oci_result($rd_query1,'GENDER') . "</td></tr>";
		echo "<tr><td>BRANCH       </td><td>: " . oci_result($rd_query1,'BRANCH') . "</td></tr></pre>";
		$x++;
	}
if($x != 0)
{
?>
</table><br>
</fieldset><br><br>




<fieldset>
<br><br>
<table>
<tr><td>NAME OF THE FATHER/MOTHER/GUARDIAN</td><td>: <input type="text" placeholder="Enter the name" name="name_parent" required></td></tr>
<tr><td>RELIGION</td><td>:
<select name="rel"  onchange='checkvalue(this.value)' required> 
    <option value=""> - select one - </option> 
<?php
while(oci_fetch($rd_query))
	{
	?>
	 
    <option value="<?php echo oci_result($rd_query,'R_SNO') ?> "> <?php echo oci_result($rd_query,'R_NAME') ?> </option>
    <?php } ?>
    <option value="0">others</option>
    </select> 
    <div id="others" ></div>

</td></tr>
<tr><td>CASTE</td><td>: <input type="text" placeholder="Enter the caste" name="caste" required></td></tr>
<tr><td>AADHAR NUMBER</td><td>: <input type="text" placeholder="XXXXXXXXXXXX" name="aadhar_no" required></td></tr>
<tr><td>DATE OF ADMISSION</td><td>: <input type="date" placeholder="Enter the date" name="admission_date" required></td></tr>
</table>
<br>
<input type="submit" value="submit" name="submit"><br>
<input type="hidden" name="regno" value="<?php echo $_POST['regno']; ?>">
</form>
<br>
</fieldset>
</center>

<?php 
}
else
{	
?>
	<br><b>Wrong Register Number</b><br><a href="login.html" >Go Back To Login</a>
<?php
}
oci_close($conn);
?>
</body>
</html>