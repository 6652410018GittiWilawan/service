<?php

    class Kitti_018
    {
        private $connDB;
        
        public $id;
        public $taskName;
        public $taskDeail;
        public $taskStatus;
        public $createdAt;

        public $msg;

        public function __construct($connDB)
        {
            $this->connDB = $connDB;
        }

        public function getAllTask():mixed{
            $sql = "SELECT * FROM Kitti_018";

            $stmt = $this->connDB->prepare($sql);

            $stmt->execute();

            return $stmt;
        }

        
    }