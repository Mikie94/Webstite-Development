<?php
	include 'includes/session.php';
	include 'includes/slugify.php';
	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$name = $_POST['name'];
		$slug = slugify($name);
		$filename = $_FILES['photo']['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$new_filename = $slug.'.'.$ext;
		move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);
		try{
			$stmt = $conn->prepare("UPDATE category SET name=:name,cat_slug=:cat_slug,c_photo=:c_photo WHERE id=:id");
			$stmt->execute(['name'=>$name, 'id'=>$id,'cat_slug'=>$slug,'c_photo'=>$new_filename]);
			$_SESSION['success'] = 'Category updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}
		
		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up edit category form first';
	}

	header('location: category.php');

?>