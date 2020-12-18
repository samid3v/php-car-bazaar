<?php include("inc/header.php");  

 if (logged_in()) {
     redirect('index.php');
 }
?>

<?php include("inc/nav.php"); 
  
  
  ?>


<body id="register">
    
<div id="caption">
    <div class="container">
        <div class="card" id="contain">
            <div class="card-header">
                <div class="img">
                    <img id="user_pic" src="imgs/user.png" alt="">
                </div>
            </div>

            <?php validate_user_login(); ?>
            <?php error_message(); ?>
            <?php success_message();  ?>

            <div class="card-body" id="signup">
                <form action="#" method="post" id="login">
                    <div class="form-group ">
                        <label class="control-label " for="email">Email</label>
                        <div class="input-group">
                            <input class="form-control" id="email" name="email" type="text"/>
                            <div class="input-group-addon">
                                <i class="fa fa-envelope text-light form_icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="control-label " for="password">Password</label>
                        <div class="input-group">
                            <input class="form-control" id="password" name="password" type="password"/>
                            <div class="input-group-addon">
                                <i class="fa fa-lock text-light form_icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info" id="btn" name="login">Login</button>
                    </div>
                </form>
            </div>

            <div class="card-footer">
                <a href="register.php" class="btn btn-secondary" id="account">Signup</a>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jssor.slider.min.js"></script>
  <script src="build/js/intlTelInput.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  
</body>
</html>
