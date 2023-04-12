<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>Home - Quadium</title>
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
</style>
<body>
	<?php include("masthead.php"); ?>
		<div class="container">
        <?php 
    error_reporting(~E_ALL & ~E_NOTICE);
         if(isset($_GET['err'])) {
            $err = $_GET['err'];
   echo '<div class="alert alert-danger" role="alert">
   '.$err.'
         </div>'; 
 }
 if(isset($_GET['msg'])) {
    $msg = $_GET['msg'];
echo '<div class="alert alert-primary" role="alert">
'.$msg.'
 </div>'; 
}
if(isset($_GET['success'])) {
    $suc = $_GET['success'];
echo '<div class="alert alert-success" role="alert">
'.$suc.'
 </div>'; 
} ?>
		<div class="row">
	<div class="col-xl-8">
				<div class="row">
			<div class="col-8">
			<h3>Recently uploaded to Quadium</h3>
			</div><div class="col-4">
			<div class="text-end"><a href="browse.php" class="btn btn-light btn-sm">Browse videos</a></div>
			</div>
		</div>
		<?php
		$statement = $mysqli->prepare("SELECT * FROM videos ORDER BY date DESC LIMIT 10");
                //$statement->bind_param("s", $_POST['fr']); i have no idea what this is but we don't need it
                $statement->execute();
                $result = $statement->get_result();
                if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
						$upload = time_elapsed_string($row['date']);
						$views = getViews($row['vid'], $mysqli); 
                        echo '
					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v='.$row['vid'].'">
					<div class="img-thumbnail">
						<img class="img-fluid" src="content/thumb/'.$row['thumb'].'">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v='.$row['vid'].'">'.$row['videotitle'].'</a></h3>
																					<p>			<a class="user" href="user.php?name='.$row['author'].'">'.$row['author'].'</a> &bull; '.$views.' views	&bull;
				<span class="text-muted">'.$upload.'</span></p>
				<p>'.$row['description'].'</p>
			</div>
		</div>
	</div>
</div>';}}?>
			</div>
	<div class="col-xl-4">
					<h3>Welcome to Quadium</h3>
			<p>I can't believe it's not squareBracket</p>
				<hr/>
		<h3>News and updates</h3>
		<p>Quadium is pretty much finished now. It's now a finished version of the prototype named "RockTube" from February 2022.</p>
		<p class="blockquote-footer">crazyassfella</p>
		<figure>
		  <blockquote class="blockquote">
		    <p>Ok</p>
		  </blockquote>
		  <figcaption class="blockquote-footer">
		    msnaero, on <cite title="crazyassfella's direct messages">crazyassfella's direct messages</cite>
		  </figcaption>
		</figure>
		<hr/>
		<h3>Featured videos</h3>
					<p>No featured videos.</p>
			</div>
</div>
		</div>
		<?php include("footer.php");?>
</body>
</html>