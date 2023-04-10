<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Upload - ticTac</title>
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
            <div class="form-floating">
            <form>
  <div class="mb-3">
    <label for="title" class="form-label">Video title (up to 30 characters)</label>
    <input type="email" class="form-control" id="title" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Upload</button>
</form></div>
		</div>

			</div>
	<div class="col-xl-4">
					<h3>Remember to follow ToS</h3>
			<p>Make sure your video doesn't violate them! Otherwise, action will be taken on your channel.</p>
				<hr/>
			</div>
</div>
		</div>
		<?php include("footer.php");?>
</body>
</html>