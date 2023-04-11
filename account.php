<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Upload - Quadium</title>
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
			<h3>Upload a video</h3>
			</div><div class="col-4">
			</div>
            <form action="" method="POST" enctype="multipart/form-data">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" name="displayname" id="displayname" aria-describedby="emailHelp">
    <label for="displayname" class="form-label">Display name</label>  
</div>
  <div class="form-floating mb-3">
    <textarea class="form-control" class="form-control" name="description" id="description" style="height: 200px"></textarea>
    <label for="description" class="form-label">Description</label>
  </div>
  <div class="mb-3">
    <label for="new_pic" class="form-label">Select a profile picture (PNG/GIF/JPG)</label>
    <input class="form-control" type="file" id="new_pic" name="new_pic">
</div>
  <input type="submit" name="submit" value="Update" class="btn btn-primary">
</form>
<?php
				if (isset($_POST["submit"])){
					if(isset($_FILES["new_pic"]) && is_uploaded_file($_FILES["new_pic"]["tmp_name"])){
						$supportedFormats = [
							"image/jpeg",
							"image/png",
							"image/gif",
						];
					    $uid = 0;
					    try{
					    	$uid = $_SESSION["profileuser3"];
						    $target_file = "content/pfp/".$uid;
						    $supported = false;
						    foreach($supportedFormats as $value){
						    	if($value === mime_content_type($_FILES["new_pic"]["tmp_name"])){
						    		$supported = true;
						    	}
						    }
						    if($supported === true && $_FILES["new_pic"]["size"] < 5000000){
						    	file_put_contents($target_file, file_get_contents($_FILES["new_pic"]["tmp_name"]));
						    }
						    else{
						    	if(!$supported){
						    		echo "Image not supported (jpg, png or gif)";
						    	}
						    	else{
							    	echo "Image is too large";
						    	}
						    }
					    }
					    catch(Exception $e){
					    	echo "Something happened: ".$e;
					    }
					}
					if(!empty($_POST['description'])){
						$statement = $mysqli->prepare("UPDATE `users` SET `description` = ? WHERE `username` = '" . $_SESSION["profileuser3"] . "'");
					    $statement->bind_param("s", $description);
					    $description = str_replace(PHP_EOL, "<br>", htmlspecialchars($_POST['description']));
					    $statement->execute();
					    $statement->close();
					}
                    if(!empty($_POST['displayname'])){
						$statement = $mysqli->prepare("UPDATE `users` SET `displayname` = ? WHERE `username` = '" . $_SESSION["profileuser3"] . "'");
					    $statement->bind_param("s", $displayname);
					    $description = htmlspecialchars($_POST['displayname']);
					    $statement->execute();
					    $statement->close();
					}
				}
			?>
		</div>

			</div>
	<div class="col-xl-4">
					<h3>Remember to follow ToS</h3>
			<p>Make sure your video doesn't violate them! Otherwise, action will be taken on your channel.</p>
				<hr/>
                <p class="text-danger">If the page looks like it's loading for a long time, do not leave the page, as the video is processing and it will stop if you navigate away.
			</div>
</div>
		</div>
		<?php include("footer.php");?>
</body>
</html>