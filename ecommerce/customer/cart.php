<?php
session_start();
include('../config/dbcon.php');
include('includes/header.php');

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();

$total = 0;
foreach ($cart as $product_id => $product) {
    $query = "SELECT price FROM products WHERE product_id = $product_id";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($query_run);

    $subtotal = $row['price'] * $product['quantity'];
    $total += $subtotal;

    $cart[$product_id]['subtotal'] = $subtotal;
}

$_SESSION['cart'] = $cart;


?>

<div class="container-fluid px-4">
    <h1 class="mt-4">View Cart</h1>
    <ol class="breadcrumb mb-5">
        <li class="breadcrumb-item active">Cart</li>
        <li class="breadcrumb-item">View Cart</li>
    </ol>
    <div class="row" style="display: flex; align-items: flex-start;" >
   
        <div class="col-md-8 mb-5">

        <?php include('message.php'); ?>    

            <div class="card">
                <div class="card-header">
                    <h4>Cart</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($cart)) : ?>
                        <p>Your cart is empty.</p>
                        <a href="products.php" class="btn btn-primary">Back to Shopping</a>
                    <?php else : ?>
                        <form method="POST" action="crud.php">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $product_id => $product) : ?>
                                        <tr>
                                            <td>
                                               <h5> <img src="../uploads/<?php echo $product['image']; ?>" alt="Product Image" style="max-width: 100px; max-height: 100px; margin-right: 5%;">
                                                <?php echo $product['name']; ?></h5>
                                            </td>
                                            <td>
                                                <input type="hidden" name="product_id[]" value="<?php echo $product_id; ?>">
                                                <input type="number" name="quantity[]" value="<?php echo $product['quantity']; ?>" min="0" max="10" style="width: 50px; height: 40px; padding-left: 10px; font-size: 20px; margin-right: 10px;">
                                            </td>
                                            <td>RM<?php echo $product['price']; ?></td>
                                            <td>RM<?php echo $product['subtotal']; ?></td>
                                            <td>
                                                <a href="crud.php?remove=true&product_id=<?php echo $product_id; ?>" class="btn btn-sm btn-danger">Remove</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <a href="products.php" class="btn btn-primary">Continue Shopping</a>
                            <button type="submit" name="update_cart" class="btn btn-success">Update Cart</button>
                        
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-5">

            <?php include('message.php'); ?>

            <div class="card">
                <div class="card-header">
                    <h4>Order Summary</h4>
                </div>
                <div class="card-body">
                    <?php if (empty($cart)) : ?>
                        <p>Your cart is empty.</p>
                    <?php else : ?>
                        <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $product_id => $product) : ?>
                                    <tr>    
                                            <td>
                                                <p><?php echo $product['name']; ?></p>
                                            </td>
                                            <td><?php echo $product['subtotal']; ?><br></td>
                                        </tr>
                                    <?php endforeach; ?>   
                                    
                                    <tr>
                                        <td><br><br><strong>Total</strong></td>
                                        <td><br><br><strong>RM<?php echo $total; ?></strong><br></td>
                                    </tr>
                                </tbody>
                            </table>

                            <a href="checkout.php" class="btn btn-warning" style="width: 100%;" >Checkout</a>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div><br><br><br><br><br><br><br><br><br>

<?php include('includes/footer.php'); ?>
