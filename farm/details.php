<?php include 'includes/session.php'; ?>
<?php
  if(isset($_SESSION['user'])){
    header('location: cart_view.php');
  }
?>
<?php
// echo $_GET['id'];
// print_r($_SESSION);
// exit();
if(isset($_GET['id'])==$_SESSION['c_id']){?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition register-page">
<div class="register-box">
  	<?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }

      if(isset($_SESSION['success'])){
        echo "
          <div class='callout callout-success text-center'>
            <p>".$_SESSION['success']."</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
    ?>
  	<div class="register-box-body">
    	<p class="login-box-msg">Address Information</p>
    	<form action="register.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="streets_number" placeholder="streets number"  required>
            <input type="hidden" class="form-control" name="c_id" placeholder="streets number" value="<?php echo $_GET['id'];?>"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="Sector" placeholder="Sector"  required>
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
      		<div class="form-group has-feedback">
        		<input type="text" class="form-control" name="District" placeholder="District"  required>
        		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      		</div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="city" placeholder="city" required>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <hr>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" name="signup_address"><i class="fa fa-pencil"></i>Submit</button>
        		</div>
      		</div>
    	</form>
      <br>
  	</div>
</div>
	
<?php include 'includes/scripts.php' ?>
</body>
</html>
  <?php }
  else{
     header('location: index.php');
  }
?>