<?php
include('db_connect.php');
include('checklogin.php');

$username = $_SESSION["rainbow_username"];
$sql = "SELECT * FROM events where username = '".$username."'";
$q = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Booking History</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="cssstyle.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <style>
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

                        <a href="booking_history.php" class="lnk active" >Booking History</a>

                        <a href="view_venues.php" class="lnk" >View Venues</a>

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

                            <a href="booking_history.php" class="lnk active" >Booking History</a>

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
            <div class="container-fluid my-4">
				<table class="table ">
					<thead>
						<tr>
							<th>Event ID</th>
							<th>Event Name</th>
							<th>Category</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Number of Guests</th>
							<th>Venue</th>
                            <th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            while ($r = $q->fetch_assoc()) {
						?>
							<tr>
								<th scope="row"><?php echo $r['id']; ?></th>
								<td><?php echo $r['name']; ?></td>
								<td><?php echo $r['category']; ?></td>
								<td><?php echo $r['start_date']; ?></td>
								<td><?php echo $r['end_date']; ?></td>
								<td><?php echo $r['number_of_guests']; ?></td>
								<td><?php echo $r['venue']; ?></td>
								<td>
                                    <?php 
                                    if($r['status']==''){
                                        echo 'Pending';
                                    }
                                    else{
                                        echo $r['status'];
                                    } ?>
                                </td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
            </div>
        </section>
    </body>
</html>