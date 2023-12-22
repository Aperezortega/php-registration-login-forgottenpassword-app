<?php
require_once '../model/db.php';
class User{

private $username;
private $email;
private $password;

public function __construct($username, $email, $password){
    $this->username = $username;
    $this->email = $email;
    $this->password = password_hash($password,PASSWORD_DEFAULT);

    global $conn;
  
    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $this->username, $this->email, $this->password);

    $stmt->execute();
    }

    public static function isEmailFree($email){
        global $conn;
       
        $sql = "SELECT email FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$email);
        
        $stmt->execute();
        $result = $stmt->get_result();
        $rowCount = $result->num_rows;
        return $rowCount == 0;
    } 

    public static function insertResetTokenIntoDb($email, $token){
        global $conn;
        $sql = "INSERT INTO passwords_reset (id_user, token) VALUES ((SELECT id FROM users WHERE email = ?), ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ss',$email, $token);
        $stmt->execute();

    }

    public static function isTokenValid($token){
        global $conn;
        $sql = "SELECT id_user FROM passwords_reset WHERE token = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s',$token);
        $stmt->execute();
        $result = $stmt->get_result();
        $id_user = $result->fetch_assoc()['id_user'];
        $_SESSION['id_user'] = $id_user;
        $rowCount = $result->num_rows;
        return $rowCount == 1;
    }
    
    public static function updatePassword($id_user, $password){
        global $conn;
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si',password_hash($password,PASSWORD_DEFAULT), $id_user);
        $stmt->execute();
    }
}
?>