<?php
include("db_connect.php");
// error_reporting(0);
$error = "";

if(isset($_POST['login']))
{
    $username = mysqli_real_escape_string($conn,trim($_POST['username']));
    $password = mysqli_real_escape_string($conn,$_POST['password']);
    
    $sql_users = "select * from users where username = '".$username."'and password = '".$password."'";
    $sql_admin = "select * from admin where username = '".$username."'and password = '".$password."'";
    $q_users = $conn->query($sql_users);
    $q_admin = $conn->query($sql_admin);

    if($q_users->num_rows==1)
    {
        $res = $q_users->fetch_assoc();
        $_SESSION['rainbow_user_id']=$res['user_id'];
        $_SESSION['rainbow_username']=$res['username'];
        $_SESSION['rainbow_mobile']=$res['mobile_number'];
        $_SESSION['rainbow_email']=$res['email_id'];
        $_SESSION['rainbow_address']=$res['address'];
        echo '<script type="text/javascript">window.location="customer_index.php"; </script>';
    }
    if($q_admin->num_rows==1)
    {
        $res = $q_admin->fetch_assoc();
        $_SESSION['rainbow_username']=$res['username'];
        $_SESSION['rainbow_email']=$res['email_id'];
        echo '<script type="text/javascript">window.location="admin_index.php"; </script>';
    }
    else
    {
        $error = 'Invalid Username or Password';
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <style>

        @import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;  
        }

        body {
            overflow: hidden;
        }

        section {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #161623;
            /* background: linear-gradient(to bottom, #f7f7fe, #dff1ff); */
            overflow: hidden;
        }

        section::before {
            content: '';
            position: absolute;
            height: 400px;
            width: 400px;
            background: linear-gradient(#43C6AC,#0052D4);
            border-radius: 50%;
            transform: translate(-160px,-100px);
        }
        
        section::after {
            content: '';
            position: absolute;
            height: 400px;
            width: 400px;
            background: linear-gradient(#1CB5E0,#000046);
            border-radius: 50%;
            transform: translate(160px,100px);
        }

        section .color {
            position: absolute;
            filter: blur(150px);
        }

        section .color:nth-child(1) {
            top: -250px;
            width: 770px;
            height: 770px;
            background: #1CB5E0;
            /* background: #bf4ad4; */
        }

        section .color:nth-child(2) {
            bottom: -150px;
            left: 100px;
            width: 700px;
            height: 600px;
            background: #0052D4;
            /* background: #ffa500; */
        }

        section .color:nth-child(3) {
            bottom: -70px;
            right: 100px;
            width: 650px;
            height: 600px;
            background: #000046;
            /* background: #2b67f3; */
        }

        .box {
            position: relative;
            z-index: 1000;
        }

        .container {
            margin: 50px 5px 50px 32px;
            position: relative;
            width: 430px;
            min-height: 400px;
            background: rgba(255,255,255,0.1);
            box-sizing: 0 25px 45px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            border-right: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input {
            width: 300px;
            height: 43px;
            border: 0;
            border-radius: 10px;
            padding: 10px;
            font-size: 18px;
            background: rgba(255,255,255,0.1);
            box-sizing: 0 25px 45px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            border-right: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            display: flex;
            justify-content: center;
            align-items: center;
            caret-color: rgb(255, 165, 0);
            /* caret-color:black; */
            color:white;
        }

        #login_button {
            border: 0;
            border-radius: 10px;
            padding: 12px 20px 12px;
            font-size: 15px;
            cursor: pointer;
            width: 300px;
        }

        #p1 {
            color: #fff;
            font-size: 15px;
            font-weight: 250;
            letter-spacing: 0.1px;
        }

        #p1 a {
            color: rgb(255, 165, 0);
            font-weight: 400;
        }

        #p1 a:hover {
            text-decoration:none;
        }

        #login_button:hover {
            transition:0.27s linear;
            /* background: black; */
            background: rgb(255, 165, 0);
            color: #fff;
        }

        #welcome {
            position: relative;
            /* color: black; */
            color: rgb(255, 165, 0);
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1.2px;
            margin-bottom: 5px;
            text-align: center;   
        }

        ::placeholder {
            color: #fff;
            padding-left: 8px;
            font-size: 17px;
            font-weight: 200;
            letter-spacing: 1px;
        }

        #anim1 {
            position: absolute;
            z-index: 2000;
            width: 100px;
            height: 100px;
            border-radius: 5px;
            background: rgba(255,255,255,0.1);
            box-sizing: 0 25px 45px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            border-right: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(23px);
            animation-name: example1;
            animation-duration: 8s;
            animation-iteration-count: infinite;
            transition-timing-function: linear;
        }

        #anim2 {
            position: absolute;
            z-index: 0;
            width: 80px;
            height: 80px;
            border-radius: 5px;
            background: rgba(255,255,255,0.1);
            box-sizing: 0 25px 45px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            border-right: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(23px);
            animation-name: example2;
            animation-duration: 7s;
            animation-iteration-count: infinite;
            transition-timing-function: linear;
        }

        #anim3 {
            position: absolute;
            z-index: 2000;
            width: 60px;
            height: 60px;
            border-radius: 5px;
            background: rgba(255,255,255,0.1);
            box-sizing: 0 25px 45px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            border-right: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(23px);
            animation-name: example3;
            animation-duration: 6s;
            animation-iteration-count: infinite;
            transition-timing-function: linear;
        }

        #anim_h {
            position: absolute;
            z-index: 1000;
            width: 1px;
            height: 45px;
            border-radius: 5px;
            background: rgba(255,255,255,0.1);
            box-sizing: 0 25px 45px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            border-right: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(23px);
            animation-name: example_h;
            animation-duration: 7s;
            animation-iteration-count: infinite;
            transition-timing-function: linear;
        }

        @keyframes example1 {
            0%   { left:-40px; top:200px;}
            50%  { left:-40px; top:140px;}
            100% { left:-40px; top:200px;}
        }

        @keyframes example2 {
            0%   { left:425px; top:0px;}
            50%  { left:425px; top:40px;}
            100% { left:425px; top:0px;}
        }

        @keyframes example3 {
            0%   { left:440px; top:350px;}
            50%  { left:440px; top:300px;}
            100% { left:440px; top:350px;}
        }

        @keyframes example_h {
            0%   { left:130px; top:20px; }
            50%  { left:294px; top:20px; }
            100%  { left:130px; top:20px; }
        }

        @media screen and (max-width: 600px) {
            @keyframes example2 {
                0%   { left:425px; top:0px;}
                50%  { left:425px; top:40px;}
                100% { left:425px; top:0px;}
            }

            @keyframes example3 {
                0%   { left:440px; top:350px;}
                50%  { left:440px; top:300px;}
                100% { left:440px; top:350px;}
            }
        }


        @media screen and (max-width: 575px) {

            @keyframes example1 {
                0%   { left:-25px; top:200px;}
                50%  { left:-25px; top:130px;}
                100% { left:-25px; top:200px;}
            }

            @keyframes example2 {
                0%   { left:412px; top:0px;}
                50%  { left:412px; top:30px;}
                100% { left:412px; top:0px;}
            }

            @keyframes example3 {
                0%   { left:425px; top:360px;}
                50%  { left:425px; top:300px;}
                100% { left:425px; top:360px;}
            }
        }

        @media screen and (max-width: 530px) {
            #anim1 , #anim2 , #anim3 {
                animation-name: none;
                z-index: 2000;
                width: 100%;
                height: 10px;
                bottom: 0;
            }

            .container {
                margin: 0;
            }
        }

        @media screen and (max-width: 440px) {
            #anim1 , #anim2 , #anim3 {
                animation-name: none;
                z-index: 2000;
                width: 100%;
                height: 10px;
                bottom: 0;
            }
            
            .container {
                margin: 0;
                width: auto;
                padding: 0 30px;
            }

            input , #login_button {
                width: 270px;
            }

            @keyframes example_h {
                0%   { left:85px; top:20px; }
                50%  { left:240px; top:20px; }
                100%  { left:85px; top:20px; }
            }
        }

        @media screen and (max-width: 335px) {
            .container {
                margin: 0;
                width: 280px;
                padding: 0 10px;
            }

            input , #login_button {
                width: 250px;
            }

            p {
                font-size: 13px;
            }

            h3 {
                margin-bottom: 11px;
            }

            @keyframes example_h {
                0%   { left:55px; top:20px; }
                50%  { left:210px; top:20px; }
                100%  { left:55px; top:20px; }
            }
        }

        .text-danger {
            color: #c22321;
        }

        article {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #error {
            color:white;
            font-size: 17px;
            padding:10px;
            border-radius:5px;
            background:#c22321;
            position: absolute; 
            z-index:1000; 
            top:15px;
            animation: anim_error 0.3s ease 1;
        }

        @keyframes anim_error {
            0% {top:0;}
            100% {top:15px;}
        }

    #close {
        color:black;
        padding: 0 5px;
        text-decoration:none;
        font-size:20px;
    }

    </style>

    <body>

    <article>
        <?php	
            if($error!='')
            {									
                echo '<p id="error">'.$error.' 
                <a href="javascript:void(0)" id="close" onclick="closeNav()" >&times;</a>
                </p>';
            }
        ?>

        <script>
            function closeNav(){
                document.getElementById("error").style.display = "none";
            }
        </script>
    </article>

        <section>
            <div class="color"></div>
            <div class="color"></div>
            <div class="color"></div>

            <div class="box">
                <div id="anim1"></div>
                <div id="anim2"></div>
                <div id="anim3"></div>

                <div class="container">
                    <form enctype="multipart/form-data" method="POST">
                        <div id="anim_h"></div>
                        <h3 id="welcome">WELCOME</h3>
                        <br>
                        <input type="text" id="username" placeholder="username" name="username" required>
                        <br>
                        <input type="password" id="password" placeholder="password" name="password" required>
                        <br>
                        <button id="login_button" type="submit" name="login">Login</button>
                        <br><br>
                    <p id="p1">Forget password ? <a href="change_password.php">Click Here</a> </p>
                    <!-- <br> -->
                    <p id="p1">Don't have an account ? <a href="add_account.php">Sign up</a> </p> 
                    </form>
                </div>
            </div>
        </section>

    </body>

</html>