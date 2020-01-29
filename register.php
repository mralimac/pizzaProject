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
				<input type="text" class="form-control"  placeholder="example@example.com" name="email" id="email" onkeyup="formCheck();" required>
				<small class="invalid-feedback" style="display:none" id="emailErrorMsg"></small>
				<br><label for="password">Password</label>
				<input type="password" class="form-control" placeholder="Password" name="password" id="password" onkeyup="formCheck()" required>
				<br><label for="password">Confim Password</label>
				<input type="password" class="form-control" placeholder="Confirm Password" name="password2" id="password2" onkeyup="formCheck()" required>
				<small class="invalid-feedback" style="display:none" id="passwordErrorMsg"></small>
				<br><label for="username">House Name</label>
				<input type="text" class="form-control"  placeholder="House Name/Number" name="address1" id="address1" onkeyup="formCheck()" required>
				<small class="invalid-feedback" style="display:none" id="add1ErrorMsg"></small>
				<br><label for="username">Street Name</label>
				<input type="text" class="form-control"  placeholder="Street Name" name="address2" id="address2" onkeyup="formCheck()" required>
				<small class="invalid-feedback" style="display:none" id="add2ErrorMsg"></small>
				<br><label for="username">City</label>
				<input type="text" class="form-control"  placeholder="City" name="address3" id="address3" onkeyup="formCheck()" required>
				<small class="invalid-feedback" style="display:none" id="add3ErrorMsg">City is invalid</small>
				<br><label for="username">Telephone</label>
				<input type="text" class="form-control"  placeholder="Telephone" name="telephone" id="telephone" onkeyup="formCheck()">
				<small class="invalid-feedback" style="display:none" id="telErrorMsg"></small>
				<br>
				<div style="text-align:center">
					<button onclick="addUser();" id="submitButton" class="btn btn-primary">Create Account</button>
					<button class="btn btn-info" onclick='loadPage("login.php");'>Login</button>
				</div>
			</div>

	  </div>
	  <label id="loginStatus"></label>
	</div>
</div>
<script>
function addUser(){
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var password2 = document.getElementById("password2").value;
	var address1 = document.getElementById("address1").value;
	var address2 = document.getElementById("address2").value;
	var address3 = document.getElementById("address3").value;
	var telephone = document.getElementById("telephone").value;
	if(password == password2){
		console.log("api/Register.php?id="+email+"&pass="+password+"&ad1="+address1+"&ad2="+address2+"&ad3="+address3+"&tel="+telephone);
		httpGetAsync("api/Register.php?id="+email+"&pass="+password+"&ad1="+address1+"&ad2="+address2+"&ad3="+address3+"&tel="+telephone, function(response){
			console.log(response["code"]);
			switch(response["code"]) {
				case 100:
				document.getElementById("password2").classList.add("is-invalid");
				document.getElementById("password2").classList.remove("is-valid");
				document.getElementById("passwordErrorMsg").innerText = response["message"];
				document.getElementById("passwordErrorMsg").style.display = "inline";
				break;
				case 101:
				document.getElementById("email").classList.add("is-invalid");
				document.getElementById("email").classList.remove("is-valid");
				document.getElementById("emailErrorMsg").innerText = response["message"];
				document.getElementById("emailErrorMsg").style.display = "inline";
				break;
				case 102:
				document.getElementById("address1").classList.remove("is-valid");
				document.getElementById("address1").classList.add("is-invalid");
				document.getElementById("add1ErrorMsg").innerText = response["message"];
				document.getElementById("add1ErrorMsg").style.display = "inline";
				break;
				case 103:
				document.getElementById("address2").classList.remove("is-valid");
				document.getElementById("address2").classList.add("is-invalid");
				document.getElementById("add2ErrorMsg").innerText = response["message"];
				document.getElementById("add2ErrorMsg").style.display = "inline";
				break;
				case 104:
				document.getElementById("address3").classList.add("is-valid");
				document.getElementById("address3").classList.remove("is-invalid");
				document.getElementById("add3ErrorMsg").innerText = response["message"];
				document.getElementById("add3ErrorMsg").style.display = "inline";
				break;
				case 105:
				document.getElementById("loginStatus").innerText = response["message"];
				document.getElementById("loginStatus").style.display = "inline";
				break;
				case 201:
				document.getElementById("emailErrorMsg").innerText = response["message"];
				document.getElementById("emailErrorMsg").style.display = "inline";
				document.getElementById("email").classList.add("is-invalid");
				document.getElementById("email").classList.remove("is-valid");
				break;
				case 202:
				document.getElementById("telErrorMsg").innerText = response["message"];
				document.getElementById("telErrorMsg").style.display = "inline";
				document.getElementById("telephone").classList.add("is-invalid");
				document.getElementById("telephone").classList.remove("is-valid");
				break;
				case 200:
				document.getElementById("loginStatus").innerText = response["message"];
				document.getElementById("loginStatus").style.display = "inline";
				loadPage("login.php");
				break;
			}
		});
	}
}

