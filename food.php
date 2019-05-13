<!-- This php file needs to run first -->

<html>
<head>	

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

<?php
	// Database Configuration
	
	$host='localhost';
	$db = 'Food';
	$username = 'postgres'; 
	$password = 'postgres'; 
	
	$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";
	
	// Create a PostgreSQL database connection
	
	$conn = new PDO($dsn);
	
	//	Query form serving table to know about distinct age groups
	
	$ageQueryStatement = 'SELECT DISTINCT(ages) FROM "serving"'; 
	$ageQuery = $conn->query($ageQueryStatement);
	$ages = $ageQuery->fetchAll();
	
	//	Query form directional table to know about distinct directionals
	
	$dirQueryStatement = 'SELECT DISTINCT(directional) FROM "directional"'; 
	$dirQuery = $conn->query($dirQueryStatement);
	$dirs = $dirQuery->fetchAll();
?>

<!-- First box: Header infortmation   -->
<div class="container" style="margin-top:40px">

	<div class="jumbotron" align="center">
	
	  <h1 class="display-4"><strong>Food Project</strong></h1>	  
	  <p class="lead">Sina Kiaei's Food Project for Dr. Liang</p>	  
	  <hr class="my-4">	  
	  <p>This project has been developed by Sina Kiaei as a fullfilment for coding project.</p>
	  
	</div>
	
</div>

<!-- Second box(Includes two colums): Frist column are inputs AND second column is result  -->
<div class="container" style="margin-top:40px">	
	<div class="row" style="background-color:gainsboro; padding:20px;">
		<!-- first column-->	
		<div class="col-md-6" >
			<h4> Individual Food Recommendation </h4>
			<hr class="my-4">
			
			<!-- first drop down-->			
			<label for="gender">Gender:</label>
			  <select class="form-control" id="gender">
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			  </select>			 			
			</br> 
			
			<!--second drop down-->				
			<label for="age">Age:</label>
			  <select class="form-control" id="age">
				<?php
					// Echo age groups from serving table
					foreach ($ages as $age)
					{
						echo '<option value="' . $age[0] . '">' . $age[0] . '</option>'; 
					}
				?>
			  </select>						
			</br> 
			
			<!--third drop down-->			
			<label for="dir">Food Options:</label>
			  <select class="form-control" id="dir">
				<?php
					//Echo directional options from directional table
					foreach ($dirs as $dir)
					{
						echo '<option value="' . $dir[0] . '">' . $dir[0] . '</option>'; 
					}
				?>
			  </select>			
			</br> 
			<!--Submit button-->
			<button type="button" class="btn btn-primary" id="submit" onclick="sendUserData()">Submit</button>
		</div>
		<!-- second column-->
		<div class="col-md-6" id="result" >
		</div>
	</div>
</div>

<script>

// function that parse JSON file which prepared by "getfooddata.php" and print the result)

function sendUserData(){
	// Send selected items to "getfooddata.php" function
	var str = "getfooddata.php?"; 
	str += "gender='" + document.getElementById("gender").value + "'"; 
	str += "&age='" + document.getElementById("age").value + "'"; 
	str += "&dir='" + document.getElementById("dir").value + "'"; 
	
	console.log(str); 
	
	var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				// Parse the response
				var obj = JSON.parse(this.responseText);
				// In case there is no result for some categories
				if(obj.length >0)
				{
					var resultSTR = "</br><span style='color:darksalmon; font-weight:bold;'></br>Based on your gender, age and  your food preferances, your serving size is: ";
					resultSTR += obj[0];
					//resultSTR += "";
					resultSTR += ". The following foods are also suggested for your health in this category:</span></br></br>";
					for(i=1; i<obj.length; i=i+2)
					{
						resultSTR += "<span style='color:#2874A6; font-weight:bold;'>" + obj[i] + "</span> of <span style='color:#6C3483; font-weight:bold;'>" + obj[i+1] + "</span></br>";
					}
					
					document.getElementById("result").innerHTML = resultSTR;
				}
				else
					document.getElementById("result").innerHTML = "<span style='color:red; font-weight:bold;'>Sorry! Our data is not enought to answer your query.</span>";

				console.log(this.responseText); 
			}
		};
		xmlhttp.open("POST", str, true);
		xmlhttp.send(); 
}
			
</script>

</body>

</html>
