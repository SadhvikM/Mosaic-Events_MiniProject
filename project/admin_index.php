<?php
include('db_connect.php');
include('checklogin.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="w3-css.css">
        <link rel="stylesheet" href="cssstyle.css">
        <style>
            .container-fluid {
                padding: 0 30px 25px;
            }
            .f-s-40 {
                font-size: 40px !important;
            }
            .m-b-0 {
                margin-bottom: 0px !important;
                font-size:18px;
            }
            .p-30 {
                padding: 30px !important;
                margin:15px 0;
            }
            .media-text-right {
                text-align: right;
            }
            .media-text-left {
                text-align: left;
            }
            .media-body h2 {
                color:rgb(144,4,4);
            }
        </style>
    </head>
   
    <body id="body">
    
        <header >
            <div class="navigation w3-highway-red w3-container">
                <nav class="nav-container w3-padding-large">
                    <div class="logo">
                        <a href="admin_index.php" >MOSAIC <span>EVENTS</span></a>
                    </div>
                    <div class="mobile-button">
                        <span style="float: right;" onclick="toggleMobileNavigation()">&#9776;</span>
                    </div>
                    <div class="links">
                        <a href='venues/view.php' class='lnk'>Venues</a>
                        <a href='event/view.php' class='lnk'>Events</a>
                        <a href='category/view.php' class='lnk'>Categories</a>
                        <a href="logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>           
                    </div>

                    <div id="mobile-sidenav" class="mobile-links">
                        <div class="mobile-logo" style="display: inline-block;">
                            <a href="admin_index.php" class="logo">MOSAIC <span>EVENTS</span></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
                        </div>
                            <a href='venues/view.php' class='lnk'>Venues</a>
                            <a href='event/view.php' class='lnk'>Events</a>
                            <a href='category/view.php' class='lnk'>Categories</a>
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


        <div style = "padding:15px 0;">

            <div style="padding:15px 35px;">
                <h3>Admin Dashboard</h3>
            </div>

          <hr>

            <div class="container-fluid" style="height:455px;">
                <div class="row">

                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle">
                                    <span><i class="fa fa-shopping-cart f-s-40 color-danger"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                   <h2><?php $sql="SELECT * from  events" ;
											  $q = $conn->query($sql);
											  $rws=mysqli_num_rows($q);
											  echo $rws;?></h2>
                                    <p class="m-b-0">Total Events</p>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle"> 
                                <?php $sql="SELECT * from events where status=''" ;
									$q = $conn->query($sql);
						    		$rws=mysqli_num_rows($q);
                                ?>
                                    <span><i class="fa fa-spinner f-s-40
                                    <?php
                                        if($rws>0){
                                    ?>
                                    <?php
                                        echo 'fa-spin';
                                        }
                                    ?>
                                     "></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php echo $rws;?></h2>
                                    <p class="m-b-0">Pending Events</p>
                                </div>
                            </div>
                        </div>
                    </div>	

                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle"> 
                                    <span><i class="fa fa-check f-s-40" aria-hidden="true"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php $sql="SELECT * from events where status = 'approved'" ;
											  $q = $conn->query($sql);
											  $rws=mysqli_num_rows($q);
											  echo $rws;?></h2>
                                    <p class="m-b-0">Approved Events</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle"> 
                                    <span><i class="fa fa-times f-s-40" aria-hidden="true"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php $sql="SELECT * from events where status = 'cancelled'" ;
											  $q = $conn->query($sql);
											  $rws=mysqli_num_rows($q);
											  echo $rws;?></h2>
                                    <p class="m-b-0">Cancelled Events</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card p-30">
                            <div class="media">
                                <div class="media-left meida media-middle"> 
                                    <span><i class="fa fa-check-circle f-s-40" aria-hidden="true"></i></span>
                                </div>
                                <div class="media-body media-text-right">
                                    <h2><?php $sql="SELECT * from events where status = 'Completed'" ;
											  $q = $conn->query($sql);
											  $rws=mysqli_num_rows($q);
											  echo $rws;?></h2>
                                    <p class="m-b-0">Completed Events</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            				
        </div>

    </body>
</html>