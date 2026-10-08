<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f4f6f9; }
        .header { background: #2563eb; color: white; text-align: center; padding: 40px 20px; }
        .header h1 { margin: 0; font-size: 26px; }
        .header p { margin: 8px 0; font-size: 13px; opacity: 0.9; }
        .badge { background: #1e40af; display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 11px; margin-bottom: 15px; }
        .btn-logout { background: white; color: black; border: none; padding: 6px 14px; border-radius: 4px; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; }
        .btn-view { background: #10b981; color: white; border: none; padding: 6px 14px; border-radius: 4px; font-weight: bold; cursor: pointer; text-decoration: none; margin-left: 6px; display: inline-block; }
        
        .container { display: flex; justify-content: center; gap: 20px; margin-top: 30px; }
        
   
        .card-link { text-decoration: none; transition: transform 0.2s ease; }
        .card-link:hover { transform: translateY(-5px); }

        .card-blue { background: #2563eb; color: white; width: 260px; padding: 25px; border-radius: 8px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-orange { background: #d97706; color: white; width: 260px; padding: 25px; border-radius: 8px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .card-title { font-weight: bold; font-size: 16px; margin-bottom: 6px; }
        .card-sub { font-size: 12px; opacity: 0.85; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Student Dashboard</h1>
        <p>Choose a class track to calculate grades.</p>
        <div class="badge">
            Joined by <b><?= htmlspecialchars($_SESSION['username'] ?? 'User'); ?></b> on <?= $_SESSION['joined_at'] ?? ''; ?>
        </div>
        <div>
        
            <a href="#" class="btn-logout" id="logoutBtn">Logout</a>
            <a href="student_list.php" class="btn-view">View User Data</a>
        </div>
    </div>

    <div class="container">
      
        <a href="science_form.php" class="card-link">
            <div class="card-blue">
                <div class="card-title">Science Class Track</div>
                <div class="card-sub">Math, Biology, Chemistry, Physics, Khmer, History, English </div>
            </div>
        </a>

     
        <a href="social_form.php" class="card-link">
            <div class="card-orange">
                <div class="card-title">Social Class Track</div>
                <div class="card-sub">Khmer, History, Geography, Civics, Earth, Ethics, English</div>
            </div>
        </a>
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
      
        document.getElementById('logoutBtn').addEventListener('click', function(e) {
            e.preventDefault(); 
            
            Swal.fire({
                title: 'ចាកចេញពីប្រព័ន្ធ?',
                text: "តើអ្នកពិតជាចង់ Logout មែនទេ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'បាទ/ចាស ចាកចេញ',
                cancelButtonText: 'បោះបង់'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php'; 
                }
            });
        });
    </script>

</body>
</html>




