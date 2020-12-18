
<?php 
 include("inc/header.php");  

if (isset($_POST['date'])) {
    $date = $_POST['date'];
    $id = $_SESSION['user_id'];

    if (isset($_GET['vehicle'])) {
        $slug = $_GET['vehicle'];
    }
    if (!empty($date)) {
        $sql = "INSERT INTO booking(user_id, date, car) VALUES('$id','$date', '$slug')";
        $result = dbquery($sql);
        if ($result) {
            $_SESSION["success_message"] = "success!!! date booked";
            redirect("index.php");
        }else{
            $_SESSION["error_message"] = "error!!! something happened";
            redirect("index.php");
        }
    }else{
        $_SESSION["error_message"] = "error!!! fill date";
        redirect("car_details.php");
    }
}