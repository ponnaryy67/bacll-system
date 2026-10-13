<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bac_system";

// ប្រើប្រាស់ @ ដើម្បីកុំឱ្យវាចេញ Error ក្រហមផ្អើលពេញ Server ពេលតភ្ជាប់មិនកើត
$conn = @new mysqli($host, $user, $password, $dbname);

// យើងមិនប្រើ die() ទេ ដើម្បីឱ្យវេបសាយនៅតែអាចដំណើរការបន្តបាន
if ($conn->connect_error) {
    $conn = null; 
}
?>



