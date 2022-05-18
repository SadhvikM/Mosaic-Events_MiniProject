<?php
include('../db_connect.php');
include('../checklogin.php');

$id_q = "select max(id) as max_category_id from categories;";
$category_id_q = $conn->query($id_q);
$res = $category_id_q->fetch_assoc();
$max_category_id = $res['max_category_id']+1;

if (isset($_POST) & !empty($_POST)) {
    $name = ($_POST['name']);
    $desc = ($_POST['description']);

    // Execute query
    $query = "INSERT INTO `categories` (id,name, description) 
		VALUES ('$max_category_id','$name', '$desc')";
    $res = mysqli_query($conn, $query);
    if ($res) {
        header('location: view.php');
    } else {
        $fmsg = "Failed to Insert data.";
        print_r($res);
    }
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
						<a href='../venues/view.php' class='lnk'>Venues</a>
                        <a href='../event/view.php' class='lnk'>Events</a>
                        <a href='../category/view.php' class='lnk active'>Categories</a>
                        <a href="../logout.php" id="logout"><i class="fa fa-power-off " style="font-size:16px" ></i></a>           
                    </div>

                    <div id="mobile-sidenav" class="mobile-links">
                        <div class="mobile-logo" style="display: inline-block;">
                            <a href="../admin_index.php" class="logo">MOSAIC <span>EVENTS</span></a>
                            <a href="javascript:void(0)" class="closebtn" onclick="toggleMobileNavigation()">&times;</a>
                        </div>
						    <a href='../venues/view.php' class='lnk'>Venues</a>
                            <a href='../events/view.php' class='lnk'>Events</a>
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
            <div class="container">
                <?php if (isset($fmsg)) { ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
                <h2 class="my-4">Add New Category</h2>
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" id="id" class="form-control" name="name" value="" required />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" id="id" class="form-control" name="description" value="" />
                    </div>
                    <input type="submit" class="btn btn-primary" value="Add Category" />
                </form>
            </div>
			</div>
		</section>
    </body>
</html>

