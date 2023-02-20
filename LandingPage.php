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
                <button class="learn-more">
                    <span class="circle" aria-hidden="true">
                    <span class="icon arrow"></span>
                    </span>
                    <a href="aboutus.php"><span class="button-text">Learn More</span></a>
                </button>
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
            </div>
            <div class="col-2">
                <p>Illustra is a photo sharing and contest platform that celebrates the beauty and diversity of life through photography. Our mission 
                    is to provide a creative outlet for photographers of all levels to showcase their talents, share their memories, and connect with a community of like-minded individuals. 
                    From landscapes to portraits, from nature to cityscapes, Illustra celebrates all forms of photography. With a user-friendly interface, exciting photo contests, 
                    and a vibrant community, Illustra is the perfect place to preserve and share your memories, discover new perspectives, and unleash your inner photographer</p>
            </div>
        </div>
    </div>

    <div class="small-container leaderboards">
        <h2>Top Picture of The Month</h2>
        <hr>
        <div class="row">
            <?php
            $sql = "SELECT * FROM `gallery` ORDER BY `gallery`.`likesGallery` DESC LIMIT 8;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "<script>alert 'SQL Statement failed!'</script>";
            } else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)){
                    echo '<a href="photogallery.php"><div class="col-4">
                    <div class="img-container">
                        <img src="gallery/'.$row["imgGallery"].'" alt="barista" width="100%">
                    </div>
                    <h3>'.$row["titleGallery"].'</h3>
                    <div class="author"><span>@'.$row["authorGallery"].'</span></div>
                    <p>Likes: '.$row["likesGallery"].'</p>
                </div></a>';
                }
            }   
            
            ?>
        </div>
    </div>  

    <div class="container">
        <h2>Photography Contest</h2>
        <hr>
        <div class="row">
            <div class="col-3">
                <div class="card-contest">
                    <div class="card-background">
                        <img src="resource/Images/wide-angle-shot-single-tree-growing-clouded-sky-during-sunset-surrounded-by-grass.jpg" alt="Tree">
                    </div>
                    <div class="card-caption">
                        <h3>Contest 1</h3>
                        <a href="photogallery.php"><button class="cta">
                            
                            <span class="hover-underline-animation"> Learn More </span>
                            <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                            </svg>
                        </button></a>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card-contest">
                    <div class="card-background">
                        <img src="resource/Images/close-up-cozy-texture-clothing_23-2149432482.jpg" alt="Cozy">
                    </div>
                    <div class="card-caption">
                        <h3>Contest 2</h3>
                        <button class="cta">
                            <span class="hover-underline-animation"> Learn More </span>
                            <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card-contest">
                    <div class="card-background">
                        <img src="resource/Images/nice-business-desk-black-background.jpg" alt="Desk">
                    </div>
                    <div class="card-caption">
                        <h3>Contest 3</h3>
                        <button class="cta">
                            <span class="hover-underline-animation"> Learn More </span>
                            <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                            </svg>
                        </button>
                    </div>
                </div>
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

