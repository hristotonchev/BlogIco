<?php
include("dbconfig.php");
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT * FROM admin WHERE username = ?";
$query = $DB_con->prepare($sql);
$result = $query->execute([$_POST['username']]);
$user = $query->fetchAll(PDO::FETCH_OBJ);
if(isset($user[0])){
    var_dump($user[0]->password);

        if (password_verify($_POST['password'], $user[0]->password)) {
            var_dump('Paris e homo');
        }else { var_dump('Paris e golqmo homo');
        }


    }


?>
<link href="../css/styles2.css" rel="stylesheet" type="text/css" />
<title>Login Page</title>
<h1>Login</h1>
<form method='post'>
    <div>
        <label for='username'>Username</label>
        <input class='box' type='text' id='username' name='username' placeholder="Enter your username" value='<?php if(isset($username)){ echo htmlspecialchars($username); } ?>' required>
    </div>
     <div>
        <label for='password'>Password</label>
        <input class='box' type='password' id='password' name='password' placeholder="Enter your password" required>
    </div>
     <div>
        <input class='button' type='submit' value='Login'/>
    </div>
</form>
