# php-registration-login-forgottenpassword-app

A simple app developed using PHP, Bootstrap, and vanilla JavaScript, made with simple code for the sole purpose of learning. The app features register, login screens, and functionality to change your password using a randomly generated token and email done with PHPMailer-master.

---

### GOALS:

- Develop an app using the MVC pattern.
- Learn how to use a POST HTTP method.
- Learn how to connect and insert data into a database using PHP.
- Learn how to use global and session variables.
- Work with public, private, and static functions.
- Implement a basic login use case with error handling and data validation.

---

### SETTINGS:

- PHP and Apache installed using XAMPP V8.2.4.
- Bootstrap 5.3.
- MySQL Database, created using HeidiSQL with the following structure:

 **Table: users**
  | id | username | email               | password             |
  | -- | -------- | ------------------- | -------------------- |
  | 1  | user1    | user1@example.com   | hashed_password_1    |
  | 2  | user2    | user2@example.com   | hashed_password_2    |
  | ...| ...      | ...                 | ...                  |

  Primary Key: id
  Unique Key: email
  
___
  **Table: passwords_reset**
  | id | id_user | token                         | timestamp           |
  | -- | ------- | ----------------------------- | -------------------- |
  | 1  | 1       | 1a2b3c4d5e6f7g8h9i0j1k2l3m4n5o | 2023-01-01 12:00:00 |
  | 2  | 2       | a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5 | 2023-01-02 13:30:00 |
  | ...| ...     | ...                           | ...                  |

  Primary Key: id
  Foreign Key: id_user (References users(id))

---

### SETTING UP THE EMAIL:

The email service has been set up using a test Gmail account that I have created for the case. The email address and password should be written in the file credentials.txt. In order to get Gmail to work with PHPMailer-master, a previous setup is needed on Gmail.

The setup is a 2-step process:

1. Activate 2-factor authentication.
2. Create an App password.

