<?php

/*
Used for updating the live status of trains 
Best used as a Cron Process

*/


include_once("core/db.php");

$json = file_get_contents('http://railradar.railyatri.in/coa/livetrainslist.json');

$count =0 ;

$y = json_decode($json, true);
	
foreach ($y[0] as $category_name ) {


if (count($category_name[0]) != 0)
{

	for($i = 0 ; $i <count($category_name) ; $i++ ) 
    {
    	


    $sql = "SELECT * from train_no where train_no=".$category_name[$i][0];
    $result1 = mysql_query($sql) or die(mysql_error());


       if(!mysql_fetch_array($result1))
        {


            $sql = "INSERT INTO `balanara_rail`.`train_no` (`train_no`, `train_name`, `fetched`) VALUES (".$category_name[$i][0].", '".$category_name[$i][1]."', '0');";

            $result2 = mysql_query($sql) or die(mysql_error());


            echo $category_name[$i][1]." Inserted<br>";

            $count++;
	   }
    
}

}

}



echo $count;

?>