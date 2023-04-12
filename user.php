<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
<?php 
            $statement = $mysqli->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $statement->bind_param("s", $_GET['name']);
            $statement->execute();
            $result = $statement->get_result();
            while($row = $result->fetch_assoc()) {
                if ($row['banned'] == '1') {
                    header("Location: index.php?err=This account has been suspended by Quadium staff<br/>Reason: ".$row['banreason']);
              }else{
                echo "<title>".$row['username']." - Quadium</title>";
              }
            }
            $statement->close();
        ?>
<body>
<?php include("masthead.php"); ?>
<div class="mb-4">
	</div>
    <?php
    $rows = getSubscribers($_GET['name'], $mysqli);
                    $statement = $mysqli->prepare("SELECT * FROM `users` WHERE `username` = ? LIMIT 1");
                    $statement->bind_param("s", $_GET['name']);
                    $statement->execute();
                    $result = $statement->get_result();
                    while($row = $result->fetch_assoc()) {
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
    margin-top: -24px;
	padding-bottom: 25px;
	}
</style>
<div class="bg-channel-background">
	<div class="col-12 mb-2 mt-0">
	<div class="p-1 bg-custom-profile text-white">
		<div class="container py-4">
			<div class="row">
				<div class="col-md-10">
					<img class="float-start rounded-circle me-3" src="content/pfp/'.getUserPic($row['username']).'" width="150" height="150" alt="pfp">
					<h1 class="align-top fw-bold mb-0">
                    '.$display.''.$verified.''.$admin.''.$rare.'</h1>
						<div class="fs-4">@'.$row['username'].'</div>
					<p class="fs-6 text-break">'.$row['description'].'</p>
				</div>';}?>
                 <?php if($_GET['name'] == $_SESSION['profileuser3']) {
                                    echo '<div class="col-md-2">
                                    <a href="account.php" id="editprof" class="btn btn-primary" type="button">Edit Profile</a>
                                </div>';
                                } else {
                            if(isset($_SESSION['profileuser3'])) {
                                if(ifSubscribed($_SESSION['profileuser3'], $_GET['name'], $mysqli) == false) {
                               echo '<div class="col-md-2">
                               <a href="subscribe.php?name='.$_GET['name'].'" id="subscribe" class="btn btn-warning" type="button">Subscribe <span class="badge bg-dark text-bg-secondary">'.$rows.'</span></a>
                           </div>';
                               } else { 
                                echo '<div class="col-md-2">
                                <a href="unsubscribe.php?name='.$_GET['name'].'" id="subscribe" class="btn btn-secondary" type="button">Unsubscribe <span class="badge bg-dark text-bg-secondary">'.$rows.'</span></a>
                            </div>';
                                 } 
                                } else {
                                    echo '<div class="col-md-2">
                                    <a id="subscribe" class="btn btn-warning" type="button" disabled>Subscribe <span class="badge bg-dark text-bg-secondary">'.$rows.'</span></a>
                                </div>';
                                }
                            }
                                 ?>
                                 <?php echo'
			</div>
		</div>
	</div>
</div>';?>
		<div class="container">
		<div class="row">
		<!-- This prevents the user info box from being extremely tall. Box probably needs to be redesigned... -->
	<div class="col-md-8 order-2 order-md-1">
		<div class="card">
			<div class="card-body">
				<div class="caption">
                    <?php
					echo '<h3>Uploaded by '.$display.'</h3>';
                    $statement = $mysqli->prepare("SELECT * FROM `videos` WHERE `author` = ?");
                    $statement->bind_param("s", $_GET['name']);
                    $statement->execute();
                    $result = $statement->get_result();
                    if($result->num_rows !== 0){
                    while($row = $result->fetch_assoc()) {
                        $upload = time_elapsed_string($row['date']);
                        $views = getViews($row['vid'], $mysqli); 
                        echo '<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v='.$row['vid'].'">
					<div class="img-thumbnail">
						<img class="img-fluid" width="960" height="540" src="content/thumb/'.$row['thumb'].'">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v='.$row['vid'].'">'.$row['videotitle'].'</a></h3>
																					<p>			<a class="user" href="user.php?name='.$row['author'].'">'.$row['author'].'</a> &bull; '.$row['views'].' views	&bull;
				<span class="text-muted">'.$upload.'</span></p>
				<p>'.$row['description'].'</p>
			</div>
		</div>
	</div>
</div>';}}?>
</div>
			</div>
		</div>
	</div>
    <?php
                   $rows = getSubscribers($_GET['name'], $mysqli);
                    $statement = $mysqli->prepare("SELECT * FROM `users` WHERE `username` = ? LIMIT 1");
                    $statement->bind_param("s", $_GET['name']);
                    $statement->execute();
                    $result = $statement->get_result();
                    while($row = $result->fetch_assoc()) {
                        $idk = strtotime($row['date']);
                        $joindate = date("F d, Y", $idk);
                        echo '
	<div class="col-md-4 order-1 order-md-2">
		<div class="card mb-2">
			<div class="card-body">
				<h4>About '.$display.'</h4>
				<hr>
				<!-- <dl class="row mb-0">
				 	<dt class="col-auto">Last seen</dt>
				 	<dd class="col-auto">18 days ago</dd>
				 </dl> -->
				<dl class="row mb-0">
					<dt class="col-auto">Joined</dt>
					<dd class="col-auto">'.$joindate.'</dd>
				</dl>
				<dl class="row mb-0">
																										<dt class="col-auto">Subscribers</dt>
					<dd class="col-auto">'.$rows.'</dd>
				</dl>
				</div>
			</div>
					</div>
	</div>';}?>
</div>
</div>
<div class="container">
		</div>
        <?php include("footer.php");?>
  </body>
</html>