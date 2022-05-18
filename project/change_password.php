<?php
include("db_connect.php");
// error_reporting(0);
$error = "";
if(isset($_POST['change']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email_id = mysqli_real_escape_string($conn,$_POST['email_id']);
    $mobile = mysqli_real_escape_string($conn,$_POST['mobile']);
    $newpassword = mysqli_real_escape_string($conn,$_POST['newpassword']);
    $confirmpassword = mysqli_real_escape_string($conn,$_POST['confirmpassword']);

    $sql = "select * from users where username= '".$username."' and email_id='".$email_id."' and mobile_number = '".$mobile."'";
    $q = $conn->query($sql);
    
    if($q->num_rows>0 && $newpassword==$confirmpassword)
    {
        $sql = "update users set password = '".$newpassword."' WHERE username = '".$username."'";
        $r = $conn->query($sql);
        echo '<script type="text/javascript">window.location="login.php"; </script>';
    }
    else
    {
        $error = 'Invalid Details';
    }
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Change Password</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            top: -350px;
            width: 770px;
            height: 770px;
            background: #1CB5E0;
        }

        section .color:nth-child(2) {
            bottom: -150px;
            left: 100px;
            width: 700px;
            height: 500px;
            background: #0052D4;
        }

        section .color:nth-child(3) {
            bottom: 50px;
            right: 100px;
            width: 650px;
            height: 500px;
            background: #000046;
        }

        .box {
            position: relative;
            z-index: 1000;
        }

        .container {
            margin: 50px 5px 50px 32px;
            position: relative;
            width: 430px;
            min-height: 535px;
            background: rgba(255,255,255,0.1);
            box-sizing: 0 25px 45px rgba(0,0,0,0.1);
            border: 1px solid rgba(255,255,255,0.5);
            border-right: 1px solid rgba(255,255,255,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(23px);
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
            backdrop-filter: blur(23px);
            display: flex;
            justify-content: center;
            align-items: center;
            caret-color: rgb(255, 165, 0);
            color:white;
        }

        button {
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
        }

        #p1 a {
            color: rgb(255, 165, 0);
            font-weight: 400;
        }

        #p1 a:hover {
            text-decoration:none;
        }

        button:hover {
            transition:0.27s linear;
            background: rgb(255, 165, 0);
            color: #fff;
        }

        #head {
            position: relative;
            color:white;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-align: center;   
        }

        ::placeholder {
            color: #fff;
            padding-left: 8px;
            font-size: 17px;
            font-weight: 200;
            letter-spacing: 1px;
        }

        @media screen and (max-width: 530px) {
            .container {
                margin: 0;
            }
        }

        @media screen and (max-width: 440px) {
            .container {
                margin: 0;
                width: auto;
                padding: 0 30px;
            }

            input , button {
                width: 270px;
            }
        }

        @media screen and (max-width: 335px) {
            .container {
                margin: 0;
                width: 280px;
                padding: 0 10px;
            }

            input , button {
                width: 240px;
            }

            p {
                font-size: 13px;
            }

            #head {
                font-size:20px;
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
            background: black;
            background:#c22321;
            position: absolute; 
            z-index:10000; 
            top:15px;
            animation: anim_error 0.3s ease 1;
        }

        @keyframes anim_error {
            0% {top:0;}
            100% {top:15px;}
        }

        #close {
            color:black;
            padding: 10px;
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
                <div class="container">
                    <form enctype="multipart/form-data" method="POST">
                        <h3 id="head">Change Password</h3>
                        <br>
                        <input type="text" id="username" placeholder="username" name="username" required>
                        <br>
                        <input type="email" id="email_id" placeholder="email id" name="email_id" required>
                        <br>
                        <input type="tel" id="mobile" placeholder="mobile number" name="mobile" required>
                        <br>
                        <input type="password" id="newpassword" placeholder="new password" name="newpassword" required>
                        <br>
                        <input type="password" id="confirmpassword" placeholder="confirm password" name="confirmpassword" required>
                        <br>
                        <button type="submit" name="change">Change</button>
                        <br><br>
                        <p id="p1">Login Page - <a href="login.php">Click Here</a> </p>
                    </form>
                </div>
            </div>
        </section>

    </body>

</html>