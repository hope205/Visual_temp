<?php
function conn(){
    // setup connection to database
    $servername = "localhost";
    $username="root";
    $password="";
    $database = "node";
    $conn = new mysqli($servername,$username,$password,$database);
    if( $conn -> connect_error){
        die("connect failed :". $conn -> connect_error);
    }else{
          
        return $conn;
       
    }
    
}
conn();


?>