<?php

$conn=oci_connect("system","oracle","localhost/orcl");
if(!$conn)
	echo "not connected";
?>