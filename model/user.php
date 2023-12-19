<?php
require_once '../model/db.php';
class User{

private $username;
private $email;
private $password;

public function __construct($username,$email,$password){
    $this->username = $username;
    $this->email = $email;
    $this->password = password_hash($password,PASSWORD_DEFAULT);

    $global $conn;
    $sql = "INSERT INTO users (username,email,password) VALUES (:username,:email,:password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username',$this->username, PDO::PARAM_STR);
    $stmt->bindParam(':email',$this->email, PDO::PARAM_STR);
    $stmt->bindParam(':password',$this->password, PDO::PARAM_STR);

    $stmt->execute();
    $conn = null;

    }
}
?>