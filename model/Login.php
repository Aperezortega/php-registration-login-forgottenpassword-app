<?php
require_once '../model/db.php';
Class Login{

    private $username;
    private $password;

    public function __construct($username, $password){
        $this->username = $username;
        $this->password = $password;
    }
    public function login(){
        $username = $this->username;
        $password = $this->password;
        global $conn;
        $sql = "SELECT username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$username);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $hash = $row['password'];
            if($this->verifyPassword($password, $hash)){
            return true;
    
             }else{
            return false;
    
            }
        }
}

    private function verifyPassword($password, $hash){
        return password_verify($password, $hash);
    }
}
?>