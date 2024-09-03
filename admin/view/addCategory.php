<?php

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";
include "../../dbConnection.php";



?>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <?php

              if(isset($_POST['addCategory']))
              {
                  $title=$_POST['title'];
                  if($title==""){

                    echo"title invalid";
                  }else{
                    


                    $checkTitle="select title from `categories` where `title` ='$title'";
                    $runCheckTitle=mysqli_query($conn,$checkTitle);
                    // $titleRows=mysqli_num_rows($runCheckTitle);
                    
                    if(mysqli_num_rows($runCheckTitle)>0){
                      echo"category is already added";
                    }else{


                      $addcategory= "insert into `categories` (`title`) values('$title')";
                      $runAddCategory= mysqli_query($conn,$addcategory);

                      if($runAddCategory){
                        echo "category added successfully";

                      }else{
                        echo " failed to add category";
                      }
                    }
        
                  }


              }

?>
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Category</h3>
                <form method="POST" action="addCategory.php">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input text-light">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
                  </div>
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

<?php 
include "../view/footer.php";
 ?>