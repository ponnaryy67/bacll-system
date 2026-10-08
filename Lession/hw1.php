<?php

echo "<h1>My Personal Profile</h1>";
echo ".............................. <br>";

$fullName = "Dara";
$age = 20;
$gender = 'Male';
$email = "dara@gmail.com";
$phone = "01234567";
$university = "WU";
$score = 90;

if ($score >= 90){
    $grade = "A";
}else if ($score>= 80){
    $grade = "B";
}else if ($score>= 70){
    $grade = "C";
}else if ($score>= 60){
    $grade = "D";
}else if ($score>= 50){
    $grade = "E";
}else {
    $grade = "F";
}


$StudentStatus = true;


echo "Name: ".$fullName. " <br>";
echo "Age: ".$age." <br> ";
echo "Gender: ".$gender." <br>";
echo "Email: ".$email." <br> ";
echo "Phone: ".$phone." <br> ";
echo "University: ".$university." <br> ";
echo "Score: ".$score." <br> ";
echo "Grade: ".$grade." <br> ";

echo "StudentStatus: " . ($StudentStatus ? "Yes" : "No") . "<br>";

?>


