<?php include("inc/header.php");  ?>
<style>
  #slides{
    min-height: 300px;
  }
</style>

  <!-- Navigation -->
<body>

  <?php include("inc/nav.php"); 
  
  
  ?>
 

  <!-- End Navigation -->

  
  <div class="container cont">
  <?php success_message();  
  
  ?>

    <div class="row">

      <div class="col-lg-3" id="sider">
      <div id="title">
          <h1 class="text-light">Filter Search</h1>
      </div>
      <?php error_message(); ?>

        <form action="" method="post">
            <div class="form-group">
                <select name="brand" id="brand" class="form-control">
                  <?php 
                  $sql = "SELECT * FROM car_ad";
                  $result = dbquery($sql);

                  while ($row = mysqli_fetch_array($result)) {
                      $brand = $row['brand'];
                  
                
                  ?>
                <option value="<?php echo $brand ?>"><?php echo $brand ?></option>
                <?php }
            
                ?>
                </select>
            </div>
            <div class="form-group">
                <input type="number" name="price" class="form-control" placeholder="enter price">
            </div>
            <div class="form-group">
                <input type="submit" name="filter" class="btn btn-info btn-block" value="filter search">
            </div>
        </form>
        
      
      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="slider" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div id="slides" class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="imgs/1.jpg" alt="First slide" width="100%" height="300px">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="imgs/sedan.jpg" alt="Second slide" width="100%" height="300px">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="imgs/suv.jpg" alt="Third slide" width="100%" height="300px">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">
        <?php 
          if ($_SERVER['REQUEST_METHOD']=='POST') {
             $brand = $_POST['brand'];
             $price = $_POST['price'];
          
           $sql = "SELECT * FROM car_ad WHERE brand = '$brand' AND price >= '$price' ";
           $result = dbquery($sql);

           while ($row = mysqli_fetch_array($result)) {
             
           
        
        ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-10">
              <a href="#"><img class="card-img-top" src="<?php echo $row['preview'] ?>" alt=""></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#"><?php echo $row['brand'] ?></a>
                </h4>
                <h5><?php echo $row['price'] ?></h5>
                
                <a href="car_details.php?vehicle=<?php echo $row['slug']; ?>" class="btn btn-large btn-block btn-info">More Info</a>
              </div>
            </div>
          </div>

           <?php
            }
          } else{ 
           ?>

        <?php 
           $sql = "SELECT * FROM car_ad";
           $result = dbquery($sql);

           while ($row = mysqli_fetch_array($result)) {
             
           
        
        ?>
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-10">
              <a href="#"><img class="card-img-top" src="<?php echo $row['preview'] ?>" alt="" height="200px"></a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#"><?php echo $row['brand'] ?></a>
                </h4>
                <h5><?php echo $row['price'] ?></h5>
                
                <a href="car_details.php?vehicle=<?php echo $row['slug']; ?>" class="btn btn-large btn-block btn-info">More Info</a>
              </div>
            </div>
          </div>

           <?php
            }
          }   
           ?>
        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  

 <?php include("inc/footer.php"); ?>
 