<?php
include('../db_connect.php');
include('../checklogin.php');

$id_q = "select max(venue_id) as max_venue_id from venues;";
$venue_id_q = $conn->query($id_q);
$res = $venue_id_q->fetch_assoc();
$max_id = $res['max_venue_id']+1;


$fmsg = '';
$fmsg_c = 0;
$targetDir="../images/venues/";
// $targetDir = '';
if (isset($_POST) & !empty($_POST) && !empty($_FILES['file']['name'])) 
{
    $fileName= basename($_FILES["file"]["name"]);
    $targetFilePath=$targetDir.$fileName;
    $fileType=pathinfo($targetFilePath,PATHINFO_EXTENSION);
    $allowtypes=array('jpg','png','jpeg');
    if(in_array($fileType,$allowtypes))
    {
        if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath))
        {
            $title=$_POST['title'];
            $fileName = 'images/venues/' . $fileName;
            $sql=$conn->query("INSERT into venues(venue_id,venue_name,venue_dir) VALUES('$max_id','$title','$fileName')");
            if($sql)
            {
                $fmsg="The file ".$fileName. " has been uploaded successfully.";
                $fmsg_c = 1;
            }
            else
            {
                $fmsg="File uploaded failed,please try again.";
            }
        }
        else
        {
            $fmsg="Sorry, there was an error uploading your file.";
        }
    }
    else
    {
        $fmsg="Sorry, only JPG, PNG, JPEG, GIF are allowed to upload.";
    }
}


?>


<!DOCTYPE html>
<html>
    <head>
        <title>Add Venues</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale = 1.0" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../w3-css.css">
        <link rel="stylesheet" href="../cssstyle.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <style>
            
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
                        <a href='view.php' class='lnk active'>Venues</a>
                        <a href='../event/view.php' class='lnk'>Events</a>
                        <a href='../category/view.php' class='lnk'>Categories</a>
                        <a href="../logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>           
                    </div>

                    <div id="mobile-sidenav" class="mobile-links">
                        <div class="mobile-logo" style="display: inline-block;">
                            <a href="../admin_index.php" class="logo">MOSAIC <span>EVENTS</span></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
                        </div>
                            <a href='view.php' class='lnk'>Venues</a>
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
                <?php 
                if(isset($fmsg) && $fmsg!='' && $fmsg_c==0){ ?>
                    <div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div>
                <?php
                    } 
                    if(isset($fmsg) && $fmsg!='' && $fmsg_c==1) 
                    {
                ?>
                        <div class="alert alert-success" role="alert"> <?php echo $fmsg; ?> </div>
                <?php
                    }
                ?>

            <div class="container">
                <h2 class="my-4">Add New Venue</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Venue Name</label>
                        <input type="text" id="id" class="form-control" name="title" value="" required />
                    </div>
                    <div class="form-group">
                        <label>Upload Venue Image</label>
                        <input type="file" id="id" class="form-control" accept="image/*" name="file" value="" />
                    </div>
                    <input type="submit" class="btn btn-primary" value="Add Category" />
                </form>
            </div>
            </div>
        </section>

    </body>
</html>