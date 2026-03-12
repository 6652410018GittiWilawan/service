<?php

class Kitti_018
{
    private $connDB;
    
    public $id;
    public $taskName;
    public $taskDetail; 
    public $taskStatus;
    public $createdAt; 

    public function __construct($connDB)
    {
        $this->connDB = $connDB;
    }

    public function getAllTask() {
        $sql = "SELECT * FROM Kitti_018tb ORDER BY id DESC"; 
        $stmt = $this->connDB->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function getTaskByTaskName($taskName) {
        $sql = "SELECT * FROM Kitti_018tb WHERE taskName LIKE :taskName ORDER BY createdAt DESC";

        $stmt = $this->connDB->prepare($sql);
        
        $taskName = htmlspecialchars(strip_tags($taskName));
        $searchParam = "%{$taskName}%"; 

        $stmt->bindParam(":taskName", $searchParam);
        $stmt->execute();

        return $stmt;
    }
    public function getTaskByTaskDetailAndTaskStatus($taskDetail,) {

    $sql = "SELECT * FROM kitti_018tb WHERE taskDetail LIKE :taskDetail AND taskStatus = 1 ORDER BY id DESC";

    $stmt = $this->connDB->prepare($sql);

    $taskDetail = htmlspecialchars(strip_tags($taskDetail));
    $search = "%{$taskDetail}%";

    $stmt->bindParam(":taskDetail", $search);

    $stmt->execute();
    return $stmt;
    }

    public function addTask($taskName,$taskDetail,$taskStatus,$id){
        $sql = "INSERT INTO kitti_018tb (taskName,taskDetail,taskStatus)VALUES (:taskName,:taskDetail,:taskStatus)";
        
        $taskName = htmlspecialchars(strip_tags($taskName));
        $taskDetail = htmlspecialchars(strip_tags($taskDetail));
        $taskStatus = intval(htmlspecialchars(strip_tags($taskStatus)));
        $id = intval(htmlspecialchars(strip_tags($id)));
        $stmt = $this->connDB->prepare($sql);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":taskName", $taskName);
        $stmt->bindParam(":taskDetail", $taskDetail);
        $stmt->bindParam(":taskStatus", $taskStatus);
        
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateTaskByID($id,$taskName,$taskDetail,$taskStatus){
        $sql = "UPDATE kitti_018tb SET taskName = :taskName,taskDetail = :taskDetail ,taskStatus = :taskStatus WHERE id = :id";
         $taskName = htmlspecialchars(strip_tags($taskName));
        $taskDetail = htmlspecialchars(strip_tags($taskDetail));
        $taskStatus = intval(htmlspecialchars(strip_tags($taskStatus)));
        $id = intval(htmlspecialchars(strip_tags($id)));
        }
    public function deleteTaskByID(){
        $sql = "DELETE FROM kitti_018tb WHERE id = :id";
    }
}