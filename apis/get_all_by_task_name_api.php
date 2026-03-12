<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: POST, GET"); 
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

    require_once __DIR__ . "/../connectDB.php";
    require_once __DIR__ . "/../models/Kitti_018.php";

$connDB = new ConnectDB();
$kiti_018 = new Kitti_018($connDB->getConnectDB());

$taskName = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['taskName'])) {
    $taskName = trim($_GET['taskName']);
} else {
    $payload = json_decode(file_get_contents("php://input"));
    if (!empty($payload->taskName)) {
        $taskName = $payload->taskName;
    }
}

if (!empty($taskName)) {
    $result = $kitti_018->getTaskByTaskName($taskName);

    if ($result->rowCount() > 0) {
        $dataInfo = array();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
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
        echo json_encode($dataInfo);
    } else {
        echo json_encode(array(array("msgresult" => "0")));
    }
} else {
    echo json_encode(array(array("msgresult" => "0", "error" => "No taskName provided")));
}