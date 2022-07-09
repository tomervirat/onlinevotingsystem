<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/./login.css">
    <title>Signin to Vote</title>
</head>


<body>
    
    <?php

include 'server.php';

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $email_search = " select * from voterlist where email='$email'";
  $query = mysqli_query($con, $email_search);

  $email_count = mysqli_num_rows($query);

  if($email_count){
    $email_pass = mysqli_fetch_assoc($query);

    $vote_pass = $email_pass['confpassword'];

    $pass_decode = password_verify($password, $vote_pass);

    if($pass_decode){
      echo "login successful";
      $_SESSION['email'] = $email;
      ?>
      <script>
        location.replace("castevote.php");
        </script>
      <?php
    }else{
      echo "login failed, password incorrect";
    }
  }else{
    echo "Invalid email";
  }
}

?>


    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <h2>Signin to Vote</h2>
            </div>

            <!-- Login Form -->
            <form action="" method="POST">
                <input type="email" id="login" class="fadeIn second" name="email" placeholder="email">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" name="submit" class="fadeIn fourth" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="#">Forgot Password?</a>
            </div>

        </div>
    </div>
</body>

</html>

<?php
session_destroy();
?>