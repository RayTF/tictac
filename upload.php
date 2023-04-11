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
			<div class="text-end"><a href="my_videos.php" class="btn btn-light btn-sm">Video manager</a></div>
			</div>
            <?php
    if(!isset($_SESSION['profileuser3'])) {
        echo('<script>
             window.location.href = "index.php";
             </script>');
    }
   if (isset($_POST['submit'])){
//     if(empty($_POST['fileToUpload'])) {
//         error_reporting(E_ALL);
// ini_set('display_errors', '1');
//         echo('<script>
//         window.location.href = "index.php?err=No video file.";
//         </script>');
//     }
    if(empty($_POST['videotitle'])) {
        echo('<script>
        window.location.href = "index.php?err=No title.";
        </script>');
    }
    if(empty($_POST['bio'])) {
        echo('<script>
        window.location.href = "index.php?err=No description.";
        </script>');
    }
    if (strlen($_POST['videotitle']) > 30) {
        echo('<script>
        window.location.href = "index.php?err=Video title too long.";
        </script>');
        exit();
    }
       if(!isset($_SESSION['profileuser3'])) {
        echo '<script>
        window.location.href = "alogin.php";
        </script>';
       }
       function randstr($len, $charset = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-"){
           return substr(str_shuffle($charset),0,$len);
       }
       $v_id = randstr(11);
       $target_dir = "content/tmp/";
       $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
       if(!is_dir($target_dir)){
           mkdir($target_dir);
       }
       $uploadOk = 1;
       $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
       if (file_exists($target_file)) {
           echo "
           <div class='alert alert-error'>
           Video with the same filename already exists.
           </div>
           ";
           $uploadOk = 0;
       }
       if($imageFileType != "mp4" && $imageFileType != "avi") {
           echo "
           <div class='alert alert-error'>
           MP4 files only.
           </div>
           ";
           $uploadOk = 0;
       }
       if ($uploadOk == 0) {
           echo "
           <div class='alert alert-error'>
           Unknown error.
           </div>
           ";
       } else {
           if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
               rename("$target_file", "content/unprocessed/$v_id.mp4");
               $new_target_file = "content/unprocessed/$v_id.mp4";
               exec("$ffmpeg -i ".$new_target_file." -vf scale=1280x720 -c:v libx264 -b:a 128k  -c:a aac -ar 22050 content/video/$v_id.mp4");
               $processed_file = "content/video/$v_id.mp4";
               unlink("content/unprocessed/$v_id.mp4");
               $target_thumb = "content/thumb/".$v_id.".jpg";
               $thumbcmd = "$ffmpeg -i $processed_file -vf \"thumbnail\" -frames:v 1 -s 1280x720 $target_thumb";
               $video = $_POST['videotitle'];
               $user = $_SESSION['profileuser3'];
             //  $v_id = randstr(11);
               $statement = $mysqli->prepare("INSERT INTO videos (videotitle, vid, description, author, filename, thumb, date) VALUES (?, ?, ?, ?, ?, ?, now())");
               $statement->bind_param("ssssss", $videotitle, $v_id, $description, $author, $filename, $thumb);
               $videotitle = htmlspecialchars($_POST['videotitle']);
               $description = str_replace(PHP_EOL, "<br>", htmlspecialchars($_POST['bio']));
               $author = htmlspecialchars($_SESSION['profileuser3']);
               $filename = "$v_id.mp4";
               $thumb = "$v_id.jpg";
               exec($thumbcmd);
               $statement->execute();
               $statement->close();
               $webhookurl = $webhook;
               $msg = "**$user** just uploaded **$video** => uploaded to a private test instance";
               $json_data = array ('content'=>"$msg");
               $make_json = json_encode($json_data);
               $ch = curl_init( $webhookurl );
               curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
               curl_setopt( $ch, CURLOPT_POST, 1);
               curl_setopt( $ch, CURLOPT_POSTFIELDS, $make_json);
               curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
               curl_setopt( $ch, CURLOPT_HEADER, 0);
               curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
               $response = curl_exec( $ch );
               echo('<script>
             window.location.href = "watch.php?v='.$v_id.'";
             </script>');
           } else {
               echo "The upload failed. Error code: ";
               echo $_FILES["fileToUpload"]["error"];
           }
       }
   }
   ?>
            <form action="" method="POST" enctype="multipart/form-data">
  <div class="form-floating mb-3">
    <input type="text" class="form-control" name="videotitle" id="videotitle" aria-describedby="emailHelp">
    <label for="videotitle" class="form-label">Video title (up to 30 characters)</label>  
</div>
  <div class="form-floating mb-3">
    <textarea class="form-control" class="form-control" name="bio" id="bio" style="height: 200px"></textarea>
    <label for="bio" class="form-label">Description</label>
  </div>
  <div class="mb-3">
    <label for="fileToUpload" class="form-label">Select a video file (MP4 only, max 110MB)</label>
    <input class="form-control" type="file" id="fileToUpload" name="fileToUpload">
</div>
  <input type="submit" name="submit" value="Upload" class="btn btn-primary">
</form>
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