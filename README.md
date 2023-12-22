# php-registration-login-forgottenpassword-app
 
A simple app developed using php, bootstrap and vanilla javascript, made with simple code for the sole purpose of learning. The app features register, login screens and functionality to change your password using a randomly generated token and email done with PHPMailer-master
___
### GOALS:
* to develope an app using the MVC pattern
* to learn how to use a POST HTTP method
* to learn how to connect and insert data into a database using PHP
* to learn how to use global and session variables
* to with public, private and static functions
* to do basic login use case with error handling and data validation
___
### SETTINGS
* PHP and APACHE installed using XAMPP V8.2.4
* Bootstrap 5.3
* MySQL Database, created using HeidiSQL and has the following structure:

table users:
+----+----------+--------------------------+------------------------+
| id | username | email                    | password               |
+----+----------+--------------------------+------------------------+
| 1  | user1    | user1@example.com        | hashed_password_1      |
| 2  | user2    | user2@example.com        | hashed_password_2      |
| ...| ...      | ...                      | ...                    |
+----+----------+--------------------------+------------------------+

Primary Key: id
Unique Key: email

table passwords_reset:
+----+---------+----------------------------------+---------------------+
| id | id_user | token                            | timestamp           |
+----+---------+----------------------------------+---------------------+
| 1  | 1       | 1a2b3c4d5e6f7g8h9i0j1k2l3m4n5o   | 2023-01-01 12:00:00 |
| 2  | 2       | a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5   | 2023-01-02 13:30:00 |
| ...| ...     | ...                              | ...                 |
+----+---------+----------------------------------+---------------------+

Primary Key: id
Foreign Key: id_user (References users(id))
___
### SETTING UP THE EMAIL:
the email service has been set up using a test gmail accout that i have created for the case.
the email address and password should be written in the file credentials.txt 
in order to get gmail to work with PHPMailer-master, a previous set up is needed on Gmail.

The set up is a 2 step process:
* Activate 2 factor authentication
* Create an App password

here some videos displaying the process:
English (Not the audio) -> https://www.youtube.com/watch?v=nuD6qNAurVM
Spanish-> https://youtu.be/ExqdE1IzpZ0?si=-zpMiiwEf4nG-WOZ

what have worked for me is just going into https://myaccount.google.com/ and then in the search bar typing 2 factor authentication and then searching for application password.
___

### STRUCTURE
The project follows a simple MVC pattern directory structure:

proyect
├── assets
│   ├── css
│   │   └── style.css
│   └── js // js files for validation and alerts 
│       ├── index.js
│       ├── login.js
│       └── register.js
├── controller
│   ├── createNewPasswordController.php
│   ├── loginController.php
│   ├── logoutController.php
│   ├── registerController.php
│   └── requestNewPasswordController.php
├── model
│   ├── db.php
│   ├── Login.php
│   └── User.php
├── service
│   ├── PHPMailer-master
│   └── resetEmailService.php
├── view
│   ├── createNewPassword.php
│   ├── loginView.php
│   ├── register.php
│   └── requestNewPassword.php
└── index.php


