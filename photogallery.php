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
    <title>Illustra - Photo Gallery</title>
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

<body class="photo-gallery">
    <div class="container-photo-gallery">
        <div class="row-2">
            <h2>Photo Gallery</h2>
            <?php
            if (isset($_SESSION['email'])){
                echo '
                <button class="icon-btn add-btn" type="button" id="open-modal-button">
                    <div class="add-icon"></div>
                    <div class="btn-txt">Upload Photo</div>
                </button>
                <div class="modal" id="modal">
                    <div class="modal-content">
                        <div class="modal-header">
                        <span class="close-button">&times;</span>
                        <h2>Upload Photo</h2>
                        </div>
                        <div class="modal-body">
                            <div class="modal-form-container">
                                <form action="upload.inc.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="text" id="title" name="filename" placeholder="Filename...">
                                </div>  
                                <div class="form-group">
                                    <input type="text" id="title" name="imgtitle" placeholder="Title..."required>
                                </div>
                                <div class="form-group">
                                    <textarea id="description" name="imgdesc" placeholder="Photo Description..." required></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="file" name="file" id="file-input" title="Image aspect ratio should be 4:3 or 16:9 for a better output">
                                </div>  
                                <div class="form-group">
                                    <button type="submit" name="submit-upload" title="Image aspect ratio should be 4:3 or 16:9 for a better output">Upload</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>';
            }

            if (isset($_GET["upload"])){
                if ($_GET["upload"] == "empty"){
                    echo "<script>alert('Fill all required fields!')</script>";
                }
                else if ($_GET["upload"] == "success") {
                    echo "<script>alert('Image Uploaded Succesfully!')</script>";
                }
            }
            ?>  
        </div>
        
        <?php
        if (isset($_GET['photoID'])){
            $photo = $_GET['photoID'];
            $query = "SELECT * FROM gallery WHERE idGallery  = '$photo'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $photoID = $row['idGallery'];
                $imgGallery = $row['imgGallery'];
                $imgTitle = $row['titleGallery'];
                $imgDescription = $row['descGallery'];
                $imgAuthor = $row['authorGallery'];
                $imgLikes = $row['likesGallery'];
                $imgDateUploaded = $row['dateuploadGallery'];
                $dateUpload = date("F d, Y h:i a", strtotime($imgDateUploaded));
                
            }
        }
        ?>

        <div id="modal-photo-view" class="modal-photo-view">
            <div class="photo-view">
                <div class="left-content">
                <div class="close-photo-view">&times;</div>
                    <img src="gallery/<?php echo $imgGallery ?>" alt="placeholder">
                </div>
                <div class="right-content">
                    <h2 id="modal-img-title"><?php echo $imgTitle ?></h2>
                    <p id="modal-img-desc"><?php echo $imgDescription ?></p>
                    <div class="likes">
                        <span>Likes: <?php echo $imgLikes ?></span>
                    </div>
                    <div class="author">
                        <span id="modal-img-author">Uploaded By: <?php echo $imgAuthor ?></span>
                        <span id="modal-img-date"> Date Uploaded: <?php echo $dateUpload ?></span>
                    </div>
                    <?php 
                    if (isset($_SESSION["email"])){
                        $photoLikes = $_GET['photoID'];
                        echo '<form action="upload.inc.php?photoID='.$photoID.'" method="post"><button type="submit" name="submit-like" class="like-button">Like</button></form>';
                    }
                    ?>
                </div>
            </div>
        </div>

        <div class="row row-photo-gallery">
            <?php
            
            $sql = "SELECT * FROM gallery ORDER BY idGallery DESC;";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)){
                echo "<script>alert 'SQL Statement failed!'</script>";
            } else{
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                while ($row = mysqli_fetch_assoc($result)){
                    $timestamp = $row["dateuploadGallery"];
                    $dateUpload = date("F d, Y h:i a", strtotime($timestamp));
                  
                    echo '<div class="col-4-photo-gallery" data-photo-id="'.$row["idGallery"].'" id="photo-view-trigger'.$row["idGallery"].'" title="Author: '.$row["authorGallery"].' | Date Uploaded: '.$dateUpload.'">
                      <div class="img-container-photo-gallery"> 
                        <img src="gallery/'.$row["imgGallery"].'" alt="placeholder">  
                      </div> 
                      <h3>'.$row["titleGallery"].'</h3>
                      <span>'.$row["descGallery"].'</span>         
                    </div>';
                  }
            }
             ?>
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
const openModalButton = document.querySelector("#open-modal-button");
const modal = document.querySelector("#modal");
const closeButton = document.querySelector(".close-button");

openModalButton.addEventListener("click", function() {
  modal.style.display = "block";
});

closeButton.addEventListener("click", function() {
  modal.style.display = "none";
});

window.addEventListener("click", function(event) {
  if (event.target === modal) {
    modal.style.display = "none";
  }
});


//----------photo view modal----------//
const photoViewTriggers = document.querySelectorAll("[data-photo-id]");
const photoview = document.querySelector("#modal-photo-view");
const closePhotoView = document.querySelector('.close-photo-view');

console.log(photoViewTriggers);

photoViewTriggers.forEach(function(trigger) {
    trigger.addEventListener("click", function() {
    const photoID = this.getAttribute("data-photo-id");
    window.location.href = "http://localhost/Photo%20Gallery/photogallery.php?photoID=" + photoID;
    });
    photoview.style.display = "block";
});

photoview.addEventListener("click", function(event) {
if (event.target === photoview) {
    photoview.style.display = "none";
}
});

closePhotoView.addEventListener('click', function() {
    photoview.style.display = 'none';
});


</script>