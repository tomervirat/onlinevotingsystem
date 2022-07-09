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
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="charts_script.js"></script>
    <script src="charts_script2.js"></script>
    <title>Voting Results</title>
</head>
<style>
    /* html {
    background-image:  url("vote_result.jpg"); 
    width: auto;
    height: 100%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    display: block;
    opacity: 2;
} */
    body {
        background-image: url("vote_result.jpg");
        width: auto;
        height: 100vh;
        background-repeat: repeat;
        background-position: center;
        background-size: cover;
        display: block;
        opacity: 1;
    }

    .container {
        /* border: 1px dashed green; */
        width: 57%;
        height: 50%;
        text-align: center;
    }

    #navbar {
        /* border: 2px solid green; */
        border-radius: 50px;
        height: 40px;
        width: 100%;
        margin: 2px 4px;
        padding: 4px 4px;
        /* display: flex; */
    }

    #navbar ul {
        display: flex;
        font-family: 'Roboto Condensed', 'serif';
    }

    #navbar ul li {
        list-style: none;
        font-size: 1.3rem;
    }

    #navbar ul li a {
        color: #ee0606;
        display: block;
        padding: 4px 30px;
        border-radius: 30px;
        text-decoration: none;
    }

    #navbar ul li a:hover {
        color: black;
        background-color: white;
    }

    #evoting {
        font-weight: bolder;
    }

    #admin {
        display: block;
        font-weight: bolder;
        position: absolute;
        /* float: right; */
        margin-left: 86%;
        /* border: 2px solid blue; */
        border-radius: 20px;
        /* background-color: rgb(122, 247, 252); */
    }

    h1 {
        border-radius: 50px;
        margin: 2rem;
        /* width: 95%; */
        padding: 5px 10px;
        text-shadow: 2px 2px 5px rgb(212, 233, 118);
        text-align: center;
        color: crimson;
        animation-name: example;
        animation-duration: 4s;
        animation-iteration-count: infinite;
    }

    @keyframes example {
        0% {
            background-color: rgb(212, 92, 92);
            left: 0px;
            top: 0px;
        }

        25% {
            background-color: yellow;
            left: 400px;
            top: 0px;
        }

        50% {
            background-color: blue;
            left: 400px;
            top: 0px;
        }

        75% {
            background-color: rgb(97, 245, 97);
            left: 0px;
            top: 0px;
        }

        100% {
            background-color: rgb(79, 214, 214);
            left: 0px;
            top: 0px;
        }
    }

    h2 {
        color: #02f1e6;
    }

    h3 {
        color: #02f126;
    }

    .resultitem {
        color: palegoldenrod;
        font-size: larger;
    }

    footer {
        /* border: 2px dotted greenyellow; */
        margin: 10px 5px;
        position: relative;
        margin-top: 18rem;
        display: flex;
        flex-direction: column;
        text-align: center;
        align-items: center;
        color: antiquewhite
    }

    footer h4 a {
        color: rgb(167, 0, 0);
        display: block;
        padding: 4px 30px;
        border-radius: 20px;
        text-decoration: none;
    }

    footer h4 a:hover {
        color: black;
        background-color: white;
    }
</style>

<body>

    <?php
    include 'server.php';

    $sql1 = "SELECT candidate_selected , COUNT(*) AS c1 FROM `evotes` WHERE candidate_selected = '1'";
    $sql2 = "SELECT candidate_selected , COUNT(*) AS c2 FROM `evotes` WHERE candidate_selected = '2'";
    $sql3 = "SELECT candidate_selected , COUNT(*) AS c3 FROM `evotes` WHERE candidate_selected = '3'";
    $sql4 = "SELECT candidate_selected , COUNT(*) AS c4 FROM `evotes` WHERE candidate_selected = '4'";

    $query1 = mysqli_query($con, $sql1);
    $query2 = mysqli_query($con, $sql2);
    $query3 = mysqli_query($con, $sql3);
    $query4 = mysqli_query($con, $sql4);

    $result1 = mysqli_fetch_object($query1);
    $result2 = mysqli_fetch_object($query2);
    $result3 = mysqli_fetch_object($query3);
    $result4 = mysqli_fetch_object($query4);


    $candidate_name = array("Candidate 1", "Candidate 2", "Candidate 3", "Candidate 4");
    $candidate_vote = array($result1, $result2, $result4, $result4);


    $m = (max($result1->c1, $result2->c2, $result3->c3, $result4->c4));
    $candidateNo;
    if ($result1->c1 == $m)
        $candidateNo = 1;
    elseif ($result2->c2 == $m)
        $candidateNo = 2;
    elseif ($result3->c3 == $m)
        $candidateNo = 3;
    else
        $candidateNo = 4;
    ?>

    <div id="navbar">
        <ul>
            <li id="evoting"><a href="index.html">eVoting</a></li>
            <li><a href="#">Features</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Feedback</a></li>
            <li><a href="signup.php" target="_blank">SignUp</a></li>
            <li id="admin"><a href="#">Admin</a></li>
        </ul>
    </div>
    <div class="container">
        <h1 class="page-header">Polling Results </h1>
        <br>
        <h2>Candidate <?php echo $candidateNo; ?> wins...</h2><br>
        <div class="box">
            <h3>Thanks to the voters who all voted.</h3>
            <ul class="resultitem" style="list-style-type:none;">
                <li>Candidate 1 got <?php echo $result1->c1; ?> votes.</li>
                <li>Candidate 2 got <?php echo $result2->c2; ?> votes.</li>
                <li>Candidate 3 got <?php echo $result3->c3; ?> votes.</li>
                <li>Candidate 4 got <?php echo $result4->c4; ?> votes.</li>
            </ul>
        </div>
    </div>
    <footer>
        <h5>Safe . Reliable . Secure . Fast </h3>
            <h6> <a href="contact.php">Contact Us</a></h6>
            <h5>Copyright &copy; www.voteonline.com. All rights reserved!</h6>
    </footer>


</body>


</html>