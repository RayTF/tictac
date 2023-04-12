<?php require("static/lib/profile.php"); ?>
<?php

$stmt = $mysqli->prepare("SELECT * FROM videos WHERE vid = ?");
$stmt->bind_param("s", $_GET['v']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) echo('<script>window.location.href = "index.php?err=Video ID '.$_GET['v'].' not found!";</script>');
while($row = $result->fetch_assoc()) {
if($row['author'] == $_SESSION['profileuser3']) {
    $vtitle = $row['videotitle'];
    $stmt2 = $mysqli->prepare("DELETE FROM videos WHERE vid = ?");
    $stmt2->bind_param("s", $_GET['v']);
    $stmt2->execute();
    unlink('content/video/'.$_GET['v'].'.mp4');
    header('Location: index.php?success=Video "'.$vtitle.'" deleted.');
} else {
    header('Location: index.php?err=This is not your video!');
}
}
?>