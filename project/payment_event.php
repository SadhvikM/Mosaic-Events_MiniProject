<?php
include('db_connect.php');
include('checklogin.php');

$username = $_SESSION["rainbow_username"];
$user_id = $_SESSION['rainbow_user_id'];

$id_q = "select max(id) as max_event_id from events;";
$event_id_q = $conn->query($id_q);
$res = $event_id_q->fetch_assoc();
$max_event_id = $res['max_event_id']+1;

$id_q2 = "select max(transaction_id) as max_trans_id from transaction;";
$trans_id_q = $conn->query($id_q2);
$res2 = $trans_id_q->fetch_assoc();
$max_trans_id = $res2['max_trans_id']+1;

$id = $_GET['id'];

$sql1 = "SELECT * FROM temp where event_id = '".$id."'";
$q1 = $conn->query($sql1);
$temp = $q1->fetch_assoc();

$arr1 = array('name', 'description', 'category', 'start_date', 'end_date', 'number_of_guests','venue');
$arr4 = array('$name', '$description', '$category', '$start_date', '$end_date','$guests','$venue');

$arr2 = array('type', 'diet', 'water', 'sweets', 'snacks_and_drinks', 'ice_cream');
$arr5 = array('$type', '$diet', '$water','$sweets', '$snacks_and_drinks', '$iceC');

$arr3 = array('lights', 'flowers', 'balloons', 'seating');
$arr6 = array('$light', '$flower', '$balloon', '$seating');

$arr7 = array('mehandhi', 'photographs', 'band');
$arr8 = array('$mehandhi', '$photographer', '$band');

    $i = 0;

    for($i=0;$i<sizeof($arr1);$i++){
        $arr4[$i] = $temp[$arr1[$i]];
    }   

    for($i=0;$i<sizeof($arr2);$i++){
        $arr5[$i] = $temp[$arr2[$i]];
    }

    for($i=0;$i<sizeof($arr3);$i++){
        $arr6[$i] = $temp[$arr3[$i]];
    }

    for($i=0;$i<sizeof($arr7);$i++){
        $arr8[$i] = $temp[$arr7[$i]];
    }


    $total_cost = $temp['total_cost'];

if(isset($_POST['cancel']))
{
    $sql6 = "DELETE FROM `temp` WHERE event_id = '".$id."'";
    $q6 = $conn->query($sql6);
    echo '<script type="text/javascript">alert("Event Cancelled.");</script>';
    header('location: book_an_event.php');
}

if(isset($_POST['confirm_event']))
{

    $paid_amount = 0.4*$temp['total_cost'];
    $total_cost = $temp['total_cost'];

    $card_number = $_POST['card_number'];
    $card_holder_name = $_POST['card_holder_name'];
    $expiration_month = $_POST['exp_mm'];
    $expiration_year = $_POST['exp_yy'];

            $sql5 = "INSERT INTO `events` (id,username,name, description, category, start_date, end_date, number_of_guests, venue,total_cost) 
            VALUES ('$max_event_id','$username','$arr4[0]', '$arr4[1]', '$arr4[2]', '$arr4[3]', '$arr4[4]','$arr4[5]','$arr4[6]','$total_cost')";
            $q = $conn->query($sql5);

            $sql2 = "INSERT INTO `catering`(user_id,event_id, type, diet, water, sweets, snacks_and_drinks, ice_cream) 
            VALUES ('$user_id','$max_event_id','$arr5[0]', '$arr5[1]', '$arr5[2]','$arr5[3]', '$arr5[4]', '$arr5[5]')";
            $q2 = $conn->query($sql2);

            $sql3 = "INSERT INTO `decorations`(user_id, event_id, lights, flowers, balloons, seating)
            VALUES ('$user_id','$max_event_id','$arr6[0]', '$arr6[1]', '$arr6[2]', '$arr6[3]')";
            $q3 = $conn->query($sql3);

            $sql4 = "INSERT INTO `other_service`(user_id, event_id, mehandhi, photographs, band)
            VALUES ('$user_id','$max_event_id','$arr8[0]', '$arr8[1]', '$arr8[2]')";
            $q4 = $conn->query($sql4);

            $sql5 = "INSERT INTO `transaction`(transaction_id, event_id, user_id, user_name, card_number,card_holder_name, expiration_month, expiration_year, total_amount, paid_amount)
            VALUES ('$max_trans_id','$max_event_id','$user_id', '$username', '$card_number','$card_holder_name','$expiration_month', '$expiration_year','$total_cost', '$paid_amount')";
            $q5 = $conn->query($sql5);

            $sql6 = "DELETE FROM `temp` WHERE event_id = '".$max_event_id."'";
            $q6 = $conn->query($sql6);

            echo '<script type="text/javascript">alert("Event Successfully Booked.");</script>';

            echo '<script type="text/javascript">window.location = "book_an_event.php";</script>';


}




