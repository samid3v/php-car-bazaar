<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background-color:#9b1284;">
    <div class="container">
      <a class="navbar-brand" href="#"><i class="fa fa-car p-2">Cars</i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="create_ad.php">Create car ad</a>
          </li>
          <?php 
             if (!logged_in()) {
               

             
          ?>
          <li class="nav-item pr-2">
            <a class="nav-link btn btn-outline-info btn-xs" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-outline-success btn-xs" href="register.php">Register</a>
          </li>
             <?php  } ?>
          <?php 
            if (isset($_SESSION['user_id'])) {
              $user_id = $_SESSION['user_id'];
              $sql ="SELECT * FROM users WHERE id = '$user_id'";
              $result = dbquery($sql);
              if (row_count($result)==1) {
                  $row = fetch_data($result);
                  $user_name = $row['first_name'];
      
                  
            }
          ?>
          <li class="nav-item dropdown">
              <a class="nav-link text-light dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user_name ?></a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="logout.php">logout</a>
                <a class="dropdown-item" href="dashboard.php?user=<?php echo $user_id ?>">Dashboard</a>
                <?php 
        
      } ?>
      <?php 
         if (check_admin()) {
              $admin_name = $_SESSION['admin_name'];
         
       ?>
      
      <a class="dropdown-item" href="admin.php">Admin</a>

      <?php 
        
      } ?>
              </div>
          </li>

                 
        </ul>
      </div>
    </div>
  </nav>