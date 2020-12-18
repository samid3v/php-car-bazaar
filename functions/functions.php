<?php

function entities($string)
{

    return htmlentities($string);

}

function redirect($redirect)
{

    return header("location: {$redirect}");

}


function error_message(){
    if (isset($_SESSION["error_message"])) {
        $output="<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
        $output.=entities($_SESSION["error_message"]);
        $output.="<button type='button' class='close' data-dismiss='alert' arial-lable='close'><span arial-hidden='true'>&times;</span>";
        $output.="</button>";
        $output.="</div>";
        
        $_SESSION["error_message"]=null;
        echo $output;
              
    }
}


function success_message(){
    if (isset($_SESSION["success_message"])) {
        $output="<div class='alert alert-success alert-dismissible fade show' role='alert'>";
        $output.=entities($_SESSION["success_message"]);
        $output.="<button type='button' class='close' data-dismiss='alert' arial-lable='close'><span arial-hidden='true'>&times;</span>";
        $output.="</button>";
        $output.="</div>";
        
        $_SESSION["success_message"]=null;
        echo $output;
              
    }
}

function token_generator()
{

    $token = $_SESSION["messages"] =  md5(uniqid(mt_rand(), true));

    return $token;
}

function email_used(){

    $email        =entities($_POST['email']);

    $sql ="SELECT * FROM users WHERE email = '$email'";
    $result = dbquery($sql);

    if(row_count($result) == 1){

        return true;
    }else{

        return false;
    }
}

function phone_used(){

    $p_No         =entities($_POST['phone']);

    $sql ="SELECT * FROM users WHERE phone = '$p_No'";
    $result = dbquery($sql);

    if(row_count($result) == 1){

        return true;
    }else{

        return false;
    }
}

function password_used(){

    $password         =entities($_POST['password']);

    $passcode = md5($password);

    $sql ="SELECT * FROM users WHERE password = '$passcode'";
    $result = dbquery($sql);

    if(row_count($result) == 1){

        return true;
    }else{

        return false;
    }
}

function validate_phone(){
    $p_No         =entities($_POST['phone']);
    $filter_phone = filter_var($p_No, FILTER_SANITIZE_NUMBER_INT);
    $clean_no = str_replace("-", " ", $filter_phone);

    if (strlen($clean_no) == 10) {
        
        return true;
    }else{

        return false;
    }
}

function validate_user()
{



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $first_name   =entities($_POST['fname']);
        $last_name    =entities($_POST['lname']);
        $email        =entities($_POST['email']);
        $p_No         =entities($_POST['phone']);
        $password     =entities($_POST['password']);
        $cpassword    =entities($_POST['cpassword']);

        if (empty($first_name) || empty($last_name) || empty($email) || empty($p_No) || empty($password) || empty($cpassword)) {
            
            $_SESSION["error_message"] = "All fields are required";
        }

        /*elseif(filter_var($email, FILTER_VALIDATE_EMAIL)){

            $_SESSION["error_message"] = "Check email format";

        }*/
        elseif($password != $cpassword){

            $_SESSION["error_message"] = "Password dont Match";
        }
        elseif(strlen($password) < 8 ){

            $_SESSION["error_message"] = "Password should not be less than 8 characters";
        }
        
       elseif (email_used()) {
            
            $_SESSION["error_message"] = "Email has been taken";
        }elseif(phone_used()){

            $_SESSION["error_message"] = "Phone Number has been taken";
        }
        else {
            register_user($first_name, $last_name, $email, $p_No, $password);

            $_SESSION["success_message"] = "successfully registered";

            redirect("login.php");
        }
        
    }
}


function register_user($first_name, $last_name, $email, $p_No, $password){



    $first_name   =escape($first_name);
    $last_name    =escape($last_name);
    $email        =escape($email);
    $p_No         =escape($p_No);
    $password     =escape($password);

    if (email_used($email)) {
        
        return false;
    }elseif (phone_used($p_No)) {
        
        return false;
    }else {

        $password = md5($password);

        $sql = "INSERT INTO users(first_name, last_name, email, phone, password) VALUES('$first_name', '$last_name', '$email', $p_No, '$password')";
        $result = dbquery($sql);
    

        
    }

}


