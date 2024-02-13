<?php
session_start();
include('../config/dbcon.php');
require_once('../vendor/tecnickcom/tcpdf/tcpdf.php');

$cust_id = $_SESSION['auth_user']['user_id'];
$order_id = $_GET['order_id'];

$query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $order_details = mysqli_fetch_assoc($result);
    
    $destination_id = $order_details['destination_id'];
    $query = "SELECT * FROM destination WHERE destination_id = '$destination_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $location = $row['location'];
    $address = $row['address'];
    $postcode = $row['postcode'];
    $city = $row['city'];
    $state = $row['state'];

    $date = date_create($order_details['created_at']);
    $formatted_date = date_format($date,"d F Y");
    $formatted_time = date_format($date,"g:i A");
     
    $query = "SELECT * FROM customers WHERE cust_id = '$cust_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $fullname = $row['fullname'];
    $email = $row['email'];


$pdf = new TCPDF('P','mm','A4');

$pdf->AddPage();


// Cell sizing(width , height , text , border , end line , [align] )
$pdf->SetFont('helvetica', '', 20);
$pdf->Cell(130	,5,'5 O`Clock',0,0);
$pdf->Cell(59	,5,'INVOICE',0,1);
$pdf->SetFont('helvetica', '', 11);


$pdf->Cell(130	,5,'UniKL MiiT',0,0);
$pdf->Cell(59	,5,'',0,1);

$pdf->Cell(130	,5,'1016, Jalan Sultan Ismail',0,0);
$pdf->Cell(25	,5,'Date',0,0);
$pdf->Cell(34	,5,$formatted_date,0,1);

$pdf->Cell(130	,5,'50250, Kampung Baru, Kuala Lumpur',0,0);
$pdf->Cell(25	,5,'Time',0,0);
$pdf->Cell(34	,5,$formatted_time,0,1);

$pdf->Cell(130	,5,'+60112718250',0,0);
$pdf->Cell(25	,5,'Order ID #',0,0);
$pdf->Cell(34	,5,$order_details['order_id'],0,1);

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(25	,5,'Customer ID',0,0);
$pdf->Cell(34	,5,$cust_id,0,1);


$pdf->Cell(189	,5,'',0,1);
$pdf->Cell(189	,10,'',0,1);

// Customer
$pdf->Cell(100	,5,'Receiver',0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$fullname,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$email,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$location,0,1);

$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$address,0,1);
$pdf->Cell(10	,5,'',0,0);
$pdf->Cell(90	,5,$postcode . ', ' . $city . ', ' . $state,0,1);

$pdf->Cell(10	,5,'',0,0);
// $pdf->Cell(90	,5,$phone,0,1);

$pdf->Cell(189	,10,'',0,1); //balnk cells

$pdf->SetFont('helvetica', '', 20);
$pdf->Cell(10	,10,'Description',0,1);
$pdf->SetFont('helvetica', '', 11);

$pdf->Cell(189	,5,'',0,1);

$pdf->Cell(100	,5,'Products',1,0);
$pdf->Cell(30	,5,'Quantity',1,0);
$pdf->Cell(59	,5,'Amount',1,1);

$query = "SELECT od.product_id, od.quantity, p.name, p.price, b.name AS brand_name 
    FROM order_details od
    INNER JOIN products p ON od.product_id = p.product_id
    INNER JOIN brand b ON p.brand_id = b.brand_id 
    WHERE od.order_id = '$order_id'";
$result = mysqli_query($con, $query);

$grand_total = 0; // Initialize grand total

while($row = mysqli_fetch_assoc($result)) {
    $product_name = $row['name'];
    $price = $row['price'];
    $brand_name = $row['brand_name'];
    $quantity = $row['quantity'];
    $total = $price * $quantity; // Calculate total for each product

    $grand_total += $total; // Add total to grand total

    $pdf->Cell(100, 5, "$brand_name $product_name", 1, 0);
    $pdf->Cell(30, 5, $quantity, 1, 0);
    $pdf->Cell(59, 5, $price, 1, 0, 'R');
}

$query = "SELECT od.product_id, od.quantity, p.name, p.price, b.name AS brand_name 
FROM order_details od
INNER JOIN products p ON od.product_id = p.product_id
INNER JOIN brand b ON p.brand_id = b.brand_id 
WHERE od.order_id = '$order_id'";
$result = mysqli_query($con, $query);

$grand_total = 0; // Initialize grand total

while($row = mysqli_fetch_assoc($result)) {
$product_name = $row['name'];
$price = $row['price'];
$brand_name = $row['brand_name'];
$quantity = $row['quantity'];
$total = $price * $quantity; // Calculate total for each product

$grand_total += $total; // Add total to grand total

$pdf->Cell(100, 5, "$brand_name $product_name", 1, 0);
$pdf->Cell(30, 5, $quantity, 1, 0);
$pdf->Cell(59, 5, $price, 1, 1, 'R');
}

$pdf->Cell(130	,5,'',0,0);
$pdf->Cell(10, 5, 'RM', 1, 0);
$pdf->Cell(49, 5, number_format($grand_total, 2), 1, 1, 'R');



$pdf->Cell(189	,10,'',0,1);

$pdf->Cell(130	,5,"Pay Via : {$order_details['payment_option']}",0,0);
$pdf->Cell(59	,5,'',0,1);

    
$pdf->Output('invoice.pdf', 'I');
}
?>

<?php include('includes/footer.php'); ?>