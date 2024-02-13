<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');

$products = mysqli_query($con, "SELECT * FROM products LIMIT 4");

?>

    <div class="container">
        <div class="welcome" Style="padding: 50px; width: 100%; box-sizing: border-box; background: linear-gradient(to top, lightblue, white); border-radius: 25px;">
            <div class="row">
            <div class="col-lg-6">
                <h1>TIMELESS QUALITY</h1>
                <p>5 o'clock, the ultimate destination for watch enthusiasts!<br>
                Elevate your wrist game with us and embark on a<br>
                timeless adventure. Lets make every second count!</p>
                <br>
                <br>
                <a href="products.php" class="btn-explore">Explore Now &#8594;</a>
                <br>
                <br>
            </div>
            <div class="col-lg-6 text-end">
            <img src="../images/watches.png" alt="Watch Image" style="width:120%; margin-right: 50px;">
            </div>
        </div>
    </div>
</div>

    <br>


<!-- gender type -->
<div class="row justify-content-center mt-5" style="align-items: flex-start;" >
<div class="col-md-10 d-flex justify-content-around">

<div class="card bg-dark text-white">
  <img class="card-img" src="../images/men.jpg" alt="Card image" style="width: 510px; height: 370px;" >
  <div class="card-img-overlay">
    <h1 class="card-title display-4" style="color:white; text-shadow: 2px 2px 5px black;">For Him</h1><br>
    <p class="card-text" style="color:white; text-shadow: 2px 2px 5px black;" >Explore our exclusive range of mens watches, crafted<br>
    to combine style, comfort, and durability. Perfect for<br>
    the man who values time and elegance.</p>
    <br>
    <br>
    <a href="products.php?gender=Men" class="btn-explore">Watches For Men</a>
    
  </div>
</div>

<div class="card bg-dark text-white">
  <img class="card-img" src="../images/women.jpeg" alt="Card image" style="width: 510px; height: 370px;">
  <div class="card-img-overlay" align="right" >
    <h1 class="card-title display-4" style="color:white; text-shadow: 2px 2px 5px black;">For Her</h1><br>
    <p class="card-text" style="color:white; text-shadow: 2px 2px 5px black;">Dive into our exquisite collection of womens watches, designed with a touch of elegance. Ideal for the
    <br> woman who appreciates style and punctuality.</p>
    <br>
    <br>
    <a href="products.php?gender=Women" class="btn-explore">Watches For Women</a>
  </div>
</div> 

    <!-- <div class="col-md-4 mb-3 mt-5" >
        <div class="card border-dark">
            
            <div class="card-body">
                <h4>For Him</h4>
            </div>
        </div>
    </div>

    
    <div class="col-md-4 mb-3 mt-5">
        <div class="card border-dark">
            
            <div class="card-body">
                    <h4>For Her</h4>
            </div>
        </div>
    </div> -->
    </div>
    </div>


<!------ featured products ------>
<div class="small-container mt-5">
    <h2 class="title">Featured Products</h2>
    <div class="row" align="center">
        <?php while ($row = mysqli_fetch_assoc($products)) : ?>
            <div class="col-4">
                <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>">
                    <img src="../uploads/<?php echo $row['image']; ?>">
                </a>
                <h4><?php echo $row['name']; ?></h4>
                <div class="rating">
                    <?php
                    $product_id = $row['product_id'];
                    $rating_query = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE product_id = $product_id";
                    $rating_result = mysqli_query($con, $rating_query);
                    $rating_data = mysqli_fetch_assoc($rating_result);
                    $avg_rating = $rating_data['avg_rating'];
                    $filled_stars = floor($avg_rating);
                    $empty_stars = 5 - $filled_stars;

                    for ($i = 0; $i < $filled_stars; $i++) {
                        echo '<i class="fa fa-star"></i>';
                    }

                    for ($i = 0; $i < $empty_stars; $i++) {
                        echo '<i class="fa fa-star-o"></i>';
                    }
                    ?>
                </div>
                <p>RM<?php echo $row['price']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<!------ brands' cards ------>
<div class="small-container mt-2">
    <h2 class="title">Top Brands</h2>
    <div class="brand-cards">
        <?php
        $brands = mysqli_query($con, "SELECT * FROM brand");
        while ($brand = mysqli_fetch_assoc($brands)) :
        ?>
            <div class="col-5">
                <a href="products.php?brand_id=<?php echo urlencode($brand['brand_id']); ?>">
                    <div class="brand-card">
                        <p style="text-transform: uppercase; font-weight: bold;">
                            <?php echo htmlspecialchars($brand['name']); ?>
                        </p>
                    </div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</div>



<!------ recently added products ------>
<div class="small-container mt-5">
    <h2 class="title">Recently Added</h2>
    <div class="row" align="center">
        <?php
        $recently_added = mysqli_query($con, "SELECT * FROM products ORDER BY created_at DESC LIMIT 4");
        while ($row = mysqli_fetch_assoc($recently_added)) :
        ?>
            <div class="col-4">
                <a href="product-details.php?product_id=<?php echo $row['product_id']; ?>">
                    <img src="../uploads/<?php echo $row['image']; ?>">
                </a>
                <h4><?php echo $row['name']; ?></h4>
                <div class="rating">
                    <?php
                    $product_id = $row['product_id'];
                    $rating_query = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE product_id = $product_id";
                    $rating_result = mysqli_query($con, $rating_query);
                    $rating_data = mysqli_fetch_assoc($rating_result);
                    $avg_rating = $rating_data['avg_rating'];
                    $filled_stars = floor($avg_rating);
                    $empty_stars = 5 - $filled_stars;

                    for ($i = 0; $i < $filled_stars; $i++) {
                        echo '<i class="fa fa-star"></i>';
                    }

                    for ($i = 0; $i < $empty_stars; $i++) {
                        echo '<i class="fa fa-star-o"></i>';
                    }
                    ?>
                </div>
                <p>RM<?php echo $row['price']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>



    <?php include('includes/footer.php'); ?>
