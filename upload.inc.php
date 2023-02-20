<?php
session_start();
include_once 'dbh.php';

if (isset($_SESSION["email"])){
    $email = $_SESSION["email"];
    $query = "SELECT firstname FROM users WHERE email  = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $author = $row['firstname'];
    
    }
}

if (isset($_POST['submit-upload'])){

    $newFilename = $_POST['filename'];
    if (empty($newFilename)){
        $newFilename = "gallery";
    }else{
        $newFilename = strtolower(str_replace(" ", "-", $newFilename));
    }
    $imgTitle = $_POST['imgtitle'];
    $imgDesc = $_POST['imgdesc'];

    $file = $_FILES['file'];

    $fileName = $file["name"];
    $filType = $file["type"];
    $fileTempname = $file["tmp_name"];
    $fileError = $file["error"];
    $fileSize = $file["size"];

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if (in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            if ($fileSize < 2000000){
                $imgFullname = $newFilename . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "gallery/" . $imgFullname;

                
                if (empty($imgTitle) || empty($imgDesc)){
                    header("Location: photogallery.php?upload=empty");
                    exit();
                }else{
                    $sql = "INSERT INTO gallery (titleGallery, descGallery,	imgGallery, authorGallery) VALUES (?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        echo "<script>alert 'SQL Statement failed!'</script>";
                    }else{
                        mysqli_stmt_bind_param($stmt, "ssss", $imgTitle, $imgDesc, $imgFullname, $author);
                        mysqli_stmt_execute($stmt); 

                        move_uploaded_file($fileTempname, $fileDestination);

                        header("Location: photogallery.php?upload=success");
                        exit();
                    }
                }   
            }else{
                echo '<script>alert"File size is over 200mb!"</script>';
                exit();
            }
        }else{
            echo '<script>alert"You have an error!"</script>';
            exit();
        }
    }else{
        echo '<script>alert"Only jpg and png file type is allowed!"</script>';
        exit();
    }

}

if (isset($_POST['photoID'])){

    $photoID = $_POST["photoID"];
    // Increment the likes for the corresponding image
    $sql = "UPDATE gallery SET likes = likes + 1 WHERE idGallery = '$photoID'";
    $result = mysqli_query($conn, $sql);

    mysqli_close($conn);

    if ($result) {
        header("Location :photogallery.php?photoID=" + $photoID);
    } else {
        echo "<script>alert('Something went wrong!')</script>";
    }

}