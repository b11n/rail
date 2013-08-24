<?php



$time_start = microtime(true);





$json = file_get_contents('http://railradar.railyatri.in/coa/livetrainslist.json');





$y = json_decode($json, true);



  $con = mysql_connect('localhost','balanara_me',',+$=0v+u9&*D')  or die(mysql_error());



  





if (mysqli_connect_errno($con))

  {

  echo "Failed to connect to MySQL: " . mysqli_connect_error();

  }



        



   mysql_select_db("balanara_rail",$con) or die(mysql_error());



 





  $sql = "DELETE from livestatus where 1";



  $res = mysql_query($sql) or die(mysql_error());





foreach ($y[0] as $category_name ) {





	for($i = 0 ; $i <count($category_name) ; $i++ ) 

    {

    	

	 $sql = "INSERT INTO `balanara_rail`.`livestatus`  VALUES ('".$category_name[$i][0]."', '".$category_name[$i][1]."', '".$category_name[$i][2]."', '".$category_name[$i][3]."', ".$category_name[$i][7].", '".$category_name[$i][10]."', ".$category_name[$i][12].", '".$category_name[$i][14]."');";



  $res = mysql_query($sql);



	

}

    

}









echo "Update Took ~". (microtime(true) - $time_start) ." seconds";

?>



