<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
if(isset($_POST['card_save'])){
		$card_name = $_POST['cardname'];
		$card_num = $_POST['cardnumber'];
		$exp_month = $_POST['expmonth'];
		$exp_year = $_POST['expyear'];
		$cvv = $_POST['cvv'];
		$id=$_POST['c_id'];
		$status=1;
		$u_id=$_SESSION['user'];
		try{
		$conn = $pdo->open();	
		$stmt = $conn->prepare("UPDATE card_details SET card_name=:card_name,card_num=:card_num, 	exp_month=:exp_month,exp_year=:exp_year,cvv=:cvv,u_id=:u_id,status=:status WHERE id=:id");
		$stmt->execute(['card_name'=>$card_name,'card_num'=>$card_num,'exp_month'=>$exp_month, 'exp_year'=>$exp_year,'cvv'=>$cvv,'u_id'=>$u_id,'status'=>$status,'id'=>$id]);
		$_SESSION['success'] = 'Card updated successfully';
		}
		catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

?>
<script type="text/javascript">
function cardnumber(inputtxt)
{
  var cardno = /^(?:5[1-5][0-9]{14})$/;
  if(inputtxt.value.match(cardno))
    {return true;}
  var cardno1 = /^(?:4[0-9]{12}(?:[0-9]{3})?)$/;
  if(inputtxt.value.match(cardno1))
    {
      return true;
     }
    else
        {
        alert("Not a valid credit card number! Only Visa & Mastercard Accepted");
        return false;
        }  
}
</script>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
	<?php include 'includes/navbar.php'; ?>
	  <div class="content-wrapper">
	    <div class="container">
	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<h1 class="page-header">Checkout</h1>
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='callout callout-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}

	        			if(isset($_SESSION['success'])){
	        				echo "
	        					<div class='callout callout-success'>
	        						".$_SESSION['success']."
	        					</div>
	        				";
	        				unset($_SESSION['success']);
	        			}
	        		?>
	        		<?php
	        			if(isset($_SESSION['user'])){
	        			$stmt = $conn->prepare("SELECT * FROM card_details WHERE u_id=:id");
						$stmt->execute(['id'=>$_SESSION['user']]);
						$card_session = $stmt->fetch();
	        			?>	    
	        			<div class="row">
  		<?php if($card_session['status']>0) { ?>
  		<div class="col-75">
  		    
      	<form action="sales.php" method="POST"> 
      	<Span><bold style="font-size: 30px;">Saved Card Details </bold>
      	<button type="button" class="btn1 btn-info btn-lg" data-toggle="modal" data-target="#myModal" style="float: right;width: 139px;">Edit card Detail
      	</button>
      	</span> 
      	<hr style="width: 100%;">

        <br>
        <label for="cname">Card Number :-<?php echo  $card_session['card_num'];?></label>
        <br>
        <label for="cname">Expiry Month:- <?php echo $card_session['exp_month'];?></label>
        <br>
        <label for="cname">Expiry Year:- <?php echo $card_session['exp_year'];?></label>
        <br>
        <label for="cname">Cvv:- <?php echo  $card_session['cvv'];?></label>
        <br>
        <input type="hidden" id="cname" name="cardname" placeholder="John More Doe" value="<?php echo $card_session['card_name'];?>">
        <input type="hidden" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" value="<?php echo $card_session['card_num'];?>">
        <input type="hidden" id="expyear" name="expyear" placeholder="2018" value="<?php echo $card_session['exp_month'];?>">
        <input type="hidden" id="expmonth" name="expmonth" placeholder="September" value="<?php echo $card_session['exp_month'];?>">
        <input type="hidden" id="cvv" name="cvv" placeholder="352" value="<?php echo  $card_session['cvv'];?>">
        <input type="checkbox" name="sameadr" value='1' style="display: none;">
        <input type="submit" value="Continue to checkout" class="btn1" name="check_btn" >
        </form>
        
    	</div>
    	<?php } ?>
    	  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Card Details</h4>
        </div>
        <div class="modal-body">
        <form action="checkout.php" method="POST" name="form2" onSubmit="return cardnumber(document.form2.cardnumber)">   	
        <div class="row">
          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
             <i class="fa fa-cc-mastercard" style="color:red;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe" value="<?php echo $card_session['card_name'];?>">
            <input type="hidden" id="c_id" name="c_id" placeholder="c_id" value="<?php echo $card_session['id'];?>">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" value="<?php echo $card_session['card_num'];?>">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" value="<?php echo $card_session['exp_month'];?>">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018" value="<?php echo $card_session['exp_month'];?>">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352" value="<?php echo  $card_session['cvv'];?>">
              </div>
            </div>
          </div>
          
        </div>
     <input type="submit" value="Saved Card Detils" class="btn1" name="card_save">
      </form>
        </div>
      </div>
      
    </div>
  </div>
  
  		<div class="col-50">
  			<hr>
      	<form action="sales.php" method="POST" name="form3" onSubmit="return cardnumber(document.form3.cardnumber)">   	
        <div class="row">
          <div class="col-50">
            <h3>Add New Card Details</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
             <i class="fa fa-cc-mastercard" style="color:red;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="John More Doe">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2018">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="352">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" name="sameadr" value='1'> Save Card
        </label>
        <input type="submit" value="Continue to checkout" class="btn1" name="check_btn">
      </form>
    </div>
  </div>	

	        		<?php	
	        	}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
	        		?>
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
<script>
var total = 0;
$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}
</script>
<!-- Paypal Express -->
<style type="text/css">
* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}


input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn1 {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 40%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn1:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</body>
</html>