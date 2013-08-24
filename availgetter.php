<?php


include_once("core/db.php");

$ch = curl_init();


$src = $_GET['src'];
$dest = $_GET['dest'];
$day = $_GET['day'];
$month = $_GET['month'];

$payload = "lccp_src_stncode=".$src."&lccp_dstn_stncode=".$dest."&lccp_classopt=ZZ&lccp_day=".$day."&lccp_month=".$month."&submit2=Get+Trains";

$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_URL, "http://www.indianrail.gov.in/cgi_bin/inet_srcdest_cgi_date.cgi");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type'=>'application/x-www-form-urlencoded')); 
 
$response = curl_exec($ch);


//echo $response;



include_once('core/simple_html_dom.php');

$html = str_get_html($response);

$ret = $html->find('table'); 



$html = $ret[26];

$guide = array('Train No' , 'Train Name','Origin',  'Dep.Time', 'Destination',  'Arr.Time', 'Travel Time' ,'M', 'T' ,'W', 'T' ,'F'  ,'S', 'S',  '1A', '2A'  ,'FC' ,'3A',  'CC', 'SL', '2S'  ,'3E');

$ret = $html->find('tr'); 

$i = 2;


$result  = array( );

while($i<count($ret))
{

  $temp = array();
  $x = $ret[$i]->find('td');
 
  for ($j=0; $j < count($x); $j++) { 


if($j>=14 && strcmp($x[$j]->plaintext , "-") != 0)
{
    array_push($temp, $guide[$j]);
    
}
else if($j < 14)
{
    array_push($temp, $x[$j]->plaintext);
  }
    //echo $x[$j]->plaintext." ";


  }

    array_push($result, $temp);

  

  $i++;
 

}


echo json_encode($result);

?>

