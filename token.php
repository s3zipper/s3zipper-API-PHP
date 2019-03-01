<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.s3zipper.com/gentoken",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_PROXY => null,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('userKey' => 'xxxxxxxxxxxxx','userSecret' => 'xxxxxxxxxxxxxxxxxx'),
));


$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
} 
?>
