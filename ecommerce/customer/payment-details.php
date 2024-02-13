<?php
session_start();
include('includes/header.php');
include('../config/dbcon.php');


if (isset($_POST['place_order'])) {

    $destination_id = $_POST['destination_id'];
    $payment_option = $_POST['payment_option'];
    $_SESSION['destination_id'] = $destination_id;
    $_SESSION['payment_option'] = $payment_option;


    if ($payment_option == 'Credit/Debit Card') {?>
            <div class="col-md-5 mx-auto my-5">
            <div class="card bg-light">
            <div class="card-header"><h4>Card Details</h4></div>
            <div class="card-body">
                <form action="placed-order.php" method="post">
                <div class="col-md-6 mb-3" >
                <label for="cardNumber">Card Number</label><br>
                <input type="text" id="cardNumber" name="cardNumber" pattern="\d{13,19}" title="Please enter a valid card number" required oninvalid="this.setCustomValidity('Please enter a valid card number')" oninput="this.setCustomValidity('')"><br>
                </div>
                <div class="col-md-6 mb-3" >
                <label for="expiryDate">Expiry Date</label><br>
                <input type="text" id="expiryDate" name="expiryDate" pattern="(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})" title="Please enter a valid expiry date (MM/YY or MM/YYYY)" required oninvalid="this.setCustomValidity('Please enter a valid expiry date (MM/YY or MM/YYYY)')" oninput="this.setCustomValidity('')"><br>
                </div>
                <div class="col-md-6 mb-3" >
                <label for="cvv">CVV</label><br>
                <input type="number" id="cvv" name="cvv" pattern="\d{3}" min="001" max="999" oninvalid="this.setCustomValidity('Please enter a valid 3 digits CVV')" oninput="this.setCustomValidity('')" ><br>
                </div>
                <a href="checkout.php" class="btn btn-danger" >Cancel</a>
                <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
                </form>
            </div>
            </div>
            </div><?php
        } else if ($payment_option == 'Online Banking') {?>
            <div class="col-md-5 mx-auto my-5">
            <div class="card bg-light">
            <div class="card-header"><h4>Choose Your Preferred Bank</h4></div>
            <div class="card-body">
            <form action="placed-order.php" method="post">
            <label for="bank">Bank:</label><br>
            <select id="bank" name="bank">
            <option value="Bank Islam">Bank Islam</option>
            <option value="Maybank">Maybank</option>
            <option value="CIMB">CIMB</option>
            <option value="Bank Rakyat">Bank Rakyat</option>
            </select><br><br>
            <input type="checkbox" required> Agree with term<br><br>
            <a href="checkout.php" class="btn btn-danger" >Cancel</a>
            <button type="submit" name="place_order" class="btn btn-success">Place Order</button>
            </form>
            </div>
            </div>
            </div>
            <br><br><br><br><?php
        }?>
<?php

    }

include('includes/footer.php'); ?>
