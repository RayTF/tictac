<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
	<title>404 Not Found - Quadium</title>
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
</style>
<body>
	<?php include("masthead.php"); ?>
		<div class="container">
        <div class="container">
		<div class="row"><div class="col">
	<h3>
					Videos
			</h3>
	<div class="card-body">
				<div class="row">
                <?php
		$statement = $mysqli->prepare("SELECT * FROM videos ORDER BY date DESC LIMIT 20");
                $statement->execute();
                $result = $statement->get_result();
                if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
						$upload = time_elapsed_string($row['date']);
						$views = getViews($row['vid'], $mysqli); 
                        echo '
							<div class="col-3">
					<div class="card" style="margin-bottom:10px">
	<div class="card-body text-center">
		<div class="row"><a href="watch.php?v='.$row['vid'].'">
				<div class="col-lg-12" style="margin-bottom:15px">
					<div class="img-thumbnail">
						<img class="img-fluid" src="content/thumb/'.$row['thumb'].'">
					</div>
				</div>
			</a>
			<div class="col-lg-12">
				<h4><a href="watch.php?v='.$row['vid'].'">'.$row['videotitle'].'</a></h4>
																					<p>			<a class="user" href="@'.$row['author'].'">'.$row['author'].'</a> &bull; '.$views.' views &bull;
				'.$upload.'</p>
			</div>
		</div>
	</div>
</div></div>';}}?>

	</div>
</div></div>
		</div>
		</div>
		<?php include("footer.php");?>
</body>
</html>