<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Edit Video - <?php echo $sitename;?></title>
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
</style>
<body>
	<?php include("masthead.php"); ?>
		<div class="container">
        <div class="row">
	<div class="col-xl-8">
				<div class="row">
			<div class="col-8">
                <?php
                                    $statement = $mysqli->prepare("SELECT * FROM `videos` WHERE `vid` = ? LIMIT 1");
                                    $statement->bind_param("s", $_GET['v']);
                                    $statement->execute();
                                    $result = $statement->get_result();
                                    while($row = $result->fetch_assoc()) {
                                        $title = $row['videotitle'];
                                        $desc = $row['description'];
                                        $priv = $row['privacy'];
                                    if ($_SESSION['profileuser3'] !== $row['author']) {
                                        echo('<script>window.location.href = "index.php?err=This is not your video!";</script>');
                                    }
                                }
                                ?>
			<h3>Editing <?php echo $_GET['v']; ?></h3>
			</div><div class="col-4">
			</div>
            <form action="" method="POST" enctype="multipart/form-data">
  <div class="form-floating mb-3">
    <input type="text" value="<?php echo $title; ?>" class="form-control" name="videotitle" id="videotitle" aria-describedby="emailHelp">
    <label for="videotitle" class="form-label">Video title (up to 27 characters)</label>  
</div>
  <div class="form-floating mb-3">
    <textarea class="form-control" class="form-control" name="bio" id="bio" style="height: 200px"><?php echo $desc; ?></textarea>
    <label for="bio" class="form-label">Description</label>
  </div>
  
  <div class="mb-3">
    <label for="privacy" class="form-label">Select video privacy</label>
    <select class="form-select" name="privacy" id="privacy" aria-label="Default select example">
  <option selected>Select a video privacy</option>
  <option value="public">Public - Everyone on clipIt can view this video</option>
  <option value="unlisted">Unlisted - Only people with the link can view this video</option>
  <!-- <option value="private">Private - Only you can view this video</option> -->
</select>
</div>
  <input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>
<?php
				if (isset($_POST["submit"])){
					if(!empty($_POST['bio'])){
						$statement = $mysqli->prepare("UPDATE `videos` SET `description` = ? WHERE `vid` = '" . $_GET["v"] . "'");
					    $statement->bind_param("s", $description);
					    $description = str_replace(PHP_EOL, "<br>", htmlspecialchars($_POST['bio']));
					    $statement->execute();
					    $statement->close();
					}
                    if(!empty($_POST['videotitle'])){
						$statement = $mysqli->prepare("UPDATE `videos` SET `videotitle` = ? WHERE `vid` = '" . $_GET["v"] . "'");
					    $statement->bind_param("s", $_POST['videotitle']);
					    $displayname = htmlspecialchars($_POST['videotitle']);
                        $trimmed = substr($videotitle, 0, 27);
					    $statement->execute();
					    $statement->close();
					}
                    if(!empty($_POST['privacy'])){
						$statement = $mysqli->prepare("UPDATE `videos` SET `privacy` = ? WHERE `vid` = '" . $_GET["v"] . "'");
					    $statement->bind_param("s", $_POST['privacy']);
					    $statement->execute();
					    $statement->close();
					}
                    echo('<script>
             window.location.href = "watch.php?v='.$_GET['v'].'";
             </script>');
				}
			?>
		</div>

			</div>
	<div class="col-xl-4">
					
			</div>
</div>
		</div>
		<?php include("footer.php");?>
</body>
</html>