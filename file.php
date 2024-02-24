<?php

require_once 'constants.php';
require_once 'Autoload.php';

Autoload::init();


if (!isset($_REQUEST['token'])){
    echo '';
    exit;
}

$cipher = new Cipher();
$cdao = new MedicalCenterDAO();

$token = $_REQUEST['token'];
$json = $cipher->decrypt($token);

try{
    $data = !empty($json)? json_decode($json,associative:true,flags:JSON_UNESCAPED_UNICODE) : null;
    if (is_null($data))
        throw new Exception('ERROR: decodificación JSON');

    if (!((isset($data[ID_USER_SESSION]) && (Validations::isInteger($data[ID_USER_SESSION] || is_null($data[ID_USER_SESSION])))) || 
          (isset($data['id-center']) && Validations::isInteger($data['id-center'])) ||
          (isset($data['timestamp']) && Validations::isInteger($data['timestamp'])) ||
          (isset($data['file']) && !empty($data['file']))))
        throw new Exception('ERROR: validaciones parámetros');

    $id_user = !is_null($data[ID_USER_SESSION])? intval($data[ID_USER_SESSION]) : null;
    $id_center = intval($data['id-center']);
    $file = $data['file'];
    $timestamp = intval($data['timestamp']);

    if (is_null($center = $cdao->findById($id_center)))
        throw new Exception('ERROR: el centro médico no existe');

    //TODO: hacerlo general pasando un parámetro
    $fileurl = URL_DOCS . "centers/$id_center/$file";
    $filepath = PATH_DOCS . "centers/$id_center/$file";
    if (!@file_exists($filepath) || !@is_file($filepath))
        throw new Exception('ERROR: el archivo no existe');

    //TODO: el timestamp se puede utilizar para que esté activo durante un periodo de tiempo

}catch(Exception|Error $e){
    http_response_code(401);
    exit;
}

$mimetype = mime_content_type($filepath);
$mimeinfo = FileForm::fncGetMimeInfo($mimetype);

http_response_code(200);
header("Content-Type: {$mimetype}");
header('Content-Length: ' . filesize($filepath));
header('Content-Transfer-Encoding: binary');
header('Accept-Ranges: bytes');
header('Content-Disposition: inline');
readfile($filepath);

?>