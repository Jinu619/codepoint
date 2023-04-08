<?php
include('connection.php');
// print_r($_POST['cid']);
$country_id = $_POST['cid'];
$sql = "SELECT * FROM `state` WHERE `c_id` = $country_id";
$result = mysqli_query($conn, $sql);
$options = '<option value="">Select state</option>';
while ($row = mysqli_fetch_object($result)) {
    $options .= "<option value='$row->id'>$row->state</option>";
}

// Return options as JSON object
echo $options;
