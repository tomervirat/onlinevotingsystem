<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Contact Us</title>
</head>
<style>

    input[type=text],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=email],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }

    input[type=submit] {
        background-color: #04AA6D;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type=submit]:hover {
        background-color: #45a049;
    }

    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }
</style>

    <body>

        <?php
        include 'server.php';
        if (isset($_POST['submit'])) {
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $message = mysqli_real_escape_string($con, $_POST['message']);
    
                    $insertquery = "insert into contactus( name, email, message) 
                        values( '$name','$email','$message')";
    
                    $iquery = mysqli_query($con, $insertquery);
    
                    if ($iquery) {
        ?>
                        <script>
                            alert("Your request has been submitted");
                            location.replace("index.html");
                        </script>
                    <?php
                    } else {
                    ?>
                        <script>
                            alert("No connection");
                        </script>
        <?php
                    }
            }
    
        ?>
    
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">eVoting</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="index.html">Home</a>
                        <li><a href="#">Features</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Feedback</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <a class="navbar-brand" href="#">Admin</a>
                    </ul>
                </div>
            </div>
        </nav>


        <h3>Contact Form</h3>

        <div class="container">
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']) ?>" method="POST">
                <label for="fname">Name</label>
                <input type="text" id="name" name="name" placeholder="Your name.." required>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Your email" required>
                <label for="message">Subject</label>
                <textarea id="message" name="message" placeholder="Write something.." style="height:200px" required></textarea>

                <div class="btn">
                        <input type="submit" name="submit" value="Submit">
                    </div>
            </form>
        </div>

    </body>

</html>