function validate_user_login()
{

  


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        
        $email        =entities($_POST['email']);
        $password     =entities($_POST['password']);

    

        if (empty($email) || empty($password)){
            
            $_SESSION["error_message"] = "All fields are required";
        }elseif(!email_used()) {

            $_SESSION["error_message"] = "email does not exist";
            
        }elseif(!password_used()) {

            $_SESSION["error_message"] = "incorrect password";
            
        }
        
        else {
            login_user($email, $password);
            redirect('index.php');
            
        }

        /*elseif(filter_var($email, FILTER_VALIDATE_EMAIL)){

            $_SESSION["error_message"] = "Check email format";

        }*/
        
    
        
    }
}


function login_user($email, $password){
     
    

        $email        =escape($_POST['email']);
        $password     =escape($_POST['password']);

        $sql ="SELECT password, id FROM users WHERE email = '$email'";
        $result = dbquery($sql);
        check_admin();
        if (row_count($result)==1) {
            $row = fetch_data($result);

            $db_password = $row['password'];
            $user_id = $row['id'];
            $mail = $row['email'];
            $name = $row['first_name'];
            

            $_SESSION['user_id'] = $user_id;

            $_SESSION['user'] = $name;
         

            if (md5($password) === $db_password) {
                
                return true;
            }else{

                return false;
            }
        }
        


}


    
    
   





function logged_in(){

   
    if (isset($_SESSION['user_id'])) {
        return true;
    }else {
        return false;
    }
}

 




function validate_car_ad(){

    $data = "abcdefghijklmnopqrstABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $shuffle =  str_shuffle($data).rand(5, 7);
    $slug = substr($shuffle, 0, 10);
    $_SESSION["unique"] = $slug;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_SESSION['user_id'])) {
            $user_id      = $_SESSION['user_id'];
        }

        $video = $_POST['video'];

     
     if (!empty($video)) {
        $url_parsed_arr = parse_url($video);
        if (!$url_parsed_arr['host'] == "www.youtube.com" && $url_parsed_arr['path'] == "/watch" && substr($url_parsed_arr['query'], 0, 2) == "v=" && substr($url_parsed_arr['query'], 2) != "") {
           $_SESSION["error_message"] = "link is not valid";
            
        }
     }
     

        
        
        $brand        =entities($_POST['brand']);
        $model     =entities($_POST['model']);
        $year     =entities($_POST['year']);
        $price        =entities($_POST['price']);
        $mileage        =entities($_POST['mileage']);
       // $engine     =entities($_POST['engine']);
        $description       =entities($_POST['message']);
        //$preview = $_FILES['preview'];

        if (empty($brand) || empty($model) || empty($price) || empty($mileage) || empty($year) || empty($description) ){
            
            $_SESSION["error_message"] = "All fields are required";
        }
            elseif (strlen($description)<200) {
                $_SESSION["error_message"] = "Description cannot be less than 200 characters";
            }else{
                $upload_location = "preview/";

                $preview = $_FILES['preview']['name'];
                $ext = pathinfo($preview, PATHINFO_EXTENSION);

                $valid_ext = array("png","jpeg","jpg");
                if(in_array($ext, $valid_ext)){
        
                    // File path
                    $path = $upload_location.$preview;

                    $sql = "INSERT INTO car_ad(brand, model, slug, price, year, mileage, preview, description, userid) VALUES('$brand', '$model', '$slug', $price, '$year', '$mileage', '$path', '$description', '$user_id')";
                    $result = dbquery($sql);
                    $sql ="INSERT INTO car_video(slug,video) VALUES ('$slug', '$video')";
                $result = dbquery($sql);
                
                    // Upload file
                    if(move_uploaded_file($_FILES['preview']['tmp_name'],$path)){
                       
                        
                        
                        $_SESSION["success_message"] = "successfully uploaded your ad";
         
                  redirect("index.php");
    

                    
                    }
                  }
                  
            }
        }             
        
    }
    

    function update_car_ad($slug){

        
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_id'])) {
                $user_id      = $_SESSION['user_id'];
            }
    
            $video = $_POST['video'];
    
         
         $url_parsed_arr = parse_url($video);
         if(!empty($video)){
            if (!$url_parsed_arr['host'] == "www.youtube.com" && $url_parsed_arr['path'] == "/watch" && substr($url_parsed_arr['query'], 0, 2) == "v=" && substr($url_parsed_arr['query'], 2) != "") {
                $_SESSION["error_message"] = "link is not valid";
                 
             }
         }
         
    
            
            
            $brand        =entities($_POST['brand']);
            $model     =entities($_POST['model']);
            $year     =entities($_POST['year']);
            $price        =entities($_POST['price']);
            $mileage        =entities($_POST['mileage']);
           // $engine     =entities($_POST['engine']);
            $description       =entities($_POST['message']);
            //$preview = $_FILES['preview'];
    
            if (empty($brand) || empty($model) || empty($price) || empty($mileage) || empty($year) || empty($description) ){
                
                $_SESSION["error_message"] = "All fields are required";
            }
                elseif (strlen($description)<200) {
                    $_SESSION["error_message"] = "Description cannot be less than 200 characters";
                }else{
                    $upload_location = "preview/";
    
                    $preview = $_FILES['preview']['name'];
                    $ext = pathinfo($preview, PATHINFO_EXTENSION);
    
                    $valid_ext = array("png","jpeg","jpg");
                    if(in_array($ext, $valid_ext)){
            
                        // File path
                        $path = $upload_location.$preview;
    
                        $sql = "UPDATE car_ad SET brand='$brand', model='$model', price='$price', year='$year', mileage='$mileage', preview='$path', description='$description' WHERE slug='$slug' ";
                        $result = dbquery($sql);
                        $sql ="UPDATE car_video SET video = '$video' WHERE slug ='$slug'";
                        $result = dbquery($sql);
                        
                        // Upload file
                        if(move_uploaded_file($_FILES['preview']['tmp_name'],$path)){
                           
        
                            
                            $_SESSION["success_message"] = "successfully uploaded your ad";
             
                      redirect("dashboard.php");
        
    
                        
                        }
                      }
                      
                }
            }             
            
        }


  
     function check_car_booking(){
        if (isset($_SESSION['user_id'])) {
            $user_id      = $_SESSION['user_id'];
         $sql = "SELECT user_id FROM booking WHERE user_id = '$user_id'";
         $result = dbquery($sql);
         if (row_count($result)==1) {
            return true;
         }
        }
     }

     
     
     
