<?php
class Database{
    private $host = "localhost";
    private $dbname = "gmaladies";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct()
    {
        try{

            $this->conn=new PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->username,$this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die( json_encode(["error"=>$e->getMessage()]) );
        }
    }

    public function connect(){
        return $this->conn;
    }
}

?>