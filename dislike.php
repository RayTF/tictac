<?php require("config.php"); ?>
<?php require("static/lib/profile.php"); ?>

<?php
$name = $_GET['v'];

if(!isset($_SESSION['profileuser3']) || !isset($_GET['v'])) {
    die("You are not logged in or you did not put in an argument");
}

$stmt = $mysqli->prepare("SELECT * FROM likes WHERE sender = ? AND reciever = ? AND type = 'd'");
$stmt->bind_param("ss", $_SESSION['profileuser3'], $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1) {
        removeLike($_SESSION['profileuser3'], $name, $mysqli);
    }

$stmt = $mysqli->prepare("SELECT * FROM likes WHERE sender = ? AND reciever = ? AND type = 'l'");
$stmt->bind_param("ss", $_SESSION['profileuser3'], $name);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows === 1) {
        removeLike($_SESSION['profileuser3'], $name, $mysqli);
    } else {
        addDislike($_SESSION['profileuser3'], $name, $mysqli);
    }
$stmt->close();

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>