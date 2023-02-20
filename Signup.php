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
    <title>Illustra - Sign Up</title>
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
                <div class="form">
                    <div class="input-form">
                    <h1>Create an account</h1>
                    <?php
                    if (isset($_GET["error"])){
                        if ($_GET["error"] == "emptyinput"){
                            echo "<script>alert('Fill all required fields!')</script>";
                        }
                        else if ($_GET["error"] == "invalidemail") {
                            echo "<script>alert('Invalid email!')</script>";
                        }
                        else if ($_GET["error"] == "passworddontmatch") {
                            echo "<script>alert('Password dont match!')</script>";
                        }
                        else if ($_GET["error"] == "emailalreadytaken") {
                            echo "<script>alert('Email already taken!')</script>";
                        }
                        else if ($_GET["error"] == "stmtfailed") {
                            echo "<script>alert('Whoops something went wrong :<')</script>";
                        }
                        else if ($_GET["error"] == "invalidpassword") {
                            echo "<script>alert('Passwords must be at least 6 characters long, contain at least one lowercase and one uppercase letter, and include at least one number.')</script>";
                        }
                        else if ($_GET["error"] == "none") {
                            header("Location: Login.php?message=signupsuccess");
                        }
                    }
                    ?>  
                        <form action="signup.inc.php" method="post">

                            <div class="group">
                                <input required="" type="text" class="input" name="firstname">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>First Name</label>
                            </div>
                            <div class="group">
                                <input required="" type="text" class="input" name="lastname">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Last Name</label>
                            </div>
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
                            <div class="group">
                                <input required="" type="password" class="input" name="pwdrepeat">
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Confirm Password</label>
                            </div>
                            <button class="form-button" type="submit" name="submit">Sign Up</button>
                        </form>
                        <span>Already have an account? <a href="login.php">Login</a></span>
                    </div>
                </div>
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