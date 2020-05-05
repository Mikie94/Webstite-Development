<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        	<h2>About US</h2>
	        	<p>
	        	A farm is an area of land that is devoted primarily agricultural processes with the primary objective of producing food and other crops; it is the basic facility in food production. At Rumo Farm, we cultivate crops naturally with no chemicals, which gives our crops the best taste in Kigali. We work with diverse hotels and Restaurants, as well as individual people. We celiver our products in a safe manner.
		            <br>
			
	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>