<?php  
include('./includes/config.php');
include('order.php');
session_start();
 if (!isset($_SESSION)) {
     echo '<script>window.location="http://localhost/wpstore/index.php";</script>';
    }

if (isset($_POST['myOrders'])) {
   $order = new Order;
   $allOrders = $order->orderList($conn);

}
else{
  echo '<script>window.location="http://localhost/wpstore/index.php";</script>';
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>WP|Orders</title>
<?php include('./css/style.php'); ?>

</head>
<body>
<?php include('./includes/nav.php'); 
 ?>


<div class="alert alert-primary" role="alert" style="width: 80%; margin: auto;margin-top: 10px; text-align: center; font-size: 30px">
  ALL ORDERS!!!
</div>

<div style="position: fixed;width: 10% ; right: 0px; bottom:0px;" >
<h2>

<form action="order.php" method="post">
<button type="submit" name="orderAgain" class="btn btn-primary" style="width: 100%; font-size: 12px" >Order Again <i class="fas fa-cart-plus"></i></button>
</form>
<div>
</h2>
</div>


<?php 
foreach($allOrders as $order){
?>



<table class="table" style="width: 80%; margin: auto; margin-top: 10px; margin-bottom: 30px">
  <thead>

    <tr class="table-primary" style="font-size: 12px">
      <th scope="col" style="width: 20%;">
      	<p style="margin: 0px">Order Code : <?php echo $order['orderCode'];  ?></p>
      	<p style="margin: 0px">Date : <?php echo $order['orderDate'];  ?></p>
      	<p style="margin: 0px">Reciever :  <?php echo ucwords($_SESSION['userInfo']['userFName'])." "; echo ucwords( $_SESSION['userInfo']['userLName']); ?></p>
      </th>
      <th scope="col" style="margin: 0px">
      <h6 style="text-align: right; color: red; width: 30%; float: right;" >Order Price: <b>₱<?php echo $order['orderTotal']; ?></h6></th>
    </tr>
  </thead>
  <tbody>

<?php 
   //order Id 
   $lineId = $order['orderId'];
   //order instance
   $orderline = new Order;
   //order list function
   $allOrderLine = $orderline->orderLineList($conn, $lineId );

foreach ($allOrderLine as $orderline) {
  $size = " ";
if (isset($orderline['brandSize'])){
  $size = "Size : ";
}
 

$displayOl = <<<HTML
    <tr class="table-primary">  
    <th scope="row"><img src="./images/{$orderline['brandImage']}" style=" width:  100px;height: 100px; object-fit: cover;"></th>
    <td style="font-size: 12px">
    <p>Brand : {$orderline['brandName']} </p>
    <p>Category : {$orderline['itemDesc']} </p>
    <p>{$size}{$orderline['brandSize']} </p>
    <p>Price : ₱{$orderline['brandPrice']} </p>
    <p>Qty : {$orderline['ordelineQty']}</p>
    <p style="float: right;">Total :<b style="color: red;">₱{$orderline['orderlinePrice']}</b> </p>
    </td>
    </tr>
    HTML;
echo $displayOl;
}
?>

  </tbody>
</table>

<?php
};
?>

</body>
</html>