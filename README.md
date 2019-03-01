# S3zipper-API
S3zipper is a managed zipping service for Amazon S3.  
It is a lightweight API but robust in its capabilities.
It can handle zipping many Gigabytes of data efficiently.

# Documentation
1. Zipping to Amazon S3 bucket:  
[Zip to S3 API](https://docs.s3zipper.com/#23fc2566-464e-bcf7-1e0d-614dd77290df)
2. Stream zipping while downloading:  
[Stream S3 Downloads API](https://docs.s3zipper.com/#1c290c02-8c67-14d7-6fee-3912dca4abbf)
3. EC2 AMI only (Only for AWS EC2)  
[EC2(AMI) S3ZIPPER API SERVER](https://docs.s3zipper.com/#bd260c71-5f11-4a05-a07b-6e489ca8cb7d)

# Website
- Main Website:  
[S3zipper](https://s3zipper.com/)

- AWS EC2 AMI :  
[Amazon EC2](https://aws.amazon.com/marketplace/pp/B0727QDVXV)

# USAGE

## 1. Register for Account
``` URL : https://s3zipper.com/registration/login ```

Register for a new account or login to start the process.  
[Registration](https://s3zipper.com/registration/login)

## 2. Get credentials
``` URL : https://s3zipper.com/auth/develop ```  

We will need these credentials to later get tokens.  
[Developer](https://s3zipper.com/auth/develop)

## 3. Generate token
```API : https://api.s3zipper.com/gentoken```  

We will need tokens to securely access the rest of the API. Please save this token in a cookie or a session depending on your use case.

- Tokens are generated using credentials from step 2 above.

- All tokens last for 24 hours.

```php
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

```

## 4. Start zipping
The API currently supports two generally desired modes:  
### 4a). Zip to Amazon S3 bucket  
 ``` API : https://api.s3zipper.com/v1/zipstart  ```    

**zipstart:**  will zip files back into the same originating bucket and issue a download URL when done.

```php
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

```

### 4b). Stream download zip files on a browser
``` API :  https://api.s3zipper.com/v1/streamzip ```

 **streamzip:**  will generate a URL that can later be used to stream download files on a browser.

 ```php
<?php

//extract($_POST);

$curl = curl_init();

$filePaths = array(
    '{{bucket}}/img1', 
    '{{bucket}}/files/img2', 
);
 
$url = 'https://api.s3zipper.com/v1/streamzip';


$token = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";

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

 ```

## 5. Check your progess.
``` API : https://api.s3zipper.com/v1/zipstate ```

Some jobs can take quite a bit, and you might want to know their progress.  With this API call, you will get to know if the process completed successfully or if it is still running.
- For this, we will need the result from step 4.

```php
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
```

## 6. Get the results.  
``` API : https://api.s3zipper.com/v1/zipresult```  

The API provides a background task that just listens and waits for the result. When done, it returns the result.   
**NB:**  
- It only returns the last result. If you zipped and requested the results emailed to you ; you will get a result about the email being sent.
- This is good if you need to automate things a bit. A good example is if you need to wait and send customized emails containing the result.
- This also consumes the result from step 4.

```php
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

```

## Conclusion

There it is! This API is more than three years in development, and we are putting a lot of effort into it to make sure that it gets even better. Our hope is to make it a de facto zipping service for busy people.

For now, it is intended to be a simple and relatively cheap API that just works and makes things easy.

More examples with different programming languages are available in [Documentation](https://docs.s3zipper.com/)
