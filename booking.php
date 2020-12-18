<?php

include("functions/init.php");

if (!logged_in()) {

    $_SESSION["error_message"] = "To view dashboard you must login";
    redirect("login.php");
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
				<?php 
            if ($_SESSION['user_id']) {
              $user_id = $_SESSION['user_id'];
              $sql ="SELECT * FROM users WHERE id = '$user_id'";
              $result = dbquery($sql);
              if (row_count($result)==1) {
                  $row = fetch_data($result);
                  $user_name = $row['first_name'];
      
                  
            }
          ?>
				  <h1><a href="index.html" class="logo"><?php echo $user_name; ?></a></h1>
				  
		<?php } 
		
		?>
	        <ul class="list-unstyled components mb-5">
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
			         <a href="users.php"><span class="fa fa-user mr-3"></span> Messages</a>
				  </li>
				  <li>
			         <a href="booking.php"><span class="fa fa-briefcase mr-3"></span> Bookings</a>
			      </li>
	          
	        </ul>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
	
        <h2 class="mb-4 text-center">CUSTOMISE YOUR ITEMS</h2>
		<div class="card-header"><i class="fa fa-table mr-1"></i><?php success_message();
		error_message();
		
		
		
		?>

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
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>Vehicle</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>

							
											<?php   if (admin()) {
							   $admin =$_SESSION['admin'];
							   $sql = "SELECT * FROM booking";
							   $result = dbquery($sql);
							   while ($row =fetch_data($result)) {
								   $date = $row['date'];
								   $slug = $row['car'];
								   
							   ?>
							   
							   
							   
							   <tr>
								   <td><?php echo $row['car'] ?></td>
								   <td><?php echo $date; ?></td>							   
								   <td class="mt-2">
									   <a href="delete.php?slug=<?php echo $slug ?>"><i class="fa fa-trash text-danger pr-4 fa-2x"></i></a>
								   </td>
								   
							   </tr><?php
											
								   
								}
							}
	
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
      </div>
		</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>