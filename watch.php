<!doctype html>
<html lang="en">
<head>
<?php include("common.php"); ?>
<?php 
            $statement = $mysqli->prepare("SELECT * FROM videos WHERE vid = ? LIMIT 1");
            $statement->bind_param("s", $_GET['v']);
            $statement->execute();
            $result = $statement->get_result();
            while($row = $result->fetch_assoc()) {
                echo '
		<meta name="title" content="'.$row['videotitle'].' - Quadium">
	<meta name="description" content="'.$row['description'].'">
	<meta property="og:site_name" content="Quadium"/>
	<meta property="og:title" content="'.$row['videotitle'].' - Quadium">
	<meta property="og:description" content="'.$row['description'].'">
	<meta property="og:image" content="content/thumb/'.$row['vid'].'.jpg">
	<meta property="og:url" content="watch.php?v='.$row['videotitle'].'">
	<meta property="twitter:title" content="'.$row['videotitle'].' - Quadium">
	<meta property="twitter:description" content="'.$row['description'].'">
	<meta property="twitter:image" content="content/thumb/'.$row['vid'].'.jpg">
	<meta name="twitter:card" content="summary_large_image">
	<title>'.$row['videotitle'].' - Quadium</title>';
    $who = $row['author'];
    $rows = getSubscribers($row['author'], $mysqli);
    $idk = strtotime($row['date']);
    $upload = date("F d, Y", $idk);}
    $statement = $mysqli->prepare("SELECT * FROM `users` WHERE `username` = ? LIMIT 1");
        $statement->bind_param("s", $who);
        $statement->execute();
        $result = $statement->get_result();
        while($row = $result->fetch_assoc()) {
        if ($row['is_verified'] == 1) {
            $verified = '<svg data-bs-toggle="tooltip" data-bs-placement="top" title="This user is verified." style="margin-left: 0.75%;" class="bi" width="16" height="16" fill="currentColor">
            <use xlink:href="icons.svg#patch-check-fill"/>
        </svg>';
        } else {
            $verified = '';
        }
        $likec = getLikes($_GET['v'], $mysqli);
        $dislikec = getDislikes($_GET['v'], $mysqli);
        $views = getViews($_GET['v'], $mysqli); 
		if(isset($_SESSION["profileuser3"])) {
		addView($_GET['v'], @$_SESSION['profileuser3'], $mysqli);
		$commentplaceholder = "Enter your comment here.";
		$commentbutton = '<div><input style="width:100%;margin-bottom:10px;" type="submit" name="submit" value="Comment" class="btn btn-primary float-end"></div>';
		} else {
		$commentplaceholder = "Please sign in to comment.";
		$commentbutton = '<input type="submit" name="submit" value="Comment" class="btn btn-primary float-end" disabled>';
		}
    }?>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
    :root {
    --plyr-color-main: #FF7F00;
    }
</style>
<body>

<?php include("masthead.php"); ?>
		<div class="container">
		<div class="row">
	<div class="col-lg-9">
    <?php
