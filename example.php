<?php require_once "securearea.php"; ?>
<div id="container">
	<div class="half left">
	  <div class="center">
		<h2>Example JS page</h2>
		<p><strong>Test Page</strong></p>
	  </div>
	</div>

	<div class="half right">
		<?php require_once 'nav.php'; ?>
		<div class="center">
			
			
			<div id="mainMenuGroup" class="list-group centralContainer">
				<label>Mouse Up and Mouse Down events are attached to this Div</label>
				<button class="btn btn-primary" onclick='loadPage("order.php");'>Order Pizza</button>
				<button class="btn btn-primary" onclick='loadPage("createPizza.php");'>Create Pizza</button>
				<button class="btn btn-primary" onclick='loadPage("account.php");'>Account</button>
				<button class="btn btn-danger" onclick='loadPage("logout.php");'>Logout</button>
			</div>
	  </div>
	</div>
</div>

<script>
document.getElementById("mainMenuGroup").addEventListener("mousedown", function(){
	document.getElementById("mainMenuGroup").style.backgroundColor = "black";
});

document.getElementById("mainMenuGroup").addEventListener("mouseup", function(){
	document.getElementById("mainMenuGroup").style.backgroundColor = "white";
});


</script>