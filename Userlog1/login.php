<?php

// How to connect PHP to db

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smc_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully!<br>";
echo "New record created successfully!<br>";

// Create Table (កែប្រែ auto_incremental -> auto_increment)
$sql = "CREATE TABLE IF NOT EXISTS tbcourse(
    id INT AUTO_INCREMENT PRIMARY KEY,
    coursename VARCHAR(30),
    department VARCHAR(30)
)";

if ($conn->query($sql) === TRUE){
    echo "Table created successfully!<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Insert data into table (កែប្រែ $sql -> $sqli)
$sqli = "INSERT INTO tbcourse(coursename, department) VALUES('Python', 'CS')";

if ($conn->query($sqli) === TRUE){
    echo "One record added successfully!";
} else {
    echo "Error inserting record: " . $conn->error;
}


$sql2="select * from tbcourse";
$result=$conn->query($sql2);
if($result -> num_rows >0 ){
    while($row=$result->fetch_assoc()){
        echo"<tr>
                <td>{$row['id']}</td>
                <td>{$row['coursename']}</td>
                <td>{$row['department']}</td>
        </tr><br>";
    }
}

// update data in table
$sql3="UPDATE `tbcourse` SET `coursename` = 'Web API' WHERE 1";

if($conn->query($sql3)===True){
    echo"One record update!";
};

// delete Record!
$sql4="DELETE FROM `tbcourse` WHERE id=1";
if($conn->query($sql4)===True){
    echo"One Record Deleted!";
}
else{
    echo"ID is not found!";
}



// $conn->query($sql3);



// Close connection
$conn->close();

?>



