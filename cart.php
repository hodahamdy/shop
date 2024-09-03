<?php include 'header.php' ?>
<?php include 'navbar.php' ;
include "dbConnection.php";
?>


<?php  

session_start();
  if(isset($_POST['addtocart'])){



    $cart=[
        'id'=>$_GET['id'],
        'name'=>$_POST['name'],
        'description'=>$_POST['description'],
        'price'=>$_POST['price'],
        'image'=>$_POST['image'],
        'quantity'=>$_POST['quantity'],

    ];
    


        if(! isset($_SESSION['carts'])){

            $_SESSION['carts']=[];
        }
        $_SESSION['carts'][]=$cart;
    }
// print_r($_SESSION['carts']);

?>
<section id="page-header" class="about-header"> 
        <h2>#Cart</h2>
        <p>Let's see what you have.</p>
    </section>
 
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Name</td>
                    <td>Desc</td>
                    <td>Quantity</td>
                    <td>price</td>
                    <td>Subtotal</td>
                    <td>Remove</td>
                    <td>Edit</td>
                </tr>
            </thead>
   
            <tbody>

            <?php 

            foreach($_SESSION['carts'] as $cart){
                $subtotal= (int)$cart['quantity']*(int)$cart['price'];

            ?>
                <tr>
                    <td><img src="admin/upload/<?php echo $cart['image'] ;?>" alt="product1"></td>
                    <td><?php echo $cart['name'] ;?></td>
                    <td><?php echo $cart['description'] ;?></td>
                    <td><?php echo $cart['quantity'] ?></td>
                    <td><?php echo $cart['price'] ?></td>
                    <td><?php echo $subtotal ?></td>
                   
                    
                
                    <form action="removecart.php?id=<?php echo $id++; ?>" method="post">
                    <td><button type="submit" name="remove" class="btn btn-danger">Remove</button></td>
                    </form>
                    <?php
            }
            ?>
                    <!-- Remove any cart item  -->
                    
                    
                
                </tr>
            </tbody>
            <!-- confirm order  -->
            <td><button type="submit" name="" class="btn btn-success">Confirm</button></td>
           
        </table>
    </section>

    <!-- <section id="cart-add" class="section-p1">
        <div id="coupon">
            <h3>Coupon</h3>
            <input type="text" placeholder="Enter coupon code">
            <button class="normal">Apply</button>
        </div>
        <div id="subTotal">
            <h3>Cart totals</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$118.25</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>$118.25</strong></td>
                </tr>
            </table>
            <button class="normal">proceed to checkout</button>
        </div>
    </section> -->

    <?php include "footer.php" ?>

