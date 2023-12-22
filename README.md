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

### FUNCTIONALITY:

Upon landing in index.php we find a  very simple view with a block of code that points you to the login/register view or if you are logged in already  displays your username and a link to logout.
Once we get to login.php we will be able to perform one of these operations:

* Register user
* Login user
* Reset password

#### USER REGISTRATION:



 
