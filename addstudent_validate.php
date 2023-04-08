<?php
include('connection.php');
$name = $_POST['name'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$country = $_POST['country'];
$state = $_POST['state'];
$st_id = $_POST['st_id'];

if (!$name || !$dob || !$gender || !$phone || !$country || !$state) {
    header("location:index.php?msg=please fill the all the fields");
    // print_r($_POST);
    exit;
}

if ($st_id) {
    $up1 = "UPDATE students SET name='$name',dob='$dob',gender='$gender',phone='$phone',email='$email',country='$country',state='$state' WHERE id = '$st_id' ";
    $ret2 = mysqli_query($conn, $up1);
    if (!$up1) {
        header("location:index.php?msg=Updation Failed");
        exit;
    }
    header("location:index.php?msg=Sucessfully Updated");
    exit;
} else {
    $ins1 = "INSERT INTO students(name,dob,gender,phone,email,country,state) values('$name', '$dob', '$gender', '$phone', '$email', '$country', '$state')";
    $ret1 = mysqli_query($conn, $ins1);
    if (!$ret1) {
        header("location:index.php?msg=Insertion Failed");
        exit;
    }
    header("location:index.php?msg=Sucessfully Added");
    exit;
}
