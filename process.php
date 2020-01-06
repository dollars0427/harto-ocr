<?php
header('Content-Type: application/json');
require('./vendor/autoload.php');
$config = parse_ini_file('./config.ini');

if (!file_exists('./files')) {
    mkdir('./files', 0777, true);
}
$validator = new FileUpload\Validator\Simple('10M', ['image/png', 'image/jpg', 'image/jpeg', 'image/gif']);
$pathresolver = new FileUpload\PathResolver\Simple('./files');
$filesystem = new FileUpload\FileSystem\Simple();
$fileupload = new FileUpload\FileUpload($_FILES['file'], $_SERVER);

$fileupload->setPathResolver($pathresolver);
$fileupload->setFileSystem($filesystem);
$fileupload->addValidator($validator);
list($files, $headers) = $fileupload->processAll();

$ocr_result = [];
foreach($files as $file){
    if ($file->completed) {
      $file_name = $file->getFilename();
      $file_url = create_image_url($file_name);
      $result = call_azure_api($file_url, $config);
      $text_json = json_decode($result, TRUE);
      $text = create_full_text($text_json);
      $ocr_result[] = ['text' => $text];
      unlink('./files/' . $file_name);
    }
}

print json_encode($ocr_result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

function create_image_url($file_name){
  $header = 'http://';
  if(!empty($_SERVER['HTTPS'])){
    $header = 'https://';
  }
  $server_name = $_SERVER['SERVER_NAME'];
  $image_url = $header . $server_name . '/files/' . $file_name;
  return $image_url;
}

//Call Azure vision ocr API, pass key and url.
function call_azure_api($file_url, $config){
  $azure_api_endpoint = $config['vision_endpoint'];
  $azure_api_key = $config['vision_key'];
  $azure_api_url = $azure_api_endpoint . 'vision/v2.1/ocr?language=zh-Hans&detectOrientation=true';
  $headers = [
    "Ocp-Apim-Subscription-Key: $azure_api_key",
    "Content-Type: application/json",
  ];
  $data = ['url' => $file_url];
  $data_string = json_encode($data);
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_URL, $azure_api_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

  $result = curl_exec($curl);
  curl_close($curl);
  return $result;
}

function create_full_text($text_json){
  $full_text = '';
  $lines = $text_json['regions'][0]['lines'];
  $lines_text = [];
  //Create text array by line.
  foreach($lines as $index => $line){
    $lines_text[$index] = [];
    $words = $line['words'];
    foreach($words as $word){
      $text = $word['text'];
      $lines_text[$index][] = $text;
    }
  }
  //Contact text array to full text.
  foreach($lines_text as $line){
    $line_text = implode('', $line);
    $full_text = $full_text . $line_text;
  }
  return $full_text;
}
