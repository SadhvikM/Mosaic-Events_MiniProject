<?php
include('db_connect.php');
include('checklogin.php');

$error = '';
$username = $_SESSION['rainbow_username'];
$email_id = $_SESSION['rainbow_email'];
$mobile_number = $_SESSION['rainbow_mobile'];
$address = $_SESSION['rainbow_address'];

if(isset($_POST['save']))
{
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $email_id = mysqli_real_escape_string($conn,$_POST['email_id']);
    $mobile_number = mysqli_real_escape_string($conn,$_POST['mobile_number']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $new_pass = mysqli_real_escape_string($conn,$_POST['new_pass']);
    $confirm_pass = mysqli_real_escape_string($conn,$_POST['confirm_pass']);

    $sql1 = "update users set username = '".$username."' , email_id = '".$email_id."' , mobile_number = '".$mobile_number."' , address = '".$address."' where user_id = '".$_SESSION['rainbow_user_id']."'";
    $q1 = $conn->query($sql1);

    echo '<script type="text/javascript">alert("Details Updated Successfully.");</script>';

    if($new_pass!='' && $confirm_pass!=""){
        if($new_pass==$confirm_pass)
        {
            $sql2 = "update users set password = '".$new_pass."' where user_id = '".$_SESSION['rainbow_user_id']."'";
            $q2 = $conn->query($sql2);
            echo '<script type="text/javascript">alert("Password Updated Successfully.");</script>';
        }
        else{
            echo '<script type="text/javascript">alert("Change Password and Confirm Password must be same.");</script>';
        }
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>My Details</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="cssstyle.css">
        
    </head>

    <style>
       @keyframes fadeIn {
            0% {
                transform:scale(.5) translateY(-10px);
                opacity:0;
            }
        }
    </style>

    <body>
            
        <header>
            <div class="navigation w3-highway-red w3-container">
                <nav class="nav-container w3-padding-large">
                    <div class="logo">
                        <a href="customer_index.php" >MOSAIC <span>EVENTS</span></a>
                    </div>
                    <div class="mobile-button">
                        <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
                    </div>
                    <div class="links">
                        <a href="customer_index.php" class="lnk active" >My Details</a>

                        <a href="book_an_event.php" class="lnk" >Book an Event</a>

                        <a href="booking_status.php" class="lnk" >Booking Status</a>

                        <a href="booking_history.php" class="lnk" >Booking History</a>

                        <a href="view_venues.php" class="lnk" >View Venues</a>

                        <a href="feedback.php" class="lnk" >Feedback</a>

                        <a href="logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>           
                    </div>

                    <div id="mobile-sidenav" class="mobile-links">
                        <div class="mobile-logo" style="display: inline-block;">
                            <a href="customer_index.php" class="logo">MOSAIC <span>EVENTS</span></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
                        </div>
                            <a href="customer_index.php" class="lnk active" >My Details</a>

                            <a href="book_an_event.php" class="lnk" >Book an Event</a>

                            <a href="booking_status.php" class="lnk" >Booking Status</a>

                            <a href="booking_history.php" class="lnk" >Booking History</a>

                            <a href="view_venues.php" class="lnk" >View Venues</a>

                            <a href="feedback.php" class="lnk" >Feedback</a>

                            <a href="logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>  
                    </div>
                </nav>

                <script>
                    function toggleMobileNavigation() {
                        const mobileNavigation = document.getElementById("mobile-sidenav");
                        mobileNavigation.classList.toggle('mobile-links-active');
                    }
                </script>
            </div>
        </header>

        <section style='animation:fadeIn .15s linear;'>
                <div>
                    <?php
                        echo "<form enctype='multipart/form-data' method='POST'>

                        <div id='content'> <p>User ID</p> <input type='text' name='user_id' 
                        value='".$_SESSION['rainbow_user_id']."' readonly style='background: rgba(255,255,255,0.5);color:black;'> </div>

                        <div id='content'> <p>Username</p> <input type='text' name='username' 
                        value='".$username."'> </div>

                        <div id='content'> <p>Email ID</p> <input type='email' name='email_id' 
                        value='".$email_id."'> </div>
                        
                        <div id='content'> <p>Mobile Number</p> <input type='tel' name='mobile_number' value='".$mobile_number."'> </div>
                        
                        <div id='content'> <p>Address</p> 
                        <textarea name='address' rows='4'>".$address."</textarea> </div>

                        <div id='content'> <p>Change Password</p> <input type='password' name='new_pass' id='new_pass'> </div>

                        <div id='content'> <p>Confirm Password</p> <input type='password' name='confirm_pass' id='confirm_pass'> </div>

                        <br>

                        <div id='content'> <button id='btn_button' type='submit' name='save'>Save Changes</button> </div>

                        </form>";
                    ?>
                </div>

        </section>

    </body>

</html>