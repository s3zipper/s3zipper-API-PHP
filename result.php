<?php

$curl = curl_init();

$token = "e.0xM2NiLTQ3NTYtOGZlYS1jN2NjOTNhYTdkMjIifQ.iDExVvGju407VQZQKZfOMJiAFz_b3Ff7k2XqLf1Kq0k";

$result ='{
 "message": "STARTED",
 "size": "9.1 kB",
 "chainTaskUUID": [
  {
   "idurl": "task_204d2-5c3c-4e0b-869d-43f4ff21"
  },
  {
   "email": "task_e3be59-c1ba-4f9f-8f2d-0be9fe"
  }
 ]
}' ; // copy the raw result from streamzip or zipstart

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.s3zipper.com/v1/zipresult",
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
