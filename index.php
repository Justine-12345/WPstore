<?php
session_start();
 if (!isset($_SESSION['userInfo'])) {
  echo'<script>window.location="http://localhost/wpstore/login.php";</script>';
 }
include_once('order.php');
include_once("./includes/config.php");
$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
$_SESSION['oldUrl'] = $current_url;
?>
<!DOCTYPE html>
<html>

<head>
	<title>WP|Store</title>
<?php include_once('./css/style.php'); 
?>
</head>
<body>
	 
<?php
include('./includes/nav.php');
include('./css/carousel.php');

$numOfOrds = 0;
$ordBadge = "No Order";
if (isset($_SESSION['cart_order'])) {
 

	
	$numOfOrds = count($_SESSION['cart_order']);
	$ordBadge = "";
	if ($numOfOrds > 1) {
		$ordBadge = "See Orders";
	}
	elseif ($numOfOrds == 1) {
		$ordBadge = "See Order";
	}
	else{
		$ordBadge = "No Order";
	}
}
 ?>
<div class="accordion" id="accordionExample" style="position: fixed; z-index: 2; width: 350px; right: 0px; bottom: 0px; font-size: 12px; right: 5px">
  <div class="card">
    <div class="card-header" id="headingOne" style="background-color: lightblue">
      <h2 class="mb-0">
        <button class="btn btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: black; text-decoration: none;">
          <b><?php echo $ordBadge; ?> <span class="badge badge-danger"><?php echo $numOfOrds;  ?></span></b><i  class="fas fa-sort" style="float: right; padding-top: 5px; font-size: 20px"></i>
        </button>
      </h2>
    </div>

<?php 

$show = "";

if (@count($_SESSION['cart_order']) <= 0) {
	$show = "";
	unset($_SESSION['updating']);
}else{
	$show = "show";
}

if (isset($_SESSION['updating'])) {
	$show = "show";
}



$accordion = <<<HTML
      <div id="collapseOne" class="collapse {$show}" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body" style="padding: 0px">
      HTML;

echo $accordion;
?>

<form action="orderline.php" method="post">          
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Qty</th>
      <th scope="col">Name</th>
      <th scope="col">Price</th>
      <th scope="col">Total</th>
      <th scope="col">Remove</th>
    </tr>
  </thead>
  <tbody>
  
    	<!-- <p>No Order Yet <i class="far fa-sad-cry"></i></p> -->

<?php 
if (isset($_SESSION['cart_order'])) {
$i = 0;
 foreach ($_SESSION['cart_order'] as $itemOrders) {
 	 
 	$i++;
 	  $current_order  = <<<HTML
 	    <tr>
 	  <th scope="row"><input type="number" name="update[{$itemOrders['brandId']}]" value="{$itemOrders['quantity']}" style="width: 45px; text-align: center;" required min="0" max="100" step="1"> </th>

      <td>{$itemOrders['brand']}</td>

      <td>₱{$itemOrders['price']}</td>

      <td><b>₱{$itemOrders['total']}</b></td>

      <td>
         <div class="custom-control custom-switch">
  	     <input type="checkbox" name="remove[]" value="{$itemOrders['brandId']}"  class="custom-control-input" id="customSwitch{$i}">
         <label class="custom-control-label" for="customSwitch{$i}"></label>
         </div>
	  </td>
   </tr>
HTML;

echo $current_order;
}
} ?>
  </tbody>
</table>
<button type="submit" name="refresh" class="btn btn-primary" style="float: right; width: 49%" >Refresh</button>
<button type="submit" name="check" class="btn btn-primary" style="width: 49%" >Checkout</button>
</form>
      </div>
    </div>
  </div>
</div>


<div class="container">
<div class="row align-items-start" style="width:">

<?php 
 $dis = new Order;
 $brands = $dis->brands($conn);

 foreach ($brands as $brand) { 
  
 	if (isset($brand['brandSize'])) {
 		 $size = "Size :";
 	}
 	else{
 		$size = "";
 	}

$products_item = <<<HTML

    <div class="col" style="margin-bottom: 20px;margin-top: 20px;">
      <div class="card" style="width: 15rem; height: 29rem">
			  <img src="./images/{$brand['brandImage']}" class="card-img-top" alt="..." style=" width:  238px;
    height: 200px;
    object-fit: cover;">
			  <div class="card-body">
			    <h5 class="card-title">{$brand['brandName']}<span class="badge badge-pill badge-secondary" style="font-size: 10px; margin-left: 5px; float: right;">{$brand['brandStock']}</span><i style="font-weight: 400; font-size: 12px; float: right;"> Stocks</i></h5>
			    <p class="card-text" style="margin: 0px">Price : ₱{$brand['brandPrice']} </p>
			    <p class="card-text" style="margin: 0px">Category :{$brand['itemDesc']}</p>
			     <p class="card-text" style="margin: 0px">{$size}{$brand['brandSize']}</p>
			    <hr>

			    <form action="orderline.php" method="post">
			    	


                 <!-- For Quantity -->
                <div class="input-group mb-3">
			    <label class="input-group-text" for="inputGroupSelect01">Quantity</label>
                <input type="number" name="quantity" class="form-control" id="inputGroupSelect01" required min="1" max="500" style="1">
                </div>
                <input type="hidden" name="stock" value="{$brand['brandStock']}">
                <input type="hidden" name="brandId" value="{$brand['brandId']}">
                <input type="hidden" name="price" value="{$brand['brandPrice']}">
                <input type="hidden" name="brand" value="{$brand['brandName']}">
                <input type="hidden" name="size" value="{$brand['brandSize']}">
                <input type="hidden" name="itemId" value="{$brand['itemId']}">
                <input type="hidden" name="image" value="{$brand['brandImage']}">
				<input type="hidden" name="item" value="{$brand['itemDesc']}">
	
                <h2 style="text-align: center;">
			    	<button type="submit" name="order" class="btn btn-primary" style="width: 100%">Add</button> 
			      </h2>
 					</form>

			</div>
		</div>
    </div>
    <br>
HTML;
echo $products_item;
 }?>

  
  </div>
</div>








</body>
</html>