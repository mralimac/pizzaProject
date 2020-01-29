<?php require_once "securearea.php"; ?>
<?php require_once 'nav.php'; ?>
<div class="container">
	<div class="half left">
	  <div class="center">
		<h2>FATHER JONATHON'S</h2>
		<p><strong>Best UHI Pizza</strong></p>
	  </div>
	</div>
	<div class="half right">
		<?php require_once 'nav.php'; ?>
		<div class="center">
			<button id="btnAllSession" class="btn btn-danger" onclick="logout(this.id);">Logout All Sessions</button>
			<button id="btnSingleSession" class="btn btn-warning" onclick="logout(this.id);">Logout This Session</button>
		</div>
	</div>
</div>
<script>
function logout(elementID){
	var userID = "<?php echo $currentUser["userID"]; ?>";
	httpGetAsync("api/Logout.php?id="+userID+"&type="+elementID, function(){
		loadPage("login.php");
	});
}
</script>