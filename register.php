<?php include("inc/header.php");  ?>
<html>
<body id="register">
<?php include("inc/nav.php"); 
  
  
  ?>
<div id="caption">
    <div class="container mt-5">
        <div class="card" id="contain">
            <div class="card-header">
                <div class="img">
                    <img id="user_pic" src="imgs/user.png" alt="">
                </div>
            </div>

            <?php validate_user(); ?>
            
                <?php error_message(); ?>
            
            <p class="form_message"></p>
            <div class="card-body">
                <form action="#" method="post" id="login">
                <div class="row" id="signup">    
                    <div class="col-sm-6" >   
                        <div class="form-group" >
                                <div class="input-group">
                                    <input class="form-control" id="fname" name="fname" type="text" placeholder="First Name"/>
                
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="input-group">
                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="input-group">
                                    <input  name="phone" id="phone" type="tel" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <div class="input-group">
                                    <input class="form-control" id="lname" name="lname" type="text" placeholder="Last Name"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="input-group">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password"/>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="input-group">
                                    <input class="form-control" id="cpassword" name="cpassword" type="password" placeholder="Confirm Password"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-info" id="btn" name="login">Create account</button>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <a href="login.php" class="btn btn-secondary float-right">Login</a>
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
</html

