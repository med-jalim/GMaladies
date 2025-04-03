<?php
include "connect.php";

class User {

    private $conn;
    public function __construct(){
        $db=new Database();
        $this->conn=$db->connect();
    }

    public function login($email,$password){
        
        $stmt=$this->conn->prepare("select * from users  where email=:email");
        $stmt->execute([":email"=>$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC); 
        if ($user && password_verify($password,$user['password'])) {
            return json_encode($user);
        } else {
            return json_encode(["error"=>"email or password incorrect",'incorrect'=>true]);
        }

    }
    public function logout(){
        session_start();
        session_destroy();
        foreach ($_COOKIE as $key => $value) {
            setcookie($key, '', time() - 3600, "/");
        }
    }

    

    public function update_Email($email,$id) {
        $stmt=$this->conn->prepare("update users set email=:email where id=:id ");
        $stmt->execute([":email"=>$email,":id"=>$id]);
        if ($stmt) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["error" => "email update failed", 'incorrect' => true]);
        }

        
    }
    public function update_password($password,$id) {
        $stmt=$this->conn->prepare("update users set password=:password where id=:id ");
        $stmt->execute([":password"=>password_hash($password,PASSWORD_BCRYPT),":id"=>$id]);
        if ($stmt) {
            return json_encode(["success" => true]);
        } else {
            return json_encode(["error" => "password update failed", 'incorrect' => true]);
        }

        
    }

    public function add($email,$password,$role){
        
        $id=(int) $this->conn->query("select max(id)+1 as 'id' from users")->fetch(PDO::FETCH_ASSOC)['id'];

        $stmt=$this->conn->prepare("select * from users where email=:email");
        $stmt->execute([":email"=>$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC); 

        if(!$user){
            $stmt=$this->conn->prepare("insert into users(email,password,role) values (:email,:password,:role)");
            $stmt->execute([":email"=>$email,':password'=>password_hash($password,PASSWORD_BCRYPT),":role"=>$role]);
            return $id;
        }else{
            return json_encode(["error" => " add user failed", 'already' => true]);

        }
        
       

    }
}

$user=new User();
?>