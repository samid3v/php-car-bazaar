<?php include("inc/header.php");  ?>

<style>
  
  #details{
    margin-top: 100px;
}
  #info li i{
    color: rgba(129, 49, 120, 0.8);
}
.sidefo{
  color: rgba(129, 49, 120, 0.8);
}
#messages{
  border-color: #9900cc;
}

#messages::placeholder{
  color: #9900cc;
}
.message{
  width: 50%;
}
</style>
  <!-- Navigation -->
<body>
<div class="modal fade" id="bookmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Road Test Booking</h5>
        <?php error_message(); ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="date.php" method="post">
        <div class="modal-body">         
            <h3 class="text-center" id="modaltitle">Select date available</h3>
                <div class="form-group">
                    <input type="text" id="datepicker" name="date" class="datepicker form-control" placeholder="select date">
                </div>
                  
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-backdrop="static">Close</button>
        <button type="submit" id="book" class="btn btn-primary" name="date" >Book Roadtest</button>
      </div>
      </form> 
  </div>
    </div>
  </div>
</div>
<?php 
if (isset($_SESSION['user_id'])) {
  $user_id      = $_SESSION['user_id'];
}
if (isset($_GET['vehicle'])) {
  $slug = $_GET['vehicle'];

          
          if (logged_in()) {
          

              message($slug);
            }
          }
         
          ?>

  <?php include("inc/nav.php"); 
  
  if (isset($_GET['vehicle'])) {
    $slug = $_GET['vehicle'];

    $sql = "SELECT * FROM car_ad WHERE slug = '$slug'";
    $result = dbquery($sql);

    while ($row=mysqli_fetch_array($result)) {
      $brand = $row['brand'];
      $model = $row['model'];
      $price = $row['price'];
      $mileage = $row['mileage'];
      
      
    
  ?>

<div class="container" id="details">

  <div class="row">
  


    <div class="col-md-8" style="background-color: #ffffff;">
        <div>
          <div id="preview">
              <img class="img-fluid rounded" src="<?php echo $row['preview'] ?>" alt="" width="800px">
          </div>
          <div class="text pt-3">
            <h2 class="text-center sidefo">Vehicle Description</h2>
            <p class="lead"><?php echo $row['description'] ?></p>
          </div>
          <div class="form">

    <?php }}
          if (isset($_GET['vehicle'])) {
            $slug = $_GET['vehicle'];
          
          
            if (logged_in()) {
              $user_id=$_SESSION['user_id'];
              
              $sql = "SELECT slug, userid FROM car_ad WHERE slug='$slug' AND userid='$user_id'";
              $result = dbquery($sql);
              $row = row_count($result);
              if ($row == 0) {
                
            ?>
            <h5 class="card-header sidefo">Contact Seller</h5>
            <?php error_message(); ?>
          <div class="card-body">
          
            <form action=" " method="post">
              <div class="form-group" id="message">
                <textarea name="message" id="messages" class="form-control" placeholder="message......"></textarea>
              </div>
              <button type="submit" name="submit" class="btn btn-success btn-block" >Send message</button>
              
            </form>
          </div>

              <?php }   
              }if (isset($_GET['vehicle'])) {
                $slug = $_GET['vehicle'];
    
                  $sqls = "SELECT messages.message, reply.reply, users.first_name, users.last_name FROM messages INNER JOIN reply ON messages.id = reply.message_id INNER JOIN users ON messages.user_id = users.id WHERE messages.car_slug='$slug'";
                $results = dbquery($sqls);
                ;
                } while ($row =fetch_data($results)) {
                ?>
                <div class="bg-defautl message">
                  <h4 class="lead">asked by:<?php echo $row['first_name'].' '.$row['last_name'] ?> </h4>
                  <p class="align-left"><?php echo $row['message'] ?></p>
                </div>
                <div class="float-right bg-info message mb-5">
                  <h4 class="lead text-light">Replied by:Admin</h4>
                  <p class=" text-light"><?php echo $row['reply'] ?></p>
                </div>

                <?php
                
              }
            }
            ?>
          
          
          
          
          
        </div>
        </div>
    </div>


    <div class="col-md-4" style="background-color: #ffffff;">
        <h2 class="text-center sidefo" id="sidefo">Car Info</h2>
        <button type="button" class="btn btn-outline-info btn-block" data-toggle="modal" data-target="#bookmodal">Book road test</button>
        <div class="details">
        <?php  

            if (isset($_GET['vehicle'])) {
                $slug = $_GET['vehicle'];

                $sql = "SELECT * FROM car_ad WHERE slug = '$slug'";
                $result = dbquery($sql);

                while ($row = mysqli_fetch_array($result)) {


        ?>
            <ul class="list-group" id="info">
                <li class="list-group-item"><i class="fa fa-bold mr-2"></i><?php echo $row['brand'] ?></li>
                <li class="list-group-item"><i class="fa fa-taxi mr-2"></i><?php echo $row['model'] ?></li>
                <li class="list-group-item"><i class="fa fa-money mr-2"></i><?php echo $row['price'] ?></li>
                <li class="list-group-item"><i class="fa fa-tachometer mr-2"></i><?php echo $row['mileage'] ?></li>
                <li class="list-group-item"><i class="fa fa-calendar mr-2"></i><?php echo $row['year'] ?></li>
            </ul>
        </div>
        <?php  } 
        
        
                }?>
                <div id="video">
        <?php  

        if (isset($_GET['vehicle'])) {
            $slug = $_GET['vehicle'];

            $sql = "SELECT * FROM car_video WHERE slug = '$slug'";
            $result = dbquery($sql);

            while ($row = mysqli_fetch_array($result)) {


        ?>
        <h3 class="text-center sidefo">Road test video</h3>
        <video width="400" height="315" controls autoplay>
          <source src="<?php echo $row['video'] ?>" type="video/mp4">
          <source src="<?php echo $row['video'] ?>" type="video/ogg">
        </video>

        <?php  } 
        
        
                }?>
        </div>
        </div>
        
     
    </div>
  </div><!-----end row------->

</div>







<?php include("inc/footer.php"); 
  
  
  ?>