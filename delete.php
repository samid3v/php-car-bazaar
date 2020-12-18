<?php  require_once("inc/header.php");  

if (isset($_GET["slug"])) {
    $slug=$_GET["slug"];
  $connectingdb;
  $query="DELETE FROM car_ad WHERE slug='$slug'";
  $execute=dbquery($query);
}
if($execute){
  $_SESSION["success_message"]="category Deleted Successfully";

  redirect("dashboard.php");

}else{
  $_SESSION["error_message"]="Something went wrong try again";

  redirect("dashboard.php");

}





?>