?>

<!DOCTYPE html>
<html>
    <head>
        <title>Payment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" readonly>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="paymentstyles.css">
        <link rel="stylesheet" href="cssstyle.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


    </head>

    <style>
        section {
            width:100%;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .t1 {
            padding:15px;
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

        
        <section>
            <div>
            <?php if (isset($fmsg)) { ?><center><div class="alert alert-success" role="alert" 
                style='width: 50%;text-align:center;'> <?php echo $fmsg; ?> </div></center><?php } ?>


                <form method="post" enctype="multipart/form-data">
					<div class="form-group" >
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="<?php echo $temp['name']; ?>" readonly />
					</div>
					<div class="form-group">
						<label>New description</label>
						<input type="text" class="form-control" name="description" value="<?php echo $temp['description']; ?>" readonly />
					</div>
					<div class="form-group">
						<label>Category</label>
						<select name="category">
                            <option value="<?= $temp['category'] ?>"><?= $temp['category'] ?></option>
						</select>
					</div>
					<div class="form-group">
						<label>Start Date</label>
						<input type="date" class="form-control" name="start_date" value="<?php echo $temp['start_date']; ?>" readonly/>
					</div>
					<div class="form-group">
						<label>End Date</label>
						<input type="date" class="form-control" name="end_date" value="<?php echo $temp['end_date']; ?>" readonly/>
					</div>
                    <div class="form-group">
						<label>Number of Guests</label>
						<input type="number" class="form-control" name="number_of_guests" 
                        value="<?php echo $temp['number_of_guests']; ?>" readonly/>
					</div>
                    <div class="form-group">
						<label>Venue</label>
                        <select name="venue">
                            <option value="<?= $temp['venue'] ?>"><?= $temp['venue'] ?></option>
						</select>
					</div>
                    
				

				
                <?php 
                    $ty=$temp['type'];
                    $typ= ['buffet'=>'', 'seating'=> '', 'buffet_and_seating'=>''];
                    $typ[$ty] = 'checked';

                    $di = $temp['diet'];
                    $diet = ['veg'=>'', 'nonveg'=>'', 'veg_and_nonveg'=>''];
                    $diet[$di] = 'checked';

                    $wa = $temp['water'];
                    $wat = ['normal_water'=>'', 'cool_water'=>'', 'cool_and_normal_water'=>''];
                    $wat[$wa] = 'checked';

                    $sw = $temp['sweets'];
                    $swe = ['sweets_yes'=>'', 'no'=>''];
                    $swe[$sw] = 'checked';

                    $sd = $temp['snacks_and_drinks'];
                    $sds = ['snacks_and_drinks_yes'=>'', 'no'=>''];
                    $sds[$sd] = 'checked';

                    $ic = $temp['ice_cream'];
                    $iceC = explode(' ',$ic);
                    $ice = ['vanilla'=>'', 'chocolate'=>'', 'strawberry'=>'', 'butterscotch'=>'', 'blackcurrent'=>'', 'pistachio'=>''];
                    if(!empty($iceC)) {
                        foreach($iceC as $i) {
                            $ice[$i] = 'checked';
                        }
                    }
                ?>

            <br>
				<h2 class="my-4">Catering Details</h2>

                        <label for='type' style='font-size:20px'><strong>Type</strong></label>
                            <br><br>
                        <div id='content_book'>
                            <div class='t1'>
                            <label for='buffet'><img src='images/buffet.jpeg' width="150" height="150"  onclick="return false;"></label>
                                    <br>
                                <input type='radio' name='type' id='buffet' 
                                <?php echo $typ['buffet']?> value='buffet' style='width: 25px;' onclick="return false;">
                                Buffet
                            </div>
                            <div class='t1'>
                                <label for='seating'><img src='images/seating.jpeg' width="150" height="150"  onclick="return false;"></label>
                                    <br>
                                <input type='radio' name='type' id='seating' 
                                <?php echo $typ['seating']?> value='seating' style='width: 25px;' onclick="return false;">
                                Seating
                            </div>
                            <div>
                                <label for='buffet_and_seating'><img src="images/buffet_seating.jpeg" width="150" height="150"  onclick="return false;"></label>
                                    <br>
                                <input type='radio' name='type' id='buffet_and_seating' 
                                <?php echo $typ['buffet_and_seating']?> value='buffet_and_seating' 
                                style='width: 25px;' onclick="return false;">
                                Both
                            </div>
                        </div>

                        <br><br>
                        
                        <label for='diet' style='font-size:20px'><strong>Diet</strong></label>
                            <br><br>

                        <div id='content_book'>
                            <div class='t1'>
                                <label for='veg'><img src='images/veg.jpg' width="150" height="150"  onclick="return false;">
                            </label>
                                    <br>
                                <input type='radio' name='diet' id='veg' 
                                <?php echo $diet['veg']?> value='veg' style='width: 25px;' onclick="return false;">
                                Veg       
                            </div>
                            <div class='t1'>
                                <label for='nonveg'><img src='images/nonveg.jpeg' width="150" height="150"  onclick="return false;"></label>
                                    <br>
                                <input type='radio' name='diet' id='nonveg' 
                                <?php echo $diet['nonveg']?> value='nonveg' style='width: 25px;' onclick="return false;">
                                Non-veg
                            </div>
                            <div class='t1'>
                                <label for='veg_and_nonveg'><img src='images/veg_nonveg.jpeg' width="150" height="150"  onclick="return false;"></label>
                                    <br>
                                <input type='radio' name='diet' id='veg_and_nonveg'
                                <?php echo $diet['veg_and_nonveg']?>  value='veg_and_nonveg' style='width: 25px;' 
                                onclick="return false;">
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
                                <input type='radio' name='water' id='cool_water' 
                                <?php echo $wat['cool_water']?> value='cool_water' style='width: 25px;' onclick="return false;">
                                <label for='cool_water'  onclick="return false;">Cool</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='water' id='normal_water' 
                                <?php echo $wat['normal_water']?> value='normal_water' style='width: 25px;' onclick="return false;">
                                <label for='normal_water'  onclick="return false;">Normal</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='water' id='cool_and_normal_water' 
                                <?php echo $wat['cool_and_normal_water']?> value='cool_and_normal_water' style='width: 25px;' onclick="return false;">
                                <label for='cool_and_normal_water'  onclick="return false;">Both</label>
                            </div>
                        </div>

                        <br><br>

                        <label for='sweets' style='font-size:20px'><strong>Sweets</strong></label>
                            <br><br>
                        <img src='images/sweets.jpeg' width='150' height='150'>
                            <br>
                        
                        <div id='content_book'>
                            <div class='t1'>
                                <input type='radio' name='sweets' id='sweets_yes' 
                                <?php echo $swe['sweets_yes']?> value='sweets_yes' style='width: 25px;' onclick="return false;">
                                <label for='sweets_yes' onclick="return false;">Yes</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='sweets' id='sweets_no' 
                                <?php echo $swe['no']?> value='no' style='width: 25px;' onclick="return false;">
                                <label for='sweets_no' onclick="return false;">No</label>
                            </div>
                        </div>

                        <br><br>

                        <label for='snacks_and_drinks' style='font-size:20px'><strong>Snacks and Drinks</strong></label>
                            <br><br>
                        <img src='images/snacks_drinks.jpeg' width='150' height='150'>
                            <br>
                        
                        <div id='content_book'>
                            <div class='t1'>
                                <input type='radio' name='snacks_and_drinks' id='snacks_and_drinks_yes' 
                                <?php echo $sds['snacks_and_drinks_yes']?> value='snacks_and_drinks_yes' 
                                style='width: 25px;' onclick="return false;">
                                <label for='snacks_and_drinks_yes' onclick="return false;">Yes</label>
                            </div>
                            <div class='t1'>
                                <input type='radio' name='snacks_and_drinks' id='snacks_and_drinks_no' 
                                <?php echo $sds['no']?> value='no' 
                                style='width: 25px;' onclick="return false;">
                                <label for='snacks_and_drinks_no' onclick="return false;">No</label>
                            </div>
                        </div>

                        <br><br>

                        <label for='icecream' style='font-size:20px'><strong>Ice cream</strong></label>
                            <br><br>
                        
                        <div id='content_book'>
                            <div class='t1'>
                                <img src='images/icecream.jpeg' width='150' heigth='150'>
                                <br>
                                <br>
                                <input type='checkbox' name='icecream[]' id='chocolate' 
                                <?php echo $ice['chocolate']?> value='chocolate' style='width: 25px;' onclick="return false;">
                                <label for='chocolate' onclick="return false;">Chocolate</label>
                                <input type='checkbox' name='icecream[]' id='vanilla' 
                                <?php echo $ice['vanilla']?> value='vanilla' style='width: 25px;' onclick="return false;">
                                <label for='vanilla' onclick="return false;">Vanilla</label>
                                <input type='checkbox' name='icecream[]' id='strawberry' 
                                <?php echo $ice['strawberry']?> value='strawberry' style='width: 25px;' onclick="return false;">
                                <label for='strawberry' onclick="return false;">Strawberry</label>
                                <br>
                                <input type='checkbox' name='icecream[]' id='butterscotch' 
                                <?php echo $ice['butterscotch']?> value='butterscotch' style='width: 25px;' onclick="return false;">
                                <label for='butterscotch' onclick="return false;">Butter scotch</label>
                                <input type='checkbox' name='icecream[]' id='blackcurrent' 
                                <?php echo $ice['blackcurrent']?> value='blackcurrent' style='width: 25px;' onclick="return false;">
                                <label for='blackcurrent' onclick="return false;">Black current</label>
                                <input type='checkbox' name='icecream[]' id='pistachio' 
                                <?php echo $ice['pistachio']?> value='pistachio' style='width: 25px;' onclick="return false;">
                                <label for='pistachio' onclick="return false;">Pistachio</label>
                            </div>
                        </div>
                        
                    



                <?php 
                    $li=$temp['lights'];
                    $lig= ['normal_lights'=>'', 'delux_lights'=> '', 'royal_lights'=>'', 'no'=>''];
                    $lig[$li] = 'checked';

                    $fl = $temp['flowers'];
                    $flo = ['normal_flowers'=>'', 'delux_flowers'=>'', 'royal_flowers'=>'', 'no'=>''];
                    $flo[$fl] = 'checked';

                    $ba = $temp['balloons'];
                    $bal = ['normal_balloons'=>'', 'delux_balloons'=>'', 'royal_balloons'=>'', 'no'=>''];
                    $bal[$ba] = 'checked';

                    $seat = $temp['seating'];
                    $seats = ['sofa'=>'', 'chair'=>'', 'sofa_and_chair'=>''];
                    $seats[$seat] = 'checked';
                ?>


            <br>
				<h2 class="my-4">Decoration Details</h2>
            <br>

                        <label for='light' style='font-size:18px'><strong>Lightnings</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <img src='images/lighting.jpg' width="150" height="150">
                            <br>
                            <br>
                            <input type='radio' name='light' id='normal_lights'
                            <?php echo $lig['normal_lights']?> value='normal_lights' style='width: 25px;' onclick="return false;">
                            <label for='normal_lights' onclick="return false;">Normal</label>
                            <input type='radio' name='light' id='delux_lights' 
                            <?php echo $lig['delux_lights']?> value='delux_lights' style='width: 25px;' onclick="return false;">
                            <label for='delux_lights' onclick="return false;">Delux</label>
                            <!-- <br> -->
                            <input type='radio' name='light' id='royal_lights' 
                            <?php echo $lig['royal_lights']?> value='royal_lights' style='width: 25px;' onclick="return false;">
                            <label for='royal_lights' onclick="return false;">Royal</label>
                            <input type='radio' name='light' id='no_lights' 
                            <?php echo $lig['no']?> value='no' style='width: 25px;' onclick="return false;">
                            <label for='no_lights' onclick="return false;">None</label>
                        </div>
                    </div>

                    <br><br>

                    <label for='flower' style='font-size:18px'><strong>Flowers</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <img src='images/flower.jpeg' width="150" height="150">
                            <br>
                            <br>
                            <input type='radio' name='flower' id='normal_flowers'
                            <?php echo $flo['normal_flowers']?> value='normal_flowers' style='width: 25px;' onclick="return false;">
                            <label for='normal_flowers' onclick="return false;">Normal</label>
                            <input type='radio' name='flower' id='delux_flowers' 
                            <?php echo $flo['delux_flowers']?> value='delux_flowers' style='width: 25px;' onclick="return false;">
                            <label for='delux_flowers' onclick="return false;">Delux</label>
                            <!-- <br> -->
                            <input type='radio' name='flower' id='royal_flowers' 
                            <?php echo $flo['royal_flowers']?> value='royal_flowers' style='width: 25px;' onclick="return false;">
                            <label for='royal_flowers' onclick="return false;">Royal</label>
                            <input type='radio' name='flower' id='no_flowers' 
                            <?php echo $flo['no']?> value='no' style='width: 25px;' onclick="return false;">
                            <label for='no_flowers' onclick="return false;">None</label>
                        </div>
                    </div>

                    <br><br>                     

                    <label for='balloon' style='font-size:18px'><strong>Balloons</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <img src='images/balloon.jpeg' width="150" height="150">
                            <br>
                            <br>
                            <input type='radio' name='balloon' id='normal_balloons' 
                            <?php echo $bal['normal_balloons']?> value='normal_balloons' style='width: 25px;' onclick="return false;">
                            <label for='normal_balloons' onclick="return false;">Normal</label>
                            <input type='radio' name='balloon' id='delux_balloons' 
                            <?php echo $bal['delux_balloons']?> value='delux_balloons' style='width: 25px;' onclick="return false;">
                            <label for='delux_balloons' onclick="return false;">Delux</label>
                            <!-- <br> -->
                            <input type='radio' name='balloon' id='royal_balloons' 
                            <?php echo $bal['royal_balloons']?> value='royal_balloons' style='width: 25px;' onclick="return false;">
                            <label for='royal_balloons' onclick="return false;">Royal</label>
                            <input type='radio' name='balloon' id='no_balloons' 
                            <?php echo $bal['no']?> value='no' style='width: 25px;' onclick="return false;">
                            <label for='no_balloons' onclick="return false;">None</label>
                        </div>
                    </div>

                    <br><br>

                    <label for='seating' style='font-size:20px'><strong>Seating</strong></label>
                        <br><br>
                    <div id='content_book'>
                        <div class='t1'>
                            <label for='sofa'><img src='images/sofas.jpeg' width="150" height="150" onclick="return false;"></label>
                                <br>
                            <input type='radio' name='seating' id='sofa' 
                            <?php echo $seats['sofa']?> value='sofa' style='width: 25px;' onclick="return false;">
                            Sofa
                        </div>
                        <div class='t1'>
                            <label for='chair'><img src='images/chairs.jpeg' width="150" height="150" onclick="return false;"></label>
                                <br>
                            <input type='radio' name='seating' id='chair'
                            <?php echo $seats['chair']?> value='chair' style='width: 25px;' onclick="return false;">
                            Chair
                        </div>
                        <div class='t1'>
                            <label for='sofa_and_chair'><img src="images/sofa_chair.jpeg" width="150" height="150" onclick="return false;"></label>
                                <br>
                            <input type='radio' name='seating' id='sofa_and_chair' 
                            <?php echo $seats['sofa_and_chair']?> value='sofa_and_chair' style='width: 25px;' onclick="return false;">
                            Both
                        </div>
                    </div>

                

				
                <?php 
                    $photo=$temp['photographs'];
                    $photos= ['photographer_yes'=>'', 'no'=> ''];
                    $photos[$photo] = 'checked';

                    $ba = $temp['band'];
                    $bandd = ['band_yes'=>'', 'no'=>''];
                    $bandd[$ba] = 'checked';

                    $me = $temp['mehandhi'];
                    $meh = ['mehandhi_yes'=>'', 'no'=>''];
                    $meh[$me] = 'checked';
                ?>
        
            <br>
                <h2 class="my-4">Other Services</h2>
            <br>

                    <label for='photographer'>Do you need photographer ?</label>
                        <br><br>
                    <div id='content_book'>
                        <img src='images/photographer.png' width='150' height='150'>
                            <br>
                        <div class='t1'>
                            <input type='radio' name='photographer' id='photographer_yes' 
                            <?php echo $photos['photographer_yes']?> value='photographer_yes' 
                            style='width: 25px;' onclick="return false;">
                            <label for='photographer_yes' onclick="return false;">Yes</label>
                        </div>
                        <div class='t1'>
                            <input type='radio' name='photographer' id='photographer_no' 
                            <?php echo $photos['no']?> value='no' 
                            style='width: 25px;' onclick="return false;">
                            <label for='photographer_no' onclick="return false;">No</label>
                        </div>
                    </div>

                    <br>

                    <label for='band'>Do you need a band ?</label>
                        <br><br>
                    <div id='content_book'>
                        <img src='images/band.jpeg' width='150' height='150'>
                           <br>
                        <div class='t1'>
                            <input type='radio' name='band' id='band_yes'
                            <?php echo $bandd['band_yes']; ?> value='band_yes' style='width: 25px;' onclick="return false;">
                            <label for='band_yes' onclick="return false;">Yes</label>
                        </div>
                        <div class='t1'>
                            <input type='radio' name='band' id='band_no'
                            <?php echo $bandd['no']; ?> value='no' style='width: 25px;' onclick="return false;">
                            <label for='band_no' onclick="return false;">No</label>
                        </div>
                    </div>

                    <br>

                    <label for='mehandhi'>Do you need mehandhi ?</label>
                            <br><br>
                    <div id='content_book'>
                        <img src='images/mehandhi.jpeg' width='150' height='150'>
                            <br>
                        <div class='t1'>
                            <input type='radio' name='mehandhi' id='mehandhi_yes'
                            <?php echo $meh['mehandhi_yes']; ?> value='mehandhi_yes' style='width: 25px;' onclick="return false;">
                            <label for='mehandhi_yes' onclick="return false;">Yes</label>
                        </div>
                        <div class='t1'>
                            <input type='radio' name='mehandhi' id='mehandhi_no' 
                            <?php echo $meh['no']; ?> value='mehandhi_no' style='width: 25px;' onclick="return false;">
                            <label for='mehandhi_no' onclick="return false;">No</label>
                        </div>
                    </div>

                    <br><br>

                        <button name='cancel' type='submit' class="btn btn-danger" >Cancel</button>

                        <button name='book' type='button' data-toggle="modal" data-target="#myModal" class="btn btn-success" >Book</button>
                </form>
            </div>
        </section>

        
            <!-- Modal1 -->
			<div class="modal fade" id="myModal" role="dialog" style='overflow-y:visible;'>
				<div class="modal-dialog">
								
					<div class="modal-content">
						<div class="modal-header">
			    			<h5 class="modal-title">Payment Details</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Are you sure?</p>
						</div>
                        <div class='container'>
                            <h4>Total Event Cost</h4>
                            <?php 
                                echo number_format($total_cost, 2, '.', ',').' Rupees';
                            ?>
                            <br>
                            <br>
                            <br>
                            <h4>Amount to be paid now</h4>
                            <h5>(Advance Amount)</h5>
                            <?php 
                                echo number_format(0.4*$total_cost, 2, '.', ',').' Rupees';
                            ?>
                        </div>
                        <form enctype="multipart/form-data" method='post' style='border:none;' >
						<div class="modal-footer">
							<button name='cancel' type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>

							<button type="submit" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#myModal2" name='pay_proceed'>Yes, Proceed</button>
                		</div>
                        </form>
					</div>
							
				</div>
			</div>




            <!-- Modal2 -->
            <div class="modal fade" id="myModal2" role="dialog" style='overflow-y:visible;'>
				<div class="modal-dialog">
								
					<!-- Modal content-->
					<div class="modal-content">
						<div class="modal-header">
			    			<h5 class="modal-title">Confirm Event</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Are you sure?</p>
						</div>
                        <div class="container">
                        <br>

                            <div class="card-container">

                                <div class="front">
                                    <div class="image">
                                        <img src="images/chip.png" alt="">
                                        <img src="images/visa.png" alt="">
                                    </div>
                                    <div class="card-number-box">################</div>
                                    <div class="flexbox">
                                        <div class="box">
                                            <span>card holder</span>
                                            <div class="card-holder-name">full name</div>
                                        </div>
                                        <div class="box">
                                            <span>expires</span>
                                            <div class="expiration">
                                                <span class="exp-month">mm</span>
                                                <span class="exp-year">yy</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="back">
                                    <div class="stripe"></div>
                                    <div class="box">
                                        <span>cvv</span>
                                        <div class="cvv-box"></div>
                                        <img src="images/visa.png" alt="">
                                    </div>
                                </div>

                            </div>

                            <br>

                            <form enctype="multipart/form-data" method='post' style='border:none;'>
                                <div class="inputBox">
                                    <span>card number</span>
                                    <input type="text" maxlength="16" class="card-number-input" name='card_number' required>
                                </div>
                                <div class="inputBox">
                                    <span>card holder</span>
                                    <input type="text" class="card-holder-input" name='card_holder_name' required>
                                </div>
                                    <div class="inputBox">
                                        <span>expiration mm</span><br>
                                        <select id="" class="month-input" name='exp_mm' required>
                                            <option value="month" selected disabled>month</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                    <div class="inputBox">
                                        <span>expiration yy</span><br>
                                        <select id="" class="year-input" name='exp_yy' required>
                                            <option value="year" selected disabled>year</option>
                                            <option value="2021">2021</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2030">2030</option>
                                        </select>
                                    </div>
                                    <div class="inputBox">
                                        <span>cvv</span>
                                        <input type="text" maxlength="3" class="cvv-input" name='cvv' required>
                                    </div>

                                    <div class="modal-footer">
                                        <button name='cancel' type="submit" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <button type="submit" name='confirm_event' class="btn btn-success" >Book Event</button>
                                    </div>
                            </form>

                        </div>    
                            

                        <script>

                        document.querySelector('.card-number-input').oninput = () =>{
                            document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
                        }

                        document.querySelector('.card-holder-input').oninput = () =>{
                            document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
                        }

                        document.querySelector('.month-input').oninput = () =>{
                            document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
                        }

                        document.querySelector('.year-input').oninput = () =>{
                            document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
                        }

                        document.querySelector('.cvv-input').onfocus = () =>{
                            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
                            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
                        }

                        document.querySelector('.cvv-input').onblur = () =>{
                            document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
                            document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
                        }

                        document.querySelector('.cvv-input').oninput = () =>{
                            document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
                        }

                        </script>

						
					</div>
							
				</div>
			</div>
    </body>
</html>