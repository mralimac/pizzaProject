<?php include 'header.php'; ?>

<div id="mainView">
</div>
<script>
document.addEventListener("load", viewportLoader());
function viewportLoader(){
	var array = document.cookie.split("=");
	var cookieValue = array[1];
	httpGetAsync("api/GetLastPage.php?id="+cookieValue, function(response){
		if(response["result"] != false){
			loadPage(response["lastpage"]);
		}else{
			loadPage("login.php");
		}
	});
}
</script>

<?php include 'footer.php'; ?>