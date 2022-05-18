<?php
include('../db_connect.php');
include('../checklogin.php');
error_reporting(0);

$ReadSql = "SELECT * FROM events";
$res = mysqli_query($conn, $ReadSql);


$status = '';
if(isset($_POST['approve'])){
	$id = $_GET['id'];
	$status = 'Approved';
	$sql = "UPDATE events SET status='$status' WHERE id='$id'";
	$q = $conn->query($sql);
	header("Refresh:0");
}

if(isset($_POST['complete'])){
	$id = $_GET['id'];
	$status = 'Completed';
	$sql = "UPDATE events SET status='$status' WHERE id='$id'";
	$q = $conn->query($sql);

	$sql6 = "SELECT * FROM transaction where event_id = '".$id."'";
	$q6 = $conn->query($sql6);
	$r6 = $q6->fetch_assoc();

	$tot = $r6['total_amount'];

	$sql7 = "UPDATE transaction SET paid_amount='$tot' WHERE event_id='$id'";
	$q7 = $conn->query($sql7);

	header("Refresh:0");
}

if(isset($_POST['cancel'])){
	$id = $_GET['id'];
	$username = $_GET['username'];

	$status = 'Cancelled';
	$sql = "UPDATE events SET status='$status' WHERE id='$id'";
	$q = $conn->query($sql);

	$qq = "select * from transaction where event_id = '".$id."'";
	$qqq = $conn->query($qq);
	$bal = mysqli_fetch_assoc($qqq);
	$paid = $bal['paid_amount'];

	$sql = "UPDATE transaction SET paid_amount = '0'  WHERE event_id='$id'";
	$q = $conn->query($sql);

	echo '<script type="text/javascript">alert("Event Cancelled.");</script>';
	echo '<script type="text/javascript">alert("Payment Refunded.");</script>';

	header("Refresh:0");
}	
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
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
			#myInput, #myInput2 {
				/* background-image: url('/css/searchicon.png'); */
				background-position: 10px 10px;
				background-repeat: no-repeat;
				width: 20%;
				font-size: 16px;
				padding: 15px 30px;
				border: 1px solid #ddd;
				margin: 15px;
				border-radius:5px;
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

		<br>

		<select name="category" id="myInput2" onChange="getV()">
			<option value="0">Event ID</option>
			<option value="1">Username</option>
			<option value="3">Category</option>
			<option value="4">Start Date</option>
			<option value="8">Status</option>
		</select>

		<script>
			val =  $('#myInput2').val();
			document.cookie = "val=" + val ;
			function getV(){
				val = $('#myInput2').val();
				document.cookie = "val=" + val ;
			}
		</script>

        	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search here .." title="Enter data">
			<!-- <input type="date" id="myInput" onkeyup="myFunction()" placeholder="Search here .." title="Enter Start Date"> -->
		
		<section>
			<div>
			<div class="container-fluid my-4">
			<?php if (isset($fmsg)) { ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>

				<div class="row my-2">
				</div>
				<table class="table " id='myTable'>
					<thead>
						<tr>
							<th>Event ID</th>
							<th>Username</th>
							<th>Event Name</th>
							<th>Category</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Number of Guests</th>
							<th>More Details</th>
							<th>Status</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
						while ($r = mysqli_fetch_assoc($res)) {
						?>
							<tr>
								<td><?php echo $r['id']; ?></td>
								<td><?php echo $r['username']; ?></td>
								<td><?php echo $r['name']; ?></td>
								<td><?php echo $r['category']; ?></td>
								<td><?php echo $r['start_date']; ?></td>
								<td><?php echo $r['end_date']; ?></td>
								<td><?php echo $r['number_of_guests']; ?></td>
								<td><a href='view_more_details_events.php?id=<?php echo $r['id']; ?>'>View More</a></td>
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

								<form action='view.php?id=<?php echo $r['id']; ?><?php echo '&username='.$r['username']; ?>' method='post' style='border:none;padding:0;text-align:inherit;
									<?php 
										if($r['status']=='Cancelled' or $r['status']=='Completed'){
											echo 'display:none;"';
										}
										else{
											echo 'display:inline-block;"';
										}
									?>'>

									<button type="submit" class="btn btn-info" name='approve' id='approve'
									<?php 
									if($r['status']=='Approved'){
										echo 'style="display:none;"';
									}
									else{
										echo 'style="display:inline-block;"';
									}
									?>
									>Approve</button>

									<button type="submit" class="btn btn-danger btn-xs" name='cancel' id='cancel' style='
									<?php 
										$today_date = date("Y-m-d");
										$date1=date_create($r['end_date']);
										$date2=date_create($today_date);
										$diff=date_diff($date2,$date1);
										if(($diff->format("%R%a"))==0){
											echo 'display:none;"';
										}
										else{
											echo 'display:inline-block;"';
										}
									?>
									'>Cancel</button>

									<?php 
										
										if((($diff->format("%R%a"))<=0) and ($r['status']=='Approved') ){
											// echo($diff->format("%R%a"));
									?>
												<button type="submit" class="btn w3-blue-grey btn-xs" name='complete' id='complete'>Completed</button>
									<?php } ?>
								</form>
									
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			</div>
		</section>

		<script>
			function myFunction() {
				const x = document.cookie
					.split('; ')
					.find(row => row.startsWith('val='))
					.split('=')[1];
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("myInput");
				filter = input.value.toUpperCase();
				table = document.getElementById("myTable");
				tr = table.getElementsByTagName("tr");
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[x];
						if (td) {
							txtValue = td.textContent || td.innerText;
							if (txtValue.toUpperCase().indexOf(filter) > -1) {
								tr[i].style.display = "";
							} else {
							tr[i].style.display = "none";
							}
						}    
				}   
			}
		</script>

    </body>
</html>