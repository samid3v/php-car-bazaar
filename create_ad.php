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
 validate_car_ad();
?>
        <form method="post" action="" enctype="multipart/form-data" id="signups">
            <h2 class="text-center">Create Your Car Ad</h2>
            <?php include('inc/ad.php');  ?>
            

            <div class="form-group btns">
                <button id="submit" name="submit" class="btn btn-primary" type="submit">Upload Car Ad</button>
            </div>
        </form>
    </div>

    <?php

include("inc/footer.php");

?>





