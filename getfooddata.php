<?php

// Gender, age and directional which submited by user 
$gender = $_REQUEST["gender"];
$age = $_REQUEST["age"];
$dir = $_REQUEST["dir"];

// Database Configuration	
$host='localhost';
$db = 'Food';
$username = 'postgres'; 
$password = 'postgres'; 
 
$dsn = "pgsql:host=$host;port=5432;dbname=$db;user=$username;password=$password";

// Create a PostgreSQL database connection

$conn = new PDO($dsn);

//	Query for extracting desired results based on selected options in distinct form
$queryStatement = 'SELECT DISTINCT(d.fgcat_id, d.fgid, s.servings, REPLACE(f.srvg_sz, \',\', \';\'), REPLACE(f.food, \',\', \';\')) FROM "foodgroups" As fg, "foods" As f, "serving" As s, "directional" As d WHERE d.directional = ' .$dir. ' AND s.ages = ' . $age . ' AND s.gender = ' .$gender . ' AND s.fgid = d.fgid AND f.fgcat_id = d.fgcat_id'; 
$q = $conn->query($queryStatement);
$results = $q->fetchAll();
// Explode results based on "," and rearry them again.
$i=0;
$output = array(); 
foreach ($results as $result)
{
	$resarray = explode(",", $result[0]); 
	if($i==0)
	{	
		$output[$i]= $resarray[2];
		$i++;
		$output[$i]= str_replace('"', "",$resarray[3]);
		$i++;
		$output[$i]= str_replace(')',"",$resarray[4]);
		$i++;			
	}	
	else
	{
		$output[$i]= str_replace('"', "",$resarray[3]);
		$i++;
		$output[$i]= str_replace(')',"",$resarray[4]);
		$i++;
	}
}
// Form results as json
$outputJSON = json_encode($output);

echo $outputJSON;

?>
