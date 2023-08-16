<?php  

include('./includes/config.php');
$order = new Order;



/**
 * 
 */

if (isset($_POST['placeOrder'])) {
	$order->store($conn);
}

if (isset($_POST['orderAgain'])) {
	$order->orderAgain();
}


class Order{
	
	public function brands($conn){

		$sql = "SELECT brands.*, items.*  FROM items, brands WHERE brands.itemId = items.itemId";

		$results = mysqli_query($conn,$sql);

		return $results;
}



public function store($conn)
{session_start();

	if (!isset($_SESSION['cart_order'])) 
	{
      echo '<script>alert("No Order to Place")</script>';
      echo '<script>window.location="http://localhost/wpstore/index.php";</script>';
    }



    if (count($_SESSION['cart_order']) > 0) 
    {	
     	$grandTotal = 0;
     	foreach ($_SESSION['cart_order'] as $order => $values) 
     	{
     		foreach ($values as $key => $value) 
     		{
     			if ($key == 'total') 
     			{
     				$grandTotal = $grandTotal + $value;
     			}
     		}
     	}
     	 $_SESSION['grandTotal'] = $grandTotal;

     	 	$orderDate = date("Y-m-d");
     	 	$_SESSION['orderDate'] = $orderDate;

     	 	$orderTotal = $_SESSION['grandTotal'];

     	 	$orderCode = rand();
     	 	$_SESSION['orderCode'] = $orderCode;

     	 	$userId = $_SESSION['userInfo']['userId'];

mysqli_begin_transaction($conn);
	    try
	    {

     	 	$sql1 = "INSERT INTO `orders`(`orderDate`, `orderTotal`, `orderCode`, `userId`) VALUES ( ?, ?, ?, ?)";

				if($stmt1 = mysqli_prepare($conn, $sql1))
				{
				 
				mysqli_stmt_bind_param($stmt1, "sssi", $orderDate, $orderTotal, $orderCode, $userId);
				mysqli_stmt_execute($stmt1);

				$lastOrderId = $stmt1->insert_id;

					foreach ($_SESSION['cart_order'] as $itemId => $attributes) 
				    {	
					
					$ordelineQty = $attributes['quantity'];
					$orderlinePrice = $attributes['total'];
					$orderId = $lastOrderId;
					$brandId = $attributes['brandId'];
					
					
						$sql2 = "INSERT INTO `orderline`(`ordelineQty`, `orderlinePrice`, `orderId`, `brandId`) VALUES ( ?, ?, ?, ?)";

						if($stmt2 = mysqli_prepare($conn, $sql2))
						{
						 
						mysqli_stmt_bind_param($stmt2, "idii", $ordelineQty, $orderlinePrice, $orderId, $brandId);

						mysqli_stmt_execute($stmt2);


						$sql3 = "UPDATE `brands` SET `brandStock`= (`brandStock` - ".$ordelineQty.")  WHERE brandId = ".$brandId." ";

						mysqli_query($conn, $sql3);

						
					   echo'<script>window.location="http://localhost/wpstore/placeorder.php";</script>';
						mysqli_commit($conn);
			            }
			            else
			            {
		        		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
						}	
					
				    }

	            }
	            else
	            {
        		echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
				}
				
		}
		catch(mysqli_sql_exception $exception)
		{
			  mysqli_rollback($conn);

              throw $exception;

		}

				//Start of Inserting
				
				//End of inserting



	}
	else
	{
		echo '<script>alert("No Order To Placed")</script>';
		echo'<script>window.location="http://localhost/wpstore/index.php";</script>';
	}


}


public function orderAgain()
{ session_start();
	unset($_SESSION['cart_order']);
	unset($_SESSION['grandTotal']);
	unset($_SESSION['orderCode']);
	unset($_SESSION['orderDate']);


	header('Location:index.php');
	
}



public function orderList($conn){
	if (isset($_SESSION['userInfo'])) 
	{	
		$id = $_SESSION['userInfo']['userId'];
		

		$sql = "SELECT orders.*  FROM users, orders WHERE users.userId = orders.userId AND users.userId = ".$id." ORDER BY orders.orderId DESC";

		$results = mysqli_query($conn,$sql);

		return $results;

	}
	else
	{
	     echo'<script>window.location="http://localhost/wpstore/login.php";</script>';
	}



}




public function orderLineList($conn, $orderId){
	if (isset($_SESSION['userInfo'])) 
	{			

		$sql = " SELECT orderline.*, brands.*, items.* FROM orderline, items, brands WHERE orderline.brandId = brands.brandId AND items.itemId = brands.itemId AND orderline.orderId = ".$orderId." ";

		$results = mysqli_query($conn,$sql);

		return $results;

	}
	else
	{
	     echo'<script>window.location="http://localhost/wpstore/login.php";</script>';
	}



}




}

?>