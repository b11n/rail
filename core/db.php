<?php


$con = mysql_connect('localhost','username','pass')  or die(mysql_error());
  



if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

 mysql_select_db("db_name",$con) or die(mysql_error());

 function getdbresults($sql)
 {
 	$res = mysql_query($sql) or die(mysql_error());
 	return $res;
 }



 ?>
