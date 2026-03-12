<?php
class ConnectDB{
    private $connDB;

    private $host = "82.25.121.181";
    private $username = "u231190616_dti268";
    private $password = "Dti028074500";
    private $dbname = "u231198616_dti269db";

    public function getConnectDB(){
        $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4"; 

        try{
            $this->connDB = new PDO($dsn, $this->username, $this->password);
            $this->connDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit; 
        }
        return $this->connDB;
    }
}