<?php  
session_start();

 if (!isset($_SESSION['cart_order']) || !isset($_SESSION)) {
     echo '<script>window.location="http://localhost/wpstore/index.php";</script>';
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>WP|Checkout</title>
<?php include('./css/style.php'); ?>

</head>
<body>
<?php include('./includes/nav.php'); 
 ?>


<div class="alert alert-primary" role="alert" style="width: 80%; margin: auto;margin-top: 10px; text-align: center; font-size: 30px">
  TO SHIP ORDER!!!
</div>

<div style="position: fixed;width: 10% ; right: 0px; bottom:0px;" >
<h2>

<form action="order.php" method="post">
<button type="submit" name="orderAgain" class="btn btn-primary" style="width: 100%; font-size: 12px" >Order Again <i class="fas fa-cart-plus"></i></button>
</form>

<div>
</h2>
</div>



<table class="table" style="width: 80%; margin: auto; margin-top: 10px; margin-bottom: 100px">
  <thead>

    <tr class="table-primary" style="font-size: 12px">
      <th scope="col" style="width: 20%;">
      	<p style="margin: 0px">Order Code : <?php echo $_SESSION['orderCode'];  ?></p>
      	<p style="margin: 0px">Date : <?php echo $_SESSION['orderDate'];  ?></p>
      	<p style="margin: 0px">Reciever :  <?php echo ucwords($_SESSION['userInfo']['userFName'])." "; echo ucwords( $_SESSION['userInfo']['userLName']); ?></p>
      </th>
      <th scope="col" style="margin: 0px">
      <h6 style="text-align: right; color: red; width: 30%; float: right;" >Order Price: <b>₱<?php echo $_SESSION['grandTotal']; ?></h6></th>
    </tr>
  </thead>
  <tbody>

<?php
foreach ($_SESSION['cart_order'] as $order) {

  if (@!empty($order['size'])) {
     $size = "Size : ";
  }
  else{
    $size = "";
  }

$finalOrder = <<<HTML
    <tr class="table-primary">  
    <th scope="row"><img src="./images/{$order['image']}" style=" width:  100px;height: 100px; object-fit: cover;"></th>
    <td style="font-size: 12px">
    <p>Brand : {$order['brand']} </p>
    <p>Category : {$order['item']} </p>
    <p>{$size}{$order['size']} </p>
    <p>Price : ₱{$order['price']} </p>
    <p>Qty : {$order['quantity']}</p>
    <p style="float: right;">Total :<b style="color: red;"> ₱ {$order['total']}</b> </p>
    </td>
    </tr>
    HTML;
    echo $finalOrder;
}


?>
  </tbody>
</table>


</body>
</html>