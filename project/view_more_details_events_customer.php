<?php
include('db_connect.php');
include('checklogin.php');

$id = $_GET['id'];

$sql1 = "SELECT * FROM events where id = '".$id."'";
$q1 = $conn->query($sql1);

$sql2 = "SELECT * FROM catering where event_id = '".$id."'";
$q2 = $conn->query($sql2);

$sql3 = "SELECT * FROM decorations where event_id = '".$id."'";
$q3 = $conn->query($sql3);

$sql4 = "SELECT * FROM other_service where event_id = '".$id."'";
$q4 = $conn->query($sql4);

$r1 = $q1->fetch_assoc();
if($r1['status']==''){
    $fmsg = 'Pending';
}
else{
    $fmsg = $r1['status'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View More <Details></Details></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="cssstyle.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


        <style>
             #txt_col {
                text-align:center;
                color:rgb(144,4,4);
            }

            section {
                padding:20px 0;
                animation:fadeIn .15s linear;
            }

            @keyframes fadeIn {
                0% {
                    transform:scale(.5) translateY(-10px);
                    opacity:0;
                }
            }

            #msgs {
				width: 50% !important;
    			text-align: center !important;
			}
        </style>
    </head>
   
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
        
        <section>
            <center>
                <?php if (isset($fmsg)) { 
                    if($r1['status']=='' or $r1['status']=='Cancelled')
                    {
                        ?>
                    <div class="alert alert-danger" role="alert" id='msgs'> 
                        <?php echo $fmsg; ?> 
                    </div>
                    <?php 
                        }
                        else 
                        {
                    ?>
                    <div class="alert alert-success" role="alert" id='msgs'> 
                        <?php echo $fmsg; ?> 
                    </div>
                    <?php } }?>
            </center>
            <div class="container-fluid my-4">
				<table class="table ">
					<thead>
						<tr>
                            <th>User Name</th>
							<th>Event ID</th>
							<th>Event Name</th>
							<th>Category</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Number of Guests</th>
							<th>Venue</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<th scope="row"><?php echo $r1['username']; ?></th>
								<td><?php echo $r1['id']; ?></td>
								<td><?php echo $r1['name']; ?></td>
								<td><?php echo $r1['category']; ?></td>
								<td><?php echo $r1['start_date']; ?></td>
								<td><?php echo $r1['end_date']; ?></td>
								<td><?php echo $r1['number_of_guests']; ?></td>
								<td><?php echo $r1['venue']; ?></td>
							</tr>
					</tbody>
				</table>
			</div>
            </div>
        </section>


        <!-- Catering Details -->
        <section>
            <div>
                <h2 id='txt_col'>Catering Details</h2>
            <div class="container-fluid my-4">
				<table class="table ">
					<thead>
						<tr>
                            <!-- <th>User ID</th> -->
							<th>Event ID</th>
							<th>Catering Type</th>
							<th>Diet</th>
							<th>Water</th>
							<th>Sweets</th>
							<th>Snacks and Drinks</th>
                            <th>Ice Cream</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            while ($r2 = $q2->fetch_assoc()) {
						?>
							<tr>
								<!-- <th scope="row"><?php echo $r2['user_id'];?></th> -->
                                <td><?php echo $r2['event_id']; ?></td>
								<td><?php echo $r2['type']; ?></td>
								<td><?php echo $r2['diet']; ?></td>
								<td><?php echo $r2['water']; ?></td>
								<td><?php echo $r2['sweets']; ?></td>
								<td><?php echo $r2['snacks_and_drinks']; ?></td>
								<td><?php echo $r2['ice_cream']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
            </div>
        </section>


        <!-- Decoration Details -->
        <section>
            <div>
            <h2 id='txt_col'>Decoration Details</h2>
            <div class="container-fluid my-4">
				<table class="table ">
					<thead>
						<tr>
                            <!-- <th>User ID</th> -->
							<th>Event ID</th>
							<th>Lights</th>
							<th>Flowers</th>
							<th>Balloons</th>
							<th>Seating</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            while ($r3 = $q3->fetch_assoc()) {
						?>
							<tr>
								<!-- <th scope="row"><?php echo $r3['user_id']; ?></th> -->
								<td><?php echo $r3['event_id']; ?></td>
								<td><?php echo $r3['lights']; ?></td>
								<td><?php echo $r3['flowers']; ?></td>
								<td><?php echo $r3['balloons']; ?></td>
								<td><?php echo $r3['seating']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
            </div>
        </section>


        <!-- Other Services -->
        <section>
            <div>
            <h2 id='txt_col'>Other Services</h2>
            <div class="container-fluid my-4">
				<table class="table ">
					<thead>
						<tr>
                            <!-- <th>User ID</th> -->
							<th>Event ID</th>
							<th>Mehandhi</th>
							<th>Photographer</th>
							<th>Band</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            while ($r4 = $q4->fetch_assoc()) {
						?>
							<tr>
								<!-- <th scope="row"><?php echo $r4['user_id']; ?></th> -->
								<td><?php echo $r4['event_id']; ?></td>
								<td><?php echo $r4['mehandhi']; ?></td>
								<td><?php echo $r4['photographs']; ?></td>
								<td><?php echo $r4['band']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
            </div>
        </section>
</html>