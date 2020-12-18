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
		  		<h1><a href="index.html" class="logo">Car Bazaar</a></h1>
	        <ul class="list-unstyled components mb-5">
			<li class="active">
	            <a href="dashboard.php"><span class="fa fa-dashboard mr-3"></span>Car Dashboard</a>
	          </li>
	          <li class="active">
	            <a href="index.php"><span class="fa fa-home mr-3"></span> Home</a>
	          </li>
	          <li>
	              <a href="create_ad.php"><span class="fa fa-user mr-3"></span> Create car ad</a>
	          </li>
	          <li>
              <a href="users.php"><span class="fa fa-briefcase mr-3"></span> Users</a>
	          </li>
	          
	        </ul>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4 text-center">CUSTOMISE <i class="fa fa-users" aria-hidden="true"></i></h2>
        <div class="card-header"><i class="fas fa-table mr-1"></i>Users Table</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
												<th>Action</th>
                                            </tr>
										</thead>
										<?php  
											$sql ="SELECT * FROM users";
											$result = dbquery($sql);
											while ($row= fetch_data($result)) {
												
											
										?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $row['first_name'] ?></td>
                                                <td><?php echo $row['last_name'] ?></td>
                                                <td><?php echo $row['email'] ?></td>
                                                <td><?php echo $row['phone'] ?></td>
                                                
												
												<td class="mt-2">
													<a href="#"><i class="fa fa-trash text-danger fa-2x"></i></a>
											    </td>
												
                                            </tr>
											<?php } ?>
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