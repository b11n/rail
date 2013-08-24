<?php
Header("Content-Type: application/x-javascript; charset=UTF-8");
include_once("core/db.php");

$sql = "SELECT code,name,state FROM `station_code` where name like '%".$_GET['q']."%' or code like '%".$_GET['q']."%'";
$res = getdbresults($sql);


$result = array();
while($row = mysql_fetch_array($res))
{
	array_push( $result,  array('name' => $row['name']."-". $row['state'],'code'=>$row['code']  ) );
}

print_r(json_encode($result))

?>