<?php
include("config.php");
        if(isset($_POST['submit'])) {
            if(!empty($_POST['bio'])) {
            if(!isset($_SESSION['profileuser3'])) {
                die("Please login to comment.");
            }
            else {
                $stmt = $mysqli->prepare("INSERT INTO comments (tovideoid, author, comment, date) VALUES (?, ?, ?, now())");
                $stmt->bind_param("sss", $_GET['v'], $_SESSION['profileuser3'], $comment);
    
                $comment = str_replace(PHP_EOL, "<br>", htmlspecialchars($_POST['bio']));
    
                $stmt->execute();
                $stmt->close();
                
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER'] . '&err=Comment cannot be empty.');
        }
        }
    ?>