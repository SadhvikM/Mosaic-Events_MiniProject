<?php
include('db_connect.php');
include('checklogin.php');
// error_reporting(0);

$username = $_SESSION["rainbow_username"];
$user_id = $_SESSION["rainbow_user_id"];

$sql = "SELECT * FROM events where username = '".$username."'";
$q2 = $conn->query($sql);

if(isset($_POST['cancel'])){
	$id = $_GET['id'];
	$da = $_GET['d'];

	$status = 'Cancelled';

	$sql2 = "UPDATE events SET status='$status' WHERE id='$id'";
	$q = $conn->query($sql2);

    $qq = "select * from transaction where event_id = '".$id."'";
	$qqq = $conn->query($qq);
	$bal = mysqli_fetch_assoc($qqq);
	$paid = $bal['paid_amount'];
	$count1 = 0.25 * $paid;
    // $count1 = (int)$count1;

    if($da==0){
        // $sql = "UPDATE transaction SET paid_amount = '$paid'  WHERE event_id='$id'";
	    // $q = $conn->query($sql);
        echo '<script type="text/javascript">alert("Event Cancelled.");</script>';
        echo '<script type="text/javascript">alert("No Refund.");</script>';
    }
    else{
        $sql = "UPDATE transaction SET paid_amount = '$count1'  WHERE event_id='$id'";
	    $q = $conn->query($sql);
        echo '<script type="text/javascript">alert("Event Cancelled.");</script>';
        echo '<script type="text/javascript">alert("75% Payment Refunded.");</script>';
    }

	header("Refresh:0");
}	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Booking Status</title>
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

                        <a href="booking_status.php" class="lnk active" >Booking Status</a>

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
                            <a href="customer_index.php" class="lnk" >My Details</a>

                            <a href="book_an_event.php" class="lnk" >Book an Event</a>

                            <a href="booking_status.php" class="lnk active" >Booking Status</a>

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
                            <th>More Details</th>
                            <th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            while ($r = $q2->fetch_assoc()) {
						?>
							<tr>
								<th scope="row"><?php echo $r['id']; ?></th>
								<td><?php echo $r['name']; ?></td>
								<td><?php echo $r['category']; ?></td>
								<td><?php echo $r['start_date']; ?></td>
								<td><?php echo $r['end_date']; ?></td>
								<td><?php echo $r['number_of_guests'];?></td>
								<td><?php echo $r['venue'];?></td>
								<td><a href='view_more_details_events_customer.php?id=<?php echo $r['id']; ?>'>View More</a></td>
                                <td>
                                <?php 
                                    if($r['status']==''){
                                        echo 'Pending';
                                    }
                                    else{
                                        echo $r['status'];
                                    } ?>
                                </td>
								<td>
									<!-- <a href="book_event_update.php?id=<?php echo $r['id']; ?>"><button type="button" class="btn btn-info">Edit</button></a> -->


                                    <?php
                                        $today_date = date("Y-m-d");
                                        $date1=date_create($r['start_date']);
                                        $date2=date_create($today_date);
                                        $diff=date_diff($date2,$date1);
                                        $d = $diff->format("%a");
                                        // echo($d);
                                    ?>

                                    <form action='booking_status.php?id=<?php echo $r['id']; ?><?php echo '&d='.$d; ?>' method='post' style='border:none;padding:5px 0;text-align:inherit;
                                    <?php 
									if($r['status']=='Cancelled' or $r['status']=='Completed'){
										echo 'display:none;"';
									}
									else{
										echo 'display:inline-block;"';
									}
								    ?>
                                    '>
                                    
									    <button type="submit" class="btn btn-danger btn-xs" name='cancel'>Cancel</button>
                                    </form>
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