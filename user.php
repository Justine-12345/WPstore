<?php  
include_once("./includes/config.php");
session_start();

/**
 * 
 */
$user = new User;

if (isset($_POST['register'])) {
	$user->store($conn);
}

if (isset($_POST['login'])) {
	$user->login($conn);
}

if (isset($_POST['logout'])) {
	$user->logout();
}


class User{
	
	public function store($conn){

		$userFName = $_POST['userFName'];
		$userEmail = $_POST['userEmail'];
		$userPassword = sha1($_POST['userPassword']);
		$userLName = $_POST['userLName'];



		$emailChk = "SELECT * FROM users WHERE userEmail = ? LIMIT 1";

		$stmtt = $conn->prepare($emailChk);

		$stmtt->bind_param("s", $userEmail);

		$stmtt->execute();

		$results = $stmtt->get_result();
		$hasEmail = $results->fetch_assoc();

		if (count($hasEmail) > 0) {
			echo '<script>alert("This Email Is Already Exist")</script>';

			echo'<script>window.location="http://localhost/wpstore/register.php";</script>';
		}
		
		else{
	




	$sql = "INSERT INTO `users`(`userFName`, `userEmail`, `userPassword`, `userLName`) VALUES ( ?, ?, ?, ?)";

	if($stmt = mysqli_prepare($conn, $sql)){
		 
		mysqli_stmt_bind_param($stmt, "ssss", $userFName, $userEmail, $userPassword,$userLName);

		mysqli_stmt_execute($stmt);
		 echo '<script>alert("Account created successfully.")</script>';

		$lastId = $stmt->insert_id;
		$this->home($lastId, $conn);

		}  else{
        echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
		}
 		 
  		echo'<script>window.location="http://localhost/wpstore/register.php";</script>';
  	}

	}

	public function login($conn){

		$userEmail =  $_POST['userEmail'];
		$userPassword =  $_POST['userPassword'];

		$sql = "SELECT userId, userEmail, userPassword FROM users WHERE userEmail = ? LIMIT 1";

		$stmt = $conn->prepare($sql);

		$stmt->bind_param("s", $userEmail);

		$stmt->execute();

		$results = $stmt->get_result();
		$users = $results->fetch_assoc();

		if (@$users['userEmail'] == $userEmail) {
			
			 $password = sha1($userPassword);
			 $id =  $users['userId'];
			 if ($users['userPassword'] == $password) {
			 	$this->home($users['userId'], $conn);
			 }else{
			 	echo '<script>alert("This User Does Not Exist")</script>';
			    echo'<script>window.location="http://localhost/wpstore/login.php";</script>';
			 }
		}
		else{
			 echo '<script>alert("This User Does Not Exist")</script>';
			 echo'<script>window.location="http://localhost/wpstore/login.php";</script>';
		};

	}

	private function home($userId, $conn){

		$sql = "SELECT * FROM users WHERE userId = ? LIMIT 1";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $userId);
		$stmt->execute();
		$results = $stmt->get_result();
		$userInfo = $results->fetch_assoc();
		
		$_SESSION['userInfo'] = $userInfo;
		

		echo'<script>window.location="http://localhost/wpstore/index.php";</script>';

	}

	public function logout(){
		session_destroy();
		echo'<script>window.location="http://localhost/wpstore/login.php";</script>';
	}

}
















?>