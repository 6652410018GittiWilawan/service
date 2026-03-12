<?php
header("Access-Control-Allow-Origin: *"); 
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "./../service/connectDB.php";
require_once "./../service/models/Kitti_018.php";

$connDB = new ConnectDB();
$kitti_018 = new Kitti_018($connDB->getConnectDB());

$data = json_decode(file_get_contents("php://input"));

$result = $kitti_018->updateTaskByID(
    $data->id,
    $data->taskName,
    $data->taskDetail,
    $data->taskStatus,
);