function booking($book){
    if($_SERVER['REQUEST_METHOD']=='POST'){

        $date = $_POST['date'];

        if (empty($date)) {
            $_SESSION["error_message"] = "Fill date to book";
        }
        
        elseif(!logged_in()){
            $_SESSION["error_message"] = "Create account to book";
            redirect("register.php");
                
        }elseif(check_car_booking()){
            
                          $_SESSION["error_message"] = "Only one booking allowed at a time";
                          
            }else{

                if (isset($_SESSION['user_id'])) {
                    $user_id      = $_SESSION['user_id'];
                    
            
                    $sql = "INSERT INTO booking(user_id, date, car) VALUES ('$user_id', '$date', '$book')";
                    $result = dbquery($sql);
            
                    $_SESSION["success_message"] = "successfully booked your car";
                     
                              redirect("index.php");
                }
        }
    }
}


function message($slug){
    if (logged_in()) {
        
            $user_id      = $_SESSION['user_id'];
    
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $message = $_POST['message'];
            if (!empty($message)) {
                $sql ="INSERT INTO messages(user_id, car_slug, message) VALUES('$user_id','$slug','$message')";
                $result =dbquery($sql);

                if ($result) {
                    $_SESSION["success_message"] = "success!!! seller will reply";
                    redirect("index.php");
                }
            }else{
                $_SESSION["error_message"] = "error!!! to send enter message";
            }
        }
    }
}     
  
 

function adminlogin(){
    $sql = "SELECT * FROM users WHERE view='admin'";
    $result= dbquery($sql);
    if ($row = fetch_data($result)) {
        $_SESSION['admin_mail']=$row['email'];
        $_SESSION['admin_id']=$row['id'];
        $_SESSION['admin_name']=$row['first_name'].''.$row['last_name'];
    }
}

function check_admin(){
    if (isset($_SESSION['admin_mail']) && isset($_SESSION['admin_mail'])) {
        if ($_SESSION['admin_id']==$_SESSION['user_id']) {
            return true;
        }
    }
}