<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Edit Profile - Quadium</title>
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
			<h3>Edit your channel</h3>
			</div><div class="col-4">
			</div>
            <form action="" method="POST" enctype="multipart/form-data">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" name="displayname" id="displayname" aria-describedby="emailHelp">
    <label for="displayname" class="form-label">Display name</label>  
</div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" name="bg" id="bg">
    <label for="bg" class="form-label">Channel background (must be external URL)</label>  
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
					    $statement->bind_param("s", $_POST['displayname']);
					    $displayname = htmlspecialchars($_POST['displayname']);
                        $trimmed = substr($displayname, 0, 30);
					    $statement->execute();
					    $statement->close();
					}
                    if(!empty($_POST['bg'])){
						$statement = $mysqli->prepare("UPDATE `users` SET `channel_background` = ? WHERE `username` = '" . $_SESSION["profileuser3"] . "'");
					    $statement->bind_param("s", $_POST['bg']);
					    $bg = htmlspecialchars($_POST['bg']);
					    $statement->execute();
					    $statement->close();
					}
				}
			?>
		</div>

			</div>
	<div class="col-xl-4">
					<h3>Profile Preview</h3>
                    <style>
	.bg-custom-profile {
  background-image: linear-gradient(#0054b6, #004492 50%, #00316a);
  color: white;
}
.bg-primary {
  background-image: linear-gradient(#0067df, #0054b6 60%, #004ba2);
}

	.bg-channel-background {
	background-image: url("'.$row['channel_background'].'");

	}
</style>
                    <?php
			if(isset($_SESSION['profileuser3'])){
				$rows = getSubscribers($_SESSION['profileuser3'], $mysqli);
			    $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
			    $statement->bind_param("s", $_SESSION['profileuser3']);
			    $statement->execute();
			    $result = $statement->get_result();
			    if($result->num_rows === 0) exit('No rows');
			    while($row = $result->fetch_assoc()) {
					$join = date("F d, Y", strtotime($row["date"]));
                    if ($row['displayname'] == null) {
                        $display = $row['username'];
                    } else {
                        $display = $row['displayname'];
                    }
                    if ($row['is_verified'] == 1) {
                        $verified = '<svg data-bs-toggle="tooltip" data-bs-placement="top" title="This user is verified." style="margin-left: 0.75%;" class="bi" width="32" height="32" fill="currentColor">
                        <use xlink:href="icons.svg#patch-check-fill"/>
                    </svg>';
                    } else {
                        $verified = '';
                    }
                    if ($row['is_rare'] == 1) {
                        $rare = '<svg data-bs-toggle="tooltip" data-bs-placement="top" title="This user has a rare username." style="margin-left: 0.75%;" class="bi" width="32" height="32" fill="currentColor">
                        <use xlink:href="icons.svg#type"/>
                    </svg>';
                    } else {
                        $rare = '';
                    }
                    if ($row['is_admin'] == 1) {
                        $admin = '<svg data-bs-toggle="tooltip" data-bs-placement="top" title="This user is a Quadium admin." style="margin-left: 0.75%;" class="bi" width="32" height="32" fill="currentColor">
                        <use xlink:href="icons.svg#person-badge"/>
                    </svg>';
                    } else {
                        $admin = '';
                    }
			        echo '
                    <div class="bg-channel-background">
	<div class="col-12 mb-2 mt-0">
	<div class="p-1 bg-custom-profile text-white">
		<div class="container py-4">
			<div class="row">
				<div class="col-md-10">
					<img class="float-start rounded-circle me-3" src="content/pfp/'.getUserPic($_SESSION['profileuser3']).'" width="150" height="150" alt="pfp">
					<h1 class="align-top fw-bold mb-0">
                    '.$display.''.$verified.''.$admin.''.$rare.'</h1>
						<div class="fs-4">@'.$row['username'].'</div>
					<p class="fs-6 text-break">'.$row['description'].'</p>
				</div>                                                  
			</div>
		</div>
	</div>
</div>';}}?>
			</div>
</div>
		</div>
		<?php include("footer.php");?>
</body>
</html>