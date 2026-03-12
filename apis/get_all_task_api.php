<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . "/../connectDB.php";
require_once __DIR__ . "/../models/Kitti_018.php";

$connDB = new ConnectDB();
$kiti_018 = new Kitti_018($connDB->getConnectDB());

$result = $kiti_018->getAllTask();

$dataInfo = array();

if ($result->rowCount() > 0) {
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $dataArray = array(
            "msgresult" => "1",
            "id" => $row["id"],
            "taskName" => $row["taskName"],
            "taskDetail" => $row["taskDetail"],
            "taskStatus" => $row["taskStatus"],
            "createAt" => $row["createAt"],
        );
        array_push($dataInfo, $dataArray);
    }
} else {
    $dataArray = array(
        "msgresult" => "0"
    );
    array_push($dataInfo, $dataArray);
}

echo json_encode($dataInfo);