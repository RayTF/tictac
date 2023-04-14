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
		<div class="alert alert-primary">TODO: Redesign this so that it doesn't look like utter garbage.</div>
<div class="row"><div class="col">
	<div class="card">
		<div class="card-header bg-dark text-white">Channels</div>
		<div class="card-body">
						<div class="row">
						<?php
		$statement = $mysqli->prepare("SELECT * FROM users ORDER BY date DESC");
                $statement->execute();
                $result = $statement->get_result();
                if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
						if($row['is_verified'] == 1) {
							$verified = '<svg data-bs-toggle="tooltip" data-bs-placement="top" title="This user is verified." style="margin-left: 0.75%;" class="bi" width="24" height="24" fill="currentColor">
							<use xlink:href="icons.svg#patch-check-fill"/>
						</svg>';
						} else {
							$verified = "";
						}
						if ($row['displayname'] == null) {
                            $display = $row['username'];
                        } else {
                            $display = $row['displayname'];
                        }
                        echo '<div class="col-3">
						<div class="card" style="margin-bottom:10px">
	<div class="card-body text-center">
		<div class="row"><a href="@'.$row['username'].'">
			<div class="col-lg-12" style="margin-bottom:15px">
				<div class="img-thumbnail">
					<img class="img-fluid rounded-circle" src="content/pfp/'.getUserPic($row['username']).'">
				</div>
			</div>
			<div class="col-lg-12">
				<h4>'.$display.' '.$verified.'</h4>
			</div>
		</a></div>
	</div>
</div></div><!--ok-->';}}?>

					</div>
							</div>
		</div>
	</div>
</div></div>
		</div>
		<?php include("footer.php");?>
</body>
</html>