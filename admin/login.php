<?php
include("dbconfig.php");
session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = test_input($_POST['username']);
        $password = test_input($_POST['password']);
    }

    function test_input($data){
            $data=trim($data);
            $data=stripcslashes($data);
            $data=htmlspecialchars($data);
            return $data;
        }

    if(isset($username) && $username == ''){
        $errorMessage = 'Empty username MF';
    }

    if(isset($password) && $password == ''){
        $errorMessage = 'Empty password MF';
    }

    if(isset($errorMessage)){
        echo '<p>'.$errorMessage.'</p>';

    }
    if(!empty($_POST) && !isset($errorMessage)){
        $sql = "SELECT * FROM admin WHERE username = ?";
        $query = $DB_con->prepare($sql);
        $result = $query->execute([$_POST['username']]);
        $user = $query->fetchAll(PDO::FETCH_OBJ);
            if (isset($user[0]) && password_verify($_POST['password'], $user[0]->password) && empty($_SESSION['login_user'])) {
                    $_SESSION['login_user'] = $username;

                $_SESSION['messages'] = ['login' => 'Welcome MF , you entered the Blog'];
                header('location:blogposts.php');
            } else {
            $_SESSION['messages'] = ['<p>'.'Wrong Username or Password'.'</p>'];
                if(!empty($_SESSION['messages']) && !isset($errorMessage)){
                    echo $_SESSION['messages'][0];
                }
            unset($_SESSION['messages'][0]);
        }
    }

include('templates/login_page.tpl.html');
