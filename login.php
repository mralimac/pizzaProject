<div id="container">
	<div class="half left">
	  <div class="center">
		<h2>FATHER JONATHON'S</h2>
		<p><strong>Best UHI Pizza</strong></p>
	  </div>
	</div>

	<div class="half right">
	  <div class="center">
			<div class="form-group centralContainer">
				<label for="username">Email</label>
				<input type="text" class="form-control loginInput"  placeholder="example@example.com" name="username" id="email">
				<label for="password">Password</label>
				<input type="password" class="form-control loginInput" placeholder="Password" name="password" id="password">
				<br>
				<button id="loginSubmitBtn" onclick="checkUser();" class="btn btn-primary">Login</button>
				<button class="btn btn-info" onclick='loadPage("register.php");'>Register?</button>
				<label id="loginStatus"></label>
			</div>
	  </div>
	</div>
</div>
<script>
document.getElementById("password").addEventListener("keyup", function(event){
	if(event.keycode === 13){
		document.getElementById("loginSubmitBtn").click();
	}
});

function checkUser(){
	var id = document.getElementById("email").value;
	var pass = document.getElementById("password").value;
	var loginMsg = document.getElementById("loginStatus");
	
	loginMsg.innerText = "Checking...";
	loginMsg.style.color = "blue";
	
	httpGetAsync("api/Login.php?id="+id+"&pass="+pass, function(response){
		console.log(response);
		if(response == 1 || response == 2){
			loginMsg.innerText = "Login Successful";
			loginMsg.style.color = "green";
			loadPage("mainMenu.php");
		}else{
			loginMsg.innerText = "Login Failed - Please Try Again";
			loginMsg.style.color = "red";
		}
	});
}
</script>