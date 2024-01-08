<?php
require_once __DIR__ . '/../../../infra/middlewares/middleware-administrator.php';
require_once __DIR__ . '/../../../infra/repositories/userRepository.php';
require_once __DIR__ . '/../../../infra/repositories/reviewRepository.php';
require_once __DIR__ . '/../../../infra/repositories/contentRepository.php';
require_once __DIR__ . '/../../../infra/repositories/shareRepository.php';
require_once __DIR__ . '/../../../templates/header.php'; 
$title = ' - User';


$adminUsers = countUsers(1);
$nonAdminUsers = countUsers(0);
$userCount = countUsers(); 
$reviewCount = countReviews(); 
$contentCount = countContents();  
$shareCount = countShares(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
            color: white;
        }

        body {
            font-family: Arial, sans-serif;
            background: url('/SIR-TP1/pages/assets/back.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        main {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.12);
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        #logo {
            width: 75px;
            position: absolute;
            top: 10px;
            left: 10px;
            opacity: 1;
            transition: opacity 0.3s ease-in-out;
        }
        section {
            max-width: 600px; 
            margin: auto; 
            padding: 20px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(30px);
            background: transparent;
            text-align: center;
        }

       
        h2 {
            color: white; 
            margin-bottom: 10px; 
        }
    </style>
</head>

<body>
    <main>
    <a href="/SIR-TP1/pages/secure/admin">
        <img id="logo" src="../../../pages/assets/image.png" alt="Logo">
            </a>
        
        
            
            <section class="pb-3">
    <h2>Total of accounts registered: <?= $userCount ?></h2>           
    <h2>Total of users registered: <?= $nonAdminUsers ?></h2>
    <h2>Total of admins registered: <?= $adminUsers ?></h2>
    <h2>Total of contents created: <?= $contentCount ?></h2>
    <h2>Total of reviews created: <?= $reviewCount ?></h2>
    <h2>Total of shares created: <?= $shareCount ?></h2>
</section>
           
        
    </main>
</body>

</html>
<?php
?>