<?php
session_start();
include('includes/header.php'); 
?>
<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12 mb-5 mt-5">
        <?php include('message.php'); ?>
            <div class="card">
                <div class="card-header">
                    <h4>Add Address
                        <a href="checkout.php" class="btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="crud.php?cust_id=<?= $_SESSION['auth_user']['user_id']; ?>" method="post" autocomplete="off">
                        <div class="row">
                            <input type="hidden" name="cust_id" value="<?= $_SESSION['auth_user']['user_id']; ?>">
                            <div class="col-md-6 mb-3">
                                <label for="">Location Name</label>
                                <input type="text" name="location" class="form-control" required oninvalid="this.setCustomValidity('Please enter a location name')" oninput="this.setCustomValidity('')" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address Line 1</label>
                                <input type="text" name="address1" class="form-control" required oninvalid="this.setCustomValidity('Please enter a shipping address')" oninput="this.setCustomValidity('')" >
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Address Line 2</label>
                                <input type="text" name="address2" class="form-control">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">Postcode</label>
                                <input type="number" name="postcode" class="form-control" pattern="\d{5}" required oninvalid="this.setCustomValidity('Please enter a valid postcode')" oninput="this.setCustomValidity('')"  >
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="">City</label>
                                <input type="text" name="city" class="form-control" required oninvalid="this.setCustomValidity('Please enter a shipping city')" oninput="this.setCustomValidity('')" > 
                            </div> 
                            <div class="col-md-6 mb-3"> 
                                <label for= ""> State </label ><br> 
                                <select name="state">
                                    <option value="Johor">Johor</option>
                                    <option value="Kedah">Kedah</option>
                                    <option value="Kelantan">Kelantan</option>
                                    <option value="Melaka">Melaka</option>
                                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                                    <option value="Pahang">Pahang</option>
                                    <option value="Perak">Perak</option>
                                    <option value="Perlis">Perlis</option>
                                    <option value="Pulau Pinang">Pulau Pinang</option>
                                    <option value="Sabah">Sabah</option>
                                    <option value="Sarawak">Sarawak</option>
                                    <option value="Selangor">Selangor</option>
                                    <option value="Terengganu">Terengganu</option>
                                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                                </select>   
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="add_destination2" class="btn btn-primary">Add Destination</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>                               
