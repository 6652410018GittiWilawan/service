<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

$conDB = new ConnectDB();
$kitti_018 = new Kitti_018($connDB->getConnectDB());

$data = json_decode(file_get_contents("php://input"));

$result = $kitti_018->getTaskByTaskName($data->taskName,$data->taskDetail,$data->taskStatus);

if($result == true){
    $dataInfo = array();
    $dataArray = array(
        "msgresult" => "1"
    );
    array_push($dataInfo,$dataArray);
    echo json_encode($dataInfo);
}else{
    $dataInfo =array();
    $dataArray =array(
        "magrsult" => "0"
    );
    array_push($dataInfo,$dataArray);
    echo json_encode($dataInfo);
}