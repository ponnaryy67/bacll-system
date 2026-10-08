<?php

    echo "<h1>Calculate Grade Student</h1>";
    function calculateGrade($math, $php, $database){

        $total = $math + $php + $database;
        $average = $total / 3;

        if($average >= 90){
            $grade = "A";
        }
        else if($average >= 80){
            $grade = "B";
        }
        else if($average >= 70){
            $grade = "C";
        }
        else if($average >= 60){
            $grade = "D";
        }
        else if($average >= 50){
            $grade = "E";
        }
        else{
            $grade = "F";
        }

        // pass or fail

        if ($average >= 60){
            $result = "Pass";

        }
        else{
            $result = "Fail";
        }
        
        return [
            "total" => $total,
            "average" => $average,
            "grade" => $grade,
            "result" => $result,
        ];

    }

    $student = calculateGrade(90, 80, 70);
    echo "Total:" .$student['total'] . "<br>";
    echo "Average:" .$student['average'] . "<br>";
    echo "Grade:" .$student['grade'] . "<br>";
    echo "Result:" .$student['result'] . "<br>";

?>

