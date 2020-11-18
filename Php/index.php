<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "node";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM temperature";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="refresh" content="5">

<style>
#customers {
    margin-left:25%;
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
</head>
<body>
    
    <h1 style="text-align:center">TEMPERATURE LOGGING</h1>

<table id="customers">
  <tr>
    <th>ID</th>
    <th>TEMPERATURE</th>
    <th>HUMIDITY</th>
    
  </tr>
  <?php 

while($row = $result->fetch_assoc()) 
{
  ?>
									 
  <tr class="row100 body">
  <td class="cell100 column1"><?php echo $row["id"]  ?></td>
  <td class="cell100 column2"><?php echo $row["temperature"]  ?></td>
  <td class="cell100 column3"><?php echo $row["humidity"]  ?></td>									
								</tr>
								<?php } ?>
  
</table>

</body>
</html>
