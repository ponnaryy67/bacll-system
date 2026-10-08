<?php 

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


