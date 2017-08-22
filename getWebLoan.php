<?php 
	if (isset($_POST["GetValue"])) {
		if (isset($_POST["getText"])) {
			$value = trim($_POST["getText"]);
			
		}

	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="" method="post">
		<div id="contentType"></div>
		<input type="text" name="getText" id="getText"></input>
		<input type="submit" name="GetValue" value="Get"></input>
	</form>
	<script type="text/javascript" src="jquery-1.12.3.min.js"></script>	
	<script type="text/javascript">

$(document).ready(function() {

		$.ajax({
		  dataType: "json",
		  url: "http://192.168.1.22:90/ntier3/PresentationLayer/webloan.php",
		  data: 'name',
		  success:function(data){
		  	var jsonobj=JSON.stringify(data);

			var obj = $.parseJSON(jsonobj);

			console.log(obj);
			$('#getText').val(obj);
		  }
		});
		return false;
});
</script>
</body>
</html>