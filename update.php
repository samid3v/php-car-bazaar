<?php

include("inc/header.php");

if (!logged_in()) {

    $_SESSION["error_message"] = "To create car ad you must login";
    redirect("login.php");
}



?>
<body id="ads">
<div>
<?php
include("inc/nav.php");
?>
</div>

<div id="contact-clean" class="p-4 mt-5 mb-5">
<?php error_message(); 
 
?>
        <form method="post" action="" enctype="multipart/form-data" id="signups">
            <h2 class="text-center">Create Your Car Ad</h2>
            <?php



if (isset($_GET['slug'])) {
    $slug = $_GET['slug'];

     update_car_ad($slug);

    $sql = "SELECT * FROM car_ad WHERE slug ='$slug'";
    $result = dbquery($sql);

    while ($row = fetch_data($result)) {
        
   
?>
            <div class="form-group">
                <input type="file" name="preview" class="form-control">
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input class="form-control" type="text" name="brand" placeholder="Car Brand" value="<?php echo $row['brand'] ?>">
                    </div> 
                    <div class="form-group">
                        <input class="form-control" type="text" name="model" placeholder="Car Model" value="<?php echo $row['model'] ?>">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="number" class="form-control" name="year" placeholder="2020" value="<?php echo $row['year'] ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="number" name="mileage" placeholder="mileage" value="<?php echo $row['mileage'] ?>">
                    </div> 
                </div>
            </div>     
            <div class="form-group">
                <input class="form-control" type="number" name="price" placeholder="Car cost" value="<?php echo $row['price'] ?>">
            </div>
            <div class="form-group">
                <input class="form-control" type="text" name="video" placeholder="video link" >
            </div>
            <div class="form-group">
                <textarea class="form-control" rows="5" name="message" placeholder="Car Description[minimum=200]" ><?php echo $row['description'] ?></textarea>
            </div>
            <?php  }?>
    
       <div class="form-group btns">
                <button name="submit" class="btn btn-primary" type="submit">Update Car Ad</button>
            </div>
            <?php
        }else{
    redirect('index.php');
} ?>
     
        </form>
    </div>

    <?php

include("inc/footer.php");

?>
