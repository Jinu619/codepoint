<?php
include('connection.php');
$username= $_POST['name'];
$password= $_POST['password'];
if(preg_match("/[-\'\/\*]/",$username)){
    header("location:login.php?msg=Please Try ANother Way!!");
    exit;
}
$sel2 = "SELECT * FROM users WHERE username = '$username' AND password = password('$password') LIMIT 1 ";
// $ins = "INSERT INTO users(username,password) values ('codepoint',password('codepoint'))";
// $ret1 = mysqli_query($conn,$ins);
$ret2 = mysqli_query($conn,$sel2);
if(mysqli_num_rows($ret2)){
    $user = mysqli_fetch_object($ret2);
    session_start();
    $_SESSION['user_id'] = $user->id;
    $_SESSION['username'] = $user->username;
    header("location:index.php"); 
    exit;
}else{
    header("location:login.php?msg=Incorrect username and password!!");
    exit;
}
?>