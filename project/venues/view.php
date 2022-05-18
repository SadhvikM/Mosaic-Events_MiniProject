<?php
include('../db_connect.php');
include('../checklogin.php');

$ReadSql = "SELECT * FROM `venues`";
$res = mysqli_query($conn, $ReadSql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Venues</title>
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
        
		<!-- <script src="js/myScript.js"></script> -->
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
						<a href='../venues/view.php' class='lnk active'>Venues</a>
                        <a href='../event/view.php' class='lnk'>Events</a>
                        <a href='../category/view.php' class='lnk'>Categories</a>
                        <a href="../logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>           
                    </div>

                    <div id="mobile-sidenav" class="mobile-links">
                        <div class="mobile-logo" style="display: inline-block;">
                            <a href="../admin_index.php" class="logo">MOSAIC <span>EVENTS</span></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
                        </div>
							<a href='../venues/view.php' class='lnk'>Venues</a>
                            <a href='../event/view.php' class='lnk'>Events</a>
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
			<div>
			<div class="container-fluid my-4">
				<div class="row my-2">
					<a href="add.php"><button type="button" class="btn btn-primary ml-4 pl-2">Add New</button></a>
				</div>
				<table class="table "> 
				<thead> 
					<tr> 
						<th>ID</th> 
						<th>Name</th> 
						<th>Image</th> 
						<th>Actions</th> 
					</tr> 
				</thead> 
				<tbody> 
				<?php 
				while($r = mysqli_fetch_assoc($res)){
				?>
					<tr> 
						<th scope="row"><?php echo $r['venue_id']; ?></th> 
						<td><?php echo $r['venue_name']; ?></td> 
						<td >
                            <img src="<?php echo '../'.$r['venue_dir']; ?>" alt='' width='200'>
                        </td> 
						<td>
							<a href="update.php?id=<?php echo $r['venue_id']; ?>"><button type="button" class="btn btn-info">Edit</button></a>

							<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal<?php echo $r['venue_id']; ?>">Delete</button>

							<!-- Modal -->
							<div class="modal fade" id="myModal<?php echo $r['venue_id']; ?>" role="dialog">
								<div class="modal-dialog">
								
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
									<h5 class="modal-title">Delete Job</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
									</div>
									<div class="modal-body">
									<p>Are you sure?</p>
									</div>
									<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
									<a href="delete.php?id=<?php echo $r['venue_id']; ?>"><button type="button" class="btn btn-danger"> Yes, Delete</button></a>
									</div>
								</div>
								</div>
							</div>

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
