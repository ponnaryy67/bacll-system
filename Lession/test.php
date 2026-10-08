<?php

$dayNumber = 3; 

switch ($dayNumber) {
    case 1:
    case 2:
    case 3:
    case 4:
    case 5:
        echo 'Weekday';
        break;
    case 6:
    case 7:
        echo 'Weekend';
        break;
    default:
        echo 'Invalid day number';
        break;
}





function calculateDiscount($price, $discountRate = 0.10) {[cite: 1]
    global $currencySymbol; 
    
    $finalPrice = $price * (1 - $discountRate);
    
    return $currencySymbol . number_format($finalPrice, 2);[cite: 1]
}

echo calculateDiscount(100)




$inventory = [
    'Laptop' => 850,
    'Mouse' => 25,
    'Keyboard' => 45,
    'Monitor' => 200
];[cite: 1]

$totalValue = array_sum($inventory);[cite: 1]
echo "Total Inventory Value: $" . $totalValue . "\n";

$maxPrice = max($inventory);[cite: 1]
echo "Most Expensive Price: $" . $maxPrice . "\n";

arsort($inventory);[cite: 1]
print_r($inventory);



function formatUserInput($inputString) {[cite: 2]

    $trimmed = trim($inputString);[cite: 2]
    $formatted = ucwords(strtolower($trimmed));[cite: 2]
    return strcasecmp($formatted, 'Admin') === 0;[cite: 2]
}

var_dump(formatUserInput('  admin  ')); 



function calculateShipping($zone, $weight = 1.0) {
    // Calculate extra weight beyond the base 1kg (minimum 0)
    $extraWeight = max(0, $weight - 1.0);

    switch ($zone) {
        case 'Zone1':
            return 5.00 + ($extraWeight * 1.50);

        case 'Zone2':
            return 10.00 + ($extraWeight * 2.50);

        case 'Zone3':
            return 20.00;

        default:
            return -1;
    }
}

echo calculateShipping('Zone1', 3.0);
echo "\n";
echo calculateShipping('Zone2', 2.5); 
echo "\n";
echo calculateShipping('Zone3', 5.0); 
echo "\n";
echo calculateShipping('Zone4', 1.0); 





?>

