<?php
include "header.php";
include "navbar.php";
include "dbConnection.php";
?>

<div class="card-body px-5 py-5" style="background-color:darkgray;">

<?php 
if(isset($_POST['login']))
{
  $email = $_POST['email'];
  $password = $_POST['password'];

  if($email=="" || $password=="")
  {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
         all inputs is required
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
  }
  else
  {
    $fetchEmail = "select * from `users` where `email`='$email' ";
    $runFetchEmail = mysqli_query($conn,$fetchEmail);
    $resultFetchEmail = mysqli_fetch_assoc($runFetchEmail);

    //print_r($resultFetchEmail);

    $passwordHash=$resultFetchEmail['password'];
    //print_r($password);

    if(count($resultFetchEmail)>0)
    {
        if(password_verify($password,$passwordHash))
        {
          $role=$resultFetchEmail['role'];

          if($role=='admin')
          {
            header("location:admin/view/layout.php");
          }
          else
          {
            $userLoggedIn = true;
            setcookie("userLoggedIn",$userLoggedIn,time()+60*60*24*14);
            header("location:shop.php");
          }
        }
        else
        {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          password invalid
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }
    else
    {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      email invalid
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }



  }
}
?>

            
              
                <h3 class="card-title text-left mb-3">Login</h3>
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                  <div class="form-group">
                    <label>email *</label>
                    <input type="email" name="email" class="form-control p_input" >
                  </div>
                  <div class="form-group">
                    <label>Password *</label>
                    <input type="text" name="password" class="form-control p_input" >
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> Remember me </label>
                    </div>
                    <a href="forgetPassword.php" class="forgot-pass">Forgot password</a>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="login" class="btn btn-primary btn-block enter-btn">Login</button>
                  </div>
                  <div class="d-flex">
                    <button class="btn btn-facebook me-2 col">
                      <i class="mdi mdi-facebook"></i> Facebook </button>
                    <button class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus </button>
                  </div>
                  <p class="sign-up">Don't have an Account?<a href="signup.php"> Sign Up</a></p>
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


    //table user, product, cart ,, review comment , rating  = session