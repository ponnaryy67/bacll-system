<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "bac_system";

$conn = null;

try {
    // ព្យាយាមតភ្ជាប់ដោយចាប់យក Exception ទុក ប្រសិនបើរក Server មិនឃើញ
    $conn = @new mysqli($host, $user, $password, $dbname);
} catch (\mysqli_sql_exception $e) {
    $conn = null;
}

// ករណីមាន connect_error ផ្សេងទៀត
if ($conn && $conn->connect_error) {
    $conn = null;
}
?>



