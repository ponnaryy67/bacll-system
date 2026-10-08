<?php

$product = "Smartphone";
$category = "Electronics";
$brand = "Samsung";
$price = 450;
$quantity = 3;
$discount = 10;
$StockStatus = "Available";


$Subtotal = $price * $quantity;
$DiscountAmount = $Subtotal * ($discount / 100); 
$FinalTotal = $Subtotal - $DiscountAmount;      


echo "MINI SHOP <br>";
echo "---------------------------------<br>";
echo "Product: ".$product."<br>";
echo "Category: ".$category."<br>";
echo "Brand: ".$brand."<br>";
echo "Price: $".$price."<br>";
echo "Quantity: ".$quantity."<br>";
echo "Subtotal: $".$Subtotal."<br>";
echo "Discount: ".$discount."%<br>";
echo "Discount Amount: $".$DiscountAmount."<br>";
echo "Final Total: $".$FinalTotal."<br>";
echo "Stock: ".$StockStatus."<br>";
echo "---------------------------------<br>";

?>



