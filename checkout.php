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




<div style="position: fixed;width: 15%;right: 0px; bottom:0px;" >
<h2>

<form action="order.php" method="post">
<button type="submit" name="placeOrder" class="btn btn-primary" style="width: 100%; font-size: 12px; right: 0px; " >Place Order <i class="fas fa-ruble-sign"></i></button>
</form>

<form action="orderline.php" method="post">

<a href="index.php" class="btn btn-primary" style="width: 100%; font-size: 12px" >Add More <i class="fas fa-plus"></i></a>
<br>
<button type="submit" name="refresh" class="btn btn-primary" style=" width: 100%;  font-size: 12px" >Refresh <i class="fas fa-sync"></i></button>
</h2>
</div>





    <span class="card" style="width: 100%; position: fixed; right: 0px; top: 56px;" id="er">
      <span style="font-weight: 500; color: grey;  font-family: 'Trebuchet MS', sans-serif; padding-left: 10px">Username:
        <?php echo ucwords($_SESSION['userInfo']['userFName'])." "; echo ucwords( $_SESSION['userInfo']['userLName']); ?>
       <br>
          Email: <?php echo $_SESSION['userInfo']['userEmail']; ?>
        

      <h5 style="text-align: right; color: red; width: 20%; float: right;" >Grand Total : <b>₱<?php echo $_SESSION['grandTotal']; ?></h5>
      </span>
    </span>



<table class="table " style="width: 90%; margin: auto; margin-top: 100px; margin-bottom: 200px">
  <thead>
    <tr>
      <th scope="col" style="width: 20%">Photos</th>
      <th scope="col">Description</th>
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
    <tr>  
      <th scope="row"><img src="./images/{$order['image']}" style=" width:  200px;
    height: 200px; object-fit: cover;"></th>
      <td style="font-size: 20px">

      <span class="badge badge-pill badge-secondary" style="font-size: 15px; margin-left: 5px; float: right;">{$order['stock']}</span><i style="font-weight: 400; font-size: 15px; float: right;"> Stocks</i>

      <p>Brand : {$order['brand']} </p>
      <p>Category : {$order['item']} </p>
      <p>{$size}{$order['size']} </p>
      <p>Price : ₱{$order['price']} <i style="color: gray; font-size: 12px">*each</i></p>
      <p>Qty : <input type="number" name="update[{$order['brandId']}]" value="{$order['quantity']}" style="width: 80px; text-align: center;" min="0" max="100" step="1" required><i style="color: gray; font-size: 12px">*click refresh after updating</i></p>
      <p style="float: right;">Total :<b style="color: red; font-weight: 500"> ₱ {$order['total']}</b> </p>
      </td>
    </tr>
    HTML;
    echo $finalOrder;

}


?>
  </tbody>
</table>


</form>

</body>
</html>