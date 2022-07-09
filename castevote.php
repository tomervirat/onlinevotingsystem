<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./images/./castevote.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
   
</head>

<body>

    <?php
    include 'server.php';
    if (isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $voter_id = mysqli_real_escape_string($con, $_POST['voter_id']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $dob = mysqli_real_escape_string($con, $_POST['dob']);
        $candidate = mysqli_real_escape_string($con, $_POST['candidate']);
        $pass = mysqli_real_escape_string($con, $_POST['pass']);

        $email_search = " select * from voterlist where email='$email'";
        $query = mysqli_query($con, $email_search);
        $email_count = mysqli_num_rows($query);
        if ($email_count) {
            $email_pass = mysqli_fetch_assoc($query);
            $vote_name = $email_pass['name'];
            if ($vote_name === $name) {
                $vote_voter_id = $email_pass['voter_id'];
                if ($vote_voter_id === $voter_id) {
                    $vote_dob = $email_pass['dob'];
                    if ($vote_dob === $dob) {
                        $vote_pass = $email_pass['confpassword'];
                        $pass_decode = password_verify($pass, $vote_pass);
                        if ($pass_decode) {
                            $myemail = mysqli_real_escape_string($con, $_POST['email']);
                            $myemailquery = " select * from vote where email='$myemail' ";
                            $myquery = mysqli_query($con, $myemailquery);

                            $myemailcount = mysqli_num_rows($myquery);

                            if ($myemailcount > 0) {
                            ?>
                                <script>
                                    alert("You have already voted");
                                </script>
                            <?php
                            } else {
                                $insertquery = "insert into evotes( email, voter_id, candidate_selected) values( '$email', '$voter_id', '$candidate')";
                                $iquery = mysqli_query($con, $insertquery);
                                if($iquery){
                            ?>
                                <script>
                                    alert("Voted successful");
                                    location.replace("index.html");
                                </script>
                            <?php
                                }
                            }
                        } else {
                            ?>
                            <script>
                                alert("Password does not match");
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script>
                            alert("DOB does not match");
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("Voter Id does not match");
                    </script>
                <?php
                }
            } else {
                ?>
                <script>
                    alert("Name does not match");
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                alert("Invalid email");
            </script>
    <?php
        }
    }
    ?>

    <div id="navbar">
        <ul>
            <li id="evoting"><a href="index.html">eVoting</a></li>
            <li id="admin"><a href="#">Admin</a></li>
        </ul>
    </div>
    <ul>
        <div class="logout" id="log"><a href="logout.php">Logout</a></div>
    </ul>
    <div class="container">
        <h2>Choose Your Candidate</h2>
        <h5>Prove Your Authencity of being correct voter.</h5>
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
            <img src="vote04.jpg" alt="Vote">
            <div class="inp">
                Voter's Name : <input type="text" name="name" required placeholder="Enter Your Full Name">
            </div>
            <div class="inp">
                Voter's Card No. : <input type="text" name="voter_id" required placeholder="Enter Your Voter Id">
            </div>
            <div class="inp">
                <label for="name">Voter's Registered email Id : </label>
                <input type="email" name="email" required placeholder="Enter Your Registered Email Id">
            </div>
            <div class="inp">
                Date of Birth : <input type="date" name="dob" required placeholder="Enter Your Date of Birth">
            </div>
            <div>
                <h3>Select Any of Them</h3>
            </div>
            <div>
                <p>Choose your candidate:</p>
                <input type="radio" name="candidate" id="c1" value="1" requierd>
                <strong>Candidate 1</strong>
                <br>
                <input type="radio" name="candidate" id="c2" value="2">
                <strong>Candidate 2</strong>
                <br>
                <input type="radio" name="candidate" id="c3" value="3">
                <strong>Candidate 3</strong>
                <br>
                <input type="radio" name="candidate" id="c4" value="4">
                <strong>Candidate 4</strong>
                <br>
            </div>
            <div class="inp" id="password">
                <label for="name">Password : </label>
                <input type="password" name="pass" id="password" placeholder="Enter Your Password">
            </div>
            Show Password : <input type="checkbox" id="showpass" onclick="myFunction()">
            <div class="inp" id="confpassword">
                <label for="name">Confirm Password : </label>
                <input type="password" name="confpass" id="confpassword" placeholder="Confirm Your Password">
            </div>
            <div class="btn_bar">
                <div class="btn">
                    <input type="submit" name="submit" onclick="ansValidation()" value="Submit Now">
                </div>
                <div class="btn">
                    <input type="reset" value="Reset Now">
                </div>
            </div>

        </form>
    </div>

</body>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

</html>

<?php
session_destroy();
?>
