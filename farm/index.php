<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container-fluid" style="padding:0px; ">

	      <!-- Main content -->
	      <section class="content" style="padding:0px; "> 
	        <div class="row">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/b1.jpg" alt="First slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/b2.jpg" alt="Second slide">
		                  </div>
		                  <div class="item">
		                    <img src="images/b3.jpg" alt="Third slide">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
		            <br>
		            <div class="col-sm-9">
		            <div class="row">
		            <h2><center>Category</center></h2>
					    <?php		             
			                $conn = $pdo->open();
			                try{
			                  $stmt = $conn->prepare("SELECT * FROM category");
			                  $stmt->execute();
			                  foreach($stmt as $row){
			                  	$image = (!empty($row['c_photo'])) ? 'images/'.$row['c_photo'] : 'images/noimage.jpg';
			                  	?>
			                   <div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src="<?php echo $image ;?>" width='100%' height='230px' class='thumbnail'>
		       							<h5><a href=<?php echo "category.php?category=".$row['cat_slug'];?>><?php echo $row['name'];?> <a></h5>
		       								</div>
		       							</div>	
		       						</div>
			                   <?php                  
			                  }
			                }
			                catch(PDOException $e){
			                  echo "There is some problem in connection: " . $e->getMessage();
			                }
			                $pdo->close();
			              ?>	
		            </div>
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>