<?php require_once "securearea.php"; ?>
<?php require_once "php/UserHandler.php"; ?>
<?php require_once "php/PizzaHandler.php"; ?>
<?php $UserHandler = new UserHandler(); ?>
<?php $PizzaHandler = new PizzaHandler(); ?>
<?php $allPizzas = $PizzaHandler->getUserPizzas($isUserLoggedIn); ?>
<?php $explodeUserAddress = explode("|", $currentUser["userAddress"]); ?>

<div id="container">
	<div class="half left">
	  <div class="center">
		<h2>FATHER JONATHON'S</h2>
		<p><strong>Best UHI Pizza</strong></p>
	  </div>
	</div>

	<div class="half right">
		<?php require_once 'nav.php'; ?>
		<div class="center">
			<div class="centralContainer" style="text-align:left; background:rgba(255,255,255,0.8); width: 100%; border-radius: 10px">
				<h2><?php echo $currentUser['email']; ?></h2>
				<p id="tel">Tel: <strong><?php echo $currentUser['userTelNo']; ?></strong> <button class="btn btn-info" onclick="amend(this.parentElement, this.parentElement.children[0].innerText, this);">Amend</button></p>
				<p id="ad1">Address 1: <strong><?php echo $explodeUserAddress[0]; ?></strong> <button class="btn btn-info" onclick="amend(this.parentElement, this.parentElement.children[0].innerText, this);">Amend</button></p>
				<p id="ad2">Address 2: <strong><?php echo $explodeUserAddress[1]; ?></strong> <button class="btn btn-info" onclick="amend(this.parentElement, this.parentElement.children[0].innerText, this);">Amend</button></p>
				<p id="ad3">Address 3: <strong><?php echo $explodeUserAddress[2]; ?></strong> <button class="btn btn-info" onclick="amend(this.parentElement, this.parentElement.children[0].innerText, this);">Amend</button></p>
				<h2>Custom Pizzas</h2>
				<?php
				if(sizeOf($allPizzas) == 0){
					?>
					<p>You have no pizzas, maybe you should design <a style="color:blue; text-decoration: underline; cursor:pointer;" onclick='loadPage("createPizza.php");'>one</a>!</p>
					<?php
				}
				for($i = 0; $i < sizeOf($allPizzas); $i++){
					?>
					<div id="<?php echo $allPizzas[$i]['pizzaID'];?>" style="display:block; margin-left:10%; margin-right:10%; border: 1px solid black; text-align:left;">
						<h3 id="pizzaOrderName" class="pizzaName"><?php echo $allPizzas[$i]['pizzaName']; ?> </h3>
						<p style="line-height:0">Topping 1: <b><?php echo $allPizzas[$i]['topping1'];?></b></p>
						<p style="line-height:0">Topping 2: <b><?php echo $allPizzas[$i]['topping2'];?></b></p>
						<p style="line-height:0">Topping 3: <b><?php echo $allPizzas[$i]['topping3'];?></b></p>
						<p id="pizzaOrderSubtotal" class="pizzaSubtotal" style="line-height:0">Total Price: £<strong><?php echo $allPizzas[$i]['pizzaPrice']; ?></strong></p>				
						<button onclick="removePizza(this.parentElement, this.parentElement.id)" class="btn btn-danger">Delete</button>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</div>

<script>
function amend(parentElement, originalLog, buttonElement){
	var userID = "<?php echo $currentUser["userID"]; ?>";
	var elementTagName = parentElement.children[0].tagName;
	if(elementTagName == "INPUT"){
		var elementType = parentElement.id;
		var inputValue = parentElement.children[0].value;
		httpGetAsync("api/AmendUser.php?value="+inputValue+"&type="+elementType+"&id="+userID, function(){
			var amendInput = document.createElement('strong');
			amendInput.innerText = inputValue;
			parentElement.replaceChild(amendInput, parentElement.children[0]);
			buttonElement.innerText = "Amend";
		});
	}else{
		var amendInput = document.createElement('input');
		amendInput.value = originalLog;
		parentElement.replaceChild(amendInput, parentElement.children[0]);
		buttonElement.innerText = "Confirm";
	}
	
}

function removePizza(element, pizzaID){
	var removePizzaValue = confirm("Are you sure you want to delete this pizza?");
	if(removePizzaValue == true){
		httpGetAsync("api/RemovePizza.php?id="+pizzaID, function(response){
			if(response["result"]){
				element.remove();
			}else{
				console.log("Pizza Not Removed");
			}
		});
	}
	
}
</script>
