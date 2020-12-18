<?php

include("functions/init.php");
$sql = "SELECT * FROM users WHERE view='admin'";
    $result= dbquery($sql);
    if ($row = fetch_data($result)) {
        $_SESSION['admin_mail']=$row['email'];
        $_SESSION['admin_id']=$row['id'];
        $_SESSION['admin_name']=$row['first_name'].' '.$row['last_name'];
    }
        if ($_SESSION['admin_id']!=$_SESSION['user_id']) {
            redirect('index.php');
        }
    

?>


<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Spinners -Get Your Desired Car </title>

<link rel="stylesheet" href="scss/style.css">
<link rel="stylesheet" href="css/dash.css">
<link href="css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .card-body{
        width: 100%;
    }
</style>

<body>
  <body>
		
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="fa fa-bars"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4">
			
	        <ul class="list-unstyled components mb-5">
            <li class="active">
	            <?php if (isset( $_SESSION['admin_name'])) {
                      $name = $_SESSION['admin_name'];
                 ?>

                <h3 class="text-light"><?php echo $name; ?></h3>

            <?php } ?>
	          </li>
			<li class="active">
	            <a href="dashboard.php"><span class="fa fa-dashboard mr-3"></span>Car Dashboard</a>
	          </li>
	          <li class="active">
	            <a href="index.php"><span class="fa fa-home mr-3"></span> Home</a>
	          </li>
	          <li>
	              <a href="create_ad.php"><span class="fa fa-car mr-3"></span> Create car ad</a>
	          </li>
	          
			
				  <li>
			         <a href="users.php"><span class="fa fa-user mr-3"></span>Users</a>
				  </li>
				  <li>
			         <a href="booking.php"><span class="fa fa-briefcase mr-3"></span> Bookings</a>
			      </li>
				  <li>
			         <a href="message.php"><span class="fa fa-envelope mr-3"></span> Messages</a>
			      </li>
			  
	          
            </ul>

    	</nav>

        <!-- Page Content  -->
      <div id="content" class="container">
	
        <h2 class="mb-4 text-center">CUSTOMISE YOUR ITEMS</h2>
		<div class="card-header">

<?php 
	
			$sql = "SELECT id FROM users";
			$result = dbquery($sql);
			$count = row_count($result);

			$sqli = "SELECT id FROM car_ad";
			$results = dbquery($sqli);
			$counts = row_count($results);

			$sqls = "SELECT id FROM booking";
			$r = dbquery($sqls);
			$rb = row_count($r);
							
?>

	  <div class="row">
		<div class="card bg-success col-sm-3">
			<div class="card-header">
				<h3 class="text-center text-light">users</h3>
				<h3 class="text-light text-center"><?php echo $count ?></h3>
			</div>
		</div>

		<div class="card bg-info col-sm-3 offset-1" >
			<div class="card-header">
				<h3 class="text-center text-light">Car posted</h3>
				<h3 class="text-light text-center"><?php echo $counts ?></h3>
			</div>
		</div>

		<div class="card bg-warning col-sm-3 offset-1">
			<div class="card-header">
				<h3 class="text-center text-light">Bookings</h3>
				<h3 class="text-light text-center"><?php echo $rb ?></h3>
			</div>
		</div>
      </div>
	</div>
      <?php  
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $reply = $_POST['reply'];
                if (isset($_GET['reply'])) {
                    $id = $_GET['reply'];

                }
                if (empty($reply)) {
                    $_SESSION["error_message"] = "error!!!! reply is blank";
                }else{
                    $sql = "INSERT INTO reply(message_id, reply) VALUES($id, '$reply')";
                    $result = dbquery($sql);
                    if ($result) {
                        $_SESSION["success_message"] = "success....reply sent";
                        redirect('message.php');
                    }
                
            }
        }
      ?>

      
        
			<div class="card-body">
                <h2 class="text-center"> Reply to message</h2>
				<form action="" method="post">
                    <div class="form-group">
                        <textarea name="reply" id="reply" cols="30" rows="10" placeholder="reply message"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Reply" name="submit" class="btn btn-info">
                    </div>
                </form>
			</div>
            </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>