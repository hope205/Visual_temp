

<?php
include_once("connect.php");



// Create connection

$conn = conn();

//select Time, Value field(s) respectively from SQL DB
// $sql = sprintf("SELECT DISTINCT  temperature, humidity FROM temperature ORDER BY ID DESC LIMIT 1 ");

// $sql = "SELECT   temperature, humidity FROM temperature ";

$sql = "SELECT  temperature, humidity ,Time FROM temperature ORDER BY ID DESC LIMIT 1 ";


//execute query
$result = $conn->query($sql);//$result=mysqli_query($con,$sql)





// $data = array();

if ($result->num_rows != 0) {
	// output data of each row
	
    while($row = $result->fetch_assoc()) {
        
        echo json_encode($row);


        // $data[] = $row;


        // echo $row["temperature"];
    }
} else {
    echo "0 results";
}


// echo json_encode($data);



//free memory associated with result
// $result->close();
$conn->close();


?> 


 




