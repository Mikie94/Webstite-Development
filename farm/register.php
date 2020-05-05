<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	include 'includes/session.php';

	if(isset($_POST['signup'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$repassword = $_POST['repassword'];
		$_SESSION['firstname'] = $firstname;
		$_SESSION['lastname'] = $lastname;
		$_SESSION['email'] = $email;
		if($password != $repassword){
			$_SESSION['error'] = 'Passwords did not match';
			header('location: signup.php');
		}
		else{
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE email=:email");
			$stmt->execute(['email'=>$email]);
			$row = $stmt->fetch();
			// print_r($row);
			// exit();
			 if($row['numrows']> 0){
				$_SESSION['error'] = 'Email already taken';
				header('location: signup.php');
			}
			else{
				$now = date('Y-m-d');
				$password = password_hash($password, PASSWORD_DEFAULT);
				// print_r($_POST);
				// exit();
				//generate code
				$set='123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$code=substr(str_shuffle($set), 0, 12);
				try{
					$stmt1 = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, activate_code, created_on,type) VALUES (:email, :password, :firstname, :lastname, :code, :now ,:type)");
					$stmt1->execute(['email'=>$email, 'password'=>$password, 'firstname'=>$firstname, 'lastname'=>$lastname, 'code'=>$code, 'now'=>$now,'type'=>0]);
					$userid = $conn->lastInsertId();
					$_SESSION['c_id']=$userid;
				    header('location: details.php?id='.$userid);
				    
				    exit();
				}
				catch(PDOException $e){
					$_SESSION['error'] = $e->getMessage();
					header('location: register.php');
				}

				$pdo->close();

			}

		}

	}
	if(isset($_POST['signup_address'])){
		$streets_number = $_POST['streets_number'];
		$sector = $_POST['Sector'];
		$district = $_POST['District'];
		$city = $_POST['city'];
		$c_id= $_POST['c_id'];
		if(strtolower($city) !='kigali' ){
			$_SESSION['error'] = 'City Should be kigali';
			header('location: details.php?id='.$c_id);
		}
		else{
			$conn = $pdo->open();
			$stmt1 = $conn->prepare("UPDATE users SET street_num=:street_num, sector=:sector, district=:district, city=:city WHERE id=:id");
			$stmt1->execute(['street_num'=>$streets_number, 'sector'=>$sector, 'district'=>$district, 'city'=>$city, 'id'=>$c_id]);
			$_SESSION['success'] = 'Account created. Please Login.';
			header('location: login.php');
			}
			$pdo->close();
		}
		
	// else{
	// 	$_SESSION['error'] = 'Fill up signup form first detilss';
	// 	header('location: signup.php');
	// }

?>