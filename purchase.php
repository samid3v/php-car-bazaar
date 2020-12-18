<?php include('inc/header.php') ;

if (!logged_in()) {
   $_SESSION['error_message'] = 'login to purchase your car'; 
   redirect('login.php');
}

?>
<style>
    .card{
        width: 50%;
        margin-top: 100px;
        margin-left: 400px;
        margin-bottom: 50px;
    }
    .card-footer{
        width: 50%;
        margin-left: 400px;
    }
</style>
<?php include('inc/nav.php') ?>
<body>
<div class="card container-sm">
    <?php success_message();  ?>
                            <div class="card-header">
                                <?php 
                                  
                                  $
                                  $sql ="SELECT * FROM buy";
                                  $results =dbquery($sql);
                                  if ($row=mysqli_fetch_array($results)) {
                                      

                                    

                                  
                                
                                ?>
                            

                                  <?php } ?>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <caption><?php echo $_SESSION['user']; ?></caption>
                                        <thead class="bg-info text-light">
                                            <tr>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th>Year</th>
                                                <th>Reg/no</th>
                                                <th>Mileage</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                           <tr>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>Price</th>
                                                <th>Mileage</th>
                                                <th>Reg/no</th>
                                                
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php 
								
                                if (isset($_GET['purchase'])) {
                                        $user = $_GET['purchase'];
                                        $sql ="SELECT * FROM car_ad WHERE slug='$user'";
                                        $results =dbquery($sql);
                                
    
                                    while ($row=mysqli_fetch_array($results)) {
                                
                                    
                                ?>
                                
                                
                                
                                <tr>
                                    <td><?php echo $row['brand'] ?></td>
                                    <td><?php echo $row['model'] ?></td>
                                    <td><?php echo $row['price'] ?></td>
                                    <td><?php echo $row['mileage'] ?></td>
                                    <td><?php echo $row['checkno'] ?></td>
    
                                    
                                </tr>
                                                <?php
                                                 }
                                                
                                                
                                                }
                                                
                                                                                                                                          
                                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="print.php"  class="btn btn-info btn-block">Print Receipt Confirmation</a>
                        </div>
                    </div>

<?php include('inc/footer.php') ?>

  

  