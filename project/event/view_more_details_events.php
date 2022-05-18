<?php
include('../db_connect.php');
include('../checklogin.php');
error_reporting(0);

$id = $_GET['id'];

$sql1 = "SELECT * FROM events where id = '".$id."'";
$q1 = $conn->query($sql1);

$sql2 = "SELECT * FROM catering where event_id = '".$id."'";
$q2 = $conn->query($sql2);

$sql3 = "SELECT * FROM decorations where event_id = '".$id."'";
$q3 = $conn->query($sql3);

$sql4 = "SELECT * FROM other_service where event_id = '".$id."'";
$q4 = $conn->query($sql4);

$sql5 = "SELECT * FROM ratee where id = '".$id."'";
$q5 = $conn->query($sql5);

$sql6 = "SELECT * FROM transaction where event_id = '".$id."'";
$q6 = $conn->query($sql6);

$r1 = $q1->fetch_assoc();
$r2 = $q2->fetch_assoc();
$r3 = $q3->fetch_assoc();
$r4 = $q4->fetch_assoc();
$r5 = $q5->fetch_assoc();
$r6 = $q6->fetch_assoc();

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
        <title>More Details</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../w3-css.css">
        <link rel="stylesheet" href="../cssstyle.css">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        

        <style>
             #txt_col {
                text-align:center;
                color:rgb(144,4,4);
            }

            section {
                padding:20px 0;
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
                        <a href="../admin_index.php" >MOSAIC <span>EVENTS</span></a>
                    </div>
                    <div class="mobile-button">
                        <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
                    </div>
                    <div class="links">
						<a href='../venues/view.php' class='lnk'>Venues</a>
                        <a href='view.php' class='lnk active'>Events</a>
                        <a href='../category/view.php' class='lnk'>Categories</a>
                        <a href="../logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>           
                    </div>

                    <div id="mobile-sidenav" class="mobile-links">
                        <div class="mobile-logo" style="display: inline-block;">
                            <a href="../admin_index.php" class="logo">MOSAIC <span>EVENTS</span></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
                        </div>
						    <a href='../venues/view.php' class='lnk'>Venues</a>
                            <a href='view.php' class='lnk'>Events</a>
                            <a href='../category/view.php' class='lnk'>Categories</a>
                            <a href="../logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>  
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
					if($r1['status']=='Cancelled' or $r1['status']=='')
					{
						?>
					<div class="alert alert-danger" role="alert" id="msgs"> 
						<?php echo $fmsg; ?> 
					</div>
					<?php 
						}
						else 
						{
					?>
					<div class="alert alert-success" role="alert" id="msgs"> 
						<?php echo $fmsg; ?> 
					</div>
					<?php } ?>
					<?php } ?>
				<div>
				<?php 
					if($r1['status']!='Cancelled')
					{
					?>
						<div class="alert alert-info w3-blue-grey" role="alert" id="msgs"> 
								<?php echo 'Total Event Cost - '.$r1['total_cost']; ?> 
						</div>
						<div class="alert alert-info w3-blue-grey" role="alert" id="msgs"> 
								<?php echo 'Paid Amount - '.$r6['paid_amount']; ?> 
						</div>
				<?php
					}
				?>
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
                            <!-- <th>Status</th> -->
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
								<!-- <td>
                                    <?php 
                                    if($r1['status']==''){
                                        echo 'Pending';
                                    }
                                    else{
                                        echo $r1['status'];
                                    } ?>
                                </td> -->
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
						
							<tr>
                                <td><?php echo $r2['event_id']; ?></td>
								<td><?php echo $r2['type']; ?></td>
								<td><?php echo $r2['diet']; ?></td>
								<td><?php echo $r2['water']; ?></td>
								<td><?php echo $r2['sweets']; ?></td>
								<td><?php echo $r2['snacks_and_drinks']; ?></td>
								<td><?php echo $r2['ice_cream']; ?></td>
							</tr>
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
							<tr>
								<td><?php echo $r3['event_id']; ?></td>
								<td><?php echo $r3['lights']; ?></td>
								<td><?php echo $r3['flowers']; ?></td>
								<td><?php echo $r3['balloons']; ?></td>
								<td><?php echo $r3['seating']; ?></td>
							</tr>
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
							<tr>
								<td><?php echo $r4['event_id']; ?></td>
								<td><?php echo $r4['mehandhi']; ?></td>
								<td><?php echo $r4['photographs']; ?></td>
								<td><?php echo $r4['band']; ?></td>
							</tr>
					</tbody>
				</table>
			</div>
            </div>
        </section>


        <!-- Feedback Details -->
        <?php 
            if($r1['status']=='Completed'){
        ?>
        <section>
            <div>
            <h2 id='txt_col'>Feedback</h2>
            <div class="container-fluid my-4">
				<table class="table ">
					<thead>
						<tr>
                            <!-- <th>User ID</th> -->
							<th>Event ID</th>
							<th>Username</th>
							<th>Event Name</th>
							<th>Feedback</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td><?php echo $r5['id']; ?></td>
								<td><?php echo $r5['username']; ?></td>
								<td><?php echo $r5['event_name']; ?></td>
								<td><?php echo $r5['feedback']; ?></td>
							</tr>
					</tbody>
				</table>
			</div>
            </div>
        </section>
        <?php 
            }
        ?>



		<!-- Transaction Details -->
		<?php 
            if($r1['status']=='Approved' or $r1['status']==''){
        ?>
		<section>
            <div>
            <h2 id='txt_col'>Transaction Details</h2>
            <div class="container-fluid my-4">
				<table class="table ">
					<thead>
						<tr>
							<th>Transaction ID</th>
							<th>Event ID</th>
                            <th>User ID</th>
							<th>Username</th>
							<th>Total Amount</th>
							<th>Paid Amount</th>
						</tr>
					</thead>
					<tbody>
							<tr>
								<td><?php echo $r6['transaction_id']; ?></td>
								<td><?php echo $r6['event_id']; ?></td>
								<td><?php echo $r6['user_id']; ?></td>
								<td><?php echo $r6['user_name']; ?></td>
								<td><?php echo $r6['total_amount']; ?></td>
								<td><?php echo $r6['paid_amount']; ?></td>
							</tr>
					</tbody>
				</table>
			</div>
            </div>
        </section>
		<?php } ?>
</html>