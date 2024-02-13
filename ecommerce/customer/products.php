<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');


$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
$sort_query = '';


if ($sort === 'price_asc') {
    $sort_query = 'ORDER BY price ASC';
} elseif ($sort === 'price_desc') {
    $sort_query = 'ORDER BY price DESC';
} elseif ($sort === 'name_asc') {
    $sort_query = 'ORDER BY name ASC';
} elseif ($sort === 'name_desc') {
    $sort_query = 'ORDER BY name DESC';
}

$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';


$brand_id = isset($_GET['brand_id']) ? $_GET['brand_id'] : '';
if (!empty($brand_id)) {
    $product_query = "SELECT products.*, brand.name AS brand_name FROM products JOIN brand ON products.brand_id = brand.brand_id WHERE products.brand_id = $brand_id $sort_query";
    $brand_query = "SELECT name FROM brand WHERE brand_id = $brand_id";
    $brand_result = mysqli_query($con, $brand_query);
    $brand_row = mysqli_fetch_assoc($brand_result);
    $h2_text = $brand_row['name'];
} else {
    $product_query = "SELECT products.*, brand.name AS brand_name FROM products JOIN brand ON products.brand_id = brand.brand_id $sort_query";
    $h2_text = "All Products";
}

if (!empty($min_price) && !empty($max_price)) {
    $product_query .= " WHERE price BETWEEN $min_price AND $max_price";
} elseif (!empty($min_price)) {
    $product_query .= " WHERE price >= $min_price";
} elseif (!empty($max_price)) {
    $product_query .= " WHERE price <= $max_price";
}

$gender = isset($_GET['gender']) ? $_GET['gender'] : '';
if (!empty($gender)) {
    $product_query .= " WHERE gender = '$gender'";
    $h2_text = "Watches for $gender";
}

$query = isset($_GET['query']) ? $_GET['query'] : '';
if (!empty($query)) {

    $product_query .= " WHERE products.name LIKE '%$query%' OR brand.name LIKE '%$query%'";
}


$product_result = mysqli_query($con, $product_query);
$product_count = mysqli_num_rows($product_result);
?>

<!-- <div class="back" style="background-image: url('../images/background-2.jpg'); background-size: cover;"> -->
<!------ sorting and filter ------>
<div class="small-container">
    <div class="row row-1 mt-4">
        <h2><?php echo $h2_text; ?></h2>
        <form action="" method="GET">
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="">Default Sorting</option>
                <option value="price_asc" <?php if ($sort === 'price_asc') echo 'selected'; ?>>Sort By Price (Low to High)</option>
                <option value="price_desc" <?php if ($sort === 'price_desc') echo 'selected'; ?>>Sort By Price (High to Low)</option>
                <option value="name_asc" <?php if ($sort === 'name_asc') echo 'selected'; ?>>Sort By Name (A to Z)</option>
                <option value="name_desc" <?php if ($sort === 'name_desc') echo 'selected'; ?>>Sort By Name (Z to A)</option>
            </select>
            <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#priceFilter" aria-expanded="false" aria-controls="priceFilter">
            <i class='fa fa-filter'></i>
            </button>
        </form>
        
        <div class="collapse" id="priceFilter">
            <div class="card card-body">
                <form action="" method="GET">
                
                <input type="number" name="min_price" placeholder=" min" style="width: 70px; height: 35px;"> ~ <input type="number" name="max_price" placeholder=" max" style="width: 70px; height: 35px;">
                    <button class="btn btn-warning" type="submit">Apply Filter</button><br><br>
                <a href="products.php" class="btn btn-outline-dark">All</a>
                <a href="products.php?gender=Men" class="btn btn-outline-dark">Men</a>
                <a href="products.php?gender=Women" class="btn btn-outline-dark">Women</a>    
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <?php if (!empty($query)) : ?>
            <p>Showing search results for: "<?php echo $query; ?>"</p>
        <?php endif; ?>


        <!-- product list -->
        <div class="row" align="center">
            
            <?php
            $column_count = 0;
            if ($product_count > 0) :
                while ($product_data = mysqli_fetch_assoc($product_result)) :
                    ?>
                    <div class="col-4">
                    <div class="card border-dark" style="width: 15rem; padding:2px;">
                        <a href="product-details.php?product_id=<?php echo $product_data['product_id']; ?>">
                            <img src="../uploads/<?php echo $product_data['image']; ?>">
                        </a>
                        <h4><?php echo $product_data['name']; ?></h4>
                        <div class="rating">
                            <?php
                            $product_id = $product_data['product_id'];
                            $rating_query = "SELECT AVG(rating) AS avg_rating FROM ratings WHERE product_id = $product_id";
                            $rating_result = mysqli_query($con, $rating_query);
                            $rating_data = mysqli_fetch_assoc($rating_result);
                            $avg_rating = $rating_data['avg_rating'];
                            $filled_stars = ($avg_rating) ? floor($avg_rating) : 0;
                            $empty_stars = 5 - $filled_stars;

                            for ($i = 0; $i < $filled_stars; $i++) {
                                echo '<i class="fa fa-star"></i>';
                            }

                            for ($i = 0; $i < $empty_stars; $i++) {
                                echo '<i class="fa fa-star-o"></i>';
                            }
                            ?>
                        </div>
                        <p>RM<?php echo $product_data['price']; ?></p>
                    </div>
                    <?php
                    $column_count++;
                    if ($column_count % 4 == 0) {
                        echo '</div><div class="row">';
                    }
                    ?>
                    </div>
            <?php endwhile; ?>
            <?php else : ?>
                <p>No products found.</p>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <br>
</div>
<!-- </div> -->

<?php include('includes/footer.php'); ?>
