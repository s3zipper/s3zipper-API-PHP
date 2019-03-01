<?php

$curl = curl_init();

$token = "eyJhbGciOiJIUzI1NiIsIn.YtOGZlYS1jN2NjOTNhYTdkMjIifQ.iDExVvGju407VQZQKZfOMJiAFz_b3Ff7k2XqLf1Kq0k";

$result ='{
 "message": "STARTED",
 "size": "9.1 kB",
 "chainTaskUUID": [
  {
   "streams3": "task_fcc32e65-0db"
  },
  {
   "email": "task_325b015d-6297-499"
  }
 ]
}' ; // copy the raw result from streamzip or zipstart

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.s3zipper.com/v1/zipstate", // if you use http, you will not get a reply
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$result,
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer $token",
    "Content-Type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
} ?>
