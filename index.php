<?php
error_reporting(0);
session_start();
include("connection.php");
if (!$_SESSION) {
    header("location:login.php");
    exit;
}
$st_id = $_GET['st_id'];
$act = $_GET['act'];

if ($act) {
    if ($act == "edit") {
        //
        // echo $st_id;
        $sel6 = mysqli_query($conn, "SELECT * FROM students WHERE id='$st_id' LIMIT 1");
        $ret6 = mysqli_fetch_object($sel6);
        $name = $ret6->name;
        $dob = $ret6->dob;
        $gender = $ret6->gender;
        $phone = $ret6->phone;
        $email = $ret6->email;
        $country  = $ret6->country;
        $state  = $ret6->state;
        // exit;
    } else if ($act == "delete") {
        $del1 = "UPDATE students SET del =1 WHERE id = '$st_id' AND del=0 ";
        $retdel = mysqli_query($conn, $del1);
        header("location:index.php?msg=Sucessfully deleted");
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Home Page</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/pricing/">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="pricing.css" rel="stylesheet"> -->
</head>

<body>

    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
        <h5 class="my-0 mr-md-auto font-weight-normal"><?php echo $_SESSION['username'] ?></h5>
        <!-- <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="#">Features</a>
            <a class="p-2 text-dark" href="#">Enterprise</a>
            <a class="p-2 text-dark" href="#">Support</a>
            <a class="p-2 text-dark" href="#">Pricing</a>
        </nav> -->
        <a class="btn btn-outline-primary" href="logout.php">Log Out</a>
    </div>

    <div class="card m-5">
        <form action="addstudent_validate.php" method="POST">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $st_id ? $name : '' ?>" placeholder="Name">
                        <input type="hidden" id="st_id" name="st_id" value="<?php echo $st_id ? $st_id : '' ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>DOB</label>
                        <input type="date" name="dob" value="<?php echo $st_id ? $dob : '' ?>" class="form-control" id="dob" placeholder="Date of Birth">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="male">Gender :</label>
                        <label for="male">Male</label>
                        <input type="radio" id="male" name="gender" <?php if ($st_id) {
                                                                        if ($gender == "Male") {
                                                                            echo "checked";
                                                                        }
                                                                    } ?> value="male">

                        <label for="female">Female</label>
                        <input type="radio" id="female" name="gender" <?php if ($st_id) {
                                                                            if ($gender == "Female") {
                                                                                echo "checked";
                                                                            }
                                                                        } ?> value="female">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Mobile Number</label>
                        <input type="number" class="form-control" value="<?php echo $st_id ? $phone : '' ?>" name="phone" placeholder="Mobile Number">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" value="<?php echo $st_id ? $email : '' ?>" name="email" placeholder="Email">
                    </div>
                </div>
                <div class="col-6">
                    <label>Country</label>
                    <select class="form-control" id="country" name="country">
                        <option>--please select-- </option>
                        <?php
                        $sel3 = mysqli_query($conn, "SELECT * FROM country WHERE del=0 ");
                        while ($ret3 = mysqli_fetch_object($sel3)) {
                        ?>
                            <option value='<?php echo $ret3->id; ?>' <?php if ($st_id) {
                                                                            if ($country == $ret3->id) {
                                                                                echo "selected";
                                                                            }
                                                                        } ?>> <?php echo $ret3->country; ?> </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">

                <div class="col-6">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control" id='state' name="state">
                            <option>--please select-- </option>
                        </select>

                    </div>
                </div>
            </div>
            <!-- <div class="form-group">
                <label>State</label>
                <select class="form-control" name="state">
                    <option>--please select-- </option>
                </select>
            </div> -->

            <button type="submit" class="btn btn-primary">ADD</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Sl/no</th>
                    <th scope="col">Name</th>
                    <th scope="col">Dob</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sel4 = mysqli_query($conn, "SELECT students.*,state.state,country.country FROM students JOIN country ON country.id = students.country JOIN state ON state.id = students.state   WHERE students.del=0 ");
                $i = 0;
                while ($ret41 = mysqli_fetch_object($sel4)) {
                ?>
                    <tr>
                        <th scope="row"><?php echo ++$i; ?></th>
                        <td><?php echo $ret41->name; ?></td>
                        <td><?php echo $ret41->dob; ?></td>
                        <td><?php echo $ret41->gender; ?></td>
                        <td><?php echo $ret41->phone; ?></td>
                        <td><?php echo $ret41->email; ?></td>
                        <td><?php echo $ret41->country; ?></td>
                        <td><?php echo $ret41->state; ?></td>
                        <td>
                            <a class='btn btn-success' href="index.php?act=edit&st_id=<?php echo $ret41->id; ?>">EDIT</a>
                            <a class='btn btn-danger' href="index.php?act=delete&st_id=<?php echo $ret41->id; ?>">DELETE</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js">
        // < script src = "plugins/jquery/jquery.min.js" >
    </script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </script>

    <script>
        $("#country").change(function() {
            var cid = $('#country').val();
            $.ajax({
                type: 'POST',
                url: 'filterstate.php',
                data: {
                    cid: cid
                },
                success: function(data) {
                    $('#state').html(data);
                }
            });
        });
        $(document).ready(function() {
            var cid = $('#country').val();
            if (cid) {
                var state = <?php echo $state; ?>;
                $.ajax({
                    type: 'POST',
                    url: 'filterstate.php',
                    data: {
                        cid: cid
                    },
                    success: function(data) {
                        $('#state').html(data);
                        var selectElement = document.getElementById("state");
                        var options = selectElement.options;
                        for (var i = 0; i < options.length; i++) {
                            if (options[i].value == state) {
                                options[i].selected = true;
                                break;
                            }
                        }
                    }
                });
            }
        });
    </script>
</body>

</html>