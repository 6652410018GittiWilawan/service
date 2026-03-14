<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "../connectDB.php";
require_once "../models/kitti_018.php";

// สร้าง instance ของการติต่อฐานข้อมูล
$connDB = new ConnectDB();
$kitti_018 = new Kitti_018($connDB->getConnectDB());

// ร้างตัวแปรที่รับข้อมูลมาจากการเรียกใช้ api
$data = json_decode(file_get_contents("php://input"));
$result = $kitti_018->updateTaskByID($data->id, $data->taskName, $data->taskDetail, $data->taskStatus);
if ($result == true) {
  $dataInfo = array();
  $dataArray = array(
    "msgresult" => "1"
  );

  array_push($dataInfo, $dataArray);
  echo json_encode($dataInfo);
} else {
  $dataInfo = array();
  $dataArray = array(
    "msgresult" => "0"
  );

  array_push($dataInfo, $dataArray);
  echo json_encode($dataInfo);
}
