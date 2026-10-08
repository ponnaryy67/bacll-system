<?php
// ១. Header និង Banner បង្ហាញជានិច្ច
include 'Layout/header.php';
include 'components/banner.php';

// ២. ចាប់យកតម្លៃ ?page= ពី URL (បើគ្មាន ឱ្យ Default ជា 'home')
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!-- ផ្នែក Dynamic Main Content -->
<main style="padding: 10px 40px 40px 40px; min-height: 80vh;">
    <?php
    switch ($page) {
        case 'home':
            // បង្ហាញ Product ដើមរបស់អ្នកនៅពេលចុច Home
            include 'components/product.php';
            break;
            
        case 'women':
            include 'components/women.php';
            break;
            
        case 'men':
            include 'components/men.php';
            break;
            
        case 'bags':
            include 'components/bags.php';
            break;
            
        case 'shoes':
            include 'components/shoes.php';
            break;
            
        case 'caps':
            include 'components/caps.php';
            break;
            
        default:
            // បើគេវាយ page ខុស ឱ្យលោតមកបង្ហាញ Product ដើមដដែល
            include 'components/product.php';
            break;
    }
    ?>
</main>

<?php
// ៣. Footer បង្ហាញជានិច្ច
include 'Layout/footer.php';
?>



