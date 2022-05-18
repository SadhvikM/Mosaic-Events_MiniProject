<?php
include('db_connect.php');
include('checklogin.php');


?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Venues</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="cssstyle.css">

    </head>

    <style>
        .card {
            transition: -webkit-transform .25s cubic-bezier(.33, .04, .63, .93);
            transition: transform .25s cubic-bezier(.33, .04, .63, .93);
            transition: transform .25s cubic-bezier(.33, .04, .63, .93), -webkit-transform .25s cubic-bezier(.33, .04, .63, .93);
            backface-visibility: hidden;
            cursor: pointer;
            width: max-content;
            position: relative;
            float: left;
            padding: 10px;
            margin:3px;
            border: 1px solid rgba(0,0,0,.125);
        }
        .card:hover {
            z-index: 99;
            box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.125);
            transform: scale3d(1.2, 1.2, 1) translateZ(0) perspective(500px);
            transition: -webkit-transform .25s cubic-bezier(.33, .04, .63, .93);
            transition: transform .25s cubic-bezier(.33, .04, .63, .93);
            transition: transform .25s cubic-bezier(.33, .04, .63, .93), -webkit-transform .25s cubic-bezier(.33, .04, .63, .93);
            transition-delay: .25s;
            position: relative;
            background:rgba(255,255,255,0.5);
            z-index: 1000;
        }
        .card:after {
            content: "";
            position: absolute;
            top: -7px;
            bottom: -7px;
            left: -7px;
            right: -7px;
            border: 0 solid #fff;
            border-radius: 8px;
            opacity: 0;
            transition: border .25s cubic-bezier(.33, .04, .63, .93);
            pointer-events: none;
            z-index: 1;
        }
        .card .img {
            height: 230px;
            width: 100%;
        }
        .card .img img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
        .card .top-text {
            padding: 0 10px;
        }
        .card .title h3 {
            font-size: 15px;
            font-weight: bold;
        }
        .title h3 {
            color: rgb(144,4,4);
        }
        .cont .image .card {
            animation: fadeIn .2s linear;
        }
        @keyframes fadeIn {
            0% {
                transform:scale(.5) translateY(-10px);
                opacity:0;
            }
        }
    </style>
    
    <body id="body">
        
        <header >
            <div class="navigation w3-highway-red w3-container">
                <nav class="nav-container w3-padding-large">
                    <div class="logo">
                        <a href="customer_index.php" >MOSAIC <span>EVENTS</span></a>
                    </div>
                    <div class="mobile-button">
                        <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
                    </div>
                    <div class="links">
                        <a href="customer_index.php" class="lnk" >My Details</a>

                        <a href="book_an_event.php" class="lnk" >Book an Event</a>

                        <a href="booking_status.php" class="lnk" >Booking Status</a>

                        <a href="booking_history.php" class="lnk" >Booking History</a>

                        <a href="view_venues.php" class="lnk active" >View Venues</a>

                        <a href="feedback.php" class="lnk" >Feedback</a>

                        <a href="logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>           
                    </div>

                    <div id="mobile-sidenav" class="mobile-links">
                        <div class="mobile-logo" style="display: inline-block;">
                            <a href="customer_index.php" class="logo">MOSAIC <span>EVENTS</span></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
                        </div>
                            <a href="customer_index.php" class="lnk" >My Details</a>

                            <a href="book_an_event.php" class="lnk" >Book an Event</a>

                            <a href="booking_status.php" class="lnk" >Booking Status</a>

                            <a href="booking_history.php" class="lnk" >Booking History</a>

                            <a href="view_venues.php" class="lnk active" >View Venues</a>

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

        <center><input type="text" placeholder="search venues" id="search-box" ></center>

        <section style='flex-wrap:wrap;' class='cont'>

            <?php 
                $sql = 'select * from venues';
                $q = $conn->query($sql);
                while($res = $q->fetch_assoc()){
            ?>

            <div class='image'>
                <div class="card mb-4" data-title='<?php echo $res["venue_name"]; ?>'>
                    <div class="img" > 
                        <img src='<?php echo $res["venue_dir"]; ?>' > 
                    </div>
                    <div class="top-text pt-2">
                        <div class="title">
                            <h3><?php echo $res["venue_name"]; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
                
        <?php 
        } 
        ?>

    </section>

    <script>

        let searchBox = document.querySelector('#search-box');
        let images = document.querySelectorAll('.cont .image .card');
        searchBox.oninput = () =>{
        images.forEach(hide => hide.style.display = 'none');
        let value = searchBox.value;
        images.forEach(filter =>{
            let title = filter.getAttribute('data-title');
            if(value == title){
                filter.style.display = 'block';
            }
            if(searchBox.value == ''){
                filter.style.display = 'block';
            }
        });
        };

    </script>
        
    </body>
</html>