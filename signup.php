<?php

session_start();
ini_set("display_errors", 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'server.php' ?>;
    <link rel="stylesheet" href="./css/./signup.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Signup to vote</title>
</head>

<body>
    <?php
    include 'server.php';
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $gender = mysqli_real_escape_string($con, $_POST['gender']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $voter_id = mysqli_real_escape_string($con, $_POST['voter_id']);
        $age = mysqli_real_escape_string($con, $_POST['age']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $contact = mysqli_real_escape_string($con, $_POST['contact']);
        $add_line1 = mysqli_real_escape_string($con, $_POST['add_line1']);
        $city = mysqli_real_escape_string($con, $_POST['city']);
        $zip = mysqli_real_escape_string($con, $_POST['zip']);
        $state = mysqli_real_escape_string($con, $_POST['state']);
        $country = mysqli_real_escape_string($con, $_POST['country']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $confpassword = mysqli_real_escape_string($con, $_POST['confpassword']);

        $pas = password_hash($password, PASSWORD_BCRYPT);
        $confpas = password_hash($confpassword, PASSWORD_BCRYPT);


        $emailquery = " select * from voterlist where email='$email' ";
        $query = mysqli_query($con, $emailquery);
                    
        $emailcount = mysqli_num_rows($query);
        echo "email = ".$emailcount;
        if ($emailcount > 0) {
            echo "email already exist";
        }
         else {
            if ($password === $confpassword) {

                echo (error_get_last());
                $insertquery = "insert into voterlist( name, gender, dob, voter_id, age, email, contact, add_line1, city, zip, state, country,password, confpassword) 
                    values( '$name', '$gender', '$dob', '$voter_id', '$age', '$email', '$contact', '$add_line1', '$city', '$zip', '$state', '$country', '$pas', '$confpas')";

                $iquery = mysqli_query($con, $insertquery);

                if ($iquery) {
                    echo (error_get_last());
    ?>
                    <script>
                        alert("Registration successful");
                        location.replace("index.html");
                    </script>
                <?php
                } else {
                ?>
                    <script>
                        alert("No connection due to some error");
                        echo(error_get_last());
                        // alert("connection to this database failed due to" .mysqli_connect_error());
                    </script>
    <?php
                }
            } else {
                echo "password are not matching";
            }
        }
    }
    ?>
    <h2>Register yourself to Vote</h2>
    <div class="container">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
            <form action="server.php" method="POST">
            <div class="inp">
                <label for="name">Name : </label>
                <input type="text" name="name" id="name" required placeholder="Enter your Name">
            </div>
            <div class="inp">
                <label for="name">Gender :
                    <input type="radio" name="gender" id="genderm" value="M" requierd>
                    <strong>Male</strong>
                    <input type="radio" name="gender" id="genderf" value="F">
                    <strong>Female</strong>
                </label>
            </div>
            <div class="inp">
                <label for="date">Date of Birth : </label>
                <input type="date" name="dob" min="1929-12-31" max="2021-12-31" required placeholder="Enter your DoB">
            </div>
            <div class="inp">
                <label for="id">Voter Id : </label>
                <input type="text" name="voter_id" required placeholder="Enter your Voter Id no">
            </div>
            <div class="inp">
                <label for="number">Age : </label>
                <input type="number" name="age" required min="18" max="99" min-width="10" required placeholder="Enter your Age">
            </div>
            <div class="inp">
                <label for="email">Email : </label>
                <input type="email" name="email" required placeholder="Enter your e-mail">
            </div>
            <div class="inp">
                <label for="tel">Contact : </label>
                <input type="tel" name="contact" id="contact" required pattern="[0-9]{4}[0-9]{3}[0-9]{3}" placeholder="1234-567-890" maxlength="10">
            </div>
            <div class="inp">
                <label><strong>Address</strong>:<br>
                    <label for="addressl1">Address Line 1:</label>
                    <input type="text" name="add_line1" required placeholder="House/Building No"><br>
                    <label>City : </label>
                    <input type="text" name="city" required placeholder="Enter your city">
                    <br>
                    <label>Zip/Postal Code : </label>
                    <input type="tel" name="zip" required maxlength="6" placeholder="Enter your Zip/Postal Code">
                    <br>
                    <label>State : </label>
                    <input type="text" name="state" required placeholder="Enter your state">
                </label>
                <div class="inp">
                    <label>Country : </label>
                    <input type="text" name="country" required placeholder="Enter your country">
                </div>

                <div class="inp" id="password">
                    <label for="name">Password : </label>
                    <input type="password" id="pass" name="password" minlength="8" maxlength="15" required placeholder="Enter Your Password">
                    <br>
                    Show Password : <input type="checkbox" id="showpass" onclick="myFunction()">

                </div>
                <div class="inp" id="confpassword">
                    <label for="name">Confirm Password : </label>
                    <input type="password" id="confpass" name="confpassword" minlength="8" maxlength="15" required placeholder="Confirm Your Password">
                </div>

                <div class="btn_bar">
                    <div class="btn">
                        <input type="submit" name="submit" onclick="ansValidation()" value="Submit Now">
                    </div>
                    <div class="btn">
                        <input type="reset" value="Reset Now">
                    </div>
                </div>
                <div class="center">
                </div>
</body>
<script>
    function myFunction() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</html>