<?php

//extract($_POST);

$curl = curl_init();

$filePaths = array(
    '{{bucket}}/img1', 
    '{{bucket}}/files/img2', 
);
 
$url = 'https://api.s3zipper.com/v1/zipstart';

$token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

$fields = array(
            'awsKey' => 'xxxxxxxxxxxxxxxxxxxx',
            'awsSecret' => 'xxyyyyyxyyxyyxyxyyxyxyyxyxy',
            'awsBucket' => 'bucket-name',
            'expireLink' => 24,
            'resultsEmail' => 'email@yahoo.com',
            'bucketAsDir' => 'true',
            'filePaths' => $filePaths
        );


$payload = json_encode( $fields, JSON_UNESCAPED_SLASHES );
//echo $payload ;

curl_setopt( $curl, CURLOPT_POSTFIELDS, $payload );
//set the url, number of POST vars, POST data
curl_setopt($curl,CURLOPT_URL, $url);
curl_setopt($curl,CURLOPT_POST, 1);
curl_setopt($curl,CURLOPT_HTTPHEADER, array(
    'Content-Type:application/json; charset=utf-8',
    "Authorization: Bearer $token"
  ) 
);


$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
} ?>
