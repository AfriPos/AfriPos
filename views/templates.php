<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Welcome to AfriPOS, a leading software development company specializing in creating innovative solutions for businesses. Explore our services, expertise, and industry-leading software products to transform your digital presence. Contact us today for custom software solutions." />

    <title>AfriPOS</title>
    <link rel="shortcut icon" href="views\img\afripos-logo.jpg" type="image/x-icon">
    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500&family=Jost:wght@500;600;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="views/lib/animate/animate.min.css" rel="stylesheet">
    <link href="views/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="views/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="views/css/style.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Include jQuery via CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="hold-transition sidebar-mini">
<?php
    if (isset($_GET['route'])) {
        // Check if the requested route is valid for the Administrator role
        if ($_GET['route'] == "home" ||
            $_GET['route'] == "explore" ||
            $_GET['route'] == "checkout" ||
            $_GET['route'] == "privacy-policies") {
            include "modules/header.php"; // Include header here
            
            include "modules/" . $_GET['route'] . ".php";
            
            include 'modules/footer.php';
        } else {
            include "modules/404.php";
        }
    } else {
        include "modules/header.php"; // Include header here
        
        include "modules/home.php"; 
        
        include 'modules/footer.php';
    }
?>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="views/lib/wow/wow.min.js"></script>
<script src="views/lib/easing/easing.min.js"></script>
<script src="views/lib/waypoints/waypoints.min.js"></script>
<script src="views/lib/counterup/counterup.min.js"></script>
<script src="views/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="views/js/main.js"></script>
<script src="views/js/mail.js"></script>
<script src="views/js/checkout.js"></script>
</body>
</html>
