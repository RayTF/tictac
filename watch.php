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
if($result->num_rows === 0) header('Location: index.php?err=That video does not exist or is no longer available');
while($row = $result->fetch_assoc()) {
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
										<img class="float-start rounded-circle w-100" src="content/pfp/default">
									</a>
								</div>
								<div class="col-lg-10">
												<a class="user" href="user.php?name='.$row['author'].'">'.$row['author'].''.$verified.'</a><br>
																																																																										<small>Uploaded on '.$upload.' &bull; '.$row['views'].' views &bull; '.$rows.' subscribers</small>
								</div>
							</div>
						</div>
						<div class="col-3 text-end">
							<a href="#" id="action_unlogged" class="text-success"><svg class="bi" width="20" height="20" fill="currentColor">
								<use xlink:href="icons.svg#hand-thumbs-up-fill"/>
							</svg></a> <span id="likes">1</span>
							<a href="#" id="action_unlogged" class="text-danger"><svg class="bi" width="20" height="20" fill="currentColor">
								<use xlink:href="icons.svg#hand-thumbs-down-fill"/>
							</svg></a> <span id="dislikes" style="padding-right: 10px">1</span>
							<button id="subscribe" class="btn btn-danger" type="button" disabled>Subscribe</button>
							</div>
						<p style="margin-top: 1rem;">'.$row['description'].'</p>
					</div>
				</div>
			</div>
		</div> <!-- WATCH VIDEO BOX -->');}
		echo'<!--<div class="mt-1">
				<div class="card">
				<div class="card-body">
				<h5>Comments</h5><hr class="mt-2 mb-3"/>
							<textarea class="form-control mt-2 mb-2" id="commentContents" style="overflow:hidden;resize:none" rows="3" placeholder="Please sign in in order to comment."></textarea>
							<div id="comment"></div>
									<div class="row">
	<div class="col-lg-1" style="width:5.5%;padding-right:0">
		<a href="user.php?name='.$row['author'].'">
			<img class="rounded-circle w-100" src="content/pfp/default">
		</a>
	</div>
	<div class="col-lg-10">
					<a class="user" href="user.php?name='.$row['author'].'">'.$row['author'].'</a> &bull; 19 days ago
		<p>test</p>	</div>
</div>

								</div>
				</div>
		</div>
	</div>-->';?>
	<div class="col-lg-3">
					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-5">
				<a href="watch.php?v=_G-0ZTV__-Z">
					<div class="img-thumbnail" style="margin-bottom:0">
						<img class="img-fluid" src="/web/20210827010404im_/https://squarebracket.veselcraft.ru/assets/thumb/_G-0ZTV__-Z.png">
					</div>
				</a>
			</div>
			<div class="col-7">
				<h5><a href="watch.php?v=_G-0ZTV__-Z">pagination test, move along.</a></h5>
																					<p>			<a class="user" href="user.php?name=Gamerappa">Gamerappa</a> &bull; 44 views &bull; 1 month ago</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-5">
				<a href="watch.php?v=9c_e578ppo6">
					<div class="img-thumbnail" style="margin-bottom:0">
						<img class="img-fluid" src="/web/20210827010404im_/https://squarebracket.veselcraft.ru/assets/thumb/9c_e578ppo6.png">
					</div>
				</a>
			</div>
			<div class="col-7">
				<h5><a href="watch.php?v=9c_e578ppo6">Testing new git changes</a></h5>
																					<p>			<a class="user" href="user.php?name=icanttellyou">icanttellyou</a> &bull; 40 views &bull; 3 months ago</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-5">
				<a href="watch.php?v=AGOh_mE3MzM">
					<div class="img-thumbnail" style="margin-bottom:0">
						<img class="img-fluid" src="/web/20210827010404im_/https://squarebracket.veselcraft.ru/assets/thumb/AGOh_mE3MzM.png">
					</div>
				</a>
			</div>
			<div class="col-7">
				<h5><a href="watch.php?v=AGOh_mE3MzM">Let&#039;s go! ...Discord?</a></h5>
																					<p>			<a class="user" href="user.php?name=ROllerozxa">ROllerozxa</a> &bull; 45 views &bull; 3 months ago</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-5">
				<a href="watch.php?v=4C88_8663__">
					<div class="img-thumbnail" style="margin-bottom:0">
						<img class="img-fluid" src="/web/20210827010404im_/https://squarebracket.veselcraft.ru/assets/thumb/4C88_8663__.png">
					</div>
				</a>
			</div>
			<div class="col-7">
				<h5><a href="watch.php?v=4C88_8663__">Sims 2 Kitty Shack - Another world (High Quality)</a></h5>
																					<p>			<a class="user" href="user.php?name=Gamerappa">Gamerappa</a> &bull; 47 views &bull; 3 months ago</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-5">
				<a href="watch.php?v=N_AhMTBjMQL">
					<div class="img-thumbnail" style="margin-bottom:0">
						<img class="img-fluid" src="/web/20210827010404im_/https://squarebracket.veselcraft.ru/assets/thumb/N_AhMTBjMQL.png">
					</div>
				</a>
			</div>
			<div class="col-7">
				<h5><a href="watch.php?v=N_AhMTBjMQL">a game</a></h5>
																					<p>			<a class="user" href="user.php?name=Danil_2461">Danil_2461</a> &bull; 44 views &bull; 1 month ago</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-5">
				<a href="watch.php?v=A2Ez___2LTc">
					<div class="img-thumbnail" style="margin-bottom:0">
						<img class="img-fluid" src="/web/20210827010404im_/https://squarebracket.veselcraft.ru/assets/thumb/A2Ez___2LTc.png">
					</div>
				</a>
			</div>
			<div class="col-7">
				<h5><a href="watch.php?v=A2Ez___2LTc">we&#039;re back</a></h5>
																					<p>			<a class="user" href="user.php?name=Gamerappa">Gamerappa</a> &bull; 31 views &bull; 10 days ago</p>
			</div>
		</div>
	</div>
</div>

			</div>
</div>
		</div>
		<?php include("footer.php"); ?>
</body>
</html>
