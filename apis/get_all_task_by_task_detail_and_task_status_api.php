<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST"); 
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "../connectDB.php";
require_once "../kitti_018_class.php"; 

$database = new ConnectDB();
$db = $database->getConnectDB();

$kitti_018 = new Kitti_018($db);

$data = json_decode(file_get_contents("php://input"));

$dataInfo = array();

if (isset($data->taskDetail) && !empty($data->taskDetail)) {
    
    $result = $kitti_018->getTaskByTaskDetailAndTaskStatus($data->taskDetail);

    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $dataArray = array(
                "msgresult" => "1",
                "id" => $row['id'],
                "taskName" => $row['taskName'],
                "taskDetail" => $row['taskDetail'],
                "taskStatus" => $row['taskStatus'],
                "createAt" => $row['createAt'] 
            );
            array_push($dataInfo, $dataArray);
        }
    } else {
        $dataArray = array(
            "msgresult" => "0",
            "message" => "ไม่พบข้อมูลงานที่ตรงกับรายละเอียดและสถานะนี้"
        );
        array_push($dataInfo, $dataArray);
    }

} else {
    $dataArray = array(
        "msgresult" => "0",
        "message" => "กรุณาระบุ taskDetail ที่ต้องการค้นหา"
    );
    array_push($dataInfo, $dataArray);
}

echo json_encode($dataInfo);

?>