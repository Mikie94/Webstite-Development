
<?php
	include 'includes/session.php';
	include 'includes/slugify.php';
	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$slug = slugify($name);
		$filename = $_FILES['photo']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$new_filename = $slug.'.'.$ext;
		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM category WHERE name=:name");
		$stmt->execute(['name'=>$name]);
		$row = $stmt->fetch();
		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Category already exist';
		}
		else{
			try{
				$stmt = $conn->prepare("INSERT INTO category (name,cat_slug,c_photo) VALUES (:name,:cat_slug, :c_photo)");
				
				$stmt->execute(['name'=>$name,'cat_slug'=>$slug,'photo'=>$new_filename]);
				
				$_SESSION['success'] = 'Category added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up category form first';
	}

	header('location: category.php');

?>