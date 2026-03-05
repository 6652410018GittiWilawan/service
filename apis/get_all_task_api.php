<?php
header("Access-Cotrol-Allow-Origin: ");
header("Access-Control-Allow-Methods: GET");
header("Access-Cotrol-Allow-Headers: Content-Type");
header("Content-Tyoe: application/json; charset=UTF-8");

require_once "./connectDB.php";
require_once "./apis/get_all_task_api.php";

$connDB = new ConnectDB();
$kiti_018 = new Kitti_018($connDB->getConnectDB());

$result = $kiti_018->getAllTask();

if ($result->rowcount() > 0){
 $dataInfo = array();
 while($row = $result->fetch(PDO::FETCH_ASSOC)){
    $dataArray = array(
        "msgresult" => "1",
        "id" => $row["id"],
        "taskName" => $row["taskName"],
        "taskDetail" => $row["taskDetail"],
        "taskStatus" => $row["taskStatus"],
        "createAt" => $row["createAt"],
    );
    array_push($dataInfo,$dataArray);
 }

    }else{
    $dataInfo = array();
    $dataArray = array(
        "msgresult" => "0"
    );
    array_push($dataInfo, $dataArray);
    echo json_encode($dataInfo);
}