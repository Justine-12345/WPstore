<?php  
include_once("./includes/config.php");
session_start();


// print_r($_POST);
$order = new Orderline;

//for adding orders
if(isset($_POST['order'])){
$order->create($conn);
}

//for refreshing orders
if(isset($_POST['refresh'])){
	$order->refresh($conn);
}


//for refreshing orders
if(isset($_POST['check'])){
	$order->checkout($conn);
}

/**
 * 
 */
class Orderline{
	
	public function create($conn){
		print_r($_POST);
		$brandId= $_POST['brandId'];
		 $quantity= $_POST['quantity'];
		 $price= $_POST['price'];
		// $brand=$_POST['brand'];
		// $size= $_POST['size'];
		// $itemId= $_POST['itemId'];
		// $image= $_POST['image'];
		// $item= $_POST['item'];
		// $order= $_POST['order'];

		 $total = $quantity * $price;
		
		$_SESSION['cart_order'][$brandId] = $_POST;
		$_SESSION['cart_order'][$brandId]['total'] = $total;

		
		
		header('Location:http://localhost/wpstore/index.php');

	}



	public function refresh($conn){

if (count($_SESSION['cart_order']) > 0) 
   {
	$_SESSION['updating'] = 1;

   		if (isset($_POST['update'])) {
   			foreach ($_POST['update'] as $brandId => $quantity) {
			if ($quantity == 0) {
			    unset($_SESSION['cart_order'][$brandId]);
			}else{
				$price = $_SESSION['cart_order'][$brandId]['price'];
				$total = $price * $quantity;

				$_SESSION['cart_order'][$brandId]['quantity'] = $quantity;
				$_SESSION['cart_order'][$brandId]['total'] = $total;
			}
		    }

   		}

	    
		
   		if (isset($_POST['remove'])) {
		foreach ($_POST['remove'] as $brandId ) {
		    echo $brandId;
	 	    unset($_SESSION['cart_order'][$brandId]);
		 	}
			
		}
	}
	else
	{
	    echo '<script>alert("No Order To Refresh")</script>';

	}
	$this->checkout($conn);

	header('Location: ' . $_SERVER['HTTP_REFERER']);
exit;
	

}


    public function checkout($conn){
    

    if (!isset($_SESSION['cart_order']) || !isset($_SESSION)) {
     echo '<script>alert("No Order To Checkout")</script>';
     echo '<script>window.location="http://localhost/wpstore/index.php";</script>';
    }


    if (count($_SESSION['cart_order']) > 0) 
    {
    	$grandTotal = 0;
    	foreach ($_SESSION['cart_order'] as $order => $values) {
    		foreach ($values as $key => $value) {
    			if ($key == 'total') {
    				$grandTotal = $grandTotal + $value;
    			}
    		}
    	}
    	 $_SESSION['grandTotal'] = $grandTotal;

    	echo'<script>window.location="http://localhost/wpstore/checkout.php";</script>';
    }
    else
	{
	    echo '<script>alert("No Order To Refresh")</script>';

	}

	echo '<script>window.location="http://localhost/wpstore/index.php";</script>';


}


}
?>