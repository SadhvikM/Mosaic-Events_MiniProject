<?php
include('db_connect.php');
include('checklogin.php');

$username = $_SESSION["rainbow_username"];
$sql = "SELECT * FROM events where username = '".$username."' and status='Completed'";
$q = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $rating = $_POST["rating"];
        $event_id = $_POST['event_id'];
        $event_name = $_POST['event_name'];
        
        $sql2 = "INSERT INTO ratee (id,username,event_name,feedback) VALUES ('$event_id','$username','$event_name','$rating')";
        if (mysqli_query($conn, $sql2))
        {
            $fmsg = "Feedback added successfully";
        }
        else{
            $sql3 = "select * from ratee where id = '$event_id'";
            $q2 = $conn->query($sql3);
            if($q2->num_rows==1)
            {
                $sql4 = "UPDATE ratee SET feedback='$rating' WHERE id='$event_id'";
                $q2 = $conn->query($sql4);
                $fmsg = 'Feedback updated successfully';
            }
        }
        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Feedback</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="cssstyle.css">   
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    </head>

    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked) > input {
            position:absolute;
            top:-9999px;
        }

        .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
        }

        .rate:not(:checked) > label:before {
            content: '★ ';
        }

        .rate > input:checked ~ label {
            color: #ffc700;    
        }

        .rate:not(:checked) > label:hover,
        .rate:not(:checked) > label:hover ~ label {
            color: #deb217;  
        }

        .rate > input:checked + label:hover,
        .rate > input:checked + label:hover ~ label,
        .rate > input:checked ~ label:hover,
        .rate > input:checked ~ label:hover ~ label,
        .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
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

                        <a href="view_venues.php" class="lnk" >View Venues</a>

                        <a href="feedback.php" class="lnk active" >Feedback</a>

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

                            <a href="view_venues.php" class="lnk" >View Venues</a>

                            <a href="feedback.php" class="lnk active" >Feedback</a>

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
            <?php if (isset($fmsg)) { ?><div class="alert alert-success" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
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
							<th>Feedback</th>
                            <!-- <th>Status</th> -->
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
								<!-- <td>
                                    <?php 
                                    if($r['status']==''){
                                        echo 'Pending';
                                    }
                                    else{
                                        echo $r['status'];
                                    } ?>
                                </td> -->
                                <td>
                                <form enctype='multipart/form-data' method="post" style='border:none;padding:5px 0;
                                text-align:inherit;'>
                                    <input type="hidden" name="event_id" value=<?php echo $r['id']; ?>> 
                                    <input type="hidden" name="event_name" value=<?php echo $r['name']; ?>> 
                                    <div class="rateyo" id= "rating"
                                        data-rateyo-rating="0"
                                        data-rateyo-num-stars="5"
                                        data-rateyo-score="3">
                                    </div>
                                    <br>
                                    <p style='text-align:left;padding:10px;width:inherit;margin:0;'>
                                        <span class='result'>0</span>
                                        <input type="submit" name="add" style='width:max-content;'>
                                    </p>
                                    <input type="hidden" name="rating"> 
                                </td>
                                </form>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
            </div>
        </section>

        <script>

            $(function () {
                $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
                    var rating = data.rating;
                    $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
                    $(this).parent().find('.result').text(''+ rating);
                    $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
                });
            });
        
        </script>
    </body>
</html>