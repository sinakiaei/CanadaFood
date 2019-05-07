<html>
<head>	

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>
<?php
	$host='localhost';
	$db = 'Food';
	$username = 'postgres'; 
	$password = 'postgres'; 
	 
	$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
	
	$conn = new PDO($dsn);
	
	$ageQueryStatement = 'SELECT DISTINCT(ages) FROM "serving" ORDER BY ages DESC'; 
	$ageQuery = $conn->query($ageQueryStatement);
	$ages = $ageQuery->fetchAll();
	
	$dirQueryStatement = 'SELECT DISTINCT(directional) FROM "directional"'; 
	$dirQuery = $conn->query($dirQueryStatement);
	$dirs = $dirQuery->fetchAll();
?>

<div class="container" style="margin-top:40px">
	<div class="jumbotron"><center>
	  <h1 class="display-4">Food Project</h1>
	  <p class="lead">Sina Kiaei's Food Project for Dr. Liang</p></center>
	  <hr class="my-4">
	  <p>This project has been developed by Sina Kiaei as a fullfilment for coding project. </p>
	</div>
</div>

<div class="container" style="margin-top:20px">
	<div class="row" style="background-color:gainsboro; padding:20px;">
		<div class="col-md-6" >
			<h4> Individual Food Recommendation </h4>
			
			<label for="gender">Gender:</label>
			  <select class="form-control" id="gender">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			  </select>
			  </br>
			
			
			<label for="age">Age:</label>
			  <select class="form-control" id="age">
				<?php
					foreach ($ages as $age)
					{
						echo '<option value="' . $age[0] . '">' . $age[0] . '</option>'; 
					}
				?>
			  </select>
			  </br>
			  
			<label for="dir">Food Option:</label>
			  <select class="form-control" id="dir">
				<?php
					foreach ($dirs as $dir)
					{
						echo '<option value="' . $dir[0] . '">' . $dir[0] . '</option>'; 
					}
				?>
			  </select>
			  
			  </br> </br>
			  
			  <button type="button" class="btn btn-primary" id="submit" onclick="sendUserData()"> Submit User Data </button>
			  
			  <div id="result" style="padding-top:15px">
			  
			  </div>
			
		</div>

		<div class="col-md-6">
			<h4> Family Food Recommendation </h4>
		</div>
	</div>
</div>

<script>

function sendUserData()
{
	var str = "getfooddata.php?"; 
	str += "gender='" + document.getElementById("gender").value + "'"; 
	str += "&age='" + document.getElementById("age").value + "'"; 
	str += "&dir='" + document.getElementById("dir").value + "'"; 
	
	console.log(str); 
	
	var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
				var obj = JSON.parse(this.responseText);
				if(obj.length >0)
				{
					var resultSTR = "";
					var resultSTR = "<span style='color:navy; font-weight:bold;'> Serving Size = ";
					resultSTR += obj[0];
					resultSTR += "</span>";
					resultSTR += "</br></br>Choose recommanded foods:</br>";
					for(i=1; i<obj.length; i=i+2)
					{
						resultSTR += "<span style='color:#2874A6; font-weight:bold;'>" + obj[i] + "</span> of <span style='color:#6C3483; font-weight:bold;'>" + obj[i+1] + "</span></br>";
					}
					
					document.getElementById("result").innerHTML = resultSTR;
				}
				else
					document.getElementById("result").innerHTML = "<span style='color:orange; font-weight:bold;'>Sorry! Our data is not enought to answer your query.</span>";
				
				
				
				console.log(this.responseText); 
            }
        };
        xmlhttp.open("POST", str, true);
        xmlhttp.send(); 
}
	
		
</script>

</body>

</html>
