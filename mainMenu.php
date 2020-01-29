<?php require_once "securearea.php"; ?>
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
			<div class="list-group centralContainer">
				<button class="btn btn-primary" id="mainMenuOrderBtn" onclick='loadPage("example.php");'>Example JS</button>
				<button class="btn btn-primary" id="mainMenuOrderBtn" onclick='loadPage("order.php");'>Order Pizza</button>
				<button class="btn btn-primary" id="mainMenuCreateBtn" onclick='loadPage("createPizza.php");'>Create Pizza</button>
				<button class="btn btn-primary" id="mainMenuAccountBtn" onclick='loadPage("account.php");'>Account</button>
				<button class="btn btn-danger" id="mainMenuLogoutBtn" onclick='loadPage("logout.php");'>Logout</button>
			</div>
	  </div>
	</div>
</div>
