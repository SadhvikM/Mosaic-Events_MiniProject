<?php
include('db_connect.php');
include('checklogin.php');

$username = $_SESSION["rainbow_username"];
$user_id = $_SESSION['rainbow_user_id'];

$id_q = "select max(id) as max_event_id from events;";
$event_id_q = $conn->query($id_q);
$res = $event_id_q->fetch_assoc();
$max_event_id = $res['max_event_id']+1;

$total_cost = 0;

if(isset($_POST['book']))
{
    $name = $_POST['event_name'];
    $description = $_POST['event_description'];
    $category = $_POST['category'];
    $start_date = $_POST['event_start_date'];
    $end_date = $_POST['event_end_date'];
    $guests = $_POST['event_guests'];
    $venue = $_POST['venue'];
 

    $type = $_POST['type'];
    $diet = $_POST['diet'];
    $water = $_POST['water'];
    $sweets = $_POST['sweets'];
    $snacks_and_drinks = $_POST['snacks_and_drinks'];
    $icecream = $_POST['icecream'];
    $iceC = implode(' ',$icecream);


    $light = $_POST['light'];
    $flower = $_POST['flower'];
    $balloon = $_POST['balloon'];
    $seating = $_POST['seating'];


    $photographer = $_POST['photographer'];
    $band = $_POST['band'];
    $mehandhi = $_POST['mehandhi'];

    $arr = array($type,$diet,$water,$sweets,$snacks_and_drinks,$light,$flower,$balloon,$seating,$photographer,$band,$mehandhi);

    $i = 0;

    for($i=0;$i<sizeof($arr);$i++){
        $qu = "select * from pricing where name = '".$arr[$i]."'";
        $re = $conn->query($qu);
        $p = $re->fetch_assoc();
        $total_cost += $p['price'];
    }   

    if(!empty($_POST['icecream'])) {
        foreach($_POST['icecream'] as $ice) {
            $qu2 = "select * from pricing where name = '".$ice."'";
            $re2 = $conn->query($qu2);
            $p2 = $re2->fetch_assoc();
            $total_cost += $p2['price'];
        }
    }

	$date1=date_create($end_date);
	$date2=date_create($start_date);
	$diff=date_diff($date2,$date1);
    $n_dates = $diff->format("%R%a");

	echo $n_dates;
    
    $l = $total_cost*($guests/40)*$n_dates;
    $total_cost = (int)$l;

    $sql = "INSERT INTO `temp` (event_id,user_id,username,name, description, category, start_date, end_date, number_of_guests, venue, type, diet, water, sweets, snacks_and_drinks, ice_cream, lights, flowers, balloons, seating, mehandhi, photographs, band,total_cost) 
    VALUES ('$max_event_id','$user_id','$username','$name', '$description', '$category', '$start_date', '$end_date','$guests','$venue','$type', '$diet', '$water','$sweets', '$snacks_and_drinks', '$iceC','$light', '$flower', '$balloon', '$seating','$mehandhi', '$photographer', '$band','$total_cost')";
    $q = $conn->query($sql);
    
    echo '<script type="text/javascript">window.location = "payment_event.php?id='.$max_event_id.'";</script>';

}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Book Event</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" required>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="cssstyle.css">

    </head>

    <style>
        
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
                        <a href="customer_index.php" class="lnk" >My Details</a>

                        <a href="book_an_event.php" class="lnk active" >Book an Event</a>

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
                            <a href="customer_index.php" class="lnk"  >My Details</a>

                            <a href="book_an_event.php" class="lnk active" >Book an Event</a>

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

        
        <section id='section_content'>
            <div>
            <?php if (isset($fmsg)) { ?><center><div class="alert alert-success" role="alert" 
                style='width: 50%;text-align:center;'> <?php echo $fmsg; ?> </div></center><?php } ?>


                <form enctype='multipart/form-data' method = 'POST' >

                        <div id='content'> 
                            <p>Event Name</p> 
                            <input type='text' name='event_name'  required> 
                        </div>

                        <div id='content'> 
                            <p>Event Category</p> 
                            <select name="category" style='width: 300px;border: 0;border-radius: 10px;padding: 10px;margin: 20px;font-size: 16px;font-weight:300;background: rgb(255,255,255);caret-color: rgb(141, 4, 4);color: black;overflow: hidden;letter-spacing:1px;' required>
								<?php
								$getCategories = "SELECT * FROM `categories`";
								$res = mysqli_query($conn, $getCategories);
								while ($r = mysqli_fetch_assoc($res)) { ?>
									<option value="<?= $r['name'] ?>"><?= $r['name'] ?></option>
								<?php } ?>
							</select>
                        </div>

                        <div id='content'> 
                            <p>Description</p> 
                            <textarea name='event_description' rows='4' required></textarea> 
                        </div>

                        <div id='content'> 
                            <p>Start Date</p> 
                            <input type='date' name='event_start_date' required> 
                        </div>

                        <div id='content'> 
                            <p>End Date</p> 
                            <input type='date' name='event_end_date' required> 
                        </div>

                        <div id='content'> 
                            <p>Number of Guests</p> 
                            <input type='number' name='event_guests' required> 
                        </div>

                        <div id='content'> 
                            <p>Select Venue</p> 
                            <select name="venue" style='width: 300px;border: 0;border-radius: 10px;padding: 10px;margin: 20px;font-size: 16px;font-weight:300;background: rgb(255,255,255);caret-color: rgb(141, 4, 4);color: black;overflow: hidden;letter-spacing:1px;' required>
								<?php
								$getVenues = "SELECT * FROM `venues`";
								$res2 = mysqli_query($conn, $getVenues);
								while ($r2 = mysqli_fetch_assoc($res2)) { ?>
									<option value="<?= $r2['venue_name'] ?>"><?= $r2['venue_name'] ?></option>
								<?php } ?>
							</select>
                        </div>

                        <br><br>

            
                        
                <h2 style="color:rgb(141, 4, 4);text-align:center">Catering details</h2>
                <br>

                        <label for='type' style='font-size:20px'><strong>Type</strong></label>
                            <br><br>
                        <div id='content_book'>
                            <div class='t1'>
                            <label for='buffet'><img src='images/buffet.jpeg' width="150" height="150"></label>
                                    <br>
                                <input type='radio' name='type' id='buffet' value='buffet' style='width: 25px;' required>
                                Buffet
                            </div>
                            <div class='t1'>
                                <label for='seating'><img src='images/seating.jpeg' width="150" height="150"></label>
                                    <br>
                                <input type='radio' name='type' id='seating' value='seating' style='width: 25px;' required>
                                Seating
                            </div>
                            <div>
                                <label for='buffet_and_seating'><img src="images/buffet_seating.jpeg" width="150" height="150"></label>
                                    <br>
                                <input type='radio' name='type' id='buffet_and_seating' value='buffet_and_seating' 
                                style='width: 25px;' required>
                                Both
                            </div>
                        </div>

                        <br><br>
                        
                        <label for='diet' style='font-size:20px'><strong>Diet</strong></label>
                            <br><br>

                        <div id='content_book'>
                            <div class='t1'>
                                <label for='veg'><img src='images/veg.jpg' width="150" height="150"></label>
                                    <br>
                                <input type='radio' name='diet' id='veg' value='veg' style='width: 25px;' required>
                                Veg       
                            </div>
                            <div class='t1'>
                                <label for='nonveg'><img src='images/nonveg.jpeg' width="150" height="150"></label>
                                    <br>
                                <input type='radio' name='diet' id='nonveg' value='nonveg' style='width: 25px;' required>
                                Non-veg
                            </div>
                            <div class='t1'>
                                <label for='veg_and_nonveg'><img src='images/veg_nonveg.jpeg' width="150" height="150"></label>
                                    <br>
                                <input type='radio' name='diet' id='veg_and_nonveg' value='veg_and_nonveg' style='width: 25px;' required>
                                Both
                            </div>
                        </div>

                        <br><br>

                        <label for='water' style='font-size:20px'><strong>Water</strong></label>
                            <br><br>
                        <img src='images/water.jpg' width='150' height='150'>
                            <br>
                        
                        <div id='content_book'>
                            <div class='t1'>
                                <input type='radio' name='water' id='cool_water' value='cool_water' style='width: 25px;' required>
                                <label for='cool_water'>Cool</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='water' id='normal_water' value='normal_water' style='width: 25px;' required>
                                <label for='normal_water'>Normal</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='water' id='cool_and_normal_water' value='cool_and_normal_water' style='width: 25px;' required>
                                <label for='cool_and_normal_water'>Both</label>
                            </div>
                        </div>

                        <br><br>

                        <label for='sweets' style='font-size:20px'><strong>Sweets</strong></label>
                            <br><br>
                        <img src='images/sweets.jpeg' width='150' height='150'>
                            <br>
                        
                        <div id='content_book'>
                            <div class='t1'>
                                <input type='radio' name='sweets' id='sweets_yes' value='sweets_yes' style='width: 25px;' required>
                                <label for='sweets_yes'>Yes</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='sweets' id='sweets_no' value='no' style='width: 25px;' required>
                                <label for='sweets_no'>No</label>
                            </div>
                        </div>

                        <br><br>

                        <label for='snacks_and_drinks' style='font-size:20px'><strong>Snacks and Drinks</strong></label>
                            <br><br>
                        <img src='images/snacks_drinks.jpeg' width='150' height='150'>
                            <br>
                        
                        <div id='content_book'>
                            <div class='t1'>
                                <input type='radio' name='snacks_and_drinks' id='snacks_and_drinks_yes' value='snacks_and_drinks_yes' 
                                style='width: 25px;' required>
                                <label for='snacks_and_drinks_yes'>Yes</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='snacks_and_drinks' id='snacks_and_drinks_no' value='no' 
                                style='width: 25px;' required>
                                <label for='snacks_and_drinks_no'>No</label>
                            </div>
                        </div>

                        <br><br>

                        <label for='icecream' style='font-size:20px'><strong>Ice cream</strong></label>
                            <br><br>
                        
                        <div id='content_book'>
                            <div class='t1'>
                                <img src='images/icecream.jpeg' width='150' heigth='150'>
                                <br>
                                <input type='checkbox' name='icecream[]' id='chocolate' value='chocolate' style='width: 25px;' >
                                <label for='chocolate'>Chocolate</label>
                                <input type='checkbox' name='icecream[]' id='vanilla' value='vanilla' style='width: 25px;' >
                                <label for='vanilla'>Vanilla</label>
                                <input type='checkbox' name='icecream[]' id='strawberry' value='strawberry' style='width: 25px;' >
                                <label for='strawberry'>Strawberry</label>
                                <br>
                                <input type='checkbox' name='icecream[]' id='butterscotch' value='butterscotch' 
                                style='width: 25px;' >
                                <label for='butterscotch'>Butter scotch</label>
                                <input type='checkbox' name='icecream[]' id='blackcurrent' value='blackcurrent' 
                                style='width: 25px;' >
                                <label for='blackcurrent'>Black current</label>
                                <input type='checkbox' name='icecream[]' id='pistachio' value='pistachio' 
                                style='width: 25px;' >
                                <label for='pistachio'>Pistachio</label>
                                
                            </div>
                        </div>

                        <br><br>
                        
                          
                        

                <h2 style="color:rgb(141, 4, 4);text-align:center">Decoration details</h2>
                    <br>


                        <label for='light' style='font-size:18px'><strong>Lightnings</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <img src='images/lighting.jpg' width="150" height="150">
                            <br>
                            <input type='radio' name='light' id='normal_lights' value='normal_lights' style='width: 25px;' required>
                            <label for='normal_lights'>Normal</label>
                            <input type='radio' name='light' id='delux_lights' value='delux_lights' style='width: 25px;' required>
                            <label for='delux_lights'>Delux</label>
                            <!-- <br> -->
                            <input type='radio' name='light' id='royal_lights' value='royal_lights' style='width: 25px;' required>
                            <label for='royal_lights'>Royal</label>
                            <input type='radio' name='light' id='no_lights' value='no' style='width: 25px;' required>
                            <label for='no_lights'>None</label>
                        </div>
                    </div>

                    <br><br>

                    <label for='flower' style='font-size:18px'><strong>Flowers</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <img src='images/flower.jpeg' width="150" height="150">
                            <br>
                            <input type='radio' name='flower' id='normal_flowers' value='normal_flowers' style='width: 25px;' required>
                            <label for='normal_flowers'>Normal</label>
                            <input type='radio' name='flower' id='delux_flowers' value='delux_flowers' style='width: 25px;' required>
                            <label for='delux_flowers'>Delux</label>
                            <!-- <br> -->
                            <input type='radio' name='flower' id='royal_flowers' value='royal_flowers' style='width: 25px;' required>
                            <label for='royal_flowers'>Royal</label>
                            <input type='radio' name='flower' id='no_flowers' value='no' style='width: 25px;' required>
                            <label for='no_flowers'>None</label>
                        </div>
                    </div>

                    <br><br>                     

                    <label for='balloon' style='font-size:18px'><strong>Balloons</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <img src='images/balloon.jpeg' width="150" height="150">
                            <br>
                            <input type='radio' name='balloon' id='normal_balloons' value='normal_balloons' style='width: 25px;' required>
                            <label for='normal_balloons'>Normal</label>
                            <input type='radio' name='balloon' id='delux_balloons' value='delux_balloons' style='width: 25px;' required>
                            <label for='delux_balloons'>Delux</label>
                            <!-- <br> -->
                            <input type='radio' name='balloon' id='royal_balloons' value='royal_balloons' style='width: 25px;' required>
                            <label for='royal_balloons'>Royal</label>
                            <input type='radio' name='balloon' id='no_balloons' value='no' style='width: 25px;' required>
                            <label for='no_balloons'>None</label>
                        </div>
                    </div>

                    <br><br>

                    <label for='seating' style='font-size:20px'><strong>Seating</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <label for='sofa'><img src='images/sofas.jpeg' width="150" height="150"></label>
                                <br>
                            <input type='radio' name='seating' id='sofa' value='sofa' style='width: 25px;' required>
                            Sofa
                        </div>
                        <div class='t1'>
                            <label for='chair'><img src='images/chairs.jpeg' width="150" height="150"></label>
                                <br>
                            <input type='radio' name='seating' id='chair' value='chair' style='width: 25px;' required>
                            Chair
                        </div>
                        <div class='t1'>
                            <label for='sofa_and_chair'><img src="images/sofa_chair.jpeg" width="150" height="150"></label>
                                <br>
                            <input type='radio' name='seating' id='sofa_and_chair' value='sofa_and_chair' style='width: 25px;' required>
                            Both
                        </div>
                    </div>

                    <br><br>

                       
                    
                <h2 style="color:rgb(141, 4, 4);text-align:center">Other Services</h2>
                    <br>

                    <label for='photographer'>Do you need photographer ?</label>
                        <br><br>
                    <div id='content_book'>
                        <img src='images/photographer.png' width='150' height='150'>
                            <br>
                        <div class='t1'>
                            <input type='radio' name='photographer' id='photographer_yes' value='photographer_yes' 
                            style='width: 25px;' required>
                            <label for='photographer_yes'>Yes</label>
                        </div>
                        <div class='t1'>
                            <input type='radio' name='photographer' id='no' value='photographer_no' 
                            style='width: 25px;' required>
                            <label for='photographer_no'>No</label>
                        </div>
                    </div>

                    <br>

                    <label for='band'>Do you need a band ?</label>
                        <br><br>
                    <div id='content_book'>
                        <img src='images/band.jpeg' width='150' height='150'>
                           <br>
                        <div class='t1'>
                            <input type='radio' name='band' id='band_yes' value='band_yes' style='width: 25px;' required>
                            <label for='band_yes'>Yes</label>
                        </div>
                        <div class='t1'>
                            <input type='radio' name='band' id='band_no' value='no' style='width: 25px;' required>
                            <label for='band_no'>No</label>
                        </div>
                    </div>

                    <br>

                    <label for='mehandhi'>Do you need mehandhi ?</label>
                            <br><br>
                    <div id='content_book'>
                        <img src='images/mehandhi.jpeg' width='150' height='150'>
                            <br>
                        <div class='t1'>
                            <input type='radio' name='mehandhi' id='mehandhi_yes' value='mehandhi_yes' style='width: 25px;' required>
                            <label for='mehandhi_yes'>Yes</label>
                        </div>
                        <div class='t1'>
                            <input type='radio' name='mehandhi' id='mehandhi_no' value='no' style='width: 25px;' required>
                            <label for='mehandhi_no'>No</label>
                        </div>
                    </div>

                    <br><br> 

                        <button name='book' type='submit' data-toggle="modal" data-target="#myModal" >Book</button>
                </form>
            </div>
        </section>

        
            
    </body>
</html>