<?php
	include 'includes/session.php';
	if(isset($_POST['check_btn'])){
		$cardname = $_POST['cardname'];
		$cardnumber = $_POST['cardnumber'];
		$expmonth = $_POST['expmonth'];
		$expyear = $_POST['expyear'];
		$cvv = $_POST['cvv'];
		$sameadr= $_POST['sameadr'];
		$date = date('Y-m-d');
		$u_id=$_SESSION['user'];
		$user['id']=$_SESSION['user'];
		$payid=strtotime(date("h:i:sa"));
		$status=1;
		$conn = $pdo->open();
		if($sameadr){
			$stmt = $conn->prepare("INSERT INTO card_details (u_id, card_name, card_num,exp_month,	exp_year,cvv,status) VALUES (:u_id, :card_name, :card_num,:exp_month,:exp_year,:cvv,:status)");
			$stmt->execute(['u_id'=>$u_id, 'card_name'=>$cardname, 'card_num'=>$cardnumber,'exp_month'=>$expmonth,'exp_year'=>$expyear,'cvv'=>$cvv,'status'=>$status]);
		}
		try{
		$email_list=[];
		array_push($email_list,$_SESSION['email']);
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE type =:type");
		$stmt->execute(['type'=>1]);
		$row = $stmt->fetch();
		if($row['numrows'] > 0){
				if($row['status']){
						if($row['type']){
							array_push($email_list,$row['email']);
;
						}
					}
				}

			$stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname FROM cart LEFT JOIN products ON products.id=cart.product_id LEFT JOIN category ON category.id=products.category_id WHERE user_id=:user_id");
			$stmt->execute(['user_id'=>$user['id']]);
		$sum=0;
		$dts='';
		foreach($stmt as $row){
				//$output['count']++;
				//$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
				$productname = $row['prodname'];
				$quantity=$row['quantity'];
				$price=$row['price'];
				$sub_total=$quantity*$price;
				$sum=$sum+$sub_total;
				$dts .="<tr><td>". $productname ."</td>
							<td> $".$price."</td>
							<td>".$quantity."</td>
							<td> $".$sub_total."</td>
				";			
			}
			$stmt = $conn->prepare("INSERT INTO sales (user_id, pay_id, sales_date) VALUES (:user_id, :pay_id, :sales_date)");
			$stmt->execute(['user_id'=>$user['id'], 'pay_id'=>$payid, 'sales_date'=>$date]);
			$salesid = $conn->lastInsertId();
			try{
				$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id=cart.product_id WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);

				foreach($stmt as $row){
					$stmt = $conn->prepare("INSERT INTO details (sales_id, product_id, quantity) VALUES (:sales_id, :product_id, :quantity)");
					$stmt->execute(['sales_id'=>$salesid, 'product_id'=>$row['product_id'], 'quantity'=>$row['quantity']]);
				}
				$stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
				$stmt->execute(['user_id'=>$user['id']]);
				$_SESSION['success'] = 'Transaction successful. Thank you.';
				$message = "
					<!DOCTYPE html>
						<html>
						<head>
						<style>
						table {
						  font-family: arial, sans-serif;
						  border-collapse: collapse;
						  width: 100%;
						}

						td, th {
						  border: 1px solid #dddddd;
						  text-align: left;
						  padding: 8px;
						}

						tr:nth-child(even) {
						  background-color: #dddddd;
						}
						</style>
						</head>
						<body>
						<h2>Thank you for Placing Order.</h2>
						<br>
						<h2>Your Order Details:</h2>
						<br>
						<table>
							<tr>
							<td>Product Name </td>
							<td>Price </td>
							<td>Quantity</td>
							<td>Sub Total</td>
							</tr>
							".
							$dts	
						."
						</table>
						<p><b>Total Amount is : $".$sum."</b></p>
						<br>
						<h2>Customer Details:-</h2>
						<br>
						<table>
							<tr>
							<td>First Name</td>
							<td>Last Name</td>
							<td>Email Id</td>
							<td>Contact Details</td>
							<td>Address</td>
							</tr>
						<tr>
						<td>".$_SESSION['firstname']."</td>
						<td>".$_SESSION['lastname']."</td>
						<td>".$_SESSION['email']."</td>
						<td>".$_SESSION['contact']."</td>
						<td>".$_SESSION['address']."</td>
						</tr>
						</table>
					</body>
					</html>	
					";
					$subject = 'Order Details ';
					$headers = "MIME-Version: 1.0" . "\r\n";
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
					for($i=0;$i<count($email_list);$i++)
				        {	$to=$email_list[$i];
				        	if(mail($to,$subject,$message,$headers))
				        	{
				        	unset($_SESSION['cart']);
				        	//$_SESSION['success'] = 'You Have Successfully Placed The Order';
				        	header('location: profile.php');
				        	}
				        	else{
				        		$_SESSION['error'] = 'Mail Not Send';
				        		header('location: profile.php');
				        	}

				    	}
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}

		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();
	}
	
	header('location: profile.php');
	
?>