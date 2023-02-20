<?php
    include_once 'component.php';
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
    <title>Illustra - Login</title>
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
                </ul>
            </nav>
        </div>
</header>

<body class="signuplogin">
    <div class="container">
        <div class="row">
            <div class="form-container">
                <div class="illustration">
                    <div class="carousel-container">
                        <div class="carousel">
                            <img src="resource/Images/bali-pagoda-sunrise-indonesia.jpg" alt="carousel" width="100%">
                        </div>
                        <div class="carousel">
                            <img src="resource/Images/sant-jordi-celebration-with-white-rose-book.jpg" alt="carousel" width="100%">
                        </div>
                        <div class="carousel">
                            <img src="resource/Images/australian-white-tree-frog-leaves-dumpy-frog-branch.jpg" alt="carousel" width="100%">
                        </div>
                    </div>
                </div>
                <div class="form">
                    <div class="input-form">
                        <h1>Login to your account</h1>
                        <?php
                        if (isset($_GET["message"])){
                            if ($_GET["message"] == "signupsuccess")
                            echo "<script>alert('Signup Successful!')</script>";
                        }
                        if (isset($_GET["error"])){
                            if ($_GET["error"] == "emptylogininput"){
                                echo "<script>alert('Fill all required fields!')</script>";
                            }
                            else if ($_GET["error"] == "invalidlogin") {
                                echo "<script>alert('Invalid Email or Password!')</script>";
                            }
                        }
                        ?>  
                        <form action="login.inc.php" method="post">
                            <div class="group">
                                <input required="" type="text" class="input" name="email">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Email</label>
                            </div>
                            <div class="group">
                                <input required="" type="password" class="input" name="pwd">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Password</label>
                            </div>
                            <button class="form-button" type="submit" name="submit">Login</button>
                        </form>
                        <span>Dont have an account yet? <a href="signup.php">Signup</a></span>
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

<script>
const illustration = document.querySelector('.illustration');
const carousels = document.querySelectorAll('.carousel');
let index = 0;

function changeSlide() {
    carousels.forEach(carousel => {
    carousel.style.display = "none";
  });

  index++;

  if (index >= carousels.length) {
    index = 0;
  }

  carousels[index].style.display = "flex";
}

setInterval(changeSlide, 4000);
</script>