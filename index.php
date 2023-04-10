<!doctype html>
<html lang="en">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
		<link rel="stylesheet" id="bootstrap" href="sb-finalium.css" type="text/css">
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
	<script src="common.js"></script>
	<script>
		subscribe_string = 'Subscribe';
		unsubscribe_string = 'Unsubscribe';
	</script>
	<link rel="apple-touch-icon" sizes="180x180" href="/web/20210803175351im_/https://squarebracket.veselcraft.ru/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/web/20210803175351im_/https://squarebracket.veselcraft.ru/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/web/20210803175351im_/https://squarebracket.veselcraft.ru/favicon-16x16.png">
	<link rel="manifest" href="/web/20210803175351/https://squarebracket.veselcraft.ru/site.webmanifest">
	<link rel="mask-icon" href="/web/20210803175351im_/https://squarebracket.veselcraft.ru/safari-pinned-tab.svg" color="#0065d8">
	<meta name="apple-mobile-web-app-title" content="ticTac">
	<meta name="application-name" content="ticTac">
	<meta name="msapplication-TileColor" content="#fd9814">
	<meta name="msapplication-TileImage" content="/mstile-144x144.png">
	<meta name="theme-color" content="#fd9814">
	<title>Home - ticTac</title>
</head>
<style>
	.bi {
		vertical-align: -4px;
	}
</style>
<body>
	<nav id="navbar" class="navbar  navbar-light bg-light  navbar-static-top navbar-expand-md">
		<div class="container">
			<a class="navbar-brand" href="."><img src="logo.png" alt="ticTac" height="32" class="d-inline-block align-text-top"></a>
			<form class="d-flex" method="GET" action="search.php">
			<div class="input-group">
			        <span class="input-group-text" id="basic-addon1"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#search"/>
</svg></span>
				<input name="query" class="form-control" type="search" placeholder="Search" aria-label="Search">
			</div>
			</form>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div id="navbarCollapse" class="collapse navbar-collapse">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
				<ul class="navbar-nav">
										<div class="d-grid gap-2 d-md-block">
						<a href="login.php" class="btn btn-warning me-md-1">Login</a>
						<a href="register.php" class="btn btn-secondary">Register</a>
					</div>
										<div class="dropdown">
						<li class="nav-item">
							<style>
								#openSettings.nav-link {
									padding: 0.25rem;
								}
							</style>
							<a href="#" id="openSettings" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" aria-expanded="false">
								<svg class="bi" width="30" height="30" fill="currentColor">
	<use xlink:href="icons.svg#three-dots-vertical"/>
</svg>							</a>
						</li>
						<ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="mainMenu">
														<li><a class="dropdown-item" id="themeSelect" href="#"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#brush"/>
</svg> Change theme</a></li>
													</ul>
						<ul class="dropdown-menu" id="themeSelection" aria-labelledby="navbarDropdown">
							<!-- <li><a class="dropdown-item" id="back" href="#">Back</a></li>
							<li><a class="dropdown-item" id="finalium" href="#">Light</a></li>
							<li><a class="dropdown-item" id="finalium-dark" href="#">Dark</a></li>
							<li><a class="dropdown-item" id="light" href="#">Classic Light</a></li>
							<li><a class="dropdown-item" id="dark" href="#">Classic Dark</a></li>
							<li><a class="dropdown-item" id="vanilla" href="#">Bootstrap</a></li>
                         --><li><a class="dropdown-item" id="un" href="#">Theme picker not added yet</a>
						</ul>
					</div>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>
	<div class="mb-4">
	<nav class="py-1 bg-dark">
		<div class="container">
			<ul class="nav me-auto">
				<li class="nav-item"><a href="/web/20210803175351/https://squarebracket.veselcraft.ru/" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#house-door"/>
</svg> Home</a></li>
				<li class="nav-item"><a href="browse.php" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#play-btn"/>
</svg> Browse</a></li>
				<li class="nav-item"><a href="channels.php" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#people"/>
</svg> Channels</a></li>
									<li class="nav-item"><a href="https://web.archive.org/web/20210803175351/https://github.com/chazizsquarebracket/squarebracket" class="nav-link link-light px-2"><svg class="bi" width="16" height="16" fill="currentColor">
	<use xlink:href="icons.svg#github"/>
