<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');
?>

<div class="row">
    <div class="col-md-8 mx-auto">
    <?php include('message.php'); ?></div>
</div>


<div class="row justify-content-center" style="align-items: flex-start;background-image: url('../images/back2.png'); background-size: cover;" >
<div class="col-md-8 d-flex justify-content-start">
    <div class="col-md-2 mb-3 mt-5" style="color:black; text-shadow: 2px 2px 5px lightgray;margin-right: 8%; padding-top:20px;" >
    
        <h3><u>About</u></h3>
    </div>

    
    <div class="col-md-9 mb-3 mt-5 bg-light" style="padding-top:20px; padding-bottom:20px; padding-left:20px; padding-right:20px;">
        <p style="text-align: justify;">
            Welcome to 5 O' Clock! We are an online watch shopping destination dedicated to providing high-quality 
            timepieces and exceptional customer service. Our passion for watches and commitment to customer satisfaction 
            drives us to curate a collection of stylish and reliable watches from renowned brands around the world. </p>

        <p style="text-align: justify;">
            At 5 O'Clock, we believe that finding the perfect watch should be a seamless and enjoyable experience. 
            Our user-friendly platform allows you to browse through our extensive selection and easily find the watch 
            that matches your style and preferences. Whether you're a collector, a fashion enthusiast, or someone looking 
            for a special gift,we have the perfect timepiece for you.</p>
    </div>
    </div>
    
    <div class="col-md-8 d-flex justify-content-start">
    <div class="col-md-2 mb-3 mt-5" style="color:black; text-shadow: 2px 2px 5px lightgray;margin-right: 8%; padding-top:20px;" >
    
        <h3><u>FAQ</u></h3>
    </div>

    
    <div class="col-md-9 mb-3 mt-5 bg-light" style="padding-top:20px; padding-bottom:20px; padding-left:20px; padding-right:20px;" >
        <h5>How Do I Place An Order</h5>
        <p style="text-align: justify;">
            Placing an order with us is simple and convenient. Just browse through our selection of watches, choose your 
            desired timepiece, and click on the 'Add to Cart' button. Proceed to the checkout page, fill in your shipping 
            details, and select your preferred payment method to complete your order. Enjoy a hassle-free shopping 
            experience with us.
        </p><br>

        <h5>Payment & Shipping</h5>
        <p style="text-align: justify;">
            We offer secure and flexible payment options to ensure a seamless transaction process. You can make payments 
            using major credit cards, debit cards, or through trusted payment gateways. Once your payment is confirmed, 
            we strive to process and ship your order within 3 to 5 business days. We provide reliable shipping services 
            to deliver your watch to your doorstep. ensuring a swift and safe delivery.
        </p><br>

        <h5>Secure Ordering & Payment Options</h5>
        <p style="text-align: justify;">
            At 5 O'Clock, we prioritize the security of your personal information and financial data Our website is equipped 
            with advanced encryption technology to safeguard your details during the ordering process. Additionally, we only 
            collaborate with trusted and renowned payment gateways to ensure secure transactions. Shop with confidence. 
            knowing that your privacy and security are our top priorities.
        </p><br>

    </div><br><br><br>
    </div><br>
    </div>

<?php 
include('includes/footer.php');
?>
