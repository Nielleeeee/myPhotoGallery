<?php
session_start();
include_once 'dbh.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css"> 
    <title>Illustra - Landing Page</title>
</head>
<header>
    <div class="navbar">
            <div class="logo">
                <a href="LandingPage.php"><img src="resource/images/Illustra Logo.PNG" alt="Illustra Logo" width="300px"></a>
            </div>
            <nav>
                <ul id="menuItems">
                    <li><a href="landingpage.php">Home</a></li>
                    <li><a href="photogallery.php">Photo Gallery</a></li>
                    <li><a href="aboutus.php">About</a></li>
                    <?php
                    if (isset($_SESSION["email"])){
                        $email = $_SESSION["email"];
                        $query = "SELECT firstname FROM users WHERE email  = '$email'";
                        $result = mysqli_query($conn, $query);

                        if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $name = $row['firstname'];
                        
                        }
                        echo "<li>Hello, $name</li>";
                        echo "<li><a href='logout.inc.php'>Log Out</a></li>";
                    }else{
                        echo "<li><a href='Signup.php'>Signup</a></li>";
                        echo "<li><a href='Login.php'>Login</a></li>";  
                    }
                    ?>
                </ul>
            </nav>
        </div>
</header>

<body>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <h1>Illustra is your all-in-one platform for sharing, discovering, and celebrating life's moments through photography</h1>
            </div>

            <div class="col-2">
                <img src="resource/images/beautiful-skyscape-during-daytime.jpg" alt="Sunset" width="100%">
            </div>
        </div>
    </div>

    <div class="about-us">
        <div class="row">
            <div class="col-2">
                <h2>What we do</h2>
                <p>Illustra is a photo sharing and contest platform that celebrates the beauty and diversity of life through photography. Our mission 
                    is to provide a creative outlet for photographers of all levels to showcase their talents, share their memories, and connect with a community of like-minded individuals. 
                    From landscapes to portraits, from nature to cityscapes, Illustra celebrates all forms of photography. With a user-friendly interface, exciting photo contests, 
                    and a vibrant community, Illustra is the perfect place to preserve and share your memories, discover new perspectives, and unleash your inner photographer</p>
            </div>
            <div class="col-2">
                <img src="resource/Images/beautiful-old-city-view.jpg" alt="beautiful-old-city-view">
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <img src="resource/images/marian-lake-darran-mountain-range-new-zealand.jpg" alt="marian-lake-darran-mountain-range-new-zealand">
            </div>
            <div class="col-2">
                <h2>How we do it</h2>
                <p>We listen carefully to the needs of our clients and work closely with them to create custom solutions that meet their unique requirements.
                    We use the latest technologies and best practices to develop high-quality products that are reliable, efficient, and easy to use.
                    We test our products thoroughly before launching them to ensure that they meet the highest standards of quality and performance.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <h2>Why we do it</h2>
                <p>We believe that our clients deserve the best products and services available, and we are committed to delivering just that.
                    We are passionate about the work we do, and we take pride in creating solutions that make a real difference in the lives of our clients.
                    We strive to create a positive impact in the communities we serve, and we believe that by delivering top-notch products and services, we can help to create a better world for everyone."</p>
            </div>
            <div class="col-2">
                <img src="resource/images/road-through-spooky-mysterious-forest.jpg" alt="road-through-spooky-mysterious-forest">
            </div>
        </div>
    </div>
</body>

<footer>
    <div class="container">
        <div class="row">
            <div class="footer-col-1">
                <img src="resource/images/illustra logo black.PNG" alt="Illustra Logo" width="300px">
                <p>Illustra is your all-in-one platform for sharing, discovering, and celebrating life's moments through photography</p>
            </div>
            <div class="footer-col-2">
                <h3>Useful Links</h3>
                <ul>
                    <li><a href="" target="_blank">Coupons</a></li>
                    <li><a href="" target="_blank">Blog Post</a></li>
                    <li><a href="" target="_blank">Join Affiliate</a></li>
                </ul>
            </div>
            <div class="footer-col-3">
                <h3>Follow Us</h3>
                <ul>
                    <li><a href="#" class="fa fa-facebook"></a></li>
                    <li><a href="#" class="fa fa-twitter"></a></li>
                    <li><a href="#" class="fa fa-instagram"></a></li>
                </ul>
            </div>

        </div>
    </div>
</footer>
</html>

