<?php require_once "securearea.php"; ?>
<?php require_once "php/PizzaHandler.php"; ?>
<?php $PizzaHandler = new PizzaHandler(); ?>
<?php $allPizzas = $PizzaHandler->getAllPizzas($isUserLoggedIn); ?>

<div id="container">
	<div class="half left">
	  <div class="center">
		<h2>FATHER JONATHON'S</h2>
		<p><strong>Best UHI Pizza</strong></p>
	  </div>
	</div>

	<div class="half right">
	  <div class="center">
			<div class="centralContainer">
			<h2>Pizzas</h2><h4>Total: £<strong id="totalCost">0</strong></h4>
				<div id="pizzaList">
				</div>
				<br>
				<div class="input-group" style="padding:10px;">
					<select class="form-control" id="pizzaselector">
					<?php
						for($i = 0; $i < sizeOf($allPizzas); $i++){
							?>
							<option value="<?php echo $allPizzas[$i]['pizzaID'];?>"><?php echo $allPizzas[$i]['pizzaName']; ?> £<?php echo $allPizzas[$i]['pizzaPrice']; ?></option>
							<?php
						}
					?>
					</select>
					<div class="input-group-append">
						<button class="btn btn-info" onclick="addPizzaToOrder()">Add Pizza</button>
					</div>
				</div>
				<div>
					<button class="btn btn-primary">Place Order</button>
				</div>
			</div>
	  </div>
	 
	  <?php require_once 'nav.php'; ?>
	</div>
</div>



<script>
function addPizzaToOrder(){
	var pizzaID = document.getElementById("pizzaselector").value;
	httpGetAsync("api/GetPizza.php?id="+pizzaID, function(response){
		
		var isPizzaAlreadyExist = false;
		arrayOfElements = document.getElementsByClassName("pizzaName");
		for(var i = 0; i < arrayOfElements.length; i++){
			if(response["pizzaName"] == arrayOfElements[i].innerText){
				isPizzaAlreadyExist = true;
				var parentElement = arrayOfElements[i].parentElement;
				var quantity = parentElement.children[1].children[0].innerText;
				var newQuantity = parseInt(quantity, 10) + parseInt(1, 10);
				parentElement.children[1].children[0].innerText = newQuantity;
				
				var existingSubTotal = parentElement.children[2].children[0].innerText;
				var newSubtotal = parseInt(existingSubTotal, 10) + parseInt(response["pizzaPrice"], 10);
				parentElement.children[2].children[0].innerText = newSubtotal;
			}
		}
		
		if(isPizzaAlreadyExist == false){
			var clonedNode = document.getElementById("exampleOrder").cloneNode(true);
			clonedNode.id = response['pizzaID'];
			clonedNode.children[0].innerText = response["pizzaName"];
			clonedNode.children[1].children[0].innerText = 1;
			clonedNode.children[2].children[0].innerText = response["pizzaPrice"];
			clonedNode.style.display = "block";
			
			document.getElementById("pizzaList").appendChild(clonedNode);
		}
		recalulateTotal(response["pizzaPrice"]);
	});
	
}

function removePizzaFromOrder(element){
	var totalSubtotal = element.children[2].children[0].innerText;
	if(element.children[1].children[0].innerText > 1){
		var oldQuantity = element.children[1].children[0].innerText;
		
		var priceOfOne = totalSubtotal/oldQuantity;
		
		var newSubtotal = totalSubtotal - priceOfOne;
		element.children[2].children[0].innerText = newSubtotal;
		
		var newQuantity = oldQuantity - 1;
		element.children[1].children[0].innerText = newQuantity;
	}else{
		var priceOfOne = totalSubtotal;
		element.remove();
	}
	priceOfOne = priceOfOne - (priceOfOne * 2);
	
	recalulateTotal(priceOfOne);
}

function recalulateTotal(changeValue){
	var totalNode = document.getElementById("totalCost");
	totalValue = totalNode.innerText;
	
	var newTotal = parseInt(totalValue, 10) + changeValue;
	
	if(Number.isNaN(newTotal)){
		newTotal = 0;
	}
	totalNode.innerText = newTotal;
}
</script>

<div id="exampleOrder" style="display:none; margin-left:10%; margin-right:10%; border: 1px solid black; text-align:left;">
	<h3 id="pizzaOrderName" class="pizzaName">[Pizza Name]</h3>
	<p id="pizzaOrderQuantity" class="pizzaQuantity" style="line-height:0">Quantity: <strong></strong></p>
	<p id="pizzaOrderSubtotal" class="pizzaSubtotal" style="line-height:0">Subtotal: £<strong></strong></p>				
	<button onclick="removePizzaFromOrder(this.parentElement)" class="btn btn-danger">Remove</button>
</div>
