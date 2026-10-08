<?php

    $students = [
        "name" => "Koko",
        "age" => 18,
        "gender" => "female",
        "major" => "CS"
    ];

    echo "<table><tr>
        <th>Name</th>
        <th>Age</th>a
        <th>Gender</th>
        <th>Major</th>
        </tr>"."<br>";
    foreach ($students as $stu){
        echo "<tr>
        <td>$stu</td>
    
        </tr>";
           
    }
    
    </table>"

    
?>