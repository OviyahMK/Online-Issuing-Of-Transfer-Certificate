<!DOCTYPE html>
<html>
<head>
<title>Conduct</title>
<style>
body
{
	margin-left:3cm;
	margin-right:3cm;
	font-size:20px;
}
table
{
	border-collapse:collapse;
	background-color:#d5e1df;
}
table, th, td
{
	border:1px solid black;
}
td, th
{
	padding:15px 15px 15px 15px
}
</style>
</head>
<body>
<?php
$conn=oci_connect("system","oracle","localhost/orcl");
if(!$conn)
	echo "not connected";
/*else
	echo "connected <br>";      
echo $_POST['branch'];
echo $_POST['em_no'];    */
$q1 = " select reg_no,name from conduct where branch='{$_POST['branch']}' AND HOD_id='{$_POST['em_no']}' ";
$rd_query1 = oci_parse($conn,$q1);
$r1=oci_execute($rd_query1);
/* echo $r1. "<br>";        */

?>
<center><br><br>
<form action="constore.php" method="POST">
<table>
<h2>STUDENT LIST</h2>
<?php
echo "<tr><th>S.NO</th><th>REGISTER NUMBER</th><th>NAME</th><th>CONDUCT</th><tr>";

$x =0;
while (oci_fetch($rd_query1))
{
	
	$arr[$x][0]=oci_result($rd_query1,'REG_NO');
	$arr[$x][1]=oci_result($rd_query1,'NAME');
	$x++;
}
/* echo "value of x is" .$x; */
$n=1;
for($i=0 ; $i<$x ;$i++)
{
	echo "<tr><td>".$n."</td><td>".$arr[$i][0]."</td><td>".$arr[$i][1]."</td><td>" ?>
	<input type="radio" name="num[<?php echo $i ?>]" value="Very good" required>Very good <input type="radio" name="num[<?php echo $i ?>]" value="Good" required>Good <input type="radio" name="num[<?php echo $i ?>]" value="Satisfactory" required>Satisfactory</td></tr>
<?php
$n++;
}
oci_close($conn);
?>


</table><br>
<input type="submit" value="submit" name="submit"><br>

</center>
</form>
</body>
</html>