
<?php
include "header.php";
include "navbar.php";
include "dbconnection.php";
?>

<div class="card-body px-5 py-5" style="background-color:darkgray;">

<?php 
if(isset($_POST['signup']))
{
    //data
    extract($_POST);

    //validation
    $errors =[];
    //userName => required | string | min 3
    if($UserName == "")
    {
       $errors[]="userName is required";
    }
    elseif(!is_string($UserName))
    {
      $errors[]="userName must be string";
    }
    elseif(strlen($UserName)<3)
    {
      $errors[]="userName must be more than 3 char";
    }


    //email => required | email | unique
    if($email == "")
    {
       $errors[]="email is required";
    }
    elseif( !filter_var($email,FILTER_VALIDATE_EMAIL))
    {
      $errors[]="email not valid";
    }
  

      $checkEmail= "select * from users where  `email` ='$email'";
      $runCheckEmail= mysqli_query($conn,$checkEmail);
      $emailRows= mysqli_num_rows($runCheckEmail);

    // print_r($emailRows);
    
    if ($emailRows>0){
      $errors[]= "this email already exists";
    }


    //password => required | min:4
    if($password == "")
    {
       $errors[]="password is required";
    }
    elseif(strlen($password)<4)
    {
      $errors[]="password must be more than 4";
    }


    //phone => required | phone number | unique
    $phoneRegex = "/^01[0,1,2,5][0-9]{8}$/";   

    if($phone == "")
    {
       $errors[]="phone is required";
    }
    elseif(preg_match($phoneRegex,$phone) !=1)
    {
      $errors[]="phone number not valid";
    }
    //check phone exists or not
    $checkPhone = "select * from users where `phone`='$phone'";
    $runCheckPhone = mysqli_query($conn,$checkPhone);
    
    $PhoneRows = mysqli_num_rows($runCheckPhone);
    
    //print_r($emailRows);
    
    if($PhoneRows>0)
      {
        $errors[]="phone already exists";
      }

    //address => required
    if($address == "")
    {
       $errors[]="address is required";
    }


    if(empty($errors))
    {

      // store db
      //add user
         $newUser= "insert into  USERS(`name`,`email`,`password`,`address`,`phone`)   
                        VALUES('$UserName','$email','$password','$address','$phone') ";
           $runNewUser= mysqli_query($conn,$newUser);
          
          


      if( $runNewUser   )
      {
        echo "<div class='alert alert-success'> data inserted successfully</div>";
      }
      else
      {
        echo "insert failed";
      }


      //header("location:login.php");

    }
    else
    {
      foreach($errors as $error)
      {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo $error;
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
      }
    }

}
?>

                <h3 class="card-title text-left mb-3">Register</h3>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control p_input" name="UserName" >
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control p_input" name="email">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control p_input" name="password">
                  </div>
                  <div class="form-group">
                    <label>Phone</label>
                    <input type="text" class="form-control p_input"name="phone">

                  </div>
                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control p_input" name="address">
                  </div>
              
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                     
                  <div class="text-center">
                    <button type="submit" name="signup" class="btn btn-primary btn-block enter-btn">Signup</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook col me-2">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up text-center">Already have an Account?<a href="login.php"> Login</a></p>
                  <p class="terms">By creating an account you are accepting our<a href="#"> Terms & Conditions</a></p>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>

    <?php include "footer.php" ?>


    <!-- regex 

  $regex = /^01[0,1,2,5][0-9]{8}$/

  preg_match($regex,) 
  
  -->