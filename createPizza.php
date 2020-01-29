<?php require_once "securearea.php"; ?>
<?php require_once "php/ToppingHandler.php"; ?>
<?php $ToppingHandler = new ToppingHandler(); ?>
<?php $allToppings = $ToppingHandler->getAllToppings(); ?>

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
			<div class="form-group centralContainer">
				<label>Enter a name for your fantasic pizza</label>
				<input type="text" class="form-control"  id="pizzaName" placeholder="Pizza Name!" autocomplete="off"
				<label>Pick a first topping</label>
				<select id="topping1" class="form-control" name="topping1">
					<?php 
						for($i = 0; $i < sizeOf($allToppings); $i++){
							?>
							<option value="<?php echo $allToppings[$i]['toppingID'];?>"><?php echo $allToppings[$i]['toppingName']; ?> £<?php echo $allToppings[$i]['toppingPrice']; ?></option>
							<?php
						}
					?>
				</select>
				<label>Pick a second topping</label>
				<select id="topping2" class="form-control"  name="topping2">
					<?php 
						for($i = 0; $i < sizeOf($allToppings); $i++){
							?>
							<option value="<?php echo $allToppings[$i]['toppingID'];?>"><?php echo $allToppings[$i]['toppingName']; ?> £<?php echo $allToppings[$i]['toppingPrice']; ?></option>
							<?php
						}
					?>
				</select>
				<label>Pick a third topping</label>
				<select id="topping3" class="form-control"  name="topping3">
					<?php 
						for($i = 0; $i < sizeOf($allToppings); $i++){
							?>
							<option value="<?php echo $allToppings[$i]['toppingID'];?>"><?php echo $allToppings[$i]['toppingName']; ?> £<?php echo $allToppings[$i]['toppingPrice']; ?></option>
							<?php
						}
					?>
				</select>
				<label>Pick a base for the pizza</label>
				<select name="base" class="form-control" id="base">
					<option value="plain">Plain</option>
					<option value="thick">Thick</option>
					<option value="thin">Thin</option>
					<option value="stuffed">Stuffed</option>
				</select>
			</div>
			<button onclick="addPizza();" class="btn btn-primary">Create Pizza</button>
	  </div>
	</div>
</div>
<script>
//Add a pizza by calling its API
function addPizza(){
	var id = "<?php echo $isUserLoggedIn; ?>";
	var name = document.getElementById("pizzaName").value;
	var topping1 = document.getElementById("topping1").value;
	var topping2 = document.getElementById("topping2").value;
	var topping3 = document.getElementById("topping3").value;
	var base = document.getElementById("base").value;
	httpGetAsync("api/CreatePizza.php?id="+id+"&base="+base+"&top1="+topping1+"&top2="+topping2+"&top3="+topping3+"&name="+name, function(response){
		console.log(response);
	});
	
}
</script>