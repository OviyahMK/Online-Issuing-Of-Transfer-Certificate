<!DOCTYPE html>
<html>
<head>
<title>Update</title>
</head>
<body>

<?php
$conn=oci_connect("system","oracle","localhost/orcl");
if(!$conn)
	echo "not connected";
/*else
	echo "connected";*/


$q1 = " select reg_no from conduct where campus='CEG' AND dept='Mechanical' AND branch='B.E Mechanical Engineering' ";
$rd_query1 = oci_parse($conn,$q1);
$r1=oci_execute($rd_query1);
/*echo $r1. "<br>";*/

$x =0;
while (oci_fetch($rd_query1))
{
	
	$arr[$x]=oci_result($rd_query1,'REG_NO');
	$x++;
}
$y=0;
foreach($_POST['num'] as $key => $value)
{
  $arr1[$y]=$value;
  $y++;
}
$count=0;
for($i=0 ; $i<$x ; $i++)
{
	$val1=$arr1[$i];
	$val2=$arr[$i];
	$q2 = " update conduct set conduct='".$val1."' where reg_no='".$val2."' ";
	$rd_query2 = oci_parse($conn,$q2);
	$r2=oci_execute($rd_query2);
	/* echo $r2. "<br>";    */
	if($r2 == 1)
		$count++;
}

if($count == $x)
	echo "<h3>CONDUCT UPDATED</h3>";
oci_close($conn);
?>
</body>
</html>