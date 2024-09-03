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
                if(isset($_POST['addProduct']))
                {
                  extract($_POST);

                  $img = $_FILES['img'];
                  $imgName = $img['name'];
                  $tmpName = $img['tmp_name'];
                  $imgSize = $img['size'];
                  $imgEx = pathinfo($imgName,PATHINFO_EXTENSION);
                  $extension = ['jpg','png','jpeg','JPG'];

                  //validation
                  if($category=="" || $title=="" || $desc=="" || $price=="" || $quantity=="")
                  {
                    echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    all inputs is required
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
                  }elseif(!in_array($imgEx,$extension))
                  {
                    echo '
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    please choose image
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    ';
                  }
                  else
                  {

                    $checkCategory="select title from `categories` where title='$category'";
                    $runCheckCategory=mysqli_query($conn,$checkCategory);
                    $categoryRows=mysqli_num_rows($runCheckCategory);
                    
                    if($categoryRows>0)
                    {
                      $checkTitle="select name from `products` where name='$title'";
                      $runCheckTitle=mysqli_query($conn,$checkTitle);
                      $titleRows=mysqli_num_rows($runCheckTitle);

                      if($titleRows>0)
                      {
                        echo '
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        product already exists
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
                      }
                      else
                      {

                        $selectCategoryId="select id from `categories` where title='$category'";
                        $runSelectId=mysqli_query($conn,$selectCategoryId);
                        $fetchId=mysqli_fetch_assoc($runSelectId);

                        $categoryId=$fetchId['id'];

                        $addProduct="insert into `products` (`name`,`description`,`price`,`image`,`quantity`,`category_id`) values('$title','$desc','$price','$imgName','$quantity','$categoryId')";
                        $runAddPoduct=mysqli_query($conn,$addProduct);
                        move_uploaded_file($tmpName,'../upload/'.$imgName);

                        if($runAddPoduct)
                        {
                          echo '
                          <div class="alert alert-success alert-dismissible fade show" role="alert">
                          product added successfly
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          ';
                        }
                        else
                        {
                          echo '
                          <div class="alert alert-warning alert-dismissible fade show" role="alert">
                          product added failed
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                          ';
                        }
                      }

                    }
                    else
                    {
                      echo '
                      <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      categroy does not exist
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                      ';
                    }
                    
                  
                  }
                }
            ?>

              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Add Product</h3>
                <form method="POST" action="addProduct.php" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" name="desc" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control p_input">
                  </div>
                  <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="img" class="form-control p_input">
                  </div>
                  <div class="text-center">
                    <button type="submit" name="addProduct" class="btn btn-primary btn-block enter-btn">Add</button>
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