Here are some videos displaying the process:
- English (Not the audio) -> [YouTube Link](https://www.youtube.com/watch?v=nuD6qNAurVM)
- Spanish -> [YouTube Link](https://youtu.be/ExqdE1IzpZ0?si=-zpMiiwEf4nG-WOZ)

What has worked for me is just going into [https://myaccount.google.com/](https://myaccount.google.com/) and then in the search bar typing 2-factor authentication and then searching for application password.

---

### STRUCTURE:

The project follows a simple MVC pattern directory structure:
~~~
Proyecto
|-- assets
|   |-- css
|   |   `-- style.css
|   `-- js
|       |-- index.js
|       |-- login.js
|       `-- register.js
|-- controller
|   |-- createNewPasswordController.php
|   |-- loginController.php
|   |-- logoutController.php
|   |-- registerController.php
|   `-- requestNewPasswordController.php
|-- model
|   |-- db.php
|   |-- Login.php
|   `-- User.php
|-- service
|   |-- PHPMailer-master
|   `-- resetEmailService.php
|-- view
|   |-- createNewPassword.php
|   |-- loginView.php
|   |-- register.php
|   `-- requestNewPassword.php
`-- index.php

~~~
### MODEL:

#### **db.php:**
A standard database connection using mysqli.  Potentially  the database access information could be written on a text file and extracted as done later with the email credentials using file(). This db.php is then required by Login.php and User.php  
With the idea to simplify things and being this such small project, the variable $conn is used globally and not passed as a parameter into the diferent methods and functions
~~~
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "php_login";
$conn;

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
$conn->set_charset("utf8");
~~~

#### **Login.php:**
A class used to login into the website. It has 2 attributes ($username,$password), and 2 methods, a public one called login() and a private  called verifyPassword, which is called also when loggin in.  
The method login() does a SQL query and gets the associated password to $this->username  and then it is passed as a parameter for verifyPassword. verifyPassword compares the user associated password from the database and the password introduced by the person when loggin in.
Apart of this, only 2 things to point out:
* queries are prepared to avoid sql injections.
* passwords are hashed

Code here:
~~~
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
        $sql = "SELECT password FROM users WHERE username = ?"; 
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
~~~

#### **User.php:**
The design idea behind this class is that when a new aobject of the class User is created, a new user is inserted into the database, thus the constructor includes all the SQL. This class also  have 4 other functions related to the User but being **static**  they do not need an  object User to be created. If it did it would be a problem, since the way it is design, creating a new User would insert a new user in the database.
these functions are:
* isEmailFree($email)
* insertResetTokenIntoDb($email,$token)
* isTokenValid($token)
* updatePassword($id_user,$password)

Whole Class code here:
~~~
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
~~~

### FUNCTIONALITY:

Upon landing in index.php we find a  very simple view with a block of code that points you to the login/register view or if you are logged in already  displays your username and a link to logout.
Once we get to login.php we will be able to perform one of these operations:

* USER REGISTRATION
* USER LOGIN
* PASSWORD RESET

#### USER REGISTRATION:
The registration process is managed using the following files:
* register.php
* register.js
* registerController

 The process starts in register.php with a form in which we are asked to introduce username, email, password and password confirmation. When  the button submit is pressed, before sending the data to the controller, javascript will validate the fields password and confirmPassword and if they are the same, then the form will be sended to the controller. 
The javascript code responsible for this:
~~~
form.addEventListener('submit', function(event) {
        event.preventDefault(); // this stops the POST submit
        if(password.value===''||confirmPassword.value===''){
            alert('Password cannot be empty');
    }else if(password.value!==confirmPassword.value){
            alert('Password does not match');
    }else{
        form.submit(); // once the fields are validated then the form is sent to the controller
    }
    });
~~~
After this the controller receives the data, checks if the username is free and if so, insert a new username into the database by creating a new objectj of the class User (we have seen User.php in the previous point. Finally if registration is successful the controller redirects you index.php or to register.php if the register has failed. 
In case of failure the redirection will include URL parametrers register=failed & error=emailtaken. This parameters will trigger an alert with the message 'Registration Failed. Email already registered'

 The controller code as follows:
~~~
<?php
require_once '../model/User.php';
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(User::isEmailFree($email)){
        $user = new User($username,$email,$password);
        header('Location: ../index.php?register=success');
        exit();
    }else{
        header('Location: ../view/register.php?register=failed&error=emailTaken');
        exit();
    }   
}
?>
~~~
With this the registration process has finished 
___
#### USER LOG IN:
The registration process is managed using the following files:
* loginView.php
* loginController.php
* login.js
* Login.php

 Same as before the process starts with the login view which we have a form that it is submitted to the controller. Once again the view is supported by a javascript file used to display informative alerts that are triggered by url parameters sent by the controller. The login is executed using a Class Login (which we have seen already) and if successful it will start username as a session variable which will be displayed later on on index.php. If login failed it will redirect us to the login screen which will have an alert stating that login failed

The controller code as follow:
~~~
<?php
require_once '../model/login.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $login = new Login($username, $password);
    
    if($login->login()){
        session_start();
        $_SESSION['username'] = $username;
        header('Location: ../index.php?login=success');
    }else{
        header('Location: ../view/loginView.php?login=failed');
    }
}
?> 
~~~

#### PASSWORD RESET 
The first thing to do here is to download [PHPMailer](https://github.com/PHPMailer/PHPMailer) library.

After this, lets set the email service. In this case, the email service has only 1 functionality which is to send a password reset link consisting of an url with  a token parameter, for this reason the code for the setting up and sending the email is all in one single file.
___


#### The service consists of a function sendResetEmail($email, $token) being $email THE EMAIL OF THE REGISTERED USER WANTING TO CHANGE HIS/HER PASSWORD Not the email address that sends the password reset link!!

___

Code for resetEmailService.php
~~~ 
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
function sendResetEmail($email, $token){
    $credentialsFile = '../credentials.txt';
    $credentialsData = file($credentialsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    

    if(count($credentialsData) == 2){
        $emailCredential = $credentialsData[0];
        $emailPasswordCredential = $credentialsData[1];
        $mail = new PHPMailer(true);
        try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $emailCredential;
        $mail-> Password = $emailPasswordCredential;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $subject = 'Reset password';
        $message = 'Click on the link to reset your password: http://localhost/view/createNewPassword.php?token='.$token;
        
        $mail->setFrom($emailCredential, 'PHP Login System');
        $mail->addAddress($email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        }catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        

    }else{
        echo 'credentials not found';
    }

}
?>
~~~
Back to password reset. It consists of a 2 step process:
* Requesting password reset link.
* Creating a new password.
 
For the first step  we  have a form on requestNewPassword.php with an email input which is then posted to requestNewPasswordController.php. On the controller the email validated using the function User::isEmailFree($email) if true, it means the email is not registered and the process stops here. We get a redirection to the previous view with an error alert.

If the email is not free, that means it is registered in the database and we can move forward with the process.  This email is then being send the url link with the token, and the token is stored in the database for future use.

~~~
<?php
require_once '../service/resetEmailService.php';
require_once '../model/User.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(8));
    if(User::isEmailFree($email)){
        header('Location: ../view/requestNewPassword.php?resetEmail=error');
        exit();
    }
    sendResetEmail($email, $token);
    User::insertResetTokenIntoDb($email, $token);
    header('Location: ../index.php?resetEmail=success');
 
}
?>
~~~
___

For the Last step, 
