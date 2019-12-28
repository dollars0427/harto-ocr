<?php
require('./vendor/autoload.php');
$config = parse_ini_file('./config.ini');
$upload_path = $config['file_path'];

ini_set('display_errors', 1);
$validator = new FileUpload\Validator\Simple('10M', ['image/png', 'image/jpg', 'image/gif']);
$pathresolver = new FileUpload\PathResolver\Simple($upload_path);
$filesystem = new FileUpload\FileSystem\Simple();
$fileupload = new FileUpload\FileUpload($_FILES['file'], $_SERVER);

$fileupload->setPathResolver($pathresolver);
$fileupload->setFileSystem($filesystem);
$fileupload->addValidator($validator);
list($files, $headers) = $fileupload->processAll();

echo json_encode(['files' => $files]);

foreach($files as $file){
    if ($file->completed) {
      echo $file->getRealPath();
    }
}
