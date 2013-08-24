<?php




$ch = curl_init();


$src = $_GET['src'];
$dest = $_GET['dest'];
$day = $_GET['day'];
$month = $_GET['month'];
$clas = $_GET['class'];
$train_no = $_GET['train'];

//$payload = "lccp_src_stncode=".$src."&lccp_dstn_stncode=".$dest."&lccp_classopt=ZZ&lccp_day=".$day."&lccp_month=".$month."&submit2=Get+Trains";



$payload = "lccp_submitfare=Get+Fare&lccp_trnno=".$train_no."&lccp_srccode=".$src."&lccp_dstncode=".$dest."&lccp_month=".$month."&lccp_day=".$day."&lccp_year=2013&lccp_age=ADULT_AGE&lccp_conc=ZZZZZZ&lccp_classopt=ZZ&lccp_frclass1=".$clas."&lccp_frclass2=ZZ&lccp_frclass3=ZZ&lccp_frclass4=ZZ&lccp_frclass5=ZZ&lccp_frclass6=ZZ&lccp_frclass7=ZZ&lccp_disp_avl_flg=1&lccp_enrtcode=NONE&lccp_viacode=NONE";
$agent= 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

curl_setopt($ch, CURLOPT_URL, "http://www.indianrail.gov.in/cgi_bin/inet_frenq_cgi.cgi");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_USERAGENT, $agent);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type'=>'application/x-www-form-urlencoded')); 
 
$response = curl_exec($ch);


//echo $response;



include_once('core/simple_html_dom.php');

$html = str_get_html($response);

$ret = $html->find('table'); 



$html = $ret[25];





$ret = $html->find('tr'); 



//header('Content-type: application/json');

$result = array( );

$x = count($ret);

$arr = $ret[$x-2]->find('td');

echo "Nor :". $arr[1]->plaintext;


$arr = $ret[$x-1]->find('td');


echo "  Tal :".$arr[1]->plaintext;





?>

