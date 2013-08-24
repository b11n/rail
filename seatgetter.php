<?php




$ch = curl_init();


$src = $_GET['src'];
$dest = $_GET['dest'];
$day = $_GET['day'];
$month = $_GET['month'];
$clas = $_GET['class'];
$train_no = $_GET['train'];

//$payload = "lccp_src_stncode=".$src."&lccp_dstn_stncode=".$dest."&lccp_classopt=ZZ&lccp_day=".$day."&lccp_month=".$month."&submit2=Get+Trains";



$payload = "lccp_trnno=".$train_no."&lccp_day=".$day."&lccp_month=".$month."&lccp_srccode=".$src."&lccp_dstncode=".$dest."&lccp_class1=".$clas."&lccp_quota=GN&submit=Please+Wait...&lccp_classopt=ZZ&lccp_class2=ZZ&lccp_class3=ZZ&lccp_class4=ZZ&lccp_class5=ZZ&lccp_class6=ZZ&lccp_class7=ZZ&lccp_class6=ZZ&lccp_class7=ZZ";

$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_URL, "http://www.indianrail.gov.in/cgi_bin/inet_accavl_cgi.cgi");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type'=>'application/x-www-form-urlencoded')); 
 
$response = curl_exec($ch);


//echo $response;



include_once('core/simple_html_dom.php');

$html = str_get_html($response);

$ret = $html->find('table'); 



$html = $ret[24];


$ret = $html->find('tr'); 



//header('Content-type: application/json');

$result = array( );



$arr = $ret[1]->find('td');



echo $arr[2]->plaintext;









?>

