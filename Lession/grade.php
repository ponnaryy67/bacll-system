

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculate Grade Student</title>
</head>
<body>

<h1>Calculate Grade Student</h1>

<form method="POST">
    <input type="text" name="name" placeholder="Student Name" required><br><br>
    <input type="number"  name="khmer" placeholder="Khmer subject" required><br><br>
    <input type="number"  name="math" placeholder="Math subject" required><br><br>
    <input type="number"  name="english" placeholder="English subject" required><br><br>
    <input type="number"  name="history" placeholder="History subject" required><br><br>
    <input type="number"  name="physics" placeholder="Physics subject" required><br><br>
    <input type="number"  name="chemistry" placeholder="Chemistry subject" required><br><br>
    <input type="number"  name="biology" placeholder="Biology subject" required><br><br>
    <button type="submit" name="Add">Add Student</button> 
</form>

<hr>

<h2>Search Student</h2>

<form method="POST"></form>

<form method="POST">
    <input type="text" name="search_name" placeholder="Enter student name" required>
    <button type="submit" name="search">Search</button>
</form>

<?php

    session_start();


if (!isset($_SESSION['students'])){
    $_SESSION['students'] = [];
}

// ADD STUDENT 

 if (isset($_POST['Add'])) { 
    $StudentName = $_POST['name']; 


    $scores = [ 
    "Khmer" => (float)$_POST['khmer'], 
    "Math" => (float)$_POST['math'], 
    "English" => (float)$_POST['english'], 
    "History" => (float)$_POST['history'], 
    "Physics" => (float)$_POST['physics'], 
    "Chemistry" => (float)$_POST['chemistry'], "
    Biology" => (float)$_POST['biology'] ]; 
    
    // Calculate Total 
    
    $Total = 0; 
    
    foreach ($scores as $subject => $score) { 
    $Total = $Total + $score;

     } 

     $Average = $Total / count($scores); 
     
      if ($Average >= 90) { 
        $Grade = "A"; 
    } elseif ($Average >= 80) { 
        $Grade = "B"; 
    } elseif ($Average >= 70) { 
        $Grade = "C"; 
    } elseif ($Average >= 60) { 
        $Grade = "D"; 
    } elseif ($Average >= 50) {
         $Grade = "E"; 
    } else { $Grade = "F"; } 
    
    // Add Student to Array 
    
    $_SESSION['students'][] = [ 

        "name" => $StudentName, 
        "scores" => $scores, 
        "total" => $Total, 
        "average" => $Average, 
        "grade" => $Grade ]; 
        
        echo "<h3>Student Added Successfully!</h3>"; 
        
        }


        // Search Student

    $searchResult = null;
    if (isset($_POST['search'])){
        foreach ($_SESSION['student'] as $student){
            if (strtolower($student['name']) == strtolower(trim($_POST['search_name']))){
                $searchResult = $student;
                
            }
        }
    }



?>

</body>
</html>