</svg> GitHub</a></li>
							</ul>
		</div>
	</nav>
	</div>
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
			<h3>Recently uploaded to ticTac</h3>
			</div><div class="col-4">
			<div class="text-end"><a href="browse.php" class="btn btn-light btn-sm">Browse videos</a></div>
			</div>
		</div>
					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=NGRwZT-1MME">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/NGRwZT-1MME.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=NGRwZT-1MME">real 2</a></h3>
																					<p>			<a class="user" href="user.php?name=Danil_2461">Danil_2461</a> &bull; 9 views	&bull;
				<span class="text-muted">8 hours ago</span></p>
				<p>real 2</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=ZTJkZQ_-ZDA">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/placeholder.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=ZTJkZQ_-ZDA">real</a></h3>
																					<p>			<a class="user" href="user.php?name=Danil_2461">Danil_2461</a> &bull; 18 views	&bull;
				<span class="text-muted">1 day ago</span></p>
				<p>real</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=MDR-Zz_uN_D">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/MDR-Zz_uN_D.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=MDR-Zz_uN_D">block_Trim</a></h3>
																					<p>			<a class="user" href="user.php?name=EricAfterEric">EricAfterEric</a> &bull; 12 views	&bull;
				<span class="text-muted">2 days ago</span></p>
				<p>the block</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=YmMiMTU4MmU">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/YmMiMTU4MmU.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=YmMiMTU4MmU">Christian Weston Chandler</a></h3>
																					<p>			<a class="user" href="user.php?name=Gamerappa">Gamerappa</a> &bull; 12 views	&bull;
				<span class="text-muted">2 days ago</span></p>
				<p>Sonichu</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=Y_R__DN5-zE">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/Y_R__DN5-zE.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=Y_R__DN5-zE">July 30th 2021 - Gamerappa streams on YouTube</a></h3>
																					<p>			<a class="user" href="user.php?name=GamerappaArchive">GamerappaArchive</a> &bull; 22 views	&bull;
				<span class="text-muted">2 days ago</span></p>
				<p>This was a livestream that Gamerappa hosted on July 30th 2021. It was a test livestream and got privated.</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=Mw_5N_Z-ZDS">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/Mw_5N_Z-ZDS.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=Mw_5N_Z-ZDS">uploader yes?</a></h3>
																					<p>			<a class="user" href="user.php?name=icanttellyou">icanttellyou</a> &bull; 7 views	&bull;
				<span class="text-muted">2 days ago</span></p>
				<p>yes</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=NGt0_DJhY-Q">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/placeholder.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=NGt0_DJhY-Q">test</a></h3>
																					<p>			<a class="user" href="user.php?name=DisplayNameTest">DisplayNameTest</a> &bull; 11 views	&bull;
				<span class="text-muted">2 days ago</span></p>
				<p>test</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=Nzdi--EzMmI">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/Nzdi--EzMmI.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=Nzdi--EzMmI">this will 2001 right?</a></h3>
																					<p>			<a class="user" href="user.php?name=icanttellyou">icanttellyou</a> &bull; 22 views	&bull;
				<span class="text-muted">3 days ago</span></p>
				<p>testing</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=NGL5NzI4-J_">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/NGL5NzI4-J_.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=NGL5NzI4-J_">squareBracket Security Issue: Password Reset Requests</a></h3>
																					<p>			<a class="user" href="user.php?name=Gamerappa">Gamerappa</a> &bull; 43 views	&bull;
				<span class="text-muted">3 days ago</span></p>
				<p>Just found out about this, accounts can likely end up being stolen easily by administrators.

If I remember correctly, Sublayer/Roller implemented this feature nearly a month ago during Alpha 3 Refresh (or Pre-Beta?)</p>
			</div>
		</div>
	</div>
</div>

					<div class="card" style="margin-bottom:10px">
	<div class="card-body">
		<div class="row">
			<div class="col-4">
				<a href="watch.php?v=Z_E-_mQ4L-V">
					<div class="img-thumbnail">
						<img class="img-fluid" src="/web/20210803175351im_/https://squarebracket.veselcraft.ru/assets/thumb/Z_E-_mQ4L-V.png">
					</div>
				</a>
			</div>
			<div class="col-6">
				<h3><a href="watch.php?v=Z_E-_mQ4L-V">шапку у меня спиздил</a></h3>
																					<p>			<a class="user" href="user.php?name=veselcraft">veselcraft</a> &bull; 23 views	&bull;
				<span class="text-muted">4 days ago</span></p>
				<p></p>
			</div>
		</div>
	</div>
</div>

			</div>
	<div class="col-xl-4">
					<h3>Welcome to ticTac</h3>
			<p>I can't believe it's not RevTube</p>
				<hr/>
		<h3>News and updates</h3>
		<p>This is that one shitty website that I never finished from 2022, except it's not shitty now!</p>
		<p class="blockquote-footer">crazyassfella</p>
		<figure>
		  <blockquote class="blockquote">
		    <p>when will you stop making shitty youtube clones??? get a life and touch grass you retard</p>
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
		<div class="p-3">
			<div class="container">
			<div class="card">
			<div class="card-body">
			<h4 class="my-0">ticTac Beta 1.1</h4>
            <p class="my-0"><b>By the ticTac contributors</b> · 2022-2023 | <b>Users registered</b>: 0 | <b>Videos uploaded</b>: 0</p>
			<p class="my-0"><a href="about.php" class="me-1">About</a> <a class="me-1">Terms</a> <a class="me-1">Guidelines</a> <a class="me-1">Contact</a></p>
			</div>
			</div>
		</footer>
	<!-- gamerappa killed the bazinga star -->
	</div>
</body>
</html>