$stmt = $mysqli->prepare("SELECT * FROM videos WHERE vid = ?");
$stmt->bind_param("s", $_GET['v']);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows === 0) echo('<script>window.location.href = "index.php?err=Video ID '.$_GET['v'].' not found!";</script>');
while($row = $result->fetch_assoc()) {
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
}
    echo('
		<div id="container" style="height: 30rem;">
        <video id="c" controls crossorigin playsinline poster="content/thumb/'.$row['vid'].'.jpg">
        <source src="content/video/'.$row['vid'].'.mp4" type="video/mp4" />
        </video>	
    </div>
    <script src="https://cdn.dashjs.org/latest/dash.all.min.js"></script>
		<script src="https://cdn.plyr.io/3.7.8/plyr.polyfilled.js"></script>
		<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=es6,Array.prototype.includes,CustomEvent,Object.entries,Object.values,URL"></script>
        <script>
  const player = new Plyr("#c");
</script>
            <style>
				.plyr--video {
					height: 30rem;
					--plyr-font-family: var(--bs-font-sans-serif);
				}
		    </style>

		<div style="margin-top:5px">
			<div class="card">
				<div class="card-body">
					<h4>'.$row['videotitle'].'</h4><hr class="mt-2 mb-3"/>
					<div class="row">
						<div class="col-lg-9">
							<div class="row">
								<div class="col-lg-2" style="width:10%;padding-right:0">
									<a href="user.php?name='.$row['author'].'">
										<img class="float-start rounded-circle w-100" src="content/pfp/'.getUserPic($row['author']).'">
									</a>
								</div>
								<div class="col-lg-10">
												<a class="user" href="user.php?name='.$row['author'].'">'.$row['author'].''.$verified.'</a><br>
																																																																										<small>Uploaded on '.$upload.' &bull; '.$views.' views &bull; '.$rows.' subscribers</small>
								</div>
							</div>
						</div>
						<div class="col-3 text-end">
							<a href="like.php?v='.$_GET['v'].'" id="action_unlogged" class="text-success"><svg class="bi" width="20" height="20" fill="currentColor">
								<use xlink:href="icons.svg#hand-thumbs-up-fill"/>
							</svg></a> <span id="likes">'.$likec.'</span>
							<a href="dislike.php?v='.$_GET['v'].'" id="action_unlogged" class="text-danger"><svg class="bi" width="20" height="20" fill="currentColor">
								<use xlink:href="icons.svg#hand-thumbs-down-fill"/>
							</svg></a> <span id="dislikes" style="padding-right: 10px">'.$dislikec.'</span>');
                             if($row['author'] == $_SESSION['profileuser3']) {
                                echo '
                                <a href="account.php" id="editprof" class="btn btn-primary" type="button">Edit Profile</a>';
                            } else {
                        if(isset($_SESSION['profileuser3'])) {
                            if(ifSubscribed($_SESSION['profileuser3'], $row['author'], $mysqli) == false) {
                           echo '
                           <a href="subscribe.php?name='.$row['author'].'" id="subscribe" class="btn btn-warning" type="button">Subscribe</a>';
                           } else { 
                            echo '
                            <a href="unsubscribe.php?name='.$row['author'].'" id="subscribe" class="btn btn-secondary" type="button">Unsubscribe</a>
                        ';
                             } 
                            } else {
                                echo'
                                <a id="subscribe" class="btn btn-warning" type="button" disabled>Subscribe</a>
                            ';
                            }
                        }
							echo('</div>
						<p style="margin-top: 1rem;">'.$row['description'].'</p>
					</div>
				</div>
			</div>
		</div> <!-- WATCH VIDEO BOX -->'); $stmt->close();}?><br>
		<div class="card">
				<div class="card-body">
				<?php
        $stmt = $mysqli->prepare("SELECT * FROM comments WHERE tovideoid = ? ORDER BY date DESC");
        $stmt->bind_param("s", $_GET['v']);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) echo('No comments.');
		$count = $result->num_rows;
		echo '<h5>'.$count.' Comments</h5><hr class="mt-2 mb-3"/>
				<div class="mt-1">
					<form action="comment.php?v='.$_GET['v'].'" method="POST">
					<textarea class="form-control mt-2 mb-2" name="bio" id="commentContents" style="overflow:hidden;resize:none" rows="3" placeholder="'.$commentplaceholder.'"></textarea>
					'.$commentbutton.'	
				</form>';
        while($row = $result->fetch_assoc()) {
			$cd = time_elapsed_string($row['date']);
		echo'
							<div id="comment">
									<div class="row">
	<div class="col-lg-1" style="width:5.5%;padding-right:0">
		<a href="user.php?name='.$row['author'].'">
			<img class="rounded-circle w-100" src="content/pfp/'.getUserPic($row['author']).'">
		</a>
	</div>
	<div class="col-lg-10">
					<a class="user" href="user.php?name='.$row['author'].'">'.$row['author'].'</a> &bull; '.$cd.'
		<p>'.$row['comment'].'</p>	</div>
</div>
								</div>
';}?>
</div></div></div></div>
	<div class="col-lg-3">
	<?php
		$statement = $mysqli->prepare("SELECT * FROM videos ORDER BY RAND() LIMIT 6");
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
			<div class="col-5">
				<a href="watch.php?v='.$row['vid'].'">
					<div class="img-thumbnail" style="margin-bottom:0">
						<img class="img-fluid" src="content/thumb/'.$row['thumb'].'">
					</div>
				</a>
			</div>
			<div class="col-7">
				<h5><a href="watch.php?v='.$row['vid'].'">'.$row['videotitle'].'</a></h5>
																					<p>			<a class="user" href="user.php?name='.$row['author'].'">'.$row['author'].'</a> &bull; '.$views.' views &bull; '.$upload.'</p>
			</div>
		</div>
	</div>
</div>';}}?>
</div></div>
		</div>
		<?php include("footer.php"); ?>
</body>
</html>
