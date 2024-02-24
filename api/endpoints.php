<?php

define ('PROJECT_PATH',$_SERVER['DOCUMENT_ROOT'] . '/sanidapp/');
require_once '../constants.php';
require_once '../Autoload.php';
Autoload::init();

$connection = new DBConnection;
$tdao = new TownDAO(connection:$connection);
$pdao = new ProvincesDAO(connection:$connection);
$cdao = new CommunitiesDAO(connection:$connection);
$request_uri = str_replace('/sanidapp/api','',$_SERVER['REQUEST_URI']);

if (preg_match_all("#/communities/?$#",$request_uri)){ // Comunidades
    $results = array_map(function($n){
        return [
            'id'=>$n->getId(),
            'name'=>$n->getName(),
            'id_country'=>$n->getIdCountry()
        ];
    },$cdao->findAll(dto:null,page:ALL_PAGES));

    $value = !empty($results)? $results : [];
    $json = json_encode($value,flags:JSON_UNESCAPED_UNICODE);

}else if (preg_match("#/communities/[0-9]+$#",$request_uri)){ // una comunidad
    $id = intval($_GET['c']);
    $dto = new CommunityDTO();
    $dto->setId($id);
    $result = $cdao->findById(id:$id);
    $result = (fn($n):?Community=>$n)($result);
    if (is_null($result)){
        http_response_code(404);
        exit;
    }
    $value = [
        'id'=>$result->getId(),
        'name'=>$result->getName(),
        'id_country'=>$result->getIdCountry()
    ];
    $json = json_encode($value,flags:JSON_UNESCAPED_UNICODE);

}else if (preg_match("#/communities/[0-9]+/provinces(/)?$#",$request_uri)){ // Provincias de una comunidad
    $id = intval($_GET['c']);
    if (is_null($cdao->findById(id:$id))){
        http_response_code(404);
        die;
    }
    $dto = new ProvinceDTO;
    $dto->setIdCommunity($id);
    $results = array_map(function($n){
        return [
            'id'=>$n->getId(),
            'name'=>$n->getName(),
            'id_community'=>$n->getIdCommunity()
        ];
    },$pdao->findAll(dto:$dto,page:ALL_PAGES));

    $value = !empty($results)? $results : [];
    $json = json_encode($value,flags:JSON_UNESCAPED_UNICODE);
}else if (preg_match("#/communities/[0-9]+/provinces/[0-9]+$#",$request_uri)){ // Una provincia de una communidad
    $idCommunity = intval($_GET['c']);
    $idProvince = intval($_GET['p']);
    if (is_null($cdao->findById(id:$idCommunity))){
        http_response_code(404);
        die;
    }

    $dto = new ProvinceDTO;
    $dto->setId($idProvince);
    $dto->setIdCommunity($idCommunity);
    $results = array_map(function($n){
        return [
            'id'=>$n->getId(),
            'name'=>$n->getName(),
            'id_community'=>$n->getIdCommunity()
        ];
    },$pdao->findAll(dto:$dto,page:ALL_PAGES));

    if (empty($results)){
        http_response_code(404);
        exit;
    }

    $value = !empty($results)? $results : [];
    $json = json_encode($value,flags:JSON_UNESCAPED_UNICODE);
}else if (preg_match("#/communities/[0-9]+/provinces/[0-9]+/towns$#",$request_uri)){
    $idCommunity = intval($_GET['c']);
    $idProvince = intval($_GET['p']);
    if (is_null($cdao->findById(id:$idCommunity))){
        http_response_code(404);
        die;
    }

    $dto = new ProvinceDTO;
    $dto->setId($idProvince);
    $dto->setIdCommunity($idCommunity);
    $results = array_map(function($n){
        return [
            'id'=>$n->getId(),
            'name'=>$n->getName(),
            'id_community'=>$n->getIdCommunity()
        ];
    },$pdao->findAll(dto:$dto,page:ALL_PAGES));

    if (empty($results)){
        http_response_code(404);
        exit;
    }

    $dto = new TownDTO;
    $dto->setIdProvince($idProvince);
    $results = array_map(function($n){
        return [
            'id'=>$n->getId(),
            'name'=>$n->getName(),
            'id_province'=>$n->getIdProvince()
        ];
    },$tdao->findAll(dto:$dto,page:ALL_PAGES));


    $value = !empty($results)? $results : [];
    $json = json_encode($value,flags:JSON_UNESCAPED_UNICODE);
}

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
echo $json;



?>