function emailCheck(){
	var email = document.getElementById("email").value;
	if(email.includes("@") && email.includes(".")){
		document.getElementById("email").classList.remove("is-invalid");
		document.getElementById("email").classList.add("is-valid");
		document.getElementById("emailErrorMsg").style.display = "none";
		return true;
	}else{
		document.getElementById("passwordErrorMsg").innerText = "Email is invalid";
		document.getElementById("email").classList.add("is-invalid");
		document.getElementById("email").classList.remove("is-valid");
		document.getElementById("emailErrorMsg").style.display = "inline";
		return false;
	}
}

function passwordCheck(){
	var pass1 = document.getElementById("password").value;
	var pass2 = document.getElementById("password2").value;
	if(pass1 == pass2 && pass2.length > 1){
		document.getElementById("password2").classList.remove("is-invalid");
		document.getElementById("password2").classList.add("is-valid");
		document.getElementById("passwordErrorMsg").style.display = "none";
		return true;
	}else{
		document.getElementById("passwordErrorMsg").innerText = "Passwords do not match";
		document.getElementById("password2").classList.add("is-invalid");
		document.getElementById("password2").classList.remove("is-valid");
		document.getElementById("passwordErrorMsg").style.display = "inline";
		return false;
	}
}

function telCheck(){
	var tel = document.getElementById("telephone").value;
	if(/^(?:\W*\d){11}\W*$/.test(tel)){
		document.getElementById("telephone").classList.remove("is-invalid");
		document.getElementById("telephone").classList.add("is-valid");
		document.getElementById("telErrorMsg").style.display = "none";
		return true;
	}else{
		document.getElementById("telErrorMsg").innerText = "Telephone number is invalid";
		document.getElementById("telephone").classList.remove("is-valid");
		document.getElementById("telephone").classList.add("is-invalid");
		document.getElementById("telErrorMsg").style.display = "inline";
		return false;
	}
}

function addressCheck(){
	var addressValue1 = false;
	var addressValue2 = false;
	var addressValue3 = false;
	
	var address1 = document.getElementById("address1").value;
	
	if(address1.length > 0){
		document.getElementById("address1").classList.add("is-valid");
		document.getElementById("address1").classList.remove("is-invalid");
		document.getElementById("add1ErrorMsg").style.display = "none";
		addressValue1 = true;
	}else{
		document.getElementById("add1ErrorMsg").innerText = "House is empty";
		document.getElementById("address1").classList.remove("is-valid");
		document.getElementById("address1").classList.add("is-invalid");
		document.getElementById("add1ErrorMsg").style.display = "inline";
		addressValue1 = false;
		
	}
	var address2 = document.getElementById("address2").value;
	if(address2.length > 0){
		document.getElementById("add2ErrorMsg").innerText = "Street is empty";
		document.getElementById("address2").classList.add("is-valid");
		document.getElementById("address2").classList.remove("is-invalid");
		document.getElementById("add2ErrorMsg").style.display = "none";
		addressValue2 = true;
	}else{
		document.getElementById("address2").classList.remove("is-valid");
		document.getElementById("address2").classList.add("is-invalid");
		document.getElementById("add2ErrorMsg").style.display = "inline";
		addressValue2 = false;
	}
	var address3 = document.getElementById("address3").value;
	if(address3.length > 0){
		document.getElementById("add3ErrorMsg").innerText = "City is empty";
		document.getElementById("address3").classList.add("is-valid");
		document.getElementById("address3").classList.remove("is-invalid");
		document.getElementById("add3ErrorMsg").style.display = "none";
		addressValue3 = true;
	}else{
		document.getElementById("address3").classList.add("is-valid");
		document.getElementById("address3").classList.remove("is-invalid");
		document.getElementById("add3ErrorMsg").style.display = "inline";
		addressValue3 = false;
	}
	
	if(addressValue1 && addressValue2 && addressValue3){
		return true;
	}else{
		return false;
	}
}

function formCheck(){
	var usernameResult = emailCheck();
	var addressResult = addressCheck();
	var passwordResult = passwordCheck();
	var telResult = telCheck();	
	if(usernameResult && addressResult && passwordResult && telResult){
		document.getElementById("submitButton").disabled = false;
	}else{
		document.getElementById("submitButton").disabled = true;
	}
	
}



</script>