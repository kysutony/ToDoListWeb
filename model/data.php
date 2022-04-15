<?php
class User{
    private $conn;
    public $id,
           $account,
           $pass;
    public function __construct($db){
        $this->conn = $db;
    }
    public function read(){
        $query = "SELECT * FROM `user` ORDER BY id ASC";
        $statement = $this->conn->query($query);
        $statement->execute();
        return $statement;
    }
    public function show(){
        $query = "SELECT * FROM `user` WHERE id=? LIMIT 1";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->account = $row['account'];
        $this->pass = $row['pass'];
    }
    public function create(){
        $query = "INSERT INTO `user` SET account=:account, pass=:pass";
        $statement = $this->conn->prepare($query);
        $this->account= htmlspecialchars(strip_tags($this->account));
        $this->pass= htmlspecialchars(strip_tags($this->pass));
        $statement->bindParam(':account', $this->account);
        $statement->bindParam(':pass', $this->pass);
        if($statement->execute()){
            return true;
        }
        printf("Error %s.\n", $statement->error);
        return false;
    }
}
class Nhiemvu{
    private $conn;
   public $idaccount,
          $noidung;
    public function __construct($db){
            $this->conn = $db;
    }
    public function read(){
        $query = "SELECT * FROM `nhiemvu` ORDER BY idaccount ASC";
        $statement = $this->conn->query($query);
        $statement->execute();
        return $statement;
    }
    public function show(){
        $query = "SELECT * FROM `nhiemvu` WHERE idaccount=? LIMIT 1";
        $statement = $this->conn->prepare($query);
        $statement->bindParam(1, $this->id);
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        $this->idaccount = $row['idaccount'];
        $this->noidung = $row['noidung'];
    }



    // public function create($idaccount, $noidung){
    //     $user =  ""
    //     $query = "INSERT INTO `nhiemvu` VALUES idaccount:=idaccount,noidung:=noidung";
    //     $statement = $this->conn->prepare($query);
    //     $idaccount= htmlspecialchars(strip_tags($idaccount));
    //     $noidung= htmlspecialchars(strip_tags($noidung));
    //     $statement->bindParam(':idaccount', $idaccount);
    //     $statement->bindParam(':noidung', $noidung);
    //     if($statement->execute()){
    //         return true;
    //     }
    //     printf("Error %d.\n", $statement->error);
    //     return false;
    // }
}